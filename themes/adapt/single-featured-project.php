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
	           <?php
			    if (get_field('short') != "") { 
				   echo '<h1>'.get_field("short").'</h1>';
	  			}
	  			else {
		  			$title = get_the_title(); 
		  			if(strlen($title) > 37) { 
		  				echo '<h1 style="font-size:34px">'.get_the_title().'</h1>';  
		  			} else {
			  			echo '<h1>'.get_the_title().'</h1>';
		  			}	
		  		} ?>
           </div>
           <div class="triangle"></div>
       </div>
           
        <div id="slider-wrap">
            <div class="flexslider clearfix">
                <ul class="slides">
                                  
                <?php   
                	$id = get_the_ID();
                	if(get_field('video', $id) != "" && get_field('video_img', $id) == "") {
						$exclude_id = get_post_thumbnail_id($id);
					} else {
						$exclude_id = '';
					}
                	
                	$feat_id = get_post_thumbnail_id( $id ); 

                    $args = array(
                        'orderby' => 'menu_order',
						'order' => 'ASC',
						'post_type' => 'attachment',
						'post_parent' => $id,
						'post_mime_type' => 'image',
						'posts_per_page' => -1,
// 						'exclude' => $exclude_id,
/*
						'meta_query' => array(
					       array(
					           'key' => 'not_in_carousel',
					           'value' => 1,
					           'type' => 'numeric',
					           'compare' => 'NOT EXISTS',
					       )
					   )
*/
                    );
                $attachments = get_posts($args);
				if (get_field('video_order', $id) != "") { 
	                $video_order = get_field('video_order', $id);
                }
                if(get_field('video_order') == "") { 
                    $video_order = 1;
                }  	
				$attachments_count = count($attachments);
                $count = 0;

                foreach ($attachments as $attachment) :
                    $count++;
                    $full_img = wp_get_attachment_image_src( $attachment->ID, 'slider');
                    $imgsize = wp_get_attachment_metadata($attachment->ID); 
                    $feat_id = get_post_thumbnail_id( $id ); 
                    $alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
                        
					if (($imgsize['width'] == 590) || ($attachment->ID == $feat_id && get_field('video', $id) != "")) { 
						$count = 0;
                 }  
                 if (($imgsize['width'] != 590) || ($attachment->ID != $feat_id && get_field('video', $id) == "")) { ?>
                
                <!-- if adding second video remember jquery for img placeholder -->        
                <?php if ($count == $video_order && get_field('video', $id) != "") {
                if(get_field('video_img', $id) != "") {
                	$thumb_id = get_field('video_img', $id);   
                } else {
					$thumb_id = get_post_thumbnail_id($id);   
                }
                if($thumb_id == 3894) {
                   $thumb_id = 3784; 
                }
                if($video_order == 1) {
	                $autoplay = 0;
                } else {
	                $autoplay = 0;
                }
                $feat_img = wp_get_attachment_image_src( $thumb_id, 'slider');
                $video = get_field('video',$id);
                $video2 = get_field('video2',$id);
					echo '<li class="video-wrapper">
					<img class="placeholder" src="'. $feat_img[0].'"/><span id="button" class="awesome-icon-play"></span>
					<iframe id="player"';
					if($video_order == 1) {
	                	echo 'class="autoplay"';
                	}
					echo 'src="http://player.vimeo.com/video/'.$video.'?api=1&title=0&byline=0&portrait=0&player_id=player&autoplay='.$autoplay.'" width="1000" height="568" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></li>';
/*
			  	if($video2) {
					echo '<li class="video-wrapper">
					<img class="placeholder" src="'. $feat_img[0].'"/><span id="button" class="awesome-icon-play"></span>
					  	<iframe id="player" src="http://player.vimeo.com/video/'.$video2.'?api=1&title=0&byline=0&portrait=0&player_id=player" width="1000" height="568" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></li>';   
                 } 
*/      
                ?>

                 <?php } ?>
                        
                	<li>                            
                        <img src="<?php echo $full_img[0]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" /> 
                        <?php if ($attachment->post_excerpt) { ?>
                            <p class="flex-caption">
                            	<?php echo $attachment->post_excerpt; ?>
                            </p>
                        <?php } if($alt && $id == 4682) { ?>
                        	<p class="flex-alt">
                            	<?php echo $alt; ?>
                        	</p>
                        <?php } ?>
                    </li>               
                         
                     <?php } ?>
                    
                    <?php endforeach; ?>
                </ul>
            </div><!-- /flex-slider -->
    </div><!-- /slider-wrap -->
    </div><!-- /single-project full-width -->
        
    <div id="featured-content">
    
    	<div id="single-project-left" class="clearfix">
      
		<?php if (get_field('question') != "") { 
		  	echo '<h2 class="excerpt">';
		  	the_field('question');
		  	echo '</h2>';
	  	} ?>               
        
        <?php the_content(); ?>
		<div class="featured-meta">     
			<?php if (get_field('explore') != "") { 
				echo "<h3>Explore</h3><div class='explore'>";
				the_field("explore");
				echo "</div>";
			}
	
			$id = get_the_id();
			$post_news = get_post($id);
	
		    $args = array('post_type' => 'news',
		        'tax_query' => array(
		            array(
		                'taxonomy' => 'project',
		                'field' => 'slug',
		                'terms' => $post_news->post_name,
		            ),
		        ),
		     );
			
		     $loop = new WP_Query($args);
		     if($loop->have_posts()) {
			    echo "<h3>News</h3>";
			    while($loop->have_posts()) : $loop->the_post();
				    echo '<p>';
				    if(get_field('link') != "") {
					    echo '<a target="_blank" href="'.get_field('link').'">';
					}
			        if(get_field('source') != "") {
				        echo '<strong>'.get_field('source').'</strong>: ';
			        }
			        	echo '<span style="font-weight: 500 !important;">'.get_the_title().'</span>';
					if(get_field('link') != "") {
					    echo '</a>';
					}
					echo '</p>';
		        endwhile;
		     }
	        wp_reset_query();
			
			
			if (get_field('awards') != "") { 
				echo "<h3>Awards</h3>";
				the_field("awards");
			} ?>
		</div>    
		
		<?php if (get_field('pdf') != "") { 
				echo "<br /><a class='pdf' target='_blank' href='";
				the_field("pdf");
				echo "'>Download Project PDF</a>";
		} ?>
	</div><!-- /single-project-left -->
        
    <div id="single-project-right" class="clearfix">
     	
	<div class="featured-meta">
	<?php if (is_single('408') || is_single('409')) {
		echo '<h3 class="related">Additional Labs </h3>';
	  	$images = get_posts( array('post_type' => 'project', 'orderby' => 'rand', 'post__not_in' => array($post->ID), 'post_status' => 'publish')  );
	  	if ( !empty($images) ) {
	  		foreach ( $images as $image ) { 
		  		setup_postdata( $image ); 
		  		$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($image->ID),'grid-thumb', true);
		  		$site_url = get_site_url();
	
				echo '<div class="related-item">';
				echo '<a href="'.$site_url.'/work/'.$image->post_name.'"><img src="'.$image_url[0].'"/></a>';
				echo '<div class="related-caption"><a href="'.$site_url.'/work/'.$image->post_name.'">';
			  	if (get_field('short', $image->ID) != "") { 
			  		the_field("short", $image->ID);
			  	}
			  	else { 
					echo $image->post_title;	  	
					 }		
				echo '</a></div></div>';
			}
		}
	} ?>

  	<?php if(is_single(2844)) { 
  		get_sidebar('lab');
  	} ?>
	  	
	<?php if(!is_single('408') && !is_single('409') && !is_single(2844)) { ?>
	  	
	  	<h3 class="related">Related Projects <a class="all" href="<?php echo get_site_url(); ?>/work">See all projects</a></h3>
	  	
<?php $tags = get_the_terms($post->ID, 'project_cats');

	$tag_ids = array();
	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
	if(is_single(3226)){
		$posts_per_page = 6;
	}
	else {
		$posts_per_page = 4;	
	}
	$featured = get_post_meta($post->ID, 'featured', true);
	if($featured == 1) {
		$featured_array = array('1');
	} else {
		$featured_array = array('1','0');
	}
	$images = get_posts( array('posts_per_page'=>$posts_per_page, 'post_type' => 'project', 'orderby' => 'rand', 'tax_query' => array(
		array(
			'taxonomy' => 'project_cats',
			'field' => 'ID',
			'terms' => $tag_ids
		)
	),
    'meta_query' => array(
        array('key' => 'featured',
              'value' => $featured_array,
              'compare' => 'IN'
        )
    ),
    'post__not_in' => array($post->ID), 'caller_get_posts' => 1)  );
		
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
		echo '<div class="related-caption"><a href="'.$site_url.'/work/'.$image->post_name.'">';
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
<?php if(!is_single(1884)) { ?>
		  	</div>
	  	<?php } ?>
    	</div>
    </div>
</div>

</article>

<?php endwhile; ?>
<?php endif; ?>	

<?php if(is_single(4682) || is_single(5764)) { ?>
<script type="text/javascript">
jQuery(function($){
(function($) {
    
  var allPanels = $('.accordion > dd').hide();
  var allParents = $('.accordion > dt > a');
    
  $('.accordion > dt > a').click(function() {
      $this = $(this);
      $target =  $this.parent().next();
          
      if($target.hasClass('active')){
        $this.removeClass('active');
        $target.removeClass('active').slideUp(); 
      }else{
		allParents.removeClass('active');
        allPanels.removeClass('active').slideUp();
        $this.addClass('active');
        $target.addClass('active').slideDown();
      }
      
    return false;
  });

})(jQuery);
});
</script>
<?php } ?>

<?php if(is_single(2844)) { ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/video.min.js"></script>
<script>
    videojs.options.flash.swf = "<?php echo get_template_directory_uri(); ?>/js/video-js.swf";
</script>
<script type="text/javascript">
jQuery(function($){
	$(document).ready(function(){
	if($('body').hasClass('postid-2844')) {
		var myVideo = jQuery(this).find('video#related_lab')[0];
		$('.related-item').hover(function() {
			myVideo.play();
		},
		function() {
			myVideo.pause();
		});
	}
		
	});
});
<?php } ?>
</script>
<script type="text/javascript">
jQuery(function($){
	
	$(document).ready(function(){
  
	// Find all YouTube & Vimeo videos
	var $allVideos = $("iframe[src^='http://player.vimeo.com'], iframe[src^='//player.vimeo.com'], iframe[src^='http://www.youtube.com']"),
	
	// The element that is fluid width
	$fluidEl = $("#featured");
	
	// Figure out and save aspect ratio for each video
	$allVideos.each(function() {
	
	$(this)
	.data('aspectRatio', this.height / this.width)
	
	// and remove the hard coded width/height
	.removeAttr('height')
	.removeAttr('width');
	
	});
	
	// When the window is resized
	$(window).resize(function() {
	
	var newWidth = $fluidEl.width();
	
	// Resize all videos according to their own aspect ratio
	$allVideos.each(function() {
	
	var $el = $(this);
	$el
	.width(newWidth)
	.height(newWidth * $el.data('aspectRatio'));
	
	});
	
	// Kick off one resize to fix all videos on page load
	}).resize();
  });
  });
</script>

<?php get_footer(); ?>