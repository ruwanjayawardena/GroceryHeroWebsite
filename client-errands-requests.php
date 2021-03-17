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
						<div class="col-lg-8 col-12">
							<h3 class="text-uppercase"><i class="fas fa-tasks"></i> <span id="category"></span> Requests Near me <span class="badge badge-light" style="font-size: 1rem"> Refresh after <span class="refreshtime">30</span> seconds</span></h3>
							<h1 id="msg"></h1>
							<div class="row AllErrandRequest">

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
			function AllErrandRequest() {
				var display = "";
				$.post('bkp/controllers/userController.php', {action: 'getUserInfoBySessionID'}, function (loggeduser) {
					$.post('bkp/controllers/caErrandRequestController.php', {action: 'clientErrandRequest'}, function (e) {
						if (e === undefined || e.length === 0 || e === null) {
							display += '<h4 class="alert alert-danger text-white w-100 text-center"> New Requests Not Availabel</h4>';
						} else {
							$.each(loggeduser, function (index_lguser, qdt_lguser) {
								$.each(e, function (index, qdt) {
									//getdistance request between user
									var runner = new google.maps.LatLng(qdt_lguser.pro_lat, qdt_lguser.pro_lng);
									var requester = new google.maps.LatLng(qdt.pro_lat, qdt.pro_lng);
									var distance_meter = google.maps.geometry.spherical.computeDistanceBetween(runner, requester);
									var distance_miles = parseFloat(distance_meter) * parseFloat(0.000621371192);
									console.log(distance_miles);
									if (parseFloat(distance_miles) <= parseFloat(20)) {
										display += '<div class="col-12">';
										display += '<div class="card p-1">';
										display += '<div class="card-body">';
										display += '<h5 class="card-title">' + qdt.cat_name + ' Request</h5>';
										display += '<p class="card-text"><strong>Pay by </strong>';
										if (parseInt(qdt.rq_how_pay_runner) == 1) {
											display += 'Cash/ Cheque';
										} else if (parseInt(qdt.rq_how_pay_runner) == 2) {
											display += 'PayPal';
										} else if (parseInt(qdt.rq_how_pay_runner) == 3) {
											display += 'CashApp';
										}
										display += '<br><strong>Location: </strong>' + qdt.rq_location;
										display += '<br><strong>Request by </strong>' + qdt.rq_name;
										display += '</p>';
										display += '<a href="view-client-request.php?rq_id=' + qdt.rq_id + '" class="btn btn-light"><i class="fas fa-address-card"></i> Make an Offer</a>';
										display += '</div>';
										display += '</div>';
										display += '</div>';
									}
								});
							});
						}
						if (display === "") {
							$('.AllErrandRequest').html('').append('<h4 class="alert alert-danger text-white w-100 text-center"> No Errand Requests found withing 20Miles around you.</h4>');
						} else {
							$('.AllErrandRequest').html('').append(display);
						}
					}, "json");
				}, "json");
			}


			function getGoogleMapDistanceTEST() {
				// Locations of landmarks
				const kurunegala = new google.maps.LatLng(7.472981, 80.354729);
				const anuradhapura = new google.maps.LatLng(8.312190, 80.418716);
				var x = google.maps.geometry.spherical.computeDistanceBetween(kurunegala, anuradhapura);
				var miles = parseFloat(x) * parseFloat(0.000621371192);
				var km = parseFloat(x) * parseFloat(0.001);
				console.log("Meters: " + x);
				console.log("kilometers: " + km);
				console.log("Miles: " + miles);
			}



			$(document).ready(function () {
				// Executes when the HTML document is loaded and the DOM is ready
				AllErrandRequest();

				setInterval(function () {
					AllErrandRequest();
				}, 30000);

			});
        </script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3ZgLOLgrwrYnlZ36NfAAKgN0wy8lULEk&libraries=geometry,places"></script>
    </body>
</html>