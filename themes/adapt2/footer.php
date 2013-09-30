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

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.kinetic.min.js"></script>
<script type="text/javascript">
jQuery(function($){
	$(document).ready(function(){
	
	if ( $(window).width() > 1400) {
		$('body').kinetic(); 
		
	var timeout;
    $(document).on("mousemove keydown click", function() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
             window.location = "<?php echo get_site_url(); ?>"; 
        }, 60 * 3000);
    }).click();
	
	}

	if ( $(window).width() < 1600) {

		if($('body').hasClass('page-template-template-blog-php')){
			$('.loop-entry a').removeAttr('data-ob', 'lightbox');
			$('.loop-entry a').removeAttr('rel', 'lightbox');
			$('.loop-entry a').removeAttr('data-ob_iframe', 'true');	
	}
	
	    var user = 'esidesign';
	      
	    // using jquery built in get json method with twitter api, return only one result
			$.getJSON('/twitterproxy.php?url='+encodeURIComponent('statuses/user_timeline.json?screen_name=esidesign&count=1'), function(data)      {
	        // result returned
		        var tweet = data[0].text;
		      
		        // process links and reply
		        tweet = tweet.replace(/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig, function(url) {
		            return '<a href="'+url+'">'+url+'</a>';
		        }).replace(/B@([_a-z0-9]+)/ig, function(reply) {
		            return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
		        });
		        // output the result
		        $(".tweet p").html(tweet);
			});
	}
	});
});
</script> 

<!-- WP Footer -->
<?php wp_footer(); ?> 
</body>
</html>