		jQuery(document).ready(function(){
			initialize();
		})
			
	var map;	//Global map object
	var markers = []; //Marker array
	var infoWindow = new google.maps.InfoWindow(); //One info window for all markers
	var timerId;
	var refreshInterval = (60 * 1000) * 10; //10 minutes
	
	
	//Setup the map and call the xajax function to load the markers
	function initialize() {
	  var mapOptions = {
		zoom: 5,
		center: new google.maps.LatLng(39.50, -98.35),
		disableDefaultUI: true
	  };

	   map = new google.maps.Map(document.getElementById('map-canvas'),
		  mapOptions);
		google.maps.event.addListener(map,"click", function(e){infoWindow.close();});
		xajax_mapRefreshRequest(); //Call for the driver/broker info for the markers
	 }

	
	//Refresh call callback	
	function setupMap(drivers, brokers)
	{
		buildMarkers(drivers,brokers);
	}
	
	//Populate the map with driver and broker and customer markers and
	//build the dropdowns for users to locate a driver, broker or customer.
	//drivers is the json array of the drivers
	//brokers is the json array of brokers and customers
	function buildMarkers(drivers, brokers)
	{
	   deleteMarkers(); //Clear the markers
	   //Add the drivers
	   for(i=0;i<drivers.length;i++)
		{
			//Extract the info from the json
			var md = drivers[i];
			driver = md.driver;
			pos = new google.maps.LatLng(md.lat, md.lng);
			dest = md.loc;
			ttype = md.ttype;
			unload = md.unload;
			id = md.did;
			//Create and save the marker for this driver
			var marker = new google.maps.Marker(
			{
				position: pos,
				cursor: 'default',
				icon: 'images/red-dot.png',
				description: '<div class="iwdiv">Driver: '+ driver +'<br> Destination: ' + dest +'<br>Equipment: '+ttype+'<br>Delivery Date: '+unload+'<div>',
				did: id,
				title: driver,
				group: 'Drivers', //Grouping for the dropdowns
				driver: driver, //Name for the dropdowns
				dropdownText: driver
				//map: map
			});
			//Closure function to insure each marker has it's own info window data
			(function(marker) {
			  // Attaching a click event to the current marker
				google.maps.event.addListener(marker, "click", function(e) {
				infoWindow.setContent(marker.description);
				infoWindow.open(map, marker);
			  });
			  
			})(marker);
			markers.push(marker); 
		}
		
		//Add the brokers and customers the same way as the drivers.
		for(i=0;i<brokers.length;i++)
		{
			//Same flow as the drivers
			var md = brokers[i];
			pos = new google.maps.LatLng(md.lat, md.lng);
			var ico;
			var ctype;
			//Pick the icon
			if(md.group == 'Customer')
			{
				ico = 'images/blue-dot.png';
			}
			else
			{
				ico = 'images/ltblue-dot.png';
			}
			var marker = new google.maps.Marker(
			{
				position: pos,
				cursor: 'default',
				icon: ico,
				description: '<div class="iwdiv">'+md.group+'<br>'+md.name+'<br>'+md.address+'<br/>'+md.city+', '+md.state+'<br/>'+md.phone+'<br/>'+md.email+'</div>',
				title: md.name + ' ' + md.group,
				group: md.group,
				name: md.name
				//map: map
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
		setAllMap(map); //Show the markers
	  
      //Create the dropdowns for locatong the entities 	  
	  //xselects are containers for the select strings for each type of marker.
	  var dselect = '<select id="driverselect" onclick="findMarker(this.value)">';
		  dselect = dselect + "<option value=''>Drivers</option>";
	  var cselect = '<select id="customerselect" onChange="findMarker(this.value)">';
		  cselect = cselect + "<option value=''>Customers</option>";
	  var bselect = '<select id="brokerselect" onChange="findMarker(this.value)">';
		  bselect = bselect + "<option value=''>Brokers</option>";
	  var opt;
	  var md;
	  
	  //Pass over the markers and construct the select
	  //tags.
	  for (i=0;i<markers.length;i++)
	  {
		md=markers[i];
		if(md.group == 'Drivers')
		{
			var driver = md.driver;
			driver = driver.toUpperCase();
			dselect = dselect + '<option value='+i+'>'+driver+'</option>';
		}
		else if (md.group == 'Customer')
		{
			var thename = md.name;
			thename = thename.toUpperCase();
			cselect = cselect + '<option value='+ i + '>' + thename + '</option >';
		}
		else //Broker or Broker/Customer
		{
			var thename = md.name.toUpperCase();
			bselect = bselect + '<option value='+ i + '>' + thename + '</option >';
		}
	  }
	  //Complete the select tags
	  dselect = dselect + '</select>';
	  bselect = bselect + '</select>';
	  cselect = cselect + '</select>';
	  //Move them into their div tags for display
	  $("#driversdropdowndiv").html(dselect);
	  $("#customersdropdowndiv").html(cselect);
	  $("#brokersdropdowndiv").html(bselect);
	  setNextRefresh(); //Timer for the next refresh.
	}

//--------------- Utils
	 //Run a timer to refresh the markers at intervals
	function setNextRefresh()
	{
		timerId = setTimeout(function(){xajax_mapRefreshRequest();}, refreshInterval);	
	}

	//Locate a marker and display it's info window
	function findMarker(i)
	{
		if (!i) return;
		//alert(i);
		marker = markers[i];
		infoWindow.setContent(marker.description);//
		infoWindow.open(map, marker);
		driverselect.value='';
		customerselect.value='';
		brokerselect.value='';
	}


	// Set the map propery on each marker. Displays them.
	function setAllMap(map) {
	  for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(map);
	  }
	}

	// Removes the markers from the map, but keeps them in the array.
	function clearMarkers() {
	  setAllMap(null); //Remove the map pointers
	}

	// Shows any markers currently in the array
	// by asigning them to the map.
	function showMarkers() {
	  setAllMap(map);
	}

	// Deletes all markers in the array by removing references to them.
	function deleteMarkers() {
	  clearMarkers(); //Null out the markers
	  markers = [];   //Empty the array
	}
