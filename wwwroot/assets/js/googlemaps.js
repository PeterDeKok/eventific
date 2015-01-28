function initializeMaps() {
	var panorama;
	geocoder = new google.maps.Geocoder();
	var netherlands = new google.maps.LatLng(52.3702, 4.895242);
	var mapOptions = {
	  center: netherlands,
	  zoom: 7
	};

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	
  // We get the map's default panorama and set up some defaults.
  // Note that we don't yet set it visible.
  panorama = map.getStreetView();
  panorama.setPosition(netherlands);
  panorama.setPov(/** @type {google.maps.StreetViewPov} */({
    heading: 265,
    pitch: 0
  }));

	panorama.setVisible(true);
	
	var address = mapsAddress;
  geocoder.geocode( { 'address': address}, function(results, status) {
		var location = results[0].geometry.location;
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          position: location
      });
			panorama.setPosition(location);
    } else {
      alert('Searching address was not successful for the following reason: ' + status);
    }
  });
}

function loadScriptMaps() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' +
      'callback=initializeMaps';
  document.body.appendChild(script);
}

window.onload = loadScriptMaps;