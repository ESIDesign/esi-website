jQuery(function($){

    var page = 0;
    var loading = false;
    var options = ['.people1', '.people2'];
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
		   				console.log(page);
						$(toggle).append($data).delay(1000).cycle({timeout: 0}).delay(1000).cycle('next');
						loading = false;
                    } 
                },
        });
    } //var load_people

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
}, 8000);
}, 1000);

		
    var pageP = 1;
    var loadingP = false;
    var optionsP = ['.home_item3', '.home_item4', '.home_item8', '.home_item14'];
    var load_project = function(){
	var toggleP = optionsP[Math.floor( Math.random()*optionsP.length)];
           $.ajax({
                type       : "GET",
                data       : {numPosts : 1, pageNumber: pageP},
                dataType   : "html",
                url        : "/wp-content/themes/adapt2/projectLoop.php",
                beforeSend : function(){
				   if($(toggleP).children('a').length > 1) {
				   		$(toggleP).cycle('destroy');
		                $(toggleP).find('a').eq(0).remove();
	                }
                },
                success    : function(data){
                    $data = $(data);
                    if($data.length){
		   				console.log(data);
		   				console.log(toggleP);
						$(toggleP).append($data).delay(1000).cycle({timeout: 0, height: 208, width: 337}).delay(1000).cycle('next');
						loadingP = false;
                    } 
                },
        });
    }

setTimeout(function(){
setInterval(function(){
	if(!loadingP) {
		loadingP = true;
		pageP++;		
		load_project();	
	}
}, 24000);
}, 4000);


	$(document).ready(function(){

	$('.home-wrap').fadeIn(); 
	
	// Wrapping, self invoking function prevents globals
	(function() {
	   // Hide the elements initially
		var lis = $('div').hide();
		$('#wrap').show();
		$('#main').show();
		$('.home_item9').show();
		var i = 3;
		
		function displayImages() {
	         lis.eq(i++).fadeIn(200, displayImages);
	    };
	      
		function fastImages() {
		    lis.fadeIn(400);
	    };
	
	    setTimeout(function(){
	        fastImages();
	    }, 100);
	        	
	})();
	
  
	var iframe = $('#home_player')[0];
	if(iframe) {
	player = $f(iframe);
		
		$("img.placeholder, #button").click(function(){
			player.api('play');
			$("img.placeholder").fadeOut(200);
			$(".home_item1 span#button").removeClass('awesome-icon-play').addClass('awesome-icon-pause').fadeOut(200);
		});
		
		player.addEvent('ready', function() {
			player.addEvent("play", function() {
				$("img.placeholder").fadeOut(200);
				$(".home_item1 span#button").removeClass('awesome-icon-play').addClass('awesome-icon-pause').fadeOut(200);
			});
			player.addEvent("pause", function() {
				$(".placeholder").fadeIn();
				$(".home_item1 span#button").removeClass('awesome-icon-pause').addClass('awesome-icon-play').fadeIn();	       
			});
			player.addEvent("finish", function() {
				$(".placeholder").fadeIn();
				$(".home_item1 span#button").removeClass('awesome-icon-pause').addClass('play').fadeIn();
			});
			player.addEvent("playProgress", function(data) {
				if(data.percent == .95) {
					player.api('pause');
					player.api('seekTo', 0);
					$(".placeholder").fadeIn();
					$(".home_item1 span#button").removeClass('awesome-icon-pause').addClass('play').fadeIn();
				}
			});	
		}); //player ready
			
			
		var isPaused = player.api('paused');
		
		if (isPaused == true) {
			$('.home_item1 a.video-caption h3 span#button').removeClass('awesome-icon-pause').addClass('awesome-icon-play');
		}
		if (isPaused == false) {
			$('.home_item1 a.video-caption h3 span#button').removeClass('awesome-icon-play').addClass('awesome-icon-pause');
		}
			
		} //if iframe
	});
});