<div class="main-container" style="min-height:100%">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Katalog Produk</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Katalog Produk</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>

			<div class="pd-20 card-box mb-30">
				<div class="clearfix">
					<div class="pull-left">
						<h4 class="text-blue h4">Form Katalog Produk </h4>
						<p class="mb-30"></p>
					</div>
				</div>
				<form action="<?php echo $action; ?>" method="post" class="form-horizontal" enctype="multipart/form-data">

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Kode Motor <?php echo form_error('kode_motor') ?></label>
						<div class="col-sm-10 col-md-6">
							<input type="text" class="form-control" readonly name="kode_motor" id="kode_motor" placeholder="Kode Motor" value="<?php echo $kode_motor; ?>" />
						</div>
						<div class="col-md-4">
							<button class="btn btn-primary" onclick="openModal();" type="button"><span class="fa fa-search"></span> Search</button>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Tipe Motor <?php echo form_error('tipe_motor') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" readonly name="tipe_motor" id="tipe_motor" placeholder="Tipe Motor" value="<?php echo $tipe_motor; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Tahun Pembuatan <?php echo form_error('tahun_pembuatan') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" readonly name="tahun_pembuatan" id="tahun_pembuatan" placeholder="Tahun Pembuatan" value="<?php echo $tahun_pembuatan; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">No Seri Mesin <?php echo form_error('no_seri_mesin') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" readonly name="no_seri_mesin" id="no_seri_mesin" placeholder="No Seri Mesin" value="<?php echo $no_seri_mesin; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">No Seri Rangka <?php echo form_error('no_seri_rangka') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" readonly name="no_seri_rangka" id="no_seri_rangka" placeholder="No Seri Rangka" value="<?php echo $no_seri_rangka; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Katalog <?php echo form_error('katalog') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="file" class="form-control" name="katalog" id="katalog" placeholder="Katalog" value="<?php echo $katalog; ?>" />
						</div>
					</div>


					<div class="card-footer text-left">
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span><?php echo $button ?></button>
						<a href="<?php echo site_url('katalog_produk') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>

				</form>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('components/modal_search_type'); ?>

<script>
	function openModal() {
		$('#type_kendaraan').modal('show');
	}
</script>


<script>
	function getDataKendaraan(value) {
		$('#kode_motor').val(value.kode_motor);
		$('#tipe_motor').val(value.tipe_motor);
		$('#tahun_pembuatan').val(value.tahun_pembuatan);
		$('#no_seri_mesin').val(value.no_seri_mesin);
		$('#no_seri_rangka').val(value.no_seri_rangka);
	}
</script>
