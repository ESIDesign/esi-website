<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
Template Name Posts: Not Featured Template
*/
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>   
<!-- <div id="dvLoading"></div> -->

<header id="page-heading">
	<h1 class="pagetitle"><a href="<?php echo get_site_url(); ?>/work">Our Work</a></h1>
	<div class="all-projects"><a href="<?php echo get_site_url(); ?>/work">Back to all projects</a></div>
</header>

<div id="single-project" class="post full-width clearfix">
<div class="nf-loading"></div>
<div id="not-featured">
   
   <div class="title">
	   <div class="band">
	       <h1><?php if (get_field('short') != "") { 
			   the_field("short");
		} else { 
			the_title(); 
		} ?></h1>
	   </div>
	   <div class="triangle"></div>
   </div>
   
    <div id="slider-wrap">
        <div class="flexslider clearfix">
        <ul class="slides">
          <?php $id = get_the_ID();
            $args = array(
                'orderby' => 'menu_order',
				'order' => 'ASC',
				'post_type' => 'attachment',
				'post_parent' => $id,
				'post_mime_type' => 'image',
				'post_status' => null,
				'posts_per_page' => -1
            );
            $attachments = get_posts($args);
			
			//attachments count
			$attachments_count = count($attachments);
		
            $count = 0;
            //start loop
            foreach ($attachments as $attachment) :
            $count++;
            //get images
            $notfeat_img = wp_get_attachment_image_src( $attachment->ID, 'notfeat-project');
            $proj_img = wp_get_attachment_image_src( $attachment->ID, 'archive-project');   ?>
               
          
					<?php if ($count == '1') { ?>   
               
                <li>          
                
				<?php 
			  	if (get_field('video') != "") { 
			  	echo '<div class="mosaic1"><iframe id="mosaic_player" src="http://player.vimeo.com/video/';
			  	echo get_field('video');
			  	echo '?api=1&title=0&byline=0&portrait=0&player_id=player" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
                $count++;
                }
                else { ?>
      
                <img class="mosaic<?php echo $count; ?>" src="<?php echo $notfeat_img[0]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" />

                <?php } ?>

                <?php } ?>
      
                <?php if ($count == '2') { ?>                         
                <img class="mosaic<?php echo $count; ?>" src="<?php echo $proj_img[0]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" /> 

                 <?php } ?>   
                 
                <?php if ($count == '3' && get_field('video') == "") { ?>                         
                <img class="mosaic<?php echo $count; ?>" src="<?php echo $proj_img[0]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" /> 

                </li>
                 <?php } ?>   
            
            
            <?php if ($attachments_count >= 6 && get_field('video') == "") { ?>
                <?php if ($count == '4') { ?>   
                <li>                            
                <img class="mosaic1" src="<?php echo $notfeat_img[0]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" />
                <!--
<?php if ($attachment->post_excerpt) { ?>
                <p class="flex-caption"><?php echo $attachment->post_excerpt; ?></p>
                <?php } ?>
-->
                <?php } ?>
      
                <?php if ($count == '5') { ?>                         
                <img class="mosaic2" src="<?php echo $proj_img[0]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" /> 
               <!--
<?php if ($attachment->post_excerpt) { ?>
                <p class="flex-caption"><?php echo $attachment->post_excerpt; ?></p>
                <?php } ?>
-->
                 <?php } ?>   
                 
                <?php if ($count == '6') { ?>                         
                <img class="mosaic3" src="<?php echo $proj_img[0]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" /> 
                <!--
<?php if ($attachment->post_excerpt) { ?>
                <p class="flex-caption"><?php echo $attachment->post_excerpt; ?></p>
                <?php } ?>
-->
                </li>
                 <?php } ?> 
         <?php   } ?>
            
            <?php endforeach; ?>
            </ul>
    </div><!-- /flex-slider -->
</div><!-- /slider-wrap -->
</div><!-- /not-featured -->
        
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
	if($loop->have_posts()) :
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
        endwhile; endif; wp_reset_query();
  	if (get_field('awards') != "") { 
  		echo "<h3>Awards</h3>";
  		the_field("awards");
  	}
  	if (get_field('pdf') != "") { 
  		echo "<br /><a class='pdf' target='_blank' href='";
  		the_field("pdf");
  		echo "'>Download Project PDF</a>";
  	} ?>
    </div><!-- /featured-meta -->
        
</div><!-- /single-project-left -->
        
<div id="single-project-right" class="clearfix featured-meta">

	<h3 class="related">Related Projects <a class="all" href="<?php echo get_site_url(); ?>/work">See all projects</a></h3>
	  	
<?php 

	$tags = wp_get_post_tags($post->ID);

	$tag_ids = array();
	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

	$images = get_posts( array('posts_per_page'=>4, 'post_type' => 'project', 'orderby' => 'rand', 'tag__in' => $tag_ids,'post__not_in' => array($post->ID))  );
			
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
		
		echo '<div class="related-item">';
		echo '<a href="'.$site_url.'/work/'.$image->post_name.'"><img src="'.$image_url[0].'"/></a>';
		echo '<div class="related-caption"><a href="'.$site_url.'/project/'.$image->post_name.'">';
	  	if (get_field('short', $image->ID) != "") { 
	  		the_field("short", $image->ID);
	  	} else { 
			echo $image->post_title;	  	
		}		
		echo '</a></div></div>';
	}
} ?>
</div><!-- /single-project-right -->
</div><!-- /single-project -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>