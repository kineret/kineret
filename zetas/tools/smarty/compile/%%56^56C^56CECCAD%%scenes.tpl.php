<?php /* Smarty version 2.6.20, created on 2010-12-20 19:39:34
         compiled from /home/kineret/kineret.com.br/zetas/themes/zetastheme/./scenes.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/home/kineret/kineret.com.br/zetas/themes/zetastheme/./scenes.tpl', 6, false),array('function', 'math', '/home/kineret/kineret.com.br/zetas/themes/zetastheme/./scenes.tpl', 19, false),array('function', 'convertPrice', '/home/kineret/kineret.com.br/zetas/themes/zetastheme/./scenes.tpl', 24, false),array('modifier', 'escape', '/home/kineret/kineret.com.br/zetas/themes/zetastheme/./scenes.tpl', 18, false),array('modifier', 'date_format', '/home/kineret/kineret.com.br/zetas/themes/zetastheme/./scenes.tpl', 27, false),array('modifier', 'strip_tags', '/home/kineret/kineret.com.br/zetas/themes/zetastheme/./scenes.tpl', 35, false),array('modifier', 'truncate', '/home/kineret/kineret.com.br/zetas/themes/zetastheme/./scenes.tpl', 35, false),array('modifier', 'count', '/home/kineret/kineret.com.br/zetas/themes/zetastheme/./scenes.tpl', 48, false),)), $this); ?>
<?php if (scenes): ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['content_dir']; ?>
js/jquery/jquery.cluetip.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['content_dir']; ?>
js/jquery/jquery.scrollto.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['content_dir']; ?>
js/jquery/jquery.serialScroll.js"></script>
<script type="text/javascript">// <![CDATA[
i18n_scene_close = '<?php echo smartyTranslate(array('s' => 'Close'), $this);?>
';
$(function () {
	li_width = parseInt(<?php echo $this->_tpl_vars['thumbSceneImageType']['width']; ?>
 + 10);
});
//]]></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['js_dir']; ?>
scenes.js"></script>
<div id="scenes">
	<div>
		<?php $_from = $this->_tpl_vars['scenes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['scenes'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['scenes']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['scene_key'] => $this->_tpl_vars['scene']):
        $this->_foreach['scenes']['iteration']++;
?>
		<div class="screen_scene" id="screen_scene_<?php echo $this->_tpl_vars['scene']->id; ?>
" style="background:transparent url(img/scenes/<?php echo $this->_tpl_vars['scene']->id; ?>
-large_scene.jpg); height:<?php echo $this->_tpl_vars['largeSceneImageType']['height']; ?>
px; width:<?php echo $this->_tpl_vars['largeSceneImageType']['width']; ?>
px; <?php if (! ($this->_foreach['scenes']['iteration'] <= 1)): ?> display:none;<?php endif; ?>">
			<?php $_from = $this->_tpl_vars['scene']->products; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product_key'] => $this->_tpl_vars['product']):
?>
			<?php $this->assign('imageIds', ($this->_tpl_vars['product']['id_product'])."-".($this->_tpl_vars['product']['id_image'])); ?>
				<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" rel="#scene_products_cluetip_<?php echo $this->_tpl_vars['scene_key']; ?>
_<?php echo $this->_tpl_vars['product_key']; ?>
_<?php echo $this->_tpl_vars['product']['id_product']; ?>
" class="cluetip" style="width:<?php echo $this->_tpl_vars['product']['zone_width']; ?>
px; height:<?php echo $this->_tpl_vars['product']['zone_height']; ?>
px; margin-left:<?php echo $this->_tpl_vars['product']['x_axis']; ?>
px ;margin-top:<?php echo $this->_tpl_vars['product']['y_axis']; ?>
px;">
					<span style="margin-top:<?php echo smarty_function_math(array('equation' => 'a/2 -10','a' => $this->_tpl_vars['product']['zone_height']), $this);?>
px; margin-left:<?php echo smarty_function_math(array('equation' => 'a/2 -10','a' => $this->_tpl_vars['product']['zone_width']), $this);?>
px;">&nbsp;</span>
				</a>
				<div id="scene_products_cluetip_<?php echo $this->_tpl_vars['scene_key']; ?>
_<?php echo $this->_tpl_vars['product_key']; ?>
_<?php echo $this->_tpl_vars['product']['id_product']; ?>
" style="display:none;">
					<h4><span class="product_name"><?php echo $this->_tpl_vars['product']['details']->name; ?>
</span><?php if (isset ( $this->_tpl_vars['product']['details']->new ) && $this->_tpl_vars['product']['details']->new): ?><span class="new"><?php echo smartyTranslate(array('s' => 'new'), $this);?>
</span><?php endif; ?></h4>
					<div class="prices">
						<p class="price"><?php if ($this->_tpl_vars['priceDisplay']): ?><?php echo Product::convertPrice(array('price' => $this->_tpl_vars['product']['details']->getPrice(false,$this->_tpl_vars['product']['details']->getDefaultAttribute($this->_tpl_vars['product']['id_product']))), $this);?>
<?php else: ?><?php echo Product::convertPrice(array('price' => $this->_tpl_vars['product']['details']->getPrice(true,$this->_tpl_vars['product']['details']->getDefaultAttribute($this->_tpl_vars['product']['id_product']))), $this);?>
<?php endif; ?></p>
							<?php if ($this->_tpl_vars['product']['details']->on_sale): ?>
							<span class="on_sale"><?php echo smartyTranslate(array('s' => 'On sale!'), $this);?>
</span>
						<?php elseif (( $this->_tpl_vars['product']['details']->reduction_price != 0 || $this->_tpl_vars['product']['details']->reduction_percent != 0 ) && ( $this->_tpl_vars['product']['details']->reduction_from == $this->_tpl_vars['product']['details']->reduction_to || ( ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M:%S') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M:%S')) <= $this->_tpl_vars['product']['details']->reduction_to && ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M:%S') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M:%S')) >= $this->_tpl_vars['product']['details']->reduction_from ) )): ?>
							<span class="discount"><?php echo smartyTranslate(array('s' => 'Price lowered!'), $this);?>
</span>
						<?php endif; ?>
					</div>
					<div class="clear">
						<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['details']->name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
">
							<img src="<?php echo $this->_tpl_vars['link']->getImageLink($this->_tpl_vars['product']['id_product'],$this->_tpl_vars['imageIds'],'medium'); ?>
" alt="" />
						</a>
						<p class="description"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['product']['details']->description_short)) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 170, '...') : smarty_modifier_truncate($_tmp, 170, '...')); ?>
</p>
					</div>
				</div>
			<?php endforeach; endif; unset($_from); ?>
		</div>
		<?php endforeach; endif; unset($_from); ?>
	</div>
	<?php if (isset ( $this->_tpl_vars['scenes']['1'] )): ?>
	<div class="thumbs_banner" style="height:<?php echo $this->_tpl_vars['thumbSceneImageType']['height']; ?>
px;">
		<span class="space-keeper">
			<a class="prev" href="#" style="height:<?php echo smarty_function_math(array('equation' => 'a+2','a' => $this->_tpl_vars['thumbSceneImageType']['height']), $this);?>
px;" onclick="{next_scene_is_at_right = false; $(this).parent().next().trigger('stop').trigger('prev'); return false;}">&nbsp;</a>
		</span>
		<div id="scenes_list">
			<ul style="width:<?php echo smarty_function_math(array('equation' => '(a*b + (a-1)*10)','a' => count($this->_tpl_vars['scenes']),'b' => $this->_tpl_vars['thumbSceneImageType']['width']), $this);?>
px; height:<?php echo $this->_tpl_vars['thumbSceneImageType']['height']; ?>
px;">
			<?php $_from = $this->_tpl_vars['scenes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['scenes_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['scenes_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['scene']):
        $this->_foreach['scenes_list']['iteration']++;
?>
				<li id="scene_thumb_<?php echo $this->_tpl_vars['scene']->id; ?>
" style="<?php if (! ($this->_foreach['scenes_list']['iteration'] == $this->_foreach['scenes_list']['total'])): ?> padding-right:10px;<?php endif; ?>">
					<a style="width:<?php echo $this->_tpl_vars['thumbSceneImageType']['width']; ?>
px; height:<?php echo $this->_tpl_vars['thumbSceneImageType']['height']; ?>
px" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['scene']->name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" href="#" rel="<?php echo $this->_tpl_vars['scene']->id; ?>
" onclick="{loadScene(<?php echo $this->_tpl_vars['scene']->id; ?>
);return false;}">
						<img alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['scene']->name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" src="<?php echo $this->_tpl_vars['content_dir']; ?>
img/scenes/thumbs/<?php echo $this->_tpl_vars['scene']->id; ?>
-thumb_scene.jpg" />
					</a>
				</li>
		 	<?php endforeach; endif; unset($_from); ?>
		 	</ul>
		</div>
		<span class="space-keeper">
			<a class="next" href="#" style="height:<?php echo smarty_function_math(array('equation' => 'a+2','a' => $this->_tpl_vars['thumbSceneImageType']['height']), $this);?>
px;" onclick="{next_scene_is_at_right = true; $(this).parent().prev().trigger('stop').trigger('next'); return false;}">&nbsp;</a>
		</span>
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>