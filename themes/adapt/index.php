<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
get_header('home'); ?>

<div class="home-wrap">

<div class="home_logo home_item9">
	<h1 style="display:none">ESI Design</h1>
	<img class="active" src="<?php echo get_template_directory_uri(); ?>/images/esi-logo-red.jpg" alt="ESI Design"/>
</div>

<div class="home_item home_item1 project">
	<div class="video-overlay">
<!-- 		<span id="button" class="awesome-icon-play"></span> -->
<!-- 		<img class="placeholder" src="<?php echo $feat_img[0]; ?>" alt="<?php echo the_title(); ?>"/> -->
<!--
		<div class="project-overlay">
			<?php echo '<p>WATCH: Main Street: eBay’s New Front Door</p>'; ?>
		</div>
-->
	</div>
	<iframe class="autoplay" src="https://player.vimeo.com/video/193393534" width="590" height="332" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>

<?php
$feat_post = get_field('featured_module', 2145);
$featuredid = $feat_post->ID; ?>
<div class="project home_item3 news_module">
	<div class="cycle">
		<a href="<?php echo get_permalink($featuredid); ?>" class="news_item">
		<?php $feat_img = wp_get_attachment_image_src(get_post_thumbnail_id($featuredid), 'archive-project'); ?>
			<img src="<?php echo $feat_img[0]; ?>" alt="<?php echo the_title(); ?>"/>
			<h3 class="project-overlay">
			<?php if(get_field('headline',2145)) {
				the_field('headline',2145);
			} ?>
			</h3>
		</a>
		<a href="<?php echo get_site_url(); ?>/news" class="news_item">
		<div class="text">
			<h3>"How do you design an experience that makes learning about the U.S. Senate fun? You let visitors role-play senators."</h3>
			<h4>— Fast Company</h4>
		</div>
		</a>
	</div>
</div>


<?php 
	$args = array(
    'post_type' =>'project',
    'post__not_in' => array($featuredid),
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
			$attachments1 = array();
			$attachments2 = array();
			$proj_title1 = '';
			$proj_title2 = '';
            foreach($project_posts as $post) : setup_postdata($post);
	            $count++;
				$id = get_the_ID();
            	if(get_field('video', $id) != "" && get_field('video_img', $id) == "") {
					$exclude_id = get_post_thumbnail_id($id);
				}
				else {
					$exclude_id = '';
				} 	
            	$feat_id = get_post_thumbnail_id($id); 
                $args = array(
                    'orderby' => 'menu_order',
					'order' => 'ASC',
					'post_type' => 'attachment',
					'post_parent' => $id,
					'post_mime_type' => 'image',
					'post_status' => null,
					'posts_per_page' => 3,
					'exclude' => array($exclude_id),
					'meta_query' => array(
						'relation' => 'OR',
						array(
							'key' => 'not_in_carousel',
							'value' => '1',
							'compare' => '!='
						),
						array(
							'key' => 'not_in_carousel',
							'compare' => 'NOT EXISTS'
						)
				   )
                );
			$attachments = get_posts($args);

			foreach ($attachments as $attachment) :

				if($count == 1) { 
					$feat_img = wp_get_attachment_image_src($attachment->ID, 'archive-project');
					array_push($attachments1,  array('img' => '<img src="'.$feat_img[0].'" height="'.$feat_img[2].'" width="'.$feat_img[1].'" alt="'.get_the_title().'" />'));
				} 
			
				if($count == 2) {
					$feat_img = wp_get_attachment_image_src($attachment->ID, 'grid-thumb2');
					array_push($attachments2, array('img' => '<img src="'.$feat_img[0].'" height="'.$feat_img[2].'" width="'.$feat_img[1].'" alt="'.get_the_title().'" />'));
				}
				
			endforeach; 
			
			if (get_field('short') != "") { 
		  		$title = get_field("short");
		  	} else { 
		  		$title = get_the_title();  	
		  	} 
		  	
		  	if($count == 1) { 
	        	$proj_title1 = '<h3 class="project-overlay">'.$title.'</h3>'; 
	        }
	        
	        if($count == 2) {
				$proj_title2 =  '<h3 class="project-overlay">'.$title.'</h3>'; 
	        } 
	        
	        endforeach; } wp_reset_query(); ?>


	<div class="project home_item4">
		<a href="<?php echo get_permalink(get_the_ID()); ?>">
			<?php echo '<div class="cycle">'; 
				foreach($attachments1 as $attachment1) {
					echo $attachment1['img'];
				}
			echo '</div>'; 
			echo $proj_title1; ?>	
	  	</a>
	</div>
             
           
<!-- People -->
<div class="home_item home_item12">

<?php
	$pcount = 0;
	$args  = array(
		'role__in' => array('Administrator', 'Editor', 'Contributor'),
	    'exclude' => array(1),
	    'orderby' => 'rand',
	    'fields'    => 'all',
	    'number'    => 3
	);

	$user_query = new WP_User_Query( $args );
	
	foreach ( $user_query->results as $user ) :
		$curauth = get_userdata($user->ID);

		$avatar = 'wavatar';

		$pcount++; ?>
		
<?php if ($pcount == '1') { ?>
	<a class="people_button" href="<?php echo get_site_url(); ?>/people"><img src="<?php echo get_template_directory_uri(); ?>/images/people-trans.png"/ alt="People"></a>
	<article class="people1">
<?php } if ($pcount == '2') { ?>
	<article class="people2">
<?php } if ($pcount == '3') { ?>	
	<article class="people3">
<?php } if ($pcount <= '3') { ?>	
		<a href="<?php echo get_site_url(); ?>/people"><?php 
	echo get_avatar($curauth->ID, '116', $avatar, $curauth->display_name); ?> 
		<p class="caption_people"><span><?php echo $curauth->first_name; ?></span></p></a>
	</article>
<?php } ?>

<?php endforeach; ?>
</div><!-- home_item12 -->      
           
 
<div class="project home_item5">
	<a href="<?php the_permalink(); ?>">
		<?php echo '<div class="cycle">'; 
			foreach($attachments2 as $attachment2) {
				echo $attachment2['img'];
			}
		echo '</div>'; 
		echo $proj_title2; ?>	
	</a>
</div>
			

<div class="home_button work">
	<a href="<?php echo get_site_url(); ?>/work"><img src="<?php echo get_template_directory_uri(); ?>/images/work-trans.png" alt="Work"/></a>
</div>


<div class="home_button about">
	<a href="<?php echo get_site_url(); ?>/about-us"><img src="<?php echo get_template_directory_uri(); ?>/images/about-trans.png" alt="About"/></a>
</div>


<div class="home_button blog">
	<a href="<?php echo get_site_url(); ?>/jobs"><img src="<?php echo get_template_directory_uri(); ?>/images/join-trans.png" alt="Join"/></a>
</div>


<div class="home_item home_item13">
	<article class="home_media">
		<a target="_blank" href="http://www.twitter.com/esidesign"><img src="<?php echo get_template_directory_uri(); ?>/images/home-twitter.png" alt="Twitter"/></a>
		<a target="_blank" href="http://www.instagram.com/esidesign"><img src="<?php echo get_template_directory_uri(); ?>/images/home-insta.png" alt="Instagram"/></a>
		<a target="_blank" href="http://www.linkedin.com/company/esi-design"><img src="<?php echo get_template_directory_uri(); ?>/images/home-in.png" alt="LinkedIn"/></a>
		<a target="_blank" href="https://vimeo.com/esidesign"><img src="<?php echo get_template_directory_uri(); ?>/images/home-vimeo.png" alt="Vimeo"/></a>
		<a target="_blank" href="https://www.facebook.com/pages/ESI-Design/148102548567381"><img src="<?php echo get_template_directory_uri(); ?>/images/home-fb.png" alt="Facebook"/></a>
	</article>
</div>

<div class="home_button lab">
	<a href="<?php echo get_site_url(); ?>/work/design-lab"><img src="<?php echo get_template_directory_uri(); ?>/images/lab-trans.png" alt="Lab"/></a>
</div>
    

<div class="home_button approach">
	<a href="<?php echo get_site_url(); ?>/blog"><img src="<?php echo get_template_directory_uri(); ?>/images/blog-trans.png" alt="Blog"/></a>
</div>
    

<div class="home_button contact">
	<a href="<?php echo get_site_url(); ?>/contact"><img src="<?php echo get_template_directory_uri(); ?>/images/contact-trans.png" alt="Contact"/></a>
</div>    


<div class="home_button news">
	<a href="<?php echo get_site_url(); ?>/news"><img src="<?php echo get_template_directory_uri(); ?>/images/news-trans.png" alt="News"/></a>
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

<?php wp_footer(); ?>
</body>
</html>