jQuery(function($){
	
	if($('body').hasClass('post-type-archive-project')) {
		var $container = $('.project-content');
		$container.imagesLoaded(function(){
			$container.animate({opacity:1});
			$container.isotope({
				filter: '.featured',
				itemSelector: '.item',
				layoutMode: 'fitRows'
			});	
		});	
	} else if($('body').hasClass('archive')) {
		var $container = $('.blog-content');
		$container.isotope({
			itemSelector: '.loop-entry'
		});
		
		window.onresize = function() {
		    $container.isotope({});
		};
	}
	$(window).on('load', function(){
		$('.filter a').click(function(e){
			e.stopPropagation();
			var filter = $(this).attr('data-filter'), 
			text = $(this).text();
			
			$container.isotope({
				filter: filter
			});
			
			$(this).parents('ul').find('a').removeClass('active');
			
			$(this).addClass('active');
			$('span.name').html(text);
			
			$('ul.filter').toggle();
			
			if($('.filter a#all').hasClass('active')) {
				$('#projects_slider').fadeIn();
 			} else {
	 			$('#projects_slider').fadeOut();
 			}			
		});
	});
	
	$('body').click(function(){
		if($('ul.filter').delay(100).is(':visible')) {
			$("ul.filter").toggle();
		}
	});
	
	$('h2.dropdown').click(function(e) {
		e.stopPropagation();
		$('ul.filter').toggle();
	});
	
});