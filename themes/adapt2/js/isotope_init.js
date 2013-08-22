jQuery(function($){
	$(window).load(function() {

			/*filter*/
			$('.filter a').click(function(){
/* 			$("#projects_slider").fadeOut(); */
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
			};
			
		  return false;
			});
			
			
			
			/*resize*/
			var isIE8 = $.browser.msie && +$.browser.version === 8;
			if (isIE8) {
				document.body.onresize = function () {
					wpexPortfolioIsotope();
				};
			} else {
				$(window).resize(function () {
					wpexPortfolioIsotope();
				});
			}
			
			// Orientation change
			window.addEventListener("orientationchange", function() {
				wpexPortfolioIsotope();
			});
		
	});
});


