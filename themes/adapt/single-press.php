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
	<p class="date gray"><?php the_time('F'); ?> <?php the_time('j'); ?>, <?php the_time('Y'); ?></p>
        <h1 class="single-title"><?php the_title(); ?></h1>
    </header>

    <br />
    <div class="entry clearfix">
        
		<?php the_content(); 
			if(get_field('pdf') != '') {
				$pdf = get_field('pdf');
				$pdf = $pdf['url'];
				echo '<p><a href="'.$pdf.'">Download PDF</a></p>';
			}
		?>
        <div class="clear"></div>
        
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
        
</article>
<!-- /post -->

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>