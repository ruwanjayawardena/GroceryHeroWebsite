<?php include './access_control/session_controler_activation_check.php'; ?>   
<!doctype html>
<html lang="en">
    <head>
		<?php include './includes/head-block.php'; ?>
        <style> 
			.req_info_img{
				width: 100%;
				height: auto;
			}
        </style>
		<style>
			/* Always set the map height explicitly to define the size of the div
			 * element that contains the map. */
			#map {
				height: 100%;
				min-height: 400px;
				width: 100%;
			}			

			#infowindow-content .title {
				font-weight: bold;
			}

			#infowindow-content {
				display: none;
			}

			#map #infowindow-content {
				display: inline;
			}
			.pac-container {
				top: 300px !important;

			}		

			#title {
				color: #fff;
				background-color: #4d90fe;
				font-size: 25px;
				font-weight: 500;
				padding: 6px 12px;
			}
			#target {
				width: 345px;
			}

			@media only screen and (min-width: 0px) and (max-width:576px) {
				.pac-container {
					top: 865px !important;
				}	
			}
			@media only screen and (min-width: 576px) and (max-width:768px) {
				.pac-container {					
					top: 655px !important;
				}	
			}
		</style>
    </head>
    <body>
        <!--navbar-->
		<?php include './includes/frontend-navbar.php'; ?>       

        <!--body content--> 
		<div class="container">
			<div class="row frontsubpages-style1">
				<div class="col-12">
					<div class="row justify-content-center">						
						<div class="col-lg-12 col-12">
							<h3 class="text-uppercase"><i class="fas fa-tasks"></i> <span id="category"></span> Request <button class="btn btn-secondary" onclick="window.history.back(-1)"><i class="fas fa-arrow-circle-left"></i> Go Back </button></h3>							
						</div>
						<div class="col-lg-3 col-12">							
							<div class="row errandRequestInformation">

							</div>
						</div>
						<div class="col-lg-4 col-12">
							<form id="pageform" class="form-profileupdate mb-3" enctype="multipart/form-data">
								<input type="hidden" id="ofr_id">
								<input type="hidden" id="ofr_errand_request" value="<?php
								if (isset($_REQUEST['rq_id']) && !empty($_REQUEST['rq_id'])) {
									echo $_REQUEST['rq_id'];
								}
								?>">
								<div class="form-row">
									<div class="col-lg-6 col-12">
										<div class="form-group">
											<label for="ofr_name">Name</label>
											<input type="text" class="form-control" id="ofr_name" placeholder="Name" required>
										</div>
									</div>
									<div class="col">
										<div class="form-group">
											<label for="ofr_phone">Phone</label>
											<input type="text" class="form-control" id="ofr_phone" placeholder="Phone" required>								
										</div>
									</div>										
								</div>
								<div class="form-row">
									<div class="col">
										<div class="form-group">
											<label for="ofr_location">Share your location</label>
											<input type="text" class="form-control" id="ofr_location_search" placeholder="Location" required>
											<input type="hidden" class="form-control" id="ofr_lat">
											<input type="hidden" class="form-control" id="ofr_lng">
											<input type="hidden" class="form-control" id="ofr_location">
											<!--1-found,0- not found-->
											<input type="hidden" class="form-control" id="ofr_map_status" value="0">
											<h4><span class="badge badge-warning locationNotification text-wrap">Choose your location and share with us.</span></h4>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="col">
										<div class="form-group">
											<label for="ofr_miles_radius">Please enter the miles radius you are willing to run errand</label>
											<input type="number" class="form-control" id="ofr_miles_radius" min="0" required>
										</div>
									</div>
								</div>
<!--								<div class="form-row">									
									<div class="col pictureUploadDiv">
										<div class="form-group">
											<label for="caErrandRequestImage_upload">Upload Grocery Receipt</label>
											<input type="file" class="form-control" name="fileToUpload[]" id="fileToUpload" multiple>
										</div>
									</div>
								</div>	-->
								<div class="form-row">
<!--									<div class="col-lg-6 col-12">
										<div class="form-group">
											<label for="ofr_receipt_amout">Receipt Amount</label>
											<input type="text" class="form-control" id="ofr_receipt_amout" placeholder="Receipt Amount" required>
										</div>
									</div>-->
									<div class="col">
										<div class="form-group">
											<label for="ofr_errand_run_fee">Errand Run Fee</label>
											<input type="text" class="form-control" id="ofr_errand_run_fee" placeholder="Errand Run Fee" required>								
										</div>
									</div>										
								</div>



								<div class="row justify-content-center">
									<div class="col-lg-12 col-12">
										<button class="btn btn-warning" id="btn-save"><i class="far fa-paper-plane"></i> Make an Offer</button>										<button class="btn btn-outline-dark" id="btn_cancel"><i class="fas fa-window-close"></i> Cancel</button>
									</div>
								</div>



							</form>

						</div>
						<div class="col">
							<div id="map"></div>
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
			// This example adds a search box to a map, using the Google Place Autocomplete
			// feature. People can enter geographical searches. The search box will return a
			// pick list containing a mix of places and predicted search terms.

			// This example requires the Places library. Include the libraries=places
			// parameter when you first load the API. For example:
			// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

			function initAutocomplete() {
				var map = new google.maps.Map(document.getElementById('map'), {
					center: {lat: 32.948334, lng: -96.729851},
					zoom: 13,
					mapTypeId: 'roadmap'
				});

				// Create the search box and link it to the UI element.
				var input = document.getElementById('ofr_location_search');
				var searchBox = new google.maps.places.SearchBox(input);
//				map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

				// Bias the SearchBox results towards current map's viewport.
				map.addListener('bounds_changed', function () {
					searchBox.setBounds(map.getBounds());
				});

				var markers = [];
				// Listen for the event fired when the user selects a prediction and retrieve
				$('#ofr_location_search').focusout(function () {
					var ofr_map_status = $('#ofr_map_status').val();
					swal({
						title: "Location Finder !",
						text: "Did you found your location on map?",
						type: "info",
						showCancelButton: true,
						confirmButtonClass: "btn btn-light",
						cancelButtonClass: "btn btn-danger",
						confirmButtonText: "Yes, found",
						cancelButtonText: "No, Not found",
						closeOnConfirm: true,
						closeOnCancel: true

					}, function (event) {
						if (!event) {
							$('#ofr_lat').val('');
							$('#ofr_lng').val('');
							$('#ofr_location').val($('#ofr_location_search').val());
							$('#ofr_map_status').val('0');
							$('.locationNotification').html('').append("Your location not found on google map.<br>So we can't display your location on map.<br>But you given location description will store as a text");
							if ($('.locationNotification').hasClass('badge-success')) {
								$('.locationNotification').removeClass('badge-success');
								$('.locationNotification').addClass('badge-warning');
							}
						}
					});

				})
				// more details for that place.
				searchBox.addListener('places_changed', function () {
					var places = searchBox.getPlaces();
					if (places.length === 0) {
						$('.locationNotification').html('').append("Your location not found on google map.<br>So we can't display your location on map.<br>But you given location description will store as a text");
						if ($('.locationNotification').hasClass('badge-success')) {
							$('.locationNotification').removeClass('badge-success');
							$('.locationNotification').addClass('badge-warning');
						}
						$('#ofr_map_status').val('0');
					} else {
						$('.locationNotification').html('').append("Your location found.We saved your location info");
						$('.locationNotification').removeClass('badge-warning');
						$('.locationNotification').addClass('badge-success');
						$('#ofr_map_status').val('1');

					}
					console.log(places);

					if (places.length == 0) {
						console.log('no such place');
						return;
					}

					// Clear out the old markers.
					markers.forEach(function (marker) {
						marker.setMap(null);
					});
					markers = [];

					// For each place, get the icon, name and location.
					var bounds = new google.maps.LatLngBounds();
					places.forEach(function (place) {
						if (!place.geometry) {
							console.log("Returned place contains no geometry");
							return;
						}
						var icon = {
							url: place.icon,
							size: new google.maps.Size(71, 71),
							origin: new google.maps.Point(0, 0),
							anchor: new google.maps.Point(17, 34),
							scaledSize: new google.maps.Size(25, 25)
						};

						//location Notification

						if (parseInt($('#ofr_map_status').val()) == 1) {
							$('#ofr_lat').val(place.geometry.location.lat());
							$('#ofr_lng').val(place.geometry.location.lng());
							$('#ofr_location').val(place.formatted_address);
						}

						// Create a marker for each place.	
						markers.push(new google.maps.Marker({
							map: map,
							icon: icon,
							title: place.name,
							position: place.geometry.location
						}));

						if (place.geometry.viewport) {
							// Only geocodes have viewport.
							bounds.union(place.geometry.viewport);
						} else {
							bounds.extend(place.geometry.location);
						}

					});
					map.fitBounds(bounds);
				});
			}

		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=CODE&libraries=places&callback=initAutocomplete"
		async defer></script>
        <script>
			function getUserInfoBySessionID() {
				$.post('bkp/controllers/userController.php', {action: 'getUserInfoBySessionID'}, function (e) {
					$.each(e, function (index, qdt) {
						var ofr_name = qdt.usr_first_name + ' ' + qdt.usr_last_name;
						var ofr_phone = qdt.usr_phone;
						$('#ofr_name').val(ofr_name);
						$('#ofr_phone').val(ofr_phone);
					});
				}, "json");
			}

			function errandRequestInformation() {
				var rq_id = $('#ofr_errand_request').val();
				var display = "";
				$.post('bkp/controllers/caErrandRequestController.php', {action: 'getErrandRequestByID', rq_id: rq_id}, function (e) {
					$.each(e, function (index, qdt) {
						$('#category').html('').append(qdt.cat_name);
						display += '<dl class="row">';
						display += '<dt class="col-lg-4 col-12">Category</dt>';
						display += '<dd class="col-lg-8 col-12">' + qdt.cat_name + '</dd>';
						display += '<dt class="col-lg-4 col-12">Request infromation</dt>';
						display += '<dd class="col-lg-8 col-12">';
						if (parseInt(qdt.rq_req_info_give_opt) == 2) {
							//by upload image							
							if (qdt.cat_img !== "#") {
								display += '<a href="asset_imageuploader/caErrandRequest/' + qdt.rq_id + '/' + qdt.rq_img + '" class="btn btn-dark btn-sm" download> Download</a>&nbsp<a target="_blank" href="asset_imageuploader/caErrandRequest/' + qdt.rq_id + '/' + qdt.rq_img + '" class="btn btn-primary btn-sm"> View</a>';
							}
						} else {
							//by call over the phone
							display += 'Information will be give over the phone ';
						}
						display += '</dd>';
						display += '<dt class="col-lg-4 col-12">Store preference</dt>';
						display += '<dd class="col-lg-8 col-12">';
						if (parseInt(qdt.rq_store_preference_opt) == 1) {
							//by upload image
							display += qdt.rq_store_preference_name;
						} else {
							//by call over the phone
							display += 'No';
						}
						display += '</dd>';
						display += '<dt class="col-lg-4 col-12">Location</dt>';
						display += '<dd class="col-lg-8 col-12">' + qdt.rq_location;
						if (parseInt(qdt.rq_map_status) == 1) {
							display += '<a target="_blank" href="request-location.php?rq_id=' + rq_id + '" class="btn btn-sm btn-primary"><i class="fas fa-map-marked"></i> Map</a>';
						}
						display += '</dd>';
						display += '<dt class="col-lg-4 col-12">How notify</dt>';
						display += '<dd class="col-lg-8 col-12">' + qdt.rq_info_notify + '</dd>';
						display += '<dt class="col-lg-4 col-12">How pay for runner</dt>';
						display += '<dd class="col-lg-8 col-12">';
//						1- Cash/ Cheque , 2- PayPal, 3 - CashApp
						if (parseInt(qdt.rq_how_pay_runner) == 1) {
							display += 'Cash/ Cheque';
						} else if (parseInt(qdt.rq_how_pay_runner) == 2) {
							display += 'PayPal';
						} else if (parseInt(qdt.rq_how_pay_runner) == 3) {
							display += 'CashApp';
						}
						display += '</dd>';
						display += '<dt class="col-lg-4 col-12">Contact Info</dt>';
						display += '<dd class="col-lg-8 col-12"><strong>Name:</strong> ' + qdt.rq_name + '<br><strong>Phone:</strong> ' + qdt.rq_phone + '</dd>';
						display += '</dl>';
					});
					$('.errandRequestInformation').html('').append(display);
				}, "json");
			}

			function addErrandOffer() {
//				var is_img_upload = 1;
				var is_img_upload = 0;
				var ofr_errand_request = $('#ofr_errand_request').val();
				var ofr_name = $('#ofr_name').val();
				var ofr_phone = $('#ofr_phone').val();
				var ofr_miles_radius = $('#ofr_miles_radius').val();
				var ofr_location = $('#ofr_location').val();
				var ofr_lat = $('#ofr_lat').val();
				var ofr_lng = $('#ofr_lng').val();
				var ofr_map_status = $('#ofr_map_status').val();
//				var ofr_receipt_amout = $('#ofr_receipt_amout').val();
				var ofr_receipt_amout = 0;
				var ofr_errand_run_fee = $('#ofr_errand_run_fee').val();
				//var ft = $('#fileToUpload')[0].files[0];
//				if (typeof(ft) === 'undefined') {
//					is_img_upload = 0;
//				}			
				var oMyForm = new FormData();
				//oMyForm.append("fileToUpload", ft);
				oMyForm.append("is_img_upload", is_img_upload);
				oMyForm.append("action", "addErrandOffer");
				oMyForm.append("ofr_errand_request", ofr_errand_request);
				oMyForm.append("ofr_name", ofr_name);
				oMyForm.append("ofr_phone", ofr_phone);
				oMyForm.append("ofr_miles_radius", ofr_miles_radius);
				oMyForm.append("ofr_location", ofr_location);
				oMyForm.append("ofr_lat", ofr_lat);
				oMyForm.append("ofr_lng", ofr_lng);
				oMyForm.append("ofr_map_status", ofr_map_status);
				oMyForm.append("ofr_receipt_amout", ofr_receipt_amout);
				oMyForm.append("ofr_errand_run_fee", ofr_errand_run_fee);
				var oReq = new XMLHttpRequest();
				oReq.open("POST", "bkp/controllers/caErrandOfferController.php", true);
				oReq.send(oMyForm);
				oReq.onload = function (oEvent) {
					if (oReq.status == 200) {
						var e = JSON.parse(oReq.responseText);
						if (parseInt(e.msgType) == 1) {
							swal({
								title: e.msg,
								timer: 1700,
								showConfirmButton: false
							});
							setTimeout(function () {
								window.location.href = "my-offer.php?ofr_id=" + e.ofr_id;
							}, 2300);
						} else {
							swal("Alert !", e.msg, "error");
						}
					} else {
						swal("Alert !", "System Error", "warning");
					}
				};
			}



			$(document).ready(function () {
				// Executes when the HTML document is loaded and the DOM is ready
				errandRequestInformation();
				getUserInfoBySessionID();
				const form = $('#pageform');

				$('#btn-save').click(function (event) {
					form.submit(false);
					form.addClass('was-validated');
					if (form[0].checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					} else {
						addErrandOffer();
					}
				});

			});
        </script>
    </body>
</html>
