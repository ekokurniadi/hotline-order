<div class="card shadow mb-4">
	<div class="card-header ">
		<a href="<?= base_url('akun_saya/checkout') ?>" class="btn d-flex align-items-center">
			<span class="fa fa-arrow-left mr-2"></span>
			<h6 class="m-0 font-weight-bold text-primary">Kembali</h6>
		</a>
	</div>
	<div class="card-body">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h5 class="modal-title text-dark" id="exampleModalLabel" style="font-weight: bold;">Detail Pesanan : <?= $header_pesanan->kode_pesanan ?></h5>
				</div>
				<div class="col-md-3">
					<label for="">Nama Lengkap</label>
					<input type="text" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap" required value="<?= $header_pesanan->nama_lengkap ?>" readonly>
				</div>
				<div class="col-md-3">
					<label for="">No. Telpon</label>
					<input type="text" class="form-control" id="no_telepon" placeholder="No Telpon" required value="<?= $header_pesanan->no_telepon ?>" readonly>
				</div>
				<div class="col-md-6">
					<label for="">Alamat</label>
					<input type="text" class="form-control" id="alamat" placeholder="Alamat" required value="<?= $header_pesanan->alamat ?>" readonly>
				</div>
				<div class="col-md-3">
					<label for="">No. Mesin</label>
					<input type="text" class="form-control" placeholder="No. Mesin" required name="no_mesin" id="no_mesin" value="<?= $header_pesanan->no_mesin ?>" readonly>
				</div>
				<div class="col-md-3">
					<label for="">No. Rangka</label>
					<input type="text" class="form-control" placeholder="No. Rangka" required name="no_rangka" id="no_rangka" value="<?= $header_pesanan->no_rangka ?>" readonly>
				</div>
				<div class="col-md-3">
					<label for="">No. Polisi</label>
					<input type="text" class="form-control" placeholder="No. Polisi" required name="no_polisi" id="no_polisi" value="<?= $header_pesanan->no_polisi ?>" readonly>
				</div>
				<div class="col-md-3">
					<label for="">Tahun Perakitan</label>
					<input type="text" class="form-control" placeholder="Tahun Perakitan" required name="tahun_perakitan" id="tahun_perakitan" value="<?= $header_pesanan->tahun_perakitan ?>" readonly>
				</div>


				<div class="col-md-6 mt-2">
					<label for="">Foto STNK</label>

					<div>
						<img class="img-fluid my-3" src="<?= base_url('uploads/pesanan/') . $header_pesanan->foto_stnk ?>" alt="" />
					</div>

				</div>

				<div class="col-md-6 mt-2">
					<label for="">Foto Sepeda Motor</label>

					<div>
						<img class="img-fluid my-3" src="<?= base_url('uploads/pesanan/') . $header_pesanan->foto_motor ?>" alt="" />
					</div>

				</div>

				<div class="col-md-12 btn btn-flat btn-block btn-success mb-2">
					Detail Barang Pesanan
				</div>

				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Barang</th>
									<th>Nama Barang</th>
									<th>Harga</th>
									<th>Jumlah</th>
									<th>Subtotal</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								$grandTotal = 0;
								foreach ($detail_pesanan as $dp) : ?>
									<?php $grandTotal += $dp->subtotal ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $dp->kode_barang ?></td>
										<td><?= $dp->nama_barang ?></td>
										<td><?= number_format($dp->harga_barang, 0, ',', '.') ?></td>
										<td><?= $dp->qty_pesanan ?></td>
										<td><?= number_format($dp->subtotal, 0, ',', '.') ?></td>
									</tr>
								<?php endforeach; ?>
							<tfoot>
								<tr>
									<td colspan="5" style="text-align: right;">Total Tagihan</td>
									<td><?= number_format($grandTotal, 0, ',', '.') ?></td>
								</tr>
							</tfoot>
							</tbody>
						</table>
					</div>
				</div>

				<div class="col-md-12 mt-2 mb-4">
					<?php if ($header_pesanan->is_payment == 0 && $header_pesanan->status != 'batal' && $header_pesanan->status != 'selesai') : ?>
						<button onclick="openModalUploadBuktiBayar();" class="btn btn-flat btn-primary">Upload Bukti Bayar</button>
						<a onclick="return confirm('Apakah anda ingin membatalkan pesanan?')" href="<?= base_url('akun_saya/batal_pesanan/') . $header_pesanan->kode_pesanan ?>" class="btn btn-flat btn-danger">Batalkan Pesanan</a>
					<?php endif; ?>
				</div>

			</div>
		</div>

	</div>
</div>
<?php $this->load->view('akun_saya/components/modal_upload_pembayaran') ?>
<script>
	function openModalUploadBuktiBayar() {
		$('#modalUploadBuktiBayar').modal('show');
	}
</script>
