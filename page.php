<?php include './access_control/session_controler.php'; ?>   
<!doctype html>
<html lang="en">
    <head>
		<?php include './includes/head-block.php'; ?>
    </head>
    <body>
        <!--navbar-->
		<?php include './includes/frontend-navbar.php'; ?>       
		<input type="hidden" id="pg" value="<?php
		if (isset($_REQUEST['pg']) && !empty($_REQUEST['pg'])) {
			echo $_REQUEST['pg'];
		}
		?>">
        <!--body content-->  
		<div class="container">
			<div class="row frontsubpages-style1">
				<div class="col-lg-12 col-12">
					<h3 class="text-uppercase pgs_heading"></h3> 
					<p class="pgs_content"></p>
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
			function loadThisPage() {
				var pgs_link_name = $('#pg').val();				
				$.post('bkp/controllers/pageController.php', {action: 'getPageSectionByURLName',pgs_link_name:pgs_link_name}, function (e) {
					$.each(e, function (index, qdt) {
						$('.pgs_heading').html('').append(qdt.pgs_heading);
						$('.pgs_content').html('').append(qdt.pgs_content);	
					});
				}, "json");
			}


			$(document).ready(function () {
				// Executes when the HTML document is loaded and the DOM is ready
				loadThisPage();
			});
        </script>
    </body>
</html>