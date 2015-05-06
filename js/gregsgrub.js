/*
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: js/gregsgrub.js
**** Description: Greg's Grub Javascript file
*/

  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map;
  google.maps.event.addDomListener(window, 'load', initialize);

  

  
$('document').ready(function(){

  // sub nav animation
	hover_sub_nav();
  
  // credit card month/year date picker
	$('#datepicker').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'mm/y',
        onClose: function(dateText, inst) { 
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }
        
    });

  // day/month/year datepicker
  $('.datepicker').datepicker();

  // directions form input
  $('#directions_form').submit(function(evt){
      evt.preventDefault();
      calcRoute();
  });

  // jquery accordion
	$('#accordion').accordion();

  // Image slider
	$('#photoShow_container').bjqs();  
});

function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer();
  var mapOptions = {
    zoom: 15,
    center: new google.maps.LatLng(35.595829, -82.550119)
  };
  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
  directionsDisplay.setMap(map);
  directionsDisplay.setPanel(document.getElementById('directions-panel'));

  var control = document.getElementById('control');
  control.style.display = 'block';
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);
}

function calcRoute() {
  var start = document.getElementById('start').value;
  var end = '123 College St, Asheville, NC 28801';
  var request = {
    origin: start,
    destination: end,
    travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
  });
}

function hover_sub_nav(){
	$('#sub_nav ul li a').mouseover(function(){
		$(this).animate({width: '160px'});
	});
	$('#sub_nav ul li a').mouseout(function(){
		$(this).animate({width: '140px'});
	});
}
