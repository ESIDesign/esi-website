<?php
// Our include
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');

// Our variables
$numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 1;
$page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 1;

query_posts(array(
    'post_type' =>'project',
    'meta_query' => array(
                        array('key' => 'lobby',
                              'value' => '1'
                        )
                    ),	
       'posts_per_page' => $numPosts,
       'paged'          => $page
));

// our loop
if (have_posts()) {
       while (have_posts()){
              the_post(); 
              $feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'archive-project');
	            $feat_img2 = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb2');
            ?>
		<a style="height:208px; width:337px;" href="<?php the_permalink(); ?>"><img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" />
	        <h3 class="project-overlay">
	        <?php if (get_field('short') != "") { 
		  	the_field("short");
		  	}
		  	else { 
		  	the_title();  	
		  	} ?></h3>
	  	</a>
     <?php  }
}
wp_reset_query();
?>