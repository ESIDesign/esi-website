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
$children = get_pages('post_type=careers&post_status=publish');
$id = get_the_ID();
if( $children ) {
echo '<br /><h2>Additional Career Opportunities</h2>';
		echo '<ul>';
			$args = array(  'post_type' => 'careers',
				            'post_status'=> 'publish',
  							'sort_order' => 'ASC',
  							'sort_column' => 'post_title',
							'hierarchical' => 0,
							'exclude' => $id 
 						);
				$mypages = get_pages($args);
				foreach( $mypages as $page ) {    
						
					echo '<li><a href="'.get_permalink($page->ID).'">'.$page->post_title.'</a></li>';

						}
				echo '</ul>';	

}
		?>
</article>
<?php endwhile; ?>
<?php endif; ?>



<script type="text/javascript">
jQuery(function($){
	$(document).ready(function(){
var paras = $('img.about').hide(),
    i = 0;

// If using jQuery 1.3 or lower, you need to do $(paras[i++] || []) to avoid an "undefined" error
(function() {
  $(paras[i++]).fadeIn(300, arguments.callee);
})();
});
});
</script>


<?php get_footer(); ?>