
<input name="street_list" value="<?php echo empty($this->_var['area']['street_list']) ? '0' : $this->_var['area']['street_list']; ?>" type="hidden">
<script type="text/javascript">
$(function(){
	
	/* 检测配送地区 */
	seller_shipping_area(<?php echo empty($this->_var['area']['merchant_id']) ? '0' : $this->_var['area']['merchant_id']; ?>);
	
	//配送区域
	goods_delivery_area();
});

/* 获取配送区域 start*/
function goods_delivery_area(){
	var area = new Object();
	
	area.province_id = <?php echo empty($this->_var['area']['province_id']) ? '0' : $this->_var['area']['province_id']; ?>;
	area.city_id = <?php echo empty($this->_var['area']['city_id']) ? '0' : $this->_var['area']['city_id']; ?>;
	area.district_id = <?php echo empty($this->_var['area']['district_id']) ? '0' : $this->_var['area']['district_id']; ?>;
	area.street_id = <?php echo empty($this->_var['area']['street_id']) ? '0' : $this->_var['area']['street_id']; ?>;
	area.street_list = $(":input[name='street_list']").val();
	area.goods_id = <?php echo empty($this->_var['area']['goods_id']) ? '0' : $this->_var['area']['goods_id']; ?>;
	area.user_id = <?php echo empty($this->_var['area']['user_id']) ? '0' : $this->_var['area']['user_id']; ?>;
	area.region_id = <?php echo empty($this->_var['area']['region_id']) ? '0' : $this->_var['area']['region_id']; ?>;
	area.area_id = <?php echo empty($this->_var['area']['area_id']) ? '0' : $this->_var['area']['area_id']; ?>;
	area.merchant_id = <?php echo empty($this->_var['area']['merchant_id']) ? '0' : $this->_var['area']['merchant_id']; ?>;

	Ajax.call('ajax_dialog.php?act=goods_delivery_area', 'area=' + $.toJSON(area), goods_delivery_areaResponse, 'POST', 'JSON'); 
	
}

function goods_delivery_areaResponse(result){
	$("#area_address").html(result.content);
	$(".store-warehouse-info").html(result.warehouse_content);
	
	if(result.is_theme == 1){
		get_user_area_shipping(result.goods_id, result.area.region_id, result.area.province_id, result.area.city_id, result.area.district_id, result.area.street_id, result.area.street_list);
	}
}
/* 获取配送区域 end*/

/* 查询用户所在地区是否支持配送 */
function get_user_area_shipping(goods_id, region_id, province_id, city_id, district_id, street_id, street_list){
	
	var area = new Object();
	
	area.goods_id = goods_id;
	area.province_id = province_id;
	area.city_id = city_id;
	area.district_id = district_id;
	area.street_id = street_id;
	area.street_list = street_list;
	
	Ajax.call('ajax_dialog.php?act=user_area_shipping', 'area=' + $.toJSON(area), user_area_shippingResponse, 'POST', 'JSON'); 
}

function user_area_shippingResponse(result){
	$("#user_area_shipping").html(result.content);
	
	changePrice('onload');
}

/* 检测配送地区 */
function seller_shipping_area(merchant_id){
	Ajax.call('ajax_dialog.php?act=seller_shipping_area','merchant_id=' + merchant_id, ajaxShippingAreaResponse, 'GET', 'JSON');
}

function ajaxShippingAreaResponse(result){
}
</script>