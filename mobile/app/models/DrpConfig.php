<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Models;

class DrpConfig extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'drp_config';
	public $timestamps = false;
	protected $fillable = array('code', 'type', 'store_range', 'value', 'name', 'warning', 'sort_order');
	protected $guarded = array();
}

?>
