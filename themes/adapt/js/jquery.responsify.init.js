jQuery(function($){
	$(document).ready(function(){
		
		//remove img & video height and width attributes for better responsiveness
		$('img').each(function(){
			$(this).removeAttr('width')
			$(this).removeAttr('height');
		});
		
		$('video').each(function(){
			$(this).removeAttr('width')
			$(this).removeAttr('height');
		});
		
		$("<select />").appendTo("#masternav");
		$("<option />", {
			"selected": "selected",
			"value" : "",
			"text" : "Menu",
		}).appendTo("#masternav select");

		$("#masternav a").each(function() {
			var el = $(this);
			if(el.parents('.sub-menu').length >= 1) {
				$('<option />', {
				 'value' : el.attr("href"),
				 'text' : '- ' + el.text()
				}).appendTo("#masternav select");
			}
			else if(el.parents('.sub-menu .sub-menu').length >= 1) {
				$('<option />', {
				 'value' : el.attr('href'),
				 'text' : '-- ' + el.text()
				}).appendTo("#masternav select");
			}
			else {
				$('<option />', {
				 'value' : el.attr('href'),
				 'text' : el.text()
				}).appendTo("#masternav select");
			}
		});	
		$("#masternav select").change(function() {
		  window.location = $(this).find("option:selected").val();
		});
		
		$("#masternav select").uniform();
	
	});
});