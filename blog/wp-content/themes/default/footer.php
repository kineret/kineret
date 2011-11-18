<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>


<div id="footer" role="contentinfo">
<!-- If you'd like to support WordPress, having the "powered by" link somewhere on your blog is the best way; it's our only promotion or advertising. -->
	<p>
		O blog do <?php bloginfo('name'); ?> é gerado pelo 
		<a href="http://wordpress.org/">WordPress</a>
		<br /><a href="<?php bloginfo('rss2_url'); ?>">Posts (RSS)</a>
		e <a href="<?php bloginfo('comments_rss2_url'); ?>">Comentarios (RSS)</a>.
		<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->
	</p>
</div>
</div>

<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/kubrick/ -->
<?php /* "Just what do you think you're doing Dave?" */ ?>

		<?php wp_footer(); ?>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-8926866-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
