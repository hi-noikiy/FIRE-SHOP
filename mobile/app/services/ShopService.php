<?php
//zend by 旺旺ecshop2012所有 禁止倒卖 一经发现停止任何服务
namespace App\Services;

class ShopService
{
	private $shopRepository;

	public function __construct(\App\Repositories\Shop\ShopRepository $shopRepository)
	{
		$this->shopRepository = $shopRepository;
	}

	public function getShopName($ruId)
	{
		$shopInfo = $this->shopRepository->findBY('ru_id', $ruId);

		if (0 < count($shopInfo)) {
			$shopInfo = $shopInfo[0];

			if ($shopInfo['shopname_audit'] == 1) {
				if (0 < $ruId) {
					$shopName = $shopInfo['brandName'] . $shopInfo['shopNameSuffix'];
				}
				else {
					$shopName = $shopInfo['shop_name'];
				}
			}
			else {
				$shopName = $shopInfo['rz_shopName'];
			}
		}
		else {
			$shopName = '';
		}

		return $shopName;
	}
}


?>
