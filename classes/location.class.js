var Location = function() {
    var self = this,
        args = arguments;

    self.init.apply(self, args);
};

Location.prototype = {
    init: function(location, map) {
        var self = this;

        for (f in location) { self[f] = location[f]; }

        self.map = map;
        self.id = self.locationID;

        var ratings = ['bronze', 'silver', 'gold'],
            random = Math.floor(3*Math.random());

        self.rating_class = 'blue';

        // this is the marker point
        self.point = new google.maps.LatLng(parseFloat(self.lat), parseFloat(self.lng));
        locator.bounds.extend(self.point);

        // Create the marker for placement on the map
        self.marker = new google.maps.Marker({
            position: self.point,
            title: self.name,
            icon: new google.maps.MarkerImage('/wp-content/themes/arbesko/img/locator/'+self.rating_class+'SmallMarker.png'),
            shadow: new google.maps.MarkerImage(
                                        '/wp-content/themes/arbesko/img/locator/smallMarkerShadow.png',
                                        new google.maps.Size(52, 18),
                                        new google.maps.Point(0, 0),
                                        new google.maps.Point(19, 14)
                                    )
        });

        google.maps.event.addListener(self.marker, 'click', function() {
            self.target('map');
        });

        google.maps.event.addListener(self.marker, 'mouseover', function() {
            self.sidebarItem().mouseover();
        });

        google.maps.event.addListener(self.marker, 'mouseout', function() {
            self.sidebarItem().mouseout();
        });

        var infocontent = Array(
            '<div class="locationInfo">',
                '<span class="locName br">'+self.name+'</span>',
                '<span class="locAddress br">',
                    self.address+'<br/>'+self.zipcode+' '+self.city+' '+self.country,
                '</span>',
                '<span class="locContact br">'
        );

        if (self.phone) {
            infocontent.push('<span class="item br locPhone">'+self.phone+'</span>');
        }

        if (self.url) {
            infocontent.push('<span class="item br locURL"><a href="http://'+self.url+'">'+self.url+'</a></span>');
        }

        if (self.email) {
            infocontent.push('<span class="item br locEmail"><a href="mailto:'+self.email+'">Email</a></span>');
        }

        // Add in the lat/long
        infocontent.push('</span>');

        infocontent.push('<span class="item br locPosition"><strong>Lat:</strong> '+self.lat+'<br/><strong>Lng:</strong> '+self.lng+'</span>');

        // Create the infowindow for placement on the map, when a marker is clicked
        self.infowindow = new google.maps.InfoWindow({
            content: infocontent.join(""),
            position: self.point,
            pixelOffset: new google.maps.Size(0, -15) // Offset the infowindow by 15px to the top
        });

    },

    // Append the marker to the map
    addToMap: function() {
        var self = this;

        self.marker.setMap(self.map);
    },

    // Creates a sidebar module for the item, connected to the marker, etc..
    sidebarItem: function() {
        var self = this;

        if (self.sidebar) {
            return self.sidebar;
        }

        var li = $('<li/>').attr({ 'class': 'location', 'id': 'location-'+self.id }),
            name = $('<span/>').attr('class', 'locationName').html(self.name).appendTo(li),
            address = $('<span/>').attr('class', 'locationAddress').html(self.address+' <br/> '+self.zipcode+' '+self.city+' '+self.country).appendTo(li);

        li.addClass(self.rating_class);

        li.bind('click', function(event) {
            self.target();
        });

        self.sidebar = li;

        return li;
    },

    // This will "target" the store. Center the map and zoom on it, as well as 
    target: function(type) {
        var self = this;

        if (locator.targeted) {
            locator.targeted.infowindow.close();
        }

        locator.targeted = this;

        if (type != 'map') {
            self.map.panTo(self.point);
            self.map.setZoom(14);
        };

        // Open the infowinfow
        self.infowindow.open(self.map);
    }
};

for (var i=0; i < locations.length; i++) {
    var location = new Location(locations[i], self.map);
    self.locations.push(location);

    // Add the sidebar item
    self.location_ul.append(location.sidebarItem());

    // Add the map!
    location.addToMap();
};