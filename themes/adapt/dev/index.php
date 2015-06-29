<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
$options = get_option( 'adapt_theme_settings' );
?>
<?php get_header('home'); ?>

<div class="home-wrap">

<div class="home_logo home_item9">
	<img class="active" src="<?php echo get_template_directory_uri(); ?>/images/esi_logo_red.jpg"/>
</div>

<?php
$post_object = get_field('featured_module',2145);
$post = $post_object;
setup_postdata( $post ); 
$args2 = array(
    'orderby' => 'ID',
	'order' => 'DESC',
	'post_type' => 'attachment',
	'post_mime_type' => 'image',
	'post_status' => null,
	'post__in' => array(4848,4847)
);
$posts = get_posts($args2); ?>
<div class="home_item home_item1">
		<span id="button" class="awesome-icon-play"></span>
		<div class="cycle">
		<?php foreach($posts as $post) : setup_postdata($post);
			$feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb3'); ?>
			<img class="placeholder" src="<?php echo $feat_img[0]; ?>"/>
		<?php endforeach; ?>
		</div>
		<div class="project-overlay">
			<?php
				echo '<p>WATCH: ESI Design on <em>CBS This Morning</em></p>';
			?>
		</div>
		<embed src="http://www.cbsnews.com/common/video/cbsnews_video.swf" quality="high" scale="noscale" salign="lt" type="application/x-shockwave-flash" background="#000000" width="590" height="332" allowFullScreen="true" allowScriptAccess="always" FlashVars="pType=embed&si=254&pid=N_igAUIZ_EkW&url=http://www.cbsnews.com/videos/how-led-lights-are-changing-architecture" />
</div>

<!--
<?php
$post_object = get_field('featured_module',2145);
$post = $post_object;
setup_postdata( $post ); 
$args2 = array(
    'orderby' => 'menu_order',
	'order' => 'ASC',
	'post_type' => 'attachment',
	'post_parent' => $post->ID,
	'post_mime_type' => 'image',
	'post_status' => null,
	'post__in' => array(4687,4691,4689,4690,4693)
);
$posts = get_posts($args2); ?>
<div class="project home_item3">
	<a href="<?php echo get_permalink($post->ID); ?>">
		<div class="cycle">
		<?php foreach($posts as $post) : setup_postdata($post);
			$feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb3'); ?>
			<img src="<?php echo $feat_img[0]; ?>"/>
		<?php endforeach; ?>
		</div>
			<h3 class="project-overlay">
			<?php if(get_field('headline',2145)) {
				the_field('headline',2145);
			} ?>
			</h3>
	</a>
</div>
-->
<?php
$post_object = get_field('featured_module',2145);
$post = $post_object;
setup_postdata( $post ); 
$args2 = array(
    'orderby' => 'menu_order',
	'order' => 'ASC',
	'post_type' => 'attachment',
	'post_parent' => $post->ID,
	'post_mime_type' => 'image',
	'post_status' => null,
	'post__in' => array(4687,4691,4689,4690,4693),
	'numberposts' => 1
);
$posts = get_posts($args2); ?>
<div class="project home_item3 news_module">
	<div class="cycle">
	<a href="<?php echo get_site_url(); ?>/news" class="news_item">
		<div class="text">
	<h3>"How do you design an experience that makes learning about the U.S. Senate fun? You let visitors role-play senators."</h3>
	<h4>— Fast Company</h4>
		</div>
	</a>
		<a href="<?php echo get_site_url(); ?>/news" class="news_item">
					<?php foreach($posts as $post) : setup_postdata($post);
			$feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb3'); ?>
	<img src="<?php echo $feat_img[0]; ?>"/>
		<?php endforeach; ?>
			<h3 class="project-overlay">
			<?php if(get_field('headline',2145)) {
				the_field('headline',2145);
			} ?>
			</h3>
	</div>
	</a>
</div>


<?php $args = array(
    'post_type' =>'project',
    'meta_query' => array(
        array('key' => 'home',
              'value' => '1'
        )
    ),
    'orderby' => 'rand',
    'posts_per_page' => 2
);
$project_posts = get_posts($args);
    if($project_posts) { 
		$count=0;  
            foreach($project_posts as $post) : setup_postdata($post);
	            $count++;
				$id = get_the_ID();
            	if(get_field('video', $id) != "" && get_field('video_img', $id) == "") {
					$exclude_id = get_post_thumbnail_id( $id );
				}
				else {
					$exclude_id = '';
				}
                    	
            	$feat_id = get_post_thumbnail_id( $id ); 
                $args = array(
                    'orderby' => 'menu_order',
					'order' => 'ASC',
					'post_type' => 'attachment',
					'post_parent' => $id,
					'post_mime_type' => 'image',
					'post_status' => null,
					'posts_per_page' => 3,
	/* 				'exclude' => $exclude_id, */
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
           
<?php if ($count == '2') { ?>     
           
<!-- People -->
<div class="home_item home_item12">

<?php
	global $wpdb;
	$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY rand() LIMIT 0, 15";
	$author_ids = $wpdb->get_results($query);
	$count = 0;
	foreach($author_ids as $author) :
		$curauth = get_userdata($author->ID);

		$avatar = 'wavatar';

		if($curauth->user_level > 4 && $curauth->first_name != 'ESI' && $curauth->ID != 2 && $curauth->first_name != 'Rosemary') :
		$count++; ?>
		
<?php if ($count == '1') { ?>
	<a class="people_button" href="<?php echo get_site_url(); ?>/people"><img src="<?php echo get_template_directory_uri(); ?>/images/people_trans.png"/></a>
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
	<a href="<?php echo get_site_url(); ?>/work"><img src="<?php echo get_template_directory_uri(); ?>/images/work_trans.png" alt="Work"/></a>
</div>


<div class="home_button about">
	<a href="<?php echo get_site_url(); ?>/about-us"><img src="<?php echo get_template_directory_uri(); ?>/images/about_trans.png" alt="About"/></a>
</div>


<div class="home_button blog">
	<a href="<?php echo get_site_url(); ?>/blog"><img src="<?php echo get_template_directory_uri(); ?>/images/blog_trans.png" alt="Blog"/></a>
</div>


<div class="home_item13">
	<article class="home_media">
		<a target="_blank" href="http://www.twitter.com/esidesign"><img src="<?php echo get_template_directory_uri(); ?>/images/home_twitter.png"/></a>
		<a target="_blank" href="http://vimeo.com/channels/esi"><img src="<?php echo get_template_directory_uri(); ?>/images/home_vimeo.png"/></a>
		<a target="_blank" href="http://www.linkedin.com/company/esi-design"><img src="<?php echo get_template_directory_uri(); ?>/images/home_in.png"/></a>
	</article>
</div>

<div class="home_button lab">
	<a href="<?php echo get_site_url(); ?>/work/lab"><img src="<?php echo get_template_directory_uri(); ?>/images/lab_trans.png" alt="Lab"/></a>
</div>
    

<div class="home_button approach">
	<a href="<?php echo get_site_url(); ?>/approach"><img src="<?php echo get_template_directory_uri(); ?>/images/approach_trans.png" alt="Approach"/></a>
</div>
    

<div class="home_button contact">
	<a href="<?php echo get_site_url(); ?>/contact"><img src="<?php echo get_template_directory_uri(); ?>/images/contact_trans.png" alt="Contact"/></a>
</div>    


<div class="home_button news">
	<a href="<?php echo get_site_url(); ?>/news"><img src="<?php echo get_template_directory_uri(); ?>/images/news_trans.png" alt="News"/></a>
</div>
    

<div class="home_item home_item10">
	<h1><a href="<?php echo get_site_url(); ?>/about-us"> 
	<?php if (get_field('about', 2145) != "") { 
		the_field('about', 2145);
	} ?>  </a></h1>
</div>
            
</div><!-- END home-wrap -->  

</div><!-- /main -->

</div><!-- wrap --> 

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.cycle.js"></script>
<?php wp_footer(); ?>
</body>
</html>