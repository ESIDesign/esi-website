<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: Portfolio
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<header id="page-heading" class="clearfix">
	<h1><?php the_title(); ?></h1>	
    <?php 
		//get portfolio categories
		$cats = get_terms('portfolio_cats');
		//show filter if categories exist
		if($cats[0]) { ?>
        
        <!-- Portfolio Filter -->
        <ul id="portfolio-cats" class="filter clearfix">
            <li><a href="#" class="active" data-filter="*"><span><?php _e('All', 'wpex'); ?></span></a></li>
            <?php
            foreach ($cats as $cat ) : ?>
            <li><a href="#" data-filter=".<?php echo $cat->slug; ?>"><span><?php echo $cat->name; ?></span></a></li>
            <?php endforeach; ?>
        </ul><!-- /portfolio-cats -->
	<?php } ?>	 
</header><!-- /page-heading -->
    
<div class="post full-width clearfix">

    <div id="portfolio-wrap" class="clearfix">
    	<div class="portfolio-content">
			<?php
            //get post type ==> portfolio
            query_posts(array(
                'post_type'=>'portfolio',
                'posts_per_page' => -1,
                'paged'=>$paged
            ));
            ?>
        
            <?php
			$count=0;
            while (have_posts()) : the_post();
			$count++;
			
            //get portfolio thumbnail
            $thumbail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
			
            //get terms
            $terms = get_the_terms( get_the_ID(), 'portfolio_cats' );
            
			//show item if thumbnail is defined
			if ( has_post_thumbnail() ) {  ?>
            <article class="portfolio-item <?php if($terms) foreach ($terms as $term) echo $term->slug .' '; ?>">
            	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                	<img src="<?php echo $thumbail[0]; ?>" height="<?php echo $thumbail[2]; ?>" width="<?php echo $thumbail[1]; ?>" alt="<?php echo the_title(); ?>" />
            		<div class="portfolio-overlay"><h3><?php echo the_title(); ?></h3></div><!-- portfolio-overlay -->
            	</a>
            </article>
            <?php } endwhile; ?>
		</div><!-- /portfolio-content -->
    </div><!-- /portfolio-wrap -->
    
	<?php wp_reset_query(); ?>

</div><!-- /post full-width -->

<?php
endwhile;
endif;
get_footer(); ?>