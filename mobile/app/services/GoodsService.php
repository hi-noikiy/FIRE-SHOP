<?php
//zend by 旺旺ecshop2012所有 禁止倒卖 一经发现停止任何服务
namespace App\Services;

class GoodsService
{
	private $goodsRepository;
	private $goodsAttrRepository;
	private $collectGoodsRepository;
	private $shopService;

	public function __construct(\App\Repositories\Goods\GoodsRepository $goodsRepository, \App\Repositories\Goods\GoodsAttrRepository $goodsAttrRepository, \App\Repositories\Goods\CollectGoodsRepository $collectGoodsRepository, ShopService $shopService)
	{
		$this->goodsRepository = $goodsRepository;
		$this->goodsAttrRepository = $goodsAttrRepository;
		$this->collectGoodsRepository = $collectGoodsRepository;
		$this->shopService = $shopService;
	}

	public function getGoodsList($categoryId = 0, $page = 1)
	{
		$page = (empty($page) ? 1 : $page);
		$size = 10;
		$field = array('goods_id', 'goods_name', 'shop_price', 'goods_thumb', 'goods_number', 'market_price', 'sales_volume');
		$list = $this->goodsRepository->findBy('category', $categoryId, $page, $size, $field);
		return $list;
	}

	public function goodsDetail($id, $uid)
	{
		$result = array('goods_img' => '', 'goods_info' => '', 'goods_comment' => '', 'goods_properties' => '');
		$collect = $this->collectGoodsRepository->findOne($id, $uid);
		$result['goods_comment'] = $this->goodsRepository->goodsComment($id);
		$goodsInfo = $this->goodsRepository->goodsInfo($id);
		$goodsInfo['goods_thumb'] = get_image_path($goodsInfo['goods_thumb']);
		$result['goods_info'] = array_merge($goodsInfo, array('is_collect' => empty($collect) ? 0 : 1));
		$ruId = $goodsInfo['user_id'];
		unset($result['goods_info']['user_id']);
		$result['shop_name'] = $this->shopService->getShopName($ruId);
		$goodsGallery = $this->goodsRepository->goodsGallery($id);

		foreach ($goodsGallery as $k => $v) {
			$goodsGallery[$k] = get_image_path($v['thumb_url']);
		}

		$result['goods_img'] = $goodsGallery;
		$result['goods_properties'] = $this->goodsRepository->goodsProperties($id);
		return $result;
	}

	public function goodsPropertiesPrice($goods_id, $attr_id, $num = 1, $warehouse_id = 0, $area_id = 0)
	{
		$result = array('attr_number' => '', 'market_price' => '', 'qty' => '', 'spec_price' => '', 'result' => '', 'attr_img' => '');
		$goods = $this->goodsRepository->goodsInfo($goods_id);
		$property = explode(',', $attr_id);
		$result['attr_number'] = $this->goodsRepository->goodsAttrNumber($goods_id, $attr_id, $warehouse_id, $area_id);
		$result['market_price'] = $goods['market_price'];
		$result['qty'] = $num;
		$result['spec_price'] = $this->goodsAttrRepository->propertyPrice($goods_id, $property, $warehouse_id, $area_id);
		$result['result'] = $this->goodsRepository->getFinalPrice($goods_id, $num, true, $property, $warehouse_id, $area_id);
		$attr_img = $this->goodsRepository->getAttrImgFlie($goods_id, $property[0]);

		if (!empty($attr_img)) {
			$result['attr_img'] = get_image_path($attr_img['attr_img_flie']);
		}

		return $result;
	}
}


?>
