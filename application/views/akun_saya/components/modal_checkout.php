<style>
	label {
		font-weight: bold;
		margin-top: 10px;
	}
</style>
<div class="modal fade" id="modalCheckout" tabindex="-1" aria-labelledby="modalCheckout" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-danger" id="exampleModalLabel">Mohon untuk melengkapi Form Order</h5>
				<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" id="form_checkout" class="needs-validation" novalidate="" enctype="multipart/form-data">

					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<h5 class="modal-title text-primary" id="exampleModalLabel" style="font-weight: bold;">Form Order</h5>
							</div>
							<div class="col-md-3">
								<label for="">Nama Lengkap</label>
								<input type="text" class="form-control" placeholder="Nama Lengkap" value="<?= $_SESSION['nama_lengkap'] ?>">
							</div>
							<div class="col-md-3">
								<label for="">No. Telpon</label>
								<input type="text" class="form-control" placeholder="Alamat">
							</div>
							<div class="col-md-6">
								<label for="">Alamat</label>
								<input type="text" class="form-control" placeholder="Alamat">
							</div>
							<div class="col-md-3">
								<label for="">No. Mesin</label>
								<input type="text" class="form-control" placeholder="No. Mesin">
							</div>
							<div class="col-md-3">
								<label for="">No. Rangka</label>
								<input type="text" class="form-control" placeholder="No. Mesin">
							</div>
							<div class="col-md-3">
								<label for="">No. Polisi</label>
								<input type="text" class="form-control" placeholder="No. Mesin">
							</div>
							<div class="col-md-3">
								<label for="">Tahun Perakitan</label>
								<input type="text" class="form-control" placeholder="No. Mesin">
							</div>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
