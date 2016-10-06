<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: Press
 */
get_header(); ?>

<div id="post" class="post clearfix archive-post news"> 

<header id="page-heading">
	<h1 class="blog-title">Press Releases</h1>
</header>
<div class="blog-content">  
 <?php
    global $post;
    $args = array(
        'post_type' =>'press',
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
	<?php if($thumb && $count <5) { ?>
	<a target="_blank" href="<?php the_permalink(' ') ?>" class="loop-entry-thumbnail"><img src="<?php echo $thumb[0]; ?>" alt="<?php echo the_title(); ?>" /></a>
	<?php } if(!$thumb) { 
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
	<div class="text">
	<?php
		echo '<p class="date gray">';
		echo the_time('F j, Y');
		echo '</p>';
	?>
	<h3><a target="_blank" href="<?php the_permalink(get_the_ID()); ?>"> 
	<?php echo the_title(); ?></a></h3>
	</div><!-- END text -->
</div><!-- END loop-entry -->
        				       					
	<?php endforeach; 
	wp_reset_postdata(); ?>  
</div><!-- END post -->
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>