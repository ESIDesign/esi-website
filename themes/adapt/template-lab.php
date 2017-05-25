<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: Lab Archive
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<header id="page-heading">
	<h1 class="pagetitle">
		<a href="<?php echo get_site_url(); ?>/work"><?php the_title(); ?></a>
	</h1>
	<div class="all-projects">
		<a href="<?php echo get_site_url(); ?>/work/lab">Back to the lab</a>
	</div>
</header>

<div class="post clearfix">

<?php
/* Only Lab Posts */

// Do a new query with these IDs to get a properly-sorted list of posts
$images = get_posts( array(
	'post_type' => 'insta',
	'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'meta_key' => 'hashtag',
    'meta_value' => 'esilab',
    'meta_compare' => '=',
    'posts_per_page' => -1
) );
		
if ( !empty($images) ) {
	foreach ( $images as $image ) { 
		setup_postdata( $image ); 
	
		$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($image->ID), 'insta', false);
		
		$insta_video = get_post_meta($image->ID, 'video', true);

		$value = get_post_meta($image->ID, 'syndication_permalink', true);
		if($value == '') {
			$value = get_post_meta($image->ID, 'insta_link', true);
		}
		if($value == '') {
			$value = get_site_url().'/'.$image->post_name;
		}
    
    if($insta_video != '') {
	    echo '<article class="lab-entry">
	    <a target="_blank" href="'. $value.'" class="lab-entry-thumbnail">
	    <div class="video-wrapper">
		<video id="related_lab" width="200" poster="'.$image_url[0].'">
			<source src="'.$insta_video.'" type="video/mp4">
		</video><span class="awesome-icon-play"></span></div></a>';
    } else {
	    echo '<article class="lab-entry">
	    <a target="_blank" href="'. $value.'" class="lab-entry-thumbnail">
	    	<img src="'.$image_url[0].'"/>
	    </a>';
    }
	
	echo '<div class="text"><p class="date">'.get_the_date('F j, Y', $image->ID).'</p>';
	echo '<h3><a target="_blank" href="'. $value.'">';
	$title = $image->post_title; 
	echo substr($title, 0, 45);
	if(strlen($title) > 45) {
		echo '...';
	} 
	echo '</a></h3>';
	echo '</article>';
	}
} ?>  

</div><!-- /post -->

<?php endwhile; endif; ?>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/video.min.js"></script>
<script>
    videojs.options.flash.swf = "<?php echo get_template_directory_uri(); ?>/js/video-js.swf";
</script>

<script type="text/javascript">

jQuery(function($){
	$(document).ready(function(){
	
		jQuery('.video-wrapper').hover(function() {
			jQuery(this).find('.awesome-icon-play').fadeOut();
			var myVideo = jQuery(this).find('video#related_lab')[0];
			myVideo.play();
		},
		function() {
			jQuery(this).find('.awesome-icon-play').fadeIn();
			var myVideo = jQuery(this).find('video#related_lab')[0];
			myVideo.pause();
		});
		
	});
});
</script>
<?php get_footer(); ?>