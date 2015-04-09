<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
Template Name Posts: Lab Template
*/
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>   

<header id="page-heading">
<h1 class="pagetitle"><a href="<?php echo get_site_url(); ?>/work">Our Work</a></h1>
<div class="all-projects"><a href="<?php echo get_site_url(); ?>/work">Back to all projects</a></div>
</header>

<article>
    <div id="single-project" class="post full-width clearfix">
	    <div class="loading"></div>
	    <div id="featured">
           
           <div class="title">
           <div class="band">
	           <h1><?php
	  	if (get_field('short') != "") { 
	  	the_field("short");
	  	}
	  	else { ?>
			<?php the_title(); ?>	  	
	  	<?php } ?></h1>
           </div>
           <div class="triangle"></div>
           </div>
           
            <div id="slider-wrap">
                <div class="flexslider clearfix">
                    <ul class="slides">
                    
                                          
                   <?php   
                    	$id = get_the_ID();
                    	$feat_id = get_post_thumbnail_id( $id ); 
                        //attachement loop
                        $args = array(
                            'orderby' => 'menu_order',
							'order' => 'ASC',
							'post_type' => 'attachment',
							'post_parent' => $id,
							'post_mime_type' => 'image',
							'post_status' => null,
							'posts_per_page' => -1,
						    'exclude' => $exclude_id,
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
					if (get_field('video_order', $id) != "") { 
                    $video_order = get_field('video_order', $id);
                    }
                    if (get_field('video_order') == "") { 
                    $video_order = 2;
                    }  	
					//attachments count
					$attachments_count = count($attachments);
                    $count = 0;
                        //start loop
                        foreach ($attachments as $attachment) :
                        $count++;
                        
                        $full_img = wp_get_attachment_image_src( $attachment->ID, 'slider');
                        $imgsize = wp_get_attachment_metadata($attachment->ID); 
                        $feat_id = get_post_thumbnail_id( $id ); ?>
                            
                    <?php if ($imgsize['width'] == 590) { 
                    
                    $count = 0;
                     } ?>
                    
                    
                    <?php if ($imgsize['width'] != 590) { ?>
                    
                    <!-- if adding second video remember jquery for img placeholder -->        
	                <?php if ($count == $video_order && get_field('video', $id) != "") { ?>   
                    <?php
                     $video = get_post_custom_values("video");
                     $video2 = get_post_custom_values("video2");
						  	echo '<li class="video-wrapper">
						  	<iframe id="player" src="http://player.vimeo.com/video/'.$video[0].'?api=1&title=0&byline=0&portrait=0&player_id=player" width="1000" height="568" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></li>';
                     if (get_field('video2', $id) != "") {
	                  echo '<li class="video-wrapper">
						  	<iframe id="player" src="http://player.vimeo.com/video/'.the_field('video2',$id).'?api=1&title=0&byline=0&portrait=0&player_id=player" width="1000" height="568" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></li>';   
                     }                  
                    
                    ?>

	                 <?php } ?>
                            
                    	<li>                            
                            <img src="<?php echo $full_img[0]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" /> 
                            <?php if ($attachment->post_excerpt) { ?>
	                            <p class="flex-caption">
	                            	<?php echo $attachment->post_excerpt; ?>
	                            </p>
                            <?php } ?>
	                    </li>   
                                      
	                         
                         <?php } ?>
                        
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- /flex-slider -->
            </div>
            <!-- /slider-wrap -->
   
</div><!-- /single-project -->
        
<div id="featured-content">
        
<div id="single-project-left" class="clearfix">
          
		<h2 class="excerpt">
			<?php if (get_field('question') != "") { 
			  	the_field('question');
		  	} else {
			  	echo get_the_excerpt(); 	
		  	} ?>  
	  	</h2>
                                      
        <?php the_content(); ?>
		
		<div class="featured-meta">     
			<?php 
			if (get_field('explore') != "") { 
			  	echo "<h3>Explore</h3><div class='explore'>";
			  	the_field("explore");
			  	echo "</div>";
			} 
			if (get_field('news') != "") { 
			  	echo "<h3>News</h3>";
			  	the_field("news");
			}
			if (get_field('awards') != "") { 
			  	echo "<h3>Awards</h3>";
			  	the_field("awards");
			} ?>
        </div>  
          
        <?php 
	  	if (get_field('pdf') != "") { 
		  	echo "<br /><a class='pdf' target='_blank' href='";
		  	the_field("pdf");
		  	echo "'>Download Project PDF</a>";
	  	} ?>
       
      <?php $blogs = get_posts( array('numberposts'=>5, 'post_type' => 'post', 'orderby' => 'date', 'category' => '282')  );
      if(!empty($blogs)) {
		  echo '<h3>Lab Blog Posts</h3>';
		      foreach($blogs as $blog) {
			      echo '<a href="'.get_site_url().'/'.$blog->post_name.'">'.$blog->post_title.'</a><br />';
		      }	 
	      echo '<a class="all-text" href="'.get_site_url().'/category/lab">See all lab blog posts →</a>';     
      } ?>
		
</div><!-- /single-project-left -->
        
<div id="single-project-right" class="clearfix">
    <?php 
  	if (get_field('quote1') != "") { 
	  	echo "<div class='pull-quote'><h3>";
	  	the_field("quote1");
	  	echo "</h3>";
		if (get_field('attrib1') != "") { 
		  	echo "<p>-";
		  	the_field("attrib1");
		  	echo "</p>";  
    	}
    	echo "</div>";
	} ?>
    	
  	<?php 
  	if (get_field('quote2') != "") { 
	  	echo "<div class='pull-quote'><h3>";
	  	the_field("quote2");
	  	echo "</h3>";
	  	if (get_field('attrib2') != "") { 
		  	echo "<p>-";
		  	the_field("attrib2");
		  	echo "</p>";
	  	}     
    	echo "</div>";
	} ?>

	<?php 
  	if (get_field('quote3') != "") { 
	  	echo "<div class='pull-quote'><h3>";
	  	the_field("quote3");
	  	echo "</h3>";
	  	if (get_field('attrib3') != "") { 
		  	echo "<p>-";
		  	the_field("attrib3");
		  	echo "</p>";
	  	}     
		echo "</div>";
	} ?>
    	
<div class="featured-meta">
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

$all_posts = array_merge( $lab_posts, $labblog_posts );

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
		  echo '<div class="video-wrapper"><video id="related_lab" width="200" >
			<source src="'.$first_vid.'" type="video/mp4">
			</video><span class="awesome-icon-play"></span></div></a>';
		}
	
		if (($output != '1') || (strlen(strstr($agent,"Firefox")) > 0)) {	
			echo '<img src="'.$image_url[0].'"/></a>';
		}
			echo '<div class="related-caption">';
		if(!empty($value)) { 
			echo '<a target="_blank" href="'. $value.'">';
		} else {
			echo '<a href="'.$site_url.'/'.$image->post_name.'">';
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
		  	</div>
    	</div>
    </div>
</article>

<?php endwhile; ?>
<?php endif; ?>	

<script type="text/javascript" src="http://a.vimeocdn.com/js/froogaloop2.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/video.min.js"></script>
<script>
    videojs.options.flash.swf = "<?php echo get_template_directory_uri(); ?>/js/video-js.swf";
</script>

<script type="text/javascript">

jQuery(function($){
	$(document).ready(function(){
	
		jQuery('.related-item').hover(function() {
			jQuery(this).find('.awesome-icon-play').fadeOut();
			var myVideo = jQuery(this).find('video#related_lab')[0];
			myVideo.play();
		},
		function() {
			jQuery(this).find('.awesome-icon-play').fadeIn();
			var myVideo = jQuery(this).find('video#related_lab')[0];
			myVideo.pause();
		});
		
	});
});
</script>

<?php get_footer(); ?>