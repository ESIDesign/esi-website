jQuery(function($){

    var page = 1;
    var loading = false;
    var options = ['.people1', '.people2', '.people3'];
    var load_people = function(){
	var toggle = options[Math.floor( Math.random()*options.length)];
           $.ajax({
                type       : "GET",
                data       : {numPosts : 1, pageNumber: page},
                dataType   : "html",
                url        : "/wp-content/themes/adapt2/peopleLoop.php",
                beforeSend : function(){
				   if($(toggle).children('a').length > 1) {
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

setTimeout(function(){
setInterval(function(){
	if(!loading) {
		loading=true;
	if(page >= 44) {
		page = 1;
	}
	else {
		page++;		
	}
	load_people();
	}
}, 6000);
}, 2000);

	$(document).ready(function(){

	if ($(window).width() != 1920) {
		$('.home-wrap').fadeIn(); 

(function() {
	var lis = $('div').hide();
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
		
	if ( $(window).width() < 767) {
		$('.work').fadeIn(200, function(){
			$('.about').fadeIn(200, function(){
				$('.home_item12').fadeIn(200, function(){
					$('.approach').fadeIn(200, function(){
						$('.blog').fadeIn(200, function(){
							$('.lab').fadeIn(200, function(){
								$('.home_item13').fadeIn(400, function(){
									$('.home_item10').fadeIn(400);
								});
							});	
						});
					});
				});
			});
		});
	}
	else {
		// set cookie
		var visited = $.cookie("visited");
		$.cookie('visited', 'yes', { expires: 1, path: '/'});
        if (visited == "yes") {
            setTimeout(function(){
            fastImages();
             $('article.home_item9_quote').css({'opacity':'.5', 'top': '910px'}).fadeIn(400);
            },600);
        }
        else {
			console.log("Home NOT Visited");
			$('article.home_item9').fadeIn(600, function(){
			var $quote = $('.quote').text().length;
			console.log($quote);
			if($quote > 100) {
				var $delay = 1000;
				setTimeout(function(){
				displayImages();
				},5000);
			}	
			if($quote < 100) {
				var $delay = 0;
				setTimeout(function(){
				displayImages();
				},4000);
			}	
			$('article.home_item9_quote').delay(200).fadeIn(400).delay(2000+$delay).animate({'opacity':'.5'}).delay(300).animate({'top': '910'}, 600, 'swing'); 
			});
		} //cookies
	}
})();
	
if ( $(window).width() > 767) {
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
	
	setTimeout(function(){
	$('.home_item3 .cycle').cycle({
			fx: 'fade',
			speed: 1600,
			timeout: 10000
	});
	}, 3000);
	
	$('.home_item4 .cycle').cycle({
			fx: 'fade',
			speed: 1600,
			timeout: 10000,
			cssBefore: { bottom: 0,
			top: -10 }
	});
	
	setTimeout(function(){
	$('.home_item5 .cycle').cycle({
			fx: 'fade',
			speed: 1600,
			timeout: 10000,
	});
	}, 6000);
	
	} //window bigger than 767
	
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
