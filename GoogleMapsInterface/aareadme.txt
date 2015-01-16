9/11/2014
Loads by Jake Google Maps Engine Interface Read me

This project creates and controls the Google Maps for LoadsByJake.com.

We employ the Google Maps Engine APIs using PHP.

Structure:

GoogleMapsInterface
-- google-api-php-client (See google apis documentation)
-- mapsengine-api-tutorial-master (A tutorial. Not too helpful...)
client_secrets.json (API account details and keys used to authenticate)
privatekey.p12 (Goggle generated private key file used for authentication)

The permanent data is stored in the database in the google_maps_items table.
Each entry consists of an item name and item value. Such things as the client id,
current auth token and any other account details deemed necessary will be in here.
A list of item names will be provided later.

We provide some utility pages for maintenance functions.

The end product will be an html page with a JavaScript function that runs a
timer and uses an XAJAX function to refresh the map at defined intervals. It will
run on either the office large display monitors or on the user desktops and will 
contain the map embedded in the user page. The map will show drivers initially and
later on customers and brokers. The latter 2 derived from another data source
maintained by the office.

The final map will center on the continental USA and have separate layers for drivers,
customers and brokers.

Authentication will use the server to server or "service account" flow. This avoids the user's 
having to grant access using messy callbacks of the full oauth2 protocol.

