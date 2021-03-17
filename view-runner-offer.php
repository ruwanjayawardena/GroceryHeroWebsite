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

        <!--body content-->             
		<input type="hidden" id="ofr_id" value="<?php
		if (isset($_REQUEST['ofr_id']) && !empty($_REQUEST['ofr_id'])) {
			echo $_REQUEST['ofr_id'];
		}
		?>">
		<input type="hidden" id="rq_id" value="<?php
		if (isset($_REQUEST['rq_id']) && !empty($_REQUEST['rq_id'])) {
			echo $_REQUEST['rq_id'];
		}
		?>">
		<div class="container">
			<div class="row frontsubpages-style1">
				<div class="col-12">
					<div class="row justify-content-center">						
						<div class="col-lg-12 col-12">
							<div class="row">
								<div class="col-lg-12 col-12">
									<h3 class="text-uppercase"><i class="fas fa-address-card"></i> <span class="ofr_name"></span> Offer for Your <span id="category"></span> Request <button class="btn btn-secondary" onclick="window.history.back(-1)">Go Back </button>&nbsp;<button class="btn btn-light btn-accept-offer">Accept Offer </button></h3>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<h3 class="text-uppercase"> <small>Your Request</small> <span class="requestStatus"></span></h3>	
							<span class="errandRequestInformation">

							</span>							
						</div>
						<div class="col-lg-6 col-12">
							<h3 class="text-uppercase"><small><span class="ofr_name"></span> Offer </small> <span class="offerstatus"></span> </h3>	
							<span class="myOfferInformation">

							</span>

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
			function getErrandOfferByID() {
				var ofr_id = $('#ofr_id').val();
				var display = "";
				$.post('bkp/controllers/caErrandOfferController.php', {action: 'getErrandOfferByID', ofr_id: ofr_id}, function (e) {
					$.each(e, function (index, qdt) {
						$('.ofr_name').html('').append(qdt.ofr_name);
						//1- not accepted yet,2- accepted offer &  processing, 3- completed
						if (parseInt(qdt.ofr_status) == 1) {
							$('.offerstatus').html('').append('<span class="badge badge-light">Not Accepted</span>');
						} else if (parseInt(qdt.rq_status) == 2) {
							$('.offerstatus').html('').append('<span class="badge badge-success">Accepted offer & Processing</span>');
						} else if (parseInt(qdt.rq_status) == 3) {
							$('.offerstatus').html('').append('<span class="badge badge-primary">Completed</span>');
						}
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
							display += '<a href="asset_imageuploader/caErrandOffer/' + qdt.ofr_id + '/' + qdt.ofr_img + '" class="btn btn-dark btn-sm ml-3" download> Receipt</a>&nbsp<a target="_blank" href="asset_imageuploader/caErrandOffer/' + qdt.ofr_id + '/' + qdt.ofr_img + '" class="btn btn-primary btn-sm"> View</a>';

						}
						display += '</dd>';
						display += '<dt class="col-lg-4 col-12">Errand Run Fee</dt>';
						display += '<dd class="col-lg-8 col-12">' + qdt.ofr_errand_run_fee + '</dd>';
						display += '<dt class="col-lg-4 col-12">Contact Info</dt>';
						display += '<dd class="col-lg-8 col-12"><strong>Name:</strong> ' + qdt.ofr_name + '<br><strong>Phone:</strong> ' + qdt.ofr_phone + '</dd>';
						display += '</dl>';
					});
					$('.myOfferInformation').html('').append(display);
				}, "json");
			}

			function errandRequestInformation() {
				var rq_id = $('#rq_id').val();
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
//						0-save draft, 1- open, 2- processing, 3- completed
						if (parseInt(qdt.rq_status) == 1) {
							$('.btn-accept-offer').prop('hidden', false);
						} else {
							$('.btn-accept-offer').prop('hidden', true);
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

//			function getErrandRequestProcessStatus() {
//				var rq_id = $('#rq_id').val();
//				var ofr_id = $('#ofr_id').val();
//				var postdata = {
//					action: "getErrandRequestProcessStatus",
//					rq_id: rq_id,
//					ofr_id: ofr_id
//				}
//				$.post('bkp/controllers/caErrandRequestController.php', postdata, function (e) {
//					$.each(e, function (index, qdt) {
//						
//					});
//				}, "json");
//			}

			function acceptErrandOffer() {
				var rq_id = $('#rq_id').val();
				var ofr_id = $('#ofr_id').val();
				swal({
					title: "Accept Offer !",
					text: "Do you need to accept this offer ?",
					type: "info",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					cancelButtonClass: "btn-light",
					confirmButtonText: "Yes, Sure",
					closeOnConfirm: false

				}, function () {
					var postdata = {
						action: "acceptErrandOffer",
						rq_id: rq_id,
						ofr_id: ofr_id
					}
					$.post('bkp/controllers/caErrandOfferController.php', postdata, function (e) {
						if (parseInt(e.msgType) == 1) {
							getErrandOfferByID();
							errandRequestInformation();
							swal("Accept Offer !", e.msg, "success");
						} else {
							swal("Accept Offer !", e.msg, "warning");
						}
					}, "json");
				});

			}



			$(document).ready(function () {
				// Executes when the HTML document is loaded and the DOM is ready
				getErrandOfferByID();
				errandRequestInformation();

				$('.btn-accept-offer').click(function () {
					acceptErrandOffer();
				});
			});
        </script>
    </body>
</html>