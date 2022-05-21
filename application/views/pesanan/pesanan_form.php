
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
                        <label class="col-sm-12 col-md-2 col-form-label">Alamat <?php echo form_error('alamat') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">No Mesin <?php echo form_error('no_mesin') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="no_mesin" id="no_mesin" placeholder="No Mesin" value="<?php echo $no_mesin; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">No Rangka <?php echo form_error('no_rangka') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="no_rangka" id="no_rangka" placeholder="No Rangka" value="<?php echo $no_rangka; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">No Polisi <?php echo form_error('no_polisi') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="no_polisi" id="no_polisi" placeholder="No Polisi" value="<?php echo $no_polisi; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">No Telepon <?php echo form_error('no_telepon') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="no_telepon" id="no_telepon" placeholder="No Telepon" value="<?php echo $no_telepon; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Foto Stnk <?php echo form_error('foto_stnk') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="foto_stnk" id="foto_stnk" placeholder="Foto Stnk" value="<?php echo $foto_stnk; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Foto Motor <?php echo form_error('foto_motor') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="foto_motor" id="foto_motor" placeholder="Foto Motor" value="<?php echo $foto_motor; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Status <?php echo form_error('status') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Tahun Perakitan <?php echo form_error('tahun_perakitan') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="tahun_perakitan" id="tahun_perakitan" placeholder="Tahun Perakitan" value="<?php echo $tahun_perakitan; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Is Payment <?php echo form_error('is_payment') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="is_payment" id="is_payment" placeholder="Is Payment" value="<?php echo $is_payment; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Is Come <?php echo form_error('is_come') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="is_come" id="is_come" placeholder="Is Come" value="<?php echo $is_come; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Bukti Bayar <?php echo form_error('bukti_bayar') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="bukti_bayar" id="bukti_bayar" placeholder="Bukti Bayar" value="<?php echo $bukti_bayar; ?>" />
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
