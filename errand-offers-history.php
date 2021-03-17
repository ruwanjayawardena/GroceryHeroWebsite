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
							<h3 class="text-uppercase"><i class="fas fa-address-card"></i> Your Offers </h3>
							<div class="table-responsive">
								<table id="tblErrandOfferByUser" class="table table-bordered table-hover" style="width:100%">
									<thead class="thead-dark">

										<tr>                                                        
											<th></th>                                    
											<th></th>                                   
											<th>Date</th>
											<th>Category</th>
											<th>Errand Requester</th>
											<th>Your Offer</th>
											<th>Offer Status</th>
										</tr>

									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
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


			function tblErrandOfferByUser(callback) {
				var tbldata = "";
				$.post('bkp/controllers/caErrandOfferController.php', {action: 'tblErrandOfferByUser'}, function (e) {
					if (e === undefined || e.length === 0 || e === null) {
						tbldata += '<tr>';
						tbldata += '<td colspan="7" class="bg-danger text-center text-white font-weight-bold"> -- Errand Requests Offers Not Found -- </td>';
						tbldata += '</tr>';
						$('#tblErrandOfferByUser tbody').html('').append(tbldata);
					} else {
						$.each(e, function (index, qdt) {
							index++;
							tbldata += '<tr>';
							tbldata += '<td>';
							tbldata += '<div class="btn-group btn-group-sm">';
							tbldata += '<button class="btn btn-success btn_view" value="' + qdt.ofr_id + '"><i class="fas fa-eye"></i> View</button>';
							if (parseInt(qdt.ofr_status) == 1) {
								tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.ofr_id + '"><i class="fas fa-trash"></i> </button>';
							}

							if (parseInt(qdt.rq_status) == 2) {
//								if (parseInt(qdt.ofr_deliver_status) == 0) {
//									tbldata += '<button class="btn btn-light btn_mark_completed" value="' + qdt.ofr_id + '"> Mark as Delivered </button>';
//								}
								if (parseInt(qdt.ofr_upload_receipt) == 0) {
									tbldata += '<button class="btn btn-warning btn_uploadreceipt" value="' + qdt.ofr_id + '-' + qdt.rq_id + '"> Upload Receipt </button>';
								}
								if (parseInt(qdt.rq_paid_receipt_status) == 1 && parseInt(qdt.ofr_requester_payment_confirmed) == 0) {
									tbldata += '<button class="btn btn-warning btn_confirmpayment" value="' + qdt.ofr_id + '-' + qdt.rq_id + '"> Confirm Received Payment</button>';
								}
								if (parseInt(qdt.rq_paid_receipt_status) == 1 && parseInt(qdt.ofr_requester_payment_confirmed) == 1 && parseInt(qdt.ofr_deliver_status) == 0) {
										tbldata += '<button class="btn btn-light btn_mark_completed" value="' + qdt.ofr_id + '"> Mark as Delivered </button>';
								}
							}
							tbldata += '</div>';
							tbldata += '</td>';
							tbldata += '<td></td>';
							tbldata += '<td>' + qdt.ofr_date + '</td>';
							tbldata += '<td>' + qdt.cat_name + '</td>';
							tbldata += '<td><strong>Name: </strong>' + qdt.rq_name + '<br><strong>Phone: </strong>' + qdt.rq_phone + '</td>';
							tbldata += '<td><strong>Run Fee: </strong>' + qdt.ofr_errand_run_fee + '<br><strong>Receipt Amount: </strong>' + qdt.ofr_receipt_amout + '</td>';
//							1- not accepted yet,2- accepted offer &  processing, 3- completed
							if (parseInt(qdt.ofr_status) == 1) {
								tbldata += '<td><span class="text-white bg-light p-1">Not Accepted By Requester</span></td>';
							} else if (parseInt(qdt.rq_status) == 2) {
								tbldata += '<td><span class="text-white bg-success p-1">Accepted offer & Processing</span>';
								if (parseInt(qdt.ofr_upload_receipt) == 1) {
									tbldata += '<br><span class="text-white bg-success p-1">Receipt Uploaded</span>';
								}
								if (parseInt(qdt.rq_paid_receipt_status) == 1) {
									tbldata += '<br><span class="text-white bg-success p-1">Requester Marked Your Receipt as Paid</span>';
								}
								if (parseInt(qdt.ofr_deliver_status) == 1) {
									tbldata += '<br><span class="badge badge-light">You marked this request as delivered</span>';
								}
								tbldata += '</td>';
							} else if (parseInt(qdt.rq_status) == 3) {
								tbldata += '<td><span class="text-white bg-primary p-1">Completed</span></td>';
							}
							tbldata += '</tr>';
						});

						if ($.fn.DataTable.isDataTable('#tblErrandOfferByUser')) {
							//re initialize 
							$('#tblErrandOfferByUser').DataTable().destroy();
							$('#tblErrandOfferByUser tbody').empty();
							$('#tblErrandOfferByUser tbody').html('').append(tbldata);
							$('#tblErrandOfferByUser').DataTable({
								responsive: {
									details: {
										type: 'column',
										target: 'tr'
									}
								},
								columnDefs: [
									{className: 'control text-right', orderable: false, targets: 1},
									{orderable: false, targets: 0}
								]
							});
						} else {
							//initilized                    
							$('#tblErrandOfferByUser tbody').html('').append(tbldata);
							$('#tblErrandOfferByUser').DataTable({
								responsive: {
									details: {
										type: 'column',
										target: 'tr'
									}
								},
								columnDefs: [
									{className: 'control text-right', orderable: false, targets: 1},
									{orderable: false, targets: 0}
								]
							});
						}
						$('[data-toggle="tooltip"]').tooltip();
					}

					$('#tblErrandOfferByUser').on('draw.dt', function () {
						$('.btn_view').click(function () {
							var ofr_id = $(this).val();
							window.location.href = 'my-offer.php?ofr_id=' + ofr_id
						});

						$('.btn_confirmpayment').click(function () {
							var ofr_id = $(this).val();
							swal({
								title: "Confirm Received Payment!",
								text: "Did you received requester payment?",
								type: "info",
								showCancelButton: true,
								confirmButtonClass: "btn-info",
								cancelButtonClass: "btn-light",
								confirmButtonText: "Yes, Sure",
								closeOnConfirm: false

							}, function () {
								var postdata = {
									action: "confirmReceivedPayment",
									ofr_id: ofr_id
								}
								$.post('bkp/controllers/caErrandOfferController.php', postdata, function (e) {
									if (parseInt(e.msgType) == 1) {
										tblErrandOfferByUser();
										swal("Confirm Received Payment!", e.msg, "success");
									} else {
										swal("Confirm Received Payment!", e.msg, "warning");
									}
								}, "json");
							});
						});
					});

					$('.btn_view').click(function () {
						var ofr_id = $(this).val();
						window.location.href = 'my-offer.php?ofr_id=' + ofr_id
					});
					$('.btn_uploadreceipt').click(function () {
						var post_str = $(this).val();
						window.location.href = 'upload-offer-receipt.php?post_str=' + post_str
					});

					$('.btn_mark_completed').click(function () {
						var ofr_id = $(this).val();
						swal({
							title: "Mark As Delivered !",
							text: "Did you deliver this request?",
							type: "info",
							showCancelButton: true,
							confirmButtonClass: "btn-info",
							cancelButtonClass: "btn-light",
							confirmButtonText: "Yes, Sure",
							closeOnConfirm: false

						}, function () {
							var postdata = {
								action: "markAsDelivered",
								ofr_id: ofr_id
							}
							$.post('bkp/controllers/caErrandOfferController.php', postdata, function (e) {
								if (parseInt(e.msgType) == 1) {
									tblErrandOfferByUser();
									swal("Mark As Delivered !", e.msg, "success");
								} else {
									swal("Mark As Delivered !", e.msg, "warning");
								}
							}, "json");
						});
					});

					$('.btn_confirmpayment').click(function () {
						var ofr_id = $(this).val();
						swal({
							title: "Confirm Received Payment!",
							text: "Did you received requester payment?",
							type: "info",
							showCancelButton: true,
							confirmButtonClass: "btn-info",
							cancelButtonClass: "btn-light",
							confirmButtonText: "Yes, Sure",
							closeOnConfirm: false

						}, function () {
							var postdata = {
								action: "confirmReceivedPayment",
								ofr_id: ofr_id
							}
							$.post('bkp/controllers/caErrandOfferController.php', postdata, function (e) {
								if (parseInt(e.msgType) == 1) {
									tblErrandOfferByUser();
									swal("Confirm Received Payment!", e.msg, "success");
								} else {
									swal("Confirm Received Payment!", e.msg, "warning");
								}
							}, "json");
						});
					});

					$('.btn_delete').click(function () {
						var ofr_id = $(this).val();
						swal({
							title: "Delete Request !",
							text: "Do you need to delete this request ?",
							type: "info",
							showCancelButton: true,
							confirmButtonClass: "btn-danger",
							cancelButtonClass: "btn-light",
							confirmButtonText: "Yes, Sure",
							closeOnConfirm: false
						}, function () {
							var postdata = {
								action: "removeErrandOffer",
								ofr_id: ofr_id
							}
							$.post('bkp/controllers/caErrandOfferController.php', postdata, function (e) {
								if (parseInt(e.msgType) == 1) {
									tblErrandOfferByUser();
									swal("Mark As Delivered !", e.msg, "success");
								} else {
									swal("Mark As Delivered !", e.msg, "warning");
								}
							}, "json");
						});
					});

					if (callback !== undefined) {
						if (typeof callback === 'function') {
							callback();
						}
					}
				}, "json");
			}


			$(document).ready(function () {
				// Executes when the HTML document is loaded and the DOM is ready
				tblErrandOfferByUser();
			}
			);
        </script>
    </body>
</html>