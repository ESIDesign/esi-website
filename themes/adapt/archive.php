<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>
<?php get_header(); ?>
<?php if (have_posts()) : ?>

<div id="post" class="post clearfix archive-post"> 

<header id="page-heading">
	<?php $post = $posts[0]; ?>
	<?php if(is_page(837)) { ?>
	<h1 class="blog-title"><span class="yellow">Read Our Minds</span></h1>	
	<?php } if (is_category()) { ?>
	<h1><span class="yellow"><?php single_cat_title(); ?></span></h1>
	<?php } elseif( is_tag() ) { ?>
	<h1><span class="yellow">Posts tagged &quot;<?php single_tag_title(); ?>&quot;</span></h1>
	<?php  } elseif (is_day()) { ?>
	<h1><span class="yellow">Archive for <?php the_time('F jS, Y'); ?></span></h1>
	<?php  } elseif (is_month()) { ?>
	<h1><span class="yellow">Archive for <?php the_time('F, Y'); ?></span></h1>
	<?php  } elseif (is_year()) { ?>
	<h1><span class="yellow">Archive for <?php the_time('Y'); ?></span></h1>
	<?php  } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	<h1><span class="yellow">Blog Archives</span></h1>
	<?php } ?>
<?php if(is_page(837)) { ?> 
<div class="drop"> 
        <h2 class="dropdown">Filter by: <span class="name">All Posts </span><span class="awesome-icon-caret-down">&nbsp;</span></h2>
 <?php $cats = get_terms('category');
		//show filter if categories exist
		if($cats[0]) { ?>
        <!-- Blog Filter -->
        <ul id="blog-cats" class="filter">
            <?php
            foreach ($cats as $cat ) : ?>
            <li><a href="#" data-filter=".<?php echo $cat->slug; ?>"><span><?php echo $cat->name; ?></span></a></li>
            <?php endforeach; ?>
            <li><a href="#" id="all" class="active" data-filter="*"><span><?php _e('All Posts', 'wpex'); ?></span></a></li>
        </ul><!-- /blog-cats -->
	<?php } ?>	 
</div>	
<?php query_posts(
            array(
            'post_type'=> 'post',
            'paged'=>$paged
        ));
}  ?>
</header>
<!-- END page-heading -->

<div class="blog-content">  
	<?php get_template_part( 'loop' , 'entry') ?>    
</div>            	     
	<?php pagination(); ?>
</div>
<!-- END post -->
<?php endif; ?>
<?php get_sidebar(); ?>
<!--
   <script src='http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js'></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/video.min.js"></script>
<script>
    videojs.options.flash.swf = "<?php echo get_template_directory_uri(); ?>/js/video-js.swf";
</script>

<script type="text/javascript">
jQuery(function($){
	
	$(document).ready(function(){
	
		jQuery('.video-wrapper').hover(function() {
			jQuery(this).find('.awesome-icon-play').fadeOut();
			var myVideo = jQuery(this).find('video#related_lab')[0];
			myVideo.play();
		},
		function() {
			jQuery(this).find('.awesome-icon-play').fadeIn();
			var myVideo = jQuery(this).find('video#related_lab')[0];
			myVideo.pause();
		});
		
	});
});
</script>
-->
<?php get_footer(); ?>