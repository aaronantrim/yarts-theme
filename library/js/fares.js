var all_zones;

var agency_id = 114;

function clear_fare_result() {
	var amounts = {"regular":"$ --"};
	update_fare_divs(amounts);
}

function load_data(url, dataType, async) {
    dataType = typeof dataType !== 'undefined' ? dataType : "json";
    async = typeof async !== 'undefined' ? async : false;
    var returned_data = null;
    jQuery.ajax({
        'async': async,
        'global': false,
        'url': url,
        'dataType': dataType,
        'success': function (data) {
            returned_data = data;
        }
    });
    return returned_data;
}

function setup_fare_zones(select_menu,start_zone) {
		start_zone = typeof start_zone !== 'undefined' ? start_zone : null;
		if (start_zone !== null) {var origin_id = '&origin_id=' + start_zone; } else {var origin_id = '';}
		zones = load_data("http://applications.trilliumtransit.com/fare_calculator/json_zones.php?agency_id="+agency_id+origin_id);
	var optionsHtml = new Array();
	if (start_zone == null) {optionsHtml.push( "<option>Select start zone</option>");}
	for (var i = 0; i < zones.length; i++) {
		var value = zones[i].zone_id;
		var label = zones[i].zone_name;
		optionsHtml.push( "<option value='"+ value +"'>"+label+"</option>");
	}
	optionsHtml = optionsHtml.join('');
		select_menu.empty();
	select_menu.append(optionsHtml);
}


function update_fare_divs(amounts) {
	jQuery('#regular_fare').html(amounts.regular); // update the DIV
	
}

var select_start_zone;
var select_end_zone;

jQuery(document).ready(function($) {



select_start_zone = $('#start_zone');
select_end_zone = $('#end_zone');


setup_fare_zones(select_start_zone);
select_start_zone.change(function() {
	setup_fare_zones(select_end_zone,select_start_zone.val());
});

$('#fare_zones').submit(function() { // catch the form's submit event
    $.ajax({ // create an AJAX call...
        data: $(this).serialize(), // get the form data
        type: $(this).attr('method'), // GET or POST
        url: $(this).attr('action'), // the file to call
        success: function(response) { // on success..
			update_fare_divs(response);
			$('#get-fares-results').addClass('show');
        }
    });
    return false; // cancel original event to prevent form submitting
});

// select_start_zone.addEventListener("change", clear_fare_result);
// select_end_zone.addEventListener("change", clear_fare_result);

//select_start_zone.change(clear_fare_result());
//select_end_zone.change(clear_fare_result());

});