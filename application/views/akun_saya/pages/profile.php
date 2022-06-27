<div class="card shadow mb-4">
	<div class="card-header ">
		<h6 class="m-0 font-weight-bold text-primary">Profil Saya</h6>
		<h5 class="m-0 font-weight-bold text-danger text-center"><?php echo $_SESSION['pesan']?></h5>
	</div>
	<div class="card-body">
		<form action="<?=base_url('akun_saya/save_profile')?>" method="post">
			<div class="col-md-12  m-2">
				<label for="" class="col-md-2 font-weight-bold text-dark">Nama Lengkap</label>
				<div class="col-md-12">
					<input type="text" class="form-control"name="nama_lengkap" value="<?=$nama_lengkap?>">
				</div>
			</div>
			<div class="col-md-12  m-2">
				<label for="" class="col-md-2 font-weight-bold text-dark">Jenis Kelamin</label>
				<div class="col-md-12">
					<select name="jenis_kelamin" id="" class="form-control">
						<option value="<?=$jenis_kelamin?>"><?=$jenis_kelamin?></option>
						<option value="Laki-Laki">Laki-Laki</option>
						<option value="Perempuan">Perempuan</option>
					</select>
				</div>
			</div>
			<div class="col-md-12  m-2">
				<label for="" class="col-md-2 font-weight-bold text-dark">Alamat</label>
				<div class="col-md-12">
					<input type="text" class="form-control" name="alamat" value="<?=$alamat?>">
				</div>
			</div>
			<div class="col-md-12  m-2">
				<label for="" class="col-md-2 font-weight-bold text-dark">Username</label>
				<div class="col-md-12">
					<input type="text" class="form-control" readonly name="username" value="<?=$username?>">
				</div>
			</div>
			<div class="col-md-12  m-2">
				<label for="" class="col-md-2 font-weight-bold text-dark">Password</label>
				<div class="col-md-12">
					<input type="text" class="form-control" name="password" value="<?=$password?>">
				</div>
			</div>
			<div class="col-md-12 m-2">
				<input type="hidden" name="id" value="<?=$id?>">
				<button class="btn btn-primary">Simpan</button>
			</div>
		</form>
	</div>
</div>
