 <?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>

<?php get_header(); ?>

<div class="careers-wrap">

<div class="careers_left">
<!--
<div class="people_item2">
<img src="/wp-content/uploads/2011/08/about20-240x180.jpg"/>
</div>
<div class="people_item2">
<img src="/wp-content/uploads/2011/08/about10-240x180.jpg"/>
</div>
-->
<img src="/wp-content/uploads/2013/06/Process-022-513x353.jpg" />
</div>

    <?php $args = array(
            'page_id' =>'471',
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
<?php
$children = get_pages('post_type=careers&post_status=publish');
if( $children ) {
echo '<h2>Current Opportunities</h2>';
		echo '<ul>';
			$args = array(  'post_type' => 'careers',
				            'post_status'=> 'publish',
  							'sort_column' => 'post_title',
							'hierarchical' => 0  
 						);
				$mypages = get_pages($args);
				foreach( $mypages as $page ) {    
					echo '<li class="orange_border"><h3><a href="'.get_permalink($page->ID).'">'.$page->post_title.'</a></h3><p>'.$page->post_excerpt.'<a href="'.get_permalink($page->ID).'"> →</a></p></li>';

						}
				echo '</ul>';	

}
else { 
	echo "<h3>There are no opportunities at this time.</h3>";
} ?>
</div>

<div class="career_people">
<?php
                    
$people_args = array(
	'post_type' => 'people',
	'orderby' => 'rand',
	'posts_per_page' => 4 
);
$people_posts = get_posts( $people_args );

$peoplepage_args = array(
	'orderby' => 'rand',
	'post_type' => 'attachment',
	'post_parent' => 343,
	'post_mime_type' => 'image',
	'orderby' => 'rand',
	'posts_per_page' => 1
);
$peoplepage_posts = get_posts($peoplepage_args);

$all_posts = array_merge($people_posts, $peoplepage_posts);

$post_ids = wp_list_pluck( $all_posts, 'ID' );

// Do a new query with these IDs to get a properly-sorted list of posts
$attachments = get_posts( array(
	'post_type' => array('attachment', 'people'),
    'post__in'    => $post_ids,
    'post_status' => array('inherit','publish'),
    'orderby' => 'date',
    'order' => 'DESC',
    'numberposts'=> 5
) ); 
            
    $i=0;         

	foreach($attachments as $attachment) :
		  
	if('people' == get_post_type($attachment->ID)) {
	setup_postdata( $attachment ); 

	$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($attachment->ID),'grid-thumb', true);
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
	$grid_thumb2 = wp_get_attachment_image_src($attachment->ID, 'grid-thumb'); ?>
		<div class="people_item2">
			<img src="<?php echo $grid_thumb2[0]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" /> 
		</div>
	<?php } ?>                    
	
	<?php $i++; ?>

<?php endforeach; ?>
</div>

</div>





<script type="text/javascript">
jQuery(function($){
	$(document).ready(function(){
var paras = $('img.about').hide(),
    i = 0;

// If using jQuery 1.3 or lower, you need to do $(paras[i++] || []) to avoid an "undefined" error
(function() {
  $(paras[i++]).fadeIn(300, arguments.callee);
})();
});
});
</script>


<?php get_footer(); ?>