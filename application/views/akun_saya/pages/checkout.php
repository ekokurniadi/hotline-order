<div class="card shadow mb-4">
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-primary">Daftar Pesanan</h6>
	</div>
	<div class="card-body">
		<div class="container">
			<div class="row">
				<div class="col-md-12 d-flex justify-content-start daftar-pesanan-a">
					<div>
						<a href="?status=belum_bayar" class="<?= $_GET['status'] == 'belum_bayar' || $_GET['status'] == '' ? 'active-href' : '' ?>">Pesanan Terbaru</a>
						<div class="<?= $_GET['status'] == 'belum_bayar' || $_GET['status'] == '' ? 'actived' : '' ?>"></div>
					</div>

					<div>
						<a href="?status=proses" class="<?= $_GET['status'] == 'proses' ? 'active-href' : '' ?>">Diproses</a>
						<div class="<?= $_GET['status'] == 'proses' ? 'actived' : '' ?>"></div>
					</div>

					<div>
						<a href="?status=batal" class="<?= $_GET['status'] == 'batal' ? 'active-href' : '' ?>">Dibatalkan</a>
						<div class="<?= $_GET['status'] == 'batal' ? 'actived' : '' ?>"></div>
					</div>

					<div>
						<a href="?status=diambil" class="<?= $_GET['status'] == 'diambil' ? 'active-href' : '' ?>">Siap Diambil</a>
						<div class="<?= $_GET['status'] == 'diambil' ? 'actived' : '' ?>"></div>
					</div>

					<div>
						<a href="?status=selesai" class="<?= $_GET['status'] == 'selesai' ? 'active-href' : '' ?>">Selesai</a>
						<div class="<?= $_GET['status'] == 'selesai' ? 'actived' : '' ?>"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 mt-3">
					<div class="table-responsive">
						<table class="table table-bordered" id="example1">
							<thead>
								<tr>
									<th>No</th>
									<th>No Pesanan</th>
									<th>Tanggal</th>
									<th>Total tagihan</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
						<script>
							$(document).ready(function() {
								dataTable = $('#example1').DataTable({
									"processing": true,
									"serverSide": true,
									"scrollX": false,
									"language": {
										"infoFiltered": "",
										"processing": "<td style='text-align:center;width:100%;display:block;'><i class='fa fa-spinner fa-spin' style='font-size:80px'></i> </td>",
									},
									"order": [],
									"lengthMenu": [
										[10, 25, 50, 75, 100],
										[10, 25, 50, 75, 100]
									],
									"ajax": {
										url: "<?php echo site_url('akun_saya/fetch_data_pesanan'); ?>",
										type: "POST",
										dataSrc: "data",
										data: function(d) {
											d.status = '<?= $_GET['status'] == '' ? 'belum_bayar' : $_GET['status'] ?>'
										},
									},
									"columnDefs": [{
										"targets": [0],
										"className": 'text-center'
									}, ],
								});
								dataTable.on('draw.dt', function() {
									var info = dataTable.page.info();
									dataTable.column(0, {
										search: 'applied',
										order: 'applied',
										page: 'applied'
									}).nodes().each(function(cell, i) {
										cell.innerHTML = i + 1 + info.start + ".";
									});
								});
							});
						</script>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<style>
	@media screen and (max-width: 600px) {
		.daftar-pesanan-a {
			overflow: scroll;
		}
	}

	.daftar-pesanan-a a {
		text-decoration: none !important;
		white-space: nowrap;
		margin: 0px 10px;
		color: gray;
	}

	.actived {
		width: 100%;
		height: 5px;
		background-color: red;
	}

	a.active-href {
		color: black;
		font-weight: bold;
	}
</style>
