jQuery(document).ready(function($) {

function clear_fare_result() {
	var amounts = {"regular":"$ --"};
	update_fare_divs(amounts);
}
function load_data(url, dataType, async) {
    dataType = typeof dataType !== 'undefined' ? dataType : "json";
    async = typeof async !== 'undefined' ? async : false;
    var returned_data = null;
    $.ajax({
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
var all_zones;
var select_start_zone = $('#start_zone');
var select_end_zone = $('#end_zone');
var agency_id = 114;
function setup_fare_zones(select_menu,start_zone) {
		start_zone = typeof start_zone !== 'undefined' ? start_zone : null;
		if (start_zone !== null) {var origin_id = '&#038;origin_id=' + start_zone; } else {var origin_id = '';}
		zones = load_data("http://applications.trilliumtransit.com/fare_calculator/json_zones.php?agency_id="+agency_id+origin_id);
	var optionsHtml = new Array();
	for (var i = 0; i < zones.length; i++) {
		var value = zones[i].zone_id;
		var label = zones[i].zone_name;
		optionsHtml.push( "<option value='"+ value +"'>"+label+"</option>");
	}
	optionsHtml = optionsHtml.join('');
		select_menu.empty();
	select_menu.append(optionsHtml);
}
setup_fare_zones(select_start_zone);
select_start_zone.change(function() {
	setup_fare_zones(select_end_zone,select_start_zone.val());
});
function update_fare_divs(amounts) {
	$('#regular_fare').html(amounts.regular); // update the DIV
}
$('#fare_zones').submit(function() { // catch the form's submit event
    $.ajax({ // create an AJAX call...
        data: $(this).serialize(), // get the form data
        type: $(this).attr('method'), // GET or POST
        url: $(this).attr('action'), // the file to call
        success: function(response) { // on success..
			update_fare_divs(response);
        }
    });
    return false; // cancel original event to prevent form submitting
});

select_start_zone.onchange = clear_fare_result();
select_end_zone.onchange = clear_fare_result();

});

