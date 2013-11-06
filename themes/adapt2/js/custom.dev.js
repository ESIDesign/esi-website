jQuery(function($){
	$(document).ready(function(){
	
		if ($(window).width() > 1915) {
			var timeout;
		    $(document).on("mousemove keydown click", function() {
		        clearTimeout(timeout);
		        timeout = setTimeout(function() {
		             window.location = "<?php echo get_site_url(); ?>"; 
		        }, 60 * 3000);
		    }).click();
			
			$('.excerpt-title').click(function(){
				$('.excerpt-content').toggle();
				return false;
			});
		}
		
		if ($(window).width() < 1915) {

				if($('body').hasClass('page-template-template-blog-php')){
					$('.loop-entry a').removeAttr('data-ob', 'lightbox');
					$('.loop-entry a').removeAttr('rel', 'lightbox');
					$('.loop-entry a').removeAttr('data-ob_iframe', 'true');	
				}
		
			    var user = 'esidesign';

				$.getJSON('/twitterproxy.php?url='+encodeURIComponent('statuses/user_timeline.json?screen_name=esidesign&count=1'), function(data)      {
	
				 var tweet = data[0].text;
	
				 tweet = tweet.replace(/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig, function(url) {
					  return '<a href="'+url+'">'+url+'</a>';
				  }).replace(/B@([_a-z0-9]+)/ig, function(reply) {
				  return reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
				  });

				  $(".tweet p").html(tweet);
			});
		}
		
		/* All sizes  */
		if ($('body').hasClass('single-project')) {
			$('li#menu-item-481').addClass('current-menu-item');
		}
		
		$('a[href=#toplink]').click(function(){
			$('html, body').animate({scrollTop:0}, 200);
			return false;
		});
	
		$('#single-project-left a').attr('target', '_blank');
		
		$('.tweet a').attr('target', '_blank');
		
	});
});