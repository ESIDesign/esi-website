jQuery(function($){
	$(window).load(function() {

		/*main function*/
/*
        function wpexProjectIsotope() {
            var $container = $('.project-content');
                $container.imagesLoaded(function(){
                        $container.isotope({
                                itemSelector: '.item'
                });
        } 
        
        wpexProjectIsotope();
       
		function filter_toggle() {
			$("ul.filter").toggle();
		}
		
		$("h2.project_dropdown").click(function() {
			$("ul.filter").toggle();
		});
*/
       
			/*filter*/
			$('.filter a').click(function(){
			  var selector = $(this).attr('data-filter');
			  var selector_name = $(this).text();
				$('.project-content').isotope({ filter: selector });
				$(this).parents('ul').find('a').removeClass('active');
				$(this).addClass('active');
				$('span.project_name').html(selector_name);
				$("ul.filter").toggle();
			 
			if ($('.filter a#all').hasClass('active')) {
				$("#projects_slider").fadeIn();
			}
			else {
				$("#projects_slider").fadeOut();
			}
			
			return false;
			});
			
		
		
		/*resize*/
		/*
		var isIE8 = $.browser.msie && +$.browser.version === 8;
		if (isIE8) {
			document.body.onresize = function () {
				wpexProjectIsotope();
			};
		} else {
			$(window).resize(function () {
				wpexProjectIsotope();
			});
		}
		
		window.addEventListener("orientationchange", function() {
			wpexProjectIsotope();
		});
		*/
		
	});
});


