jQuery(function(e){e(window).load(function(){e(".filter a").click(function(){var t=e(this).attr("data-filter"),n=e(this).text();e(".project-content").isotope({filter:t});e(this).parents("ul").find("a").removeClass("active");e(this).addClass("active");e("span.name").html(n);e("ul.filter").toggle();e(".filter a#all").hasClass("active")?e("#projects_slider").fadeIn():e("#projects_slider").fadeOut();return!1})})});

function filter_toggle() {
	$("ul.filter").toggle();
}

jQuery(function($){
	$('.project-content').isotope({
		filter: '.featured',
		itemSelector: '.item',
		layoutMode: 'fitRows'
	});	

	$(document).ready(function(){

		var $container = $('.project-content');
		$container.imagesLoaded(function(){
			$container.isotope({
				filter: '.featured',
				itemSelector: '.item',
				layoutMode: 'fitRows'
			});	
		});	

		$("h2.dropdown").click(function() {
			$("ul.filter").toggle();
		});
	});
});