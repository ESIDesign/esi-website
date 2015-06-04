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

<div class="archive-sidebar <?php if(is_page(2)) { echo 'news'; } ?>">
<?php if(!is_page(2)) { ?>
<div class='sidebar-box twitter'><h3><a target="_blank" href="http://www.twitter.com/esidesign"><img src="<?php echo get_template_directory_uri(); ?>/images/tweet.png" alt="Twitter"> Twitter</a></h3>	
<div class="twitter">
</div>
</div>

<div class='sidebar-box'><h3><a target="_blank" href="http://instagram.com/esidesign"><img src="<?php echo get_template_directory_uri(); ?>/images/instagram.png" alt="Instagram"> Instagram</a></h3>	
	<?php
/* Only Lab Posts */

// Do a new query with these IDs to get a properly-sorted list of posts
$images = get_posts( array(
	'post_type' => 'lab',
	'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => 6
));
		
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

</div>
<?php } ?>

<?php if(is_page(2)) { ?>
<div class='sidebar-box twitter'>
<h3>Press Inquiries</h3>
<p><strong>Rosemary Siciliano</strong><br />
Communications Director<br />
212-989-9389<br />
207.332.9008 (c)<br />
rsiciliano (at) esidesign.com</p>
</div>

<div class='sidebar-box video'>
	<h3>Video<a class="all" href="https://vimeo.com/esidesign">See all video</a></h3>
	<?php echo '<div class="related-item">';
		echo '<a href=""><iframe id="player" src="http://player.vimeo.com/video/74313412?api=1&title=0&byline=0&portrait=0&player_id=player"></iframe></li></a>';

		echo '<div class="related-caption"><a href="https://vimeo.com/74313412">';
	  	echo 'Media Architecture';		
		echo '</a></div>';

		echo '</div>';
		?>
		<?php echo '<div class="related-item">';
		echo '<a href=""><iframe id="player" src="http://player.vimeo.com/video/109265859?api=1&title=0&byline=0&portrait=0&player_id=player"></iframe></li></a>';

		echo '<div class="related-caption"><a href="https://vimeo.com/109265859">';
	  	echo 'Beacon Capital Partners: 745 Atlantic';		
		echo '</a></div>';

		echo '</div>';
		?>
</div>
	

<div class='sidebar-box'>
<?php
global $post;
$args = array(
	'post_type' =>'press',
	'orderby' => 'date',
	'order' => 'ASC',
	'numberposts' => 4
);
$posts = get_posts($args);
$count = 0;
if($posts) {
echo '<h3>Press Releases</h3>';
	foreach ($posts as $post) : setup_postdata($post);
		echo '<p><a href="'.get_the_permalink().'">'.get_the_title().'</a><br />
		'.get_the_date().'</p>';
	endforeach; 
} ?>
</div>
<?php } ?>

<div class="clearfix"></div>

</div>

</aside>
<!-- /sidebar -->
