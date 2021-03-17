<?php include './access_control/session_controler.php'; ?>   
<!doctype html>
<html lang="en">
    <head>	
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="" />
		<meta name="keywords" content="">
		<?php include './includes/head-block-index.php'; ?>	
		<style>
			.bg-dark {
				background-color: #1e202200 !important;
				box-shadow: 0px 4px 5px 0px #0392be2b !important;
			}

			#slidersideimg{
				width: 100%;
				height: 450px;
			}

			.footercity a{
				color:  #a0a0a0;
				font-size: 0.75rem;
			}

			.footercity{
				font-size: 0.75rem;
			}

			.carousel img{
				width: 100%;
				height: 800px;
			}

			.carousel-caption {
				bottom: 34%;
			}

			.carousel-caption h5 {
				font-size: 2.98rem;
				font-family: 'Lato', sans-serif !important;
				font-weight: 300;
				text-transform: none !important;
				color: white !important;
				letter-spacing: 1.5px;
				text-align: left;
			}

			section.wrapper-location-accordion.wrapper-bg-none {
				background-color: #07073100;
			}

			section.wrapper-location-accordion.wrapper-bg-none .card-body {
				border-top: none;
			}

			section.wrapper-location-accordion.wrapper-bg-none .card.col-lg-4 {
				margin: 0;
				border: none;
				padding: 0;
			}

			.slider_sec1 .card {
				padding: 0;
				margin: 0;
				border: 0;
			}


			.slider_sec1 .card-header {
				font-family: 'Blinker', sans-serif;
				font-size: 1.35rem;
				color: #fcfcff;
				text-transform: uppercase;
				text-align: center;
				letter-spacing: 0.1rem;
			}
			.slider_sec1 .card {
				margin: 0px 1.5%;
				min-height: auto;				
				background-color: #0f11a6;
				border: 1px solid #0c0cae7a !important;
			}

			.sectionslider{
				margin: 0;
				padding: 0;
			}

			.locationcard{
				background: linear-gradient(45deg,#ffffff,#c3c3c3 100%);
				border-left: none;
				border-right: none;
				border-top: 1px solid #f2f2f24f;
			}

			.locationcard .btn-link {
				color: #0037dc;
			}





			.card{
				/*background-color: #0c0115;*/
				background-color: #f1f1f1;
			}
			.card-body {
				background-color: #3c3a3a00;
			}

			.card-text .bg-primary {
				background-color: #922f4a!important;
			}

			#adlistning_div .card-title {
				font-weight: 800;
				font-size: 1.5rem;
				color: #000000 !important;
				background-color: #fdfdfd8c;
				padding: 2px 10px 2px 10px;
			}

			.card-img-top {
				background-color:#f1f1f1;
				width: 120px !important;
				height: 120px !important;
			}

			.adcategory-card .card {
				border: none;
			}
		</style>		
    </head>
    <body>
		<!--nav bar-->
		<?php include './includes/frontend-navbar.php'; ?>
		<!--slider-->
		<?php include './includes/frontend-slider.php'; ?>
        <!--body content-->
		<div class="container-fluid pageSections">

		</div>       
        <!--footer-->
		<?php
		include './includes/frontend-footer.php';
		include './includes/end-block.php';
		include './includes/commonJS.php';
		?> 		
        <script>

			function loadIndexPage() {
				$.post('bkp/controllers/settingController.php', {action: 'getAllSystemInfo'}, function (e) {
					$.each(e, function (index, qdt) {
						//section 2
						$('.sys_welcome_msg').html('').append(qdt.sys_welcome_msg);
						//slider                        
						$.post('bkp/controllers/settingController.php', {action: 'loadslider'}, function (sldr) {
							var slider = "";
							var indicators = "";
							$.each(sldr, function (index, slimg) {

								if (index === 0) {
									slider += '<div class="carousel-item active">';
									indicators += '<li data-target="#carouselExampleIndicators" data-slide-to="' + index + '" class="active"></li>';
								} else {
									slider += '<div class="carousel-item">';
									indicators += '<li data-target="#carouselExampleIndicators" data-slide-to="' + index + '"></li>';
								}
								slider += '<img class="d-block w-100" src="asset_imageuploader/slider/images/' + slimg + '">';
								slider += '<div class="carousel-caption">';
								slider += '<div class="row">';
								slider += '<div class="col-lg-7 col-12 text-left">';


								slider += '<h5 class="text-uppercase mb-4">' + qdt.sys_slider_text1 + '</h5>';
								slider += '<p class="text-capitalize">' + qdt.sys_slider_text2 + '</p>';

								slider += '<button class="btn btn-light text-uppercase carousel-action-button btn-req-errand">Request Errand</button>';
								slider += ' <button class="btn btn-outline-light text-uppercase carousel-action-button-outline btn-run-errand">Run Errand</button>';


								slider += '</div>';

								slider += '<div class="col d-none d-md-block sliderrightcontent">';
								slider += '<img src="assets/img/phone5.png" class="img-reponsive" id="slidersideimg">';
								slider += '</div>';

								slider += '</div>';
								slider += '</div>';
								slider += '</div>';
							});

							$('.carousel-inner').html('').append(slider);
							$('.carousel-indicators').html('').append(indicators);

							$('.carousel').carousel({
								interval: 3000
							});

							$('.btn-req-errand').click(function () {
								$.post('bkp/controllers/settingController.php', {action: 'checkLoginStatus'}, function (e) {
									if (e.logged === 1) {
										if (parseInt(e.usr_cat_id) == 3) {
											//Request Errand
											window.location.href = 'request-errand.php';
										} else if (parseInt(e.usr_cat_id) == 4) {
											//Run Errand
											swal("Alert !", "Sorry your account type is not allowed for request errnads.", "warning");
										}
									} else {
										//go signup
										window.location.href = 'signup.php';
									}
								}, "json");
							});

							$('.btn-run-errand').click(function () {
								$.post('bkp/controllers/settingController.php', {action: 'checkLoginStatus'}, function (e) {
									if (e.logged === 1) {
										if (parseInt(e.usr_cat_id) == 3) {
											//Request Errand											
											swal("Alert !", "Sorry your account type is not allowed for run errnads.", "warning");
										} else if (parseInt(e.usr_cat_id) == 4) {
											//Run Errand
											window.location.href = 'client-errands-requests.php';
										}
									} else {
										//go signup
										window.location.href = 'signup.php';
									}
								}, "json");
							});


						}, "json");
					});
				}, "json");
			}




			$(document).ready(function () {
				$(window).scroll(function () {
					var scrollPos = $(document).scrollTop();
					if (parseInt(scrollPos) == 0) {
						$(".bg-dark").attr('style', 'background-color:#1e202200 !important;box-shadow: 0px 4px 5px 0px #0392be2b  !important');
						$(".logoText").attr('style', 'color:white !important');
						$(".navbar .btn-light").attr('style', 'border-color: white !important');
						$(".navbar .loadadwebsite .nav-item a").attr('style', 'color: #fff !important');
						$(".navbar .text-light").attr('style', 'color: white !important');
						$(".navbar .fa-inverse").attr('style', 'color: white !important');
						$("#mobiletogglebutton").addClass('fa-inverse');
					} else {
						$(".bg-dark").attr('style', 'background-color: #f8f8f8 !important;box-shadow: 0px 4px 5px 0px #d5d5d559 !important');
						$(".logoText").attr('style', 'color:#0e0f02 !important');
						$(".navbar .btn-light").attr('style', 'border-color: #9da3a9 !important;');
						$(".navbar .loadadwebsite .nav-item a").attr('style', 'color: #021D2B !important');
						$(".navbar .text-light").attr('style', 'color: #3c620d !important');
						$(".navbar .fa-inverse").attr('style', 'color: #02c2f0 !important');
						$("#mobiletogglebutton").removeClass('fa-inverse');
					}

				});
				loadIndexPage();
			});
        </script>
    </body>
</html>