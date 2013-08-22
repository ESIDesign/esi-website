<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: TEST
 */
?>

<?php 
    query_posts('showposts=1&orderby=rand'); 
    the_post();
	$args = $args = array(
            'post_type' =>'project',
            'numberposts' => '1',
            'meta_query' => array(
                                array('key' => 'home',
                                      'value' => '1'
                                )
                            ),
            'orderby' => 'rand'
        );
	$rand_posts = get_posts( $args );
	
?>
<?php
	foreach( $rand_posts as $post ) :  setup_postdata($post);
	 $feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
        $feat_img2 = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb2');
?>

              <a href="<?php the_permalink(); ?>"><img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" />
                 <a href="<?php the_permalink(); ?>" class="project-overlay"><h3> <?php 
	  	if (get_field('short') != "") { 
	  	the_field("short");
	  	}
	  	else { 
	  	the_title();  	
	  	 } ?></h3></a>
                </a>
<?php endforeach; ?>