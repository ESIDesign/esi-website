<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
$options = get_option( 'adapt_theme_settings' );
?>
</div><!-- /main -->

    <div id="footer" class="clearfix">
         <div class="tweet"><p></p></div>
		<div id="footer-bottom" class="clearfix">
        
            <div id="copyright">
                &copy; <?php echo date('Y'); ?>  <?php bloginfo( 'name' ) ?>
            </div><!-- /copyright -->
            
			<?php dynamic_sidebar('footer-one'); ?>
        
            <?php dynamic_sidebar('footer-two'); ?>
        
        </div><!-- /footer-bottom -->
        
	</div><!-- /footer -->
    
</div><!-- wrap --> 

<script type="text/javascript">
jQuery(function($){

	if($(window).width() > 1900 || ($(window).width() > 1445 && $(window).width() < 1450)) {
		yepnope([{
		    test: $(window).width() > 1900 || ($(window).width() > 1445 && $(window).width() < 1450), 
		    yep: "<?php echo get_template_directory_uri(); ?>/js/jquery.kinetic.min.js",
		    complete: function() {$('body').kinetic();}
		}]);
	}
	
	
	yepnope([{
		    test: 769 >= screen.width, 
		    yep: "<?php echo get_template_directory_uri(); ?>/js/jquery.uniform.js",
	}]);
	
	yepnope([{
		    test: $(window).width() < 769, 
		    yep: "<?php echo get_template_directory_uri(); ?>/js/jquery.responsify.init.js",
	}]);
	$(document).ready(function(){

	});
});
</script> 

<!-- WP Footer -->
<?php wp_footer(); ?> 
</body>
</html>