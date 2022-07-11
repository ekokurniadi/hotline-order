<div class="main-container" style="min-height:100%">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Profil Perusahaan</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Profil Perusahaan</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>

			<div class="pd-20 card-box mb-30">
				<div class="clearfix">
					<div class="pull-left">
						<h4 class="text-blue h4">Form Profil Perusahaan </h4>
						<p class="mb-30"></p>
					</div>
				</div>
				<form action="<?php echo $action; ?>" method="post" class="form-horizontal" enctype="multipart/form-data">

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Logo <?php echo form_error('logo') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="file" class="form-control" name="logo" id="logo" placeholder="Logo" value="<?php echo $logo; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Alamat <?php echo form_error('alamat') ?></label>
						<div class="col-sm-12 col-md-10">
							<textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Whatsapp Admin <?php echo form_error('logo') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" name="whatsapp_admin" id="whatsapp_admin" placeholder="whatsapp_admin" value="<?php echo $logwhatsapp_admino; ?>" />
						</div>
					</div>


					<div class="card-footer text-left">
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span><?php echo $button ?></button>
						<a href="<?php echo site_url('profil_perusahaan') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>

				</form>
			</div>
		</div>
	</div>
</div>
