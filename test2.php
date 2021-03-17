<!DOCTYPE html>
<html>
	<head>
		<title>Geolocation</title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<style>
			/* Always set the map height explicitly to define the size of the div
			 * element that contains the map. */
			#map {
				height: 100%;
			}
			/* Optional: Makes the sample page fill the window. */
			html, body {
				height: 100%;
				margin: 0;
				padding: 0;
			}
		</style>
	</head>
	<body>
		<div id="map"></div>
		<script>
			function GPS() {
				// Try HTML5 geolocation.
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(function (position) {
						console.log(position.coords.latitude);
						console.log('found');
						var pos = {
							lat: position.coords.latitude,
							lng: position.coords.longitude
						};
					}, function () {
						console.log('not found');
					});
				} else {
					// Browser doesn't support Geolocation
					console.log('Browser do not support this features');
				}
			}
		</script>
		<script async defer
				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3ZgLOLgrwrYnlZ36NfAAKgN0wy8lULEk&callback=GPS">
		</script>
	</body>
</html>