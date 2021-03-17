<?php include './access_control/session_controler.php'; ?>   
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
    </head>
    <body>
        <!--navbar-->
		<?php include './includes/frontend-navbar.php'; ?>      
		<input type="hidden" id="post_str" value="<?php
		if (isset($_REQUEST['post_str']) && !empty($_REQUEST['post_str'])) {
			echo $_REQUEST['post_str'];
		}
		?>">
        <!--body content-->             

		<div class="container">
			<div class="row frontsubpages-style1">
				<div class="col-12">
					<div class="row justify-content-center">						
						<div class="col-lg-12 col-12">
							<h3 class="text-uppercase"><i class="fas fa-address-card"></i> Upload Receipt for <span id="category"></span> Request <button class="btn btn-secondary" onclick="window.location.href = 'errand-offers-history.php'"><i class="fas fa-address-card"></i> Your Offers </button></h3>							
						</div>
						<div class="col-lg-6 col-12">
							<h3 class="text-uppercase"> <small>Errand Request</small> <span class="requestStatus"></span></h3>
							<span class="errandRequestInformation">

							</span>							
						</div>
						<div class="col-lg-6 col-12">
							<form id="pageform" class="form-profileupdate mb-3" enctype="multipart/form-data">
								<input type="hidden" id="ofr_id">
								<input type="hidden" id="ofr_errand_request">
								<div class="form-row">									
									<div class="col pictureUploadDiv">
										<div class="form-group">
											<label for="caErrandRequestImage_upload">Upload Grocery Receipt</label>
											<input type="file" class="form-control" name="fileToUpload[]" id="fileToUpload" multiple>
										</div>
									</div>
								</div>
								<div class="form-row">	
									<div class="col">
										<div class="form-group">
											<label for="ofr_receipt_amout">Receipt Amount</label>
											<input type="text" class="form-control" id="ofr_receipt_amout" placeholder="Receipt Amount" required>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="col-lg-12 col-12">
										<button class="btn btn-warning" id="btn-save"><i class="far fa-paper-plane"></i> Upload</button>									
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
			function getErrandOfferByID(ofr_id) {
				var display = "";
				$.post('bkp/controllers/caErrandOfferController.php', {action: 'getErrandOfferByID', ofr_id: ofr_id}, function (e) {
					$.each(e, function (index, qdt) {
						//1- not accepted yet,2- accepted offer &  processing, 3- completed
						if (parseInt(qdt.ofr_status) == 1) {
							$('.offerStatus').html('').append('<span class="badge badge-light">Not Accepted By Requester</span>');
						} else if (parseInt(qdt.rq_status) == 2) {
							$('.offerStatus').html('').append('<span class="badge badge-success">Accepted offer & Processing</span>');
						} else if (parseInt(qdt.rq_status) == 3) {
							$('.offerStatus').html('').append('<span class="badge badge-primary">Completed</span>');
						}

						$('#category').html('').append(qdt.cat_name);
						display += '<dl class="row">';
						display += '<dt class="col-lg-4 col-12">Category</dt>';
						display += '<dd class="col-lg-8 col-12">' + qdt.cat_name + '</dd>';
						display += '<dt class="col-lg-4 col-12">Location</dt>';
						display += '<dd class="col-lg-8 col-12">' + qdt.ofr_location;
						if (parseInt(qdt.ofr_map_status) == 1) {
							display += '&nbsp;<a target="_blank" href="offer-location.php?ofr_id=' + qdt.ofr_id + '" class="btn btn-sm btn-primary"><i class="fas fa-map-marked"></i> Map</a>';
						}
						display += '</dd>';
						display += '<dt class="col-lg-4 col-12">Miles radius you are willing to run</dt>';
						display += '<dd class="col-lg-8 col-12">' + qdt.ofr_miles_radius + ' Miles</dd>';
						display += '<dt class="col-lg-4 col-12">Receipt Amount</dt>';
						display += '<dd class="col-lg-8 col-12">' + qdt.ofr_receipt_amout;
						if (qdt.ofr_img !== "#") {
							display += '<a href="asset_imageuploader/caErrandOffer/' + qdt.ofr_id + '/' + qdt.ofr_img + '" class="btn btn-dark btn-sm ml-3" download> Receipt </a>&nbsp<a target="_blank" href="asset_imageuploader/caErrandOffer/' + qdt.ofr_id + '/' + qdt.ofr_img + '" class="btn btn-primary btn-sm"> View </a>';

						}
						display += '</dd>';
						display += '<dt class="col-lg-4 col-12">Errand Run Fee</dt>';
						display += '<dd class="col-lg-8 col-12">' + qdt.ofr_errand_run_fee + '</dd>';
						display += '<dt class="col-lg-4 col-12">Contact Info</dt>';
						display += '<dd class="col-lg-8 col-12"><strong>Name:</strong> ' + qdt.ofr_name + '<br><strong>Phone:</strong> ' + qdt.ofr_phone + '</dd>';
						display += '</dl>';
						errandRequestInformation(qdt.rq_id);
					});
					$('.myOfferInformation').html('').append(display);
				}, "json");
			}

			function errandRequestInformation(rq_id) {
				var display = "";
				$.post('bkp/controllers/caErrandRequestController.php', {action: 'getErrandRequestByID', rq_id: rq_id}, function (e) {
					$.each(e, function (index, qdt) {
						//1- open, 2- processing, 3- completed
						if (parseInt(qdt.rq_status) == 1) {
							$('.requestStatus').html('').append('<span class="badge badge-primary">Open</span>');
						} else if (parseInt(qdt.rq_status) == 2) {
							$('.requestStatus').html('').append('<span class="badge badge-success">Processing</span>');
						} else if (parseInt(qdt.rq_status) == 3) {
							$('.requestStatus').html('').append('<span class="badge badge-light">Completed</span>');
						} else if (parseInt(qdt.rq_status) == 0) {
							$('.requestStatus').html('').append('<span class="badge badge-warning">Saved Draft</span>');
						}
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

			function uploadOfferReceipt() {
				var is_img_upload = 1;
				var ofr_receipt_amout = $('#ofr_receipt_amout').val();
				var ofr_id = $('#ofr_id').val();
				var ft = $('#fileToUpload')[0].files[0];
				if (typeof (ft) === 'undefined') {
					is_img_upload = 0;
				}
				var oMyForm = new FormData();
				oMyForm.append("fileToUpload", ft);
				oMyForm.append("is_img_upload", is_img_upload);
				oMyForm.append("action", "uploadOfferReceipt");
				oMyForm.append("ofr_id", ofr_id);
				oMyForm.append("ofr_receipt_amout", ofr_receipt_amout);
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
				var post_str = $('#post_str').val();
				var ar = post_str.split("-");
				$('#ofr_id').val(ar[0])
				$('#ofr_errand_request').val(ar[1])
				getErrandOfferByID(ar[0]);

				const form = $('#pageform');

				$('#btn-save').click(function (event) {
					form.submit(false);
					form.addClass('was-validated');
					if (form[0].checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					} else {
						uploadOfferReceipt();
					}
				});
			});
        </script>
    </body>
</html>