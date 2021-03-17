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
		<style> 
			.req_info_img{
				width: 100%;
				height: auto;
			}

			.card-body {
				background-color: #01151c;
			}

			p {
				color: #fff;
			}

			.h5, h5 {
				color: #ccc !important;
			}

			.card-body p, strong {
				font-size: 0.92rem !important;
			}
			strong {
				font-weight: bolder;
				color: #04aae1;
				font-weight: 900;
			}

			.card-text {
				font-size: 0.94rem;
			}

			.card-title {
				font-size: 1.1rem;
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
					<div class="row justify-content-center">						
						<div class="col-lg-12 col-12">
							<h3 class="text-uppercase"><i class="fas fa-tasks"></i> <span id="category"></span> Request <button class="btn btn-secondary" onclick="window.location.href = 'errand-request-history.php'"><i class="fas fa-people-carry fa-lg"></i> Your Requests </button></h3>							
						</div>
						<div class="col-lg-6 col-12">	
							<h3 class="text-uppercase"> <small>Your Request</small> <span class="requestStatus"></span></h3>	
							<span class="errandRequestInformation">

							</span>
						</div>
						<div class="col-lg-6 col-12">
							<h3 class="text-uppercase"> <small>All Submitted Offer By runners</small> <span class="badge badge-light" style="font-size: 1rem"> Refresh after <span class="refreshtime">30</span> seconds</span></h3>	
							<span class="getErrandOfferByRequest">

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
			function errandRequestInformation() {
				var rq_id = $('#rq_id').val();
				var display = "";
				$.post('bkp/controllers/caErrandRequestController.php', {action: 'getErrandRequestByID', rq_id: rq_id}, function (e) {
					$.each(e, function (index, qdt) {
						$('#category').html('').append(qdt.cat_name);
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

			function getErrandOfferByRequest() {
				var rq_id = $('#rq_id').val();
				var display = "";
				$.post('bkp/controllers/caErrandOfferController.php', {action: 'getErrandOfferByRequest', ofr_errand_request: rq_id}, function (e) {
					if (e === undefined || e.length === 0 || e === null) {
						display += '<h4 class="alert alert-danger text-center w-100">Offers Not Received</h4>';

					} else {
						$.each(e, function (index, qdt) {
							display += '<div class="col-12">';
							display += '<div class="card p-1">';
							display += '<div class="card-body">';
							display += '<h5 class="card-title">Runner Fee <span class="badge badge-primary">' + qdt.ofr_errand_run_fee + '</span></span>';
//							display += '<h5 class="card-title">Run Fee <span class="badge badge-success">' + qdt.ofr_errand_run_fee + '</span> | Receipt Amount <span class="badge badge-primary">' + qdt.ofr_receipt_amout + '</span>';
							//1- not accepted yet,2- accepted offer &  processing, 3- completed
							if (parseInt(qdt.ofr_status) == 2) {
								display += ' | <span class="badge badge-success text-uppercase ml-4"> Processing</span>';
							} else if (parseInt(qdt.ofr_status) == 3) {
								display += ' | <span class="badge badge-light text-uppercase ml-4"> Completed</span>';
							}
							display += '</h5>';
							display += '<p class="card-text"><strong>Miles Radius Willing to Run </strong>' + qdt.ofr_miles_radius + ' Miles';						
							display += '<br><strong>Name: </strong>' + qdt.ofr_phone;
							display += '<br><strong>Phone </strong>' + qdt.ofr_name;
							display += '<br><strong>location </strong>' + qdt.ofr_location;							
							display += '</p>';
							display += '<a href="view-runner-offer.php?ofr_id=' + qdt.ofr_id + '&rq_id=' + rq_id + '" class="btn btn-info"><i class="fas fa-address-card"></i> View Runner Offer</a>&nbsp;';
							//0-save draft, 1- open, 2- processing, 3- completed REQUEST SIDE
							if (parseInt(qdt.rq_status) == 1) {
								display += '<button class="btn btn-light btn-accept-offer" value="' + rq_id + '-' + qdt.ofr_id + '"><i class="fas fa-address-card"></i> Accept Offer</button>';
							}
							display += '</div>';
							display += '</div>';
							display += '</div>';
						});
					}
					$('.getErrandOfferByRequest').html('').append(display);

					$('.btn-accept-offer').click(function () {
						var strval = $(this).val();
						var ar = strval.split('-');
						var rq_id = ar[0];
						var ofr_id = ar[1];
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
									getErrandOfferByRequest();
									swal("Accept Offer !", e.msg, "success");
								} else {
									swal("Accept Offer !", e.msg, "warning");
								}
							}, "json");
						});
					});
				}, "json");
			}



			$(document).ready(function () {
				// Executes when the HTML document is loaded and the DOM is ready
				errandRequestInformation();
				getErrandOfferByRequest();

				setInterval(function () {
					getErrandOfferByRequest();
				}, 30000);
			});
        </script>
    </body>
</html>