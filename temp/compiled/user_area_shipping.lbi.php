<?php if ($this->_var['shippingFee']['is_shipping'] == 1): ?>
<span class="gary">[ 快递：<?php echo $this->_var['shippingFee']['shipping_fee_formated']; ?> ]</span>
<?php endif; ?>

<input name="is_shipping" id="is_shipping" type="hidden" value="<?php echo empty($this->_var['shippingFee']['is_shipping']) ? '0' : $this->_var['shippingFee']['is_shipping']; ?>">