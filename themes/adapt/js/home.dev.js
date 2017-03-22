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
// 				   		$(toggle).cycle('destroy');
		                $(toggle).find('a').eq(0).remove();
	                }
                },
                success    : function(data){
                    $data = $(data);
                    if($data.length){
// 						$(toggle).append($data).delay(100).cycle({timeout: 0}).delay(1000).cycle('next');
						$(toggle).append($data);
						var person1 = $(toggle).find('a').eq(0);
						var person2 = $(toggle).find('a').eq(1);
						
						$(person1).animate({opacity: 0}, 800);
						$(person1).delay(50).css('z-index',0);
						$(person2).delay(100).animate({opacity: 1},800);
						$(person2).delay(150).css('z-index',1);

// 						console.log(data);
						
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
}, 2400);
}, 200);

var iframe = document.querySelector('iframe');
if(iframe) {
var player = new Vimeo.Player(iframe);	
if($(iframe).hasClass('autoplay')) {
	player.ready().then(function() {
		player.play();
		player.setVolume(0);
	});  	
	
	player.on('ended', function(){
		player.element.src = player.element.src;
		setTimeout(function(){
			player.play();
			player.setVolume(0);
		}, 400);
	});
} 
}

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
	
$(document).ready(function(){
// 	console.log("BODY");
	$("body").removeClass("preload");

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
	
	setTimeout(function(){
// 		$('.home_item, .home_button, .project, .home_media').css('display','block');
		$('.project').fadeIn(600);
		$('.home_button, .home_item12').delay(200).fadeIn(600);
		$('.home_item, .home_media').delay(400).fadeIn(600);
	}, 400);
	
} else {
	setTimeout(function(){
		$('.home_item, .home_button, .project, .home_media').css('display','block');
		$('.home_item, .home_button, .project, .home_media').addClass('fadeIn');
	}, 100);
}

	function videoOverlay() {
		if($('.placeholder').is(':visible')) {
// 			$('.placeholder').fadeOut(200);
// 			$('.home_item1 span#button').removeClass('awesome-icon-play').addClass('awesome-icon-pause').fadeOut(200);
		} else {
// 			$('.placeholder').fadeIn();
// 			$('.home_item1 span#button').removeClass('awesome-icon-pause').addClass('play').fadeIn();
		}
	}


/*
	$('.home_item1 .cycle').cycle({
			fx: 'fade',
			speed: 800
	});
*/
	
	$('.home_item3 .cycle').cycle({
			fx: 'fade',
			delay: 16000,
			speed: 1200,
// 			timeout: 5000
	});
	
	$('.home_item4 .cycle').cycle({
			delay: 9000,
			fx: 'fade',
			speed: 1000,
// 			timeout: 2000
	});
	
	$('.home_item5 .cycle').cycle({
			delay: 12000,
			fx: 'fade',
			speed: 1000,
// 			timeout: 3000,
	});
	

	});
	
	$(window).resize(function(evt) {
		dynamicSize();
		
/*
		if ( $(window).width() < 767) {
		$('.home_item1, .home_item3, .home_item4, .home_item5, .home_item1 .cycle, .home_item3 .cycle, .home_item4 .cycle, .home_item5 .cycle, .project-overlay').css({'display':'block'});
		}
*/
		
	});
});