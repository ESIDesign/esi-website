<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
$options = get_option( 'adapt_theme_settings' );
?>
</div>
<!-- /main -->

    <div id="footer" class="clearfix">
         <div class="tweet"><p></p></div>
		<div id="footer-bottom" class="clearfix">
        
            <div id="copyright">
                &copy; <?php echo date('Y'); ?>  <?php bloginfo( 'name' ) ?>
            </div>
            <!-- /copyright -->
            
			<?php dynamic_sidebar('footer-one'); ?>
        
            <?php dynamic_sidebar('footer-two'); ?>
        
        </div>
        <!-- /footer-bottom -->
        
	</div>
	<!-- /footer -->
    
</div>


<script type="text/javascript">
jQuery(function($){
	$(document).ready(function(){
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
});
});
</script> 


<!-- wrap --> 


<!-- WP Footer -->
<?php wp_footer(); ?> 
</body>
</html>