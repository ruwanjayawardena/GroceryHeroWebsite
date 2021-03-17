<script>
	window.fbAsyncInit = function () {
		FB.init({
			appId: '221700855705123',
			status: true,
			xfbml: true,
			cookie: true, // Enable cookies to allow the server to access the session.
			version: 'v6.0'
		});
//		FB.getLoginStatus(function (response) {
//			if (response.status === 'connected') {
//				console.log('we are connected');
//			} else if (response.status === 'not_authorized') {
//				console.log('we are not logged in.');
//			} else {
//				console.log('you are not logged in to Facebook');
//			}
//		});
	};
	(function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {
			return;
		}
		js = d.createElement(s);
		js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
//			function login() {
//				FB.login(function (response) {
//					if (response.status === 'connected') {
//						document.getElementById('status').innerHTML = 'we are connected';
//					} else if (response.status === 'not_authorized') {
//						document.getElementById('status').innerHTML = 'we are not logged in.'
//					} else {
//						document.getElementById('status').innerHTML = 'you are not logged in to Facebook';
//					}
//
//				}, {scope: 'public_profile,email'});
//			}
//			;
	// get user basic info

//			function getInfo() {
//				FB.api('/me?fields=email,first_name,last_name,name,id', function (response) {
//					//document.getElementById('status').innerHTML = response.name;
//					console.log(response.email);
//					console.log(response.name);
//				});
//			}
//
	function fblogout() {
		FB.logout(function (response) {
			//no things to do
		});
	}
</script>
<script type="text/javascript">

	function chosenRefresh() {
		$('select').trigger("chosen:updated");
	}

	function madeCheckBoxString(chkClassName, stringStoreID) {
		var ar = [];
		var es;
		var v;
		if ($(this).is(':checked')) {
			es = $(chkClassName + ':checked');
			es.each(function (index) {
				ar.push($(this).val());
			});
		} else {
			es = $(chkClassName + ':checked');
			es.each(function (index) {
				ar.push($(this).val());
			});
		}
		v = ar.join(',');
		$(stringStoreID).val(v);
	}



	//NEED
	function navigateDashboard() {
		var postData = {
			action: "navigateDashboard"
		}
		$.post('bkp/controllers/userController.php', postData, function (e) {
			if (parseInt(e) == 2) {
				//admin
				window.location.href = 'bkp/dashboard-admin.php';
			} else if (parseInt(e) == 3) {
				//user category
				window.location.href = 'dashboard-requester.php';
			} else if (parseInt(e) == 4) {
				//user category
				window.location.href = 'dashboard-runner.php';
			} else if (parseInt(e) == 1) {
				//super admin
				window.location.href = 'bkp/dashboard.php';
			}
		});
	}
	//END NEED

	//NEED
	function WebsiteCommonSettings() {
		$.post('bkp/controllers/settingController.php', {action: 'getAllSystemInfo'}, function (e) {
			$.each(e, function (index, qdt) {
				if (parseInt(qdt.sys_logo_type) == 1) {
					$('#sys_name').val(qdt.sys_name);
					$('.logoDisplyModule').html('').append('<span class="logoText">' + qdt.sys_name + '</span>')
				} else if (parseInt(qdt.sys_logo_type) == 2) {
					$.post('bkp/controllers/settingController.php', {action: 'loadwebsitelogo'}, function (logo) {
						$('.logoDisplyModule').html('').append('<img class="website_logo d-inline-block img-logo" src="asset_imageuploader/websitelogo/images/' + logo + '">');
					});
				}
			});
		}, "json");
	}
	//END NEED

	//NEED
	function getLoggedUserStatus() {
		$.post('bkp/controllers/userController.php', {action: 'getLoggedUserStatus'}, function (e) {
			if (parseInt(e.usr_status) == 0) {
				//not activated
				$('.sysMessage').prop('hidden', false);
				$('.sysMessage').html('').append('<h5 class="p-2 text-white"><strong class="text-uppercase">Alert ! </strong>&nbsp;&nbsp; Please check your email (​'+e.usr_email+') and activate your account in order to access your account</h5>');
			} else {
				$('.sysMessage').prop('hidden', true);
			}
		}, "json");
	}
	//END NEED

	//NEED
	function loadFrontEndPageSections() {
		var sections = "";
		var navbar = "";
		var footer_support = "";
		var footer_legal = "";
		$.post('bkp/controllers/pageController.php', {action: 'allPageSection'}, function (e) {
			$.each(e, function (index, qdt) {
				//home page sections
				if (parseInt(qdt.pgs_filter_one) == 4) {
					if (parseInt(qdt.pgs_style) == 3) {
						sections += '<div class="row ' + qdt.sty_class + '">';
						sections += '<div class="col-12">';
						sections += '<h3 class="text-capitalize text-center wrapper-text-heading">' + qdt.pgs_heading + '</h3>';
						sections += '</div>';
						sections += '</div>';
					} else {
						sections += '<div class="row justify-content-center ' + qdt.sty_class + '">'
						sections += '<div class="col-lg-8 col-10 text-center">';
						sections += '<h3>' + qdt.pgs_heading + '</h3>';
						sections += '<p>' + qdt.pgs_content + '</p>';
						sections += '</div>';
						sections += '</div>';
					}
				}
			});
			//header nav bar
			navbar += '<li class="nav-item active">';
			navbar += '<a class="nav-link" href="index.php">Home</a>';
			navbar += '</li>';
			$.each(e, function (index, qdt) {
				if (parseInt(qdt.pgs_filter_one) == 1) {
					navbar += '<li class="nav-item">';
					navbar += '<a class="nav-link" href="page.php?pg=' + qdt.pgs_link_name + '">' + qdt.pgs_heading + '</a>';
					navbar += '</li>';
				}
			});
			navbar += '<li class="nav-item">';
			navbar += '<a class="nav-link" href="contact.php">Contact Us</a>';
			navbar += '</li>';
			//footer section
			$.each(e, function (index, qdt) {
				if (parseInt(qdt.pgs_filter_one) == 2) {
					if (parseInt(qdt.pgs_filter_two) == 2) {
						//Support
						footer_support += '<li><a href="page.php?pg=' + qdt.pgs_link_name + '">' + qdt.pgs_heading + '</a></li>';
					}
					if (parseInt(qdt.pgs_filter_two) == 3) {
						//Legal
						footer_legal += '<li><a href="page.php?pg=' + qdt.pgs_link_name + '">' + qdt.pgs_heading + '</a></li>';
					}
				}
			});
			$('.footer_support').html('').append(footer_support);
			$('.footer_legal').html('').append(footer_legal);
			$('.loadadwebsite').html('').append(navbar);
			$('.pageSections').html('').append(sections);
		}, "json");
	}
	//END NEED

	$(document).ready(function () {
		getLoggedUserStatus();
		WebsiteCommonSettings();
		loadFrontEndPageSections();

		$('select').chosen();

		$('body').append('<button id="toTop" class="btn btn-outline-light" hidden><i class="fas fa-arrow-circle-up"></i></button>');

		$(window).on('scroll', function () {
			if ($(this).scrollTop() != 0) {
				$('#toTop').prop('hidden', false);
			} else {
				$('#toTop').prop('hidden', true);
			}
		});

		$('#toTop').click(function () {
			$("html, body").animate({scrollTop: 0}, 600);
			return false;
		});
		$('.logout').click(function () {
			swal({
				title: "Alert !",
				text: "Do you need to log out ?",
				type: "info",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				cancelButtonClass: "btn-light",
				confirmButtonText: "Yes, Sign out",
				closeOnConfirm: false

			}, function () {
				$.post('bkp/controllers/userController.php', {action: 'logout'}, function (x) {
					if (parseInt(x.msgType) == 1) {
						if (x.logout_type === 'fb') {
							fblogout();
						}
						swal({
							title: "Please Wait...",
							text: x.msg,
							timer: 1700,
							showConfirmButton: false
						});
						setTimeout(function () {
							window.location.href = "index.php";
						}, 2300);

					} else {
						swal("Alert !", x.msg, "warning");
					}
				}, "json");
			});
		});
	});</script>
