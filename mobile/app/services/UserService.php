<?php
//zend by 旺旺ecshop2012所有 禁止倒卖 一经发现停止任何服务
namespace App\Services;

class UserService
{
	private $orderRepository;
	private $goodsRepository;
	private $userRepository;
	private $addressRepository;
	private $regionRepository;
	private $userBonusRepository;
	private $accountRepository;
	private $collectGoodsRepository;
	private $shopService;
	private $commentRepository;

	public function __construct(\App\Repositories\Order\OrderRepository $orderRepository, \App\Repositories\Goods\GoodsRepository $goodsRepository, \App\Repositories\User\UserRepository $userRepository, \App\Repositories\User\AddressRepository $addressRepository, \App\Repositories\Region\RegionRepository $regionRepository, \App\Repositories\Bonus\UserBonusRepository $userBonusRepository, \App\Repositories\User\AccountRepository $accountRepository, \App\Repositories\Goods\CollectGoodsRepository $collectGoodsRepository, ShopService $shopService, \App\Repositories\Comment\CommentRepository $commentRepository)
	{
		$this->orderRepository = $orderRepository;
		$this->goodsRepository = $goodsRepository;
		$this->userRepository = $userRepository;
		$this->addressRepository = $addressRepository;
		$this->regionRepository = $regionRepository;
		$this->userBonusRepository = $userBonusRepository;
		$this->accountRepository = $accountRepository;
		$this->collectGoodsRepository = $collectGoodsRepository;
		$this->shopService = $shopService;
		$this->commentRepository = $commentRepository;
	}

	public function userCenter(array $args)
	{
		$userId = $args['uid'];
		$result['order']['all_num'] = $this->orderRepository->orderNum($userId);
		$result['order']['no_paid_num'] = $this->orderRepository->orderNum($userId, 0);
		$result['order']['no_received_num'] = $this->orderRepository->orderNum($userId, 1);
		$result['order']['no_evaluation_num'] = $this->orderRepository->orderNum($userId, 3);
		$result['userInfo'] = $this->userRepository->userInfo($userId);
		$bestGoods = $this->goodsRepository->findByType('best');
		$result['best_goods'] = array_map(function($v) {
			return array('goods_id' => $v['goods_id'], 'goods_name' => $v['goods_name'], 'market_price' => $v['market_price'], 'shop_price' => $v['shop_price'], 'goods_thumb' => get_image_path($v['goods_thumb']));
		}, $bestGoods);
		return $result;
	}

	public function orderList($args)
	{
		$orderList = $this->orderRepository->getOrderByUserId($args['uid'], $args['status']);

		foreach ($orderList as $k => $v) {
			$orderList[$k]['add_time'] = date('Y-m-d H:i', $v['add_time']);
			$orderList[$k]['order_status'] = $this->orderStatus($v['order_status']);
			$orderList[$k]['pay_status'] = $this->payStatus($v['pay_status']);
			$orderList[$k]['shipping_status'] = $this->shipStatus($v['shipping_status']);
			$dataTotalNumber = 0;

			foreach ($v['goods'] as $gk => $gv) {
				$dataTotalNumber += $gv['goods_number'];
				$orderList[$k]['goods'][$gk]['goods_thumb'] = get_image_path($gv['goods_thumb']);

				if (empty($orderList[$k]['shop_name'])) {
					$orderList[$k]['shop_name'] = $this->shopService->getShopName($gv['user_id']);
					unset($orderList[$k]['goods'][$gk]['user_id']);
				}
			}

			$orderList[$k]['goods'] = array_slice($orderList[$k]['goods'], 0, 3);
			$orderList[$k]['total_number'] = $dataTotalNumber;
			$orderList[$k]['total_amount'] = price_format($v['money_paid'] + $v['order_amount'], false);
		}

		return $orderList;
	}

	public function orderDetail($args)
	{
		$order = $this->orderRepository->orderDetail($args['uid'], $args['goods_id']);

		if (empty($order)) {
			return array();
		}

		$address = $this->regionRepository->getRegionName($order['country']);
		$address .= $this->regionRepository->getRegionName($order['province']);
		$address .= $this->regionRepository->getRegionName($order['city']);
		$address .= $this->regionRepository->getRegionName($order['district']);
		$address .= $order['address'];
		$list = array('add_time' => date('Y-m-d H:i', $order['add_time']), 'shipping_time' => date('Y-m-d H:i', $order['shipping_time']), 'address' => $address, 'consignee' => $order['consignee'], 'mobile' => $order['mobile'], 'money_paid' => $order['money_paid'], 'order_amount' => $order['order_amount'], 'order_id' => $order['order_id'], 'order_sn' => $order['order_sn'], 'order_status' => $this->orderStatus($order['order_status']), 'pay_status' => $this->payStatus($order['pay_status']), 'shipping_status' => $this->shipStatus($order['shipping_status']), 'pay_time' => $order['pay_time'], 'pay_fee' => $order['pay_fee'], 'pay_name' => $order['pay_name'], 'shipping_fee' => $order['shipping_fee'], 'shipping_id' => $order['shipping_id']);

		if (!empty($list)) {
			$orderGoods = $this->orderRepository->getOrderGoods($args['goods_id']);
			$goodsList = array();
			$total_number = 0;

			foreach ($orderGoods as $k => $v) {
				$goodsList[$k]['goods_id'] = $v['goods_id'];
				$goodsList[$k]['goods_name'] = $v['goods_name'];
				$goodsList[$k]['goods_number'] = $v['goods_number'];
				$goodsList[$k]['goods_price'] = $v['goods_price'];
				$goodsList[$k]['goods_sn'] = $v['goods_sn'];
				$goodsList[$k]['shop_name'] = $this->shopService->getShopName($v['ru_id']);
				$total_number += $v['goods_number'];
			}

			$list['goods'] = $goodsList;
			$list['total_number'] = $total_number;
		}

		return $list;
	}

	public function orderAppraise($args)
	{
		$list = $this->orderRepository->getReceived($args['uid']);
		$orders = array();

		foreach ($list as $k => $v) {
			foreach ($v['goods'] as $gk => $gv) {
				if (empty($gv['rec_id'])) {
					continue;
				}

				$orders[] = array('id' => $gv['goods_id'], 'oid' => $gv['order_id'], 'goods_name' => $gv['goods_name'], 'shop_price' => $gv['goods_price'], 'goods_thumb' => get_image_path($gv['goods_thumb']));
			}
		}

		return $orders;
	}

	public function orderAppraiseDetail($args)
	{
		$list = $this->orderRepository->orderAppraiseDetail($args['uid'], $args['oid'], $args['gid']);
		$arr = $list['goods'][0];
		$arr['goods_thumb'] = get_image_path($arr['goods_thumb']);
		return $arr;
	}

	public function orderAppraiseAdd($args)
	{
		$now = \Carbon\Carbon::now('Asia/shanghai')->toDateTimeString();
		$arr = array('comment_type' => 0, 'id_value' => $args['gid'], 'email' => 'email', 'user_name' => 'user_name', 'content' => $args['content'], 'comment_rank' => $args['rank'], 'add_time' => $now, 'ip_address' => app('request')->ip(), 'status' => 1 - _config('shop.comment_check'), 'parent_id' => 0, 'user_id' => $args['uid'], 'single_id' => 0, 'order_id' => $args['oid']);
		return $this->commentRepository->orderAppraiseAdd($arr);
	}

	public function orderCancel($args)
	{
		$goods = $this->orderRepository->find($args['goods_id']);

		if ($goods['user_id'] != $args['uid']) {
			return array('error' => 1, 'msg' => '不是本人订单');
		}

		if (($goods['order_status'] != \App\Models\OrderInfo::OS_UNCONFIRMED) && ($goods['order_status'] != \App\Models\OrderInfo::OS_CONFIRMED)) {
			return array('error' => 1, 'msg' => '订单不能取消');
		}

		if ($goods['shipping_status'] != \App\Models\OrderInfo::SS_UNSHIPPED) {
			return array('error' => 1, 'msg' => '订单已确认');
		}

		if ($goods['pay_status'] != \App\Models\OrderInfo::PS_UNPAYED) {
			return array('error' => 1, 'msg' => '订单已付款，请与商家联系');
		}

		$res = $this->orderRepository->orderCancel($args['uid'], $args['goods_id']);
		return $res;
	}

	private function orderStatus($num)
	{
		$array = array('未确认', '已确认', '已取消', '无效', '退货', '已分单', '部分分单');
		return $array[$num];
	}

	private function payStatus($num)
	{
		$array = array('未付款', '付款中', '已付款');
		return $array[$num];
	}

	private function shipStatus($num)
	{
		$array = array('未发货', '已发货', '已收货', '备货中', '已发货(部分商品)', '发货中(处理分单)', '已发货(部分商品)');
		return $array[$num];
	}

	public function userAddressList($userId)
	{
		$userInfo = $this->userRepository->userInfo($userId);
		$res = $this->addressRepository->addressListByUserId($userId);
		$default = $userInfo['address_id'];
		$list = array_map(function($v) use($default) {
			$v['country_name'] = $this->regionRepository->getRegionName($v['country']);
			$v['province_name'] = $this->regionRepository->getRegionName($v['province']);
			$v['city_name'] = $this->regionRepository->getRegionName($v['city']);
			$v['district_name'] = $this->regionRepository->getRegionName($v['district']);
			$v['street_name'] = $this->regionRepository->getRegionName($v['street']);
			$v['id'] = $v['address_id'];
			$v['default'] = $v['address_id'] == $default ? 1 : 0;
			unset($v['country']);
			unset($v['province']);
			unset($v['city']);
			unset($v['district']);
			unset($v['street']);
			unset($v['address_id']);
			unset($v['email']);
			unset($v['address_name']);
			$v['address'] = $v['country_name'] . ' ' . $v['province_name'] . ' ' . $v['city_name'] . ' ' . $v['district_name'] . ' ' . $v['street_name'] . ' ' . $v['address'];
			return $v;
		}, $res);
		return $list;
	}

	public function addressChoice(array $args)
	{
		$res = $this->addressRepository->find($args['id']);
		if (empty($res) || ($args['uid'] != $res['user_id'])) {
			return false;
		}

		return $this->userRepository->setDefaultAddress($args['id'], $args['uid']);
	}

	public function addressAdd(array $args)
	{
		$arr = array('user_id' => $args['uid'], 'consignee' => $args['consignee'], 'email' => '', 'country' => !empty($args['country']) ? $args['country'] : '', 'province' => !empty($args['province']) ? $args['province'] : '', 'city' => !empty($args['city']) ? $args['city'] : '', 'district' => !empty($args['region']) ? $args['region'] : '', 'address' => $args['address'], 'mobile' => isset($args['mobile']) ? $args['mobile'] : '', 'address_name' => '', 'sign_building' => '', 'best_time' => '');
		$res = $this->addressRepository->addAddress($arr);
		return $res;
	}

	public function addressDetail($args)
	{
		$res = $this->addressRepository->find($args['id']);
		if (empty($res) || ($args['uid'] != $res['user_id'])) {
			return false;
		}

		return array('id' => $res->address_id, 'consignee' => $res->consignee, 'country_id' => $res->country, 'province_id' => $res->province, 'city_id' => $res->city, 'district_id' => $res->district, 'address' => $res->address, 'mobile' => $res->mobile);
	}

	public function addressUpdate($args)
	{
		$arr = array('user_id' => $args['uid'], 'consignee' => $args['consignee'], 'email' => '', 'country' => !empty($args['country']) ? $args['country'] : '', 'province' => !empty($args['province']) ? $args['province'] : '', 'city' => !empty($args['city']) ? $args['city'] : '', 'district' => !empty($args['region']) ? $args['region'] : '', 'address' => $args['address'], 'mobile' => isset($args['mobile']) ? $args['mobile'] : '', 'address_name' => '', 'sign_building' => '', 'best_time' => '');
		$res = $this->addressRepository->updateAddress($args['id'], $arr);
		return (int) $res;
	}

	public function addressDelete($args)
	{
		$res = $this->addressRepository->deleteAddress($args['id'], $args['uid']);
		return $res;
	}

	public function userAccount($userId)
	{
		$userInfo = $this->userRepository->userInfo($userId);

		if (empty($userInfo)) {
			return array();
		}

		$result['user_money'] = $userInfo['user_money'];
		$result['frozen_money'] = $userInfo['frozen_money'];
		$result['pay_points'] = $userInfo['pay_points'];
		$result['bonus_num'] = $this->userBonusRepository->getUserBonusCount($userId);
		return $result;
	}

	public function accountDetail($args)
	{
		$list = $this->accountRepository->accountList($args['user_id'], $args['page'], $args['size']);
		$accountList = array_map(function($v) {
			return array('log_sn' => $v['log_id'], 'money' => $v['user_money'], 'time' => $v['change_time']);
		}, $list);
		return $accountList;
	}

	public function accountLog($args)
	{
		$list = $this->accountRepository->accountLogList($args['user_id'], $args['page'], $args['size']);
		$logList = array_map(function($v) {
			return array('log_sn' => $v['id'], 'money' => $v['amount'], 'time' => $v['add_time'], 'type' => $v['process_type'] == 0 ? '充值' : '提现', 'status' => $v['is_paid'] == 0 ? '未支付' : '已支付');
		}, $list);
		return $logList;
	}

	public function deposit($args)
	{
		$arr = array('user_id' => $args['uid'], 'amount' => $args['amount'], 'add_time' => time(), 'user_note' => $args['user_note'], 'payment' => $args['payment']);
		return $this->accountRepository->deposit($arr);
	}

	public function collectGoods($args)
	{
		$list = $this->collectGoodsRepository->findByUserId($args['user_id'], $args['page'], $args['size']);
		$collect = array_map(function($v) {
			$goodsInfo = $this->goodsRepository->goodsInfo($v['goods_id']);
			return array('goods_name' => $goodsInfo['goods_name'], 'shop_price' => $goodsInfo['goods_price'], 'goods_thumb' => get_image_path($goodsInfo['goods_thumb']), 'goods_stock' => $goodsInfo['stock'], 'time' => $v['add_time'], 'goods_id' => $v['goods_id']);
		}, $list);
		return $collect;
	}

	public function collectAdd($args)
	{
		$collectGoods = $this->collectGoodsRepository->findOne($args['id'], $args['uid']);

		if (empty($collectGoods)) {
			$result = $this->collectGoodsRepository->addCollectGoods($args['id'], $args['uid']);
		}
		else {
			$result = $this->collectGoodsRepository->deleteCollectGoods($args['id'], $args['uid']);
		}

		return $result;
	}

	public function myConpont($args)
	{
		$list = array();
		return $list;
	}
}


?>
