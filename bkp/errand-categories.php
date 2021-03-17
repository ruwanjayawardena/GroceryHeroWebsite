<?php include './access_control/pages_auth.php'; ?> 
<!doctype html>
<html lang="en">
    <head>
		<?php include './includes/head-block.php'; ?>    
		<style>
			table .img-thumbnail {
				width: 70px !important;
				height: 70px !important;
			}

			table .imgdiv{
				width: 70px
			}
		</style>
    </head>
    <body>
        <!--navbar-->
		<?php include 'includes/backend-navbar.php'; ?>        

        <!--body content-->
        <section class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-th fa-lg"></i> Errand Categories  &nbsp;&nbsp;<a class="btn btn-primary d-print-none" onclick="navigateDashboard()"><i class="fas fa-arrow-circle-left"></i>&nbsp;Back</a></h4>                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7 col-12">
                        <form id="pageform" novalidate>
                            <input type="hidden" class="form-control" id="cat_id">                           
                            <div class="form-row">
								<div class="col">
									<div class="form-group">
										<label for="cat_name">Category</label>
										<input type="text" class="form-control" id="cat_name" placeholder="Category" required>
										<div class="valid-feedback">
											<i class="fas fa-lg fa-check-circle"></i> Looks good! 
										</div>
										<div class="invalid-feedback">
											<i class="fas fa-lg fa-exclamation-circle"></i> Please enter category
										</div>
									</div>
								</div>
							</div>                                                  
                            <br>
                            <div class="form-row">
								<div class="col">
									<button class="btn btn-success" id="btn_save"><i class="fas fa-save"></i> Add</button>
									<button class="btn btn-warning" id="btn_edit" hidden><i class="fas fa-edit"></i> Edit</button>
									<button class="btn btn-light" id="btn_clear"><i class="fas fa-undo"></i> Clear</button>
								</div>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <div class="table-responsive">
                            <table id="tblCategory" class="table table-bordered table-hover" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
										<th></th>                                
                                        <th></th>                            
                                        <th></th>
										<th>Category</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
	<?php
	include './includes/end-block.php';
	include './includes/comboboxJS.php';
	include './includes/commonJS.php';
	?>  
    <script>
		function tblCategory(callback) {
			var tbldata = "";
			$.post('controllers/caCategoryController.php', {action: 'tblCategory'}, function (e) {
				if (e === undefined || e.length === 0 || e === null) {
					tbldata += '<tr>';
					tbldata += '<td colspan="4" class="bg-danger text-center"> -- Data Not Available -- </td>';
					tbldata += '</tr>';
					$('#tblCategory tbody').html('').append(tbldata);
				} else {
					$.each(e, function (index, qdt) {
						index++;
						tbldata += '<tr>';
						tbldata += '<td>';
						tbldata += '<div class="btn-group btn-group-sm">';
						tbldata += '<button class="btn btn-info btn_select" value="' + qdt.cat_id + '"><i class="fas fa-edit"></i></button>';
						tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.cat_id + '"><i class="fas fa-trash-alt"></i></button>';
						tbldata += '<button class="btn btn-secondary btn_upload" value="' + qdt.cat_id + '"><i class="fas fa-upload"></i> Upload</button>';
						tbldata += '</div>';
						tbldata += '</td>';
						tbldata += '<td></td>';
						tbldata += '<td class="imgdiv">';
						if (qdt.cat_img === "#") {
							tbldata += '<img src="../assets/img/noimage.png" class="img-thumbnail">';
						} else {
							tbldata += '<img src="../asset_imageuploader/caCategory/' + qdt.cat_id + '/' + qdt.cat_img + '" class="img-thumbnail">';
						}
						tbldata += '</td>';
						tbldata += '<td>' + qdt.cat_name + '</td>';
						tbldata += '</tr>';
					});

					if ($.fn.DataTable.isDataTable('#tblCategory')) {
						//re initialize 
						$('#tblCategory').DataTable().destroy();
						$('#tblCategory tbody').empty();
						$('#tblCategory tbody').html('').append(tbldata);
						$('#tblCategory').DataTable({
							responsive: {
								details: {
									type: 'column',
									target: 'tr'
								}
							},
							columnDefs: [
								{className: 'control text-right', orderable: false, targets: 1},
								{orderable: false, targets: 0}
							]
						});
					} else {
						//initilized                    
						$('#tblCategory tbody').html('').append(tbldata);
						$('#tblCategory').DataTable({
							responsive: {
								details: {
									type: 'column',
									target: 'tr'
								}
							},
							columnDefs: [
								{className: 'control text-right', orderable: false, targets: 1},
								{orderable: false, targets: 0}
							]
						});
					}
					$('[data-toggle="tooltip"]').tooltip();
				}

				$('#tblCategory').on('draw.dt', function () {
					$('.btn_upload').click(function () {
						var cat_id = $(this).val();
						var confirmModalString = '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
								'<div class="modal-dialog" role="document">' +
								'<div class="modal-content">' +
								'<div class="modal-header">' +
								'<h5 class="modal-title" id="exampleModalLabel">Upload Category Image</h5>' +
								'<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
								'<span aria-hidden="true">&times;</span>' +
								'</button>' +
								'</div>' +
								'<div class="modal-body">';
						//here is model body start
						confirmModalString += '<iframe src="caCategoryImage_upload.php?id=' + cat_id + '"  id="iframe_photos" width="100%"></iframe>';
						//here is model body end
						confirmModalString += '</div>' +
								//start model footer
								'<div class="modal-footer">' +
								'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>' +
								'</div>' +
								//end modal footer
								'</div>' +
								'</div>' +
								'</div>';

						var confirmModal = $(confirmModalString);
						confirmModal.modal('show');

						confirmModal.on('hide.bs.modal', function () {
							tblCategory();
						});
					});

					$('.btn_select').click(function () {
						$('#btn_save').prop('hidden', true);
						$('#btn_edit').prop('hidden', false);
						var cat_id = $(this).val();
						$.post('controllers/caCategoryController.php', {action: 'getCategoryByID', cat_id: cat_id}, function (e) {
							$.each(e, function (index, qdt) {
								$('#cat_id').val(qdt.cat_id);
								$
								$('#cat_name').val(qdt.cat_name);
							});
						}, "json");
					});

					$('.btn_delete').click(function () {
						var cat_id = $(this).val();
						swal({
							title: "Are you sure?",
							text: "Do you want to delete this category ?",
							type: "warning",
							showCancelButton: true,
							confirmButtonClass: "btn-danger",
							cancelButtonClass: "btn-light",
							confirmButtonText: "Yes, delete it!",
							closeOnConfirm: false
						}, function () {
							$.post('controllers/caCategoryController.php', {action: 'removeCategory', cat_id: cat_id}, function (e) {
								if (parseInt(e.msgType) == 1) {
									swal("Good Job!", e.msg, "success");
									clearCategory();
								} else {
									swal("Error!", e.msg, "error");
								}
							}, "json");
						});
					});
				});

				$('.btn_upload').click(function () {
					var cat_id = $(this).val();
					var confirmModalString = '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
							'<div class="modal-dialog" role="document">' +
							'<div class="modal-content">' +
							'<div class="modal-header">' +
							'<h5 class="modal-title" id="exampleModalLabel">Upload Category Image</h5>' +
							'<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
							'<span aria-hidden="true">&times;</span>' +
							'</button>' +
							'</div>' +
							'<div class="modal-body">';
					//here is model body start
					confirmModalString += '<iframe src="caCategoryImage_upload.php?id=' + cat_id + '"  id="iframe_photos" width="100%"></iframe>';
					//here is model body end
					confirmModalString += '</div>' +
							//start model footer
							'<div class="modal-footer">' +
							'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>' +
							'</div>' +
							//end modal footer
							'</div>' +
							'</div>' +
							'</div>';

					var confirmModal = $(confirmModalString);
					confirmModal.modal('show');
					
					confirmModal.on('hide.bs.modal', function () {
						tblCategory();
					});
				});




				$('.btn_select').click(function () {
					$('#btn_save').prop('hidden', true);
					$('#btn_edit').prop('hidden', false);
					var cat_id = $(this).val();
					$.post('controllers/caCategoryController.php', {action: 'getCategoryByID', cat_id: cat_id}, function (e) {
						$.each(e, function (index, qdt) {
							$('#cat_id').val(qdt.cat_id);
							$
							$('#cat_name').val(qdt.cat_name);
						});
					}, "json");
				});

				$('.btn_delete').click(function () {
					var cat_id = $(this).val();
					swal({
						title: "Are you sure?",
						text: "Do you want to delete this category ?",
						type: "warning",
						showCancelButton: true,
						confirmButtonClass: "btn-danger",
						cancelButtonClass: "btn-light",
						confirmButtonText: "Yes, delete it!",
						closeOnConfirm: false
					}, function () {
						$.post('controllers/caCategoryController.php', {action: 'removeCategory', cat_id: cat_id}, function (e) {
							if (parseInt(e.msgType) == 1) {
								swal("Good Job!", e.msg, "success");
								clearCategory();
							} else {
								swal("Error!", e.msg, "error");
							}
						}, "json");
					});
				});

				if (callback !== undefined) {
					if (typeof callback === 'function') {
						callback();
					}
				}
			}, "json");
		}

		function addCategory() {
			var cat_name = $('#cat_name').val();
			var postdata = {
				action: "addCategory",
				cat_name: cat_name
			}
			$.post('controllers/caCategoryController.php', postdata, function (e) {
				if (parseInt(e.msgType) == 1) {
					swal("Good job!", e.msg, "success");
					clearCategory();
				} else {
					swal("Alert !", e.msg, "error");
				}
			}, "json");
		}

		function editCategory() {
			var cat_id = $('#cat_id').val();
			var cat_name = $('#cat_name').val();
			var postdata = {
				action: "editCategory",
				cat_name: cat_name,
				cat_id: cat_id
			}
			$.post('controllers/caCategoryController.php', postdata, function (e) {
				if (parseInt(e.msgType) == 1) {
					swal("Good job!", e.msg, "success");
					clearCategory();
				} else {
					swal("Alert !", e.msg, "error");
				}
			}, "json");
		}

		function clearCategory() {
			$('#cat_id').val('');
			$('#cat_name').val('');
			$('#btn_save').prop('hidden', false);
			$('#btn_edit').prop('hidden', true);
			$('#pageform').removeClass('was-validated');
			tblCategory();
		}




		$(document).ready(function () {
			tblCategory();
			const form = $('#pageform');

			$('#btn_save').click(function (event) {
				form.submit(false);
				form.addClass('was-validated');
				if (form[0].checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				} else {
					addCategory();
				}
			});

			$('#btn_edit').click(function (event) {
				form.submit(false);
				form.addClass('was-validated');
				if (form[0].checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				} else {
					editCategory();
				}
			});

			$('#btn_clear').click(function (event) {
				form.submit(false);
				clearCategory();
			});


		});
    </script>
</body>
</html>