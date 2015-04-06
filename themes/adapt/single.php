<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>
<?php get_header(); ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=152807418071119&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<link href="<?php echo get_template_directory_uri(); ?>/css/video-js.css" rel="stylesheet" type="text/css">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php $twitter_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'insta'); ?>
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@esidesign">
<meta name="twitter:creator" content="@esidesign">
<meta name="twitter:title" content="<?php the_title(); ?>">
<meta name="twitter:description" content="<?php the_excerpt(); ?>">
<meta name="twitter:image" content="<?php echo $twitter_img[0]; ?>">

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
        
        <?php if(get_field('author_bio')) {
			$author_email = get_the_author_meta('user_email');
			echo '<div class="author">';
			echo get_avatar($author_email, 160);
			echo '<div class="bio"><p><strong><a href="'.get_site_url().'/people">';
			the_author();
			echo '</a></strong></p><p>';
		    the_field('author_bio'); 
			echo '</p></div></div>';
	    } ?>
         
        <div class="post-bottom">
        	<?php the_tags('<div class="post-tags"><span class="awesome-icon-tags"></span>',', ','</div>'); ?>
        </div>
        <!-- /post-bottom -->
        
        
        </div>
        <!-- /entry -->

	<div class="share">
<div class="fb-share-button" style="display:inline-block;vertical-align:top;margin-right:10px;" data-href="<?php echo get_permalink(); ?>" data-layout="button_count"></div>
<a style="display:inline-block;" href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo wp_get_shortlink(); ?>" data-counturl="<?php echo get_permalink(); ?>" data-via="esidesign">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</div>
		
        <nav id="single-nav" class="clearfix"> 
		<?php next_post_link('<div id="single-nav-left">%link</div>', '<span class="awesome-icon-chevron-left"></span> '.__('','adapt').'', false); ?>
		<?php previous_post_link('<div id="single-nav-right">%link</div>', ''.__('','adapt').' <span class="awesome-icon-chevron-right"></span>', false); ?>
	</nav>
		
		<?php comments_template(); ?>
   
        
</article>
<!-- /post -->

<?php endwhile; ?>
<?php endif; ?>

<!-- <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/video.min.js"></script> -->
  <script type="text/javascript">
/*
   _V_("lab");
    videojs.options.flash.swf = "http://www.esidesign.com/wp-content/themes/adapt2/js/video-js.swf";
  
*/
jQuery(function($){
	
	$(document).ready(function(){
  
	// Find all YouTube & Vimeo videos
	var $allVideos = $("iframe[src^='http://player.vimeo.com'], iframe[src^='//player.vimeo.com'], iframe[src^='http://www.youtube.com']"),
	
	// The element that is fluid width
	$fluidEl = $(".post");
	
	// Figure out and save aspect ratio for each video
	$allVideos.each(function() {
	
	$(this)
	.data('aspectRatio', this.height / this.width)
	
	// and remove the hard coded width/height
	.removeAttr('height')
	.removeAttr('width');
	
	});
	
	// When the window is resized
	$(window).resize(function() {
	
	var newWidth = $fluidEl.width();
	
	// Resize all videos according to their own aspect ratio
	$allVideos.each(function() {
	
	var $el = $(this);
	$el
	.width(newWidth)
	.height(newWidth * $el.data('aspectRatio'));
	
	});
	
	// Kick off one resize to fix all videos on page load
	}).resize();
  });
  });
  </script>

<?php get_footer(); ?>