<input id="input" class="controls pac-input" type="text" placeholder="Localização" required>

<div id="mapDiv" style="height: 600px;">
</div>

<script src="https://cdn.klokantech.com/maptilerlayer/v1/index.js"></script>


<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0sMN4oZv0arXqQMn53OqpN5O2s_WjqzM&libraries=places&callback=ShowGoogleMap"></script>

<script>
  var map;
  $(window).load(function () {
    BindResizeEvent();

  });
  function BindResizeEvent() {
    $("a[href='#tab2']").on('shown.bs.tab', function () {

      lastCenter=map.getCenter();
      google.maps.event.trigger(map, 'resize');
      map.setCenter(lastCenter);

    });

  }
  function ShowGoogleMap() {


    map = new google.maps.Map(document.getElementById('mapDiv'), {
      center: {lat: -33.8688, lng: 151.2195},
      zoom: 11
    });
    var input = /** @type {!HTMLInputElement} */(
      document.getElementById('input'));

    var types = document.getElementById('type-selector');

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

    var geoloccontrol = new klokantech.GeolocationControl(map);

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();



    var marker = new google.maps.Marker({
      map: map,
      anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {
      infowindow.close();
      marker.setVisible(false);
      var place = autocomplete.getPlace();
      if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(15);  // Why 17? Because it looks good.
          }
          marker.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
          }));
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
            (place.address_components[0] && place.address_components[0].short_name || ''),
            (place.address_components[1] && place.address_components[1].short_name || ''),
            (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
          infowindow.open(map, marker);
        });


    var infoWindow = new google.maps.InfoWindow({map: map});

    // Try HTML5 geolocation.
    if (navigator.geolocation) {

      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };

        infoWindow.setPosition(pos);
        infoWindow.setContent('Localização encontrada.');
        map.setCenter(pos);
      }, function() {
        handleLocationError(true, infoWindow, map.getCenter());
      });
    } else {
          // Browser doesn't support Geolocation
          
          handleLocationError(false, infoWindow, map.getCenter());
        }







        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
          infoWindow.setPosition(pos);
          infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        }
        
      }
    </script>