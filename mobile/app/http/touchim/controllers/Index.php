<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace app\http\touchim\controllers;

class Index extends \app\http\base\controllers\Frontend
{
	protected $config;

	public function __construct()
	{
		$this->config = require_once ROOT_PATH . '../kefu/config/config.php';
		parent::__construct();
	}

	public function actionIndex()
	{
		$uid = (!empty($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : 0);

		if (empty($uid)) {
			$this->redirect('user/login/index');
		}

		$user = $this->db->getRow('SELECT * FROM {pre}users WHERE user_id = ' . $uid);

		if (empty($user['user_name'])) {
			$this->redirect('/', 3, '没有用户');
		}

		$goodsId = I('goods_id');
		$ruId = I('ru_id', null);
		$dialog = $this->db->getRow('SELECT id, goods_id, customer_id, services_id, store_id, status FROM ' . \kefu\app\models\Kefu::$pre . 'im_dialog WHERE customer_id = ' . $uid . ' order by start_time DESC');
		$rootPath = rtrim(rtrim(dirname(__ROOT__), '\\'),'/');

		if ($goodsId) {
			$goods = $this->db->getRow('SELECT goods_thumb, goods_name, shop_price, user_id FROM ' . \kefu\app\models\Kefu::$pre . 'goods WHERE goods_id = ' . $goodsId);
			$goods['goods_id'] = $goodsId;
			$goods['goods_thumb'] = $rootPath . '/' . $goods['goods_thumb'];
			$this->assign('goods', $goods);
		}

		if (!$ruId && !empty($goods)) {
			$ruId = $goods['user_id'];
		}

		if (!empty($dialog) && ($dialog['store_id'] === $ruId)) {
			$this->assign('status', $dialog['status']);
			$this->assign('services_id', $dialog['services_id']);
		}

		if (empty($ruId) && empty($goodsId)) {
			//$this->redirect('user/index/index');
		}

		$shopinfo = get_shop_name($ruId, 2);
		$shopinfo['shop_name'] = get_shop_name($ruId, 1);
		$shopinfo['ru_id'] = $ruId;
		$shopinfo['logo_thumb'] = get_image_path(str_replace('../', '', $shopinfo['logo_thumb']));
		$this->assign('shopinfo', $shopinfo);
		$this->assign('user_id', $user['user_id']);
		$this->assign('user_name', $user['user_name']);

		if (empty($user['user_picture'])) {
			$user_pic = $rootPath . '/kefu/public/assets/images/' . $this->config['default_avatar'];
		}
		else {
			$user_pic = $rootPath . '/' . $user['user_picture'];
		}

		$this->assign('avatar', $user_pic);
		$this->assign('title', $shopinfo['shop_name']);

		if (empty($this->config['prot'])) {
			show_message('socket端口号未配置');
		}

		if (empty($this->config['listen_route'])) {
			$listen_route = $this->getServerIp();
		}
		else {
			$listen_route = $this->config['listen_route'];
		}

		$this->assign('listen_route', $listen_route);
		$this->assign('prot', $this->config['prot']);
		$sql = 'UPDATE ' . \kefu\app\models\Kefu::$pre . 'im_message SET status = 0 WHERE status = 1 AND to_user_id = ' . $uid;
		$this->db->query($sql);
		$this->display('index');
	}

	public function actionChatList()
	{
		$uid = (!empty($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : 0);

		if (empty($uid)) {
			$this->error('请先登录');
		}
		$sql = 'SELECT d.id as dialog_id, s.id as service_id, u.user_id as admin_id, u.ru_id, i.logo_thumb, i.shop_name FROM ' . \kefu\app\models\Kefu::$pre . 'im_dialog d ';
		$sql .= ' LEFT JOIN ' . \kefu\app\models\Kefu::$pre . 'im_service s ON s.id = d.services_id';
		$sql .= ' LEFT JOIN ' . \kefu\app\models\Kefu::$pre . 'admin_user u ON u.user_id = s.user_id ';
		$sql .= ' LEFT JOIN ' . \kefu\app\models\Kefu::$pre . 'seller_shopinfo i ON i.ru_id = u.ru_id';
		$sql .= ' WHERE  d.customer_id = ' . $uid . '  GROUP BY services_id ';
		$serId = $this->db->getAll($sql);
		$store = array();


		foreach ($serId as $k => $v) {
			if( $v['ru_id'] ) {
				$store[$v['ru_id']][$v['service_id']] = $v;
				$store[$v['ru_id']]['logo_thumb'] = get_image_path(ltrim($v['logo_thumb'], '../'));
				$store[$v['ru_id']]['shop_name'] = $v['shop_name'];
			}
		}

		$storeMessage = array();


		foreach ($store as $k => $v) {
			$storeMessage[$k]['ru_id'] = $k;
			$storeMessage[$k]['thumb'] = $v['logo_thumb'];
			$storeMessage[$k]['shop_name'] = $v['shop_name'];
			unset($v['logo_thumb']);
			unset($v['shop_name']);
			$serviceId = implode(',', array_keys($v));

			if (empty($serviceId)) {
				continue;
			}

			$sql = 'SELECT count(*) FROM ' . \kefu\app\models\Kefu::$pre . 'im_message WHERE (from_user_id in (' . $serviceId . ')  AND to_user_id =' . $uid . ') OR (to_user_id in (' . $serviceId . ') AND from_user_id =' . $uid . ') AND status = 1';
			$storeMessage[$k]['count'] = $this->db->getOne($sql);
			$sql = 'SELECT message, from_unixtime(add_time) as add_time FROM ' . \kefu\app\models\Kefu::$pre . 'im_message WHERE (from_user_id in (' . $serviceId . ')  AND to_user_id =' . $uid . ') OR (to_user_id in (' . $serviceId . ') AND from_user_id =' . $uid . ') ORDER BY add_time DESC limit 1';
			$res = $this->db->getRow($sql);
			$storeMessage[$k]['message'] = htmlspecialchars_decode($res['message']);
			$storeMessage[$k]['add_time'] = $res['add_time'];
		}

		$this->assign('message', $storeMessage);
		$this->display('chatList');
	}

	public function actionSingleChatList()
	{
		$uid = (!empty($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : I('uid'));
		$store_id = I('store_id', 0, 'intval');
		$rootPath = rtrim(rtrim(dirname(dirname(__ROOT__)), '/'), '\\');

		$page = I('page', 1);

		if (6 < $page) {
			$this->ajaxReturn(json_encode(array('error' => 1, 'content' => '没有更多了')));
		}

		$default_size = 3;
		$size = 10;
		$type = I('type', 0);

		if ($type === 'default') {
			$page = 1;
			$size = $default_size;
		}

		$sql = 'SELECT s.id FROM ' . \kefu\app\models\Kefu::$pre . 'im_service' . ' s' . ' LEFT JOIN ' . \kefu\app\models\Kefu::$pre . 'admin_user' . ' u ON s.user_id = u.user_id' . ' WHERE u.ru_id = ' . $store_id;
		$serArr = $this->db->getCol($sql);
		$serArr = implode(',', $serArr);
		$sql = 'SELECT id, IF(from_user_id = ' . $uid . ", to_user_id, from_user_id) as service_id, message, user_type, from_user_id, to_user_id,\r\n from_unixtime(add_time) as add_time FROM " . \kefu\app\models\Kefu::$pre . 'im_message WHERE ((from_user_id = ' . $uid . ' AND to_user_id IN (' . $serArr . ')) OR (to_user_id = ' . $uid . ' AND from_user_id IN (' . $serArr . '))) AND to_user_id <> 0 ORDER BY add_time DESC, id DESC';
		$default = I('default', 0);
		$start = ($page - 1) * $size;

		if ($default == 1) {
			$start += $default_size;
		}

		if (1 < $page) {
			$start -= $size;
		}

		$sql .= ' limit ' . $start . ', ' . $size;
		$services = $this->db->getAll($sql);

		foreach ($services as $k => $v) {
			if ($v['user_type'] == 1) {
				$sql = 'SELECT s.nick_name, i.logo_thumb FROM ' . \kefu\app\models\Kefu::$pre . 'im_service s' . ' LEFT JOIN ' . \kefu\app\models\Kefu::$pre . 'admin_user u ON s.user_id = u.user_id' . ' LEFT JOIN ' . \kefu\app\models\Kefu::$pre . 'seller_shopinfo i ON i.ru_id = u.ru_id' . ' WHERE s.id = ' . $v['from_user_id'];
				$nickName = $this->db->getRow($sql);
				$services[$k]['name'] = $nickName['nick_name'];
				$services[$k]['avatar'] = $this->formatImage($nickName['logo_thumb']);
			}
			else if ($v['user_type'] == 2) {
				$sql = 'SELECT user_name, user_picture FROM ' . \kefu\app\models\Kefu::$pre . 'users WHERE user_id = ' . $v['from_user_id'];
				$nickName = $this->db->getRow($sql);
				$services[$k]['name'] = $nickName['user_name'];
				$services[$k]['avatar'] = $rootPath . '/data/images_user/' . (empty($nickName['user_picture']) ? $this->config['default_avatar'] : $nickName['user_picture']);
			}

			$services[$k]['message'] = htmlspecialchars_decode($v['message']);
			$services[$k]['time'] = $v['add_time'];
			$services[$k]['id'] = $v['id'];
		}

		$this->ajaxReturn(json_encode($services));
	}

	public function getServerIp()
	{
		if (isset($_SERVER)) {
			if ($_SERVER['SERVER_ADDR']) {
				$server_ip = $_SERVER['SERVER_ADDR'];
			}
			else {
				$server_ip = $_SERVER['LOCAL_ADDR'];
			}
		}
		else {
			$server_ip = getenv('SERVER_ADDR');
		}

		return $server_ip;
	}

	public function formatImage($pic)
	{
		$rootPath = rtrim(rtrim(dirname(dirname(__ROOT__)), '/'), '\\');
		if (empty($pic) || ($pic == $this->config['default_avatar'])) {
			return $rootPath . '/kefu/public/assets/images/' . (empty($pic) ? $this->config['default_avatar'] : $pic);
		}

		return $rootPath . '/images_user/' . $pic;
	}

	public function actionSendImage()
	{
		$result = $this->upload('kefu/images', true, 2);

		if ($result['error'] == 0) {
			$arr = array(
				'code' => 0,
				'msg'  => '上传成功',
				'data' => array('src' => dirname(__ROOT__) . '/' . $result['url'], 'title' => '')
				);
			$this->ajaxReturn($arr);
		}
	}
}

?>
