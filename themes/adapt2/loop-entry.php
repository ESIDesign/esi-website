<?php
while (have_posts()) : the_post();
//get featured img
$feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
?>  

<article class="loop-entry clearfix">
	<?php if($feat_img) { ?>
    	<a href="<?php the_permalink(' ') ?>" class="loop-entry-thumbnail"><img src="<?php echo $feat_img[0]; ?>" alt="<?php echo the_title(); ?>" /></a>
	<?php } ?>
	<div class="text">
	<p class="date"><?php the_time('F'); ?> <?php the_time('j'); ?>, <?php the_time('Y'); ?></p>
	<h2><a href="<?php the_permalink(' ') ?>?iframe" rel="lightbox" data-ob="lightbox" data-ob_iframe="true"> 
	<?php $title = get_the_title(); 
			        echo substr($title, 0, 40);
			        if(strlen($title) > 40) {
				        echo '...';
			        }  ?>
	</a></h2>
    <?php
	//show meta only on blog posts
    if ( get_post_type() != 'page' || get_post_type() != 'project') { ?>
	<div class="loop-entry-meta">
        <p class="by"><?php _e('By', 'surplus'); ?> <a href="<?php echo get_site_url(); ?>/people"><?php the_author(); ?></a>
<!-- <span class="awesome-icon-comments"></span> <?php comments_popup_link('0', '1', '%'); ?></p> -->
    </div>
    <!-- /loop-entry-meta -->
    <?php } ?>
	<?php echo get_excerpt(195); ?>
	</div>
</article>
<!-- loop-entry -->

<?php endwhile; ?>
