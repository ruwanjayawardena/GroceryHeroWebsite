<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="">
<title>:: GroceryHero ::</title>

<!--<link rel="shortcut icon" href="assets/img/favicon-logo/FaviconLogo.jpg">-->

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!--hover-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css">
<!--font awesome-->
<!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">-->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-12/css/all.css">
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">-->


<!--google translate button-->
<link rel="stylesheet" href="assets/css/googletranslate.css">
<!--data table-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

<!--bootstrap sweet alert-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">

<!--bootstrap chosen-->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">-->
<link rel="stylesheet" href="assets/css/component-chosen.min.css">

<!--bootstrap datetime picker-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<!--animation-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<!--fontend style-->
<link rel="stylesheet" href="assets/css/frontend.css">
<!--ribbon style-->
<link rel="stylesheet" href="assets/css/ribbon.css">

<script>
	function googleTranslateElementInit() {
		new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
		//		includedLanguages: 'ar,en,es,jv,ko,pa,pt,ru,zh-CN'

		$('#google_translate_element').on("click", function () {
			$("iframe").contents().find('.goog-te-menu2').css({
				"background-color": "black"
			});
			$("iframe").contents().find(".goog-te-menu2-item div, .goog-te-menu2-item:link div").css({
				"color": "#dadada",
				"background": "#ffffff05",
				'width': '100%'
			});
			$("iframe").contents().find(".goog-te-menu2-item span.text").css({
				"font-size": "small"
			});
			//			$("iframe").contents().find(".goog-te-menu2-item").css({
			//				"padding": "2px"
			//			});
			$("iframe").contents().find(".goog-te-menu2-item span.text:hover").css({
				'background-color': '#ffc107',
				'color': 'white'
			});
			//			Change iframes's size
			$("iframe").contents().find('.goog-te-menu2').css({
				'height': '100%',
				'width': '100%'
			});
			// Change hover effects
			$("iframe").contents().find(".goog-te-menu2-item div").hover(function () {
				$(this).css('background-color', '#007bff').find('span.text').css({
					'color': 'white',
					'font-weight': 'bold'
				});
			}, function () {
				$(this).css('background-color', '#000000').find('span.text').css({
					'color': 'white',
					'font-weight': 'normal'
				});
			});
			$("iframe").contents().find('.goog-te-menu2-item-selected div span.text, .goog-te-menu2-item-selected:link div span.text').css({
				"font-size": "12pt",
				"color": "#f23884",
				"font-weight": "bold"
			});
			$("iframe").contents().find('.goog-te-menu2-item-selected div span.indicator, .goog-te-menu2-item-selected:link div span.indicator').css({
				"font-size": "12pt",
				"color": "#f23884",
				"font-weight": "bold"
			});
			// Change Google's default blue border
			$("iframe").contents().find('.goog-te-menu2').css('border', 'none');
			// Change the iframe's box shadow
			$("iframe").contents().find(".goog-te-menu-frame").css('box-shadow', '0px 1px 4px 1px #007bff');
		});
	}
</script>








