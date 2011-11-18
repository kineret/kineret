<?php /* Smarty version 2.6.20, created on 2011-11-14 01:39:51
         compiled from /home/kineret/kineret.com.br/zetas/themes/zetastheme/footer.tpl */ ?>
		<?php if (! $this->_tpl_vars['content_only']): ?>
				</div>

<!-- Right -->
<div id="zetas">
<ul id="menu_zetas">
<li id="menu-grupos"><a href="../grupos/" title="Idades, Hor‡rio, Local, Professores..."><span class="bgimage">Grupos</span></a></li>
<li id="menu-fotos"><a href="../fotos/" title="Viagens, Apresenta›es, Eventos..."><span class="bgimage">Fotos</span></a></li> 
<li id="menu-depo"><a href="../depoimentos/" title="O que andam dizendo..."><span class="bgimage">Depoimentos</span></a></li>
<li id="menu-eventos"><a href="../eventos/" title="Veja onde estaremos..."><span class="bgimage">Loja Virtual</span></a></li> 
</ul>
</div>
				<div id="right_column" class="column">
					<?php echo $this->_tpl_vars['HOOK_RIGHT_COLUMN']; ?>

				</div>
			</div>

<!-- Footer -->
			<div id="footer"><?php echo $this->_tpl_vars['HOOK_FOOTER']; ?>
</div>
		</div>
	<?php endif; ?>
	</body>
</html>