
jQuery(document).ready(function($) {


	$('.linked-div').click(function() {
		
		window.location = $(this).find('a').attr('href');
		
	});
	
	$('#route-detail-map').click(function() {
		
		//$(this).toggleClass('wide-view');
		//$(this).css('height',$(this).find('img').height());
		
	});
	
	$('#alert-title, #route-alert-expander').click(function() {
		$(this).parent().find('#route-alert-content').slideToggle('fast', function() { 
		if($('#route-alert-content').css('display') == 'block') {
			$(this).parent().find('#alert-expand-text').text('Click to Hide');
			$(this).parent().find('#route-alert-expander .expand-triangle').html('&#9650;');
		} else {
			$(this).parent().find('#alert-expand-text').text('Click to Expand');
			$(this).parent().find('#route-alert-expander .expand-triangle').html('&#9660;');
		}
		}); 
	});
	
	
	$('#map-box area').hover(function() {
		$(this).parent().parent().find('#bg_clear').toggleClass($(this).attr('alt'));	
	}, function() {
		$(this).parent().parent().find('#bg_clear').toggleClass($(this).attr('alt'));
	});


});