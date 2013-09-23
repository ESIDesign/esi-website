jQuery(function($){
/*
	if ( $(window).width() > 1600) {
		var windowH = $(window).height();
		var stickToBot = windowH - $('#masternav').outerHeight(true);
		
		$('#masternav').css({'top': stickToBot + 'px'});
		
			$(window).scroll(function() {
			var scrollVal = $(this).scrollTop();
			if ( scrollVal > stickToBot ) {
				$('#masternav').css({'position':'fixed','top' :'0px'});
			} else {
				$('#masternav').css({'position':'absolute','top': stickToBot +'px'});
			}
			});
	}
*/
	
	$(document).ready(function(){
	
		if ($('body').hasClass('single-project')) {
			$('li#menu-item-481').addClass('current-menu-item');
		}
		
		$('a[href=#toplink]').click(function(){
			$('html, body').animate({scrollTop:0}, 200);
			return false;
		});
		
	var currentHeight = jQuery(this).height();

	//Project Captions
	jQuery('.item').hover(function() {
		jQuery(this).find('a.caption').stop(false,true).fadeIn(200);
		jQuery(this).animate({	'-webkit-box-shadow': '2px 5px 1px 0px rgba(0, 0, 0, .2)', 'box-shadow': '1px 1px 2px 0px rgba(0, 0, 0, .2)'});
	},
	function() {
		jQuery(this).find('a.caption').stop(false,true).fadeOut(200);

	});
	jQuery(this).find('.caption4').css({'bottom':-currentHeight});

	
	});

});


jQuery(function($){
	$(window).load(function() {

startAtSlideIndex = 0;
slideshowBoolean = true;
// see if a tab anchor has been included in the url
if (window.location.hash !== '') {

  startAtSlideIndex = window.location.hash.substr(1,1)-1;
  slideshowBoolean = false;
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
		
		$('.tweet a').attr('target', '_blank');
	});
/*
		function cyclePrinciples(){
      var active = $('.process_item15 .active');
      var next = ($active.next().length > 0) ? active.next() : $('.process_item15 article:first');
      next.css('z-index',2);//move the next image up the pile
      active.fadeOut(600,function(){//fade out the top image
	  active.css('z-index',1).show().removeClass('active');//reset the z-index and unhide the image
          next.css('z-index',3).addClass('active');//make the next image the top one
      });
    }
*/

});
