<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>
<?php get_header(); ?>
		
		<div id="post" class="full-width clearfix">   
		<header id="page-heading">
			<h1 id="archive-title"><?php _e('Search results for', 'adapt'); ?> <span class="yellow"><?php the_search_query(); ?></span></h1>
		</header>
		
		<?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		query_posts($query_string .'&posts_per_page=10&paged=' . $paged.'&post_type=project');
		if (have_posts()) : ?>
        
		</div>
		<div class="search-left">
		<h2>Work</h2>
		<?php
		while (have_posts()) : the_post();
		//get featured img
		$feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
		?>  
		<div class="item">
			<?php if($feat_img) { ?>
		    	<a href="<?php the_permalink(' ') ?>" class="project-thumbnail"><img src="<?php echo $feat_img[0]; ?>" alt="<?php echo the_title(); ?>" /></a>
			<?php } else { ?>
				<a href="<?php the_permalink(' ') ?>" class="project-thumbnail">TEST</a>
			<?php } ?>
			<div class="project-overlay">
			<a href="<?php the_permalink(' ') ?>"><?php
	  	if (get_field('short') != "") { 
	  	echo "<h4>";
	  	the_field("short");
	  	echo "</h4>";
	  	}
	  	else { ?>
			<h4><?php the_title(); ?></h4>		  	
	  	<?php } ?>
	    </a></div>
		
		</div>
		<!-- loop-entry -->
		
		
		<?php endwhile; ?>                	     
			<?php pagination(); ?>
		</div>
		<!-- END post -->
		
		<?php else : ?>


        <div class="search-left">
        <h2>Work</h2>
            <?php _e('No work found for that query.', 'adapt'); ?>
        </div>
			<!-- /post  -->
		
		<?php endif; ?>
        
        
        
        
        		<?php
	        		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		query_posts($query_string .'&posts_per_page=10&paged=' . $paged.'&post_type=post');
		if (have_posts()) : ?>
        
            
		<div class="search-right">
		<h2>Blog</h2>
<!--
			<?php
while (have_posts()) : the_post();
//get featured img
$feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
?>  
-->

<article class="loop-entry clearfix">
	<p class="date"><?php the_time('F'); ?> <?php the_time('j'); ?>, <?php the_time('Y'); ?></p>
	<h2><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
    <?php
	//show meta only on blog posts
    if ( get_post_type() != 'page' || get_post_type() != 'project') { ?>
	<div class="loop-entry-meta">
        <p class="date"><?php _e('By', 'surplus'); ?> <a href="<?php echo get_site_url(); ?>/people"><?php the_author(); ?></a>
        <span class="awesome-icon-comments"></span> <?php comments_popup_link('0', '1', '%'); ?></p>
    </div>
    <!-- /loop-entry-meta -->
    <?php } ?>
	<?php the_excerpt(''); ?>
</article>
<!-- loop-entry -->

<!-- <?php endwhile; ?> -->
		</div>
		<!-- /post  -->
        
		<?php else : ?>
        
        <div class="search-right">
        <h2>Blog</h2>
            <?php _e('No entry found for that query.', 'adapt'); ?>
        </div>
			<!-- /post  -->
            
        <?php endif; ?>
        
        

<?php get_footer(); ?>