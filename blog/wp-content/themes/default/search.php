<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

	<div id="content" class="narrowcolumn" role="main">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle">Achei isso. Dá uma olhada.</h2>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Posts Anteriores') ?></div>
			<div class="alignright"><?php previous_posts_link('Posts Recentes &raquo;') ?></div>
		</div>


		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?>>
				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<small><?php the_time('l, F jS, Y') ?></small>

				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('Sem Comentários &#187;', '1 Comentário &#187;', '% Comentários &#187;'); ?></p>
			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Posts Anteriores') ?></div>
			<div class="alignright"><?php previous_posts_link('Posts Recentes &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">Não achei! Mude os termos da busca.</h2>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
