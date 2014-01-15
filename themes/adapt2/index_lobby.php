<?php
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');
?>

<div class="home-wrap clearfix">

<article class="home_item9">

	<img class="active" src="<?php echo get_template_directory_uri(); ?>/images/esi_logo_red.jpg"/>

</article>

<?php
/* Lab Custom Post — mostly Instagram Feed */
$today = getdate();
$lab_today = get_posts( 'post_type=lab&post_status=publish&year=' . $today["year"] .'&monthnum=' . $today["mon"] .'&day=' . $today["mday"] );
/*'&monthnum=' . $today["mon"] .'&day=' . $today["mday"] */
if(!empty($lab_today)) {
	$images = get_posts( array(
		'post_type' => 'lab',
	    'post_status' => 'publish',
/* 	    'include' => array(3531, 3481, 3409, 3374, 3092, 3328, 3083), */
	    'year=' . $today["year"],
	    'monthnum=' => $today["mon"],
	    'orderby' => 'rand',
	    'posts_per_page'=> 1
	));
		$count_images = 0;
		foreach ( $images as $image ) { 
			$count_images++;
			if($count_images == 1) {
			setup_postdata( $image ); 
		
			$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($image->ID),'slider', true);
			$site_url = get_site_url();
		
			ob_start();
			ob_end_clean();
			$output = preg_match_all('/<source.+src=[\'"]([^\'"]+)[\'"].*>/i', $image->post_content, $matches);
			$first_vid = $matches [1] [0];
		
			$value = get_post_meta($image->ID, 'syndication_permalink', true);
			echo '<div class="home_item1">';
		
		    $agent = $_SERVER['HTTP_USER_AGENT'];
	
			if (($output == '1') && (strlen(strstr($agent,"Firefox")) == 0)) {	 
			  echo '<div class="video-wrapper"><video id="related_lab" width="610" >
				<source src="'.$first_vid.'" type="video/mp4">
				</video></div>';
			}
	
			if (($output != '1') || (strlen(strstr($agent,"Firefox")) > 0)) {	
				echo '<img src="'.$image_url[0].'"/>';
			}
			echo '<h3 class="project-overlay">';
			echo $image->post_title;	
			echo '</h3></div>';
		}
	}
}
if(empty($lab_today)) {
    $args2 = array(
        'post_type' =>'project',
        'post__in' => array( 418, 449, 125, 1802, 408, 2844, 3226, 446, 409 ),
        'meta_query' => array(
	                         array('key' => 'video',
	                              'value' => '',
	                              'compare' => '!='
	                        )
                    ),
        'orderby' => 'rand',
        'numberposts' => 1,
    );
	$video_posts = get_posts($args2);
	$video_ID = array($video_posts[0]->ID);
	foreach($video_posts as $video_post) {
		
		setup_postdata($video_post);
	
			if(get_field('video_img', $video_post->ID) != "") {
		    	$thumb_id = get_field('video_img', $video_post->ID);    
		    }
		    else {
				$thumb_id = get_post_thumbnail_id($video_post->ID);   
		    }
		    $feat_img = wp_get_attachment_image_src($thumb_id, 'slider'); ?>
		    <div class="home_item1">
					
<img class="placeholder" src="<?php echo $feat_img[0]; ?>"/><span class="circle"></span><span id="button" class="awesome-icon-play"></span>
					<iframe id="home_player" src="http://player.vimeo.com/video/<?php echo the_field('video', $video_post->ID); ?>?api=1&title=0&byline=0&portrait=0&player_id=home_player" width="590" height="332" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				
				</div>
	<?php } 
} 
?>


<?php $args = array(
    'post_type' =>'project',
    'meta_query' => array(
                        array('key' => 'featured',
                              'value' => '1',
                        )
                    ),
	'post__not_in' => $video_ID,
    'orderby' => 'rand',
);
    $portfolio_posts = get_posts($args);
    if($portfolio_posts) { 
            $count=0;
            
            foreach($portfolio_posts as $post) : setup_postdata($post);
            $count++;

            $feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'archive-project');
            $feat_img2 = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb2');
            ?>
            
            <?php if ($feat_img) {  ?>

<?php if ($count == '1') { ?>
	<div class="project home_item3">
		<a href="<?php the_permalink(); ?>"><img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" />
		<h3 class="project-overlay"> 
		<?php if (get_field('short') != "") { 
	  	the_field("short");
	  	}
	  	else { 
	  	the_title();  	
	  	 } ?>
	    </h3></a>
    </div>
<?php } ?>

<?php if ($count == '2') { ?>
	<div class="project home_item4">
		<a href="<?php the_permalink(); ?>"><img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" />
        <h3 class="project-overlay">
        <?php if (get_field('short') != "") { 
	  	the_field("short");
	  	}
	  	else { 
	  	the_title();  	
	  	} ?></h3></a>
	</div>
<?php } ?>


<?php if ($count == '3') { ?>
	<div class="project home_item8">
		<a href="<?php the_permalink(); ?>"><img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" />
        <h3 class="project-overlay">
        <?php if (get_field('short') != "") { 
	  	the_field("short");
	  	}
	  	else { 
	  	the_title();  	
	  	} ?></h3></a>
	</div>
<?php } ?>


<?php if ($count == '4') { ?>
	<div class="project home_item14">
		<a href="<?php the_permalink(); ?>"><img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" />
        <h3 class="project-overlay">
        <?php if (get_field('short') != "") { 
	  	the_field("short");
	  	}
	  	else { 
	  	the_title();  	
	  	} ?></h3></a>
	</div>
<?php } ?>

           
<?php if ($count == '5') { ?>     
           
<!-- People -->
<div class="home_item12">

<?php
// Get the authors from the database ordered by user nicename get 10 to accommodate for some not meeting if requirements below
	global $wpdb;
	$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY rand() LIMIT 0,10";
	$author_ids = $wpdb->get_results($query);
	$count = 0;

	foreach($author_ids as $author) :

		$curauth = get_userdata($author->ID);

		// Set default avatar (values = default, wavatar, identicon, monsterid)
		$avatar = 'wavatar';

		// If user level is above author, not admin or Amanda who goes first in peopleLoop
		if($curauth->user_level > 4 && $curauth->first_name != 'ESI' && $curauth->ID != 2) :
		$count++; ?>
		
<?php if ($count == '1') { ?>
	<a class="people_button" href="<?php echo get_site_url(); ?>/people"><img src="<?php echo get_template_directory_uri(); ?>/images/people.png"/></a>
	<article class="people1">
		<a href="<?php echo get_site_url(); ?>/people"><?php 
	echo get_avatar($curauth->ID, '116', $avatar); ?> 
		<p class="caption_people"><?php echo $curauth->first_name; ?></p></a>
	</article>
<?php } ?>

<?php if ($count == '2') { ?>
	<article class="people2">
		<a href="<?php echo get_site_url(); ?>/people"><?php 
		echo get_avatar($curauth->ID, '116', $avatar); ?> 
		<p class="caption_people"><?php echo $curauth->first_name; ?></p></a>
	</article>

<?php
/* People Custom Post — mostly Instagram Feed */
$today = getdate();
$people_today = get_posts( 'post_type=people&post_status=publish&year=' . $today["year"] . '&monthnum=' . $today["mon"] . '&day=' . $today["mday"]);

if(!empty($people_today)) {
	$order = 'date';
}
if(empty($lab_today)) {
	$order = 'rand';
}

$people_images = get_posts( array(
	'post_type' => 'people',
    'post_status' => 'publish',
    'orderby' => $order,
    'posts_per_page'=> 1
) );

if ( !empty($people_images) ) {
	foreach ( $people_images as $people_image ) { 
		
		setup_postdata( $people_image ); 
	
		$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($people_image->ID),'people', true);
		$site_url = get_site_url();
	
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<source.+src=[\'"]([^\'"]+)[\'"].*>/i', $people_image->post_content, $matches);
		$first_vid = $matches [1] [0];
	
		$value = get_post_meta($people_image->ID, 'syndication_permalink', true);
		echo '<div class="people_button">';
	
	    $agent = $_SERVER['HTTP_USER_AGENT'];

		if (($output == '1') && (strlen(strstr($agent,"Firefox")) == 0)) {	 
		  echo '<div class="video-wrapper"><video id="people" width="115" >
			<source src="'.$first_vid.'" type="video/mp4">
			</video><span class="awesome-icon-play"></span></div>';
		}

		if (($output != '1') || (strlen(strstr($agent,"Firefox")) > 0)) {	
			echo '<img src="'.$people_image_url[0].'"/>';
		}
/*
		echo '<h3 class="project-overlay">';
		echo 'ESI People';	
		echo '</h3>';
*/
		echo '</div>';
	}
} ?>

<?php } ?>

	<?php endif; ?>
<?php endforeach; ?>

</div><!-- home_item12 -->      
           
 
<div class="project home_item5">
	<a href="<?php the_permalink(); ?>"><img src="<?php echo $feat_img2[0]; ?>" alt="<?php echo the_title(); ?>" />
	<h3 class="project-overlay">
	<?php if (get_field('short') != "") { 
	  	the_field("short");
	}
	else { 
	  	the_title();  	
	} ?>
	</h3></a>
</div>
			
			<?php } ?><!-- if 3rd proj -->

            <?php } ?><!-- if proj feat img -->
            
		<?php endforeach; ?>
	<?php wp_reset_query(); ?>
<?php } ?><!-- if projects -->
    

<?php
/* Lab Custom Post — mostly Instagram Feed */
$today = getdate();
$lab_today = get_posts( 'post_type=lab&post_status=publish&year=' . $today["year"] . '&monthnum=' . $today["mon"] . '&day=' . $today["mday"]);
if(!empty($lab_today)) {
	$order = 'date';
}
if(empty($lab_today)) {
	$order = 'rand';
}

$images = get_posts( array(
	'post_type' => 'lab',
    'post_status' => 'publish',
    'orderby' => $order,
    'order' => 'DESC',
    'numberposts'=> 1
) );

if ( !empty($images) ) {
	$count = 0;
	foreach ( $images as $image ) { 
		$count++;
		
		setup_postdata( $image ); 
	
		$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($image->ID),'people', true);
		$site_url = get_site_url();
	
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<source.+src=[\'"]([^\'"]+)[\'"].*>/i', $image->post_content, $matches);
		$first_vid = $matches [1] [0];
	
		$value = get_post_meta($image->ID, 'syndication_permalink', true);
		echo '<div class="lab_item'.$count.'">';
	
	    $agent = $_SERVER['HTTP_USER_AGENT'];

		if (($output == '1') && (strlen(strstr($agent,"Firefox")) == 0)) {	 
		  echo '<div class="video-wrapper"><video id="related_lab" width="115" >
			<source src="'.$first_vid.'" type="video/mp4">
			</video><span class="awesome-icon-play"></span></div>';
		}

		if (($output != '1') || (strlen(strstr($agent,"Firefox")) > 0)) {	
			echo '<img src="'.$image_url[0].'"/>';
		}
		echo '<h3 class="project-overlay">';
		echo 'Lab Experiment';	
		echo '</h3></div>';
	}
}
?>

<!--
<?php
/* Blog Posts — To Use or Not to Use?  */
$images = get_posts( array(
	'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'numberposts'=> 2
) );


if ( !empty($images) ) {
	$count = 0;
	foreach ( $images as $image ) { 
	$count++;
	
	setup_postdata( $image ); 
		$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($image->ID),'people', true);
		$site_url = get_site_url();

  ob_start();
  ob_end_clean();

		echo '<div class="blog_item'.$count.'"><a href="'.$site_url.'/blog">';
		echo '<img src="'.$image_url[0].'"/></a>';
		echo '<h3 class="project-overlay">';
		echo substr($image->post_title,0,20).'...';	
		echo '</h3></div>';
	}
}
?>
-->

<div class="home_button work">

	<a href="<?php echo get_site_url(); ?>/work"><img src="<?php echo get_template_directory_uri(); ?>/images/work.png"/></a>

</div>


<div class="home_button about">

	<a href="<?php echo get_site_url(); ?>/about"><img src="<?php echo get_template_directory_uri(); ?>/images/about.png"/></a>

</div>

<div class="home_button blog">

	<a href="<?php echo get_site_url(); ?>/blog"><img src="<?php echo get_template_directory_uri(); ?>/images/blog.png"/></a>

</div>

<div class="home_button lab">

	<a href="<?php echo get_site_url(); ?>/work/lab"><img src="<?php echo get_template_directory_uri(); ?>/images/lab.png"/></a>

</div>
    

<div class="home_button approach">

	<a href="<?php echo get_site_url(); ?>/approach"><img src="<?php echo get_template_directory_uri(); ?>/images/approach.png"/></a>

</div>
    
<div class="home_item10">
	<article class="description">
	<h1><a href="<?php echo get_site_url(); ?>/about"> 
	<?php if (get_field('about', 2145) != "") { 
		the_field('about', 2145);
	} ?>  </a></h1>
	</article>
</div>
            
</div><!-- END home-wrap -->   

<script type="text/javascript" src="http://a.vimeocdn.com/js/froogaloop2.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/home_lobby.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.cycle.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/video.min.js"></script>
  <script>
    videojs.options.flash.swf = "<?php echo get_site_url(); ?>/wp-content/themes/adapt2/js/video-js.swf";
  </script>

</div><!-- /main -->
    
</div><!-- wrap --> 

<!-- WP Footer -->
<?php wp_footer(); ?>

</body>
</html>
