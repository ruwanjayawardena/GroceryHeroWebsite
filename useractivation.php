<?php include './access_control/session_controler.php'; ?>  
<!doctype html>
<html lang="en">
    <head>		
		<?php include './includes/head-block.php'; ?>
		<link rel="stylesheet" href="assets/css/sign-in.css">	
		<style>
			.alert-warning {
				color: #856404;
				background-color: #d5d5d5;
				border-color: #d5d5d5;
			}
		</style>		
    </head>
    <body>
        <!--nav bar-->
		<?php include './includes/frontend-navbar.php'; ?>   
		<input type="hidden" id="usr_id" value="<?php
		if (isset($_REQUEST['usr_id'])) {
			echo $_REQUEST['usr_id'];
		}
		?>"/>
		<input type="hidden" id="usr_confirm_code" value="<?php
		if (isset($_REQUEST['usr_confirm_code'])) {
			echo $_REQUEST['usr_confirm_code'];
		}
		?>"/>
        <!--body content-->
		<div class="container">
			<div class="row frontsubpages-style1 justify-content-center">				
				<div class="col">								
					<h3 class="text-center">Account Activation</h3>
					<h4 class="p-3 text-center"><span class="alert alert-warning text-dark font-weight-bolder"> Please Wait for activate your account...</span></h4>				
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

			function autoActivation() {
				var usr_confirm_code = $('#usr_confirm_code').val();
				var usr_id = $('#usr_id').val();
				$.post('bkp/controllers/userController.php', {action: "activateUserAccount", usr_id: usr_id, usr_confirm_code: usr_confirm_code}, function (e) {
					if (parseInt(e.msgType) == 1) {
						swal({
							title: "Welcome !",
							text: e.msg,
							timer: 2600,
							showConfirmButton: false
						});
						setTimeout(function () {
							if (parseInt(e.usr_cat_id) == 3) {
								//Request Errand
								window.location.href = 'dashboard-requester.php';
							} else if (parseInt(e.usr_cat_id) == 4) {
								//Run Errand
								window.location.href = 'dashboard-runner.php';
							}
						}, 2800);
					} else if (parseInt(e.msgType) == 2) {
						swal({
							title: "Welcome !",
							text: e.msg,
							timer: 2600,
							showConfirmButton: false
						});
						setTimeout(function () {
							window.location.href = 'login.php';
						}, 2800);

					} else if (parseInt(e.msgType) == 3) {
						swal("Alert !", e.msg, "warning");
					}
				}, "json");
			}










			$(document).ready(function () {
				autoActivation();
			});


        </script>
    </body>
</html>

