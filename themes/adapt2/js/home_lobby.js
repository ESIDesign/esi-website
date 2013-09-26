jQuery(function($){
     
	console.log("TEST");
    var page = 1;
    var loading = true;
    var options = ['.people1', '.people2'];
    var load_posts = function(){
	var toggle = options[Math.floor( Math.random()*options.length)];
           $.ajax({
                type       : "GET",
                data       : {numPosts : 1, pageNumber: page},
                dataType   : "html",
                url        : "http://localhost:8888/wp-content/themes/adapt2/loopHandler.php",
                beforeSend : function(){
				   if($(toggle).children('a').length > 1) {
		   				console.log(page);
				   		$(toggle).cycle('destroy');
		                $(toggle).find('a').eq(0).remove();
	                }
                },
                success    : function(data){
                    $data = $(data);
                    if($data.length){
/*                         $data.hide(); */
						$(toggle).append($data).delay(1000).cycle({timeout: 0}).delay(1000).cycle('next');
						loading = false;
                       
                    } 
                },
        });
    }

	$(document).ready(function(){
	  	setTimeout(function(){
	  	loading=true;
		page++;
setInterval('load_posts()', 6000);
},10000);
	
	$('.white').fadeOut(); 
	$('.home-wrap').fadeIn(); 
	
	
	// Wrapping, self invoking function prevents globals
(function() {
   // Hide the elements initially
   var lis = $('div').hide();
/*    var left = this.left(); */
	$('div#wrap').show();
	$('div#main').show();
	$('div.home-wrap').show();
	$('div.quote').show();
		 var i = 3;
	
	
	function displayImages() {

         lis.eq(i++).fadeIn(200, displayImages);

      };
      
      	function fastImages() {

         lis.fadeIn(400);

      };


		// set cookie
		var visited = $.cookie("visited");
		$.cookie('visited', 'yes', { expires: 1, path: '/'});
        if (visited == "yes") {
            setTimeout(function(){
            fastImages();
             $('article.home_item9_quote').css({'opacity':'.5', 'top': '925px'}).fadeIn(400);
            },600);
            }
            else {
		        console.log("Home NOT Visited");
					 $('article.home_item9').fadeIn(600, function(){
					 var $quote = $('.quote').text().length;
				console.log($quote);
				if($quote > 100) {
					var $delay = 2000;
					setTimeout(function(){
				displayImages();
				},6000);
				}	
				if($quote < 100) {
					var $delay = 0;
					setTimeout(function(){
				displayImages();
				},4000);
				}	
				$('article.home_item9_quote').delay(200).fadeIn(400).delay(2000+$delay).animate({'opacity':'.5'}).delay(300).animate({'top': '925'}, 600, 'swing'); 
					 });
            } //cookies
	
})();
	
  
		var iframe = $('#home_player')[0],
		player = $f(iframe);
		
		$("img.placeholder, #button").click(function(){
			player.api('play');
			$("img.placeholder").fadeOut(200);
			$(".home_item1 span#button").removeClass('awesome-icon-play').addClass('awesome-icon-pause').fadeOut(200);
		});
		player.addEvent('ready', function() {
			player.addEvent("pause", function() {
				$(".placeholder").fadeIn();
				$(".home_item1 span#button").removeClass('awesome-icon-pause').addClass('awesome-icon-play').fadeIn();	       
			});
			player.addEvent("finish", function() {
				$(".placeholder").fadeIn();
				$(".home_item1 span#button").removeClass('awesome-icon-pause').addClass('play').fadeIn();
			});
		});
		var isPaused = player.api('pause');
		
		if (isPaused == true) {
			$('.home_item1 a.video-caption h3 span#button').removeClass('awesome-icon-pause').addClass('awesome-icon-play');
		}
		if (isPaused == false) {
			$('.home_item1 a.video-caption h3 span#button').removeClass('awesome-icon-play').addClass('awesome-icon-pause');
		}
		
	
	});
	
	});
	
	function cycleImages(){
      var $active = $('.home_item9 .active');
      var $next = ($active.next().length > 0) ? $active.next() : $('.home_item9 img:first');
      $next.css('z-index',2);//move the next image up the pile
      $active.fadeOut(600,function(){//fade out the top image
	  $active.css('z-index',1).show().removeClass('active');//reset the z-index and unhide the image
          $next.css('z-index',3).addClass('active');//make the next image the top one
      });
    }
