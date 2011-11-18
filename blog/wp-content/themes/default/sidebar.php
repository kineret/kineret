<?php
/**
 * 			<?php /* If this is a category archive * } elseif (is_category()) { ?>
 *			<p>You are currently browsing the archives for the <?php single_cat_title(''); ?> category.</p>
 *
 *			<?php /* If this is a daily archive * } elseif (is_day()) { ?>
 *			<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a> blog archives
 *			for the day <?php the_time('l, F jS, Y'); ?>.</p>
 *
 *			<?php /* If this is a monthly archive * } elseif (is_month()) { ?>
 *			<p>Você filtrou os posts do mês <?php the_time('F, Y'); ?>.</p>
 *
 *			<?php /* If this is a yearly archive * } elseif (is_year()) { ?>
 *			<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a> blog archives
 *			for the year <?php the_time('Y'); ?>.</p>
 *
 *			<?php /* If this is a search result * } elseif (is_search()) { ?>
 *			<p>You have searched the <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a> blog archives
 *			for <strong>'<?php the_search_query(); ?>'</strong>. If you are unable to find anything in these search results, you can try one of these links.</p>
 *
 *			<?php /* If this set is paginated * } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
 *			<p>Você selecionou a opção <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a> blog archives.</p>
 * 
 * @package WordPress
 * @subpackage Default_Theme
 */
?>
	<div id="sidebar" role="complementary">
		<!-- <ul>
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
			<li>
				<?php get_search_form(); ?>
			</li>
-->
			<!-- Author information is disabled per default. Uncomment and fill in your details if you want to use it.
			<li><h2>Author</h2>
			<p>A little something about you, the author. Nothing lengthy, just an overview.</p>
			</li>
			-->
<!--
			<?php if ( is_404() || is_category() || is_day() || is_month() ||
						is_year() || is_search() || is_paged() ) {
			?> <li>

			<?php /* If this is a 404 page */ if (is_404()) { ?>

			<?php } ?>

			</li>
		<?php }?>
		</ul>
		<ul role="navigation">
			<?php wp_list_categories('show_count=1&title_li=<h2>Escolha por Evento</h2>'); ?>

			<li><h2>Escolha por Data</h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>

			
		</ul>
		<ul>
			<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>

				
			<?php } ?>

			<?php endif; ?>
		</ul> -->
			<h2 style="display:block;float:right;width:400px;padding:0px 0px 0px;text-align:center;text-decoration:none;font-family: helvetica, arial, sans-serif;letter-spacing:-1px;color:#fdb813;font-size:16pt;font-weight:normal;">Mural do Kineret</h2>
			<h2 style="display:block;float:right;width:400px;padding:0px 0px 20px;text-align:center;text-decoration:none;font-family: helvetica, arial, sans-serif;letter-spacing:-1px;color:#525252;font-size:8pt;font-weight:normal;">É necessário possuir Facebook para visualizar o Mural</h2>
		
			<div id="fb-root"></div>
			<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
			<fb:fan profile_id="136305039732604" stream="1" connections="14" width="430"></fb:fan>
		
		
		
	</div>

