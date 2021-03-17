<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<title>FACEBOOK INTERGRATION</title>   
	</head>
	<body>
		<div id="status"></div>
		<button onclick="getInfo();">Get INFO</button>
		<button onclick="login();">login</button>
		<button onclick="fblogout();">logout</button>
		<script>
			window.fbAsyncInit = function () {
				FB.init({
					appId: '221700855705123',
					status: true,
					xfbml: true,
					cookie: true, // Enable cookies to allow the server to access the session.
					version: 'v6.0'
				});
				FB.getLoginStatus(function (response) {
					if (response.status === 'connected') {
						console.log('we are connected');
					} else if (response.status === 'not_authorized') {
						console.log('we are not logged in.');
					} else {
						console.log('you are not logged in to Facebook');
					}
				});
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
			function login() {
				FB.login(function (response) {
					if (response.status === 'connected') {
						document.getElementById('status').innerHTML = 'we are connected';
					} else if (response.status === 'not_authorized') {
						document.getElementById('status').innerHTML = 'we are not logged in.'
					} else {
						document.getElementById('status').innerHTML = 'you are not logged in to Facebook';
					}

				}, {scope: 'public_profile,email,user_location'});
			}

			// get user basic info

			function getInfo() {
				FB.api('/me?fields=email,first_name,last_name,name,id', function (response) {
					//document.getElementById('status').innerHTML = response.name;
					console.log(response.email);
					console.log(response.name);
					console.log(response.user_location);
				});
			}
			//
			function fblogout() {
				FB.logout(function (response) {
					//no things to do
				});
			}
		</script>
	</body>
</html>