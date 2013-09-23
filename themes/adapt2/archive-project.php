 <?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>
<?php get_header(); ?>
<?php $args = array(
            'post_type' =>'project',
            'post_status'=>'publish', 
            'meta_key' => 'date',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        ); ?>
<?php query_posts ($args); ?>
<?php if (have_posts()) : ?>

<header id="page-heading">
	<?php $post = $posts[0]; ?>
	<h1 class="pagetitle">Our Work</h1>

</header><!-- END page-heading -->

<div id="post" class="full-width clearfix"> 
	   
	   <div class="project-drop"> 
        <h2 class="project_dropdown">Filter by: <span class="project_name">All Projects </span><span class="awesome-icon-caret-down">&nbsp;</span></h2>
 <?php 
		//get project categories
		$cats = get_terms('project_cats');
		//show filter if categories exist
		if($cats[0]) { ?>
        <!-- Project Filter -->
        <ul id="project-cats" class="filter">
            <li><a href="#" id="all" class="active" data-filter="*"><span><?php _e('All Projects', 'wpex'); ?></span></a></li>
            <?php
            foreach ($cats as $cat ) : ?>
            <li><a href="#" data-filter=".<?php echo $cat->slug; ?>"><span><?php echo $cat->name; ?></span></a></li>
            <?php endforeach; ?>
        </ul><!-- /project-cats -->
	<?php } ?>	 

</div>	    
	   
	    
	    <div id="projects_slider">
	    
	    <div class="loading"></div>
          
           
            <div id="slider-wrap">
                <div class="flexslider clearfix">
                    <ul class="slides">
                         <div class="blue_nug"></div>
                               <div class="triangle"></div>
 <?php
        global $post;
        $args2 = array(
            'post_type' =>'project',
            'numberposts' => '5',
            'meta_query' => array(
                                array('key' => 'featured',
                                      'value' => '1'
                                )
                            ),
            'orderby' => 'rand'
        );
       $attachments = get_posts($args2);
						
						//attachments count
						$attachments_count = count($attachments);
                    $count = 0;
                        //start loop
                        foreach ($attachments as $attachment) : setup_postdata($post);
            $count++;
            //get portfolio thumbnail
            $full_img = wp_get_attachment_image_src( get_post_thumbnail_id($attachment->ID), 'slider');?>
            
            		<li>   
            		            <div class="title">
           <div class="band">
	             <h1><?php if (get_field('short', $attachment->ID) != "") { 
							  the_field('short', $attachment->ID);
						  	} else {
							  	echo $attachment->post_title; 	
						  	} ?></h1>
           </div>
           </div>
                                     
	            <a href="<?php echo get_permalink($attachment->ID); ?>"><img src="<?php echo $full_img[0]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" /></a>
                            <?php if ($attachment->post_excerpt || get_field('slideshow_caption', $attachment->ID)) { ?>
                            <p class="flex-caption">
                            <?php if (get_field('slideshow_caption', $attachment->ID) != "") { 
							  the_field('slideshow_caption', $attachment->ID);
						  	} else {
							  	echo strip_tags($attachment->post_excerpt); 	
						  	} ?>  
                            </p>
                            <?php } ?>
                     </li>

	<?php endforeach; 
	wp_reset_postdata();
	?>
	
	
                    </ul>
                </div>
            </div>
	  	   
	   
	    </div>
	    
	  	    
<div class="project-content">  

<?php 
$count = 0;
while (have_posts()) : the_post();

$featured = get_post_meta(get_the_ID(), 'featured', true);
/* if($featured != '1') :  ADD BACK IN ENDIF */

$count++;
//get featured img
$feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'archive-project');

//get terms
$terms = get_the_terms( get_the_ID(), 'project_cats' );
?>  

<?php if($feat_img) { ?>
	<div class="item <?php if($terms) foreach ($terms as $term) echo $term->slug .' '; ?>">
	    <a href="<?php the_permalink(' ') ?>" class="project-thumbnail"><img src="<?php echo $feat_img[0]; ?>" alt="<?php echo the_title(); ?>" /></a>
		<div class="project-overlay">
		   <a href="<?php the_permalink(' ') ?>"><?php
		  	if (get_field('short') != "") { 
			  	echo "<h3>";
		  	the_field("short");
			  	echo "</h3>";
		  	}
		  	else { ?>
				<h3><?php the_title(); ?></h3>		  	
		  	<?php } ?>
		    </a>
		</div>
</div><!-- item -->
<?php } ?>
   
<?php endwhile; ?>                	     
	<?php pagination(); ?>
</div><!-- END project-content -->

</div><!-- END post -->

<?php endif; ?>

<!-- <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.bbq.js"> </script> -->
  <script type="text/javascript">

function filter_toggle() {
	$("ul.filter").toggle();
}

jQuery(function($){
	$(document).ready(function(){
var $container = $('.project-content');
/* 				$container.imagesLoaded(function(){ */
					$container.isotope({
						itemSelector: '.item'
					});
	
	$("#footer").hide();
	var paras = $('.item').hide(),
    i = 0;

(function() {
  $(paras[i++]).fadeIn(100, arguments.callee);
})();


$("h2.project_dropdown").click(function() {
	$("ul.filter").toggle();
});


});
});

</script>
<?php get_footer(); ?>