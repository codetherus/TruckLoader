<?php

/*

TODO
---------

marker shapes

dsn issues

geolocation statuses

change bike, streetview, traffic to set and return tehir var names

make javascript variables into objects 

sidebar

add code to javascript says its me

if using jquery use window.load not document.ready

escape output

*/



class PHPGoogleMapAPI {

        private $map_id = 'map';
        private $language;
        private $region;
        private $sensor = 'false';
        private $api_version = 3;
        private $map_type = 'roadmap';
        private $zoom = 7;
        private $auto_encompass = true;

        private $height, $width;

        private $center_lat, $center_lng;
        private $center_on_user = false;

        private $use_geocode_cache = false;
        private $geocode_cache_table = 'geocode_cache';
        private $geocode_cache_field_lat = 'lat';
        private $geocode_cache_field_lng = 'lng';
        private $geocode_cache_field_location = 'location';
        private $geocode_cache_db;
        private $geocode_cache_db_host, $geocode_cache_db_user, $geocode_cache_db_pw, $geocode_cache_db_name;
        private $geocode_cache_db_type = mysql;
        private $geocode_cache_db_error;

        private $control_positions = array( 'top', 'top_left', 'top_right', 'bottom', 'bottom_left', 'bottom_right', 'left', 'right' );

        private $navigation_control_styles = array( 'default', 'small', 'zoom_pan', 'android' );
        private $navigation_control = true;
        private $navigation_control_position;
        private $navigation_control_style;

        private $map_type_control_styles = array( 'default', 'dropdown_menu', 'horizontal_bar' );
        private $map_types = array( 'roadmap', 'satellite', 'hybrid', 'terrain' );
        private $map_type_control = true;
        private $map_type_control_position;
        private $map_type_control_style;

        private $scale_control = false;
        private $scale_control_position;

        private $scrollable = true;
        private $draggable = true;


        private $default_marker_icon = null, $default_marker_icon_shadow = null;
        private $markers = array();
        private $marker_icons = array();
        private $marker_shapes = array();
        
        private $fusion_tables = array();

        private $traffic = false;
        private $bicycle_routes = false;

        private $event_listeners = array();

        private $info_windows = true;
        
        private $compress_output = false;
        
        private $get_user_location = false;
        private $geocode_high_accuracy = false;
        private $user_location_fail_function;
        private $geocode_timeout = 6000;
        private $user_location_backup_lat;
        private $user_location_backup_lng;

        private $streetview;

        private $mobile = false;

        private $directions;
        private $directions_units_options = array( 'imperial', 'metric' );
        private $directions_units;
        private $directions_fail_callback;
        private $directions_success_callback;

        function getStaticMap( $format='png', array $visible = null ) {
        
                $url = "http://maps.google.com/maps/api/staticmap?";

                $request .= sprintf( "size=%sx%s&", intval( $this->width ), intval( $this->height ) );
                $request .= sprintf( "sensor=%s&", $this->sensor );
                $request .= sprintf( "format=%s&", $format );
                $request .= sprintf( "maptype=%s&", $this->map_type );
                $request .= sprintf( "language=%s&", $this->language );
                if ( is_array( $visible ) ) {
                        $request .= sprintf( "visible=%s&", implode( ',', $visible ) );
                }
                if ( $this->center_lat && $this->center_lng ) {
                        $request .= sprintf( "center=%s,%s&", $this->center_lat, $this->center_lng );
                        $request .= sprintf( "zoom=%s&", $this->zoom );
                }
                foreach( $this->markers as $marker ) {
                        $request .= sprintf( "markers=size:%s|color:%s|label:%s|%sshadow:%s|%s,%s&",
                                $marker->static->size,
                                $marker->static->color,
                                strtoupper( (string) $marker->static->label[0] ),
                                ( $marker->icon )  ? ( is_int( $marker->icon ) ? sprintf( "icon:%s|", $this->marker_icons[$marker->icon]->url ) : sprintf( "icon:%s|", $marker->icon ) ) : '',
                                ( $marker->static->flat ) ? 'false' : 'true',
                                $marker->lat, $marker->lng
                        );
                }
                return sprintf( "%s%s", $url, $request );
        
        }

        function validateStaticMap( $format='png', array $visible = null ) {
                $headers = get_headers($this->getStaticMap());
                if ( strpos( $headers[0], '200' ) ) {
                        return true;
                }
                return false;
        }

        function printStaticMap( $format='png', array $visible = null ) {
                echo $this->getStaticMap();
        }

        function addMarkerShapeCircle( $center_x, $center_y, $radius ) {
                $coords = array( $center_x, $center_y, $radius );
                return $this->addMarkerShape( 'circle', $coords);
        }

        function addMarkerShapePoly( array $coords ) {
                return $this->addMarkerShape( 'poly', $coords );
        }

        function addMarkerShapeRect( $topleft_x, $topleft_y, $bottomright_x, $bottomright_y ) {
                $coords = array ( $topleft_x, $topleft_y, $bottomright_x, $bottomright_y );
                return $this->addMarkerShape( 'rect', $coords );
        }

        function AddMarkerShape( $type, array $coords ) {
                $shape = new MarkerShape;
                $shape->type =  $type;
                $shape->coords = $coords;
                $shape->id = count( $this->marker_shapes ) + 1;
                $this->marker_shapes[$shape->id] = $shape;
                return $shape;
        }

        private function setDirectionsTravelMode( $directions_travel_mode ) {
                if ( in_array( strtolower($directions_travel_mode ), $this->directions_travel_modes ) ) {
                        $this->directions_travel_modes = $directions_travel_modes;
                }
        }
        function setDirectionsUnits( $directions_units ) {
                if ( in_array( strtolower($directions_units ), $this->directions_units ) ) {
                        $this->directions_units = $directions_units;
                }
        }
        function setDirectionsFailCallback( $callback ) {
                $this->directions_fail_callback = $callback;
        }
        function setDirectionsSuccessCallback( $callback ) {
                $this->directions_success_callback = $callback;
        }

        private function validateDirectionsPoint( $point ) {
                if ( is_array( $point ) ) {
                        if ( !isset( $point['lat'], $point['lng'] ) ) {
                                return false;
                        }
                }
                if ( !strlen( $point ) ) {
                        return false;
                }
                return true;
        }

        function addDrivingDirections( $origin, $destination ) {
                return $this->addDirections( $origin, $destination, 'driving' );
        }
        function addBicyclingDirections( $origin, $destination ) {
                return $this->addDirections( $origin, $destination, 'bicycling' );
        }
        function addWalkingDirections( $origin, $destination ) {
                return $this->addDirections( $origin, $destination, 'walking' );
        }
        private function addDirections( $origin, $destination, $travel_mode ) {
        
                if ( !$this->validateDirectionsPoint( $origin ) || !$this->validateDirectionsPoint( $destination ) ) {
                        return false;
                }
        
                $directions = new Directions;
                $directions->request_options = new StdClass;
                $directions->renderer_options = new StdClass;
                $directions->request_options->origin =  ( is_array( $origin ) ) ? (object) $origin : $origin;
                $directions->request_options->destination =  ( is_array( $destination ) ) ? (object) $destination : $destination; 
                $directions->request_options->travel_mode = $travel_mode;
                $this->directions = $directions;
                return true;
        
        }

        function setDirectionsRequestOptions( $request_options ) {
                foreach( $request_options as $request_option => $request_value ) {
                        if ( !isset( $this->directions->request_options->$request_option ) ) {
                                $this->directions->request_options->$request_option = $request_value;
                        }
                }
        }

        function setDirectionsRendererOptions( $renderer_options ) {
                foreach( $renderer_options as $renderer_option => $renderer_value ) {
                        if ( !isset( $this->directions->renderer_options->$renderer_option ) ) {
                                $this->directions->renderer_options->$renderer_option = $renderer_value;
                        }
                }
        }

        function setDirectionsPanel( $panel ) {
                $this->directions->renderer_options->panel = $panel;
        }

        function getDirections() {
                return $this->directions;
        }

        function getLocationByIP( $ip ) {
                $url = sprintf( "http://api.hostip.info/?ip=%s&position=true", $ip );
                $data = $this->scrape( $url );
                if ( !$data ) return false;
                $xml = simplexml_load_string( str_replace( ":", "_", $data ) );
                $coords = trim( (string) $xml->gml_featureMember->Hostip->ipLocation->gml_pointProperty->gml_Point->gml_coordinates );
                if ( $coords ) {
                        $latlng = explode( ',', $coords );
                        $location = new stdClass();
                        $location->lat = $latlng[1];
                        $location->lng = $latlng[0];
                        return $location;
                }
                return false;
        }

        function getUserLocation( $geocode_timeout=null, $geocode_high_accuracy=null ) {
                if ( $geocode_timeout ) $this->geocode_timeout = (int) $geocode_timeout;
                if ( $geocode_high_accuracy ) $this->geocode_high_accuracy = (bool) $geocode_high_accuracy;
                $this->get_user_location = true;
        }

        function setGeocodeCacheFields( $location, $lat, $lng ) {
                $this->geocode_cache_field_location = $location;
                $this->geocode_cache_field_lat = $lat;
                $this->geocode_cache_field_lng = $lng;
        }

        function enableGeocodeCaching() {
                $this->use_geocode_cache = true;
        }

        function disableGeocodeCaching() {
                $this->use_geocode_cache = false;
        }

        function getGeocodeCacheDbError() {
                return $this->geocode_cache_db_error;
        }

        function setGeocodeCacheDbInfo( $geocode_cache_db_host, $geocode_cache_db_user, $geocode_cache_db_pw, $geocode_cache_db_name, $geocode_cache_db_type=null ) {
                $this->geocode_cache_db_host    = $geocode_cache_db_host;
                $this->geocode_cache_db_user    = $geocode_cache_db_user;
                $this->geocode_cache_db_pw              = $geocode_cache_db_pw;
                $this->geocode_cache_db_name    = $geocode_cache_db_name;
                if ( $geocode_cache_db_type ) {
                        $this->geocode_cache_db_type = $geocode_cache_db_type;
                }
        }

        function setGeocodeCacheTable( $geocode_cache_table ) {
                $this->geocode_cache_table = $geocode_cache_table;
        }

        private function getGeocodeCacheDb( $persistent=true ) {
                if ( !$this->geocode_cache_db_name ) return false;
                if ( !$this->geocode_cache_db ) {
                        $driver_optionas = array();
                        $dsn = sprintf( '%s:dbname=%s;host=%s', $this->geocode_cache_db_type, $this->geocode_cache_db_name, $this->geocode_cache_db_host );
                        if ( $persistent ) {
                                $driver_options[PDO::ATTR_PERSISTENT] = true;
                        }
                        try {
                                $this->geocode_cache_db = new pdo( $dsn, $this->geocode_cache_db_user, $this->geocode_cache_db_pw, $driver_options );
                        }
                        catch (PDOException $e) {
                                $this->geocode_cache_db_error = new stdClass();
                                $this->geocode_cache_db_error->message = $e->getMessage();
                                $this->geocode_cache_db_error->code = $e->getCode();
                                return false;
                        }
                }
                return $this->geocode_cache_db;
        }

        // override this
        function getGeocodeCache( $location ) {
                $db = $this->getGeocodeCacheDb();
                if ( !$db ) return false;
                $get = $db->prepare( sprintf( 'select %s, %s from %s where %s=:location limit 1', $this->geocode_cache_field_lat, $this->geocode_cache_field_lng, $this->geocode_cache_table, $this->geocode_cache_field_location ) );
                $get->bindValue( ':location', $location );
                $get->execute();
                $result = $get->fetchAll( PDO::FETCH_ASSOC );
                if ( count( $result ) ) {
                        $cached_result = new stdClass();
                        $cached_result->lat = $result[0]['lat'];
                        $cached_result->lng = $result[0]['lng'];
                        return $cached_result;
                }
                return false;
        }

        // override this
        function putGeocodeCache( $location, $lat, $lng ) {
                $db = $this->getGeocodeCacheDb();
                if ( !$db ) return false;
                $put = $db->prepare( sprintf( 'insert into %s (%s,%s,%s) values(:lat,:lng,:location)', $this->geocode_cache_table, $this->geocode_cache_field_lat, $this->geocode_cache_field_lng, $this->geocode_cache_field_location ) );
                $put->bindValue( ':lat', $lat );
                $put->bindValue( ':lng', $lng );
                $put->bindValue( ':location', $location );
                $put->execute();
                return $put->rowCount();
        }

        function clearGeocodeCache() {
                $db = $this->getGeocodeCacheDb();
                if ( !$db ) return false;
                $clear = $db->prepare( sprintf( 'delete from %s', $this->geocode_cache_table ) );
                $clear->execute();
                return $clear->rowCount();
        }

        // returning viewport or bounds disables caching
        function geocode( $location, $return_viewport=false, $return_bounds=false ) {

                if ( $this->use_geocode_cache && !$return_viewport && !$return_bounds ) {
                        if ( ( $cached_geocoded_location = $this->getGeocodeCache( $location ) ) !== false ) {
                                $cached_geocoded_location->get_cache = true;
                                return $cached_geocoded_location;
                        }
                }

                $url = sprintf( "http://maps.google.com/maps/api/geocode/json?address=%s&sensor=false", urlencode( $location ) );

                $gc = json_decode( $this->scrape( $url ) );

                if ( $gc->status != 'OK' ) {
                        return false;
                }
                
                $geocoded_location = new stdClass();
                $geocoded_location->lat = $gc->results[0]->geometry->location->lat;
                $geocoded_location->lng = $gc->results[0]->geometry->location->lng;

                if ( $return_viewport ) {
                        $geocoded_location->viewport = new stdClass();
                        $geocoded_location->viewport->southwest = new stdClass();
                        $geocoded_location->viewport->southwest->lat = $gc->results[0]->geometry->viewport->southwest->lat;
                        $geocoded_location->viewport->southwest->lng = $gc->results[0]->geometry->viewport->southwest->lng;
                        $geocoded_location->viewport->northeast = new stdClass();
                        $geocoded_location->viewport->northeast->lat = $gc->results[0]->geometry->viewport->northeast->lat;
                        $geocoded_location->viewport->northeast->lng = $gc->results[0]->geometry->viewport->northeast->lng;
                }
                
                if ( $return_bounds ) {
                        $geocoded_location->bounds = new stdClass();
                        $geocoded_location->bounds->southwest = new stdClass();
                        $geocoded_location->bounds->southwest->lat = $gc->results[0]->geometry->bounds->southwest->lat;
                        $geocoded_location->bounds->southwest->lng = $gc->results[0]->geometry->bounds->southwest->lng;
                        $geocoded_location->bounds->northeast = new stdClass();
                        $geocoded_location->bounds->northeast->lat = $gc->results[0]->geometry->bounds->northeast->lat;
                        $geocoded_location->bounds->northeast->lng = $gc->results[0]->geometry->bounds->northeast->lng;
                }

                if ( $this->use_geocode_cache && !$return_viewport && !$return_bounds ) {
                        if ( $this->putGeocodeCache( $location, $geocoded_location->lat, $geocoded_location->lng ) ) {
                                $geocoded_location->put_cache = true;
                        }
                }
                
                return $geocoded_location;
                
        }

        function getMarkerCount() {
                return count( $this->markers );
        }

        function setDefaultMarkerIcon( $icon, $icon_shadow=null ) {
                if ( $icon instanceof MarkerIcon ) {
                        $default_icon = $icon->id;
                }
                else {
                        $default_icon = $icon;
                }
                
                if ( $icon_shadow ) {
                        if ( $icon_shadow instanceof MarkerIcon ) {
                                $default_icon_shadow = $icon_shadow->id;
                        }
                        else {
                                $default_icon_shadow = $icon_shadow;
                        }
                }               
                $this->default_marker_icon = $default_icon;
                if  ( $default_icon_shadow ) $this->default_marker_icon_shadow = $default_icon_shadow;
        }

        function clearDefaultMarkerIcon() {
                $this->default_marker_icon = null;
                $this->default_marker_icon_shadow = null;
        }

        function enableCompressedOutput() {
                $this->compress_output = true;
        }
        
        function enableInfoWindows() {
                $this->info_windows = true;
        }

        function disableInfoWindows() {
                $this->info_windows = false;
        }

        function enableScrollWheel() {
                $this->scrollable = true;
        }

        function disableScrollWheel() {
                $this->scrollable = false;
        }

        function enableDragging() {
                $this->draggable = true;
        }

        function disableDragging() {
                $this->draggable = false;
        }

        function enableAutoEncompass() {
                $this->auto_encompass = true;
        }

        function disableAutoEncompass() {
                $this->auto_encompass = false;
        }

        function addEventListener( $event, $function ) {
                $this->event_listeners[] = array(
                        'event'         => $event,
                        'function'      => $function
                );
        }

        function enableUserLocation() {
                $this->get_user_location = true;
        }

        function enableCenterOnUserLocation() {
                $this->center_on_user = true;
        }

        function enableBicycleRoutes() {
                $this->bicycle_routes = true;
        }
        
        function enableTraffic() {
                $this->traffic = true;
        }
        
        function addFusionTable( $fusion_table_id, $query=null, $heatmap=false ) {
                $fusion_table = new FusionTable;
                $fusion_table->id = count( $this->fusion_tables ) + 1;
                $fusion_table->dsrcid = $fusion_table_id;
                $fusion_table->query = $query;
                $fusion_table->heatmap = $heatmap;
                $this->fusion_tables[$fusion_table->id] = $fusion_table;
                return $fusion_table;
        }

        /*
        * Marker Functions
        */

        function getMarkers() {
                return $this->markers;
        }
        function getMarker( $marker ) {
                return $this->markers[$marker];
        }

        function addMarkerIcon( $icon_absolute_url, $icon_anchor_x=null, $icon_anchor_y=null, $icon_origin_x=0, $icon_origin_y=0, $icon_width=null, $icon_height=null ) {
        
                if ( !$icon_width || !$icon_height ) {
                        list( $icon_image_width, $icon_image_height ) = getimagesize( $icon_absolute_url );
                }
        
                if ( !$icon_width ) $icon_width = $icon_image_width;
                if ( !$icon_height ) $icon_height = $icon_image_height;

                $icon = new MarkerIcon;
                $icon->id = count( $this->marker_icons ) + 1;
                $icon->url = $icon_absolute_url;
                $icon->width = $icon_width;
                $icon->height = $icon_height;
                if ( $icon_anchor_x === null ) $icon_anchor_x = $icon_width / 2;
                if ( $icon_anchor_y === null ) $icon_anchor_y = $icon_height;
                $icon->anchor = new StdClass;
                $icon->anchor->x = $icon_anchor_x;
                $icon->anchor->y = $icon_anchor_y;
                $icon->origin = new StdClass;
                $icon->origin->x = $icon_origin_x;
                $icon->origin->y = $icon_origin_y;
                
                if ( $shadow_icon ) $icon->shadow = $shadow_icon->id;

                $this->marker_icons[$icon->id] = $icon;

                return $icon;
        
        }

        function addMarkerByLocation( $location, $content='', $icon=null, $icon_shadow=null, array $options=null, MarkerShape $shape=null, array $static_marker_style=null ) {
                if ( ( $coords = $this->geocode( $location ) ) === false ) {
                        return false;
                }
                return $this->addMarkerByCoords( $coords->lat, $coords->lng, $content, $icon, $icon_shadow, $options, $shape, $static_marker_style );
        }
        function addStaticMapMarkerByLocation( $location, $icon=null, $flat=false, $color=null, $label=null, $size=null ) {
                $static_marker_style['flat'] = $flat;
                $static_marker_style['color'] = $color;
                $static_marker_style['label'] = $label;
                $static_marker_style['size'] = $size;
                return $this->addMarkerByLocation( $location, null, $icon, null, null, $static_marker_style );
        }

        function addMarkerByCoords( $lat, $lng, $content='', $icon=null,$icon_shadow=null, array $options=null, MarkerShape $shape=null, array $static_marker_style=null ) {
                $marker = new Marker;
                $marker->lat = $lat;
                $marker->lng = $lng;
                $marker->content = $content;
                $marker->icon = $icon;
                $marker->icon_shadow = $icon_shadow;
                $marker->static_marker_style = $static_marker_style;
                $marker->shape = $shape;
                $marker->options = (object) $options;
                return $this->addMarker( $marker );
        }
        function addStaticMapMarkerByCoords( $lat, $lng, $icon=null, $flat=false, $color=null, $label=null, $size=null ) {
                $static_marker_style['flat'] = $flat;
                $static_marker_style['color'] = $color;
                $static_marker_style['label'] = $label;
                $static_marker_style['size'] = $size;
                return $this->addMarkerByCoords( $lat, $lng, null, $icon, null, null, $static_marker_style );
        }

        function addMarkerByUserLocation( $content='', $icon=null, $icon_shadow=null, array $options=null, MarkerShape $shape=null, array $static_marker_style=null ) {
                $this->getUserLocation();
                $marker = new Marker;
                $marker->options = (object) $options;
                $marker->user_location = true;
                $marker->content = $content;
                $marker->icon = $icon;
                $marker->icon_shadow = $icon_shadow;
                $marker->shape = $shape;
                $marker->static_marker_style = $static_marker_style;
                return $this->addMarker( $marker );
        }

        private function addMarker( Marker $marker ) {

                if ( $marker->icon instanceof MarkerIcon ) {
                        $marker->icon = $marker->icon->id;
                }
                elseif ( $this->default_marker_icon ) {
                        $marker->icon = $this->default_marker_icon;
                }

                if ( $marker->icon_shadow instanceof MarkerIcon ) {
                        $marker->icon_shadow = $marker->icon_shadow->id;
                }
                elseif ( $this->default_marker_icon_shadow ) {
                        $marker->icon_shadow = $this->default_marker_icon_shadow;
                }

                if ( $marker->static_marker_style ) {
                        $marker->static = new StdClass;
                        $marker->static = (object) $marker->static_marker_style;
                        unset( $marker->static_marker_style );
                }
                
                if ( is_array( $marker->options ) ) {
                        $marker->options = (object) $marker->options;
                }
                if ( $marker->shape ) {
                        $marker->shape = $marker->shape->id;
                }
                
                $marker->id = count( $this->markers ) + 1;
                $this->markers[$marker->id] = $marker;
                return $marker;
        }

        function setNavigationControlPosition( $position ) {
                if ( in_array( strtolower($position), $this->control_positions ) ) {
                        $this->navigation_control_position = $position;
                }
        }

        function setMapTypeControlPosition( $position ) {
                if ( in_array( strtolower($position), $this->control_positions ) ) {
                        $this->map_type_control_position = $position;
                }
        }

        function setScaleControlPosition( $position ) {
                if ( in_array( strtolower($position), $this->control_positions ) ) {
                        $this->scale_control_position = $position;
                }
        }

        function enableScaleControl() {
                $this->scale_control = true;
        }

        function disableScaleControl() {
                $this->scale_control = false;
        }

        function enableNavigationControl() {
                $this->navigation_control = true;
        }

        function disableNavigationControl() {
                $this->navigation_control = false;
        }

        function enableMapTypeControl() {
                $this->map_type_control = true;
        }

        function disableMapTypeControl() {
                $this->map_type_control = false;
        }

        //override this function if you have to
        function scrape( $url ) {
                if ( ini_get( 'allow_url_fopen' ) ) {
                        return file_get_contents( $url );
                }
                elseif ( function_exists( 'curl_init' ) ) {
                        $curl = curl_init();
                        curl_setopt( $curl, CURLOPT_URL, $url );
                        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
                        curl_setopt( $curl, CURLOPT_HEADER, 0);
                        return curl_exec( $curl );
                }
                else {
                                return FALSE;
                }
        }

        function setMapType( $map_type ) {
                if ( in_array( strtolower($map_type), $this->map_types ) ) {
                        $this->map_type = $map_type;
                }
        }

        function setNavigationControlStyle( $style ) {
                if ( in_array( strtolower($style), $this->navigation_control_styles ) ) {
                        $this->navigation_control_style = $style;
                }
        }

        function setMapTypeControlStyle( $style ) {
                if ( in_array( strtolower($style), $this->map_type_control_styles ) ) {
                        $this->map_type_control_style = $style;
                }
        }

        function setZoom( $zoom ) {
                $this->zoom = abs( (int) $zoom ); 
        }
        
        function setCenterByCoords( $lat, $lng ) {
                $this->center_lat = (float) $lat;
                $this->center_lng = (float) $lng;
        }
        
        function setCenterByLocation( $location ) {
                if ( ( $coords = $this->geocode( $location ) ) === false ) {
                        return false;
                }
                $this->setCenterByCoords( $coords->lat, $coords->lng );
        }

        function setCenterByUserLocation( $backup_lat=null, $backup_lng=null ) {
                if ( $backup_lat ) $this->user_location_backup_lat = $backup_lat;
                if ( $backup_lng ) $this->user_location_backup_lng = $backup_lng;
                $this->getUserLocation();
                $this->center_on_user = true;
        }

        function getCenterCoordsLat() {
                return $this->center_lat;
        }

        function getCenterCoordsLng() {
                return $this->center_lng;
        }

        function enableMobileDisplay( $set_dimensions=false ) {
                $this->mobile = true;
                if ( $set_dimensions ) {
                        $this->setWidth( '100%' );
                        $this->setHeight( '100%' );
                }
        }

        function getHeaderJS() {
                return sprintf( "%s<script type=\"text/javascript\" src=\"http://maps.google.com/maps/api/js?sensor=%s&v=%s&language=%s&region=%s\"></script>\n\n", ( $this->mobile ? "<meta name=\"viewport\" content=\"initial-scale=1.0, user-scalable=no\">\n" : '' ), $this->sensor, $this->api_version, $this->language, $this->region );
        }
        
        function printHeaderJS() {
                echo $this->getHeaderJS();
        }

        function getStreetView() {
                return $this->streetview;
        }       

        function enableStreetView( $streetview_container = null ) {
        
                $streetview = new StreetView;
                $streetview->js_var = sprintf( "%s_streetview", $this->map_id );
                if ( $streetview_container ) {
                        $streetview->container = $streetview_container;
                }
                else {
                        $streetview->container = $this->map_id;
                }
                
                $streetview->pov = new StdClass;
                $streetview->pov->heading = 0;
                $streetview->pov->pitch = 8;
                $streetview->pov->zoom = 1;
                
                $this->streetview = $streetview;

                return $this->streetview->js_var;
        }
        function setStreetViewLocationByLocation( $location ) {
                if ( ( $coords = $this->geocode( $location ) ) === false ) {
                        return false;
                }
                $this->setStreetViewLocationByCoords( $coords->lat, $coords->lng );
        }
        function setStreetViewLocationByCoords( $streetview_position_lat, $streetview_position_lng ) {
                $this->streetview->position = new StdClass;
                $this->streetview->position->lat = $streetview_position_lat;
                $this->streetview->position->lng = $streetview_position_lng;    
        }
        function setStreetViewHeading( $heading ) {
                $this->streetview->pov->heading = $heading;
        }
        function setStreetViewPitch( $pitch ) {
                $this->streetview->pov->pitch = $pitch;
        }
        function setStreetViewZoom( $zoom ) {
                $this->streetview->pov->zoom = $zoom;
        }
        function setStreetViewOptions( $streetview_options ) {
                $this->streetview->options = $streetview_options;
        }
        
        function phpToJs( $php, $n = true, $tabs = 0, $brackets = false ) {
        
                if ( is_bool( $php ) ) {
                        return $php ? 'true' : 'false';
                }
        
                if ( is_numeric( $php ) ) {
                        return $php;
                }
        
                if ( is_array( $php ) || is_object( $php ) ) {
                        foreach( $php as $k => $v ) {
                                $js .= sprintf( "%s%s:%s,%s", str_repeat( "\t", $tabs ), $k, $this->phpToJs( $v ), ( $n ) ? "\n": "" );
                        }
                        return sprintf( "%s%s%s", ( $brackets ? "{" : "" ), $js, ( $brackets ? "}" : "" ) );
                }
                
                return sprintf( '"%s"', $php );
        }

        function setMapPreloadFunction( $preload_function ) {
                $this->preload_function = $preload_function;
        }
        function setMapOnloadFunction( $onload_function ) {
                $this->onload_function = $onload_function;
        }
        function setUserLocationFailFunction( $user_location_fail_function ) {
                $this->user_location_fail_function = $user_location_fail_function;
        }

        function getMapJS() {

                if ( $this->preload_function ) {
                        $output .= sprintf( "google.maps.event.addDomListener(window, \"load\", %s );\n\n", $this->preload_function );
                }

                $output .= sprintf( "var %s;\nfunction phpgooglemap_%s() {\n\nthis.initialize = function() {\n\n", $this->map_id, $this->map_id );
                $output .= "\tvar self = this;\n";
                $output .= "\tthis.map_options = {\n";
                $output .= sprintf("\t\tzoom: %s,\n", $this->zoom );

                if ( !$this->scroll_wheel ) {
                        $output .= "\t\tscrollwheel: false,\n";
                }
                if ( $this->streetview ) {
                        $output .= "\t\tstreetViewControl: true,\n";
                }
                if ( !$this->draggable ) {
                        $output .= "\t\tdraggable: false,\n";
                }

                $output .= sprintf( "\t\tnavigationControl: %s,\n", $this->phpToJs( $this->navigation_control ) );
                $output .= sprintf( "\t\tmapTypeControl: %s,\n", $this->phpToJs( $this->map_type_control ) );
                $output .= sprintf( "\t\tscaleControl: %s,\n", $this->phpToJs( $this->scale_control ) );

                $output .= "\t\tnavigationControlOptions: {\n";
                if ( $this->navigation_control_style ) {
                        $output .= sprintf( "\t\t\tstyle: google.maps.NavigationControlStyle.%s,\n", strtoupper( $this->navigation_control_style ) );
                }
                if ( $this->navigation_control_position ) {
                        $output .= sprintf( "\t\t\tposition: google.maps.ControlPosition.%s,\n", strtoupper( $this->navigation_control_position ) );
                }
                $output .= "\t\t},\n";

                $output .= "\t\tmapTypeControlOptions: {\n";
                if ( $this->map_type_control_style ) {
                        $output .= sprintf( "\t\t\tstyle: google.maps.MapTypeControlStyle.%s,\n", strtoupper( $this->map_type_control_style ) );
                }
                if ( $this->map_type_control_position ) {
                        $output .= sprintf( "\t\t\tposition: google.maps.ControlPosition.%s,\n", strtoupper( $this->map_type_control_position ) );
                }
                $output .= "\t\t},\n";

                $output .= "\t\tscaleControlOptions: {\n";
                if ( $this->scale_control_position ) {
                        $output .= sprintf( "\t\t\tposition: google.maps.ControlPosition.%s,\n", strtoupper( $this->scale_control_position ) );
                }
                $output .= "\t\t},\n";

            $output .= sprintf("\t\tmapTypeId: google.maps.MapTypeId.%s,\n", strtoupper( $this->map_type ) );
                $output .= "\t};\n\n";
                $output .= sprintf( "\tthis.map = new google.maps.Map(document.getElementById(\"%s\"), this.map_options);\n", $this->map_id );
                
                if ( $this->directions ) {
                        $output .= "\tthis.directions = {};\n";
                        // Directions Renderer Options
                        $renderer_options = "\tthis.directions.renderer_options = {\n";
                        foreach ( $this->directions->renderer_options as $renderer_option => $renderer_value ) {
                                switch ( $renderer_option ) {
                                        case 'panel':
                                                $renderer_options .= sprintf( "\t\tpanel: document.getElementById(\"%s\"),\n", $renderer_value );
                                                break;
                                        default:
                                                $renderer_options .= sprintf( "\t\t%s:%s,\n", $renderer_option, $this->phpToJs( $renderer_value, null, null, true ) );
                                }
                        }
                        $renderer_options .= "\t};\n\n";
                        $output .= $renderer_options;
                
                        $output .= "\tthis.directions.renderer = new google.maps.DirectionsRenderer(this.directions.renderer_options);\n\tthis.directions.service = new google.maps.DirectionsService();\n";
                        $output .= "\tthis.directions.renderer.setMap(this.map);\n\n";
                        
                        // Directions Request Options
                        $request_options = sprintf( "\tthis.directions.request_options = {\n", $this->map_id );
                        foreach ( $this->directions->request_options as $request_option => $request_value ) {
                                switch ( $request_option ) {
                                        case 'origin':
                                                if ( is_object( $this->directions->request_options->origin ) ) {
                                                        $request_options .= sprintf( "\t\torigin: new google.maps.LatLng(%s,%s),\n", $this->directions->request_options->origin->lat, $this->directions->request_options->origin->lng );
                                                }
                                                else {
                                                        $request_options .= sprintf( "\t\torigin: \"%s\",\n", $this->directions->request_options->origin );
                                                }
                                                break;
                                        case 'destination':
                                                if ( is_object( $this->directions->request_options->destination ) ) {
                                                        $request_options .= sprintf( "\t\tdestination: new google.maps.LatLng(%s,%s),\n", $this->directions->request_options->destination->lat, $this->directions->request_options->destination->lng );
                                                }
                                                else {
                                                        $request_options .= sprintf( "\t\tdestination: \"%s\",\n", $this->directions->request_options->destination );
                                                }
                                                break;
                                        case 'travel_mode':
                                                $request_options .= sprintf( "\t\ttravelMode: google.maps.DirectionsTravelMode.%s,\n", strtoupper( $this->directions->request_options->travel_mode ) );
                                                break;
                                        default:
                                                $request_options .= sprintf( "\t\t%s:%s,\n", $request_option, $this->phpToJs( $request_value ) );
                                }
                        }
                        $request_options .= "\t};\n";
                        $output .= $request_options;
                        $output .= sprintf( "\t\n\tthis.directions.service.route(this.directions.request_options, function(response,status) {\n\t\tif (status == google.maps.DirectionsStatus.OK) {\n\t\t\tself.directions.success = response;\n\t\t\tself.directions.renderer.setDirections(response);%s\n\t\t}\n\t\telse {\n\t\t\tself.directions.error = status;%s\n\t\t}\n\t});\n\n",
                                ( $this->directions_success_callback ? sprintf( "\n\t\t\t%s(response);", $this->directions_success_callback ) : "" ),
                                ( $this->directions_fail_callback ? sprintf( "\n\t\t\t%s(status);", $this->directions_fail_callback ) : "" )
                        );
                }

                if ( count( $this->marker_shapes ) ) {
                        $output .= sprintf( "\n\tthis.marker_shapes = [];\n", $this->map_id );
                }
                foreach ( $this->marker_shapes as $marker_shape ) {
                        $output .= sprintf( "\tthis.marker_shapes[%s] = {\n", $marker_shape->id );
                        $output .= sprintf( "\t\ttype: \"%s\",\n", 'circle');//, $marker_shape->type );
                        $output .= sprintf( "\t\tcoord: [%s]\n", implode( ",", $marker_shape->coords ) );
                        $output .= "\t};\n";
                }

                if ( count( $this->marker_icons ) ) {
                        $output .= sprintf( "\n\tthis.marker_icons = [];\n", $this->map_id );
                }
                foreach ( $this->marker_icons as $marker_icon_name => $marker_icon ) {
                
                        $output .= sprintf( "\tthis.marker_icons[%s] = new google.maps.MarkerImage(\n\t\t\"%s\",\n", $marker_icon->id, $marker_icon->url );
                        $output .= sprintf( "\t\tnew google.maps.Size(%s, %s),\n", $marker_icon->width, $marker_icon->height );
                        $output .= sprintf( "\t\tnew google.maps.Point(%s, %s),\n", (int)$marker_icon->origin->x, (int)$marker_icon->origin->y );
                        $output .= sprintf( "\t\tnew google.maps.Point(%s, %s)\n", (int)$marker_icon->anchor->x, (int)$marker_icon->anchor->y );
                        $output .= "\t);\n";
                }
                
                if ( count( $this->markers ) && $this->auto_encompass ) {
                        $output .= "\n\tthis.bounds = new google.maps.LatLngBounds();\n";
                }

                if ( count( $this->markers ) && $this->info_windows ) {
                        $output .= "\tthis.info_window = new google.maps.InfoWindow();\n";
                }

                if ( count( $this->markers ) ) {
                        $output .= "\n\tthis.markers = [];\n";
                }

                foreach ( $this->markers as $marker ) {
                
                        if ( $marker->user_location ) {
                                $output .= "\tif ( navigator.geolocation && typeof user_location != 'undefined' ) {\n";
                        }
                
                        $output .= sprintf( "\tthis.markers[%s] = new google.maps.Marker({\n", $marker->id );
                        if ( $marker->user_location ) {
                                $output .= "\t\tposition: user_location,\n";
                        }
                        else {
                                $output .= sprintf( "\t\tposition: new google.maps.LatLng(%s,%s),\n", $marker->lat, $marker->lng );                     
                        }
                        $output .= "\t\tmap: this.map,\n";

                        if ( $marker->icon ) {
                                if ( is_int( $marker->icon ) ) {
                                        $output .= sprintf( "\t\ticon:this.marker_icons[%s],\n", $marker->icon );
                                }
                                else {
                                        $output .= sprintf( "\t\ticon:\"%s\",\n", $marker->icon );
                                }
                        }
                        if ( $marker->icon && $marker->icon_shadow ) {
                                if ( is_int( $marker->icon_shadow ) ) {
                                        $output .= sprintf( "\t\tshadow:this.marker_icons[%s],\n", $marker->icon_shadow );
                                }
                                else {
                                        $output .= sprintf( "\t\tshadow:\"%s\",\n", $marker->icon_shadow );
                                }
                        }
                        if ( $marker->shape ) {
                                $output .= sprintf( "\t\tshape: this.marker_shapes[%s],\n", $marker->shape );
                        }
                        if ( is_object( $marker->options ) ) {
                                foreach( $marker->options as $marker_option => $marker_value ) {
                                        $output .= sprintf( "\t\t%s:%s,\n", $marker_option, $this->phpToJs( $marker_value ) );
                                }
                        }
                        
                        $output .= "\t});\n";

                        if ( $this->info_windows ) {
                                $output .= sprintf( "\tgoogle.maps.event.addListener(this.markers[%s], 'click', function() { self.info_window.setContent('%s');self.info_window.open(self.map,self.markers[%s]); });\n", $marker->id, $marker->content, $marker->id );
                        }

                        if ( $this->auto_encompass & !$marker->location ) {
                                $output .= sprintf( "\tthis.bounds.extend(this.markers[%s].position);\n", $marker->id );
                                $output .= "\tthis.map.fitBounds(this.bounds);\n";
                        }

                        if ( $marker->user_location ) {
                                $output .= "\t}\n\n";
                        }

                }
                
                if ( count( $this->fusion_tables ) ) {
                        $output .= "\tthis.fusion_tables = [];\n";
                }
                foreach ( $this->fusion_tables as $fusion_table ) {
                
                        if ( $fusion_table->query ) {
                                $ft_options = sprintf( "\t\tquery: \"%s\",\n", str_replace( "\"", "'", $fusion_table->query ) );
                        }
                        if ( $fusion_table->heatmap ) {
                                $ft_options .= "\t\theatmap: true,\n";
                        }
                        $output .= sprintf( "\tthis.fusion_tables[%s] = new google.maps.FusionTablesLayer(%s, {\n%s\t});\n\tthis.fusion_tables[%s].setMap(this.map);\n\n", $fusion_table->id, $fusion_table->dsrcid, $ft_options, $fusion_table->id );
                }
                
                if ( $this->traffic ) {
                        $output .= "\tthis.traffic_layer = new google.maps.TrafficLayer().setMap(this.map);\n\n";
                }

                if ( $this->bicycle_routes ) {
                        $output .= "\tthis.bicycle_layer = new google.maps.BicyclingLayer().setMap(this.map);\n\n";
                }

                if ( $this->center_on_user ) {
                        if ( $this->user_location_backup_lat && $this->user_location_backup_lng ) {
                                $output .= "\tif ( typeof user_location != 'undefined' ) {\n";
                        }
                        $output .= "\t\tthis.map.setCenter( user_location );\n";
                        if ( $this->user_location_backup_lat && $this->user_location_backup_lng ) {
                                $output .= sprintf( "\t}\n\telse {\n\t\tthis.map.setCenter( new google.maps.LatLng(%s,%s) );\n\t}\n\n", $this->user_location_backup_lat, $this->user_location_backup_lng );
                        }
                }
                if ( $this->center_lat && $this->center_lng ) {
                        $output .= sprintf( "\tthis.map.setCenter( new google.maps.LatLng(%s,%s) );\n", $this->center_lat, $this->center_lng );
                }
                
                foreach( $this->event_listeners as $event_listener ) {
                        $output .= sprintf( "\tgoogle.maps.event.addListener(this.map, '%s', %s);\n", $event_listener['event'], $event_listener['function'] );
                }

                if ( $this->onload_function ) {
                        $output .= sprintf( "\tgoogle.maps.event.addListener(this.map, 'idle', %s );\n", $this->onload_function );
                }
                
                if ( $this->streetview && ( ( $this->streetview->position_lat && $this->streetview->position_lng ) || count( $this->streetview->options ) > 0 ) ) {
                
                        foreach( $this->streetview->options as $streetview_option => $streetview_value ) {
                                $streetview_options .= sprintf( "\t\t%s:%s,\n", $streetview_option, $this->phpToJs( $streetview_value ) );
                        }
                        if ( $this->streetview->position->user_location ) {
                                $streetview_options .= "\t\tposition:user_location,\n";
                        }
                        if ( $this->streetview->position->lat && $this->streetview->position->lng ) {
                                $streetview_options .= sprintf( "\t\tposition:new google.maps.LatLng(%s,%s),\n", $this->streetview->position->lat, $this->streetview->position->lng );
                        }
                        
                        $streetview_options .= sprintf( "\t\tpov: {heading:%s,pitch:%s,zoom:%s},",$this->streetview->pov->heading, $this->streetview->pov->pitch, $this->streetview->pov->zoom );
                        
                        $output .= sprintf( "\tthis.streetview = new google.maps.StreetViewPanorama(document.getElementById(\"%s\"), {\n%s\n\t});\n\tthis.map.setStreetView(this.streetview);\n", $this->streetview->container, $streetview_options );
                        if ( $this->streetview->container == $this->map_id && !( $this->streetview->position->lat && $this->streetview->position->lng ) ) {
                                $output .= sprintf( "\tthis.streetview.setVisible( false );\n", $this->map_id );
                        }
                }

                $output .= sprintf( "\n};\n\n}\nfunction initialize_%s() {\n\t%s = new phpgooglemap_%s();\n\t%s.initialize();\n}\n\n", $this->map_id, $this->map_id, $this->map_id, $this->map_id );

                if ( $this->get_user_location ) {
                        $output .= "function get_user_location() {\n";
                        $output .= sprintf( "\tnavigator.geolocation.getCurrentPosition( initialize_with_user_location, user_location_error, {enableHighAccuracy: %s, timeout: %s} );\n", ( $this->geocode_high_accuracy ? 'true' : 'false' ), $this->geocode_timeout);
                        $output .= "}\n";
                        $output .= "function initialize_with_user_location( position ) {\n";
                        $output .= sprintf( "\tgeolocation_status=1;\n\tuser_location = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);\n\tinitialize_%s();\n}\n", $this->map_id );
                        $output .= sprintf( "function user_location_error( error ){\n\tgeolocation_status=0;\n\tgeolocation_error = error.code;\n\tinitialize_%s();%s\n}\n", $this->map_id, ( $this->user_location_fail_function ? $this->user_location_fail_function . "();\n\t" : '' ) );
                        $output .= "if ( navigator.geolocation ) {\n";
                        $output .= "\tgoogle.maps.event.addDomListener(window, \"load\", get_user_location );\n";
                        $output .= "}\nelse {\n";
                        $output .= sprintf( "\tgoogle.maps.event.addDomListener(window, \"load\", initialize_%s );\n}\n\n", $this->map_id, $this->map_id );
                }
                else {
                        $output .= sprintf( "google.maps.event.addDomListener(window, \"load\", initialize_%s );\n\n", $this->map_id, $this->map_id );
                }

                if ( $this->compress_output ) {
                        $output = preg_replace( '~\n|\t~', '', $output );
                }

                $output = preg_replace( '~,(\s*[\}|\)])~', '$1', $output );

                return sprintf("\n<script type=\"text/javascript\">\n\n%s\n\n</script>", $output );
        
        }

        function printMapJS() {
                echo $this->getMapJS();
        }


        function getMap() {
                return sprintf( '<div id="%s" style="%s%s"></div>', $this->map_id, ( $this->width ? 'width: ' . $this->width . ';' : '' ), ( $this->height ? 'height: ' . $this->height . ';' : '' ) );
        }

        function printMap() {
                echo $this->getMap();
        }

        function setLanguage( $language ) {
                $this->language = $language;
        }
        function setRegion( $region ) {
                $this->region = $region;
        }

        function __construct( $map_id = null ) {
                if ( $map_id ) $this->map_id  = $map_id;
        }
        
        function getInfoWindowJsVar() {
                return sprintf( "%s.%s", $this->map_id, 'info_window' );
        }
        function getMarkersJsVar() {
                return sprintf( "%s.%s", $this->map_id, 'markers' );
        }
        function getMarkerJsVar( $marker ) {
                if ( $marker instanceof Marker ) {
                        $id = $marker->id;
                }
                else {
                        $id = $marker;
                }
                return sprintf( "%s.%s[%s]", $this->map_id, 'markers', $id );
        }
        function getStreetViewJsVar() {
                return sprintf( "%s.%s", $this->map_id, 'streetview' );
        }
        function getDirectionsRendererJsVar() {
                return sprintf( "%s.%s", $this->map_id, 'directions.renderer' );
        }
        function getDirectionsServiceJsVar() {
                return sprintf( "%s.%s", $this->map_id, 'directions.service' );
        }
        function enableGeocodeCache() {
                $this->use_geocode_cache = true;
        }
        
        function disableGeocodeCache() {
                $this->use_geocode_cache = false;
        }

        function setWidth( $width ) {
                $this->width = $width;
        }
        function setHeight( $height ) {
                $this->height = $height;
        }
        function __toString() {
                return $this->map_id;
        }

}

class Map extends StdClass {}
class FusionTable extends StdClass {}
class Marker extends StdClass {}
class MarkerIcon extends StdClass {}
class MarkerShape extends StdClass {}
class Directions extends StdClass {}
class StreetView extends StdClass {}