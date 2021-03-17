<?php include './access_control/session_controler.php'; ?>   
<!doctype html>
<html lang="en">
    <head>
		<?php include './includes/head-block.php'; ?>
        <style>          
			#map {
				height:800px;
				width:100%;
			}
        </style>
    </head>
    <body>
        <!--navbar-->
		<?php include './includes/frontend-navbar.php'; ?>       

        <!--body content-->             
		<input type="hidden" id="rq_id" value="<?php
		if (isset($_REQUEST['rq_id']) && !empty($_REQUEST['rq_id'])) {
			echo $_REQUEST['rq_id'];
		}
		?>">	
		<div class="container">
			<div class="row frontsubpages-style1">
				<div class="col-12">
					<div class="row">
						<div class="col-lg-12 col-12">
							<h3 class="text-uppercase"><i class="fas fa-map-marked"></i> <span id="category"></span> Request Location</h3>
						</div>
					</div>
					<div class="row">						
						<div class="col-lg-12 col-12" id="map">

						</div>

					</div>
				</div>
			</div>

		</div>

        <!--footer-->
		<?php
		include './includes/frontend-footer.php';
		include './includes/comboboxJS.php';
		include './includes/end-block.php';
		include './includes/commonJS.php';
		?>        
        <script>
			function loadMap() {
				var rq_id = $('#rq_id').val();
				$.post('bkp/controllers/caErrandRequestController.php', {action: 'getErrandRequestByID', rq_id: rq_id}, function (e) {
					$.each(e, function (index, qdt) {
						$('#category').html('').append(qdt.cat_name);
						var lat = parseFloat(qdt.rq_lat);
						var lng = parseFloat(qdt.rq_lng);
						var loc = {lat: lat, lng:lng};
						var map = new google.maps.Map(document.getElementById('map'), {
							zoom: 15,
							center: loc
						});

						var contentString = '<div id="content">' +
								'<h3 id="firstHeading" class="firstHeading">' + qdt.rq_location + '</h3>' +
								'</div>';

						var infowindow = new google.maps.InfoWindow({
							content: contentString
						});

						var marker = new google.maps.Marker({
							position: loc,
							map: map,
							title: qdt.rq_location
						});
						marker.addListener('click', function () {
							infowindow.open(map, marker);
						});

					});
				}, "json");
			}

			$(document).ready(function () {
				// Executes when the HTML document is loaded and the DOM is ready   
				loadMap();
			});
        </script>
		<script async defer
				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3ZgLOLgrwrYnlZ36NfAAKgN0wy8lULEk&callback=loadMap">
		</script>			
    </body>
</html>