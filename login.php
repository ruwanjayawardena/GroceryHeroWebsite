<?php include './access_control/login_auth.php'; ?>  
<!doctype html>
<html lang="en">
    <head>		
		<?php include './includes/head-block.php'; ?>
		<link rel="stylesheet" href="assets/css/sign-in.css">
		<style>
			hr{
				border-top: 4px solid #242424 !important;
			}
		</style>
    </head>
    <body>
        <!--nav bar-->
		<?php include './includes/frontend-navbar.php'; ?>       
        <!--body content-->
		<div class="container">							
			<div class="row  justify-content-center wrapper-login-style1">                    
				<div class="col-lg-5 col-12"> 
					<form class="form-signin pt-auto text-center">										
						<h3 class="mb-3 text-uppercase text-center">Please Sign in</h3>
						<div class="form-row">
							<div class="col">
								<div class="form-group">                               
									<input type="text" class="form-control" id="usr_username" placeholder="Username" autocomplete="off" required>
									<div class="valid-feedback">
										<i class="fas fa-lg fa-check-circle"></i> Looks good! 
									</div>
									<div class="invalid-feedback">
										<i class="fas fa-lg fa-exclamation-circle"></i> Please Provide valid username
									</div>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col">
								<div class="form-group">
									<input type="password" class="form-control" id="usr_pass" placeholder="Password" autocomplete="off" required>
									<div class="valid-feedback">
										<i class="fas fa-lg fa-check-circle"></i> Looks good! 
									</div>
									<div class="invalid-feedback">
										<i class="fas fa-lg fa-exclamation-circle"></i> Please Provide valid password
									</div>
								</div>  
							</div>
						</div>
						<div class="form-row">
							<div class="col">
								<div class="mb-2 mt-1">
									<label>
										<button id="btn-forgetpass" class="btn btn-link btn btn-link text-underline badge badge-warning" style="font-size: 0.9rem;font-weight: 400;text-decoration: none"><i class="fas fa-key"></i> Forgot Password</button>
									</label>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col">
								<button class="btn btn-lg btn-success" id="btn_login">Log in</button>
								<button class="btn btn-lg btn-dark" onclick="window.location.href = 'signup.php'">Create Account</button>
								<hr>
								<button class="btn btn-lg btn-primary mt-2" onclick="facebookLogin();"><i class="fab fa-facebook fa-lg"></i> Login with Facebook</button>
							</div>
						</div>
					</form>			

				</div>                    
			</div>
		</div>

        <!--footer-->
		<?php
		include './includes/frontend-footer.php';
		include './includes/end-block.php';
		include './includes/commonJS.php';
		?>  
        <script>
			function forgotPassword() {
				var modelForgotPasswordStr = '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
						'<div class="modal-dialog" role="document">' +
						'<div class="modal-content">' +
						'<div class="modal-header">' +
						'<h5 class="modal-title" id="exampleModalLabel">Forgot Password <small>Have lost your password ? </small></h5>' +
						'<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
						'<span aria-hidden="true">&times;</span>' +
						'</button>' +
						'</div>' +
						'<div class="modal-body">' +
						//here is model body start                        
						'<form id="password-form" novalidate>' +
						'<div class="form-group">' +
						'<label for="usr_email" class="col-form-label">Email</label>' +
						'<input type="text" class="form-control" id="usr_email" placeholder="Enter your email address" required>' +
						'</div>' +
						'</form>' +
						//here is model body end
						'</div>' +
						//start model footer
						'<div class="modal-footer">' +
						'<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>' +
						'<button type="button" class="btn btn-primary" id="btn_recover">Request Change</button>' +
						'</div>' +
						//end modal footer
						'</div>' +
						'</div>' +
						'</div>';

				var modelForgotPassword = $(modelForgotPasswordStr);
				modelForgotPassword.modal('show');


				modelForgotPassword.find('#btn_recover').click(function (event) {
					var usr_email = modelForgotPassword.find('#usr_email').val();
					var postData = {
						usr_email: usr_email,
						action: "autopassowrdreset"
					}
					var form = modelForgotPassword.find('#password-form');
					form.submit(false);
					form.addClass('was-validated');
					if (form[0].checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					} else {
						$.post('bkp/controllers/userController.php', postData, function (e) {
							if (parseInt(e.msgType) == 1) {
								modelForgotPassword.modal('hide');
								swal({
									title: "Alert !",
									text: e.msg,
									type: "success",
									timer: 2500,
									showConfirmButton: false
								});
								setTimeout(function () {
									window.location.href = './index.php';
								}, 3000);
							} else {
								swal("Alert !", e.msg, "warning");
							}
						}, "json");
					}
				});
			}


			function facebookLogin() {
				FB.login(function (response) {
					if (response.status === 'connected') {
						FB.api('/me?fields=email,first_name,last_name,name,id', function (response) {
							var usr_email = response.email;
							var usr_username = response.email;
							var postData = {
								usr_email: usr_email,								
								action: "facebookLogin"
							}
							$.post('bkp/controllers/userController.php', postData, function (e) {
								if (parseInt(e.msgType) == 1) {
									swal({
										title: "Congratulations !",
										text: "Reload page please wait...",
										type: "success",
										timer: 2600,
										showConfirmButton: false
									});
									setTimeout(function () {
										if (parseInt(e.usr_cat_id) == 3) {
											//Request Errand
											window.location.href = 'dashboard-requester.php';
										} else if (parseInt(e.usr_cat_id) == 4) {
											//Run Errand
											window.location.href = 'dashboard-runner.php';
										}
									}, 2800);
								} else {
									swal("Alert !", e.msg, "warning");
								}
							}, "json");

						});
					} else if (response.status === 'not_authorized') {
						swal("Facebook Signup!", 'Sorry! Sign up failed,becasue of your facebook account not connected with us.Please Try again later', "warning");
					} else {
						swal("Facebook Signup!", 'Sorry! Sign up failed,becasue of your facebook account not connected with us.Please Try again later', "warning");
					}

				}, {scope: 'public_profile,email'});
			}


			function login() {
				var usr_username = $('#usr_username').val();
				var usr_pass = $('#usr_pass').val();
				var postData = {
					usr_username: usr_username,
					usr_pass: usr_pass,
					action: 'login'
				}
				$.post('bkp/controllers/userController.php', postData, function (e) {
					if (e === undefined || e.length === 0 || e === null) {
						swal("Alert !", "System Error", "warning");
					} else {
						if (parseInt(e.msgType) == 1) {
							swal({
								title: "Congratulations !",
								text: "Reload page please wait...",
								type: "success",
								timer: 2600,
								showConfirmButton: false
							});
							setTimeout(function () {
								if (parseInt(e.usr_cat_id) == 2) {
									//admin
									window.location.href = 'bkp/dashboard-admin.php';
								} else if (parseInt(e.usr_cat_id) == 3) {
									//user category
									window.location.href = 'dashboard-requester.php';
								} else if (parseInt(e.usr_cat_id) == 4) {
									//user category
									window.location.href = 'dashboard-runner.php';
								} else if (parseInt(e.usr_cat_id) == 1) {
									//super admin
									window.location.href = 'bkp/dashboard.php';
								}
							}, 2800);
						} else {
							swal("Alert !", e.msg, "warning");
						}
					}
				}, "json");
			}


			$(document).ready(function () {

				const form = $('.form-signin');
				form.submit(false);

				$('#btn_login').click(function (event) {
					form.submit(false);
					form.addClass('was-validated');
					if (form[0].checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					} else {
						login();
					}
				});

				$('#btn-forgetpass').click(function () {
					form.submit(false);
					forgotPassword();
				});

				$(document).on('keypress', function (event) {
					if (event.which == 13) {
						event.preventDefault();
						form.submit(false);
						form.addClass('was-validated');
						if (form[0].checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						} else {
							login();
						}
					}
				});
			});


        </script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3ZgLOLgrwrYnlZ36NfAAKgN0wy8lULEk&libraries=places"></script>
    </body>
</html>