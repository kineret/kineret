<?php /* Smarty version 2.6.20, created on 2010-12-21 11:55:52
         compiled from /home/kineret/kineret.com.br/zetas/modules/blockpermanentlinks/blockpermanentlinks-header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/home/kineret/kineret.com.br/zetas/modules/blockpermanentlinks/blockpermanentlinks-header.tpl', 3, false),array('modifier', 'addslashes', '/home/kineret/kineret.com.br/zetas/modules/blockpermanentlinks/blockpermanentlinks-header.tpl', 6, false),)), $this); ?>
<!-- Block permanent links module HEADER -->
<ul id="header_links">
	<li id="header_link_contact"><a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
contact-form.php" title="<?php echo smartyTranslate(array('s' => 'contact','mod' => 'blockpermanentlinks'), $this);?>
"><?php echo smartyTranslate(array('s' => 'contact','mod' => 'blockpermanentlinks'), $this);?>
</a></li>
	<li id="header_link_sitemap"><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
sitemap.php" title="<?php echo smartyTranslate(array('s' => 'sitemap','mod' => 'blockpermanentlinks'), $this);?>
"><?php echo smartyTranslate(array('s' => 'sitemap','mod' => 'blockpermanentlinks'), $this);?>
</a></li>
	<li id="header_link_bookmark">
		<script type="text/javascript">writeBookmarkLink('<?php echo $this->_tpl_vars['come_from']; ?>
', '<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meta_title'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)))) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
', '<?php echo smartyTranslate(array('s' => 'bookmark','mod' => 'blockpermanentlinks'), $this);?>
');</script>
	</li>
</ul>
<!-- /Block permanent links module HEADER -->