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
    </head>
    <body>
        <!--navbar-->
		<?php include './includes/frontend-navbar.php'; ?>       

        <!--body content-->             

		<div class="container">
			<div class="row frontsubpages-style1">
				<div class="col-12">
					<div class="row">
						<div class="col-lg-12 col-12">
							<h3 class="text-uppercase"><i class="fas fa-user-circle"></i> Profile</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-12">
							<div class="col-12">
								<h4 class="font-weight-bolder text-center">Profile Picture</h4>
								<iframe  id="iframe_profileimage" width="100%" height="50px" scrolling="no" ></iframe>
							</div>
						</div>
						<div class="col-lg-8 col-12">
							<form class="form-profileupdate pt-auto mb-3">
								<input type="hidden" id="usr_id">
								<div class="form-row">                                
									<div class="col-lg-6 col-12">
										<div class="form-group">
											<label for="usr_name">First Name/ Screen Name</label>
											<input type="text" class="form-control" id="usr_first_name" placeholder="First Name/ Screen Name" required>
											<div class="valid-feedback">
												<i class="fas fa-lg fa-check-circle"></i> Looks good! 
											</div>
											<div class="invalid-feedback">
												<i class="fas fa-lg fa-exclamation-circle"></i> Please Provide valid profile name
											</div>
										</div>
									</div>								
									<div class="col-lg-6 col-12">
										<div class="form-group">
											<label for="usr_name">Last Name</label>
											<input type="text" class="form-control" id="usr_last_name" placeholder="Last Name" required>
											<div class="valid-feedback">
												<i class="fas fa-lg fa-check-circle"></i> Looks good! 
											</div>
											<div class="invalid-feedback">
												<i class="fas fa-lg fa-exclamation-circle"></i> Please Provide valid profile name
											</div>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="col-lg-6 col-12">
										<div class="form-group">
											<label for="usr_phone">Phone No</label>
											<input type="tel" class="form-control" id="usr_phone" placeholder="Phone No" required>
											<div class="valid-feedback">
												<i class="fas fa-lg fa-check-circle"></i> Looks good! 
											</div>
											<div class="invalid-feedback">
												<i class="fas fa-lg fa-exclamation-circle"></i> Please Provide valid phone no
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-12">
										<div class="form-group">
											<label for="usr_email">Email</label>
											<input type="email" class="form-control" id="usr_email" placeholder="Email" required>
											<div class="valid-feedback">
												<i class="fas fa-lg fa-check-circle"></i> Looks good! 
											</div>
											<div class="invalid-feedback">
												<i class="fas fa-lg fa-exclamation-circle"></i> Please Provide valid email
											</div>
										</div>
									</div>
								</div>							

								<div class="row justify-content-center">
									<div class="col-lg-12 col-12">
										<button class="btn btn-outline-warning" id="btn-update"><i class="fas fa-edit"></i> Update</button>
										<button class="btn btn-light" id="btn_chngpass"><i class="fas fa-key"></i> Change Password</button>
									</div>
								</div>
							</form>
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
			function userProfileInfo() {
				$.post('bkp/controllers/userController.php', {action: 'getUserProfileInfo'}, function (e) {
					$.each(e, function (index, qdt) {
						$('#usr_email').val(qdt.usr_email);
						$('#usr_first_name').val(qdt.usr_first_name);
						$('#usr_last_name').val(qdt.usr_last_name);
						$('#usr_phone').val(qdt.usr_phone);
						$('#usr_id').val(qdt.usr_id);
						if (parseInt(qdt.df_user.usr_verified_media) == 1) {
							//1 - Email, 2 - Mobile, 3 - Facebook, 4 - By System
							$('#usr_email').attr('readonly', true);
						} else if (parseInt(qdt.df_user.usr_verified_media) == 2) {
							$('#usr_phone').attr('readonly', true);
						} else if (parseInt(qdt.df_user.usr_verified_media) == 3) {

						} else if (parseInt(qdt.df_user.usr_verified_media) == 4) {

						}
					});
				}, "json");
			}

			function profileUpdate() {
				var usr_id = $('#usr_id').val();
				var usr_first_name = $('#usr_first_name').val();
				var usr_last_name = $('#usr_last_name').val();
				var usr_phone = $('#usr_phone').val();
				var usr_email = $('#usr_email').val();
				var postdata = {
					action: "profileUpdateFront",
					usr_id: usr_id,
					usr_first_name: usr_first_name,
					usr_last_name: usr_last_name,
					usr_phone: usr_phone,
					usr_email: usr_email,
				}
				$.post('bkp/controllers/userController.php', postdata, function (e) {
					if (parseInt(e.msgType) == 1) {
						swal("Good Job !", e.msg, "success");
						userProfileInfo();
					} else {
						swal("Alert !", e.msg, "warning");
					}
				}, "json");
			}

			$(document).ready(function () {
				// Executes when the HTML document is loaded and the DOM is ready   
				$(".datepicker").datetimepicker({
					viewMode: 'days',
					format: 'YYYY-MM-DD'
				});



				$("#iframe_profileimage").attr("src", "user_profileimage.php");
				userProfileInfo();


				const form = $('.form-profileupdate');


				$('#btn-update').click(function (event) {
					form.submit(false);
					form.addClass('was-validated');
					if (form[0].checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					} else {
						profileUpdate();
						form.removeClass('was-validated');
					}
				});


				$('#btn_chngpass').click(function () {
					form.submit(false);
					var confirmModalString = '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
							'<div class="modal-dialog" role="document">' +
							'<div class="modal-content">' +
							'<div class="modal-header">' +
							'<h5 class="modal-title" id="exampleModalLabel">Change Password</h5>' +
							'<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
							'<span aria-hidden="true">&times;</span>' +
							'</button>' +
							'</div>' +
							'<div class="modal-body">' +
							//here is model body start
							'<form id="password-form" novalidate>' +
							'<div class="form-group">' +
							'<label for="recipient-name" class="col-form-label">New password</label>' +
							'<input type="text" class="form-control" id="usr_pass_recover"  placeholder="New password" required>' +
							'</div>' +
							'<div class="form-group">' +
							'<label for="recipient-name" class="col-form-label">Confirm password</label>' +
							'<input type="text" class="form-control" id="usr_pass_confirm_recovery"  placeholder="New password" required>' +
							'</div>' +
							'</form>' +
							//here is model body end
							'</div>' +
							//start model footer
							'<div class="modal-footer">' +
							'<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>' +
							'<button type="button" class="btn btn-primary" id="btn_updatepass">Update</button>' +
							'</div>' +
							//end modal footer
							'</div>' +
							'</div>' +
							'</div>';

					var confirmModal = $(confirmModalString);
					confirmModal.modal('show');

					confirmModal.find('#btn_updatepass').click(function (event) {
						var form = confirmModal.find('#password-form');
						form.addClass('was-validated');
						if (form[0].checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						} else {
							var usr_pass = confirmModal.find('#usr_pass_recover').val();
							var usr_pass_confirm = confirmModal.find('#usr_pass_confirm_recovery').val();
							var postData = {
								usr_pass: usr_pass,
								action: "profilePasswordChange"
							}
							if (usr_pass_confirm === usr_pass) {
								$.post("bkp/controllers/userController.php", postData, function (e) {
									if (e !== undefined || e.lenght !== 0 || e !== null) {
										if (parseInt(e.msgType) == 1) {
											swal("Good job!", e.msg, "success");
											confirmModal.modal('hide');
										} else {
											swal("Error !", e.msg, "error");
										}
									} else {
										swal("Alert !", e.msg, "warning");
									}
								}, "json");
							} else {
								swal("Password Not Matched", "Please Enter Correct Password", "warning");
							}
						}
					});

				});
			});
        </script>
    </body>
</html>