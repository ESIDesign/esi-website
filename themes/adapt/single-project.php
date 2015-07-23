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

  <nav id="project-nav" class="clearfix"> 
            <?php next_post_link('<div id="single-nav-left">%link</div>', '<span class="awesome-icon-chevron-left"></span> '.__('','adapt').'', false); ?>
            <?php previous_post_link('<div id="single-nav-right">%link</div>', ''.__('','adapt').' <span class="awesome-icon-chevron-right"></span>', false); ?>
        </nav>

<article>
    <div id="single-project" class="post full-width clearfix">
	    <div class="nf-loading"></div>
	    <div id="not-featured">
           
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
                        //attachement loop
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
                        $proj_img = wp_get_attachment_image_src( $attachment->ID, 'archive-project'); 

					     ?>
                           
                       

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
                </div>
                <!-- /flex-slider -->
            </div>
            <!-- /slider-wrap -->

        
        </div>
        <!-- /single-portfolio-left -->
        
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
	  	}?>
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
         <?php 
	  	if (get_field('pdf') != "") { 
	  	echo "<br /><a class='pdf' target='_blank' href='";
	  	the_field("pdf");
	  	echo "'>Download Project PDF</a>";
	  	}?>
        </div>
            
            
         <?php 
	  	if (get_field('pdf') != "") { 
	  	echo "<br /><a class='pdf' target='_blank' href='";
	  	the_field("pdf");
	  	echo "'>Download Project PDF</a>";
	  	}?>
        </div>
       
        <!-- /single-portfolio-right -->
        
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
    	}?>
    	
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
    	}?>
    	
    	
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
    	}?>
-->
    	
    	<div class="featured-meta">

	  	<h3 class="related">Related Projects <a class="all" href="<?php echo get_site_url(); ?>/work">See all projects</a></h3>
	  	
<?php 

	$tags = wp_get_post_tags($post->ID);

	$tag_ids = array();
	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

	$images = get_posts( array('posts_per_page'=>4, 'post_type' => 'project', 'orderby' => 'rand', 'tag__in' => $tag_ids,'post__not_in' => array($post->ID), 'caller_get_posts' => 1)  );
			
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
?>
	  	
	  	</div>
    	</div>
    </div>

</article>
<?php endwhile; ?>
<?php endif; ?>	
<!--
<script type="text/javascript" src="http://a.vimeocdn.com/js/froogaloop2.min.js"></script>
<script type="text/javascript">
		var iframe = $('#player')[0];
var player = $f(iframe);

// When the player is ready, add listeners for pause, finish, and playProgress
player.addEvent('ready', function() {
    setTimeout(function(){
  $('.title').animate({opacity: 1}, 1000)}, 800);
});
</script>
-->

<script type="text/javascript">
jQuery(function($){
	$(document).ready(function(){
		 $('#single-project-left a').attr('target', '_blank');
	
	});
});
</script>

<?php get_footer(); ?>