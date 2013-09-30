<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>
<?php get_header(); ?>
<link href="<?php echo get_template_directory_uri(); ?>/css/video-js.css" rel="stylesheet" type="text/css">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article class="post clearfix">

	<header>
	<p class="date"><?php the_time('F'); ?> <?php the_time('j'); ?>, <?php the_time('Y'); ?></p>
        <h1 class="single-title"><?php the_title(); ?></h1>
	<div class="loop-entry-meta">
        <p class="by">By <?php if ( function_exists( 'coauthors_posts_links' ) ) { ?>
        <a href="<?php echo get_site_url(); ?>/people">
  <?php coauthors();
} else { ?>
	<a href="<?php echo get_site_url(); ?>/people"><?php the_author(); ?></a>
<?php } ?>
        <span class="awesome-icon-comments"></span> <?php comments_popup_link('0', '1', '%'); ?></p>
    </div>
        <!-- /loop-entry-meta -->
    </header>

    <br />
    <div class="entry clearfix">
        <?php
		/* remove commenting to show featured image
		$feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
		if($feat_img) {
		?>
		<img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" class="post-thumbnail" />
        <?php } */ ?>
        
		<?php the_content(); ?>
        <div class="clear"></div>
        
        <?php wp_link_pages(' '); ?>
         
        <div class="post-bottom">
        	<?php the_tags('<div class="post-tags"><span class="awesome-icon-tags"></span>',' , ','</div>'); ?>
        </div>
        <!-- /post-bottom -->
        
        
        </div>
        <!-- /entry -->
        <nav id="single-nav" class="clearfix"> 
		<?php next_post_link('<div id="single-nav-left">%link</div>', '<span class="awesome-icon-chevron-left"></span> '.__('','adapt').'', false); ?>
		<?php previous_post_link('<div id="single-nav-right">%link</div>', ''.__('','adapt').' <span class="awesome-icon-chevron-right"></span>', false); ?>
	</nav>
		<?php comments_template(); ?>
   
        
</article>
<!-- /post -->

<?php endwhile; ?>
<?php endif; ?>
             
<?php get_sidebar(); ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/video.min.js"></script>
  <script>
   _V_("lab");
    videojs.options.flash.swf = "http://www.esidesign.com/wp-content/themes/adapt2/js/video-js.swf";
  
jQuery(function($){
	
	$(document).ready(function(){
/* lobby lightbox temp hack  */
  if ($(window).width() > 1400 && $(window).width() < 1460) {
  		$('body').kinetic(); 
  }
  });
  });
  </script>

<?php get_footer(); ?>