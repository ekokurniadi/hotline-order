</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
	<div class="container my-auto">
		<div class="copyright text-center my-auto">
			<span>Copyright &copy; Your Website 2020</span>
		</div>
	</div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<a class="btn btn-primary" href="<?=base_url('auth_client/logout')?>">Logout</a>
			</div>
		</div>
	</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('akun_saya_assets/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('akun_saya_assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('akun_saya_assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('akun_saya_assets/') ?>js/sb-admin-2.min.js"></script>

<script src="<?php echo base_url() ?>assets/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>assets/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>

<!-- buttons for Export datatable -->
<script src="<?php echo base_url() ?>assets/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url() ?>assets/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/src/plugins/datatables/js/buttons.print.min.js"></script>
<script src="<?php echo base_url() ?>assets/src/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url() ?>assets/src/plugins/datatables/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url() ?>assets/src/plugins/datatables/js/pdfmake.min.js"></script>
<script src="<?php echo base_url() ?>assets/src/plugins/datatables/js/vfs_fonts.js"></script>
<!-- Datatable Setting js -->
<!-- add sweet alert js & css in footer -->
<!-- <script src="<?php echo base_url() ?>assets/vendors/scripts/dashboard3.js"></script> -->
<script src="<?php echo base_url() ?>assets/src/plugins/sweetalert2/sweetalert2.all.js"></script>
<script src="<?php echo base_url() ?>assets/src/plugins/sweetalert2/sweet-alert.init.js"></script>
<script>
	function validationError() {
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Silahkan isi data dengan lengkap !',

		});
	}
</script>
</body>

</html>
