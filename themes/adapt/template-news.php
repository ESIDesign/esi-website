<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: News
 */
get_header(); ?>

<div id="post" class="post clearfix archive-post news"> 

<header id="page-heading">
	<h1 class="blog-title">In The News</h1>
</header>
<div class="blog-content">  
 <?php
    global $post;
    $args = array(
        'post_type' =>'news',
        'orderby' => 'date',
        'order' => 'ASC',
        'posts_per_page' => -1
    );
   $posts = get_posts($args);
        $count = 0;
        foreach ($posts as $post) : setup_postdata($post);
        $count++;
	$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'grid-thumb'); 
	$projects = get_the_terms( $post->ID, 'project' );
	$project_ids = array();
	foreach ($projects as $project) {
		$project_ids[] = $project->term_id;
	} ?>
<div class="loop-entry">
	<?php if(!$thumb) {
		$attachment_args = array(
		'posts_per_page' => 1,
		'orderby'=> 'rand',
		'post_mime_type' => 'image',
		'post_parent' => $project_ids[0],
		'post_type' => 'attachment'
		);
		$attachments = get_posts($attachment_args);
		if(!empty($attachments)) {
			$thumb = wp_get_attachment_image_src($attachments[0]->ID, 'grid-thumb');	
		}
		} ?>
    	<?php if($count < 5) { ?>
    	<a target="_blank" href="<?php the_permalink(' ') ?>" class="loop-entry-thumbnail"><img src="<?php echo $thumb[0]; ?>" alt="<?php echo the_title(); ?>" /></a>
    	<?php } ?>
	<div class="text">
	<?php $source_text = get_field('source',$post->ID);
		if($source_text) {
		echo '<p class="date gray">';
		the_field('source',$post->ID);
		echo '</p>';
	} 
	$results = search($sources, 'source', $source_text);
	$logo = $results[0]['logo_id'];
	if($logo) {
		$logo_img = wp_get_attachment_image_src($logo, 'small');
		echo '<img class="logo" src="'.$logo_img[0].'" alt="'.$source_text.'" />';
	}
	?>
	<?php $link = get_field('link',$post->ID); 
		if($link == '') {
			$link = get_field('archive',$post->ID);	
			$link = $link['url'];
		}
	?>
	<h3><a target="_blank" href="<?php echo $link; ?>"> 
	<?php echo the_title(); ?></a></h3>
	<?php $project_title = get_the_title($project_ids[0]); ?>
	<div class="loop-entry-meta">
		<?php if($projects) { ?>
	<a class="all" href="">More on <?php echo $project_title; ?></a>
	<?php } ?>
	</div>
	</div>
</div>
        				       					
	<?php endforeach; 
	wp_reset_postdata(); ?>  
</div>            	     
<!-- END post -->
</div>

<?php get_sidebar(); ?>
   <script src='http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js'></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/video.min.js"></script>
<script>
    videojs.options.flash.swf = "<?php echo get_template_directory_uri(); ?>/js/video-js.swf";
</script>

<script type="text/javascript">
/*
function filter_toggle() {
	$("ul.filter").toggle();
}
*/

/*
jQuery(function($){
	$(window).load(function(){
		function blogIsotope() {
			var $container = $('.blog-content');
			$container.isotope({
				itemSelector: '.loop-entry'
			});
		} 
		
		blogIsotope();
		
		$("h2.dropdown").click(function() {
			$("ul.filter").toggle();
		});	
				
		window.onresize = function() {
		    blogIsotope();
		};
	});
	
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
*/
</script>
<?php get_footer(); ?>