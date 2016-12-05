<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>
<aside id="sidebar" class="clearfix">

<?php if(is_page(430)) { 
echo "<div class='sidebar-box'><h3 class='careers'>Career Opportunities</h3>";
$children = get_pages('post_type=careers&post_status=publish');
if( $children ) {
	echo '<ul>';
	$args = array(  'post_type' => 'careers',
		            'post_status'=> 'publish',
						'sort_order' => 'ASC',
						'sort_column' => 'post_title',
					'hierarchical' => 0  
					);
		$mypages = get_pages($args);
		foreach( $mypages as $page ) {    		
			echo '<li><a href="'.get_permalink($page->ID).'">'.$page->post_title.'</a></li>';
		}
		echo '</ul>';	
	}
	if( $children == null ) { 
		echo "<p>There are no opportunities at this time.</p>";
	} 
	echo '</div>';   
} ?>

<?php if(!is_page(2) && !is_post_type_archive('press')) { ?>
	<div class='sidebar-box'><h3><a target="_blank" href="http://www.twitter.com/esidesign"><img src="<?php echo get_template_directory_uri(); ?>/images/tweet.png" alt="Twitter"> Twitter</a></h3>	
	<div class="twitter"></div>
</div>

<div class='sidebar-box'>
	<h3><a target="_blank" href="http://instagram.com/esidesign"><img src="<?php echo get_template_directory_uri(); ?>/images/instagram.png" alt="Instagram"> Instagram</a></h3>	

<?php
$jsonurl = "https://api.instagram.com/v1/users/self/media/recent/?access_token=266854171.7827081.6439a537b65044a7872f1d35af72fda2&count=6";	
$json = file_get_contents($jsonurl,0,null,null);
$json_output = json_decode($json, true);
$count = 1;
foreach($json_output['data'] as $item) {
		$count++;
		echo '<article class="twocol instagram">';
		echo '<a target="_blank" href="'.$item['link'].'">';
		echo '<img src="'.$item['images']['thumbnail']['url'].'"/></a>';
		echo '</article>';
} ?>
</div>
<?php } ?>

<!-- News Sidebar -->
<?php if(is_page(2) || is_post_type_archive('press')) { ?>
<div class='sidebar-box'>
<?php
global $post;
$args = array(
	'post_type' =>'press',
	'orderby' => 'date',
	'order' => 'ASC',
	'numberposts' => 3
);
$posts = get_posts($args);
$count = 0;
if($posts) {
echo '<h3>Press Releases</h3>';
	foreach ($posts as $post) : setup_postdata($post);
		echo '<p><a href="'.get_the_permalink().'">'.get_the_title().'</a><br /><span class="gray">
		'.get_the_date().'</span></p>';
	endforeach; 
} 
echo '<a href="'.get_post_type_archive_link('press').'">View All Press Releases  →</a>';
?>
</div>

<?php if(get_field('press_inquiries', 2) != "") {
	echo '<div class="sidebar-box press">';
	echo '<h3>Press Inquiries</h3>';
	the_field('press_inquiries', 2);
	echo '</div>';
} ?>

<?php if(have_rows('videos', 2) ):
	echo '<div class="sidebar-box video">';
	echo '<h3>Video<a class="all" target="_blank" href="https://vimeo.com/esidesign">See all video</a></h3>';
	while (have_rows('videos', 2) ) : the_row();
		echo '<div class="related-item">';
		echo '<a href="https://vimeo.com/'.get_sub_field('video_id').'" target="_blank"><iframe id="player" src="https://player.vimeo.com/video/'.get_sub_field('video_id').'?api=1&title=0&byline=0&portrait=0&player_id=player"></iframe></li></a>';
		echo '<div class="related-caption"><a href="https://vimeo.com/'.get_sub_field('video_id').'" target="_blank">'.get_sub_field('video_title').'</a></div>';
		echo '</div>';
	endwhile;
	echo '</div>';
endif; ?>
<?php } ?>

<div class="clearfix"></div>

</aside><!-- /sidebar -->