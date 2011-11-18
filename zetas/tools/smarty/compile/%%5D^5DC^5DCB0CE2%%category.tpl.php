<?php /* Smarty version 2.6.20, created on 2010-12-20 19:39:34
         compiled from /home/kineret/kineret.com.br/zetas/themes/zetastheme/category.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/home/kineret/kineret.com.br/zetas/themes/zetastheme/category.tpl', 6, false),array('function', 'l', '/home/kineret/kineret.com.br/zetas/themes/zetastheme/category.tpl', 8, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./errors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['category']->id && $this->_tpl_vars['category']->active): ?>
	<h2 class="category_title"><?php echo ''; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['category']->name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?><?php echo '<span>'; ?><?php if ($this->_tpl_vars['nb_products'] == 0): ?><?php echo ''; ?><?php echo smartyTranslate(array('s' => 'There are no products.'), $this);?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php if ($this->_tpl_vars['nb_products'] == 1): ?><?php echo ''; ?><?php echo smartyTranslate(array('s' => 'There is'), $this);?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smartyTranslate(array('s' => 'There are'), $this);?><?php echo ''; ?><?php endif; ?><?php echo '&#160;'; ?><?php echo $this->_tpl_vars['nb_products']; ?><?php echo '&#160;'; ?><?php if ($this->_tpl_vars['nb_products'] == 1): ?><?php echo ''; ?><?php echo smartyTranslate(array('s' => 'product.'), $this);?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smartyTranslate(array('s' => 'products.'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo '</span>'; ?>

	</h2>

	<?php if ($this->_tpl_vars['scenes']): ?>
		<!-- Scenes -->
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./scenes.tpl", 'smarty_include_vars' => array('scenes' => $this->_tpl_vars['scenes'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
		<!-- Category image -->
		<?php if ($this->_tpl_vars['category']->id_image): ?>
		<div class="align_center">
			<img src="<?php echo $this->_tpl_vars['link']->getCatImageLink($this->_tpl_vars['category']->link_rewrite,$this->_tpl_vars['category']->id_image,'category'); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['category']->name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['category']->name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" id="categoryImage" />
		</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['category']->description): ?>
		<div class="cat_desc"><?php echo $this->_tpl_vars['category']->description; ?>
</div>
	<?php endif; ?>
	<?php if (isset ( $this->_tpl_vars['subcategories'] )): ?>
	<!-- Subcategories -->
	<div id="subcategories">
		<h3><?php echo smartyTranslate(array('s' => 'Subcategories'), $this);?>
</h3>
		<ul class="inline_list">
		<?php $_from = $this->_tpl_vars['subcategories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subcategory']):
?>
			<li>
				<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['link']->getCategoryLink($this->_tpl_vars['subcategory']['id_category'],$this->_tpl_vars['subcategory']['link_rewrite']))) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['subcategory']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
">
					<?php if ($this->_tpl_vars['subcategory']['id_image']): ?>
						<img src="<?php echo $this->_tpl_vars['link']->getCatImageLink($this->_tpl_vars['subcategory']['link_rewrite'],$this->_tpl_vars['subcategory']['id_image'],'medium'); ?>
" alt="" />
					<?php else: ?>
						<img src="<?php echo $this->_tpl_vars['img_cat_dir']; ?>
default-medium.jpg" alt="" />
					<?php endif; ?>
				</a>
				<br />
				<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['link']->getCategoryLink($this->_tpl_vars['subcategory']['id_category'],$this->_tpl_vars['subcategory']['link_rewrite']))) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['subcategory']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</a>
			</li>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
		<br class="clear"/>
	</div>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['products']): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./product-sort.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./product-list.tpl", 'smarty_include_vars' => array('products' => $this->_tpl_vars['products'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./pagination.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php elseif (! isset ( $this->_tpl_vars['subcategories'] )): ?>
			<p class="warning"><?php echo smartyTranslate(array('s' => 'There are no products in this category.'), $this);?>
</p>
		<?php endif; ?>
<?php elseif ($this->_tpl_vars['category']->id): ?>
	<p class="warning"><?php echo smartyTranslate(array('s' => 'This category is currently unavailable.'), $this);?>
</p>
<?php endif; ?>