<?php if ($this->_var['history_goods']): ?>
<div class="g-main g-history">
	<div class="mt">
		<h3>最近浏览</h3>
		<a onclick="clear_history()" class="clear_history ftx-05 fr mt10 mr10" href="javascript:void(0);"><?php echo $this->_var['lang']['clear']; ?></a>
	</div>
	<div class="mc">
		<div class="mc-warp" id="history_list">
			<ul>
				<?php $_from = $this->_var['history_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_23437500_1503823066');if (count($_from)):
    foreach ($_from AS $this->_var['goods_0_23437500_1503823066']):
?>
				<li>
					<div class="p-img"><a href="<?php echo $this->_var['goods_0_23437500_1503823066']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['goods_0_23437500_1503823066']['goods_name']); ?>"><img src="<?php echo $this->_var['goods_0_23437500_1503823066']['goods_thumb']; ?>" width="170" height="170"></a></div>
                    <div class="p-name"><a href="<?php echo $this->_var['goods_0_23437500_1503823066']['url']; ?>" target="_blank"><?php echo $this->_var['goods_0_23437500_1503823066']['short_name']; ?></a></div>
					<div class="p-lie">
						<div class="p-price">
							<?php if ($this->_var['releated_goods_data']['promote_price'] != ''): ?>
								<?php echo $this->_var['goods_0_23437500_1503823066']['formated_promote_price']; ?>
							<?php else: ?>
								<?php echo $this->_var['goods_0_23437500_1503823066']['shop_price']; ?>
							<?php endif; ?>
						</div>
					</div>
				</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
		</div>
	</div>
</div>
<?php endif; ?>