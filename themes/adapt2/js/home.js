jQuery(function($){
 
/*
 	if ( $(window).width() > 1600) {
		$('body').empty();
		$('body').load('http://localhost:8888/wp-content/themes/adapt2/index_lobby.php');
		return false;
	}
	
*/
	
    var page = 1;
    var loading = true;
    load_posts = function(){
    var options = ['.people1', '.people2', '.people3'];
	var toggle = options[Math.floor( Math.random()*options.length)];
            $.ajax({
                type       : "GET",
                data       : {numPosts : 1, pageNumber: page},
                dataType   : "html",
                url        : "http://localhost:8888/wp-content/themes/adapt2/loopHandler.php",
                beforeSend : function(){
	                console.log("BEFORE SEND");
				   if($(toggle).children('a').length > 1) {
				   		console.log(toggle);
		                $(toggle).find('a').eq(0).remove();
	                }
                },
                success    : function(data){
                    $data = $(data);
                    if($data.length){
/*                         $data.hide(); */
						$(toggle).append(data).cycle({timeout: 1, autostop: 1, autostopCount: 2});
                       
                    } else {
                        $("#temp_load").remove();
                    }
                },
/*
                error     : function(jqXHR, textStatus, errorThrown) {
                    $("#temp_load").remove();
                    alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                }
*/
        });
    }

  setInterval(function(){
  load_posts();
  }, 7000);


	$(document).ready(function(){

	
	
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
		
		if ( $(window).width() < 767) {
			$('.home_item2').fadeIn(400, function(){
				$('.home_item6').fadeIn(400, function(){
					$('.home_item12').fadeIn(400, function(){
						$('.home_item7').fadeIn(400, function(){
							$('.home_item13').fadeIn(400, function(){
								$('.home_item10').fadeIn(400);
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
				$('article.home_item9_quote').delay(200).fadeIn(400).delay(2000+$delay).animate({'opacity':'.5'}).delay(300).animate({'top': '910'}, 600, 'swing'); 
					 });
            } //cookies
			
		} //window bigger than 767
	
})();
	
  
  		var iframe = $('#home_player')[0],
	    player = $f(iframe);

   	$("img.placeholder, .circle, #button").click(function(){
   		player.api('play');
   		$("img.placeholder").fadeOut(200);
   		$(".home_item1 span.circle").fadeOut(200);
   		$('.home_item1 span#button').removeClass('awesome-icon-play');
       $('.home_item1 span#button').addClass('awesome-icon-pause');
/*    		$('.home_item1 a.video-caption h3').text('Pause Video'); */
   	});
	player.addEvent('ready', function() {
	    player.addEvent("pause", function() {
	       $(".placeholder").fadeIn();
	       $(".home_item1 span.circle").fadeIn();
	       $('.home_item1 span#button').removeClass('awesome-icon-pause');
	       $('.home_item1 span#button').addClass('awesome-icon-play');
/* 	       $('.home_item1 a.video-caption h3').text('Play Video'); */
	       
	     });
	    player.addEvent("ended", function() {
	       $(".placeholder").fadeIn();
	       $(".home_item1 span.circle").fadeIn();
	       $('.home_item1 span#button').removeClass('awesome-icon-pause');
	       $('.home_item1 span#button').addClass('play');
/* 	       $('.home_item1 a.video-caption h3').text('Play Video'); */
	    });
	});
	var isPaused = player.api('pause');
	
	if (isPaused == true) {
		$('.home_item1 a.video-caption h3 span#button').removeClass('awesome-icon-pause');
	       $('.home_item1 a.video-caption h3 span#button').addClass('awesome-icon-play');
	}
	if (isPaused == false) {
	$('.home_item1 a.video-caption h3 span#button').removeClass('awesome-icon-play');
	       $('.home_item1 a.video-caption h3 span#button').addClass('awesome-icon-pause');
		$('.home_item1 a.video-caption h3 span#button').text('Pause Video');
	}
	
	
	
	var move = -10;

	var currentHeight = jQuery(this).height();


	jQuery('.home_item3').hover(function() {
		
		//Move the image
		jQuery(this).find('img').stop(false,true).animate({'bottom':move}, {duration:600});
		jQuery(this).find('.project-overlay').stop(false,true).animate({opacity:1}).css('background-color', 'rgba(0,0,0,.4)');

	},
	function() {
	jQuery(this).find('img').stop(false,true).animate({'bottom':'0px'}, {duration:600});	
	jQuery(this).find('.project-overlay').stop(false,true).animate({opacity:.4}).css('background-color', 'transparent');

});

	jQuery('.home_item4').hover(function() {
		
		//Move and zoom the image
		jQuery(this).find('img').stop(false,true).animate({'bottom':move}, {duration:600});
		
		//Display the caption
		jQuery(this).find('.project-overlay').stop(false,true).animate({opacity:1}).css('background-color', 'rgba(0,0,0,.5)');
	},
	function() {
		//Reset the image
		jQuery(this).find('img').stop(false,true).animate({'bottom':'0px'}, {duration:600});	
		jQuery(this).find('.project-overlay').stop(false,true).animate({opacity:.5}).css('background-color', 'transparent');
	});
	
	jQuery('.home_item11 .project-overlay').css({'bottom':-currentHeight});
	
	jQuery('.home_item5').hover(function() {
		
		//Move and zoom the image
		jQuery(this).find('img').stop(false,true).animate({'left':move}, {duration:600});
		
		//Display the caption
		jQuery(this).find('.project-overlay').stop(false,true).animate({opacity:1}).css('background-color', 'rgba(0,0,0,.5)');
	
	},
	function() {
		//Reset the image
		jQuery(this).find('img').stop(false,true).animate({'left':'0px'}, {duration:600});	
		jQuery(this).find('.project-overlay').stop(false,true).animate({opacity:.4}).css('background-color', 'transparent');
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
