<?php
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');
?>

<div class="home-wrap clearfix">

<article class="home_item9">

	<img class="active" src="<?php echo get_template_directory_uri(); ?>/images/esi_logo_red.jpg"/>

</article>

<article class="home_item9_quote">
<div class="quote"><h1>Touch to explore</h1></div>
</article>

<?php
    global $post;
    $args2 = array(
        'post_type' =>'project',
        'post__in' => array( 418, 449, 125, 1802, 408, 2844, 3226, 446, 409 ),
        'meta_query' => array(
/*
	                        array('key' => 'featured',
	                              'value' => '1'
	                        ),
*/
	                         array('key' => 'video',
	                              'value' => '',
	                              'compare' => '!='
	                        )
                    ),
        'orderby' => 'rand',
	   
    );
    $video_posts = get_posts($args2);
     $video_ID = array($video_posts[0]->ID);
     $count=0;
     foreach($video_posts as $video_post) : setup_postdata($video_post);
     $count++;
     
		if ($count == '1') { 

	if(get_field('video_img', $video_post->ID) != "") {
    	$thumb_id = get_field('video_img', $video_post->ID);    
    }
    else {
		$thumb_id = get_post_thumbnail_id($video_post->ID);   
    }
    $feat_img = wp_get_attachment_image_src($thumb_id, 'slider'); 
    ?>

		<div class="home_item1">
<!-- 		<?php echo the_field('video_placeholder', $video_post->ID); ?> -->
		
			<img class="placeholder" src="<?php echo $feat_img[0]; ?>"/><span class="circle"></span><span id="button" class="awesome-icon-play"></span>
			<iframe id="home_player" src="http://player.vimeo.com/video/<?php echo the_field('video', $video_post->ID); ?>?api=1&title=0&byline=0&portrait=0&player_id=home_player" width="590" height="332" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		
		</div>
		<?php } ?>
	<?php endforeach; ?>

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
// Get the authors from the database ordered by user nicename
	global $wpdb;
	$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY rand()";
	$author_ids = $wpdb->get_results($query);
	$count = 0;
// Loop through each author
	foreach($author_ids as $author) :

	// Get user data
		$curauth = get_userdata($author->ID);

		// Set default avatar (values = default, wavatar, identicon, monsterid)
			$avatar = 'wavatar';

	// If user level is above 0 or login name is "admin", display profile
		if($curauth->user_level > 4 && $curauth->first_name != 'ESI') :
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
<?php } ?>

<?php if ($count == '3') { ?>
	<article class="people3">
		<a href="<?php echo get_site_url(); ?>/people"><?php 
	echo get_avatar($curauth->ID, '116', $avatar); ?> 
		<p class="caption_people"><?php echo $curauth->first_name; ?></p></a>
	</article>
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
$images = get_posts( array(
	'post_type' => 'lab',
    'post_status' => 'publish',
    'orderby' => 'rand',
    'order' => 'DESC',
    'numberposts'=> 1
) );


if ( !empty($images) ) {
	$count = 0;
	foreach ( $images as $image ) { 
	$count++;
	
	setup_postdata( $image ); 

		$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($image->ID),'thumbnail', true);
		$site_url = get_site_url();

  ob_start();
  ob_end_clean();
    $output = preg_match_all('/<source.+src=[\'"]([^\'"]+)[\'"].*>/i', $image->post_content, $matches);
  $first_vid = $matches [1] [0];

		$value = get_post_meta($image->ID, 'syndication_permalink', true);
		echo '<div class="lab_item'.$count.'">';

    $agent = $_SERVER['HTTP_USER_AGENT'];

	  if (($output == '1') && (strlen(strstr($agent,"Firefox")) == 0)) {

 	 
	  echo '<div class="video-wrapper"><video id="related_lab" width="330" >
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
/* Lab Custom Post — mostly Instagram Feed */
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

<script type="text/javascript">
jQuery(function($){
	$(document).ready(function(){
/* 			$('body').kinetic(); */
	
	var timeout;
    $(document).on("mousemove keydown click", function() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
/*              window.location = "<?php echo get_site_url(); ?>/work";  */
				window.location.reload();
        }, 60 * 3600);
    }).click();

	});
});
</script>


</div><!-- /main -->
    
</div><!-- wrap --> 

<!-- WP Footer -->
<?php wp_footer(); ?>

</body>
</html>
