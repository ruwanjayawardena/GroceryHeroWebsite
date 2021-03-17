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
							<h3 class="text-uppercase"><i class="fas fa-people-carry fa-lg"></i> Submitted Requests Status </h3>
							<div class="table-responsive">
								<table id="tblErrandRequestByUser" class="table table-bordered table-hover" style="width:100%">
									<thead class="thead-dark">

										<tr>                                                        
											<th></th>                                    
											<th></th>                                   
											<th>Date</th>
											<th>Category</th>
											<th>Number of Offers</th>
											<th>Selected Runner</th>
											<th>Status</th>
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


			function tblErrandRequestByUser(callback) {
				var tbldata = "";
				$.post('bkp/controllers/caErrandRequestController.php', {action: 'tblErrandRequestByUser'}, function (e) {
					if (e === undefined || e.length === 0 || e === null) {
						tbldata += '<tr>';
						tbldata += '<td colspan="7" class="bg-danger text-center text-white font-weight-bold"> -- Errand Requests Not Found -- </td>';
						tbldata += '</tr>';
						$('#tblErrandRequestByUser tbody').html('').append(tbldata);
					} else {
						$.each(e, function (index, qdt) {
							index++;
							tbldata += '<tr>';
							tbldata += '<td>';
							tbldata += '<div class="btn-group btn-group-sm">';
							tbldata += '<button class="btn btn-success btn_view" value="' + qdt.rq_id + '"><i class="fas fa-eye"></i> View All Offers</button>';
							//0-safe draft 1- open, 2- processing, 3- completed
							if (parseInt(qdt.runner_selected_status) == 1) {
								tbldata += '<a class="btn btn-light" href="view-runner-offer.php?ofr_id=' + qdt.runner_offer_id + '&rq_id=' + qdt.rq_id + '"><i class="fas fa-running"></i> Runner Offer</a>';
							}
							if (parseInt(qdt.rq_status) == 0) {
								tbldata += '<button class="btn btn-dark btn_publish" value="' + qdt.rq_id + '"><i class="fas fa-globe"></i> Publish </button>';
							}
							if (parseInt(qdt.rq_status) <= 1) {
								tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.rq_id + '"><i class="fas fa-trash-alt"></i> </button>';
							}
							if (parseInt(qdt.rq_status) == 2) {
//								tbldata += '<button class="btn btn-dark btn_markascompleted" value="' + qdt.rq_id + '"><i class="fas fa-calendar-check"></i> Mark As completed</i> </button>';
								if ((qdt.receipt_upload_status !== null && parseInt(qdt.receipt_upload_status) == 1) && parseInt(qdt.rq_paid_receipt_status) == 0) {
									tbldata += '<button class="btn btn-dark btn_markaspaid" value="' + qdt.rq_id + '"><i class="fas fa-money-check-alt"></i> Mark As Paid</i> </button>';
								}
								if ((qdt.ofr_deliver_status !== null && parseInt(qdt.ofr_deliver_status) == 1) && parseInt(qdt.rq_delivery_received_status) == 0) {
									tbldata += '<button class="btn btn-dark btn_markascompleted" value="' + qdt.rq_id + '"><i class="fas fa-box-open"></i> Mark As Received Develiery</i> </button>';
								}

							}

							tbldata += '</div>';
							tbldata += '</td>';
							tbldata += '<td></td>';
							tbldata += '<td>' + qdt.rq_date + '</td>';
							tbldata += '<td>' + qdt.cat_name + '</td>';
							tbldata += '<td class="text-center"><span class="badge badge-info">' + qdt.number_of_offers + '</span></td>';
							if (qdt.selected_runner === null) {
								tbldata += '<td><span class="badge badge-warning">Not Selected</span></td>';
							} else {
								tbldata += '<td>' + qdt.selected_runner + '</td>';
							}
//							1- open, 2- processing, 3- completed
							if (parseInt(qdt.rq_status) == 1) {
								tbldata += '<td><span class="text-white bg-primary p-1">Open</span></td>';
							} else if (parseInt(qdt.rq_status) == 2) {
								tbldata += '<td><span class="text-white bg-success p-1">Processing</span>';
//								if (parseInt(qdt.ofr_deliver_status) == 1) {
//									tbldata += '<br><span class="badge badge-light">'+qdt.selected_runner+' marked this request as delivered</span>';
//								}
								tbldata += '</td>'
							} else if (parseInt(qdt.rq_status) == 3) {
								tbldata += '<td><span class="text-white bg-light p-1">Completed</span></td>';
							} else if (parseInt(qdt.rq_status) == 0) {
								tbldata += '<td><span class="text-white bg-warning p-1">Saved Draft</span></td>';
							}
							tbldata += '</tr>';
						});

						if ($.fn.DataTable.isDataTable('#tblErrandRequestByUser')) {
							//re initialize 
							$('#tblErrandRequestByUser').DataTable().destroy();
							$('#tblErrandRequestByUser tbody').empty();
							$('#tblErrandRequestByUser tbody').html('').append(tbldata);
							$('#tblErrandRequestByUser').DataTable({
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
							$('#tblErrandRequestByUser tbody').html('').append(tbldata);
							$('#tblErrandRequestByUser').DataTable({
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

					$('#tblErrandRequestByUser').on('draw.dt', function () {
						$('.btn_view').click(function () {
							var rq_id = $(this).val();
							window.location.href = 'my-errand-request.php?rq_id=' + rq_id
						});

						$('.btn_publish').click(function () {
							var rq_id = $(this).val();
							swal({
								title: "Publish Request !",
								text: "Do you need to publish this request ?",
								type: "info",
								showCancelButton: true,
								confirmButtonClass: "btn-danger",
								cancelButtonClass: "btn-light",
								confirmButtonText: "Yes, Sure",
								closeOnConfirm: false

							}, function () {
								var postdata = {
									action: "publishErrandRequest",
									rq_id: rq_id
								}
								$.post('bkp/controllers/caErrandRequestController.php', postdata, function (e) {
									if (parseInt(e.msgType) == 1) {
										tblErrandRequestByUser();
										swal("Publish Request !", e.msg, "success");
									} else {
										swal("Publish Request !", e.msg, "warning");
									}
								}, "json");
							});
						});

						$('.btn_markascompleted').click(function () {
							var rq_id = $(this).val();
							swal({
								title: "Confirm Delivery !",
								text: "Did you received your requested items?",
								type: "info",
								showCancelButton: true,
								confirmButtonClass: "btn-info",
								cancelButtonClass: "btn-light",
								confirmButtonText: "Yes, Sure",
								closeOnConfirm: false

							}, function () {
								var postdata = {
									action: "markCompletedErrandRequest",
									rq_id: rq_id
								}
								$.post('bkp/controllers/caErrandRequestController.php', postdata, function (e) {
									if (parseInt(e.msgType) == 1) {
										tblErrandRequestByUser();
										swal("Confirm Delivery !", e.msg, "success");
									} else {
										swal("Confirm Delivery !", e.msg, "warning");
									}
								}, "json");
							});
						});

						$('.btn_markaspaid').click(function () {
							var rq_id = $(this).val();
							swal({
								title: "Mark As Paid !",
								text: "Do you need to mark this request as paid ?",
								type: "info",
								showCancelButton: true,
								confirmButtonClass: "btn-info",
								cancelButtonClass: "btn-light",
								confirmButtonText: "Yes, Sure",
								closeOnConfirm: false

							}, function () {
								var postdata = {
									action: "markRequestAsPaid",
									rq_id: rq_id
								}
								$.post('bkp/controllers/caErrandRequestController.php', postdata, function (e) {
									if (parseInt(e.msgType) == 1) {
										tblErrandRequestByUser();
										swal("Mark As Paid !", e.msg, "success");
									} else {
										swal("Mark As Paid !", e.msg, "warning");
									}
								}, "json");
							});
						});

						$('.btn_delete').click(function () {
							var rq_id = $(this).val();
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
									action: "removeErrandRequest",
									rq_id: rq_id
								}
								$.post('bkp/controllers/caErrandRequestController.php', postdata, function (e) {
									if (parseInt(e.msgType) == 1) {
										tblErrandRequestByUser();
										swal("Delete Request !", e.msg, "success");
									} else {
										swal("Delete Request !", e.msg, "warning");
									}
								}, "json");
							});
						});
					});



					$('.btn_view').click(function () {
						var rq_id = $(this).val();
						window.location.href = 'my-errand-request.php?rq_id=' + rq_id
					});

					$('.btn_publish').click(function () {
						var rq_id = $(this).val();
						swal({
							title: "Publish Request !",
							text: "Do you need to publish this request ?",
							type: "info",
							showCancelButton: true,
							confirmButtonClass: "btn-danger",
							cancelButtonClass: "btn-light",
							confirmButtonText: "Yes, Sure",
							closeOnConfirm: false

						}, function () {
							var postdata = {
								action: "publishErrandRequest",
								rq_id: rq_id
							}
							$.post('bkp/controllers/caErrandRequestController.php', postdata, function (e) {
								if (parseInt(e.msgType) == 1) {
									tblErrandRequestByUser();
									swal("Publish Request !", e.msg, "success");
								} else {
									swal("Publish Request !", e.msg, "warning");
								}
							}, "json");
						});
					});

					$('.btn_markascompleted').click(function () {
						var rq_id = $(this).val();
						swal({
							title: "Confirm Delivery !",
							text: "Did you received your requested items?",
							type: "info",
							showCancelButton: true,
							confirmButtonClass: "btn-info",
							cancelButtonClass: "btn-light",
							confirmButtonText: "Yes, Sure",
							closeOnConfirm: false

						}, function () {
							var postdata = {
								action: "markCompletedErrandRequest",
								rq_id: rq_id
							}
							$.post('bkp/controllers/caErrandRequestController.php', postdata, function (e) {
								if (parseInt(e.msgType) == 1) {
									tblErrandRequestByUser();
									swal("Confirm Delivery !", e.msg, "success");
								} else {
									swal("Confirm Delivery !", e.msg, "warning");
								}
							}, "json");
						});
					});
					
					$('.btn_markaspaid').click(function () {
						var rq_id = $(this).val();
						swal({
							title: "Mark As Paid !",
							text: "Do you need to mark this request as paid ?",
							type: "info",
							showCancelButton: true,
							confirmButtonClass: "btn-info",
							cancelButtonClass: "btn-light",
							confirmButtonText: "Yes, Sure",
							closeOnConfirm: false

						}, function () {
							var postdata = {
								action: "markRequestAsPaid",
								rq_id: rq_id
							}
							$.post('bkp/controllers/caErrandRequestController.php', postdata, function (e) {
								if (parseInt(e.msgType) == 1) {
									tblErrandRequestByUser();
									swal("Mark As Paid !", e.msg, "success");
								} else {
									swal("Mark As Paid !", e.msg, "warning");
								}
							}, "json");
						});
					});

					$('.btn_delete').click(function () {
						var rq_id = $(this).val();
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
								action: "removeErrandRequest",
								rq_id: rq_id
							}
							$.post('bkp/controllers/caErrandRequestController.php', postdata, function (e) {
								if (parseInt(e.msgType) == 1) {
									tblErrandRequestByUser();
									swal("Delete Request !", e.msg, "success");
								} else {
									swal("Delete Request !", e.msg, "warning");
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
				tblErrandRequestByUser();
			}
			);
        </script>
    </body>
</html>