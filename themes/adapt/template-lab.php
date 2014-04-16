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
		<a href="<?php echo get_site_url(); ?>/work">Back to the lab</a>
	</div>
</header>

<div class="post clearfix">

<?php
/* Only Lab Posts */

// Do a new query with these IDs to get a properly-sorted list of posts
$images = get_posts( array(
	'post_type' => 'lab',
	'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'order' => 'DESC',
    'posts_per_page' => -1
) );
		
if ( !empty($images) ) {
	foreach ( $images as $image ) { 
		setup_postdata( $image ); 
	
		$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($image->ID),'insta', true);
		$site_url = get_site_url();
		
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<source.+src=[\'"]([^\'"]+)[\'"].*>/i', $image->post_content, $matches);
		$first_vid = $matches [1] [0];

		$value = get_post_meta($image->ID, 'syndication_permalink', true); ?>
	
		<article class="lab-entry">
		
		<?php if(!empty($value)) { 
			echo '<a target="_blank" href="'. $value.'" class="lab-entry-thumbnail">';
		} else {
			echo '<a href="'.$site_url.'/'.$image->post_name.'" class="lab-entry-thumbnail">';
		}
	
	    $agent = $_SERVER['HTTP_USER_AGENT'];
	
		if (($output == '1') && (strlen(strstr($agent,"Firefox")) == 0)) {
		  echo '<div class="video-wrapper"><video id="related_lab" width="200" >
			<source src="'.$first_vid.'" type="video/mp4">
			</video><span class="awesome-icon-play"></span></div></a>';
		}
	
		if (($output != '1') || (strlen(strstr($agent,"Firefox")) > 0)) {	
			echo '<img src="'.$image_url[0].'"/></a>';
		} ?>
			<div class="text"><p class="date"><?php echo mysql2date('F j, Y', $image->post_date); ?></p>
		<?php if(!empty($value)) { 
			echo '<h3><a target="_blank" href="'. $value.'">';
		} else {
			echo '<h3><a href="'.$site_url.'/'.$image->post_name.'">';
		} 
/* 		if(empty($value)) { */
					$title = $image->post_title; 
			        echo substr($title, 0, 45);
			        if(strlen($title) > 45) {
				        echo '...';
			        }  
/* 			      } */
			      ?>
		</a></h3>
		</div>
		</article>
	<?php }
} ?>
       
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