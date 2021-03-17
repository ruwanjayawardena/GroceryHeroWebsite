<?php include './access_control/dashboard_auth_user3.php'; ?>   
<!doctype html>
<html lang="en">
    <head>
		<?php include './includes/head-block.php'; ?>
        <style>
            .card-title {
                color: white !important;
            }
			.card-title .fa, .fas{
				color: white !important;
			}

			.list-group-item {
				font-size: 0.74rem;
				color: #cfc5f7;
				background-color: #1717173d;				
			}

			.dashboardwidget .card.bg-primary {
				background-color: #341346 !important;
			}
			.dashboardwidget .card {
				border: 1px solid #000000;
				margin-bottom: 2px;
			}

			.dashboardwidget .card-body {
				background-color: #343a40;
				padding: 10px;
				color: #cfd5e8;
			}

			.dashboardwidget .card-header .fas {
				color: white !important;
			}

			.headicon{
				color: black !important;
			}

			.alert-warning {
				color: #856404;
				background-color: #ffdb6a;
				border-color: #c3960914;
			}

			@media only screen and (min-width: 0px) and (max-width:576px) {
				/*common*/				
				.dashboardwidget .card-header .fas {
					color: white !important;
				}
			}
		</style>
	</head>
	<body>
		<!--navbar-->
		<?php include './includes/frontend-navbar.php'; ?>       

		<!--body content-->	
		<div class="container">
			<div class="row justify-content-center frontsubpages-style1">				
				<div class="col-12">					
					<div class="row">
						<div class="col-12">
							<h3 class="text-uppercase"><i class="fas fa-cogs headicon"></i> My Dashboard</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-12 notificationpanal">

						</div>
						<div class="col-12 notificationpanal2">

						</div>
					</div>					
					<div class="row justify-content-center">
						<div class="col-lg-2 col-sm-12 hvr-grow">
							<a href="profile.php" class="text-decoration-none">
								<div class="card text-white bg-secondary">
									<div class="card-header text-center d-none d-sm-block"><i class="fas fa-user-circle fa-4x"></i></div>
									<div class="card-header text-center d-block d-sm-none"><h5 class="card-title"><i class="fas fa-user-circle fa-lg"></i> Profile</h5></div>
									<div class="card-body text-center d-none d-sm-block">
										<h5 class="card-title"><i class="fas fa-user-circle fa-lg"></i> Profile</h5>
									</div>                           
								</div>
							</a>
						</div>	
						<div class="col-lg-2 col-sm-12 hvr-grow">
							<a href="request-errand.php" class="text-decoration-none">
								<div class="card text-white bg-success">
									<div class="card-header text-center d-none d-sm-block"><i class="fas fa-tasks fa-4x"></i></div>
									<div class="card-header text-center d-block d-sm-none"><h5 class="card-title"><i class="fas fa-tasks fa-lg"></i> Profile</h5></div>
									<div class="card-body text-center d-none d-sm-block">
										<h5 class="card-title"><i class="fas fa-tasks fa-lg"></i> Request a New Errand</h5>
									</div>                           
								</div>
							</a>
						</div>	
						<div class="col-lg-2 col-sm-12 hvr-grow">
							<a href="errand-request-history.php" class="text-decoration-none">
								<div class="card text-white bg-secondary">
									<div class="card-header text-center d-none d-sm-block"><i class="fas fa-people-carry fa-4x"></i></div>
									<div class="card-header text-center d-block d-sm-none"><h5 class="card-title"><i class="fas fa-people-carry fa-lg"></i> Profile</h5></div>
									<div class="card-body text-center d-none d-sm-block">
										<h5 class="card-title"><i class="fas fa-people-carry fa-lg"></i> Submitted Requests Status</h5>
									</div>                           
								</div>
							</a>
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
			function recentlyCompletedRequestNotification() {
				var notification = "";
				$.post('bkp/controllers/caErrandRequestController.php', {action: 'tblErrandRequestByUserLastOne'}, function (e) {
					if (e !== undefined || e.length !== 0 || e !== null) {
						$.each(e, function (index, qdt) {
							if (parseInt(qdt.rq_status) == 3) {
								notification += '<div class="alert alert-success alert-dismissible fade show" role="alert">';
								notification += '<strong>' + qdt.cat_name + ' Request</strong> (Published on ' + qdt.rq_date + ') has been recently completed. <button class="btn btn-sm btn-secondary btn_view_runner_offer" value="' + qdt.runner_offer_id + '-' + qdt.rq_id + '"><i class="fas fa-running"></i> Selected Runner Offer</button>';
								notification += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
								notification += '<span aria-hidden="true">&times;</span>';
								notification += '</button>';
								notification += '</div>';
							}
						});
						$('.notificationpanal2').html('').append(notification);
						$('.btn_view').click(function () {
							var rq_id = $(this).val();
							window.location.href = 'my-errand-request.php?rq_id=' + rq_id;
						});
						$('.btn_view_runner_offer').click(function () {
							var rq_str = $(this).val();
							var ar = rq_str.split("-");
							window.location.href = 'view-runner-offer.php?ofr_id=' + ar[0] + '&rq_id=' + ar[1];
						});
					}
				}, "json");
			}
			function notificationPanal() {
				var notification = "";
				$.post('bkp/controllers/caErrandRequestController.php', {action: 'tblErrandRequestByUser'}, function (e) {
					if (e !== undefined || e.length !== 0 || e !== null) {
						$.each(e, function (index, qdt) {
							if (parseInt(qdt.rq_status) == 1) {
								notification += '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
								notification += '<strong>' + qdt.cat_name + ' Request</strong> (Published on ' + qdt.rq_date + ') has been received <span class="badge badge-dark">' + qdt.number_of_offers + '</span> runner offers. <button class="btn btn-sm btn-secondary btn_view" value="' + qdt.rq_id + '"><i class="fas fa-eye"></i> View Offers</button>';
								notification += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
								notification += '<span aria-hidden="true">&times;</span>';
								notification += '</button>';
								notification += '</div>';
							}
							if (parseInt(qdt.rq_status) == 2) {
								if (parseInt(qdt.rq_status) == 2) {
									notification += '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
									notification += '<strong>' + qdt.cat_name + ' Request</strong> (Published on ' + qdt.rq_date + ') has been started to processing. <button class="btn btn-sm btn-secondary btn_view_runner_offer" value="' + qdt.runner_offer_id + '-' + qdt.rq_id + '"><i class="fas fa-running"></i> Selected Runner Offer</button>';
									notification += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
									notification += '<span aria-hidden="true">&times;</span>';
									notification += '</button>';
									notification += '</div>';
								}
								if (qdt.receipt_upload_status !== null && parseInt(qdt.receipt_upload_status) == 1) {
									notification += '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
									notification += '<strong>' + qdt.cat_name + ' Request</strong> (Published on ' + qdt.rq_date + ') has been receipt uploaded. <button class="btn btn-sm btn-secondary btn_view_runner_offer" value="' + qdt.runner_offer_id + '-' + qdt.rq_id + '"><i class="fas fa-running"></i> Selected Runner Offer</button>';
									notification += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
									notification += '<span aria-hidden="true">&times;</span>';
									notification += '</button>';
									notification += '</div>';
								}
								if (parseInt(qdt.rq_paid_receipt_status) == 1 && (qdt.ofr_requester_payment_confirmed !== null && parseInt(qdt.ofr_requester_payment_confirmed) == 1)) {
									notification += '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
									notification += '<strong>' + qdt.cat_name + ' Request</strong> (Published on ' + qdt.rq_date + ') has been confirmed as payment received by runner. <button class="btn btn-sm btn-secondary btn_view_runner_offer" value="' + qdt.runner_offer_id + '-' + qdt.rq_id + '"><i class="fas fa-running"></i> Selected Runner Offer</button>';
									notification += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
									notification += '<span aria-hidden="true">&times;</span>';
									notification += '</button>';
									notification += '</div>';
								}
								if (qdt.ofr_deliver_status !== null && parseInt(qdt.ofr_deliver_status) == 1) {
									notification += '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
									notification += '<strong>' + qdt.cat_name + ' Request</strong> (Published on ' + qdt.rq_date + ') has been marked as delivered by runner. <button class="btn btn-sm btn-secondary btn_view_runner_offer" value="' + qdt.runner_offer_id + '-' + qdt.rq_id + '"><i class="fas fa-running"></i> Selected Runner Offer</button>';
									notification += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
									notification += '<span aria-hidden="true">&times;</span>';
									notification += '</button>';
									notification += '</div>';
								}
							}
						});
						$('.notificationpanal').html('').append(notification)
					}

					$('.btn_view').click(function () {
						var rq_id = $(this).val();
						window.location.href = 'my-errand-request.php?rq_id=' + rq_id;
					});
					$('.btn_view_runner_offer').click(function () {
						var rq_str = $(this).val();
						var ar = rq_str.split("-");
						window.location.href = 'view-runner-offer.php?ofr_id=' + ar[0] + '&rq_id=' + ar[1];
					});
				}, "json");
			}

			$(document).ready(function () {
				notificationPanal();
				recentlyCompletedRequestNotification();
				
				setInterval(function () {
					notificationPanal();
					recentlyCompletedRequestNotification();
				}, 30000);
			});
		</script>
	</body>
</html>