// ==========  START GOOGLE MAP ========== //
function initialize() {

	(function($) {
		$(".map-canvas").each(function() {



		var LocTitle = $(this).attr('data-loctitle');
		var LocName = $(this).attr('data-locname');
		var LocDesc = $(this).attr('data-locdesc');
		var IconBase = $(this).attr('data-base');
		var LatValue = $(this).attr('data-lat');
		var LngValue = $(this).attr('data-lng');
		var GetID = $(this).attr('id');
		var myLatLng = new google.maps.LatLng(LatValue,LngValue);
		var roadAtlasStyles;
		/*var roadAtlasStyles = [ { "featureType": "landscape", "elementType": "geometry.fill", "stylers": [ { "color": "#474D5D" } ] },{ "elementType": "labels.text.fill", "stylers": [ { "color": "#FFFFFF" } ] },{ "elementType": "labels.text.stroke", "stylers": [ { "visibility": "off" } ] },{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "color": "#50525f" } ] },{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "visibility": "on" }, { "color": "#808080" } ] },{ "featureType": "poi", "elementType": "labels", "stylers": [ { "visibility": "off" } ] },{ "featureType": "transit", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] },{ "featureType": "poi", "elementType": "geometry", "stylers": [ { "color": "#808080" } ] },{ "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "color": "#3071a7" }, { "saturation": -65 } ] },{ "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] },{ "featureType": "landscape", "elementType": "geometry.stroke", "stylers": [ { "color": "#bbbbbb" } ] } ];*/

		var mapOptions = {
			zoom: 14,
			center: myLatLng,
			disableDefaultUI: true,
			scrollwheel: false,
			navigationControl: false,
			mapTypeControl: false,
			scaleControl: false,
			draggable: false,
			mapTypeControlOptions: {
			mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'roadatlas']
			}
		  };

		  var map = new google.maps.Map(document.getElementById(GetID), mapOptions);
		  
		   
		  var marker = new google.maps.Marker({
			  position: myLatLng,
			  map: map,
			  title: LocName,
		  });
		  
		  var contentString = '<div style="max-width: 300px" id="content">'+
			  '<div id="bodyContent">'+
			  '<h4>' + LocTitle + '</h4>' +
			  '<p style="font-size: 12px">' + LocDesc + '</p>'+
			  '</div>'+
			  '</div>';

		  /*var infowindow = new google.maps.InfoWindow({
			  content: contentString
		  });
		  
		  google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map,marker);
		  });
*/
		  var styledMapOptions = {
			name: LocName
		  };

		  var usRoadMapType = new google.maps.StyledMapType(
			  roadAtlasStyles, styledMapOptions);

		  map.mapTypes.set('roadatlas', usRoadMapType);
		  map.setMapTypeId('roadatlas');
		  
		 });

	})(jQuery);

}

google.maps.event.addDomListener(window, "load", initialize);
// ========== END GOOGLE MAP ========== //