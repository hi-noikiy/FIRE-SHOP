<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<?php echo $this->fetch('library/js_languages_new.lbi'); ?>
<link rel="stylesheet" type="text/css" href="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/css/goods_fitting.css" />
<link rel="stylesheet" type="text/css" href="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/css/suggest.css" />
<link rel="stylesheet" type="text/css" href="js/calendar/calendar.min.css" />
<link rel="stylesheet" type="text/css" href="js/perfect-scrollbar/perfect-scrollbar.min.css" />
</head>

<body>
    <?php echo $this->fetch('library/page_header_common.lbi'); ?>
    <div class="full-main-n">
        <div class="w w1200 relative">
        <?php echo $this->fetch('library/ur_here.lbi'); ?>
        </div>
    </div>
    <div class="container">
    	<div class="w w1200">
            <div class="product-info">
                <?php echo $this->fetch('library/goods_gallery.lbi'); ?>
                <div class="product-wrap<?php if ($this->_var['goods']['user_id']): ?> product-wrap-min<?php endif; ?>">
                    <form action="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY" >
                	<div class="name"><?php echo $this->_var['goods']['goods_style_name']; ?></div>
                        <?php if ($this->_var['goods']['goods_brief']): ?>
                        <div class="newp"><?php echo $this->_var['goods']['goods_brief']; ?></div>
                        <?php endif; ?>
                        <?php if ($this->_var['goods']['gmt_end_time']): ?>
                        <div class="activity-title" <?php if ($this->_var['promo_count'] > 1): ?> style="display:none;"<?php endif; ?>>
                            <div class="activity-type"><i class="icon icon-promotion"></i>促销时间</div>
                            <div class="sk-time-cd">
                                <div class="sk-cd-tit">距结束</div>
                                <div class="cd-time" ectype="time" data-time="<?php echo $this->_var['goods']['promote_end_time']; ?>">
                                    <div class="days">00</div>
                                    <span class="split">:</span>
                                    <div class="hours">00</div>
                                    <span class="split">:</span>
                                    <div class="minutes">00</div>
                                    <span class="split">:</span>
                                    <div class="seconds">00</div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="summary">
                    	<div class="summary-price-wrap">
                            <div class="s-p-w-wrap">
                                <div class="summary-item si-shop-price">
                                    <div class="si-tit"><?php if ($this->_var['goods']['gmt_end_time']): ?>促 销 价<?php else: ?>商 城 价<?php endif; ?></div>
                                    <div class="si-warp">
                                        <strong class="shop-price" id="ECS_SHOPPRICE" ectype="SHOP_PRICE"></strong>
                                        <span class="price-notify" data-userid="<?php echo $this->_var['user_id']; ?>" data-goodsid="<?php echo $this->_var['goods']['goods_id']; ?>" ectype="priceNotify"><?php echo $this->_var['lang']['price_notice']; ?></span>
                                    </div>
                                </div>
                                <?php if ($this->_var['cfg']['show_marketprice']): ?>
                                <div class="summary-item si-market-price">
                                    <div class="si-tit">市 场 价</div>
                                    <div class="si-warp"><div class="m-price" id="ECS_MARKETPRICE"><?php echo $this->_var['goods']['market_price']; ?></div></div>
                                </div>
                                <?php endif; ?>
                                <div class="si-info">
                                    <div class="si-cumulative"><?php echo $this->_var['lang']['Cumulative_evaluation']; ?><em><?php echo $this->_var['comment_all']['allmen']; ?></em></div>
                                    <div class="si-cumulative"><?php echo $this->_var['lang']['Cumulative_Sales']; ?><em><?php echo $this->_var['goods']['sales_volume']; ?></em></div>
                                </div>
                                <?php if ($this->_var['two_code']): ?>
                                <div class="si-phone-code">
                                    <div class="qrcode-wrap">
                                        <div class="qrcode_tit"><?php echo $this->_var['lang']['summary_phone']; ?><i class="iconfont icon-qr-code"></i></div>
                                        <div class="qrcode_pop">
                                            <div class="mobile-qrcode"><img src="<?php echo $this->_var['weixin_img_url']; ?>" alt="<?php echo $this->_var['lang']['two_code']; ?>" title="<?php echo $this->_var['weixin_img_text']; ?>" width="175"></div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ($this->_var['goods_coupons']): ?>
                                <div class="summary-item si-coupon">
                                    <div class="si-tit">领 券</div>
                                    <div class="si-warp">
                                        <?php $_from = $this->_var['goods_coupons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vo');if (count($_from)):
    foreach ($_from AS $this->_var['vo']):
?>
                                        <a class="J-open-tb" href="#none" data-goodsid="<?php echo $this->_var['goods_id']; ?>">
                                            <div class="quan-item"><i class="i-left"></i>满<?php echo $this->_var['vo']['cou_man']; ?>减<?php echo $this->_var['vo']['cou_money']; ?><i class="i-right"></i></div>
                                        </a>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ($this->_var['promotion'] || $this->_var['goods']['consumption']): ?>
                                <div class="summary-item si-promotion"<?php if ($this->_var['promo_count'] > 2): ?> ectype="view-prom"<?php endif; ?><?php if ($this->_var['promo_count'] < 2): ?> style="height:24px;"<?php endif; ?>>
                                    <div class="si-tit">促 销</div>
                                    <div class="si-warp">
                                        <div class="prom-items">									
                                            <?php $_from = $this->_var['promotion']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');$this->_foreach['nopromotion'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nopromotion']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
        $this->_foreach['nopromotion']['iteration']++;
?>
                                            <?php if ($this->_var['item']['type'] == "favourable"): ?>
                                            <div class="prom-item">
                                                <?php if ($this->_var['item']['act_type'] == 0): ?>
                                                <em class="prom-tip"><?php echo $this->_var['lang']['With_a_gift']; ?></em>
                                                <?php elseif ($this->_var['item']['act_type'] == 1): ?>
                                                <em class="prom-tip"><?php echo $this->_var['lang']['Stand_minus']; ?></em>
                                                <?php elseif ($this->_var['item']['act_type'] == 2): ?>
                                                <em class="prom-tip"><?php echo $this->_var['lang']['discount']; ?></em>
                                                <?php endif; ?>
                                                <?php echo $this->_var['item']['act_name']; ?>
                                            </div>
                                            <?php elseif ($this->_var['item']['type'] == "group_buy"): ?>
                                            <div class="prom-item">
                                                <a href="group_buy.php" title="<?php echo $this->_var['lang']['group_buy']; ?>" class="prom-tip" title="<?php echo $this->_var['lang']['group_buy']; ?>"><?php echo $this->_var['lang']['group_buy']; ?></a>
                                            </div>
                                            <?php elseif ($this->_var['item']['type'] == "auction"): ?>
                                            <div class="prom-item">
                                                <a href="auction.php" title="<?php echo $this->_var['lang']['auction']; ?>" class="prom-tip" title="<?php echo $this->_var['lang']['auction']; ?>"><?php echo $this->_var['lang']['auction']; ?></a>
                                            </div>
                                            <?php elseif ($this->_var['item']['type'] == "snatch"): ?>
                                            <div class="prom-item">
                                                <a href="snatch.php" title="<?php echo $this->_var['lang']['snatch']; ?>" class="prom-tip" title="<?php echo $this->_var['lang']['snatch']; ?>"><?php echo $this->_var['lang']['snatch']; ?></a>
                                            </div>
                                            <?php endif; ?>											
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            <?php if ($this->_var['goods']['consumption']): ?>
                                            <div class="prom-item">
                                                <a href="javascript:;" class="prom-tip" title="<?php echo $this->_var['lang']['Full_reduction']; ?>"><?php echo $this->_var['lang']['Full_reduction']; ?></a>
                                                <em class="h1_red">
                                                <?php $_from = $this->_var['goods']['consumption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'con');$this->_foreach['nocon'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nocon']['total'] > 0):
    foreach ($_from AS $this->_var['con']):
        $this->_foreach['nocon']['iteration']++;
?>
                                                    <?php echo $this->_var['lang']['man']; ?><?php echo $this->_var['con']['cfull']; ?><?php echo $this->_var['lang']['minus']; ?><?php echo $this->_var['con']['creduce']; ?>
                                                    <?php if (! ($this->_foreach['nocon']['iteration'] == $this->_foreach['nocon']['total'])): ?>，<?php endif; ?>
                                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                </em>
                                            </div>
                                            <?php endif; ?>	
                                        </div>
                                        <?php if ($this->_var['promo_count'] > 2): ?>
                                        <div class="view-all-promotions">
                                            <span class="prom-sum">共<em class="prom-number"><?php echo $this->_var['promo_count']; ?></em>项促销</span>
                                            <i class="iconfont icon-down"></i>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="summary-basic-info">
                            <?php if ($this->_var['volume_price_list']): ?>
                            <div class="summary-item is-ladder">
                                <div class="si-tit"><?php echo $this->_var['lang']['Preferential_steps']; ?></div>
                                <div class="si-warp">
                                    <a href="javascript:void(0);" class="link-red" ectype="view_priceLadder"><?php echo $this->_var['lang']['View_price_ladder']; ?></a>
                                    <dl class="priceLadder" ectype="priceLadder">
                                        <dt>
                                            <span><?php echo $this->_var['lang']['number_to']; ?></span>
                                            <span><?php echo $this->_var['lang']['preferences_price']; ?></span>
                                        </dt>
                                        <?php $_from = $this->_var['volume_price_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('price_key', 'price_list');if (count($_from)):
    foreach ($_from AS $this->_var['price_key'] => $this->_var['price_list']):
?>
                                        <dd>
                                            <span><?php echo $this->_var['price_list']['number']; ?></span>
                                            <span><?php echo $this->_var['price_list']['format_price']; ?></span>
                                        </dd>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </dl>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($this->_var['rank_prices'] && $this->_var['cfg']['show_rank_price'] && ! $this->_var['goods']['gmt_end_time']): ?>
                            <div class="summary-item is-ladder">
                                <div class="si-tit"><?php echo $this->_var['lang']['rank_prices']; ?></div>
                                <div class="si-warp">
                                    <a href="javascript:void(0);" class="link-red" ectype="view_priceLadder"><?php echo $this->_var['lang']['View_price_ladder']; ?></a>
                                    <dl class="priceLadder" ectype="priceLadder">
                                    	<dt>
                                            <span><?php echo $this->_var['lang']['rank']; ?></span>
                                            <span><?php echo $this->_var['lang']['prices']; ?></span>
                                        </dt>
                                        <?php $_from = $this->_var['rank_prices']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('price_key', 'rank');if (count($_from)):
    foreach ($_from AS $this->_var['price_key'] => $this->_var['rank']):
?>
                                        <dd>
                                            <span><?php echo $this->_var['rank']['rank_name']; ?></span>
                                            <span><?php echo $this->_var['rank']['price']; ?></span>
                                        </dd>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </dl>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="summary-item is-stock">
                                <div class="si-tit">配送</div>
                                <div class="si-warp">
                                    <span class="initial-area">
                                        <?php if ($this->_var['adress']['city']): ?>
                                            <?php echo $this->_var['adress']['city']; ?>
                                        <?php else: ?>
                                            <?php echo $this->_var['basic_info']['city']; ?>
                                        <?php endif; ?>  
                                    </span>
                                    <span>至</span>
                                    <div class="store-selector">
                                        <div class="text-select" id="area_address" ectype="areaSelect"></div>
                                    </div>
                                    <div class="store-warehouse">
                                        <div class="store-warehouse-info"></div>
                                        <div id="isHas_warehouse_num" class="store-prompt"></div>
                                    </div>
                                </div>  
                            </div>
                            <div class="summary-item is-service">
                            	<div class="si-tit">服务</div>
                                <div class="si-warp">
                                	<div class="fl"> 
                                    <?php if ($this->_var['goods']['user_id'] > 0): ?>
                                    	由 <a href="<?php echo $this->_var['goods']['store_url']; ?>" class="link-red" target="_blank"><?php echo $this->_var['goods']['rz_shopName']; ?></a> 发货并提供售后服务
                                    <?php else: ?>
                                    	由 <a href="javascript:void(0)" class="link-red"><?php echo $this->_var['goods']['rz_shopName']; ?></a> 发货并提供售后服务
                                    <?php endif; ?>
                                    </div>
                                    <div class="fl pl10" id="user_area_shipping">
                                    </div>
                                </div>
                            </div>
                            <?php if ($this->_var['cfg']['show_brand'] && $this->_var['goods']['user_id'] && $this->_var['goods']['goods_brand']): ?>
                            <div class="summary-item is-brand">
                            	<div class="si-tit">品牌</div>
                                <div class="si-warp"><a href="<?php echo $this->_var['goods']['goods_brand_url']; ?>" target="_blank"><?php echo $this->_var['goods']['goods_brand']; ?></a></div>
                            </div>
                            <?php endif; ?>
                            <?php if ($this->_var['cfg']['use_integral']): ?>
                            <div class="summary-item is-integral">
                            	<div class="si-tit">可用积分</div>
                                <div class="si-warp">可用 <span class="integral"><?php echo $this->_var['goods']['integral']; ?></span></div>
                            </div>
                            <?php endif; ?>
                            <?php if ($this->_var['goods']['give_integral'] && $this->_var['cfg']['show_give_integral']): ?>
                            <div class="summary-item is-integral">
                            	<div class="si-tit">赠送积分</div>
                                <div class="si-warp"><span class="integral"><?php echo $this->_var['goods']['give_integral']; ?></span></div>
                            </div>
                            <?php endif; ?>
                            <?php if ($this->_var['goods']['goods_extends']['is_reality'] || $this->_var['goods']['goods_extends']['is_return'] || $this->_var['goods']['goods_extends']['is_fast']): ?>
                            <div class="summary-item">
                                <div class="si-tit">承诺</div>
                                <div class="si-warp">
                                    <ul class="tips-list">
                                        <?php if ($this->_var['goods']['goods_extends']['is_reality']): ?><li class="choose-item choose-zp"><i class="iconfont icon-zheng"></i><?php echo $this->_var['lang']['is_reality']; ?></li><?php endif; ?>
                                        <?php if ($this->_var['goods']['goods_extends']['is_return']): ?><li class="choose-item choose-bt"><i class="iconfont icon-money"></i><?php echo $this->_var['lang']['is_return']; ?></li><?php endif; ?>
                                        <?php if ($this->_var['goods']['goods_extends']['is_fast']): ?><li class="choose-item choose-ss"><i class="iconfont icon-light"></i><?php echo $this->_var['lang']['is_fast']; ?></li><?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if ($this->_var['goods']['is_xiangou'] == 1 && $this->_var['xiangou'] == 1): ?>
                            <div class="summary-item is-integral">
                            	<div class="si-tit">限购</div>
                                <div class="si-warp">
                                    <?php echo $this->_var['goods']['xiangou_num']; ?>&nbsp;<?php if ($this->_var['goods']['goods_unit']): ?><?php echo $this->_var['goods']['goods_unit']; ?><?php elseif ($this->_var['goods']['measure_unit']): ?><?php echo $this->_var['goods']['measure_unit']; ?><?php endif; ?>
                                    (<?php echo $this->_var['lang']['Already_buy']; ?>：<i id="orderG_number"><?php echo empty($this->_var['orderG_number']) ? '0' : $this->_var['orderG_number']; ?></i>&nbsp;<?php if ($this->_var['goods']['goods_unit']): ?><?php echo $this->_var['goods']['goods_unit']; ?><?php elseif ($this->_var['goods']['measure_unit']): ?><?php echo $this->_var['goods']['measure_unit']; ?><?php endif; ?>)
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if ($this->_var['area_position_list'] && $this->_var['goods']['store_count'] > 0): ?>
                            <div class="summary-item is-since">
                            	<div class="si-tit">自提</div>
                                <div class="si-warp">
                                    <a href="javascript:void(0);" ectype="seller_store" class="link-red"><i class="iconfont icon-store-alt"></i>选择门店</a>
                                    <span class="ml10">请选择有货的门店，上门自提</span>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php $_from = $this->_var['specification']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('spec_key', 'spec');if (count($_from)):
    foreach ($_from AS $this->_var['spec_key'] => $this->_var['spec']):
?>
                            <?php if ($this->_var['spec']['values']): ?>
                            <div class="summary-item is-attr goods_info_attr" ectype="is-attr" data-type="<?php if ($this->_var['spec']['attr_type'] == 1): ?>radio<?php else: ?>checkbox<?php endif; ?>">
                            	<div class="si-tit"><?php echo $this->_var['spec']['name']; ?></div>
                                <?php if ($this->_var['cfg']['goodsattr_style'] == 1): ?>
                                <div class="si-warp">
                                    <ul>
                                        <?php $_from = $this->_var['spec']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'value');$this->_foreach['attrvalues'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['attrvalues']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
        $this->_foreach['attrvalues']['iteration']++;
?>  
                                        <?php if ($this->_var['spec']['is_checked'] > 0): ?>
                                        <li class="item<?php if ($this->_var['value']['checked'] == 1 && $this->_var['cfg']['add_shop_price'] == 1): ?> selected<?php endif; ?>" data-name="<?php echo $this->_var['value']['id']; ?>">
                                            <b></b>
                                            <a href="<?php if ($this->_var['value']['img_site']): ?><?php echo $this->_var['value']['img_site']; ?><?php else: ?>javascript:void(0);<?php endif; ?>">
                                                <?php if ($this->_var['value']['img_flie']): ?>
                                                <img src="<?php echo $this->_var['value']['img_flie']; ?>" width="24" height="24" />
                                                <?php endif; ?>
                                                <i><?php echo $this->_var['value']['label']; ?></i>
                                                <input id="spec_value_<?php echo $this->_var['value']['id']; ?>" type="<?php if ($this->_var['spec']['attr_type'] == 2): ?>checkbox<?php else: ?>radio<?php endif; ?>" data-attrtype="<?php if ($this->_var['spec']['attr_type'] == 2): ?>2<?php else: ?>1<?php endif; ?>" name="spec_<?php echo $this->_var['spec_key']; ?>" value="<?php echo $this->_var['value']['id']; ?>" class="hide" />
                                                <?php if ($this->_var['value']['checked'] == 1): ?>
                                                <script type="text/javascript">
                                                    $(function(){
                                                        <?php if ($this->_var['cfg']['add_shop_price'] == 1): ?>
                                                        $("#spec_value_<?php echo $this->_var['value']['id']; ?>").prop("checked", true);
                                                        <?php else: ?>
                                                        $("#spec_value_<?php echo $this->_var['value']['id']; ?>").prop("checked", false);
                                                        <?php endif; ?>
                                                    });
                                                </script>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                        <?php else: ?>
                                        <li class="item <?php if ($this->_var['key'] == 0 && $this->_var['cfg']['add_shop_price'] == 1): ?> selected<?php endif; ?>" data-name="<?php echo $this->_var['value']['id']; ?>">
                                            <b></b>
                                            <a href="javascript:void(0);" name="<?php echo $this->_var['value']['id']; ?>" class="noimg">
                                                <i><?php echo $this->_var['value']['label']; ?></i>
                                                <input id="spec_value_<?php echo $this->_var['value']['id']; ?>" type="<?php if ($this->_var['spec']['attr_type'] == 2): ?>checkbox<?php else: ?>radio<?php endif; ?>" data-attrtype="<?php if ($this->_var['spec']['attr_type'] == 2): ?>2<?php else: ?>1<?php endif; ?>" name="spec_<?php echo $this->_var['spec_key']; ?>" value="<?php echo $this->_var['value']['id']; ?>" class="hide" /></a> 
                                                <?php if ($this->_var['key'] == 0): ?>
                                                <script type="text/javascript">
                                                    $(function(){
                                                        <?php if ($this->_var['cfg']['add_shop_price'] == 1): ?>
                                                        $("#spec_value_<?php echo $this->_var['value']['id']; ?>").prop("checked", true);
                                                        <?php else: ?>
                                                        $("#spec_value_<?php echo $this->_var['value']['id']; ?>").prop("checked", false);
                                                        <?php endif; ?>
                                                    });
                                                </script>
                                                <?php endif; ?>											
                                            </a>
                                        </li>									
                                        <?php endif; ?>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </ul>
                                </div>
                                <?php else: ?>
                                ...
                                <?php endif; ?>
                                <input type="hidden" name="spec_list" value="<?php echo $this->_var['spec_key']; ?>" data-spectype="<?php if ($this->_var['spec']['attr_type'] == 1): ?>attr-radio<?php else: ?>attr-check<?php endif; ?>" />
                            </div>
                            <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

                            <?php if ($this->_var['stages']): ?>
                            <div class="summary-item is-ious" ectype="is-ious">
                            	<div class="si-tit">白条</div>
                                <div class="si-warp">
                                    <?php $_from = $this->_var['stages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'vo');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['vo']):
?>
                                    <?php if ($this->_var['k'] == 1): ?>
                                    <div class="item" data-value="<?php echo $this->_var['k']; ?>">
                                    	<b></b>
                                    	<a href="javascript:void(0);"><i><?php echo $this->_var['lang']['noFree_30']; ?></i></a>
                                    	<div class="baitiao-tips">
                                            <span><?php echo $this->_var['lang']['nofree']; ?></span>
                                        </div>
                                    </div>									
                                    <?php else: ?>
                                    <div class="item" data-value="<?php echo $this->_var['k']; ?>">
                                    	<b></b>
                                    	<a href="javascript:void(0);"><i>￥<?php echo $this->_var['vo']['stages_one_price']; ?>×<?php echo $this->_var['k']; ?><?php echo $this->_var['lang']['qi']; ?></i></a>
                                    	<div class="baitiao-tips">
                                            <span><?php echo $this->_var['lang']['free_desc']; ?><?php echo $this->_var['goods']['stages_rate']; ?>%，￥<?php echo $this->_var['vo']['stages_one_price']; ?>×<?php echo $this->_var['k']; ?><?php echo $this->_var['lang']['qi']; ?></span>
                                        </div>
                                    </div>									
                                    <?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    <div class="bt-info-tips">
                                    	<a href="javascript:void(0);"><i class="question"></i></a>
                                        <div class="tips">
                                            <div class="sprite-arrow"></div>
                                            <div class="content">
                                            	<p>1､实际分期金额及手续费以白条剩余额度及收银台优惠为准</p>
                                                <p>2､什么是白条分期？<br>白条分期是商创推出的一种“先消费，后付款”的全新支付方式。使用白条进行付款，可以享受最长30天的延后付款期或最长24期的分期付款方式。</p>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="stages_qishu" value=""/>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="summary-item is-number">
                            	<div class="si-tit">数量</div>
                                <div class="si-warp">
                                    <div class="amount-warp">
                                        <input class="text buy-num" ectype="quantity" onblur="changePrice()" value="1" name="number" defaultnumber="1">
                                        <div class="a-btn">
                                            <a href="javascript:void(0);" class="btn-add"><i class="iconfont icon-up"></i></a>
                                            <a href="javascript:void(0);" class="btn-reduce btn-disabled"><i class="iconfont icon-down"></i></a>
                                            <input type="hidden" ectype="perNumber" value="1000">
                                            <input type="hidden" ectype="perMinNumber" value="1">
                                        </div>
                                        <input name="confirm_type" id="confirm_type" type="hidden" value="3" />
                                    </div>
                                    <?php if ($this->_var['cfg']['show_goodsnumber']): ?>
                                    <span><?php echo $this->_var['lang']['goods_inventory']; ?>&nbsp;<em id="goods_attr_num" ectype="goods_attr_num"></em>&nbsp;<?php if ($this->_var['goods']['goods_unit']): ?><?php echo $this->_var['goods']['goods_unit']; ?><?php else: ?><?php echo $this->_var['goods']['measure_unit']; ?><?php endif; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="choose-btns<?php if (! $this->_var['area_position_list'] || $this->_var['goods']['store_count'] <= 0 || ! $this->_var['stages'] || $this->_var['goods']['is_on_sale'] == 0): ?> ml60<?php endif; ?> clearfix">
                            <?php if ($this->_var['goods']['review_status'] <= 2 || $this->_var['goods']['is_on_sale'] == 0): ?>
                                <a id="sold_out" class="btn-invalid" href="javascript:void(0);">此商品已下架</a>
                            <?php else: ?>
                                <?php if ($this->_var['goods_area'] == 1): ?>
                                    <a href="<?php if ($this->_var['user_id'] <= 0 && $this->_var['one_step_buy']): ?>#none<?php else: ?>javascript:bool=0;addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)<?php endif; ?>" class="btn-buynow" ectype="btn-buynow">立即购买</a>
                                    <?php if (! $this->_var['one_step_buy']): ?>
                                        <a href="javascript:bool=0;addToCartShowDiv(<?php echo $this->_var['goods']['goods_id']; ?>)" class="btn-append" ectype="btn-append"><i class="iconfont icon-carts"></i><?php echo $this->_var['lang']['btn_add_to_cart']; ?></a>
                                    <?php endif; ?>
                                    
                                    <?php if ($this->_var['stages']): ?>
                                        <a href="javascript:void(0);" class="btn-baitiao" ectype="byStages"><?php echo $this->_var['lang']['Installment_purchase']; ?></a>
                                    <?php endif; ?>
                                    
                                <?php else: ?>
                                <a id="no_addToCart" class="btn-invalid btn_disabled" href="javascript:void(0);">暂时无货</a>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ($this->_var['area_position_list'] && $this->_var['goods']['store_count'] > 0): ?>
                            <a href="javascript:void(0);" class="btn-since" ectype="btn-store-pick"><?php echo $this->_var['lang']['btn_store_pick']; ?></a>
                            <?php endif; ?>
                        </div>
                            <?php if ($this->_var['goods']['goods_tag']): ?>
                            <div class="summary-basic-info">
                                <div class="summary-item is-service">
                                    <div class="si-tit">服务承诺</div>
                                    <div class="si-warp">
                                        <?php $_from = $this->_var['goods']['goods_tag']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'tag');if (count($_from)):
    foreach ($_from AS $this->_var['tag']):
?>
                                        <span class="tary"><?php echo $this->_var['tag']; ?></span>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                    </div>
                        <input type="hidden" value="<?php echo $this->_var['user_id']; ?>" id="user_id" name="user_id">
                        <input type="hidden" value="<?php echo $this->_var['goods_id']; ?>" id="good_id" name="good_id">
                        <input type="hidden" value="<?php echo $this->_var['region_id']; ?>" id="region_id" name="region_id">
                        <input type="hidden" value="<?php echo $this->_var['area_id']; ?>" id="area_id" name="area_id">
                    </form>
                </div>
                <?php if (! $this->_var['goods']['user_id']): ?>
                <div class="track">
                    <div class="track_warp">
                    	<div class="track-tit"><h3>看了又看</h3><span></span></div>
                        <div class="track-con">
                            <ul>
                                <?php $_from = $this->_var['see_more_goods']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_15625000_1503823066');$this->_foreach['goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_15625000_1503823066']):
        $this->_foreach['goods']['iteration']++;
?>
                                <li>
                                    <div class="p-img"><a href="<?php echo $this->_var['goods_0_15625000_1503823066']['url']; ?>" target="_blank" title="<?php echo $this->_var['goods_0_15625000_1503823066']['goods_name']; ?>"><img src="<?php echo $this->_var['goods_0_15625000_1503823066']['goods_thumb']; ?>" width="140" height="140"></a></div>
                                    <div class="p-name"><a href="<?php echo $this->_var['goods_0_15625000_1503823066']['url']; ?>" target="_blank" title="<?php echo $this->_var['goods_0_15625000_1503823066']['goods_name']; ?>"><?php echo $this->_var['goods_0_15625000_1503823066']['goods_name']; ?></a></div>
                                    <div class="price">
                                        <?php if ($this->_var['goods_0_15625000_1503823066']['promote_price'] != ''): ?>
                                            <?php echo $this->_var['goods_0_15625000_1503823066']['promote_price']; ?>
                                        <?php else: ?>
                                            <?php echo $this->_var['goods_0_15625000_1503823066']['shop_price']; ?>
                                        <?php endif; ?>										
                                    </div>
                                </li>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </ul>
                        </div>
                        <div class="track-more">
                            <a href="javascript:void(0);" class="sprite-up"><i class="iconfont icon-up"></i></a>
                            <a href="javascript:void(0);" class="sprite-down"><i class="iconfont icon-down"></i></a>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="seller-pop">
                    <div class="seller-logo">
                    	<?php if ($this->_var['goods']['shopinfo']['brand_thumb']): ?>
                            <a href="<?php echo $this->_var['goods']['store_url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['shopinfo']['brand_thumb']; ?>" /></a>
                        <?php else: ?>
                            <a href="<?php echo $this->_var['goods']['goods_brand_url']; ?>" target="_blank"><?php echo $this->_var['goods']['goods_brand']; ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="seller-info">
                    	<a href="<?php echo $this->_var['goods']['store_url']; ?>" title="<?php echo $this->_var['goods']['rz_shopName']; ?>" target="_blank" class="name"><?php echo $this->_var['goods']['rz_shopName']; ?></a>
                        <?php if ($this->_var['shop_information']['is_IM'] == 1 || $this->_var['shop_information']['is_dsc']): ?>
                            <a id="IM" href="javascript:;" onclick="openWin(this)" goods_id="<?php echo $this->_var['goods']['goods_id']; ?>"><i class="icon i-kefu"></i></a>
                        <?php else: ?>
                            <?php if ($this->_var['basic_info']['kf_type'] == 1): ?>
                                <a href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo $this->_var['basic_info']['kf_ww']; ?>&siteid=cntaobao&status=1&charset=utf-8" target="_blank"><i class="icon i-kefu"></i></a>
                            <?php else: ?>
                                <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->_var['basic_info']['kf_qq']; ?>&site=qq&menu=yes" target="_blank"><i class="icon i-kefu"></i></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php if ($this->_var['goods']['shopinfo']['self_run']): ?>
                    <div class="seller-sr" ><?php echo $this->_var['lang']['platform_self']; ?></div>
                    <?php endif; ?>
                    <div class="seller-pop-box">
                    	<div class="s-score">
                            <span class="score-icon"><span class="score-icon-bg" style="width:<?php echo $this->_var['merch_cmt']['cmt']['all_zconments']['allReview']; ?>%;"></span></span>
                            <span><?php echo $this->_var['merch_cmt']['cmt']['all_zconments']['score']; ?></span>
                            <i class="iconfont icon-down"></i>
                        </div>
                        <div class="g-s-parts">
                            <div class="parts-item parts-goods">
                                <span class="col1">商品评价</span>
                                <span class="col2 <?php if ($this->_var['merch_cmt']['cmt']['commentRank']['zconments']['is_status'] == 1): ?>ftx-02<?php elseif ($this->_var['merch_cmt']['cmt']['commentRank']['zconments']['is_status'] == 2): ?>average<?php else: ?>ftx-01<?php endif; ?>"><?php echo $this->_var['merch_cmt']['cmt']['commentRank']['zconments']['score']; ?><i class="iconfont icon-arrow-<?php if ($this->_var['merch_cmt']['cmt']['commentRank']['zconments']['is_status'] == 1): ?>up<?php elseif ($this->_var['merch_cmt']['cmt']['commentRank']['zconments']['is_status'] == 2): ?>average<?php else: ?>down<?php endif; ?>"></i></span>
                            </div>
                            <div class="parts-item parts-goods">
                                <span class="col1">服务态度</span>
                                <span class="col2 <?php if ($this->_var['merch_cmt']['cmt']['commentServer']['zconments']['is_status'] == 1): ?>ftx-02<?php elseif ($this->_var['merch_cmt']['cmt']['commentServer']['zconments']['is_status'] == 2): ?>average<?php else: ?>ftx-01<?php endif; ?>"><?php echo $this->_var['merch_cmt']['cmt']['commentServer']['zconments']['score']; ?><i class="iconfont icon-arrow-<?php if ($this->_var['merch_cmt']['cmt']['commentServer']['zconments']['is_status'] == 1): ?>up<?php elseif ($this->_var['merch_cmt']['cmt']['commentServer']['zconments']['is_status'] == 2): ?>average<?php else: ?>down<?php endif; ?>"></i></span>
                            </div>
                            <div class="parts-item parts-goods">
                                <span class="col1">发货速度</span>
                                <span class="col2 <?php if ($this->_var['merch_cmt']['cmt']['commentDelivery']['zconments']['is_status'] == 1): ?>ftx-02<?php elseif ($this->_var['merch_cmt']['cmt']['commentDelivery']['zconments']['is_status'] == 2): ?>average<?php else: ?>ftx-01<?php endif; ?>"><?php echo $this->_var['merch_cmt']['cmt']['commentDelivery']['zconments']['score']; ?><i class="iconfont icon-arrow-<?php if ($this->_var['merch_cmt']['cmt']['commentDelivery']['zconments']['is_status'] == 1): ?>up<?php elseif ($this->_var['merch_cmt']['cmt']['commentDelivery']['zconments']['is_status'] == 2): ?>average<?php else: ?>down<?php endif; ?>"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="seller-item">
                    	<a href="javascript:void(0);" ectype="collect_store" data-type='goods' data-value='{"userid":<?php echo $this->_var['user_id']; ?>,"storeid":<?php echo $this->_var['goods']['user_id']; ?>}' class="gz-store<?php if ($this->_var['goods']['error'] == 1): ?> selected<?php endif; ?>" data-url="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>"><i class="iconfont<?php if ($this->_var['goods']['error'] == 1): ?> icon-zan-alts<?php else: ?> icon-zan-alt<?php endif; ?>"></i>关注<?php echo $this->_var['goods']['error']; ?></a>
                        <a href="<?php echo $this->_var['goods']['store_url']; ?>" class="store-home"><i class="iconfont icon-home-store"></i>店铺</a>
                        <input type="hidden" name="error" value="<?php echo $this->_var['goods']['error']; ?>" id="error"/>
                    </div>
                    <div class="seller-tel"><i class="iconfont icon-tel"></i><?php echo $this->_var['shop_information']['kf_tel']; ?></div>
                </div>
                <?php endif; ?>
                <div class="clear"></div>
            </div>
            <?php echo $this->fetch('library/goods_fittings.lbi'); ?>	
            <div class="goods-main-layout">
            	<div class="g-m-left">
                    <?php echo $this->fetch('library/goods_merchants.lbi'); ?>
                    <?php if ($this->_var['basic_info']['kf_type'] == 1): ?>
                        <?php if ($this->_var['basic_info']['kf_ww_all']): ?>
                        <div class="g-main service_list">
                            <div class="mt"><h3><?php echo $this->_var['lang']['store_Customer_service']; ?></h3></div>
                            <div class="mc">
                                <ul>
                                    <?php $_from = $this->_var['basic_info']['kf_ww_all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'kf_ww');if (count($_from)):
    foreach ($_from AS $this->_var['kf_ww']):
?>
                                    <li><a href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo $this->_var['kf_ww']['1']; ?>&siteid=cntaobao&status=1&charset=utf-8" target="_blank"><i class="icon_service_ww"></i><span><?php echo $this->_var['kf_ww']['0']; ?></span></a></li>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if ($this->_var['basic_info']['kf_qq_all']): ?>
                        <div class="g-main service_list">
                            <div class="mt"><h3><?php echo $this->_var['lang']['store_Customer_service']; ?></h3></div>
                            <div class="mc">
                                <ul>
                                    <?php $_from = $this->_var['basic_info']['kf_qq_all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'kf_qq');if (count($_from)):
    foreach ($_from AS $this->_var['kf_qq']):
?>
                                        <li class="service_qq"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->_var['kf_qq']['1']; ?>&site=qq&menu=yes" target="_blank"><i class="icon i-kefu"></i><span><?php echo $this->_var['kf_qq']['0']; ?></span></a></li>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php if ($this->_var['goods_store_cat']): ?>
                    <div class="g-main g-store-cate">
                    	<div class="mt">
                            <h3>店内分类</h3>
                        </div>
                        <div class="mc">
                            <div class="g-s-cate-warp">
                                <?php $_from = $this->_var['goods_store_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['cat']):
?>
                            	<dl ectype="cateOpen">
                                    <dt><i class="icon"></i><a href="<?php echo $this->_var['cat']['url']; ?>" target="_blank"><?php echo $this->_var['cat']['name']; ?></a></dt>
                                    <dd>
                                        <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'cat');$this->_foreach['nocat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nocat']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['cat']):
        $this->_foreach['nocat']['iteration']++;
?>
                                    	<a href="<?php echo $this->_var['cat']['url']; ?>" class="a-item" target="_blank">&gt; <?php echo $this->_var['cat']['name']; ?></a>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </dd>
                                </dl>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if ($this->_var['goods_related_cat']): ?>
                    <div class="g-main">
                    	<div class="mt">
                            <h3>相关分类</h3>
                        </div>
                        <div class="mc">
                            <div class="mc-warp">
                            	<div class="items">
                                    <?php $_from = $this->_var['goods_related_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['cat']['iteration']++;
?>
                                    <?php if ($this->_foreach['cat']['iteration'] < 11): ?>
                                    <div class="item"><a href="<?php echo $this->_var['cat']['url']; ?>" target="_blank"><?php echo $this->_var['cat']['cat_name']; ?></a></div>
                                    <?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if ($this->_var['goods_brand']): ?>
                    <div class="g-main">
                    	<div class="mt">
                            <h3>同类其他品牌</h3>
                        </div>
                        <div class="mc">
                            <div class="mc-warp">
                            	<div class="items">
                                    <?php $_from = $this->_var['goods_brand']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');if (count($_from)):
    foreach ($_from AS $this->_var['brand']):
?>
                                    <div class="item"><a href="<?php echo $this->_var['brand']['url']; ?>" target="_blank"><?php echo $this->_var['brand']['brand_name']; ?></a></div>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <?php echo $this->fetch('library/goods_article.lbi'); ?>
                    					
                    <div class="g-main g-rank">
                        <div class="mc">
                            <ul class="mc-tab">
                            	<li class="curr">新品</li>
                                <li>推荐</li>
                                <li>热销</li>
                            </ul>
                        	<div class="mc-content">
                                    
                                    <?php echo $this->fetch('library/recommend_new_goods.lbi'); ?>
                                    
                                    
                                    <?php echo $this->fetch('library/recommend_best_goods.lbi'); ?>
                                    
                                    
                                    <?php echo $this->fetch('library/recommend_hot_goods.lbi'); ?>
                                    
                                </div>
                            </div>
                        </div>
                        <?php 
$k = array (
  'name' => 'history_goods',
  'goods_id' => '0',
  'warehouse_id' => $this->_var['region_id'],
  'area_id' => $this->_var['area_id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
                        
                        <?php echo $this->fetch('library/goods_related.lbi'); ?>
                        
                    </div>
                <div class="g-m-detail">
                	<div class="gm-tabbox" ectype="gm-tabs">
                    	<ul class="gm-tab">
                            <li class="curr" ectype="gm-tab-item">商品详情</li>
                            <?php if ($this->_var['properties']): ?><li ectype="gm-tab-item">规格参数</li><?php endif; ?>
                            <li ectype="gm-tab-item">用户评论（<em class="ReviewsCount"><?php echo $this->_var['comment_all']['allmen']; ?></em>）</li>
                            <li ectype="gm-tab-item">网友讨论圈</li>
                        </ul>
                        <div class="extra">
                        	<div class="item">
								<?php if ($this->_var['two_code']): ?>
                                <div class="si-phone-code">
                                    <div class="qrcode-wrap">
                                        <div class="qrcode_tit"><?php echo $this->_var['lang']['summary_phone']; ?><i class="iconfont icon-qr-code"></i></div>
                                        <div class="qrcode_pop">
                                            <div class="mobile-qrcode"><img src="<?php echo $this->_var['weixin_img_url']; ?>" alt="<?php echo $this->_var['lang']['two_code']; ?>" title="<?php echo $this->_var['weixin_img_text']; ?>" width="175"></div>
                                        </div>
                                    </div>
                                </div>
								<?php endif; ?>
                            	<div class="inner">
                                	<a href="javascript:void(0)" class="btn sc-redBg-btn" id="btn-anchor" ectype="tb-tab-anchor"><?php echo $this->_var['lang']['btn_add_to_cart']; ?></a>
                                	<div class="tb-popsku">
                                    	<span class="arrow-top"></span>
                                        <div class="tb-popsku-content">
                                        	<div class="tb-list">
                                            	<div class="tb-label">价格：</div>
                                                <div class="tb-value"><strong class="shop-price" ectype="SHOP_PRICE"></strong></div>
                                            </div>
                                            <?php $_from = $this->_var['specification']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('spec_key', 'spec');if (count($_from)):
    foreach ($_from AS $this->_var['spec_key'] => $this->_var['spec']):
?>
                                            <?php if ($this->_var['spec']['values']): ?>
                                            <div class="tb-list is-attr goods_info_attr" ectype="is-attr" data-type="<?php if ($this->_var['spec']['attr_type'] == 1): ?>radio<?php else: ?>checkbox<?php endif; ?>">
                                                <div class="tb-label"><?php echo $this->_var['spec']['name']; ?>:</div>
                                                <?php if ($this->_var['cfg']['goodsattr_style'] == 1): ?>
                                                <div class="tb-value">
                                                    <ul>
                                                    <?php $_from = $this->_var['spec']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'value');$this->_foreach['attrvalues'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['attrvalues']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
        $this->_foreach['attrvalues']['iteration']++;
?>  
                                                    <?php if ($this->_var['spec']['is_checked'] > 0): ?>
                                                    <li class="item<?php if ($this->_var['value']['checked'] == 1 && $this->_var['cfg']['add_shop_price'] == 1): ?> selected<?php endif; ?>" data-name="<?php echo $this->_var['value']['id']; ?>">
                                                        <b></b>
                                                        <a href="<?php if ($this->_var['value']['img_site']): ?><?php echo $this->_var['value']['img_site']; ?><?php else: ?>javascript:void(0);<?php endif; ?>"<?php if ($this->_var['value']['img_site']): ?> target="_blank"<?php endif; ?>>
                                                            <?php if ($this->_var['value']['img_flie']): ?>
                                                            <img src="<?php echo $this->_var['value']['img_flie']; ?>" width="24" height="24" />
                                                            <?php endif; ?>
                                                            <i><?php echo $this->_var['value']['label']; ?></i>
                                                            <input id="spec_value_<?php echo $this->_var['value']['id']; ?>" type="<?php if ($this->_var['spec']['attr_type'] == 2): ?>checkbox<?php else: ?>radio<?php endif; ?>" data-attrtype="<?php if ($this->_var['spec']['attr_type'] == 2): ?>2<?php else: ?>1<?php endif; ?>" name="spec_<?php echo $this->_var['spec_key']; ?>" value="<?php echo $this->_var['value']['id']; ?>" class="hide" />
                                                            <?php if ($this->_var['value']['checked'] == 1): ?>
                                                            <script type="text/javascript">
                                                                $(function(){
                                                                    <?php if ($this->_var['cfg']['add_shop_price'] == 1): ?>
                                                                    $("#spec_value_<?php echo $this->_var['value']['id']; ?>").prop("checked", true);
                                                                    <?php else: ?>
                                                                    $("#spec_value_<?php echo $this->_var['value']['id']; ?>").prop("checked", false);
                                                                    <?php endif; ?>
                                                                });
                                                            </script>
                                                            <?php endif; ?>
                                                        </a>
                                                    </li>
                                                    <?php else: ?>
                                                    <li class="item <?php if ($this->_var['key'] == 0 && $this->_var['cfg']['add_shop_price'] == 1): ?> selected<?php endif; ?>" data-name="<?php echo $this->_var['value']['id']; ?>">
                                                        <b></b>
                                                        <a href="javascript:void(0);" name="<?php echo $this->_var['value']['id']; ?>" class="noimg">
                                                            <i><?php echo $this->_var['value']['label']; ?></i>
                                                            <input id="spec_value_<?php echo $this->_var['value']['id']; ?>" type="<?php if ($this->_var['spec']['attr_type'] == 2): ?>checkbox<?php else: ?>radio<?php endif; ?>" data-attrtype="<?php if ($this->_var['spec']['attr_type'] == 2): ?>2<?php else: ?>1<?php endif; ?>" name="spec_<?php echo $this->_var['spec_key']; ?>" value="<?php echo $this->_var['value']['id']; ?>" class="hide" /></a> 
                                                            <?php if ($this->_var['key'] == 0): ?>
                                                            <script type="text/javascript">
                                                                $(function(){
                                                                    <?php if ($this->_var['cfg']['add_shop_price'] == 1): ?>
                                                                    $("#spec_value_<?php echo $this->_var['value']['id']; ?>").prop("checked", true);
                                                                    <?php else: ?>
                                                                    $("#spec_value_<?php echo $this->_var['value']['id']; ?>").prop("checked", false);
                                                                    <?php endif; ?>
                                                                });
                                                            </script>
                                                            <?php endif; ?>											
                                                        </a>
                                                    </li>									
                                                    <?php endif; ?>
                                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                    </ul>
                                                </div>
                                                <?php else: ?>
                                                ...
                                                <?php endif; ?>
                                                <input type="hidden" name="spec_list" value="<?php echo $this->_var['spec_key']; ?>" data-spectype="<?php if ($this->_var['spec']['attr_type'] == 1): ?>attr-radio<?php else: ?>attr-check<?php endif; ?>" />
                                            </div>
                                            <?php endif; ?>
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        	<div class="tb-list">
                                            	<div class="tb-label">数量：</div>
												<div class="tb-value">
													<div class="amount-warp">
														<input class="text buy-num" ectype="quantity" onblur="changePrice()" value="<?php if ($this->_var['goods']['measure_unit'] == 0): ?>0<?php else: ?>1<?php endif; ?>" name="number" defaultnumber="1">
														<div class="a-btn">
															<a href="javascript:void(0);" class="btn-add"><i class="iconfont icon-up"></i></a>
															<a href="javascript:void(0);" class="btn-reduce btn-disabled"><i class="iconfont icon-down"></i></a>
														</div>
														<input name="confirm_type" id="confirm_type" type="hidden" value="3" />
													</div>
													<span class="lh30 ml10"><?php echo $this->_var['lang']['goods_inventory']; ?>&nbsp;<em ectype="goods_attr_num"></em>&nbsp;<?php if ($this->_var['goods']['goods_unit']): ?><?php echo $this->_var['goods']['goods_unit']; ?><?php else: ?><?php echo $this->_var['goods']['measure_unit']; ?><?php endif; ?></span>
												</div>
											</div>
                                            <div class="tb-list">
                                            	<div class="tb-label">&nbsp;</div>
                                                <div class="tb-value">
													<a href="javascript:bool=0;addToCartShowDiv(<?php echo $this->_var['goods']['goods_id']; ?>)" class="cz-btn cz-btn-true" ectype="btn-append">确定</a>
                                                    <a href="javascript:void(0);" class="cz-btn cz-btn-false" ectype="tb-cancel">取消</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gm-tab-qp-bort" ectype="qp-bort"></div>
                    </div>
                    <div class="gm-floors" ectype="gm-floors">
                    	
                        <div class="gm-f-item gm-f-details" ectype="gm-item">
                        	<div class="gm-title">
                            	<h3>商品详情</h3>
                            </div>
                            <div class="goods-para-list">
                                <dl class="goods-para">
                                    <dd class="column"><span><?php echo $this->_var['lang']['goods_name']; ?>：<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?></span></dd>
                                    <dd class="column"><span><?php echo $this->_var['lang']['Commodity_number']; ?>：<?php echo $this->_var['goods']['goods_sn']; ?></span></dd>
                                    <dd class="column"><span><?php echo $this->_var['lang']['seller_store']; ?>：<a href="<?php echo $this->_var['goods']['store_url']; ?>" title="<?php echo $this->_var['goods']['rz_shopName']; ?>" target="_blank"><?php echo $this->_var['goods']['rz_shopName']; ?></a></span></dd>
                                    <?php if ($this->_var['cfg']['show_goodsweight']): ?>
                                    <dd class="column"><span><?php echo $this->_var['lang']['weight']; ?>：<?php echo $this->_var['goods']['goods_weight']; ?></span></dd>
                                    <?php endif; ?>
                                    <?php if ($this->_var['cfg']['show_addtime']): ?>
                                    <dd class="column"><span><?php echo $this->_var['lang']['add_time']; ?><?php echo $this->_var['goods']['add_time']; ?></span></dd>
                                    <?php endif; ?>
                                </dl>
                            
                                <?php if ($this->_var['properties']): ?>
                                <dl class="goods-para">
                                    <?php $_from = $this->_var['properties']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'property_group');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['property_group']):
?>
                                    <?php $_from = $this->_var['property_group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'property');$this->_foreach['noproperty'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['noproperty']['total'] > 0):
    foreach ($_from AS $this->_var['property']):
        $this->_foreach['noproperty']['iteration']++;
?>
                                    <?php if ($this->_foreach['noproperty']['iteration'] < 13): ?>
                                    <dd class="column"><span title="<?php echo $this->_var['property']['value']; ?>"><?php echo htmlspecialchars($this->_var['property']['name']); ?>：<?php echo $this->_var['property']['value']; ?></span></dd>
                                    <?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </dl>
                                <?php endif; ?>
                                <?php if ($this->_var['extend_info']): ?>
                                <dl class="goods-para">
                                    <?php $_from = $this->_var['extend_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'info_0_15625000_1503823066');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['info_0_15625000_1503823066']):
?>	
                                    <dd class="column"><span title="<?php echo htmlspecialchars($this->_var['info_0_15625000_1503823066']); ?>"><?php echo $this->_var['key']; ?>：<?php echo htmlspecialchars($this->_var['info_0_15625000_1503823066']); ?></span></dd>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </dl>
                                <?php endif; ?>
                                <?php if ($this->_var['properties']): ?>
                                <p class="more-par">
                                    <a href="#product-detail" class="ftx-05">更多参数>></a>
                                </p>
                                <?php endif; ?>
                            </div>
                            
                            <?php echo $this->_var['goods']['goods_desc']; ?>
                        </div>
                        <?php if ($this->_var['properties']): ?>
                        <div class="gm-f-item gm-f-parameter" ectype="gm-item" id="product-detail">
                        	<div class="gm-title">
                            	<h3>规格参数</h3>
                            </div>
                            <div class="Ptable">
                            	<?php $_from = $this->_var['properties']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'property_group');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['property_group']):
?>
                            	<div class="Ptable-item">
                                	<h3><?php echo $this->_var['key']; ?></h3>
                                    <dl>
                                    	<?php $_from = $this->_var['property_group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'property');if (count($_from)):
    foreach ($_from AS $this->_var['property']):
?>
                                    	<dt><?php echo htmlspecialchars($this->_var['property']['name']); ?></dt>
                                        <dd title="<?php echo $this->_var['property']['value']; ?>"><?php echo $this->_var['property']['value']; ?></dd>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </dl>
                                </div>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="gm-f-item gm-f-comment" ectype="gm-item">
                        	<div class="gm-title">
                            	<h3>评论晒单</h3>
								<?php 
$k = array (
  'name' => 'goods_comment_title',
  'goods_id' => $this->_var['goods']['goods_id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
                            </div>
                            <div class="gm-warp">
                            	<div class="praise-rate-warp">
                                	<div class="rate">
                                    	<strong><?php echo $this->_var['comment_all']['goodReview']; ?></strong>
                                        <span class="rate-span">
                                        	<span class="tit">好评率</span>
                                            <span class="bf">%</span>
                                        </span>
                                    </div>
                                    <div class="actor-new">
                                    	<?php if ($this->_var['goods']['impression_list']): ?>
                                    	<dl>
											<?php $_from = $this->_var['goods']['impression_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'tag');if (count($_from)):
    foreach ($_from AS $this->_var['tag']):
?>
											<dd><?php echo $this->_var['tag']['txt']; ?>(<?php echo $this->_var['tag']['num']; ?>)</dd>
											<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        </dl>
                                        <?php else: ?>
                                        <div class="not_impression">此商品还没有设置买家印象，陪我一起等下嘛~</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
								<div class="com-list-main">
								<?php echo $this->fetch('library/comments.lbi'); ?>
								</div>
                            </div>
                        </div>
                        <div class="gm-f-item gm-f-tiezi" ectype="gm-item">
							<?php 
$k = array (
  'name' => 'goods_discuss_title',
  'goods_id' => $this->_var['goods']['goods_id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
                            <div class="table" id='discuss_list_ECS_COMMENT'>
                            	<?php echo $this->fetch('library/comments_discuss_list1.lbi'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="rection">
                	<div class="ftit"><h3><?php echo $this->_var['lang']['guess_love']; ?></h3></div>
                    <?php echo $this->fetch('library/guess_goods_love.lbi'); ?>
                </div>
            </div>
        </div>
    </div>
    <div id="notify_box" class="hide">
        <div class="sale-notice">
            <div class="prompt"><?php echo $this->_var['lang']['price_notice_desc']; ?></div>
            <div class="user-form foreg-form">
            	<div class="form-row">
                	<div class="form-label"><em class="red">*</em><?php echo $this->_var['lang']['Price_below']; ?>：</div>
                    <div class="form-value">
                    	<input type="text" id="price-notice" name="price-notice" class="form-input w120 fl">
                        <div class="notic"><?php echo $this->_var['lang']['Price_below_one']; ?></div>
                        <div class="error"></div>
                    </div>
                </div>
                <div class="form-row">
                	<div class="form-label"><em class="red">*</em><?php echo $this->_var['lang']['label_mobile']; ?></div>
                    <div class="form-value">
                    	<input type="text" class="form-input" id="cellphone" name="cellphone">
                        <div class="error"></div>
                    </div>
                </div>
                <div class="form-row">
                	<div class="form-label"><em class="red">*</em><?php echo $this->_var['lang']['website_email']; ?>：</div>
                    <div class="form-value">
                    	<input type="text" class="form-input" id="user_email_notice" name="email">
                        <div class="error"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="ecsc-cart-popup" id="addtocartdialog">
        <div class="loading-mask"></div>
        <div class="loading">
            <div class="center_pop_txt">
                <div class="title"><h3><?php echo $this->_var['lang']['Prompt']; ?></h3><a href="javascript:loadingClose();" title="<?php echo $this->_var['lang']['close']; ?>" class="loading-x">X</a></div>
            </div>
            <div class="btns">
                <a href="flow.php" class="ecsc-btn-mini ecsc-btn-orange"><?php echo $this->_var['lang']['go_pay']; ?></a>
                <a href="javascript:loadingClose();" class="ecsc-btn-mini"><?php echo $this->_var['lang']['go_shopping']; ?></a>
            </div>
        </div>
    </div>
    
    <?php echo $this->fetch('library/common_html.lbi'); ?>
    
    <?php echo $this->fetch('library/goods_fittings_cnt.lbi'); ?>
    
    	 
    <?php echo $this->fetch('library/duibi.lbi'); ?>
    
    
    <?php 
$k = array (
  'name' => 'user_menu_position',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
    
    <?php echo $this->fetch('library/page_footer.lbi'); ?>
    
    <?php 
$k = array (
  'name' => 'goods_delivery_area_js',
  'area' => $this->_var['area'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
   
    <?php echo $this->smarty_insert_scripts(array('files'=>'jquery.SuperSlide.2.1.1.js,jquery.yomi.js,common.js,compare.js,cart_common.js,warehouse_area.js,magiczoomplus.js,cart_quick_links.js')); ?>
    <script type="text/javascript" src="js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
	<script type="text/javascript" src="js/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/dsc-common.js"></script>
    <script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/jquery.purebox.js"></script>
    <script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/sc_memake.js"></script>
    
    <script type="text/javascript">
	//商品详情悬浮框
	$(".goods-main-layout").jfloor();
	
	//商品相册小图滚动
	$(".spec-list").slide({mainCell:".spec-items ul",effect:"left",trigger:"click",pnLoop:false,autoPage:true,scroll:1,vis:5,prevCell:".spec-prev",nextCell:".spec-next"});
	
	//右侧看了又看上下滚动
	$(".track_warp").slide({mainCell:".track-con ul",effect:"top",pnLoop:false,autoPlay:false,autoPage:true,prevCell:".sprite-up",nextCell:".sprite-down",vis:3});
	
	//商品搭配切换
	$(".combo-inner").slide({titCell:".tab-nav li",mainCell:".tab-content",titOnClassName:"curr",trigger:"click"});
	
	//商品搭配 多个商品滚动切换
	$(".combo-items").slide({mainCell:".combo-items-warp ul",effect:"left",pnLoop:false,autoPlay:false,autoPage:true,prevCell:".o-prev",nextCell:".o-next",vis:4});
	
	//左侧新品 热销 推荐排行切换
	$(".g-rank").slide({titCell:".mc-tab li",mainCell:".mc-content",titOnClassName:"curr",trigger:"click"});
	
	/*促销价格倒计时*/
	<?php if ($this->_var['goods']['gmt_end_time']): ?>
		$(".cd-time").each(function(){
			$(this).yomi();
		});
	<?php endif; ?>
    </script>
	<script type="text/javascript">
	//全局变量
	var goods_id = <?php echo $this->_var['goods_id']; ?>;
	var goodsattr_style = <?php echo empty($this->_var['cfg']['goodsattr_style']) ? '1' : $this->_var['cfg']['goodsattr_style']; ?>;
	var gmt_end_time = <?php echo empty($this->_var['promote_end_time']) ? '0' : $this->_var['promote_end_time']; ?>;
	var goodsId = <?php echo $this->_var['goods_id']; ?>;
	var now_time = <?php echo $this->_var['now_time']; ?>;
	
	$(function(){
		
		Compare.init();
		
		//设置sku属性价格处理radio标签不选中兼容问题
		<?php if ($this->_var['cfg']['add_shop_price'] == 0): ?>
			$(".goods_info_attr").find(".item :input").prop("checked", false);
			$(".goods_info_attr").find(".item").removeClass("selected");
		<?php endif; ?>

		//数量选择
		function quantity(){
			$(".btn-reduce").click(function(){
				var quantity = Number($("*[ectype='quantity']").val());
				var perNumber = Number($("*[ectype='perNumber']").val());
				var perMinNumber = Number($("*[ectype='perMinNumber']").val());
			
				if(quantity>perMinNumber){
					quantity-=1;
					$("*[ectype='quantity']").val(quantity);
//					changePrice();//@author bylu 数量减少后获取白条分期新价格;
					
					if(quantity == 1)
					$(".btn-reduce").addClass("btn-disabled");
				}else{
					$("*[ectype='quantity']").val(perMinNumber);
				}
			});
			
			$(".btn-add").click(function(){
				var quantity = Number($("*[ectype='quantity']").val());
				var perNumber = Number($("*[ectype='perNumber']").val());
				var perMinNumber = Number($("*[ectype='perMinNumber']").val());
				var err = 0;
			
				if(quantity < perNumber){
					
					quantity+=1;
					
					//限购
					<?php if ($this->_var['xiangou'] == 1): ?>
						<?php if ($this->_var['goods']['is_xiangou'] == 1 && $this->_var['goods']['xiangou_num'] > 0): ?>
							var xuangou_num = <?php echo $this->_var['goods']['xiangou_num']; ?>;
							var xiangou = <?php echo $this->_var['xiangou']; ?>;
							
							if (<?php echo $this->_var['orderG_number']; ?> >= xuangou_num){
								  err = 1;
								  var message = json_languages.Already_buy+'<?php echo $this->_var['orderG_number']; ?>'+json_languages.Already_buy_two;
								  quantity = 1;
							}else if(quantity > xuangou_num && xuangou_num > 0 && xiangou == 1){
								  err = 1;
								  var message = json_languages.Purchase_quantity;
								  quantity = 1;
							}
							
							if(err == 1){
								pbDialog(message,"",0);
							}
						<?php endif; ?>
					<?php endif; ?>
					
					if(quantity == 1){
						err = 0;
					}
					$("*[ectype='quantity']").val(quantity);
//					changePrice();//@author bylu 数量增加后获取白条分期新价格;
					
				  $(".btn-reduce").removeClass("btn-disabled");
				}else{
					if(perNumber == 0){
						perNumber = 1;
					}
					$("*[ectype='quantity']").val(perNumber);
				}
		
			})
		}
		quantity();

		//后台购买流程设置点击确定立即购买，并且没有登录会员弹出登录框
		$("*[ectype='btn-buynow']").click(function(){
			var user_id = Number(<?php echo $this->_var['user_id']; ?>);
			var one_step_buy = Number(<?php echo $this->_var['one_step_buy']; ?>);
			if(user_id <= 0 && one_step_buy == 1)
			{
				var back_url = "goods.php?id=" + <?php echo $this->_var['goods']['goods_id']; ?>;
				$.notLogin("get_ajax_content.php?act=get_login_dialog",back_url);
				return false;
			}
		});
	});
	
	/******************************************* js方法 start***********************************************/
	
	/**
	 * 点击可选属性或改变数量时修改商品价格的函数
	 */
	function changePrice(onload)
	{
	  var qty = $("*[ectype='quantity']").val();
	
	  //ecmoban模板堂 --zhuo start 限购
	  if(onload != 'onload'){
		  
		  var goods_attr_id = getSelectedAttributes(document.forms['ECS_FORMBUY']);

		  <?php if ($this->_var['xiangou'] == 1): ?>
			 <?php if ($this->_var['goods']['is_xiangou'] == 1 && $this->_var['goods']['xiangou_num'] > 0): ?>
				var xuangou_num = <?php echo $this->_var['goods']['xiangou_num']; ?>;
				var xiangou = <?php echo $this->_var['xiangou']; ?>;
				if(qty > xuangou_num && xuangou_num > 0 && xiangou == 1){
					
					var add_cart_divId = 'flow_add_cart';
					var content = '<div id="flow_add_cart">' + 
										'<div class="tip-box icon-box">' +
											'<span class="warn-icon m-icon"></span>' + 
											'<div class="item-fore">' +
												'<h3 class="rem ftx-04">'+json_languages.Purchase_quantity+'</h3>' +
											'</div>' +
										'</div>' +
									'</div>';
					pb({
						id:add_cart_divId,
						title:json_languages.title,
						width:455,
						height:58,
						content:content, 	//调取内容
						drag:false,
						foot:false
					});
					qty = 1;
				}
			 <?php endif; ?>
		   <?php endif; ?>
		   
		   var goods_attr = '';
		   <?php if ($this->_var['cfg']['add_shop_price'] == 0): ?>
				var attr_id = goods_attr = getSelectedAttributesGroup(document.forms['ECS_FORMBUY']);
				goods_attr = '&goods_attr=' + attr_id;
		   <?php endif; ?>
		   
		   Ajax.call('goods.php', 'act=price&id=' + goodsId + '&attr=' + goods_attr_id + goods_attr + '&number=' + qty + '&warehouse_id=' + <?php echo empty($this->_var['region_id']) ? '0' : $this->_var['region_id']; ?> + '&area_id=' + <?php echo empty($this->_var['area_id']) ? '0' : $this->_var['area_id']; ?>, changePriceResponse, 'GET', 'JSON');
	  }else{
		  
		  <?php if ($this->_var['cfg']['add_shop_price'] == 1): ?>	
			var goods_attr_id = getSelectedAttributes(document.forms['ECS_FORMBUY']);
			attr = '&attr=' + goods_attr_id;
		  <?php else: ?>
			var attr = '';
		  <?php endif; ?>
	  
		  Ajax.call('goods.php', 'act=price&id=' + goodsId + attr + '&number=' + qty + '&warehouse_id=' + <?php echo empty($this->_var['region_id']) ? '0' : $this->_var['region_id']; ?> + '&area_id=' + <?php echo empty($this->_var['area_id']) ? '0' : $this->_var['area_id']; ?> + '&onload=' + onload, changePriceResponse, 'GET', 'JSON');
	  }
	   //ecmoban模板堂 --zhuo end 限购
	}

	/**
	 * 接收返回的信息
	 */
	function changePriceResponse(res)
	{
	
	  if (res.err_msg.length > 0)
	  {
		pbDialog(res.err_msg,"",0);
	  }
	  else
	  {
		
		if (document.getElementById('bar_code')){
			if(res.bar_code){
				$("#bar_code").html(res.bar_code);
				$("#bar_code").parents(".bar_code").removeClass("hide");
			}else{
				$("#bar_code").parents(".bar_code").addClass("hide");
			}
		}
		  
		$("*[ectype='quantity']").val(res.qty);
		
		$('#cost-price').html(res.marketPrice_amount);
	
		//ecmoban模板堂 --zhuo satrt
		if (document.getElementById('goods_attr_num')){
		  //document.getElementById('goods_attr_num').innerHTML = res.attr_number;  
		  $("*[ectype='goods_attr_num']").html(res.attr_number);
		  //document.getElementById('perNumber').value = res.attr_number;  
		  $("*[ectype='perNumber']").html(res.attr_number);
		}
		/*更新已购买数量*/
		if(document.getElementById('orderG_number')){
				$("#orderG_number").html(res.orderG_number);
			}
		if(document.getElementById('ECS_SHOPPRICE')){ 
			if(document.getElementById('ECS_MARKETPRICE')){
				document.getElementById('ECS_MARKETPRICE').innerHTML = res.result_market;
			}
			
			if(res.onload == 'onload'){
				//document.getElementById('ECS_SHOPPRICE').innerHTML = res.result;
				$("*[ectype='SHOP_PRICE']").html(res.result);
			}else{
				<?php if ($this->_var['cfg']['add_shop_price'] == 1): ?>	
					//document.getElementById('ECS_SHOPPRICE').innerHTML = res.result;
					$("*[ectype='SHOP_PRICE']").html(res.result);
				<?php else: ?>
					if(res.show_goods == 1){
						//document.getElementById('ECS_SHOPPRICE').innerHTML = res.spec_price;
						$("*[ectype='SHOP_PRICE']").html(res.spec_price);
					}else{
						//document.getElementById('ECS_SHOPPRICE').innerHTML = res.result;
						$("*[ectype='SHOP_PRICE']").html(res.spec_price);
					}
				<?php endif; ?>
			}
			
			var combo_shop = document.getElementsByName('combo_shopPrice[]'); 
			var combo_mark = document.getElementsByName('combo_markPrice[]');  
			
			for(var i=0; i<combo_shop.length; i++){
				combo_shop[i].innerHTML = res.shop_price;
			}
			
			for(var i=0; i<combo_mark.length; i++){
				combo_mark[i].innerHTML = res.market_price;
			}
		}
		
		if(res.err_no == 2){
			$('#isHas_warehouse_num').html(json_languages.shiping_prompt);
		}else{
			
			var isHas;
			var status = <?php echo $this->_var['cfg']['add_shop_price']; ?>;
			var is_shipping = Number($("#is_shipping").val());
			
			if (document.getElementById('isHas_warehouse_num')){
			  
			  if((res.attr_number > 0 || status == 0) && (res.attr_number > 0 || res.original_spec_price == res.original_shop_price) && (<?php echo empty($this->_var['goods']['is_on_sale']) ? '0' : $this->_var['goods']['is_on_sale']; ?> != 0 || is_shipping == 1)){
				  $("a[ectype='btn-append']").attr('href','javascript:addToCartShowDiv(<?php echo $this->_var['goods']['goods_id']; ?>)').removeClass('btn_disabled');
				  $("a[ectype='btn-buynow']").attr('href','<?php if ($this->_var['user_id'] <= 0 && $this->_var['one_step_buy']): ?>#none<?php else: ?>javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)<?php endif; ?>').removeClass('btn_disabled');
				  $("a[ectype='byStages']").removeClass('btn_disabled');
				  $('a').remove('#quehuo');
				  isHas = '<strong>'+json_languages.Have_goods+'</strong>，'+json_languages.Deliver_back_order;
				  
				  $("a[ectype='btn-buynow']").show();
				  $("a[ectype='btn-append']").show();
				  $("a[ectype='byStages']").show();
			  }else{
				  isHas = '<strong>'+json_languages.No_goods+'</strong>，'+json_languages.goods_over;
				 
					$("a[ectype='btn-buynow']").attr('href','javascript:void(0)').addClass('btn_disabled');
					$("a[ectype='btn-append']").attr('href','javascript:void(0)').addClass('btn_disabled');
					$("a[ectype='byStages']").addClass('btn_disabled');
					
					<?php if ($this->_var['goods']['review_status'] >= 3): ?>
						if(!document.getElementById('quehuo') ){
							if(<?php echo empty($this->_var['goods']['is_on_sale']) ? '0' : $this->_var['goods']['is_on_sale']; ?> != 0 || is_shipping == 1){
								$("a[ectype='btn-buynow']").hide();
								$("a[ectype='btn-append']").hide();
								$("a[ectype='byStages']").hide();
								$('.choose-btns').append('<a id="quehuo" class="btn-buynow" href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>);">暂时缺货</a>');
							}
						}
					<?php endif; ?>
			  }
					  
			  if(res.store_type == 1){
				  $(".btn-store-pick").show();
				  $(".choose-store").show();
			  }else{
				  $(".btn-store-pick").hide();
				  $(".choose-store").hide();
			  }
			  
			  if(is_shipping == 0){
				  isHas = '<strong>'+json_languages.Have_goods+'</strong>，' + json_languages.shiping_prompt;
			  }
			  
			  document.getElementById('isHas_warehouse_num').innerHTML = isHas;
			}
		}
		
		if(res.fittings_interval){
			for(var i=0; i<res.fittings_interval.length; i++){
				$("#m_goods_" + res.fittings_interval[i].groupId).html(res.fittings_interval[i].fittings_minMax);
				$("#m_goods_save_" + res.fittings_interval[i].groupId).html(res.fittings_interval[i].save_minMaxPrice);
				$("#m_goods_reference_" + res.fittings_interval[i].groupId).html(res.fittings_interval[i].market_minMax);
			}
		}
		
		if(res.onload == 'onload'){
			//document.getElementById('ECS_SHOPPRICE').innerHTML = res.result;
			$("*[ectype='SHOP_PRICE']").html(res.result);
		}
		
		<?php if ($this->_var['cfg']['add_shop_price'] == 1): ?>	
			$('.ECS_fittings_interval').html(res.shop_price);
		<?php else: ?>
			if(res.show_goods == 1){
				$('.ECS_fittings_interval').html(res.spec_price);
			}else{
				$('.ECS_fittings_interval').html(res.shop_price);
			}
		<?php endif; ?>
		//ecmoban模板堂 --zhuo end
	
	
		  //@author-bylu 更新白条分期购每期的价格 start
		  if(res.stages){
			  var i=0;
			  $.each(res.stages,function(k,v){
				  if(k!=1) {
					  $('#chooseStages dd strong').eq(i).html('￥' + v + '×' + k + qi);
					  $('#chooseStages dd strong').eq(i).next('span').html(free_desc+'<?php echo $this->_var['goods']['stages_rate']; ?>%，￥' + v + '×' + k + qi);
				  }
				  i++;
			  });
		  }
		  //author-bylu end
	  }
	}
	
	//配送地区 常用地址选择
	function get_region_change(goods_id, province_id, city_id, district_id){
		Ajax.call("ajax_dialog.php", 'id=' + goods_id + '&act=in_stock' + '&province=' + province_id + "&city=" + city_id + "&district=" + district_id, ajax_is_inStock, "GET", "JSON");
	}
	
	function ajax_is_inStock(res){
		var t = '&t=' + parseInt(Math.random()*1000);
		var str_new = window.location.href.replace(/\&t\=\d+/g,t);
		location.href = str_new;
	}
	/* 获取配送区域 end*/
	

	//处理添加商品到组合购买购物车
	function get_cart_combo_open_list(rev, fitt_goods){
	  var group        	= new Object();
	  group.rev   		= rev;
	  
	  if(fitt_goods){
		group.fitt_goods  = fitt_goods;
	  }
	
	  Ajax.call('flow.php?step=add_cart_combo_list', 'group=' + $.toJSON(group), get_cart_combo_openResponse, 'POST', 'JSON'); //兼容jQuery by mike
	}
	
	
	//处理添加商品到组合购买购物车的反馈信息
	function get_cart_combo_openResponse(result)
	{
		if(result.list_select != 1){
			$("#fittings_minMax_top").html(result.fittings_minMax);
			$("#list_select").html(result.null_money);
		}else{
			$(".fittings_minMax").html(result.fittings_minMax);
		}
		
		$('.J_ComboDialog').find(".fitts_body").html(result.content_type);
		
		$(".save_minMaxPrice").html(result.save_minMaxPrice);
		$(".market_minMax").html(result.market_minMax);
		$(".collocation_number").html(result.collocation_number);
		
		$(".fittings_minMax").html(result.fittings_minMax);
		$('strong[name="combo_savePrice[]"]').html(result.save_minMaxPrice);
		$('span[name="combo_shopPrice[]"]').html(result.fittings_minMax);
		$('span[name="combo_markPrice[]"]').html(result.market_minMax);
	}
	
	//清空浏览历史
	function clear_history()
	{
		Ajax.call('user.php', 'act=clear_history',function(){
			$("#history_list").html('<div class="history_tishi"><?php echo $this->_var['lang']['no_history']; ?><br /><a href="index.php" class="ftx-05"><?php echo $this->_var['lang']['go_shoping']; ?></a></div>');
		}, 'GET', 'TEXT',1,1);
	}
	//商品举报
        $("*[ectype='report']").on("click", function () {
            var goods_id = $("input[name='good_id']").val(),
                user_id = $("input[name='user_id']").val();
            var back_url = "user.php?act=goods_report&goods_id="+goods_id;
            if (user_id > 0) {
               location.href = back_url;
            } else {
                $.notLogin("get_ajax_content.php?act=get_login_dialog", back_url);
                return false;
            }
        });
	/******************************************* js方法 end***********************************************/	
	</script>
</body>
</html>
