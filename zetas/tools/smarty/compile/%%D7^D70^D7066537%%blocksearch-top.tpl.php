<?php /* Smarty version 2.6.20, created on 2010-12-21 11:32:39
         compiled from /home/kineret/kineret.com.br/zetas/modules/blocksearch/blocksearch-top.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlentities', '/home/kineret/kineret.com.br/zetas/modules/blocksearch/blocksearch-top.tpl', 8, false),array('modifier', 'stripslashes', '/home/kineret/kineret.com.br/zetas/modules/blocksearch/blocksearch-top.tpl', 8, false),array('function', 'l', '/home/kineret/kineret.com.br/zetas/modules/blocksearch/blocksearch-top.tpl', 9, false),)), $this); ?>
<!-- Block search module TOP -->
<div id="search_block_top">
	<form method="get" action="<?php echo $this->_tpl_vars['base_dir']; ?>
search.php" id="searchbox">
	<p>
		<label for="search_query"><!-- image on background --></label>
		<input type="hidden" name="orderby" value="position" />
		<input type="hidden" name="orderway" value="desc" />
		<input type="text" id="search_query" name="search_query" value="<?php if (isset ( $_GET['search_query'] )): ?><?php echo ((is_array($_tmp=((is_array($_tmp=$_GET['search_query'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp, $this->_tpl_vars['ENT_QUOTES'], 'utf-8') : htmlentities($_tmp, $this->_tpl_vars['ENT_QUOTES'], 'utf-8')))) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
<?php endif; ?>" />
		<input type="submit" name="submit_search" value="<?php echo smartyTranslate(array('s' => 'Search','mod' => 'blocksearch'), $this);?>
" class="button" />
	</p>
	</form>
</div>
<?php if ($this->_tpl_vars['ajaxsearch']): ?>
	<script type="text/javascript"><?php echo '
		$(\'document\').ready( function() {
			$("#search_query")
				.autocomplete(
					\''; ?>
<?php if ($this->_tpl_vars['search_ssl'] == 1): ?><?php echo $this->_tpl_vars['base_dir_ssl']; ?>
<?php else: ?><?php echo $this->_tpl_vars['base_dir']; ?>
<?php endif; ?><?php echo 'search.php\', {
						minChars: 3,
						max: 10,
						width: 500,
						selectFirst: false,
						scroll: false,
						dataType: "json",
						formatItem: function(data, i, max, value, term) {
							return value;
						},
						parse: function(data) {
							var mytab = new Array();
							for (var i = 0; i < data.length; i++) {
								mytab[mytab.length] = { 
									data: data[i], 
									value: data[i].cname + \' > \' + data[i].pname 
								};
							}
							return mytab;
						},
						extraParams: {
							ajaxSearch: 1,
							id_lang: '; ?>
<?php echo $this->_tpl_vars['cookie']->id_lang; ?>
<?php echo '
						}
					}
				)
				.result(function(event, data, formatted) {
					$(\'#search_query\').val(data.pname);
					document.location.href = data.product_link;
				})
		});'; ?>

	</script>
<?php endif; ?>
<!-- /Block search module TOP -->