jQuery(function($){
	
	$(document).ready(function(){
	
	if ($(window).width() > 1600) {
		$('.excerpt-title').click(function(){
			console.log("CLICK");
			$('.excerpt-content').toggle();
			return false;
		});
	}
		
		if ($('body').hasClass('single-project')) {
			$('li#menu-item-481').addClass('current-menu-item');
		}
		
		$('a[href=#toplink]').click(function(){
			$('html, body').animate({scrollTop:0}, 200);
			return false;
		});
	
		 $('#single-project-left a').attr('target', '_blank');
		
		$('.tweet a').attr('target', '_blank');

if ($(window).width() > 767) {
		var iframe = $('#player')[0];
		if(iframe) {
		var	player = $f(iframe);	

		player.addEvent("ready", function(){    		 
			player.addEvent("play", function(){
				$('#featured .flexslider').flexslider("pause");
			});
			player.addEvent("pause", function(){
				$(".placeholder").fadeIn();
				$('span#button').removeClass('awesome-icon-pause');
				$('span#button').addClass('awesome-icon-play');
				$("span#button").fadeIn();
			});
			player.addEvent("finish", function() {
				$(".placeholder").fadeIn();
				$('span#button').removeClass('awesome-icon-pause');
				$('span#button').addClass('play');
				$("span#button").fadeIn();
		    });
		});

	   	$("img.placeholder, #button").click(function(){
				player.api('play');
				$("img.placeholder").fadeOut(200);
				$('span#button').removeClass('awesome-icon-play');
				$('span#button').addClass('awesome-icon-pause');
				$("span#button").fadeOut(200);
	   	});
		
		var isPaused = player.api('pause');
		
		if (isPaused == true) {
			$('span#button').removeClass('awesome-icon-pause');
		       $('span#button').addClass('awesome-icon-play');
		}
		if (isPaused == false) {
		$('span#button').removeClass('awesome-icon-play');
		       $('span#button').addClass('awesome-icon-pause');
			$('span#button').text('Pause Video');
		}
	}

startAtSlideIndex = 0;
slideshowBoolean = true;
// see if a tab anchor has been included in the url
if (window.location.hash != '') {

  startAtSlideIndex = window.location.hash.substr(1,1)-1;
  slideshowBoolean = false;
}

		
		$('#featured .flexslider').flexslider({
			animation: "slide",
			slideshow: slideshowBoolean,
			slideshowSpeed: 6000,
			animationDuration: 600,
			smoothHeight: true,
			directionNav: true,
			controlNav: true,
			keyboardNav: true,
			touchSwipe: true,
			prevText: '<span class="awesome-icon-chevron-left"></span>',
			nextText: '<span class="awesome-icon-chevron-right"></span>',
			randomize: false,
			animationLoop: true,
			pauseOnAction: true,
			pauseOnHover: false,
			startAt: startAtSlideIndex,
			video: true,
			start: function(){
				$('.loading').fadeOut(function(){
					$('#featured').fadeIn(600);
					$('.flexslider').fadeIn(800);
					$('.title').show();
				});
				
			},
			before: function(){
				if(iframe){
					player.api('pause');	
				}
			}, 
			after: function(){

			},
		});
		}
		else {
			$('.loading').hide();	
         $('.slides li img:gt(5)').hide(200);
		}

		$('#projects_slider .flexslider').flexslider({
			animation: "fade",
			slideshow: true,
			slideshowSpeed: 6000,
			animationDuration: 400,
			smoothHeight: true,
			directionNav: true,
			controlNav: false,
			keyboardNav: true,
			touchSwipe: true,
			prevText: '<span class="awesome-icon-chevron-left"></span>',
			nextText: '<span class="awesome-icon-chevron-right"></span>',
			randomize: false,
			animationLoop: true,
			pauseOnAction: true,
			pauseOnHover: false,
			start: function(){
				$('.loading').fadeOut(function(){
/* 					$('#projects_slider').fadeIn(600); */
					$('.flexslider').css('height', '625px');
					$('.flexslider').fadeIn(600);
					$('.title').show();
					$('.blue_nug').show();
					$('.triangle').show();
					$('.project-content').fadeIn(function(){
						$("#footer").fadeIn(1600);
					});
				});
				
			},
		});
	
	
			$('#not-featured .flexslider').flexslider({
			animation: "fade",
			slideshow: slideshowBoolean,
			slideshowSpeed: 6000,
			animationDuration: 600,
			smoothHeight: true,
			directionNav: true,
			controlNav: false,
			keyboardNav: true,
			touchSwipe: true,
			prevText: '<span class="awesome-icon-chevron-left"></span>',
			nextText: '<span class="awesome-icon-chevron-right"></span>',
			randomize: false,
			animationLoop: true,
			pauseOnAction: true,
			pauseOnHover: false,
			startAt: startAtSlideIndex,
			start: function(){
				$('.nf-loading').fadeOut(function(){
					$('#not-featured').fadeIn(600);
					$('.flexslider').fadeIn(800);
					$('.title').show();
				});
				
			},
		});
		
	});

});
