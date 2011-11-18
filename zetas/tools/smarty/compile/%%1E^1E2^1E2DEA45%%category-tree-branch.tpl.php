<?php /* Smarty version 2.6.20, created on 2010-12-21 11:53:27
         compiled from /home/kineret/kineret.com.br/zetas/modules/blockcategories/category-tree-branch.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/home/kineret/kineret.com.br/zetas/modules/blockcategories/category-tree-branch.tpl', 2, false),array('modifier', 'count', '/home/kineret/kineret.com.br/zetas/modules/blockcategories/category-tree-branch.tpl', 3, false),)), $this); ?>
<li <?php if ($this->_tpl_vars['last'] == 'true'): ?>class="last"<?php endif; ?>>
	<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['node']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>
" <?php if ($this->_tpl_vars['node']['id'] == $this->_tpl_vars['currentCategoryId']): ?>class="selected"<?php endif; ?> title="<?php echo ((is_array($_tmp=$this->_tpl_vars['node']['desc'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['node']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>
</a>
	<?php if (count($this->_tpl_vars['node']['children']) > 0): ?>
		<ul>
		<?php $_from = $this->_tpl_vars['node']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['categoryTreeBranch'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['categoryTreeBranch']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['child']):
        $this->_foreach['categoryTreeBranch']['iteration']++;
?>
			<?php if (($this->_foreach['categoryTreeBranch']['iteration'] == $this->_foreach['categoryTreeBranch']['total'])): ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['branche_tpl_path'], 'smarty_include_vars' => array('node' => $this->_tpl_vars['child'],'last' => 'true')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['branche_tpl_path'], 'smarty_include_vars' => array('node' => $this->_tpl_vars['child'],'last' => 'false')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
	<?php endif; ?>
</li>