/*
	LBJ Google Maps interface page JS
	This uses the JQ jMapping plugin
*/

	jQuery(document).ready(function(){
		initialize();
		
	})
		
//var map;	//Global map object
//var markers = []; //array of markers for refresh scan
var driverdata; //Global map data object
var custdata; //Global map data object 
var infoWindow = new google.maps.InfoWindow(); //One info window for all markers
var drivers; //Store the initial array of drivers for change checking.
var timerVar; //Interval timer varable
var isLoadEvent = true; //Page load will turn this off so all following will be updates

function initialize() {
	var mapOptions = {
    zoom: 4,
    center: new google.maps.LatLng(39.5, -98.35)
  };

   map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
   google.maps.event.addListener(map,"click", function(e){infoWindow.close();});
   xajax_mapRefreshRequest(); //Call the server for info to setup the markers
   //$('#map').jMapping();
    
   //startTimer();
 }
 
//Callback for the xajax function.
//markerfile is name of the html file holding the driverinformation
function buildMarkers(markerfile)
{
	/*alert(markerfile);
	$('#map-side-bar').html(load($markerfile, nil, function(){
      $('#map').jMapping('update');
    })
	alert($('#map-side-bar').innerHTML);
	*/
}


function callForRefresh()
{
	//alert('in call for refresh'); //Just so i know the refresh call is happening
	xajax_mapRefreshRequest();
}

function startTimer()
{
	window.clearInterval(timerVar);
	//Time is in milliseconds.
	timerVar = window.setInterval(callForRefresh, 5000);
}
 //Create a new marker
function addNewMarker(md)
{
		driver = md.driver;
		pos = new google.maps.LatLng(md.lat, md.lng);
		dest = md.loc;
		ttype = md.ttype;
		unload = md.unload;
		id = md.did;
		var marker = new google.maps.Marker(
		{
			position: pos,
			map: map,
			cursor: 'default',
			icon: 'images/red-dot.png',
			description: md.description,
			driverId: id,
		});
		//Closure function to insure each marker has it's own info window data
		(function(marker) {
		  // Attaching a click event to the current marker
			google.maps.event.addListener(marker, "click", function(e) {
			infoWindow.setContent(marker.description);
			infoWindow.open(map, marker);
		  });
		  markers.push(marker); //save for refresh later	
		})(marker);
		//Save the initial set of markers
		if(isLoadEvent)
			markers.push(marker);
}



//For the refresh cycle, see if thi marker has changed.
//If so, replace the changed properties.
function checkMarker(md, markerIndex)
{
	//alert('in checkMarker');
	desc = markers[markerIndex].description;
	loc = markers[markerIndex].position;
	pos = new google.maps.LatLng(md.lat, md.lng);
	mdesc = md.description;
	if (desc == mdesc &&  loc == pos) return;//Bail - no changes
	markers[markerIndex].description = desc; 
	markers[markerIndex].position = pos;
}

//Look for the driver in the markers array.
//Return its index if found else false.
function scanMarkers(id)
{
	for(i=0;i<markers.length;i++)
	{
		if (markers[i].driverId == id)
			return i;
	}
	return false;
}

function refreshMarkers(markerdata)
{
	
	for(i=0;i<markerdata.length;i++)
	{
		//Extract the data for this item
		var md = markerdata[i];
		id = md.did;
		markerIndex = scanMarkers(id);
		if(markerIndex === false)
			addNewMarker(md);
		else
			checkMarker(md, markerIndex);
	}
	for(i=0;i<markers.length;i++)
	{
		markers[i].map = null;
		markers[i].map = map;
	}
	
}
