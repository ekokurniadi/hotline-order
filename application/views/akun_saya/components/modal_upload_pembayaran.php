<section class="contact_us">
	<div class="modal fade" id="modalUploadBuktiBayar" tabindex="-1" aria-labelledby="modalUploadBuktiBayar" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">

					<h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
					<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" id="form_gantiFoto" class="needs-validation" novalidate="" enctype="multipart/form-data">
						<div class="container">

							<div class="row">

								<div class="col-md-12">
									<input type="file" class="form-control tanya" name="bukti_bayar" id="bukti_bayar" onchange="loadFile(event)">
								</div>
								<br>
								<div class="col-md-12 mb-3">
									<div>
										<h6 style="text-align: left;">Preview</h6>
										<img id="output" class="img-responsive" width="60%">
									</div>
								</div>
								<div class="col-md-12 mt-2">
									<input type="hidden" name="kode_pesanan" id="kode_pesanan" value="<?= $header_pesanan->kode_pesanan ?>">
									<button class="btn btn-primary btn-sm btn-flat" id="btnSaveImage" type="button">Upload</button>
								</div>
							</div>
						</div>

					</form>


				</div>
			</div>
		</div>
	</div>
</section>

<script>
	var loadFile = function(event) {
		var reader = new FileReader();
		reader.onload = function() {
			var output = document.getElementById('output');
			output.src = reader.result;
		};
		reader.readAsDataURL(event.target.files[0]);

	};

	$('#btnSaveImage').click(function() {
		var form = new FormData();
		var files = $('#bukti_bayar')[0].files;
		console.log(files)
		if (files.length > 0) {
			form.append('bukti_bayar', files[0]);
			form.append('kode_pesanan', $('#kode_pesanan').val());
			$.ajax({
				enctype: 'multipart/form-data',
				url: '<?= base_url('akun_saya/upload_bukti_bayar') ?>',
				type: 'POST',
				data: form,
				processData: false,
				contentType: false,
				cache: false,
				dataType: 'JSON',
				success: function(response) {
					if (response.status == 200) {
						$('#modalUploadBuktiBayar').modal('hide');
						Swal.fire({
							icon: 'success',
							title: 'Notification',
							text: 'Berhasil Mengupload Bukti Pembayaran',

						});
						setTimeout(() => {
							window.location.reload();
						}, 1000);

						dataTable.draw();
					} else {
						gagal_send();
					}
				}
			});
		} else {
			validationError();
		}
	});
</script>
