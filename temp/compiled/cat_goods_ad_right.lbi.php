
<?php if ($this->_var['ad_child']): ?>
    <?php if ($this->_var['floor_style_tpl'] == 1): ?>
        <?php $_from = $this->_var['ad_child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'ad_0_18467500_1504930457');$this->_foreach['noad'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['noad']['total'] > 0):
    foreach ($_from AS $this->_var['ad_0_18467500_1504930457']):
        $this->_foreach['noad']['iteration']++;
?>
        <div class="f-r-m-item<?php if ($this->_foreach['noad']['iteration'] == 1): ?> f-r-m-i-double<?php endif; ?>">
            <a href="<?php echo $this->_var['ad_0_18467500_1504930457']['ad_link']; ?>" target="_blank">
                <div class="title">
                    <h3><?php echo $this->_var['ad_0_18467500_1504930457']['b_title']; ?></h3>
                    <span><?php echo $this->_var['ad_0_18467500_1504930457']['s_title']; ?></span>
                </div>
                <img src="<?php echo $this->_var['ad_0_18467500_1504930457']['ad_code']; ?>" width="<?php echo $this->_var['ad_0_18467500_1504930457']['ad_width']; ?>" height="<?php echo $this->_var['ad_0_18467500_1504930457']['ad_height']; ?>">
            </a>
        </div>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <?php elseif ($this->_var['floor_style_tpl'] == 2): ?>
        <?php $_from = $this->_var['ad_child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'ad_0_18476000_1504930457');$this->_foreach['noad'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['noad']['total'] > 0):
    foreach ($_from AS $this->_var['ad_0_18476000_1504930457']):
        $this->_foreach['noad']['iteration']++;
?>
        <div class="f-r-m-item<?php if ($this->_foreach['noad']['iteration'] == 2): ?> f-r-m-i-double<?php endif; ?>">
            <a href="<?php echo $this->_var['ad_0_18476000_1504930457']['ad_link']; ?>" target="_blank">
                <div class="title">
                    <h3><?php echo $this->_var['ad_0_18476000_1504930457']['b_title']; ?></h3>
                    <span><?php echo $this->_var['ad_0_18476000_1504930457']['s_title']; ?></span>
                </div>
                <img src="<?php echo $this->_var['ad_0_18476000_1504930457']['ad_code']; ?>" width="<?php echo $this->_var['ad_0_18476000_1504930457']['ad_width']; ?>" height="<?php echo $this->_var['ad_0_18476000_1504930457']['ad_height']; ?>">
            </a>
        </div>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <?php elseif ($this->_var['floor_style_tpl'] == 3): ?>
        <?php $_from = $this->_var['ad_child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'ad_0_18483800_1504930457');$this->_foreach['noad'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['noad']['total'] > 0):
    foreach ($_from AS $this->_var['ad_0_18483800_1504930457']):
        $this->_foreach['noad']['iteration']++;
?>
        <div class="f-r-m-item<?php if ($this->_foreach['noad']['iteration'] == 4): ?> f-r-m-i-double<?php endif; ?>">
            <a href="<?php echo $this->_var['ad_0_18483800_1504930457']['ad_link']; ?>" target="_blank">
                <div class="title">
                    <h3><?php echo $this->_var['ad_0_18483800_1504930457']['b_title']; ?></h3>
                    <span><?php echo $this->_var['ad_0_18483800_1504930457']['s_title']; ?></span>
                </div>
                <img src="<?php echo $this->_var['ad_0_18483800_1504930457']['ad_code']; ?>" width="<?php echo $this->_var['ad_0_18483800_1504930457']['ad_width']; ?>" height="<?php echo $this->_var['ad_0_18483800_1504930457']['ad_height']; ?>">
            </a>
        </div>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <?php else: ?>
        <?php $_from = $this->_var['ad_child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'ad_0_18489400_1504930457');$this->_foreach['noad'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['noad']['total'] > 0):
    foreach ($_from AS $this->_var['ad_0_18489400_1504930457']):
        $this->_foreach['noad']['iteration']++;
?>
        <div class="f-r-m-item<?php if ($this->_foreach['noad']['iteration'] == 5): ?> f-r-m-i-double<?php endif; ?>">
            <a href="<?php echo $this->_var['ad_0_18489400_1504930457']['ad_link']; ?>" target="_blank">
                <div class="title">
                    <h3><?php echo $this->_var['ad_0_18489400_1504930457']['b_title']; ?><?php echo $this->_var['goods_cat']['floor_style_tpl']; ?></h3>
                    <span><?php echo $this->_var['ad_0_18489400_1504930457']['s_title']; ?></span>
                </div>
                <img src="<?php echo $this->_var['ad_0_18489400_1504930457']['ad_code']; ?>" width="<?php echo $this->_var['ad_0_18489400_1504930457']['ad_width']; ?>" height="<?php echo $this->_var['ad_0_18489400_1504930457']['ad_height']; ?>">
            </a>
        </div>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <?php endif; ?>	
<?php endif; ?>