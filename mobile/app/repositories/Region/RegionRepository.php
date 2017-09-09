<?php
//zend by 旺旺ecshop2012所有 禁止倒卖 一经发现停止任何服务
namespace App\Repositories\Region;

class RegionRepository implements \App\Contracts\Repository\Region\RegionRepositoryInterface
{
	public function getRegionName($regionId)
	{
		$regionName = \App\Models\Region::where('region_id', $regionId)->pluck('region_name')->toArray();

		if (empty($regionName)) {
			return '';
		}

		return $regionName[0];
	}

	public function regionListByType($type)
	{
		$reginList = \Illuminate\Support\Facades\Cache::get('region_list_' . $type);

		if (empty($reginList)) {
			$reginList = \App\Models\Region::where('region_type', $type)->get()->toArray();
			\Illuminate\Support\Facades\Cache::put('region_list_' . $type, $reginList, 60);
		}

		return $reginList;
	}

	public function getRegionTypeById($regionId)
	{
		$regionType = \App\Models\Region::where('region_id', $regionId)->pluck('region_type')->toArray();

		if (empty($regionType)) {
			return '';
		}

		return $regionType[0];
	}
}

?>
