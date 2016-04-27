 <?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>

<?php get_header(); ?>

<div class="careers-wrap">

<div class="careers_left">
	<?php $img_args = array(
		'post_type' =>'project',
        'numberposts' => '1',
        'orderby' => 'rand',
        'meta_query' => array(
                            array('key' => 'featured',
                                  'value' => '1'
	                            )
	                        ),
						);
	$imgs = get_posts($img_args);
	foreach($imgs as $img) {
		$feat_img = wp_get_attachment_image_src( get_post_thumbnail_id($img->ID), 'grid-thumb3'); ?>
		<img src="<?php echo $feat_img[0]; ?>" alt="<?php echo apply_filters('the_title', $img->post_title); ?>" />
	<?php } ?>
</div>

<?php $args = array(
    'page_id' =>'6',
    'post_status'=>'publish', 
); ?>
<?php query_posts ($args); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="careers_title">
<h1><?php the_title(); ?></h1>
<h3><?php the_content(); ?></h3>
<?php if (get_field('sub_headline') != "") { 
	echo '<h3>';
	the_field('sub_headline');
	echo '</h3>';
} ?>
</div>
<?php endwhile; ?>
<?php endif; ?>   

<div class="clear"></div>

<div class="career_opps">
	<?php $children = get_pages('post_type=careers&post_status=publish');
	if( $children ) {
		echo '<h2>Current Opportunities</h2>';
		echo '<ul>';
		$args = array(  
			'post_type' => 'careers',
			'post_status'=> 'publish',
			'sort_column' => 'post_title',
			'hierarchical' => 0  
		);
		$mypages = get_pages($args);
		foreach( $mypages as $page ) {    
			echo '<li><a href="'.get_permalink($page->ID).'"><h3>'.$page->post_title.'</h3><p><span class="gray">'.$page->post_excerpt.' </span>  <span class="black"> View Listing →</span></a></p></li>';
		}
		echo '</ul>';	
	}
	else { 
		echo "<h3>There are no opportunities at this time.</h3>";
	} ?>
</div>

<div class="career_people">
<?php $people_args = array(
	'post_type' => 'people',
	'orderby' => 'rand',
	'exclude' => 3484,
	'posts_per_page' => 5 
);
$people_posts = get_posts( $people_args );

$peoplepage_args = array(
	'orderby' => 'rand',
	'post_type' => 'attachment',
	'post_parent' => 343,
	'post_mime_type' => 'image',
	'orderby' => 'rand',
	'posts_per_page' => 3
);
$peoplepage_posts = get_posts($peoplepage_args);

$all_posts = array_merge($people_posts, $peoplepage_posts);

$post_ids = wp_list_pluck( $all_posts, 'ID' );

// Do a new query with these IDs to get a properly-sorted list of posts
$attachments = get_posts( array(
	'post_type' => array('attachment', 'people', 'lab'),
/*     'post__in'    => $post_ids, */
	'post__in' => array(5273, 6514, 4988, 5329, 5727, 5596, 5934, 4973, 4974, 1233, 3804, 3431, 3420, 1196, 3368, 4853), 
    'post_status' => array('inherit','publish'),
/*     'orderby' => 'date', */
	'orderby' => 'post__in',
    'order' => 'DESC',
    'numberposts'=> 8
) ); 
            
    $i=0;         

	foreach($attachments as $attachment) :
		  
	if('people' == get_post_type($attachment->ID) || 'lab' == get_post_type($attachment->ID)) {
	setup_postdata( $attachment ); 

	$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($attachment->ID),'insta', true);
	$site_url = get_site_url();

	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<source.+src=[\'"]([^\'"]+)[\'"].*>/i', $attachment->post_content, $matches);
	$first_vid = $matches[1][0];

	$value = get_post_meta($attachment->ID, 'syndication_permalink', true);
	echo '<div class="people_item">';

    $agent = $_SERVER['HTTP_USER_AGENT'];

	if (($output == '1') && (strlen(strstr($agent,"Firefox")) == 0)) {
 	 
	  echo '<div class="video-wrapper"><video id="esipeople" width="240" >
		<source src="'.$first_vid.'" type="video/mp4">
		</video><span class="awesome-icon-play"></span></div>';
		}

	  if (($output != '1') || (strlen(strstr($agent,"Firefox")) > 0)) {	
		echo '<img src="'.$image_url[0].'"/>';
		}
		echo '</div>';
	}
	if('attachment' == get_post_type($attachment->ID)) {
	$grid_thumb2 = wp_get_attachment_image_src($attachment->ID, 'insta'); ?>
		<div class="people_item">
			<img src="<?php echo $grid_thumb2[0]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" /> 
		</div>
	<?php } ?>                    
	
	<?php $i++; ?>

<?php endforeach; ?>
</div>

</div>



<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/video.min.js"></script>
<script>
    videojs.options.flash.swf = "<?php echo get_template_directory_uri(); ?>/js/video-js.swf";
</script>
<script type="text/javascript">

jQuery(function($){
	$(document).ready(function(){
	
		jQuery('.video-wrapper').hover(function() {
			jQuery(this).find('.awesome-icon-play').fadeOut();
			var myVideo = jQuery(this).find('video#esipeople')[0];
			myVideo.play();
		},
		function() {
			jQuery(this).find('.awesome-icon-play').fadeIn();
			var myVideo = jQuery(this).find('video#esipeople')[0];
			myVideo.pause();
		});

	});
});
</script>

<?php get_footer(); ?>