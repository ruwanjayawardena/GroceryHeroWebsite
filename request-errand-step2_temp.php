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
			<div class="row frontsubpages-style1 justify-content-center">
				<div class="col-10">
					<h3 class="text-uppercase"><i class="fas fa-tasks"></i> Request Errand <span class="badge badge-warning">STEP2</span> <br></h3>								
					<form class="form-profileupdate mb-3">
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
									<iframe  id="caErrandRequestImage_upload" width="100%" height="50px" scrolling="no" ></iframe>
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
									<input type="text" class="form-control" id="rq_location" placeholder="Location" required>
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
										<input class="form-check-input" type="checkbox" id="rq_accept_toc" required>
										<label class="form-check-label" for="rq_accept_toc">
											Please accept out terms and condition
										</label>
									</div>

								</div>
							</div>
						</div>


						<div class="row justify-content-center">
							<div class="col-lg-12 col-12">
								<button class="btn btn-warning" id="btn-update"><i class="fas fa-edit"></i> Post Errand Request</button>
								<button class="btn btn-secondary" id="btn_chngpass"><i class="fas fa-key"></i> Save Draft</button>
								<button class="btn btn-outline-dark" id="btn_chngpass"><i class="fas fa-key"></i> Cancel</button>
							</div>
						</div>



					</form>

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
			function errandCategories() {
				var display = "";
				$.post('bkp/controllers/caCategoryController.php', {action: 'allCategory'}, function (e) {
					$.each(e, function (index, qdt) {
						display += '<div class="col-lg-3 col-sm-4 col-6 hvr-grow col-style"><a href="request-errand-step2.php?category=' + qdt.cat_name + '"><div class="card">';
						if (qdt.cat_img === "#") {
							display += '<img src="assets/img/noimage.png" class="card-img-top">';
						} else {
							display += '<img src="asset_imageuploader/caCategory/' + qdt.cat_id + '/' + qdt.cat_img + '" class="card-img-top">';
						}
						display += '<div class="card-body">';
						display += '<h5 class="card-title">' + qdt.cat_name + '</h5>';
						display += '</div>';
						display += '</div></a></div>';
					});

					$('.errandCategories').html('').append(display);
				}, "json");
			}

			function getCategoryIDByName() {
				var cat_name = $('#category').val();
				$.post('bkp/controllers/caCategoryController.php', {action: 'getCategoryIDByName', cat_name: cat_name}, function (e) {
					$('#rq_errand_category').val(e);
				}, "json");
			}






			$(document).ready(function () {
				// Executes when the HTML document is loaded and the DOM is ready
//				errandCategories();
				getCategoryIDByName();

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


			});
		</script>
    </body>
</html>