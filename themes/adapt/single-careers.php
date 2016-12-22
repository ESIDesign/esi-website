<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: Career Listing
 */
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article class="post clearfix disc">    
   	<header>
	<p class="date"><?php the_time('F'); ?> <?php the_time('j'); ?>, <?php the_time('Y'); ?></p>
        <h1 class="single-title"><?php the_title(); ?></h1>
        <?php if (get_field('intro', 6) != "") { 
				  the_field('intro', 6);
			  	} ?>
   	</header>
    <?php the_content(); ?>
    
    <p><em>Please no phone calls or unscheduled appointments/walk-ins.</em></p>

<p>To be considered, please e-mail your cover letter and resume with the position as the subject to: <a href="mailto:recruit@esidesign.com?subject=<?php the_title(); ?>">recruit@esidesign.com</a></p>

<?php setPostViews(get_the_ID()); ?>
    
</article> 

<article class="post clearfix">
<?php
$id = get_the_ID();
	$args = array(  
		'post_type' => 'careers',
        'post_status'=> 'publish',
		'sort_order' => 'ASC',
		'sort_column' => 'post_title',
		'hierarchical' => 0,
		'exclude' => $id 
	);
	$careers = get_pages($args);
	if($careers) {
		echo '<br /><h2>Additional Career Opportunities</h2>';
		echo '<ul>';
	foreach( $careers as $career ) {    		
		echo '<li><a href="'.get_permalink($career->ID).'">'.$career->post_title.'</a></li>';
	}
	echo '</ul><br /><br />';	
	}
	echo '<br /><h2 style="margin-bottom:1%">Don\'t see a role that fits your experience?</h3>Get in touch by emailing your cover letter and resume to <a href="mailto:recruit@esidesign.com">recruit@esidesign.com</a>.</p>';
?>
</article>
<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>