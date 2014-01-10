<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
Template Name Posts: Featured Template
*/
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>   

<header id="page-heading">
	<h1 class="pagetitle">
		<a href="<?php echo get_site_url(); ?>/work">Our Work</a>
	</h1>
	<div class="all-projects">
		<a href="<?php echo get_site_url(); ?>/work">Back to all projects</a>
	</div>
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
                            
                    <?php if (($imgsize['width'] == 590) || ($attachment->ID == $feat_id && get_field('video', $id) != "")) { 
                    
                    $count = 0;
                     } ?>
                    
                    
                    <?php if (($imgsize['width'] != 590) || ($attachment->ID != $feat_id && get_field('video', $id) == "")) { ?>
                    
                    <!-- if adding second video remember jquery for img placeholder -->        
	                <?php if ($count == $video_order && get_field('video', $id) != "") { ?>   
                    <?php
                    if(get_field('video_img', $id) != "") {
	                	$thumb_id = get_field('video_img', $id);    
                    }
                    else {
						$thumb_id = get_post_thumbnail_id($id);   
                    }
                    $feat_img = wp_get_attachment_image_src( $thumb_id, 'slider');
                     $video = get_post_custom_values("video");
						  	echo '<li class="video-wrapper">
						  	<img class="placeholder" src="'. $feat_img[0].'"/><span id="button" class="awesome-icon-play"></span>
						  	<iframe id="player" src="http://player.vimeo.com/video/'.$video[0].'?api=1&title=0&byline=0&portrait=0&player_id=player" width="1000" height="568" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></li>';
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

        
        </div>
        <!-- /single-project-left -->
        
        <div id="featured-content">
        
        <div id="single-project-excerpt">
		<h2 class="excerpt-title"><?php the_title(); ?></h2>
			<div class="excerpt-content">
				<h3 class="excerpt">
				<?php 
				if (get_field('question') != "") { 
				  	the_field('question');
			  	} 
			  	else {
				  	echo get_the_excerpt(); 	
			  	} ?>  
			  	</h3>
		        <p><?php $string = get_the_content(); 
		        if(strlen($string) > 700) {
			    if(get_field('lobby_excerpt') != '') {
			        the_field('lobby_excerpt');
		        } else {
	 		        echo substr($string,0,690);   
		        }    
		        }
		        else {
	 		        echo substr($string,0,690);   
		        }  
		        ?>
		        </p>
			</div>
        </div>
        
        <div id="single-project-left" class="clearfix">
          
			<h2 class="excerpt">
			<?php 
			if (get_field('question') != "") { 
			  	the_field('question');
		  	} 
		  	else {
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
				}?>
		<!--
	<?php 
				if (get_field('news') != "") { 
				echo "<h3>News</h3>";
				the_field("news");
				}?>
			        <?php 
				if (get_field('awards') != "") { 
				echo "<h3>Awards</h3>";
				the_field("awards");
				}?>
-->
			</div>    
			 <?php 
				if (get_field('pdf') != "") { 
				echo "<br /><a class='pdf' target='_blank' href='";
				the_field("pdf");
				echo "'>Download Project PDF</a>";
				}?>
		</div><!-- /single-portfolio-left -->
        
    <div id="single-project-right" class="clearfix">
<!--
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
-->
	<div class="featured-meta">     
			<?php 
				if (get_field('news') != "") { 
				echo "<h3>News</h3>";
				the_field("news");
				}?>
			        <?php 
				if (get_field('awards') != "") { 
				echo "<h3>Awards</h3>";
				the_field("awards");
				}?>
			</div>      	
	<div class="featured-meta">
	<?php if (is_single('408') || is_single('409')) {
		  	echo '<h3 class="related">Additional Labs </h3>';
	  	$images = get_posts( array('post_type' => 'project', 'meta_key' => 'lab', 'meta_value' => '1', 'orderby' => 'rand', 'post__not_in' => array($post->ID), 'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'))  );
	  	if ( !empty($images) ) {
	foreach ( $images as $image ) { 
	setup_postdata( $image ); 
	
		$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($image->ID),'grid-thumb', true);
		$site_url = get_site_url();

	  /* 	$short = the_field("short"); */
		echo '<div class="related-item">';
		echo '<a href="'.$site_url.'/work/'.$image->post_name.'"><img src="'.$image_url[0].'"/></a>';
		echo '<div class="related-caption"><a href="'.$site_url.'/project/'.$image->post_name.'">';
	  	if (get_field('short', $image->ID) != "") { 
	  	the_field("short", $image->ID);
	  	}
	  	else { 
			echo $image->post_title;	  	
			 }		
		echo '</a></div></div>';
	}
}
}
	  	?>
	  	
	  	<?php if(!is_single('408') && !is_single('409')) { ?>
	  	
	  	<h3 class="related">Related Projects <a class="all" href="<?php echo get_site_url(); ?>/work">See all projects</a></h3>
	  	
<?php 

	$tags = get_the_terms($post->ID, 'project_cats');

	$tag_ids = array();
	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
	if(is_single(3226)){
		$posts_per_page = 6;
	}
	else {
		$posts_per_page = 4;	
	}

	$images = get_posts( array('posts_per_page'=>$posts_per_page, 'post_type' => 'project', 'orderby' => 'rand', 'tax_query' => array(
		array(
			'taxonomy' => 'project_cats',
			'field' => 'ID',
			'terms' => $tag_ids
		)
	),'post__not_in' => array($post->ID), 'caller_get_posts' => 1)  );
		
if ( !empty($images) ) {
	foreach ( $images as $image ) { 
	setup_postdata( $image ); 
	$rtags = wp_get_post_tags($image->ID);
		$rtagsarray = array();
		foreach ($rtags as $tag) {
			$rtagsarray[] = $tag->name;
		}
		$rtagslist = implode(', ', $rtagsarray);
		$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($image->ID),'grid-thumb', true);
		$site_url = get_site_url();

	  /* 	$short = the_field("short"); */
		echo '<div class="related-item">';
		echo '<a href="'.$site_url.'/work/'.$image->post_name.'"><img src="'.$image_url[0].'"/></a>';
		echo '<div class="related-caption"><a href="'.$site_url.'/project/'.$image->post_name.'">';
	  	if (get_field('short', $image->ID) != "") { 
	  	the_field("short", $image->ID);
	  	}
	  	else { 
			echo $image->post_title;	  	
			 }		
		echo '</a></div></div>';
	}
}
}
?>

	  	</div>
    	</div>
    </div>
  </div>

</article>

<?php endwhile; ?>
<?php endif; ?>	

<?php get_footer(); ?>