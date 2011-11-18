<?php /* Smarty version 2.6.20, created on 2010-12-30 14:41:44
         compiled from /home/kineret/kineret.com.br/zetas/modules/blockcart/blockcart-json.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'addslashes', '/home/kineret/kineret.com.br/zetas/modules/blockcart/blockcart-json.tpl', 9, false),array('modifier', 'html_entity_decode', '/home/kineret/kineret.com.br/zetas/modules/blockcart/blockcart-json.tpl', 11, false),array('modifier', 'truncate', '/home/kineret/kineret.com.br/zetas/modules/blockcart/blockcart-json.tpl', 12, false),array('modifier', 'cat', '/home/kineret/kineret.com.br/zetas/modules/blockcart/blockcart-json.tpl', 58, false),array('function', 'displayWtPrice', '/home/kineret/kineret.com.br/zetas/modules/blockcart/blockcart-json.tpl', 11, false),array('function', 'convertPrice', '/home/kineret/kineret.com.br/zetas/modules/blockcart/blockcart-json.tpl', 62, false),)), $this); ?>
{
'products': [
<?php if ($this->_tpl_vars['products']): ?>
<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['products'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['products']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['products']['iteration']++;
?>
<?php $this->assign('productId', $this->_tpl_vars['product']['id_product']); ?>
<?php $this->assign('productAttributeId', $this->_tpl_vars['product']['id_product_attribute']); ?>
	{
		'id':            <?php echo $this->_tpl_vars['product']['id_product']; ?>
,
		'link':          '<?php echo ((is_array($_tmp=$this->_tpl_vars['link']->getProductLink($this->_tpl_vars['product']['id_product'],$this->_tpl_vars['product']['link_rewrite'],$this->_tpl_vars['product']['category']))) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
',
		'quantity':      <?php echo $this->_tpl_vars['product']['cart_quantity']; ?>
,
		'priceByLine':   '<?php if ($this->_tpl_vars['priceDisplay'] == @PS_TAX_EXC): ?><?php echo ((is_array($_tmp=Product::displayWtPrice(array('p' => $this->_tpl_vars['product']['total']), $this))) ? $this->_run_mod_handler('html_entity_decode', true, $_tmp, 2, 'UTF-8') : html_entity_decode($_tmp, 2, 'UTF-8'));?>
<?php else: ?><?php echo ((is_array($_tmp=Product::displayWtPrice(array('p' => $this->_tpl_vars['product']['total_wt']), $this))) ? $this->_run_mod_handler('html_entity_decode', true, $_tmp, 2, 'UTF-8') : html_entity_decode($_tmp, 2, 'UTF-8'));?>
<?php endif; ?>',
		'name':          '<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['product']['name'])) ? $this->_run_mod_handler('html_entity_decode', true, $_tmp, 2, 'UTF-8') : html_entity_decode($_tmp, 2, 'UTF-8')))) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 15, '...', true) : smarty_modifier_truncate($_tmp, 15, '...', true)); ?>
',
		'price':         '<?php if ($this->_tpl_vars['priceDisplay'] == @PS_TAX_EXC): ?><?php echo ((is_array($_tmp=Product::displayWtPrice(array('p' => $this->_tpl_vars['product']['total']), $this))) ? $this->_run_mod_handler('html_entity_decode', true, $_tmp, 2, 'UTF-8') : html_entity_decode($_tmp, 2, 'UTF-8'));?>
<?php else: ?><?php echo ((is_array($_tmp=Product::displayWtPrice(array('p' => $this->_tpl_vars['product']['total_wt']), $this))) ? $this->_run_mod_handler('html_entity_decode', true, $_tmp, 2, 'UTF-8') : html_entity_decode($_tmp, 2, 'UTF-8'));?>
<?php endif; ?>',
		'idCombination': <?php if (isset ( $this->_tpl_vars['product']['attributes_small'] )): ?><?php echo $this->_tpl_vars['productAttributeId']; ?>
<?php else: ?>0<?php endif; ?>,
<?php if (isset ( $this->_tpl_vars['product']['attributes_small'] )): ?>
		'hasAttributes': true,
		'attributes':    '<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['attributes_small'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
',
<?php else: ?>
		'hasAttributes': false,
<?php endif; ?>
		'hasCustomizedDatas': <?php if (isset ( $this->_tpl_vars['customizedDatas'][$this->_tpl_vars['productId']][$this->_tpl_vars['productAttributeId']] )): ?>true<?php else: ?>false<?php endif; ?>,

		'customizedDatas':[
		<?php $_from = $this->_tpl_vars['customizedDatas'][$this->_tpl_vars['productId']][$this->_tpl_vars['productAttributeId']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['customizedDatas'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['customizedDatas']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['id_customization'] => $this->_tpl_vars['customization']):
        $this->_foreach['customizedDatas']['iteration']++;
?>{

			'customizationId':	<?php echo $this->_tpl_vars['id_customization']; ?>
,
			'quantity':			<?php echo $this->_tpl_vars['customization']['quantity']; ?>
,
			'datas': [
				<?php $_from = $this->_tpl_vars['customization']['datas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['customization'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['customization']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['type'] => $this->_tpl_vars['datas']):
        $this->_foreach['customization']['iteration']++;
?>
				{
					'type':	<?php echo $this->_tpl_vars['type']; ?>
,
					'datas':
					[
					<?php $_from = $this->_tpl_vars['datas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['datas'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['datas']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['data']):
        $this->_foreach['datas']['iteration']++;
?>
						{
						'index':			<?php echo $this->_tpl_vars['index']; ?>
,
						'value':			'<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['value'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
',
						'truncatedValue':	'<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['data']['value'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 28, '...') : smarty_modifier_truncate($_tmp, 28, '...')))) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
'
						}<?php if (! ($this->_foreach['datas']['iteration'] == $this->_foreach['datas']['total'])): ?>,<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>]
				}<?php if (! ($this->_foreach['customization']['iteration'] == $this->_foreach['customization']['total'])): ?>,<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			]
		}<?php if (! ($this->_foreach['customizedDatas']['iteration'] == $this->_foreach['customizedDatas']['total'])): ?>,<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		]


	}<?php if (! ($this->_foreach['products']['iteration'] == $this->_foreach['products']['total'])): ?>,<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php endif; ?>
],

'discounts': [
<?php if ($this->_tpl_vars['discounts']): ?><?php $_from = $this->_tpl_vars['discounts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['discounts'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['discounts']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['discount']):
        $this->_foreach['discounts']['iteration']++;
?>
	{
		'id':              '<?php echo $this->_tpl_vars['discount']['id_discount']; ?>
',
		'name':            '<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['discount']['name'])) ? $this->_run_mod_handler('cat', true, $_tmp, ' : ') : smarty_modifier_cat($_tmp, ' : ')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['discount']['description']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['discount']['description'])))) ? $this->_run_mod_handler('truncate', true, $_tmp, 18, '...') : smarty_modifier_truncate($_tmp, 18, '...')))) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
',
		'description':     '<?php echo ((is_array($_tmp=$this->_tpl_vars['discount']['description'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
',
		'nameDescription': '<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['discount']['name'])) ? $this->_run_mod_handler('cat', true, $_tmp, ' : ') : smarty_modifier_cat($_tmp, ' : ')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['discount']['description']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['discount']['description'])))) ? $this->_run_mod_handler('truncate', true, $_tmp, 18, '...') : smarty_modifier_truncate($_tmp, 18, '...')); ?>
',
		'link':            '<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
order.php?deleteDiscount=<?php echo $this->_tpl_vars['discount']['id_discount']; ?>
',
		'price':           '-<?php if ($this->_tpl_vars['priceDisplay'] == 1): ?><?php echo ((is_array($_tmp=Product::convertPrice(array('price' => $this->_tpl_vars['discount']['value_tax_exc']), $this))) ? $this->_run_mod_handler('html_entity_decode', true, $_tmp, 2, 'UTF-8') : html_entity_decode($_tmp, 2, 'UTF-8'));?>
<?php else: ?><?php echo ((is_array($_tmp=Product::convertPrice(array('price' => $this->_tpl_vars['discount']['value_real']), $this))) ? $this->_run_mod_handler('html_entity_decode', true, $_tmp, 2, 'UTF-8') : html_entity_decode($_tmp, 2, 'UTF-8'));?>
<?php endif; ?>'
	}
	<?php if (! ($this->_foreach['discounts']['iteration'] == $this->_foreach['discounts']['total'])): ?>,<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php endif; ?>
],

'shippingCost': '<?php echo ((is_array($_tmp=$this->_tpl_vars['shipping_cost'])) ? $this->_run_mod_handler('html_entity_decode', true, $_tmp, 2, 'UTF-8') : html_entity_decode($_tmp, 2, 'UTF-8')); ?>
',
'wrappingCost': '<?php echo ((is_array($_tmp=$this->_tpl_vars['wrapping_cost'])) ? $this->_run_mod_handler('html_entity_decode', true, $_tmp, 2, 'UTF-8') : html_entity_decode($_tmp, 2, 'UTF-8')); ?>
',
'nbTotalProducts': '<?php echo $this->_tpl_vars['nb_total_products']; ?>
',
'total': '<?php echo ((is_array($_tmp=$this->_tpl_vars['total'])) ? $this->_run_mod_handler('html_entity_decode', true, $_tmp, 2, 'UTF-8') : html_entity_decode($_tmp, 2, 'UTF-8')); ?>
',
'productTotal': '<?php echo ((is_array($_tmp=$this->_tpl_vars['product_total'])) ? $this->_run_mod_handler('html_entity_decode', true, $_tmp, 2, 'UTF-8') : html_entity_decode($_tmp, 2, 'UTF-8')); ?>
',

<?php if (isset ( $this->_tpl_vars['errors'] ) && $this->_tpl_vars['errors']): ?>
'hasError' : true,
errors : [
<?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['errors'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['errors']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['error']):
        $this->_foreach['errors']['iteration']++;
?>
	'<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['error'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)))) ? $this->_run_mod_handler('html_entity_decode', true, $_tmp, 2, 'UTF-8') : html_entity_decode($_tmp, 2, 'UTF-8')); ?>
'
	<?php if (! ($this->_foreach['errors']['iteration'] == $this->_foreach['errors']['total'])): ?>,<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
]
<?php else: ?>
'hasError' : false
<?php endif; ?>

}