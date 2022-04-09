<div class="modal fade" id="upload-master-part" tabindex="-1" aria-labelledby="upload-master-part" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Upload Master Parts</h5>
				<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" id="form_" class="needs-validation" novalidate="" enctype="multipart/form-data">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<input type="file" class="form-control tanya" name="file_part" id="file_part" onchange="loadFile(event)">
							</div>
							<br>
							<div class="col-md-12 mt-2">
								<button class="btn btn-primary btn-sm btn-flat" id="btn_submit" type="button">Upload</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$('#btn_submit').click(function() {
		if ($('#file_part').val() == '') {
			validationError();
		} else {
			var values = new FormData($('#form_')[0]);
			$.ajax({
				beforeSend: function() {
					$('#btn_submit').html('<i class="fa fa-spinner fa-spin"></i> Process');
					$('#btn_submit').attr('disabled', true);
				},
				enctype: 'multipart/form-data',
				url: '<?= base_url('master_parts/upload_master_parts') ?>',
				type: "POST",
				data: values,
				processData: false,
				contentType: false,
				cache: false,
				dataType: 'JSON',
				success: function(response) {
					$('#upload-master-part').modal('hide');
					window.location = response.link;
					$('#btn_submit').html('Start Upload');
				},
				error: function() {
					alert("Something Went Wrong !");
					$('#btn_submit').html('Start Upload');
					$('#btn_submit').attr('disabled', false);
				}
			});
		}
	});
</script>
