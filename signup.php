<?php include './access_control/session_controler.php'; ?>  
<!doctype html>
<html lang="en">
    <head>		
		<?php include './includes/head-block.php'; ?>
		<link rel="stylesheet" href="assets/css/sign-in.css">	
		<style>
			.pac-container {
				top: 136px !important;

			}	

			@media only screen and (min-width: 0px) and (max-width:576px) {
				.pac-container {
					top: 237px !important;
				}	
			}
			@media only screen and (min-width: 576px) and (max-width:768px) {
				.pac-container {
					top: 190px !important;
				}	
			}
		</style>
    </head>
    <body>
        <!--nav bar-->
		<?php include './includes/frontend-navbar.php'; ?>       
        <!--body content-->
		<div class="container">
			<div class="row justify-content-center wrapper-login-style2">				
				<div class="col-12">
					<h3 class="mb-3 text-uppercase text-center">create new account </h3>
					<form id="signup-form" class="form-signin pt-auto">
						<input type="hidden" class="form-control" id="pro_lat">
						<input type="hidden" class="form-control" id="pro_lng">
						<!--1-found,0- not found-->
						<input type="hidden" class="form-control" id="pro_map_status" value="0">
						<div class="row justify-content-center">
							<div class="col-lg-8 col-sm-12 col-xs-12">
								<div class="form-row">
									<div class="form-group col-lg-6 col-12">   
										<select class="form-control" id="usr_cat_id">
											<option value="3">I need to request an errand</option>
											<option value="4">I need to run an errand</option>
										</select>										
										<div class="valid-feedback">
											<i class="fas fa-lg fa-check-circle"></i> Looks good! 
										</div>
										<div class="invalid-feedback">
											<i class="fas fa-lg fa-exclamation-circle"></i> Please select what are you looking for
										</div>
									</div>									
									<div class="form-group col-lg-6 col-12" class="form-control">   
										<input type="text" class="form-control" id="pro_location" placeholder="Location lookup here" required>									
										<div class="valid-feedback">
											<i class="fas fa-lg fa-check-circle"></i> Looks good! 
										</div>
										<div class="invalid-feedback">
											<i class="fas fa-lg fa-exclamation-circle"></i> Please location lookup here
										</div>
									</div>									
								</div>
								<div class="form-row">
									<div class="form-group col-lg-6 col-12">                               
										<input type="text" class="form-control" id="usr_first_name" placeholder="First Name" autocomplete="off" required>
										<div class="valid-feedback">
											<i class="fas fa-lg fa-check-circle"></i> Looks good! 
										</div>
										<div class="invalid-feedback">
											<i class="fas fa-lg fa-exclamation-circle"></i> Please enter your first name
										</div>
									</div>
									<div class="form-group col-lg-6 col-12">                               
										<input type="text" class="form-control" id="usr_last_name" placeholder="Last Name" autocomplete="off" required>
										<div class="valid-feedback">
											<i class="fas fa-lg fa-check-circle"></i> Looks good! 
										</div>
										<div class="invalid-feedback">
											<i class="fas fa-lg fa-exclamation-circle"></i> Please enter your last name
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-lg-6 col-12">
										<input type="text" class="form-control" id="usr_email" placeholder="Email Address" autocomplete="off" required>
										<div class="valid-feedback">
											<i class="fas fa-lg fa-check-circle"></i> Looks good! 
										</div>
										<div class="invalid-feedback">
											<i class="fas fa-lg fa-exclamation-circle"></i> Please enter valid email address
										</div>
									</div>  
									<div class="form-group col-lg-6 col-12">
										<input type="text" class="form-control" id="usr_phone" placeholder="Phone Number"  autocomplete="off" required>
										<div class="valid-feedback">
											<i class="fas fa-lg fa-check-circle"></i> Looks good! 
										</div>
										<div class="invalid-feedback">
											<i class="fas fa-lg fa-exclamation-circle"></i> Please enter valid phone no
										</div>
									</div>
								</div>
								<div class="form-row">									 
									<div class="form-group col-lg-6 col-12">
										<input type="password" class="form-control" id="usr_pass" placeholder="Password" autocomplete="off" required>
										<div class="valid-feedback">
											<i class="fas fa-lg fa-check-circle"></i> Looks good! 
										</div>
										<div class="invalid-feedback">
											<i class="fas fa-lg fa-exclamation-circle"></i> Please provide valid password
										</div>
									</div>  
									<div class="form-group col-lg-6 col-12">
										<input type="password" class="form-control" id="usr_passConfirm" placeholder="Confirm Password" autocomplete="off" required>
										<div class="valid-feedback">
											<i class="fas fa-lg fa-check-circle"></i> Looks good! 
										</div>
										<div class="invalid-feedback">
											<i class="fas fa-lg fa-exclamation-circle"></i> Please provide valid confirm password
										</div>
									</div>  
								</div>
							</div>  

						</div>
					</form>								
					<div class="row justify-content-center">
						<div class="col-lg-5 col-12 text-center">
							<button class="btn btn-lg btn-dark btn-block" onclick="signup();">Sign up</button>
							<h4 class="p-3"> -- Or -- </h4>
							<button class="btn btn-lg btn-primary" onclick="facebookSignup();"><i class="fab fa-facebook fa-lg"></i> Continue with Facebook</button>

						</div>
					</div>

				</div>

			</div>
		</div>       
        <!--footer-->
		<?php
		include './includes/frontend-footer.php';
		include './includes/end-block.php';
		include './includes/comboboxJS.php';
		include './includes/commonJS.php';
		?> 		
        <script>
			function googlePlaceSearchbox() {
				var input = document.getElementById('pro_location');
				var searchBox = new google.maps.places.SearchBox(input);

				searchBox.addListener('places_changed', function () {
					var places = searchBox.getPlaces();
					places.forEach(function (place) {
						if (places.length !== 0) {
							$('#pro_lat').val(place.geometry.location.lat());
							$('#pro_lng').val(place.geometry.location.lng());
							$('#pro_map_status').val(1);
						}
					});
				});
			}

			function getGPS() {
				// Try HTML5 geolocation.
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(function (position) {
						$('#pro_lat').val(position.coords.latitude)
						$('#pro_lng').val(position.coords.longitude)
						$('#pro_map_status').val(1);
					}, function () {
						$('#pro_map_status').val(0);
					});
				} else {
					// Browser doesn't support Geolocation
					$('#pro_map_status').val(0);
				}
			}

			function signup() {
				const form = $('#signup-form');
				form.submit(false);
				form.addClass('was-validated');
				if (form[0].checkValidity() !== false) {
					var pro_lat = $('#pro_lat').val();
					var pro_lng = $('#pro_lng').val();
					var pro_map_status = $('#pro_map_status').val();
					var pro_location = $('#pro_location').val();
					var usr_cat_id = $('#usr_cat_id').val();
					var usr_email = $('#usr_email').val();
					var usr_phone = $('#usr_phone').val();
					var usr_username = $('#usr_email').val();
					var usr_first_name = $('#usr_first_name').val();
					var usr_last_name = $('#usr_last_name').val();
					var usr_pass = $('#usr_pass').val();
					var usr_passConfirm = $('#usr_passConfirm').val();
					//1- by email, 2 by facebook
					var usr_signup_method = 1;
					var postData = {
						usr_email: usr_email,
						usr_phone: usr_phone,
						usr_username: usr_username,
						usr_first_name: usr_first_name,
						usr_last_name: usr_last_name,
						usr_cat_id: usr_cat_id,
						pro_location: pro_location,
						pro_map_status: pro_map_status,
						pro_lng: pro_lng,
						pro_lat: pro_lat,
						usr_pass: usr_pass,
						usr_signup_method: usr_signup_method,
						action: "signupUsers"
					}
					if (usr_pass === usr_passConfirm) {
						$.post('bkp/controllers/userController.php', postData, function (e) {
							if (parseInt(e.msgType) == 1) {
								swal({
									title: "Signup!",
									text: e.msg,
									type: "success",
									confirmButtonClass: "btn btn-light",
									confirmButtonText: "OK",
									closeOnConfirm: true
								}, function () {
									if (parseInt(e.usr_cat_id) == 3) {
										//Request Errand
										window.location.href = 'dashboard-requester.php';
									} else if (parseInt(e.usr_cat_id) == 4) {
										//Run Errand
										window.location.href = 'client-errands-requests.php';
									}
								});
							} else {
								swal("Signup !", e.msg, "warning");
							}
						}, "json");
					} else {
						swal("Signup !", "The password does not match. Please check your password", "warning");
					}
				}
			}

			function facebookSignup() {
				swal({
					title: "Facebook Signup!",
					text: "Please select what you would like to do ?",
					type: "info",
					showCancelButton: true,
					confirmButtonClass: "btn btn-light",
					cancelButtonClass: "btn btn-primary",
					confirmButtonText: "Request Errand",
					cancelButtonText: "Run Errand",
					closeOnConfirm: true,
					closeOnCancel: true

				}, function (event) {
					if (!event) {
//						Run Errand
						var usr_cat_id = 4
					} else {
//						Request Errand
						var usr_cat_id = 3
					}
					FB.login(function (response) {
						if (response.status === 'connected') {
							FB.api('/me?fields=email,first_name,last_name,name,id', function (response) {
								var pro_lat = $('#pro_lat').val();
								var pro_lng = $('#pro_lng').val();
								var pro_map_status = $('#pro_map_status').val();
								var pro_location = '';
								var usr_email = response.email;
								var usr_phone = '000000000000';
								var usr_username = response.email;
								var usr_first_name = response.first_name;
								var usr_last_name = response.last_name;
								var usr_pass = response.first_name + Math.floor((Math.random() * 1000) + 1);
								//1- by email, 2 by facebook
								var usr_signup_method = 2;
								var postData = {
									usr_email: usr_email,
									usr_phone: usr_phone,
									usr_username: usr_username,
									usr_first_name: usr_first_name,
									usr_last_name: usr_last_name,
									usr_cat_id: usr_cat_id,
									pro_location: pro_location,
									pro_map_status: pro_map_status,
									pro_lng: pro_lng,
									pro_lat: pro_lat,
									usr_pass: usr_pass,
									usr_signup_method: usr_signup_method,
									action: "signupUsers"
								}
								$.post('bkp/controllers/userController.php', postData, function (e) {
									if (parseInt(e.msgType) == 1) {
										swal({
											title: "Facebook Signup!",
											text: e.msg,
											type: "success",
											confirmButtonClass: "btn btn-light",
											confirmButtonText: "OK",
											closeOnConfirm: true
										}, function () {
											if (parseInt(e.usr_cat_id) == 3) {
												//Request Errand
												window.location.href = 'dashboard-requester.php';
											} else if (parseInt(e.usr_cat_id) == 4) {
												//Run Errand
												window.location.href = 'client-errands-requests.php';
											}
										});
									} else {
										swal("Facebook Signup!", e.msg, "warning");
									}
								}, "json");

							});
						} else if (response.status === 'not_authorized') {
							swal("Facebook Signup!", 'Sorry! Sign up failed,becasue of your facebook account not connected with us.Please Try again later', "warning");
						} else {
							swal("Facebook Signup!", 'Sorry! Sign up failed,becasue of your facebook account not connected with us.Please Try again later', "warning");
						}

					}, {scope: 'public_profile,email'});
				});
			}

			$(document).ready(function () {
				$('select').chosen({width: "100%"});

				getGPS();
				googlePlaceSearchbox();
			});


        </script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3ZgLOLgrwrYnlZ36NfAAKgN0wy8lULEk&libraries=places"></script>
    </body>
</html>
