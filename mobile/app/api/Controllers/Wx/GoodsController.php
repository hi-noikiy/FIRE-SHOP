<?php
//zend by 旺旺ecshop2012所有 禁止倒卖 一经发现停止任何服务
namespace App\Api\Controllers\Wx;

class GoodsController extends \App\Api\Controllers\Controller
{
	private $goodsService;
	private $authService;

	public function __construct(\App\Services\GoodsService $goodsService, \App\Services\AuthService $authService)
	{
		$this->goodsService = $goodsService;
		$this->authService = $authService;
	}

	public function goodsList(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('id' => 'required', 'page' => 'required|int'));
		$list = $this->goodsService->getGoodsList($request->get('id'), $request->get('page'));
		return $this->apiReturn($list);
	}

	public function goodsDetail(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('id' => 'required|integer'));
		$uid = $this->authService->authorization();
		$list = $this->goodsService->goodsDetail($request->get('id'), $uid);
		return $this->apiReturn($list);
	}

	public function property(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('id' => 'required|integer', 'attr_id' => 'required', 'num' => 'required|integer', 'warehouse_id' => 'required|integer', 'area_id' => 'required|integer'));
		$price = $this->goodsService->goodsPropertiesPrice($request->get('id'), $request->get('attr_id'), $request->get('num'), $request->get('warehouse_id'), $request->get('area_id'));
		return $this->apiReturn($price);
	}
}

?>
