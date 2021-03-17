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
				background-color: #444;
			}

			p {
				color: #afdc7a;
			}

			.h5, h5 {
				color: #f6ffeb !important;
				font-size: 1.2rem;
			}

			bg-secondary{
				background-color: #555859 !important;
			}
			strong {
				font-weight: bolder;
				color: #bfccb0;
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
		<input type="hidden" id="usr_id" value="<?php
		if (isset($_REQUEST['usr_id']) && !empty($_REQUEST['usr_id'])) {
			echo $_REQUEST['usr_id'];
		} else {
			echo 0;
		}
		?>">
		<div class="container">
			<div class="row frontsubpages-style1">
				<div class="col-12">
					<h3 class="text-uppercase"><i class="fas fa-tasks"></i> <span id="category"></span> Errand Requests pool <span class="badge badge-light" style="font-size: 1rem"> Refresh after <span class="refreshtime">30</span> seconds</span></h3>

					<h5 class="bg-secondary p-2 text-white"> Please check your email (​<span class="usr_email"></span>) and activate your account in order to view nearby requests</h5>									



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
			function checkUserActivation() {
				var usr_id = $('#usr_id').val();
				if (parseInt(usr_id) == 0) {
					window.location.href = 'index.php';
				} else {
					$.post('bkp/controllers/userController.php', {action: 'checkUserActivation', usr_id: usr_id}, function (auth) {
						$('.usr_email').html('').append(auth.usr_email);
						if (parseInt(auth.activeStatus) == 1) {
							console.log('paka');
							$.post('bkp/controllers/userController.php', {action: 'autosignin', usr_id: usr_id}, function (autolog) {
								if (parseInt(autolog) == 1) {
									window.location.href = 'client-errands-requests.php';
								}
							});
						} else if (parseInt(auth.activeStatus) == 99) {
							window.location.href = 'index.php';
						}

					}, "json");
				}
			}



			$(document).ready(function () {
				// Executes when the HTML document is loaded and the DOM is ready
				checkUserActivation();

				setInterval(function () {
					checkUserActivation();
				}, 30000);

			});
        </script>
    </body>
</html>