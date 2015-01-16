/*
	Google Maps interface for loadsbyjake.com
	
	The user clicks the map link in the Floatbox overlay
	and we display a route map from the load source to
	the driver using the zip code class to get the
	longitude and latitude points via an xajax call.
*/

function showmap(lat1, long1, lat2, long2)
{
	  var latlng1 = new google.maps.LatLng(lat1, long1);    
		var latlng1 = new google.maps.LatLng(lat2, long2);
    var myOptions = {
      zoom: 8,
      center: latlng1,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("gmapdiv"), myOptions);
}
