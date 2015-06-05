<h3 class="related">Recent Experiments</h3>
</div>
<?php
/* Lab Custom Post — mostly Instagram Feed */
$lab_args = array(
	'post_type' => 'lab',
	'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'numberposts' => 8
);
$lab_posts = get_posts( $lab_args );

/* Blog Posts Category Lab  */
$labblog_args = array(
    'post_type' => 'post',
    'category' => '282',
    'orderby' => 'date',
    'order' => 'DESC',
    'numberposts' => 8
);
$labblog_posts = get_posts( $labblog_args );

// $all_posts = array_merge( $lab_posts, $labblog_posts );
$all_posts = array_merge( $lab_posts);

$post_ids = wp_list_pluck( $all_posts, 'ID' );//Just get IDs from post objects

// Do a new query with these IDs to get a properly-sorted list of posts
$images = get_posts( array(
	'post_type' => array('post','lab'),
    'post__in'    => $post_ids,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'numberposts'=> 8
) );
		
if ( !empty($images) ) {
	foreach ( $images as $image ) { 
		setup_postdata( $image ); 
	
		$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($image->ID),'grid-thumb', true);
		$thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id($image->ID),'insta', true);
		$site_url = get_site_url();
		
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<source.+src=[\'"]([^\'"]+)[\'"].*>/i', $image->post_content, $matches);
		$first_vid = $matches [1] [0];
	
		echo '<div class="related-item">';
		$value = get_post_meta($image->ID, 'syndication_permalink', true);
	
		if(!empty($value)) { 
			echo '<a target="_blank" href="'. $value.'">';
		} else {
			echo '<a href="'.$site_url.'/'.$image->post_name.'">';
		}
	
	    $agent = $_SERVER['HTTP_USER_AGENT'];
	
		if (($output == '1') && (strlen(strstr($agent,"Firefox")) == 0)) {
		  echo '<div class="video-wrapper">
		  <video id="related_lab" poster="'.$thumb_url[0].'">
			<source src="'.$first_vid.'" type="video/mp4; codecs=avc1.42E01E,mp4a.40.2">
			</video><span class="awesome-icon-play"></span></div></a>';
		}
	
		if (($output != '1') || (strlen(strstr($agent,"Firefox")) > 0)) {	
			echo '<img src="'.$image_url[0].'"/></a>';
		}
			echo '<div class="related-caption">';
		if(!empty($value)) { 
			echo '<a target="_blank" href="'. $value.'">';
		} else {
			echo '<a href="'.$site_url.'/blog/'.$image->post_name.'">';
		}
		if (get_field('short', $image->ID) != "") { 
		  	the_field("short", $image->ID);
		}
		else { 
			echo substr($image->post_title,0,35);
			if	(strlen($image->post_title) > 35) {
				echo '...';
			}
		}		
		echo '</a></div></div>';
	}
} ?>
<a class="all-text" href="<?php echo get_site_url(); ?>/lab-archive">See all lab experiments →</a>