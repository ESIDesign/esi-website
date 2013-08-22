<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: Career
 */
?>test

<?php get_header(); ?>
test
    	  <!--
  <header id="page-heading">
        <h1><?php the_title(); ?></h1>		
    </header>
-->
    <!-- /page-heading -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article class="post clearfix">    
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>
    <!-- /post -->
    <?php
$children = get_pages('child_of=6');
if( $children ) {
echo '<h2>Current Opportunities</h2>';
		echo '<ul>';
			$args = array(  'child_of' => 6, 
  							'sort_order' => ASC,
  							'sort_column' => post_title,
							'hierarchical' => 0  
 						);
				$mypages = get_pages($args);
				foreach( $mypages as $page ) {    
						
					echo '<li><a href="'.get_permalink($page->ID).'">'.$page->post_title.'</a></li>';

						}
				echo '</ul>';	

}
else { 
 echo "<h3>There are no opportunities at this time.</h3>";
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