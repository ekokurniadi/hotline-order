
<div class="main-container" style="min-height:100%">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>User</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">User</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Form User </h4>
                        <p class="mb-30"></p>
                    </div>
                </div>
                <form action="" method="post" class="form-horizontal">
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Nama Lengkap <?php echo form_error('nama_lengkap') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" readonly name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $nama_lengkap; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" readonly name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin" value="<?php echo $jenis_kelamin; ?>" />
                          </div>
                    </div>
	 
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Alamat <?php echo form_error('alamat') ?></label>
                        <div class="col-sm-12 col-md-10">
                        <textarea class="form-control" rows="3" readonly name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
                        </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">No Hp <?php echo form_error('no_hp') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" readonly name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $no_hp; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Username <?php echo form_error('username') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" readonly name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Password <?php echo form_error('password') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" readonly name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Role <?php echo form_error('role') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" readonly name="role" id="role" placeholder="Role" value="<?php echo $role; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Status <?php echo form_error('status') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" readonly name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                          </div>
                    </div>
	
            
        <div class="card-footer text-left">
        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <a href="<?php echo site_url('user') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>
	
          </form>
          </div>
      </div>
  </div>
</div>
