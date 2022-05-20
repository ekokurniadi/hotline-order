<section class="contact_us">
	<div class="modal fade" id="modalRegister" tabindex="-1" aria-labelledby="modalRegisterLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: red;">
					<img src="<?php echo base_url('uploads/logo/honda-white.png') ?>" width="50%" alt="">
					<h5 class="modal-title text-white" id="modalRegisterLabel">Mendaftar Akun Baru</h5>
					<button type="button" class="btn btn-warning" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table style="vertical-align: top;" width="100%">
						<form method="POST" action="<?= base_url('auth_client/register') ?>" class="needs-validation" novalidate="">
							<form accept-charset="UTF-8" role="form" class="form-signin">
								<tr>
									<td><input type="text" required class="tanya" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap"></td>
								</tr>
								<tr>
									<td>
										<select name="jenis_kelamin" id="jenis_kelamin" class="tanya">
											<option value="">Select an option</option>
											<option value="Laki-Laki">Laki-Laki</option>
											<option value="Perempuan">Perempuan</option>
										</select>
									</td>
								</tr>
								<tr>
									<td><input type="text" required class="tanya" name="no_telepon" id="no_telepon" placeholder="No.Hp"></td>
								</tr>
								<tr>
									<td><input type="text" required class="tanya" name="alamat" id="alamat" placeholder="Alamat"></td>
								</tr>
								<tr>
									<td><input type="text" required class="tanya" name="username" id="username" placeholder="Email"></td>
								</tr>
								<tr>
									<td><input type="password" required class="tanya" name="password" id="password" placeholder="Password"></td>
								</tr>
								<tr>
									<td><input type="checkbox" onclick="Toggle()" class="tanya" name="password" id="password" placeholder="Password">
										<label for="" style="font-size: 10pt;">Show Password</label>
									</td>
								</tr>

								<tr>
									<td>
										<button type="submit" id="submitMessage" class="btn btn-flat btn-primary mt-2"><span class="fa fa-lock"></span> Daftar</button>
									</td>
								</tr>
					</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	// Change the type of input to password or text
	function Toggle() {
		var temp = document.getElementById("password");
		if (temp.type === "password") {
			temp.type = "text";
		} else {
			temp.type = "password";
		}
	}
</script>
