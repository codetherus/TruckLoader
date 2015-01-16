/*
	Javascript for tracker1.php
	POC for driver tracking display
	using Google maps api.
*/
	var geocoder;									//Reverse geocoding obj
	var infoWindow = new google.maps.InfoWindow();  //Info window to show marker details
	var markers = [];								//Map marker array
	var map;										//The map obj
	var point;										//json obj from the xajax call
	var pos;										//latlng obj
	var addr;										//Address from reverse gecoding
	var locs = [];									//Polyline array for route path
	var route;										//Polyline object
	
	jQuery(document).ready(function(){
		initialize();
		xajax_getAllRoutes();
	})

	//Setup the map and call the xajax function to load the markers
	function initialize() {
	  var mapOptions = {
		zoom: 5,
		center: new google.maps.LatLng(39.50, -98.35),
		disableDefaultUI: false,
		mapTypeId: 'roadmap'
	  };
	   geocoder = new google.maps.Geocoder();	
	   map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	   google.maps.event.addListener(map,"click", function(e){infoWindow.close();});
	}
	
	//Select on change handler
	function getRoute(driver)
	{
		if(driver != '')
			xajax_readDriverTrack(driver);
	}

	//Add polylines to the route
	//The segments run from point to point.
	function drawRoute(points)
	{
		
		if(route)
			route.setMap(null);
		locs = [];
		for (i=0;i<points.length;i++)
	    {
			point = points[i];
			pos = new google.maps.LatLng(point.lat, point.lng);
			locs.push(pos);
		}
		route = new google.maps.Polyline({
		path: locs,
		geodesic: true,
		strokeColor: 'red',
		strokeOpacity: 1.0,
		strokeWeight: 1
	  });
	  route.setMap(map);
	}
	
		
	//Callback for xajax readDriverTrack
	function plotRoute(points)
	{
		
		deleteMarkers();
		for (i=0;i<points.length;i++)
	    {
			
			point = points[i];
			pos = new google.maps.LatLng(point.lat, point.lng);
			marker = new google.maps.Marker({
				position: pos,
				icon: 'images/red-circle-lv.png',
				map: map,
				description: point['driver']+'<br/>'+point['addr']+'<br/>'+point['gtime']
			});
			(function(marker) {
			  // Attaching a click event to the current marker
				google.maps.event.addListener(marker, "click", function(e) {
				infoWindow.setContent(marker.description);
				infoWindow.open(map, marker);
			  });
			  
			})(marker);
			
			markers.push(marker);
			
		}
		setAllMap(map);
		drawRoute(points);
	}
	
	function deleteMarkers() {
	  clearMarkers(); //Null out the markers
	  markers = [];   //Empty the array
	}

	// Set the map propery on each marker. 
	function setAllMap(map) {
	  for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(map);
	  }
	}
	
	function clearMarkers() {
	  setAllMap(null); //Remove the map pointers
	}

