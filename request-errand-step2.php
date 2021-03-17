<?php include './access_control/session_controler.php'; ?>   
<!doctype html>
<html lang="en">
    <head>
		<?php include './includes/head-block.php'; ?>
        <style>
			iframe{
                height: 250px;
                border: none;
            }
			iframe{
				overflow:hidden;
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
				top: 565px !important;

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
					top: 618px !important;
				}	
			}
			@media only screen and (min-width: 576px) and (max-width:768px) {
				.pac-container {
					top: 576px !important;
				}	
			}
		</style>

    </head>
    <body>
        <!--navbar-->
		<?php include './includes/frontend-navbar.php'; ?>       

        <!--body content-->
		<div class="container">
			<div class="row frontsubpages-style1 justify-content-center">
				<div class="col-12">
					<h3 class="text-uppercase"><i class="fas fa-tasks"></i> Request a New Errand <span class="badge badge-warning">STEP2</span> <br></h3>								
				</div>							
				<div class="col-lg-6 col-12">				
					<form id="pageform" class="form-profileupdate mb-3" enctype="multipart/form-data">
						<input type="hidden" id="rq_id">
						<input type="hidden" id="rq_errand_category">
						<input type="hidden" id="category" value="<?php
						if (isset($_REQUEST['category']) && !empty($_REQUEST['category'])) {
							echo $_REQUEST['category'];
						}
						?>">						
						<div class="form-row">
							<div class="col-lg-6 col-12">
								<div class="form-group">
									<label for="rq_req_info_give_opt">Choose an option</label>
									<div class="form-check">
										<input class="form-check-input rq_req_info_give_opt" type="radio" name="rq_req_info_give_opt" id="give_opt_radio" value="1" checked>
										<label class="form-check-label" for="give_opt_radio">
											<i class="fas fa-phone-volume fa-lg"></i> Give request information over the phone
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input rq_req_info_give_opt" type="radio" name="rq_req_info_give_opt" id="give_opt_radio2" value="2">
										<label class="form-check-label" for="give_opt_radio2">
											<i class="fas fa-cloud-upload-alt fa-lg"></i> Upload Picture of request information
										</label>
									</div>
								</div>
							</div>
							<div class="col pictureUploadDiv" hidden>
								<div class="form-group">
									<label for="caErrandRequestImage_upload">Upload Picture</label>
									<input type="file" class="form-control" name="fileToUpload[]" id="fileToUpload" multiple>
									<!--<iframe  id="caErrandRequestImage_upload" width="100%" height="50px" scrolling="no" ></iframe>-->
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-lg-5 col-12">
								<div class="form-group">
									<label for="rq_store_preference_opt">Do you have any store preference ?</label>
									<div class="form-check">
										<input class="form-check-input rq_store_preference_opt" type="radio" name="rq_store_preference_opt" id="preference_opt1" value="1">
										<label class="form-check-label" for="preference_opt1">
											<i class="fas fa-check-circle fa-lg"></i> Yes
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input rq_store_preference_opt" type="radio" name="rq_store_preference_opt" id="preference_opt2" value="0" checked>
										<label class="form-check-label" for="preference_opt2">
											<i class="fas fa-times-circle fa-lg"></i> No
										</label>
									</div>
								</div>
							</div>
							<div class="col storePreferenceDiv" hidden>
								<div class="form-group">
									<label for="rq_store_preference_name">If Yes, Where ?</label>
									<input type="text" class="form-control" id="rq_store_preference_name" placeholder="Where">									
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-lg-6 col-12">
								<div class="form-group">
									<label for="rq_name">Name</label>
									<input type="text" class="form-control" id="rq_name" placeholder="Name" required>
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="rq_phone">Phone</label>
									<input type="text" class="form-control" id="rq_phone" placeholder="Phone" required>								
								</div>
							</div>										
						</div>
						<div class="form-row">
							<div class="col">
								<div class="form-group">
									<label for="rq_location">Share your location</label>
									<input type="text" class="form-control" id="rq_location_search" placeholder="Location" required>
									<input type="hidden" class="form-control" id="rq_lat">
									<input type="hidden" class="form-control" id="rq_lng">
									<input type="hidden" class="form-control" id="rq_location">
									<!--1-found,0- not found-->
									<input type="hidden" class="form-control" id="rq_map_status" value="0">
									<h4><span class="badge badge-warning locationNotification">Choose your location and share with us.</span></h4>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col">
								<div class="form-group">
									<label for="rq_info_notify">How would like to be notified ?</label>
									<input type="text" class="form-control" id="rq_info_notify" required>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col">
								<div class="form-group">
									<label for="rq_how_pay_runner">How would you pay for runner ?</label>
									<div class="form-check">
										<input class="form-check-input rq_how_pay_runner" type="radio" name="rq_how_pay_runner" id="rq_how_pay_runner1" value="1" checked>
										<label class="form-check-label" for="rq_how_pay_runner1">
											<i class="fas fa-hand-holding-usd fa-lg"></i> Cash/ Cheque
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input rq_how_pay_runner" type="radio" name="rq_how_pay_runner" id="rq_how_pay_runner2" value="2">
										<label class="form-check-label" for="rq_how_pay_runner2">
											<i class="fab fa-cc-paypal fa-lg"></i> PayPal
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input rq_how_pay_runner" type="radio" name="rq_how_pay_runner" id="rq_how_pay_runner3" value="3">
										<label class="form-check-label" for="rq_how_pay_runner3">
											<i class="fas fa-mobile-alt fa-lg"></i> CashApp
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col">
								<div class="form-group">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="rq_accept_toc" checked required>
										<label class="form-check-label" for="rq_accept_toc">
											Please accept out terms and condition
										</label>
									</div>

								</div>
							</div>
						</div>


						<div class="row justify-content-center">
							<div class="col-lg-12 col-12">
								<button class="btn btn-warning" id="btn-save"><i class="fas fa-globe"></i> Post Errand Request</button>
								<button class="btn btn-secondary" id="btn_savedraft"><i class="fas fa-save"></i> Save Draft</button>
								<button class="btn btn-outline-dark" id="btn_cancel"><i class="fas fa-key"></i> Cancel</button>
							</div>
						</div>



					</form>

				</div>
				<div class="col-lg-6 col-12">
					<div id="map"></div>
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
				var input = document.getElementById('rq_location_search');
				var searchBox = new google.maps.places.SearchBox(input);
//				map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

				// Bias the SearchBox results towards current map's viewport.
				map.addListener('bounds_changed', function () {
					searchBox.setBounds(map.getBounds());
				});

				var markers = [];
				// Listen for the event fired when the user selects a prediction and retrieve
				$('#rq_location_search').focusout(function () {
					var rq_map_status = $('#rq_map_status').val();
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
							$('#rq_lat').val('');
							$('#rq_lng').val('');
							$('#rq_location').val($('#rq_location_search').val());
							$('#rq_map_status').val('0');
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
						$('#rq_map_status').val('0');
					} else {
						$('.locationNotification').html('').append("Your location found.We saved your location info");
						$('.locationNotification').removeClass('badge-warning');
						$('.locationNotification').addClass('badge-success');
						$('#rq_map_status').val('1');

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

						if (parseInt($('#rq_map_status').val()) == 1) {
							$('#rq_lat').val(place.geometry.location.lat());
							$('#rq_lng').val(place.geometry.location.lng());
							$('#rq_location').val(place.formatted_address);
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
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3ZgLOLgrwrYnlZ36NfAAKgN0wy8lULEk&libraries=places&callback=initAutocomplete"
		async defer></script>

		<script>

			function getCategoryIDByName() {
				var cat_name = $('#category').val();
				$.post('bkp/controllers/caCategoryController.php', {action: 'getCategoryIDByName', cat_name: cat_name}, function (e) {
					$('#rq_errand_category').val(e);
				}, "json");
			}

			function getUserInfoBySessionID() {
				$.post('bkp/controllers/userController.php', {action: 'getUserInfoBySessionID'}, function (e) {
					$.each(e, function (index, qdt) {
						var rq_name = qdt.usr_first_name + ' ' + qdt.usr_last_name;
						var rq_phone = qdt.usr_phone;
						$('#rq_name').val(rq_name);
						$('#rq_phone').val(rq_phone);
					});
				}, "json");
			}

			function addErrandRequest() {
				var rq_errand_category = $('#rq_errand_category').val();
				var rq_name = $('#rq_name').val();
				var rq_phone = $('#rq_phone').val();
				var rq_req_info_give_opt = $('.rq_req_info_give_opt:checked').val();
				var rq_store_preference_opt = $('.rq_store_preference_opt:checked').val();
				var rq_store_preference_name = $('#rq_store_preference_name').val();
				var rq_info_notify = $('#rq_info_notify').val();
				var rq_location = $('#rq_location').val();
				var rq_lat = $('#rq_lat').val();
				var rq_lng = $('#rq_lng').val();
				var rq_map_status = $('#rq_map_status').val();
				var rq_how_pay_runner = $('.rq_how_pay_runner:checked').val();
				var rq_accept_toc = 0;
				if ($('#rq_accept_toc').is(':checked')) {
					rq_accept_toc = 1;
				}
				var ft = $('#fileToUpload')[0].files[0];
				var oMyForm = new FormData();
				oMyForm.append("fileToUpload", ft);
				oMyForm.append("action", "addErrandRequest");
				oMyForm.append("rq_errand_category", rq_errand_category);
				oMyForm.append("rq_name", rq_name);
				oMyForm.append("rq_phone", rq_phone);
				oMyForm.append("rq_req_info_give_opt", rq_req_info_give_opt);
				oMyForm.append("rq_store_preference_opt", rq_store_preference_opt);
				oMyForm.append("rq_store_preference_name", rq_store_preference_name);
				oMyForm.append("rq_info_notify", rq_info_notify);
				oMyForm.append("rq_location", rq_location);
				oMyForm.append("rq_lat", rq_lat);
				oMyForm.append("rq_lng", rq_lng);
				oMyForm.append("rq_map_status", rq_map_status);
				oMyForm.append("rq_how_pay_runner", rq_how_pay_runner);
				oMyForm.append("rq_accept_toc", rq_accept_toc);
				var oReq = new XMLHttpRequest();
				oReq.open("POST", "bkp/controllers/caErrandRequestController.php", true);
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
								window.location.href = "my-errand-request.php?rq_id=" + e.rq_id;
							}, 2300);
						} else {
							swal("Alert !", e.msg, "error");
						}
					} else {
						swal("Alert !", "System Error", "warning");
					}
				};
			}

			function saveDraftErrandRequest() {
				var rq_errand_category = $('#rq_errand_category').val();
				var rq_name = $('#rq_name').val();
				var rq_phone = $('#rq_phone').val();
				var rq_req_info_give_opt = $('.rq_req_info_give_opt:checked').val();
				var rq_store_preference_opt = $('.rq_store_preference_opt:checked').val();
				var rq_store_preference_name = $('#rq_store_preference_name').val();
				var rq_info_notify = $('#rq_info_notify').val();
				var rq_location = $('#rq_location').val();
				var rq_lat = $('#rq_lat').val();
				var rq_lng = $('#rq_lng').val();
				var rq_map_status = $('#rq_map_status').val();
				var rq_how_pay_runner = $('.rq_how_pay_runner:checked').val();
				var rq_accept_toc = 0;
				if ($('#rq_accept_toc').is(':checked')) {
					rq_accept_toc = 1;
				}
				var ft = $('#fileToUpload')[0].files[0];
				var oMyForm = new FormData();
				oMyForm.append("fileToUpload", ft);
				oMyForm.append("action", "saveDraftErrandRequest");
				oMyForm.append("rq_errand_category", rq_errand_category);
				oMyForm.append("rq_name", rq_name);
				oMyForm.append("rq_phone", rq_phone);
				oMyForm.append("rq_req_info_give_opt", rq_req_info_give_opt);
				oMyForm.append("rq_store_preference_opt", rq_store_preference_opt);
				oMyForm.append("rq_store_preference_name", rq_store_preference_name);
				oMyForm.append("rq_info_notify", rq_info_notify);
				oMyForm.append("rq_location", rq_location);
				oMyForm.append("rq_lat", rq_lat);
				oMyForm.append("rq_lng", rq_lng);
				oMyForm.append("rq_map_status", rq_map_status);
				oMyForm.append("rq_how_pay_runner", rq_how_pay_runner);
				oMyForm.append("rq_accept_toc", rq_accept_toc);
				var oReq = new XMLHttpRequest();
				oReq.open("POST", "bkp/controllers/caErrandRequestController.php", true);
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
								window.location.href = "my-errand-request.php?rq_id=" + e.rq_id;
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
				getCategoryIDByName();
				getUserInfoBySessionID();
				const form = $('#pageform');

				$('.rq_req_info_give_opt').click(function () {
					var rq_req_info_give_opt = $(this).val();
					if (parseInt(rq_req_info_give_opt) == 2) {
						$('.pictureUploadDiv').prop('hidden', false);
					} else {
						$('.pictureUploadDiv').prop('hidden', true);
					}
				});

				$('.rq_store_preference_opt').click(function () {
					var rq_store_preference_opt = $(this).val();
					if (parseInt(rq_store_preference_opt) == 1) {
						$('.storePreferenceDiv').prop('hidden', false);
					} else {
						$('.storePreferenceDiv').prop('hidden', true);
					}
				});


				$('#rq_accept_toc').click(function () {
					if ($(this).is(':checked')) {
						$('#btn-save').prop('hidden', false);
					} else {
						$('#btn-save').prop('hidden', true);
					}

				});

				$('#btn-save').click(function (event) {
					form.submit(false);
					form.addClass('was-validated');
					if (form[0].checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					} else {
						addErrandRequest();
					}
				});

				$('#btn_savedraft').click(function (event) {
					form.submit(false);
					form.addClass('was-validated');
					if (form[0].checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					} else {
						saveDraftErrandRequest();
					}
				});


			});
		</script>
    </body>
</html>