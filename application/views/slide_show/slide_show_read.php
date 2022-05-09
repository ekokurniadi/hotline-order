
<div class="main-container" style="min-height:100%">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Slide Show</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Slide Show</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Form Slide Show </h4>
                        <p class="mb-30"></p>
                    </div>
                </div>
                <form action="" method="post" class="form-horizontal">
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Gambar <?php echo form_error('gambar') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" readonly name="gambar" id="gambar" placeholder="Gambar" value="<?php echo $gambar; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Judul <?php echo form_error('judul') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" readonly name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Deskripsi <?php echo form_error('deskripsi') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" readonly name="deskripsi" id="deskripsi" placeholder="Deskripsi" value="<?php echo $deskripsi; ?>" />
                          </div>
                    </div>
	
            
        <div class="card-footer text-left">
        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <a href="<?php echo site_url('slide_show') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>
	
          </form>
          </div>
      </div>
  </div>
</div>
