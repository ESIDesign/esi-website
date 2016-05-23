<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
$options = get_option( 'adapt_theme_settings' );
if(!is_single(2844)) { ?>
</div><!-- /main -->
<?php } ?>
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

<!-- WP Footer -->
<?php wp_footer(); ?> 
</body>
</html>