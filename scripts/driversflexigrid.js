    $("#flex1").flexigrid
		(
		{
		url: 'includes/driver_search_grid.php',
		dataType: 'json',
		colModel : [
			{display: 'id',          name : 'id',          width : 20,  sortable : true, align: 'center'},
			{display: 'Name',        name : 'driver',      width : 120, sortable : true, align: 'left'},
			{display: 'Truck #',     name : 'truck_no',    width : 60,  sortable : true, align: 'left'},
      {display: 'Destination', name : 'location',    width : 100, sortable : true, align: 'left'},
			{display: 'Unload Date', name : 'unload_date', width : 70,  sortable : true, align: 'left'},
			{display: 'TWIC',        name : 'twic',        width : 30,  sortable : true, align: 'left'},
      {display: 'Canada',      name : 'canada',      width : 30,  sortable : true, align: 'left'}
			],
		searchitems : [
			{display: 'Driver',      name : 'driver', isdefault: true},
			{display: 'Location',    name : 'location'},
      {display: 'Unload Date', name : 'unload_date'},        
      {display: 'Truck #',     name : 'truck_no'}
			],
		sortname: "driver",
		sortorder: "asc",
		usepager: true,
		title: 'Drivers Search',
		useRp: true,
		rp: 25,
		showTableToggleBtn: true,
		width: 750,
		onSubmit: addFormData,
		height: 650
		}
		);

