jQuery(function(e){e(document).ready(function(){e(window).width()==1920&&e(".excerpt-title").click(function(){e(".excerpt-content").toggle();return!1});if(e(window).width()<1915){if(e("body").hasClass("page-template-template-blog-php")){e(".loop-entry a").removeAttr("data-ob","lightbox");e(".loop-entry a").removeAttr("rel","lightbox");e(".loop-entry a").removeAttr("data-ob_iframe","true")}var t="esidesign";e.getJSON("/twitterproxy.php?url="+encodeURIComponent("statuses/user_timeline.json?screen_name=esidesign&count=1"),function(t){var n=t[0].text;n=n.replace(/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig,function(e){return'<a href="'+e+'">'+e+"</a>"}).replace(/B@([_a-z0-9]+)/ig,function(e){return e.charAt(0)+'<a href="http://twitter.com/'+e.substring(1)+'">'+e.substring(1)+"</a>"});e(".tweet p").html(n)})}e("body").hasClass("single-project")&&e("li#menu-item-481").addClass("current-menu-item");e("a[href=#toplink]").click(function(){e("html, body").animate({scrollTop:0},200);return!1});e("#single-project-left a").attr("target","_blank");e(".tweet a").attr("target","_blank")})});

jQuery(function($){
if($('body').hasClass('archive')) {
	var user = 'esidesign';
	$.getJSON('/twitterproxy.php?url='+encodeURIComponent('statuses/user_timeline.json?screen_name=esidesign&count=2'), function(data) {
	var tweet_array = [];
	for(i in data) {
		var tweet_data = data[i]
		var tweet = tweet_data.text;
		tweet = tweet.replace(/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig, function(url) {
		return '<a href="'+url+'">'+url+'</a>';
		}).replace(/B@([_a-z0-9]+)/ig, function(reply) {
		return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
		});
		var text = '<p>'+tweet+'</p>';
		tweet_array.push(text);
	}
	var tweet_display = tweet_array.join('');
	$(".sidebar-box .twitter").html(tweet_array);	
});	
}
});
