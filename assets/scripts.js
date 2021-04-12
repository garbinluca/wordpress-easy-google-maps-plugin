function easyGoogleMapsInitCallback() {

	var maps = document.getElementsByClassName('easy-google-maps');
	for(let index = 0; index < maps.length; index++) {

		var mapDiv = maps[index];
		var latitude = parseFloat(mapDiv.dataset.latitude),
			longitude = parseFloat(mapDiv.dataset.longitude),
			zoom = parseInt(mapDiv.dataset.zoom || 8),
			styles = mapDiv.dataset.styles ? JSON.parse(mapDiv.dataset.styles) : [],
			pin = mapDiv.dataset.pin ? JSON.parse(mapDiv.dataset.pin) : null;

		var map = new google.maps.Map(mapDiv, {
			center: {lat: latitude, lng: longitude},
			zoom: zoom,
			styles: styles
		});

		var marker = new google.maps.Marker({
			position: {
				lat: latitude,
				lng: longitude
			},
			map
		});

		if (pin) {

			var markerImage = new google.maps.MarkerImage(
				pin.src,
				null,
				null,
				null,
				new google.maps.Size(pin.width, pin.height)
			);

			marker.setIcon(markerImage);

		}

	}

}