jQuery(function($){
var windowWidth = $(window).width();

/*
$(window).resize(function() {
    if(windowWidth > $(window).width()){
    location.reload();
    return;
    }
});
*/
});

jQuery(function($){
	
	$(document).ready(function(){
	$('.white').fadeOut(); 
	$('.home-wrap').fadeIn(); 
	
	var move = -10;

	var currentHeight = jQuery(this).height();
	
/* 	jQuery('.home_item3 a.project-overlay').css({'bottom':-currentHeight}); */

	jQuery('.home_item3').hover(function() {
		
		//Move the image
		jQuery(this).find('img').stop(false,true).animate({'bottom':move}, {duration:600});
		jQuery(this).find('.project-overlay h3').stop(false,true).animate({opacity:1}).css('background-color', 'rgba(0,0,0,.4)');

	},
	function() {
	jQuery(this).find('img').stop(false,true).animate({'bottom':'0px'}, {duration:600});	
	jQuery(this).find('.project-overlay h3').stop(false,true).animate({opacity:.4}).css('background-color', 'transparent');

});

	
/* 	jQuery('.home_item4 a.project-overlay').css({'bottom':-currentHeight}); */
	
	jQuery('.home_item4').hover(function() {
		
		//Move and zoom the image
		jQuery(this).find('img').stop(false,true).animate({'bottom':move}, {duration:600});
		
		//Display the caption
		jQuery(this).find('.project-overlay h3').stop(false,true).animate({opacity:1}).css('background-color', 'rgba(0,0,0,.5)');
	},
	function() {
		//Reset the image
		jQuery(this).find('img').stop(false,true).animate({'bottom':'0px'}, {duration:600});	
		jQuery(this).find('.project-overlay h3').stop(false,true).animate({opacity:.5}).css('background-color', 'transparent');
	});
	
	jQuery('.home_item11 a.project-overlay').css({'bottom':-currentHeight});
	
	jQuery('.home_item5').hover(function() {
		
		//Move and zoom the image
		jQuery(this).find('img').stop(false,true).animate({'left':move}, {duration:600});
		
		//Display the caption
		/* jQuery(this).find('a.project-overlay').stop(false,true).animate({'bottom':'0px'}); */
		jQuery(this).find('.project-overlay h3').stop(false,true).animate({opacity:1}).css('background-color', 'rgba(0,0,0,.5)');
	
	},
	function() {
		//Reset the image
		jQuery(this).find('img').stop(false,true).animate({'left':'0px'}, {duration:600});	
		/* 	jQuery(this).find('a.project-overlay').stop(false,true).animate({'bottom':-currentHeight});	 */
		jQuery(this).find('.project-overlay h3').stop(false,true).animate({opacity:.4}).css('background-color', 'transparent');
	});
	
	jQuery('.people1').hover(function() {
		
		//Display the caption
				jQuery(this).find('a.caption_people').stop(false,true).animate({opacity:1}).css('background-color', 'rgba(0,0,0,.4)');
	},
	function() {
		//Hide the caption
			jQuery(this).find('a.caption_people').stop(false,true).animate({opacity:.4}).css('background-color', 'transparent');

	
	});
	
	
	jQuery('.people2').hover(function() {
		
		//Display the caption
				jQuery(this).find('a.caption_people').stop(false,true).animate({opacity:1}).css('background-color', 'rgba(0,0,0,.4)');
	},
	function() {
		//Hide the caption
			jQuery(this).find('a.caption_people').stop(false,true).animate({opacity:.4}).css('background-color', 'transparent');

	
	});


jQuery('.people3').hover(function() {
		
		//Display the caption
				jQuery(this).find('a.caption_people').stop(false,true).animate({opacity:1}).css('background-color', 'rgba(0,0,0,.4)');
	},
	function() {
		//Hide the caption
			jQuery(this).find('a.caption_people').stop(false,true).animate({opacity:.4}).css('background-color', 'transparent');

	
	});

	
	
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
