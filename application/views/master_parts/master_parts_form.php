<div class="main-container" style="min-height:100%">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Master Parts</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Master Parts</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>

			<div class="pd-20 card-box mb-30">
				<div class="clearfix">
					<div class="pull-left">
						<h4 class="text-blue h4">Form Master Parts </h4>
						<p class="mb-30"></p>
					</div>
				</div>
				<form action="<?php echo $action; ?>" method="post" class="form-horizontal" enctype="multipart/form-data">

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Kode Barang <?php echo form_error('kode_barang') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" name="kode_barang" id="kode_barang" placeholder="Kode Barang" value="<?php echo $kode_barang; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Nama Barang <?php echo form_error('nama_barang') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Foto <?php echo form_error('foto') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="file" class="form-control" name="foto" id="foto" placeholder="Foto" value="<?php echo $foto; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Harga <?php echo form_error('harga') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" />
						</div>
					</div>


					<div class="card-footer text-left">
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span><?php echo $button ?></button>
						<a href="<?php echo site_url('master_parts') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>
				</form>
			</div>
		</div>
	</div>
</div>
