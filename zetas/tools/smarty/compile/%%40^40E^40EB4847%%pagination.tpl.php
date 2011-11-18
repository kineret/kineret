<?php /* Smarty version 2.6.20, created on 2010-12-20 19:39:35
         compiled from /home/kineret/kineret.com.br/zetas/themes/zetastheme/./pagination.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'intval', '/home/kineret/kineret.com.br/zetas/themes/zetastheme/./pagination.tpl', 2, false),array('modifier', 'escape', '/home/kineret/kineret.com.br/zetas/themes/zetastheme/./pagination.tpl', 31, false),array('function', 'l', '/home/kineret/kineret.com.br/zetas/themes/zetastheme/./pagination.tpl', 21, false),)), $this); ?>
<?php if (isset ( $this->_tpl_vars['p'] ) && $this->_tpl_vars['p']): ?>
	<?php if (((is_array($_tmp=$_GET['id_category'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp))): ?>
		<?php $this->assign('requestPage', $this->_tpl_vars['link']->getPaginationLink('category',$this->_tpl_vars['category'],false,false,true,false)); ?>
		<?php $this->assign('requestNb', $this->_tpl_vars['link']->getPaginationLink('category',$this->_tpl_vars['category'],true,false,false,true)); ?>
	<?php elseif (((is_array($_tmp=$_GET['id_manufacturer'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp))): ?>
		<?php $this->assign('requestPage', $this->_tpl_vars['link']->getPaginationLink('manufacturer',$this->_tpl_vars['manufacturer'],false,false,true,false)); ?>
		<?php $this->assign('requestNb', $this->_tpl_vars['link']->getPaginationLink('manufacturer',$this->_tpl_vars['manufacturer'],true,false,false,true)); ?>
	<?php elseif (((is_array($_tmp=$_GET['id_supplier'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp))): ?>
		<?php $this->assign('requestPage', $this->_tpl_vars['link']->getPaginationLink('supplier',$this->_tpl_vars['supplier'],false,false,true,false)); ?>
		<?php $this->assign('requestNb', $this->_tpl_vars['link']->getPaginationLink('supplier',$this->_tpl_vars['supplier'],true,false,false,true)); ?>
	<?php else: ?>
		<?php $this->assign('requestPage', $this->_tpl_vars['link']->getPaginationLink(false,false,false,false,true,false)); ?>
		<?php $this->assign('requestNb', $this->_tpl_vars['link']->getPaginationLink(false,false,true,false,false,true)); ?>
	<?php endif; ?>
	<!-- Pagination -->
	<div id="pagination" class="pagination">
	<?php if ($this->_tpl_vars['start'] != $this->_tpl_vars['stop']): ?>
		<ul class="pagination">
		<?php if ($this->_tpl_vars['p'] != 1): ?>
			<?php $this->assign('p_previous', $this->_tpl_vars['p']-1); ?>
			<li id="pagination_previous"><a href="<?php echo $this->_tpl_vars['link']->goPage($this->_tpl_vars['requestPage'],$this->_tpl_vars['p_previous']); ?>
">&laquo;&nbsp;<?php echo smartyTranslate(array('s' => 'Previous'), $this);?>
</a></li>
		<?php else: ?>
			<li id="pagination_previous" class="disabled"><span>&laquo;&nbsp;<?php echo smartyTranslate(array('s' => 'Previous'), $this);?>
</span></li>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['start'] > 3): ?>
			<li><a href="<?php echo $this->_tpl_vars['link']->goPage($this->_tpl_vars['requestPage'],1); ?>
">1</a></li>
			<li class="truncate">...</li>
		<?php endif; ?>
		<?php unset($this->_sections['pagination']);
$this->_sections['pagination']['name'] = 'pagination';
$this->_sections['pagination']['start'] = (int)$this->_tpl_vars['start'];
$this->_sections['pagination']['loop'] = is_array($_loop=$this->_tpl_vars['stop']+1) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pagination']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['pagination']['show'] = true;
$this->_sections['pagination']['max'] = $this->_sections['pagination']['loop'];
if ($this->_sections['pagination']['start'] < 0)
    $this->_sections['pagination']['start'] = max($this->_sections['pagination']['step'] > 0 ? 0 : -1, $this->_sections['pagination']['loop'] + $this->_sections['pagination']['start']);
else
    $this->_sections['pagination']['start'] = min($this->_sections['pagination']['start'], $this->_sections['pagination']['step'] > 0 ? $this->_sections['pagination']['loop'] : $this->_sections['pagination']['loop']-1);
if ($this->_sections['pagination']['show']) {
    $this->_sections['pagination']['total'] = min(ceil(($this->_sections['pagination']['step'] > 0 ? $this->_sections['pagination']['loop'] - $this->_sections['pagination']['start'] : $this->_sections['pagination']['start']+1)/abs($this->_sections['pagination']['step'])), $this->_sections['pagination']['max']);
    if ($this->_sections['pagination']['total'] == 0)
        $this->_sections['pagination']['show'] = false;
} else
    $this->_sections['pagination']['total'] = 0;
if ($this->_sections['pagination']['show']):

            for ($this->_sections['pagination']['index'] = $this->_sections['pagination']['start'], $this->_sections['pagination']['iteration'] = 1;
                 $this->_sections['pagination']['iteration'] <= $this->_sections['pagination']['total'];
                 $this->_sections['pagination']['index'] += $this->_sections['pagination']['step'], $this->_sections['pagination']['iteration']++):
$this->_sections['pagination']['rownum'] = $this->_sections['pagination']['iteration'];
$this->_sections['pagination']['index_prev'] = $this->_sections['pagination']['index'] - $this->_sections['pagination']['step'];
$this->_sections['pagination']['index_next'] = $this->_sections['pagination']['index'] + $this->_sections['pagination']['step'];
$this->_sections['pagination']['first']      = ($this->_sections['pagination']['iteration'] == 1);
$this->_sections['pagination']['last']       = ($this->_sections['pagination']['iteration'] == $this->_sections['pagination']['total']);
?>
			<?php if ($this->_tpl_vars['p'] == $this->_sections['pagination']['index']): ?>
				<li class="current"><span><?php echo ((is_array($_tmp=$this->_tpl_vars['p'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</span></li>
			<?php else: ?>
				<li><a href="<?php echo $this->_tpl_vars['link']->goPage($this->_tpl_vars['requestPage'],$this->_sections['pagination']['index']); ?>
"><?php echo ((is_array($_tmp=$this->_sections['pagination']['index'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</a></li>
			<?php endif; ?>
		<?php endfor; endif; ?>
		<?php if ($this->_tpl_vars['pages_nb'] > $this->_tpl_vars['stop']+2): ?>
			<li class="truncate">...</li>
			<li><a href="<?php echo $this->_tpl_vars['link']->goPage($this->_tpl_vars['requestPage'],$this->_tpl_vars['pages_nb']); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['pages_nb'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
</a></li>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['pages_nb'] > 1 && $this->_tpl_vars['p'] != $this->_tpl_vars['pages_nb']): ?>
			<?php $this->assign('p_next', $this->_tpl_vars['p']+1); ?>
			<li id="pagination_next"><a href="<?php echo $this->_tpl_vars['link']->goPage($this->_tpl_vars['requestPage'],$this->_tpl_vars['p_next']); ?>
"><?php echo smartyTranslate(array('s' => 'Next'), $this);?>
&nbsp;&raquo;</a></li>
		<?php else: ?>
			<li id="pagination_next" class="disabled"><span><?php echo smartyTranslate(array('s' => 'Next'), $this);?>
&nbsp;&raquo;</span></li>
		<?php endif; ?>
		</ul>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['nb_products'] > 10): ?>
		<form action="<?php if (! is_array ( $this->_tpl_vars['requestNb'] )): ?><?php echo $this->_tpl_vars['requestNb']; ?>
<?php else: ?><?php echo $this->_tpl_vars['requestNb']['requestUrl']; ?>
<?php endif; ?>" method="get" class="pagination">
			<p>
				<?php if (isset ( $this->_tpl_vars['query'] ) && $this->_tpl_vars['query']): ?><input type="hidden" name="search_query" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['query'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" /><?php endif; ?>
				<?php if (isset ( $this->_tpl_vars['tag'] ) && $this->_tpl_vars['tag'] && ! is_array ( $this->_tpl_vars['tag'] )): ?><input type="hidden" name="tag" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['tag'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" /><?php endif; ?>
				<input type="submit" class="button_mini" value="<?php echo smartyTranslate(array('s' => 'OK'), $this);?>
" />
				<label for="nb_item"><?php echo smartyTranslate(array('s' => 'items:'), $this);?>
</label>
				<select name="n" id="nb_item">
				<?php $_from = $this->_tpl_vars['nArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['nValue']):
?>
					<?php if ($this->_tpl_vars['nValue'] <= $this->_tpl_vars['nb_products']): ?>
						<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['nValue'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" <?php if ($this->_tpl_vars['n'] == $this->_tpl_vars['nValue']): ?>selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['nValue'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</option>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
				</select>
				<?php if (is_array ( $this->_tpl_vars['requestNb'] )): ?>
					<?php $_from = $this->_tpl_vars['requestNb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['requestKey'] => $this->_tpl_vars['requestValue']):
?>
						<?php if ($this->_tpl_vars['requestKey'] != 'requestUrl'): ?>
							<input type="hidden" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['requestKey'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['requestValue'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" />
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
				<?php endif; ?>
			</p>
		</form>
	<?php endif; ?>
	</div>
	<!-- /Pagination -->
<?php endif; ?>