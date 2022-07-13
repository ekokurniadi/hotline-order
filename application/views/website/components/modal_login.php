<section class="contact_us">
	<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: red;">
					<img src="<?php echo base_url('uploads/logo/honda-white.png') ?>" width="50%" alt="">
					<h5 class="modal-title text-white" id="modalLoginLabel">Login ke Akun Anda</h5>
					<button type="button" class="btn btn-warning" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table style="vertical-align: top;" width="100%">
						<form method="POST" action="<?= base_url('auth_client') ?>" class="needs-validation" novalidate="">
							<form accept-charset="UTF-8" role="form" class="form-signin">
								<tr>
									<td><input type="text" required autocomplete="off" class="tanya" name="username" id="username" placeholder="Username"></td>
								</tr>
								<tr>
									<td><input type="password" required autocomplete="off" class="tanya" name="password" id="password" placeholder="Password"></td>
								</tr>
								<tr>
									<td><input type="checkbox" onclick="ToggleLogin()" class="tanya" name="password"  placeholder="Password">
										<label for="" style="font-size: 10pt;">Show Password</label>
									</td>
								</tr>
								<tr>
									<td>
										<button type="submit" id="submitMessage" class="btn btn-flat btn-primary mt-2"><span class="fa fa-lock"></span> Login</button>
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
	function ToggleLogin() {
		var temp = document.getElementById("password");
		if (temp.type === "password") {
			temp.type = "text";
		} else {
			temp.type = "password";
		}
	}
</script>
