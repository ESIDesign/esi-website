<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
$options = get_option( 'adapt_theme_settings' );
?>
<?php get_header('home'); ?>

<div class="home-wrap clearfix">

<article class="home_item9">
	<img class="active" src="<?php echo get_template_directory_uri(); ?>/images/esi_logo_red.jpg"/>
</article>

<article class="home_item9_quote">
<?php if (get_field('quote3', 2145) != "") { 
	$rand_quote = rand(1,3);
}
if (get_field('quote3', 2145) == "" && get_field('quote2', 2145) != "") { 
	$rand_quote = rand(1,2);
}
if (get_field('quote3', 2145) == "" && get_field('quote2', 2145) == "" && get_field('quote1', 2145) != "") { 
	$rand_quote = 1;
}
if (get_field('quote'.$rand_quote, 2145) != "") { 
	echo '<div class="quote">';
		$quote_length = strlen(strval(get_field('quote'.$rand_quote, 2145)));
			if ($quote_length > 100) {
				echo '<h2>';
			}
			if ($quote_length < 99) {
				echo '<h1>';
			}
			the_field('quote'.$rand_quote, 2145);
			if ($quote_length > 100) {
				echo '</h2>';
			}
			if ($quote_length < 99) {
				echo '</h1>';
			}
		echo '</div>';
		} ?>
<h3 class="attrib">
<?php if (get_field('attrib'.$rand_quote, 2145) != "") { 
	  the_field('attrib'.$rand_quote, 2145);
  	} ?></h3>
</article>

<?php
    global $post;
    $args2 = array(
        'post_type' =>'project',
        'meta_query' => array(
	                        array('key' => 'home',
	                              'value' => '1'
	                        ),
	                         array('key' => 'video_placeholder',
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
     
		if ($count == '1') { ?>
		
			<div class="home_item1">
			
				<img class="placeholder" src="<?php echo the_field('video_placeholder', $video_post->ID); ?>"/><span id="button" class="awesome-icon-play"></span>
				<iframe id="home_player" src="http://player.vimeo.com/video/<?php echo the_field('video', $video_post->ID); ?>?api=1&title=0&byline=0&portrait=0&player_id=home_player" width="590" height="332" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			
			</div>
		<?php } ?>
	<?php endforeach; ?>

<?php $args = array(
    'post_type' =>'project',
    'meta_query' => array(
                        array('key' => 'home',
                              'value' => '1'
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
            
                    	$id = get_the_ID();
                    	if(get_field('video', $id) != "" && get_field('video_img', $id) == "") {
							$exclude_id = get_post_thumbnail_id( $id );
						}
						else {
							$exclude_id = '';
						}
                    	
                    	$feat_id = get_post_thumbnail_id( $id ); 
                        //attachement loop
                        $args = array(
                            'orderby' => 'menu_order',
							'order' => 'ASC',
							'post_type' => 'attachment',
							'post_parent' => $id,
							'post_mime_type' => 'image',
							'post_status' => null,
							'posts_per_page' => 4,
/* 						    'exclude' => $exclude_id, */
							'meta_query' => array(
						       array(
						           'key' => 'not_in_carousel',
						           'value' => 1,
						           'type' => 'numeric',
						           'compare' => 'NOT EXISTS',
						       )
						   )
                        );
			$attachments = get_posts($args);
            $feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'archive-project');
            $feat_img2 = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb2');
            ?>
            
<?php if ($feat_img) {  ?>

<?php if ($count == '1') { ?>
	<div class="project home_item3">
		<a href="<?php the_permalink(); ?>">
		<?php if($post->ID == 3226) { ?>
			<img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" />
			<?php }
			else {
			echo '<div class="cycle">';
			foreach ($attachments as $attachment) :
			$feat_img = wp_get_attachment_image_src($attachment->ID, 'archive-project'); ?>
			<img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" />
			<?php endforeach; 
			echo '</div>'; 
			} ?>
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
		<a href="<?php the_permalink(); ?>">
		<?php if($post->ID == 3226) { ?>
			<img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" />
			<?php } 
			else {
			echo '<div class="cycle">';
			foreach ($attachments as $attachment) :
			$feat_img = wp_get_attachment_image_src($attachment->ID, 'archive-project'); ?>
			<img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" />
			<?php endforeach; 
			echo '</div>'; 
			} ?>
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
           
<!-- People -->
<div class="home_item12">

<?php
	global $wpdb;
	$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY rand()";
	$author_ids = $wpdb->get_results($query);
	$count = 0;
	foreach($author_ids as $author) :
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
	<a href="<?php the_permalink(); ?>">
		<?php if($post->ID == 3226) { ?>
		<img src="<?php echo $feat_img2[0]; ?>" alt="<?php echo the_title(); ?>" />
		<?php }
		else {
		echo '<div class="cycle">';
		foreach ($attachments as $attachment) :
		$feat_img2 = wp_get_attachment_image_src($attachment->ID, 'grid-thumb2'); ?>
		<img src="<?php echo $feat_img2[0]; ?>" alt="<?php echo the_title(); ?>" />
		<?php endforeach; 
		echo '</div>'; 
		} ?>
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
    

<div class="home_button work">
	<a href="<?php echo get_site_url(); ?>/work"><img src="<?php echo get_template_directory_uri(); ?>/images/work.png"/></a>
</div>


<div class="home_button about">
	<a href="<?php echo get_site_url(); ?>/about"><img src="<?php echo get_template_directory_uri(); ?>/images/about.png"/></a>
</div>


<div class="home_button blog">
	<a href="<?php echo get_site_url(); ?>/blog"><img src="<?php echo get_template_directory_uri(); ?>/images/blog.png"/></a>
</div>


<div class="home_item13">
	<article class="home_media">
		<a target="_blank" href="http://www.twitter.com/esidesign"><img src="<?php echo get_template_directory_uri(); ?>/images/home_twitter.png"/></a>
		<a target="_blank" href="http://vimeo.com/channels/esi"><img src="<?php echo get_template_directory_uri(); ?>/images/home_vimeo.png"/></a>
		<a target="_blank" href="http://www.linkedin.com/company/esi-design"><img src="<?php echo get_template_directory_uri(); ?>/images/home_in.png"/></a>
	</article>
</div>


<div class="home_button lab">
	<a href="<?php echo get_site_url(); ?>/work/lab"><img src="<?php echo get_template_directory_uri(); ?>/images/lab.png"/></a>
</div>
    

<div class="home_button approach">
	<a href="<?php echo get_site_url(); ?>/approach"><img src="<?php echo get_template_directory_uri(); ?>/images/approach.png"/></a>
</div>
    

<div class="home_button contact">
	<a href="<?php echo get_site_url(); ?>/contact"><img src="<?php echo get_template_directory_uri(); ?>/images/contact.png"/></a>
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
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.cycle.js"></script>

</div><!-- /main -->

</div><!-- wrap --> 
<!-- WP Footer -->
<?php wp_footer(); ?>
</body>
</html>
