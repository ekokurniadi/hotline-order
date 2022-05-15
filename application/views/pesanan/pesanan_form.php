
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
                            <input type="text" class="form-control" name="kode_pesanan" id="kode_pesanan" placeholder="Kode Pesanan" value="<?php echo $kode_pesanan; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Tanggal Dibuat <?php echo form_error('tanggal_dibuat') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="tanggal_dibuat" id="tanggal_dibuat" placeholder="Tanggal Dibuat" value="<?php echo $tanggal_dibuat; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Id Pelanggan <?php echo form_error('id_pelanggan') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="id_pelanggan" id="id_pelanggan" placeholder="Id Pelanggan" value="<?php echo $id_pelanggan; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Nama Lengkap <?php echo form_error('nama_lengkap') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $nama_lengkap; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Nomor Mesin <?php echo form_error('nomor_mesin') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="nomor_mesin" id="nomor_mesin" placeholder="Nomor Mesin" value="<?php echo $nomor_mesin; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Nomor Plat Kendaraan <?php echo form_error('nomor_plat_kendaraan') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="nomor_plat_kendaraan" id="nomor_plat_kendaraan" placeholder="Nomor Plat Kendaraan" value="<?php echo $nomor_plat_kendaraan; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Foto Stnk <?php echo form_error('foto_stnk') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="foto_stnk" id="foto_stnk" placeholder="Foto Stnk" value="<?php echo $foto_stnk; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Nomor Hp <?php echo form_error('nomor_hp') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="nomor_hp" id="nomor_hp" placeholder="Nomor Hp" value="<?php echo $nomor_hp; ?>" />
                          </div>
                    </div>
	 
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Keterangan <?php echo form_error('keterangan') ?></label>
                        <div class="col-sm-12 col-md-10">
                        <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
                        </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Status <?php echo form_error('status') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Foto Motor <?php echo form_error('foto_motor') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="foto_motor" id="foto_motor" placeholder="Foto Motor" value="<?php echo $foto_motor; ?>" />
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
