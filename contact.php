<?php include './access_control/session_controler.php'; ?>   
<!doctype html>
<html lang="en">
    <head>
		<?php include './includes/head-block.php'; ?>
    </head>
    <body>
        <!--navbar-->
		<?php include './includes/frontend-navbar.php'; ?>       

        <!--body content-->               

		<div class="container">
			<div class="row frontsubpages-style1">
				<div class="col-lg-12 col-sm-12">
					<h3 class="text-uppercase">Contact Us</h3>                        
				</div>
				<div class="col-lg-6 col-sm-12">
					<form id="emailform" novalidate>
						<input type="hidden" class="form-control" id="sys_email">
						<div class="form-group">
							<label for="em_name">Name</label>
							<input type="text" class="form-control" id="em_name" placeholder="Your name" autocomplete="off" required>
							<div class="valid-feedback">
								<i class="fas fa-lg fa-check-circle"></i> Looks good! 
							</div>
							<div class="invalid-feedback">
								<i class="fas fa-lg fa-exclamation-circle"></i> Please enter your name
							</div>
						</div>
						<div class="form-group">
							<label for="em_email">Email</label>
							<input type="email" class="form-control" id="em_email" placeholder="Your email" autocomplete="off" required>
							<div class="valid-feedback">
								<i class="fas fa-lg fa-check-circle"></i> Looks good! 
							</div>
							<div class="invalid-feedback">
								<i class="fas fa-lg fa-exclamation-circle"></i> Please enter your email address
							</div>
						</div>
						<div class="form-group">
							<label for="em_msg">Request</label>
							<textarea class="form-control" id="em_msg" rows="6" required></textarea>
							<div class="valid-feedback">
								<i class="fas fa-lg fa-check-circle"></i> Looks good! 
							</div>
							<div class="invalid-feedback">
								<i class="fas fa-lg fa-exclamation-circle"></i> Please enter message
							</div>
						</div>
						<br>
						<div class="form-group">
							<button class="btn btn-outline-primary" id="btn_email"><i class="fas fa-save"></i> Request</button>
							<button class="btn btn-light" id="btn_clear"><i class="fas fa-undo"></i> Clear</button>
						</div>
					</form>
				</div>
				<div class="col-lg-6 col-sm-12">
					<span class="sys_map_embed"></span>
				</div>
			</div>
		</div>

        <!--footer-->
		<?php
		include './includes/frontend-footer.php';
		include './includes/end-block.php';
		include './includes/commonJS.php';
		?>
        <script>
			function sendEmail() {
				var em_name = $('#em_name').val();
				var em_email = $('#em_email').val();
				var sys_email = $('#sys_email').val();
				var em_msg = $('#em_msg').val();
				var postdata = {
					action: 'sendContactUsPageEmail',
					em_name: em_name,
					em_email: em_email,
					sys_email: sys_email,
					em_msg: em_msg,
				}
				$.post('bkp/controllers/settingController.php', postdata, function (e) {
					if (parseInt(e.msgType) == 1) {
						swal("Good job!", e.msg, "success");
						clearEmail();
					} else {
						swal("Alert !", e.msg, "error");
					}
				}, "json");
			}

			function clearEmail() {
				$('#em_name').val('');
				$('#em_email').val('');
				$('#em_msg').val('');
				$('#emailform').removeClass('was-validated');
			}

			function loadThisPageSettings() {
				$.post('bkp/controllers/settingController.php', {action: 'getAllSystemInfo'}, function (e) {
					$.each(e, function (index, qdt) {
						//contact info
						$('#sys_email').val(qdt.sys_email);
						$('.sys_map_embed').html('').append(qdt.sys_map_embed)
						console.log(qdt.sys_map_embed)
					});
				}, "json");
			}


			$(document).ready(function () {
				// Executes when the HTML document is loaded and the DOM is ready
				loadThisPageSettings();

				const form = $('#emailform');

				$('#btn_email').click(function (event) {
					form.submit(false);
					form.addClass('was-validated');
					if (form[0].checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					} else {
						sendEmail();
					}
				});
			});
        </script>
    </body>
</html>