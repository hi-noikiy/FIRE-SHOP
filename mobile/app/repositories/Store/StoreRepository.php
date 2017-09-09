<?php
//zend by 旺旺ecshop2012所有 禁止倒卖 一经发现停止任何服务
namespace App\Repositories\Store;

class StoreRepository implements \App\Contracts\Repository\Store\StoreRepositoryInterface
{
	public function all()
	{
		$store = \App\Models\MerchantsShopInformation::select('shop_id', 'user_id', 'rz_shopName')->with(array('sellershopinfo' => function($query) {
			$query->select('logo_thumb', 'ru_id');
		}))->get()->toArray;
		return $store;
	}

	public function detail($id)
	{
		$detail = \App\Models\MerchantsShopInformation::select('shop_id', 'user_id', 'rz_shopName')->with(array('sellershopinfo' => function($query) {
			$query->select('logo_thumb', 'street_thumb', 'ru_id');
		}))->get()->toArray();
		return $detail;
	}

	public function goods($id)
	{
		$goods = \App\Models\Goods::select('goods_id', 'goods_name', 'goods_thumb', 'shop_price', 'cat_id', 'market_price', 'goods_number')->where('user_id', $id)->where('store_best', '1')->where('is_on_sale', '1')->where('is_alone_sale', '1')->get()->toArray();
		return $goods;
	}

	public function create(array $data)
	{
	}

	public function update(array $data, $id)
	{
	}

	public function delete($id)
	{
	}

	public function find($id, $columns = array('*'))
	{
	}

	public function findBy($field, $value, $columns = array('*'))
	{
	}
}

?>
