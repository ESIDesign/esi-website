jQuery(function($){

$('.home-wrap').fadeIn(); 

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

	$(document).ready(function(){

(function() {
		var lis = $('div').hide();
		$('#wrap').show();
		$('#main').show();
		$('.home-wrap').show();
		$('.home_item9').show();
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
/* 01/13/2014 removed cookies if statement because there is no quote */
	    setTimeout(function(){
		    fastImages();
	    },400);
	}
})();
	
if ( $(window).width() > 767) {
	if($('#home_player')[0]) {
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
	}
	
	$('.home_item1 .cycle').cycle({
			fx: 'fade',
			speed: 1000,
			timeout: 20000
	});
	
	$('.home_item3 .cycle').cycle({
			fx: 'fade',
			speed: 1000,
			timeout: 10000
	});
	
	$('.home_item4 .cycle').cycle({
			delay: 4000,
			fx: 'fade',
			speed: 1000,
			timeout: 10000,
			cssBefore: { bottom: 0,
			top: -10 }
	});
	
	$('.home_item5 .cycle').cycle({
			delay: 8000,
			fx: 'fade',
			speed: 1000,
			timeout: 10000,
	});
	
	} //window bigger than 767
	
		
	});
});