<?php include './access_control/session_controler_activation_check.php'; ?>   
<!doctype html>
<html lang="en">
    <head>
		<?php include './includes/head-block.php'; ?>
        <style>           

            iframe{
                height: 250px;
                border: none;
            }
			iframe{
				overflow:hidden;
			}

			.card-body h5{
				color: #000 !important;
				font-weight: 900 !important;
				text-align: center;
			}

			.card-body{
				background-color: white;
			}
			
			.col-style{
				padding: 0;
			}

			.card {
				border: 1px solid rgba(151, 151, 151, 0.8);
				/*border: 1px solid rgb(175, 220, 122);*/
				min-height: 200px;
				margin: 5px;
			}
        </style>
    </head>
    <body>
        <!--navbar-->
		<?php include './includes/frontend-navbar.php'; ?>       

        <!--body content-->             

		<div class="container">
			<div class="row frontsubpages-style1">
				<div class="col-12">
					<div class="row justify-content-center">						
						<div class="col-lg-8 col-12">
							<h3 class="text-uppercase"><i class="fas fa-tasks"></i> Request a New Errand <br><small>What you need ?</small></h3>
							<div class="row errandCategories justify-content-center">

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
			function errandCategories() {
				var display = "";
				$.post('bkp/controllers/caCategoryController.php', {action: 'allCategory'}, function (e) {
					$.each(e, function (index, qdt) {
						display += '<div class="col-lg-3 col-sm-4 col-6 hvr-grow col-style"><a href="request-errand-step2.php?category='+qdt.cat_name+'"><div class="card">';
						if (qdt.cat_img === "#") {
							display += '<img src="assets/img/noimage.png" class="card-img-top">';
						} else {
							display += '<img src="asset_imageuploader/caCategory/' + qdt.cat_id + '/' + qdt.cat_img + '" class="card-img-top">';
						}
						display += '<div class="card-body">';
						display += '<h5 class="card-title">' + qdt.cat_name + '</h5>';
						display += '</div>';
						display += '</div></a></div>';
					});

					$('.errandCategories').html('').append(display);
				}, "json");
			}



			$(document).ready(function () {
				// Executes when the HTML document is loaded and the DOM is ready
				errandCategories();
			});
        </script>
    </body>
</html>