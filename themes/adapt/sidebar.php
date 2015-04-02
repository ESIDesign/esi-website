<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
 $options = get_option( 'adapt_theme_settings' );
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
		

	}	?>

<div class="archive-sidebar">

<div class='sidebar-box twitter'><h3><a target="_blank" href="http://www.twitter.com/esidesign"><img src="<?php echo get_template_directory_uri(); ?>/images/tweet.png" alt="Twitter"> Twitter</a></h3>	
<div class="twitter">

</div>
</div>

<div class='sidebar-box'><h3><a target="_blank" href="http://instagram.com/esidesign"><img src="<?php echo get_template_directory_uri(); ?>/images/instagram.png" alt="Twitter"> Instagram</a></h3>	
	<?php
/* Only Lab Posts */

// Do a new query with these IDs to get a properly-sorted list of posts
$images = get_posts( array(
	'post_type' => 'lab',
	'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => 6
) );
		
if ( !empty($images) ) {
	foreach ( $images as $image ) { 
		setup_postdata( $image ); 
	
		$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($image->ID),'grid-thumb', true);
		$site_url = get_site_url();
		
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<source.+src=[\'"]([^\'"]+)[\'"].*>/i', $image->post_content, $matches);
		$first_vid = $matches [1] [0];

		$value = get_post_meta($image->ID, 'syndication_permalink', true); ?>
	
		<article class="twocol">
		
		<?php if(!empty($value)) { 
			echo '<a target="_blank" href="'. $value.'" class="">';
		} else {
			echo '<a href="'.$site_url.'/'.$image->post_name.'" class="">';
		}
	
	    $agent = $_SERVER['HTTP_USER_AGENT'];
	
		if (($output == '1') && (strlen(strstr($agent,"Firefox")) == 0)) {
		  echo '<div class="video-wrapper"><video id="related_lab" width="110" >
			<source src="'.$first_vid.'" type="video/mp4">
			</video><span class="awesome-icon-play"></span></div></a>';
		}
	
		if (($output != '1') || (strlen(strstr($agent,"Firefox")) > 0)) {	
			echo '<img src="'.$image_url[0].'"/></a>';
		} ?>
		</article>
	<?php }
} ?>
     <div class="instagram"></div>
</div>
<div class="clearfix"></div>

<!--
<div class='sidebar-box padding-top'>
<?php $args = array(
	'title_before' => '<h3>',
	'title_after' => '</h3>',
); ?>
<?php wp_list_bookmarks($args); ?> 
</div>
-->
</div>

</aside>
<!-- /sidebar -->
