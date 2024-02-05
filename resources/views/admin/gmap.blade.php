
<div class="google_map_ext">
    <input type="text" id="googlemap_search" class="form-control">
    <div class="map_block" id="maker_gmap"></div><!-- map_block -->
    <div class="map_inputs">
            <div class="form-group">
                <div class="input-group mb5">
                    <input type="text" name="latlng" class="latlng form-control" value="{{@$latlng}}" readonly >
                    <input type="hidden" name="zmap" class="zmap" value="{{@$zmap}}">
                </div>
                <label class="control-label"> Map Title </label>
                <div class="input-group mb5">
                    <div class="input-group-addon"><i class="flag-icon flag-icon-sa"></i></div>
                    <input type="text" name="map_title" value="{{@$title}}" class="form-control">
                </div>
                <div class="input-group mb5">
                    <div class="input-group-addon"><i class="flag-icon flag-icon-us"></i></div>
                    <input type="text" name="map_title_en" value="{{@$title_en}}" class="form-control">
                </div>
            </div>
    </div><!-- map_inputs -->
</div><!-- google_map_ext -->

<script id="gmapscript"  src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAxl_M0pg_sIgLqUPQE0hRA9DZdap-cOKM"></script>
<script>
  var markers = [];
  var latlng = new google.maps.LatLng('{{@$latlng_object[0]}}','{{@$latlng_object[1]}}');
  var mapOptions = {
      center: latlng,
      zoom: (Number('{{@$zmap}}')) ? Number('{{@$zmap}}') : 5,
  }
  var map = new google.maps.Map(document.getElementById("maker_gmap"), mapOptions);
  var searchBox = new google.maps.places.SearchBox(document.getElementById('googlemap_search'));
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    searchBox.set('map', null);
    var places = searchBox.getPlaces();
    var bounds = new google.maps.LatLngBounds();
    var i, place;
    for (i = 0; place = places[i]; i++) {
      (function(place) {
        var marker = new google.maps.Marker({
            position: place.geometry.location,
            map: map,
            zoom: map.getZoom()
        });
        markers.push(marker);
        $('.latlng').val(place.geometry.location);
        $('.zmap').val(map.getZoom());
        marker.bindTo('map', searchBox, 'map');
        google.maps.event.addListener(marker, 'map_changed', function() {
          if (!this.getMap()) {
            this.unbindAll();
          }
        });
        bounds.extend(place.geometry.location);
      }(place));
    }
    map.fitBounds(bounds);
    searchBox.set('map', map);
    map.setZoom(Math.min(map.getZoom(),12));
  });
  google.maps.event.addListener(map, 'zoom_changed', function(event) {
    $('.zmap').val(map.getZoom());
  });
  google.maps.event.addListener(map, 'click', function(event) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
    var marker = new google.maps.Marker({
        position: event.latLng,
        map: map,
        zoom: map.getZoom()
    });
    $('.latlng').val(event.latLng);
    $('.zmap').val(map.getZoom());
    markers.push(marker);
  });
  </script>
