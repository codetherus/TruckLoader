/*
	This is the Javascript to service the coordinate
	API. It is part of the coordinate_driver.php page
*/
var teamID = '4H1lJJ99-aTtgICZEO8hHQ';
var clientId = '531516436563-jgu3u0sk21tv4nspte769t7uhfm33bbp.apps.googleusercontent.com';

//Handle the OAuth2 processing.
//Called on load...
function authorizeUs() {
    var config = {
      'client_id': clientId,
      'scope': 'https://www.googleapis.com/auth/coordinate'
    };
    gapi.auth.authorize(config, function() {
	  xajax_storeToken(gapi.auth.getToken());
    });
}

//Retrieve the token from the server.
//If the token is null, we callfor it 
//else we set it in the auth object.
function getToken(token)
{
	if(!token)
		xajax_getToken();
	else
		gapi.auth.setToken(token);
}

function jobsList()
{
	gapi.client.load('mapsengine', 'v1',function()
		{
			var req = gapi.client.mapsengine.assets.list();
			req.execute(function(resp){
			var myArray = JSON.stringify(resp);
			alert(myArray);});
		})
}		
		