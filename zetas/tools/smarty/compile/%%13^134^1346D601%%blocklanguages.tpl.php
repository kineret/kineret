<?php /* Smarty version 2.6.20, created on 2010-12-21 11:32:39
         compiled from /home/kineret/kineret.com.br/zetas/modules/blocklanguages/blocklanguages.tpl */ ?>
<!-- Block languages module -->
<div id="languages_block_top">
	<ul id="first-languages">
		<?php $_from = $this->_tpl_vars['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['languages'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['languages']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['language']):
        $this->_foreach['languages']['iteration']++;
?>
			<li <?php if ($this->_tpl_vars['language']['iso_code'] == $this->_tpl_vars['lang_iso']): ?>class="selected_language"<?php endif; ?>>
				<?php if ($this->_tpl_vars['language']['iso_code'] != $this->_tpl_vars['lang_iso']): ?><a href="<?php echo $this->_tpl_vars['link']->getLanguageLink($this->_tpl_vars['language']['id_lang'],$this->_tpl_vars['language']['name']); ?>
" title="<?php echo $this->_tpl_vars['language']['name']; ?>
"><?php endif; ?>
					<img src="<?php echo $this->_tpl_vars['img_lang_dir']; ?>
<?php echo $this->_tpl_vars['language']['id_lang']; ?>
.jpg" alt="<?php echo $this->_tpl_vars['language']['iso_code']; ?>
" width="16" height="11" />
				<?php if ($this->_tpl_vars['language']['iso_code'] != $this->_tpl_vars['lang_iso']): ?></a><?php endif; ?>
			</li>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<script type="text/javascript">
	$('ul#first-languages li:not(.selected_language)').css('opacity', 0.3);
	$('ul#first-languages li:not(.selected_language)').hover(function(){
		$(this).css('opacity', 1);
	}, function(){
		$(this).css('opacity', 0.3);
	});
</script>
<!-- /Block languages module -->
