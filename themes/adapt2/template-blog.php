<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: Blog
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<header id="page-heading">
	<h1><span class="yellow">Read Our Minds</h1>		
</header>

<div class="post clearfix">

<?php
    //query posts
        query_posts(
            array(
            'post_type'=> 'post',
            'paged'=>$paged
        ));
    ?>
	<?php if (have_posts()) : ?>              
        	<?php get_template_part( 'loop', 'entry') ?>                	
    <?php endif; ?>       
	<?php pagination(); wp_reset_query(); ?>

</div>
<!-- /post -->

<?php endwhile; ?>
<?php endif; ?>

<script type="text/javascript">
jQuery(function($){
	$(document).ready(function(){
		var paras = $('.loop-entry').hide();
		i = 0;
		(function() {
		  $(paras[i++]).fadeIn(200, arguments.callee);
		})();	
	});
});
</script>
<?php get_footer(); ?>