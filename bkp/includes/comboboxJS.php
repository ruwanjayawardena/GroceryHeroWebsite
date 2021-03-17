<script type="text/javascript">
	//Load Combo Box Functions 
	function cmbPagefilter1(selected, callback) {
		var cmbdata = "";
		$.post('controllers/pageController.php', {action: 'cmbPagefilter1'}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> -- Data Not Found -- </option>';
			} else {
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.flh_id)) {
							cmbdata += '<option value="' + qdt.flh_id + '" selected>' + qdt.flh_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.flh_id + '">' + qdt.flh_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.flh_id + '">' + qdt.flh_name + '</option>';
					}
				});
			}
			$('.cmbPagefilter1').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback();
				}
			}
		}, "json");
	}

	function cmbPagefilter2(flh_id, selected, callback) {
		var cmbdata = "";
		$.post('controllers/pageController.php', {action: 'cmbPagefilter2', flh_id: flh_id}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> -- Data Not Found -- </option>';
			} else {
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.fls_id)) {
							cmbdata += '<option value="' + qdt.fls_id + '" selected>' + qdt.fls_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.fls_id + '">' + qdt.fls_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.fls_id + '">' + qdt.fls_name + '</option>';
					}
				});
			}
			$('.cmbPagefilter2').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback();
				}
			}
		}, "json");
	}

	function cmbPageStyle(selected, callback) {
		var cmbdata = "";
		$.post('controllers/pageController.php', {action: 'cmbPageStyle'}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> -- Data Not Found -- </option>';
			} else {
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.sty_id)) {
							cmbdata += '<option value="' + qdt.sty_id + '" selected>' + qdt.sty_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.sty_id + '">' + qdt.sty_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.sty_id + '">' + qdt.sty_name + '</option>';
					}
				});
			}
			$('.cmbPageStyle').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback();
				}
			}
		}, "json");
	}



	function cmbUserCategory(selected, callback) {
		var cmbdata = "";
		$.post('controllers/userController.php', {action: 'cmbUserCategory'}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> -- no data found -- </option>';
			} else {
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.usr_cat_id)) {
							cmbdata += '<option value="' + qdt.usr_cat_id + '" selected>' + qdt.usr_cat_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.usr_cat_id + '">' + qdt.usr_cat_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.usr_cat_id + '">' + qdt.usr_cat_name + '</option>';
					}
				});
			}
			$('.cmb_usercategory').html('').append(cmbdata);
			chosenRefresh();


			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback();
				}
			}
		}, "json");
	}




</script>

