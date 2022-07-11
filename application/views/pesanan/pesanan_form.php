<div class="main-container" style="min-height:100%">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Pesanan</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Pesanan</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>

			<div class="pd-20 card-box mb-30">
				<div class="clearfix">
					<div class="pull-left">
						<h4 class="text-blue h4">Form Pesanan </h4>
						<p class="mb-30"></p>
					</div>
				</div>
				<form action="<?php echo $action; ?>" method="post" class="form-horizontal">

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Kode Pesanan <?php echo form_error('kode_pesanan') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" readonly name="kode_pesanan" id="kode_pesanan" placeholder="Kode Pesanan" value="<?php echo $kode_pesanan; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Tanggal Dibuat <?php echo form_error('tanggal_dibuat') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" readonly name="tanggal_dibuat" id="tanggal_dibuat" placeholder="Tanggal Dibuat" value="<?php echo $tanggal_dibuat; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Id Pelanggan <?php echo form_error('id_pelanggan') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" readonly name="id_pelanggan" id="id_pelanggan" placeholder="Id Pelanggan" value="<?php echo $id_pelanggan; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Nama Lengkap <?php echo form_error('nama_lengkap') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" readonly name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $nama_lengkap; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Alamat <?php echo form_error('alamat') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" readonly name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">No Mesin <?php echo form_error('no_mesin') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" readonly name="no_mesin" id="no_mesin" placeholder="No Mesin" value="<?php echo $no_mesin; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">No Rangka <?php echo form_error('no_rangka') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" readonly name="no_rangka" id="no_rangka" placeholder="No Rangka" value="<?php echo $no_rangka; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">No Polisi <?php echo form_error('no_polisi') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" readonly name="no_polisi" id="no_polisi" placeholder="No Polisi" value="<?php echo $no_polisi; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">No Telepon <?php echo form_error('no_telepon') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" readonly name="no_telepon" id="no_telepon" placeholder="No Telepon" value="<?php echo $no_telepon; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Foto Stnk <?php echo form_error('foto_stnk') ?></label>
						<div class="col-sm-12 col-md-10">
						<input type="text" class="form-control" name="foto_stnk" id="foto_stnk" placeholder="Foto Stnk" value="<?php echo $foto_stnk; ?>" />	
						<img src="<?= base_url('uploads/pesanan/') . $foto_stnk ?>" class="img-fluid" alt="">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Foto Motor <?php echo form_error('foto_motor') ?></label>
						<div class="col-sm-12 col-md-10">
						<input type="text" class="form-control" name="foto_motor" id="foto_motor" placeholder="Foto Motor" value="<?php echo $foto_motor; ?>" />
							<img src="<?= base_url('uploads/pesanan/') . $foto_motor ?>" class="img-fluid" alt="">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Status <?php echo form_error('status') ?></label>
						<div class="col-sm-12 col-md-10">
							<select name="status" id="status" class="form-control">
								<option value="<?= $status ?>"><?= $status ?></option>
								<option value="proses">Proses</option>
								<option value="batal">Batal</option>
								<option value="selesai">Selesai</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Tahun Perakitan <?php echo form_error('tahun_perakitan') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" readonly name="tahun_perakitan" id="tahun_perakitan" placeholder="Tahun Perakitan" value="<?php echo $tahun_perakitan; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Pembayaran Valid <?php echo form_error('is_payment') ?></label>
						<div class="col-sm-12 col-md-10">
							<select name="is_payment" id="is_payment" class="form-control">
								<option value="<?= $is_payment ?>"><?= $is_payment == "1" ? "Ya" : "Tidak" ?></option>
								<option value="1">Ya</option>
								<option value="0">Tidak</option>
							</select>
						</div>
					</div>

				
						<input type="hidden" class="form-control" readonly name="is_come" id="is_come" placeholder="No Telepon" value="<?php echo $is_come; ?>" />
					

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Bukti Bayar <?php echo form_error('bukti_bayar') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" name="bukti_bayar" id="bukti_bayar" placeholder="Bukti Bayar" value="<?php echo $bukti_bayar; ?>" readonly />
							<img src="<?= base_url('uploads/pesanan/') . $bukti_bayar ?>" class="img-fluid" alt="">
						</div>
					</div>


					<div class="form-group row">
						<div class="col-md-12">
							<button class="btn btn-block btn-flat btn-danger" type="button">Detail Barang Pesanan</button>
						</div>
					</div>

					
					<div class="form-group row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="data-table table stripe hover nowrap" id="example1" style="min-width:100%;">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode Barang</th>
											<th>Nama Barang</th>
											<th>Harga Barang</th>
											<th>Kuantitas</th>
											<th>Subtotal</th>
											<th>Sudah Sampai</th>
											<th>Sudah Diambil</th>
										</tr>
									</thead>
									<tbody></tbody>
									<tfoot>
										<th colspan="5" style="text-align:right !important;">Total :</th>
										<th></th>
									</tfoot>
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
												url: "<?php echo site_url('pesanan/fetch_data_pesanan2'); ?>",
												type: "POST",
												dataSrc: "data",
												data: function(d) {
													d.kode = "<?= $kode_pesanan ?>";
												},
											},
											"columnDefs": [{
												"targets": [0],
												"className": 'text-center'
											}, ],
											"footerCallback": function(row, data, start, end, display) {
												total = this.api()
													.column(5)
													.data()
													.reduce(function(a, b) {
														return parseInt(a) + parseInt(b);
													}, 0);
												// Update footer
												$(dataTable.column(5).footer()).html(
													numberWithCommas(total)
												);
											}
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

									function numberWithCommas(x) {
										return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
									}
								</script>
							</div>
						</div>
					</div>

					<div class="card-footer text-left">
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span><?php echo $button ?></button>
						<a href="<?php echo site_url('pesanan') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>

				</form>

			</div>
		</div>
	</div>
</div>

<script>
	function handleCheckbox(value){
		if(value.checked){
			$.ajax({
				url:"<?=base_url('pesanan/sudah_datang')?>",
				method:"POST",
				dataType:"JSON",
				data:{"id":value.value,"state":value.checked},
				success:function(res){
					alert(res.message);
					dataTable.draw();
				}
			});
		}else{
			$.ajax({
				url:"<?=base_url('pesanan/sudah_datang')?>",
				method:"POST",
				dataType:"JSON",
				data:{"id":value.value,"state":false},
				success:function(res){
					alert(res.message);
					dataTable.draw();
				}
			});
		}
	}
	function handleCheckboxTake(value){
		if(value.checked){
			$.ajax({
				url:"<?=base_url('pesanan/sudah_datang_take')?>",
				method:"POST",
				dataType:"JSON",
				data:{"id":value.value,"state":value.checked},
				success:function(res){
					alert(res.message);
					dataTable.draw();
				}
			});
		}else{
			$.ajax({
				url:"<?=base_url('pesanan/sudah_datang_take')?>",
				method:"POST",
				dataType:"JSON",
				data:{"id":value.value,"state":false},
				success:function(res){
					alert(res.message);
					dataTable.draw();
				}
			});
		}
	}
</script>
