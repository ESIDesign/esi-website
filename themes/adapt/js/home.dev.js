jQuery(function($){

    var page = 0;
    var loading = false;
    var options = ['.people1', '.people2', '.people3'];
    var load_people = function(){
	var toggle = options[Math.floor( Math.random()*options.length)];
           $.ajax({
                type       : "GET",
                data       : {numPosts : 1, pageNumber: page},
                dataType   : "html",
                url        : "/wp-content/themes/adapt/peopleLoop.php",
                beforeSend : function(){
				   if($(toggle).children('a').length > 1) {
				   		$(toggle).cycle('destroy');
		                $(toggle).find('a').eq(0).remove();
	                }
                },
                success    : function(data){
                    $data = $(data);
                    if($data.length){
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
}, 600);

var maxWidth  = $('.home-wrap').width();

jQuery.fn.center = function () {
    this.css("position","relative");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + 
                                                $(window).scrollLeft()) + "px");
    return this;
}

	
function dynamicSize() {
		var $window = $(window);
	    var width = $window.width();
	    var height = $window.height();
	    var scale;

/*
	    if(width >= 1300) {
		    maxWidth = 1400;
		    $('.home-wrap').css({'left':'44px'});
	    }
*/

	    if(width >= 768) {
		    maxWidth = 1150;
		    $('.home-wrap').css({'left':'44px'});
	    }
	    
	    if(width <= 767) {
		    maxWidth = 785;
		    $('.home-wrap').css({'left':'-15px'});
	    }
	    
	    if(width <= 479) {
		    maxWidth = 450;
		    var homeWidth = 240;
		    var wrapWidth = $('#wrap').outerWidth();
		    console.log(wrapWidth);
		    var homeCenter = (wrapWidth - homeWidth)/2;
	        $('.home-wrap').delay(100).css({'transform': 'scale(1)', 'left': homeCenter+'px'});
// 	        $('.home-wrap').center();
	        $('#wrap').css({ width: width});
	        return;
	    }
	    
	    else if(width >= maxWidth+100) {
	        $('.home-wrap').css({'-webkit-transform': ''});
	        $('#wrap').css({ width: '', height: '' });
	        return;
	    }
	    
	    scale = Math.min(width/maxWidth);
	    $('.home-wrap').css({'-webkit-transform': 'scale(' + scale + ')', 'transform': 'scale(' + scale + ')'});
	    $('#wrap').css({ width: maxWidth * scale });
}


function displayImages() {
	lis.eq(i++).fadeIn(200, displayImages);
}

function fastImages() {
	lis.fadeIn(400);
}

(function() {
// 		var lis = $('div').hide();
// 		$('#wrap').show();
// 		$('#main').show();
// 		$('.home-wrap').show();
// 		$('.home_item9').show();
		var i = 3;
		
	if ( $(window).width() < 500) {
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
/* 01/13/2014 removed cookies if statement because there is no quote */
/*
	    setTimeout(function(){
		    fastImages();
	    },400);
*/
	}
})();
	
$(document).ready(function(){
// 	console.log("BODY");
	$("body").removeClass("preload");
	setTimeout(function(){
		$('.home_item, .home_button, .project, .home_media').css('display','block');
		$('.home_item, .home_button, .project, .home_media').addClass('fadeIn');
	}, 400);
	
	if ( $(window).width() < 1200) {
		dynamicSize();
	}
	  
if ( $(window).width() > 479) {
	var iframe = document.querySelector('iframe');
	if(iframe) {
		var player = new Vimeo.Player(iframe);	
	} 
		
	$('.home_item1').on('click touchstart', function(ev) {
		ev.preventDefault();
   		player.ready().then(function() {
			player.play();
		});
   		videoOverlay();
   	});

	player.on('pause', function(){
              
    });

    player.on('finish', function() {
       videoOverlay();
       player.currentTime = 0;
    });
	
	} //window bigger than 767

	function videoOverlay() {
		if($('.placeholder').is(':visible')) {
			$('.placeholder').fadeOut(200);
			$('.home_item1 span#button').removeClass('awesome-icon-play').addClass('awesome-icon-pause').fadeOut(200);
		} else {
			$('.placeholder').fadeIn();
			$('.home_item1 span#button').removeClass('awesome-icon-pause').addClass('play').fadeIn();
		}
	}


	$('.home_item1 .cycle').cycle({
			fx: 'fade',
			speed: 800
	});
	
	$('.home_item3 .cycle').cycle({
			fx: 'fade',
			speed: 1200,
			timeout: 30000
	});
	
	$('.home_item4 .cycle').cycle({
			delay: 4000,
			fx: 'fade',
			speed: 1000,
			timeout: 10000
	});
	
	$('.home_item5 .cycle').cycle({
			delay: 8000,
			fx: 'fade',
			speed: 1000,
			timeout: 10000,
	});
	

	});
	
	$(window).resize(function(evt) {
		dynamicSize();
		
		if ( $(window).width() < 767) {
		$('.home_item1, .home_item3, .home_item4, .home_item5, .home_item1 .cycle, .home_item3 .cycle, .home_item4 .cycle, .home_item5 .cycle, .project-overlay').css({'display':'block'});
		}
		
	});
});