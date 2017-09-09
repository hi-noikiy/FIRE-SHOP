<?php
//zend by 旺旺ecshop2012所有 禁止倒卖 一经发现停止任何服务
namespace App\Services;

class StoreService
{
	private $storeRepository;

	public function __construct(\App\Repositories\Store\StoreRepository $storeRepository)
	{
		$this->storeRepository = $storeRepository;
	}

	public function storeList()
	{
		$list = $this->storeRepository->all();
		return $list;
	}

	public function detail($id)
	{
		$list = $this->storeRepository->detail($id);
		$goods = $this->storeRepository->goods($id);

		foreach ($goods as $key => $value) {
			$goods[$key]['goods_name'] = $value['goods_name'];
			$goods[$key]['goods_thumb'] = get_image_path($value['goods_thumb']);
			$goods[$key]['shop_price'] = $value['shop_price'];
			$goods[$key]['cat_id'] = $value['cat_id'];
			$goods[$key]['market_price'] = $value['market_price'];
			$goods[$key]['goods_number'] = $value['goods_number'];
		}

		$list['goods'] = $goods;
		return $list;
	}
}


?>
