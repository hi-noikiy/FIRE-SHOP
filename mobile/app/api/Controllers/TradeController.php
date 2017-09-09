<?php
//zend by 旺旺ecshop2012所有 禁止倒卖 一经发现停止任何服务
namespace App\Api\Controllers;

class TradeController extends \App\Api\Foundation\Controller
{
	protected $trade;
	protected $tradeTransformer;

	public function __construct(\App\Repositories\trade\TradeRepository $trade, \app\api\v2\trade\transformer\TradeTransformer $tradeTransformer)
	{
		parent::__construct();
		$this->trade = $trade;
		$this->tradeTransformer = $tradeTransformer;
	}

	public function actionGet()
	{
	}
}

?>
