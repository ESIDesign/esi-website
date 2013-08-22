<?php
require( 'http://www.esidesign.com/wp-blog-header.php' );
get_header();
?>

    <?php
        global $post;
        $args = array(
            'post_type' =>'project',
            'numberposts' => '3',
            'meta_query' => array(
                                array('key' => 'home',
                                      'value' => '1'
                                )
                            ),
            'orderby' => 'rand'
        );
        $portfolio_posts = get_posts($args);
    ?>
    <?php if($portfolio_posts) { ?>        

            <?php
            $count=0;
            foreach($portfolio_posts as $post) : setup_postdata($post);
            $count++;
            //get portfolio thumbnail
            $feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
            $feat_img2 = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb2');
            ?>
<?php
$category = get_the_category(); 

?>
            
            <?php if ($feat_img) {  ?>
            <!--
<div class="item" <?php if($count == '3') {  
            echo 'style="height:353px;';
            } else { echo 'style="height:170px;'; }?>>
-->
            
            <?php if ($count == '1') { ?>
            <div class="home_item3">
              <a href="<?php the_permalink(); ?>"><img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" />
                 <a href="<?php the_permalink(); ?>" class="project-overlay"><h3><?php echo the_title(); ?></h3></a>
                </a>
            </div>
            <?php } ?>
           <?php if ($count == '2') { ?>
           <div class="home_item4">
	            <a href="<?php the_permalink(); ?>"><img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" />
                        <a href="<?php the_permalink(); ?>" class="project-overlay"><h3><?php echo the_title(); ?></h3></a>
                </a>
           </div>

           <?php } ?>
           <?php if ($count == '3') { ?>
           <div class="home_item11">
	            <a href="<?php the_permalink(); ?>"><img src="<?php echo $feat_img2[0]; ?>" height="<?php echo $feat_img2[2]; ?>" width="<?php echo $feat_img2[1]; ?>" alt="<?php echo the_title(); ?>" />
                        <a href="<?php the_permalink(); ?>" class="project-overlay"><h3><?php echo the_title(); ?></h3></a>
                </a>
           </div>
            <?php } ?>
                <!--
<a class="caption <?php ucc_get_terms_list(); ?>"><?php echo $category[0]->cat_name; ?></a>
                </a>
-->

            <?php } ?>
            
            <?php
            endforeach; ?>
  	
    <?php } ?>