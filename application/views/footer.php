	<footer style="position: static;bottom:0;left:0;right:0;margin-top:10px">
		<div class="footer-wrap pd-20 mb-20 card-box">
		 Copyright &copy;2022
		</div>
	</footer>
	<!-- js -->
	<script src="<?php echo base_url() ?>assets/vendors/scripts/core.js"></script>
	<script src="<?php echo base_url() ?>assets/vendors/scripts/script.min.js"></script>
	<script src="<?php echo base_url() ?>assets/vendors/scripts/process.js"></script>
	<script src="<?php echo base_url() ?>assets/vendors/scripts/layout-settings.js"></script>
	<script src="<?php echo base_url() ?>assets/src/plugins/apexcharts/apexcharts.min.js"></script>

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
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
	</body>

	</html>
