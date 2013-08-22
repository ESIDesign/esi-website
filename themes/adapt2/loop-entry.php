<?php
while (have_posts()) : the_post();
//get featured img
$feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
?>  

<article class="loop-entry clearfix">
	<?php if($feat_img) { ?>
    	<a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>" class="loop-entry-thumbnail"><img src="<?php echo $feat_img[0]; ?>" alt="<?php echo the_title(); ?>" /></a>
	<?php } ?>
	<p class="date"><?php the_time('F'); ?> <?php the_time('j'); ?>, <?php the_time('Y'); ?></p>
	<h2><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
    <?php
	//show meta only on blog posts
    if ( get_post_type() != 'page' || get_post_type() != 'project') { ?>
	<div class="loop-entry-meta">
        <p class="by"><?php _e('By', 'surplus'); ?> <a href="<?php echo get_site_url(); ?>/people"><?php the_author(); ?></a>
<!--         <span class="awesome-icon-comments"></span> <?php comments_popup_link('0', '1', '%'); ?></p> -->
    </div>
    <!-- /loop-entry-meta -->
    <?php } ?>
	<?php the_excerpt(''); ?>
</article>
<!-- loop-entry -->

<?php endwhile; ?>

<script type="text/javascript">
jQuery(function($){
	$(document).ready(function(){
var paras = $('.loop-entry').hide(),
    i = 0;

// If using jQuery 1.3 or lower, you need to do $(paras[i++] || []) to avoid an "undefined" error
(function() {
  $(paras[i++]).fadeIn(200, arguments.callee);
})();
});
});
</script>