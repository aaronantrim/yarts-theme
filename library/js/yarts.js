
$(document).ready(function(){


	$('.linked-div').click(function() {
		
		window.location = $(this).find('a').attr('href');
		
	});
	
	$('#route-detail-map').click(function() {
		
		$(this).toggleClass('wide-view');
		$(this).css('height',$(this).find('img').height());
		
	});
	
	$('#alert-title, #route-alert-expander').click(function() {
		$('#route-alert-content').slideToggle('fast', function() { 
		if($('#route-alert-content').css('display') == 'block') {
			$('#alert-expand-text').text('Click to Hide');
			$('#route-alert-expander .expand-triangle').html('&#9650;');
		} else {
			$('#alert-expand-text').text('Click to Expand');
			$('#route-alert-expander .expand-triangle').html('&#9660;');
		}
		}); 
	});
	
	


});