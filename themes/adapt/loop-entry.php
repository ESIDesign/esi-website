<?php
while (have_posts()) : the_post();
//get featured img
$feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
//get terms
$terms = get_the_terms( get_the_ID(), 'category' );
?>  

<div class="loop-entry <?php if($terms) foreach ($terms as $term) echo $term->slug .' '; ?>">
	<?php if($feat_img) { ?>
    	<a href="<?php echo esc_url( get_permalink(get_the_ID()) ); ?>" class="loop-entry-thumbnail"><img src="<?php echo $feat_img[0]; ?>" alt="<?php echo the_title(); ?>" /></a>
	<?php } ?>
	<div class="text">
	<p class="date"><?php the_time('F'); ?> <?php the_time('j'); ?>, <?php the_time('Y'); ?></p>
	<h3><a href="<?php echo esc_url( get_permalink(get_the_ID()) ); ?>"> 
	<?php $title = get_the_title(); 
    echo substr($title, 0, 80);
    if(strlen($title) > 80) {
        echo '...';
    } ?>
	</a></h3>
    <?php
	//show meta only on blog posts
    if ( get_post_type() != 'page' || get_post_type() != 'project') { ?>
	<div class="loop-entry-meta">
        <p class="by gray">By <a href="<?php echo get_site_url(); ?>/people"><?php the_author(); ?></a>
<!-- <span class="awesome-icon-comments"></span> <?php comments_popup_link('0', '1', '%'); ?></p> -->
    </div>
    <!-- /loop-entry-meta -->
    <?php } ?>
	<p><?php echo get_excerpt(220); ?></p>
	</div>
</div>
<!-- loop-entry -->

<?php endwhile; ?>