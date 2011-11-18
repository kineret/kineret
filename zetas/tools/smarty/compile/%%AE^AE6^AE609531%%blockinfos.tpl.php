<?php /* Smarty version 2.6.20, created on 2010-12-21 11:53:27
         compiled from /home/kineret/kineret.com.br/zetas/modules/blockinfos/blockinfos.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/home/kineret/kineret.com.br/zetas/modules/blockinfos/blockinfos.tpl', 3, false),array('modifier', 'escape', '/home/kineret/kineret.com.br/zetas/modules/blockinfos/blockinfos.tpl', 6, false),)), $this); ?>
<!-- Block informations module -->
<div id="informations_block_left" class="block">
	<h4><?php echo smartyTranslate(array('s' => 'Information','mod' => 'blockinfos'), $this);?>
</h4>
	<ul class="block_content">
		<?php $_from = $this->_tpl_vars['cmslinks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cmslink']):
?>
			<li><a href="<?php echo $this->_tpl_vars['cmslink']['link']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['cmslink']['meta_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['cmslink']['meta_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>
</a></li>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<!-- /Block informations module -->