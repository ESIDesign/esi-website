jQuery(function(a){a(document).ready(function(){if(1920==a(window).width()&&a(".excerpt-title").click(function(){return a(".excerpt-content").toggle(),!1}),a(window).width()<1915){a("body").hasClass("page-template-template-blog-php")&&(a(".loop-entry a").removeAttr("data-ob","lightbox"),a(".loop-entry a").removeAttr("rel","lightbox"),a(".loop-entry a").removeAttr("data-ob_iframe","true"));a.getJSON("/twitterproxy.php?url="+encodeURIComponent("statuses/user_timeline.json?screen_name=esidesign&count=1"),function(b){var c=b[0].text;c=c.replace(/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gi,function(a){return'<a href="'+a+'">'+a+"</a>"}).replace(/B@([_a-z0-9]+)/gi,function(a){return a.charAt(0)+'<a href="http://twitter.com/'+a.substring(1)+'">'+a.substring(1)+"</a>"}),a(".tweet p").html(c)})}a("body").hasClass("single-project")&&a("li#menu-item-481").addClass("current-menu-item"),a("a[href=#toplink]").click(function(){return a("html, body").animate({scrollTop:0},200),!1}),a("#single-project-left a").attr("target","_blank"),a(".tweet a").attr("target","_blank")})}),jQuery(function(a){if(a("body").hasClass("archive,page-template-template-contact")){a.getJSON("/twitterproxy.php?url="+encodeURIComponent("statuses/user_timeline.json?screen_name=esidesign&count=2"),function(b){var c=[];for(i in b){var d=b[i],e=d.text;e=e.replace(/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gi,function(a){return'<a href="'+a+'">'+a+"</a>"}).replace(/B@([_a-z0-9]+)/gi,function(a){return a.charAt(0)+'<a href="http://twitter.com/'+a.substring(1)+'">'+a.substring(1)+"</a>"});var f="<p>"+e+"</p>";c.push(f)}c.join("");a(".sidebar-box .twitter").html(c)})}});