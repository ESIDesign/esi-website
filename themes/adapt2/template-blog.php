<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: Blog
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<header id="page-heading">
	<h1><span class="yellow">Read Our Minds</h1>		
</header>

<div class="post clearfix">

<?php
    //query posts
        query_posts(
            array(
            'post_type'=> 'post',
            'paged'=>$paged
        ));
    ?>
	<?php if (have_posts()) : ?>              
        	<?php get_template_part( 'loop', 'entry') ?>                	
    <?php endif; ?>       
	<?php pagination(); wp_reset_query(); ?>

</div>
<!-- /post -->

<?php endwhile; ?>
<?php endif; ?>

<script type="text/javascript">
jQuery(function($){
var footer = document.getElementsByTagName('body')[0];
var js = document.createElement("script");

js.type = "text/javascript";
    if($(window).width() > 1900) {
        js.src = '<?php echo get_template_directory_uri(); ?>/js/orangebox.js';
    }
footer.appendChild(js);    
/*
$('.loop-entry').hide();
		var paras = $('.loop-entry').hide();
		function load(){
		i = 0;
		(function() {
		  $(paras[i++]).fadeIn(200, arguments.callee);
		})();	
		}
*/
	$(document).ready(function(){
		var paras = $('.loop-entry').hide();
		i = 0;
		(function() {
		  $(paras[i++]).fadeIn(200, arguments.callee);
		})();	
/*
		yepnope([{
		    test: $(window).width() > 1900, // devices 768 and up
		    yep: "<?php echo get_template_directory_uri(); ?>/js/orangebox.js",
		    callback: load(),
		    complete: console.log('loaded'),
		}]);
*/
	});
});
</script>
<?php get_footer(); ?>