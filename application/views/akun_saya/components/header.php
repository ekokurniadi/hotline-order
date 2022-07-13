<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>User Dashboard</title>

	<!-- Custom fonts for this template-->
	<link href="<?= base_url('akun_saya_assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<!-- Custom styles for this template-->
	  <!-- CSS Libraries -->
	  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

  <!-- load jquery CDN -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<link href="<?= base_url('akun_saya_assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">
	
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/src/plugins/datatables/css/responsive.bootstrap4.min.css"> -->
	<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" /> -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
</head>

<body id="page-top" onload="checkSesion()">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
				<div class="sidebar-brand-icon rotate-n-15">
					<i class="fas fa-laugh-wink"></i>
				</div>
				<div class="sidebar-brand-text mx-3">User Dashboard</div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url() ?>">
					<i class="fas fa-home"></i>
					<span>Kehalaman Utama</span></a>
			</li>

			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item active">
				<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
					<i class="fas fa-fw fa-folder"></i>
					<span>Menu</span>
				</a>
				<div id="collapsePages" class="collapse hide" aria-labelledby="headingPages" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<h6 class="collapse-header">Navigasi</h6>
						<a class="collapse-item <?= $this->uri->segment('2') == 'profile' ? 'active' : '' ?>" href="<?= base_url('akun_saya/profile') ?>">Profil</a>
						<a class="collapse-item <?= $this->uri->segment('2') == 'keranjang' ? 'active' : '' ?> " href="<?= base_url('akun_saya/keranjang') ?>">Keranjang</a>
						<a class="collapse-item <?= $this->uri->segment('2') == 'checkout' ? 'active' : '' ?>" href="<?= base_url('akun_saya/checkout') ?>">Daftar Pesanan</a>
						<a class="collapse-item <?= $this->uri->segment('2') == 'no_rekening' ? 'active' : '' ?>" href="<?= base_url('akun_saya/no_rekening') ?>">Informasi No. Rekening</a>
						<a class="collapse-item <?= $this->uri->segment('2') == 'informasi' ? 'active' : '' ?>" href="<?= base_url('akun_saya/informasi') ?>">Informasi Penting </a>

					</div>
				</div>
			</li>

			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>

		</ul>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>
					<!-- <div style="width: 100%;">
						<h6 class="m-0 font-weight-bold text-danger">Informasi Penting :</h6>
						<?php $info = $this->db->get('informasi')->result(); ?>
						<marquee behavior="" direction="left">
							<?php foreach ($info as $i) : ?>
								<em class="text-dark"><?= $i->urutan ?>. <?= $i->informasi . " &nbsp;&nbsp;&nbsp; " ?></em>
							<?php endforeach; ?>
						</marquee>

					</div> -->
					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">



						<div class="topbar-divider d-none d-sm-block"></div>

						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['nama_lengkap'] ?></span>
								<img class="img-profile rounded-circle" src="<?= base_url('akun_saya_assets/') ?>img/undraw_profile.svg">
							</a>
							<!-- Dropdown - User Information -->
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">


								<a class="dropdown-item" href="<?=base_url('auth_client/logout')?>" data-toggle="modal" data-target="#logoutModal">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
							</div>
						</li>

					</ul>

				</nav>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
				<div class="container-fluid">
					<script src="<?= base_url("js/vue/qs.min.js") ?>" type="text/javascript"></script>
					<script src="<?= base_url("js/vue/vue.min.js") ?>" type="text/javascript"></script>
					<script src="<?= base_url("js/vue/axios.min.js") ?>" type="text/javascript"></script>
					<script src="<?= base_url("js/vue/accounting.js") ?>" type="text/javascript"></script>
					<script src="<?= base_url("js/vue/vue-numeric.min.js") ?>" type="text/javascript"></script>
					<script src="<?= base_url("js/lodash.min.js") ?>" type="text/javascript"></script>
					<script type="text/javascript" src="<?= base_url("js/moment.min.js") ?>"></script>
					<script>
						function checkSesion() {
							var userLogin = '<?= $_SESSION['id'] ?>';
							if (userLogin === "" || userLogin === null || userLogin === undefined) {
								alert('Sesi Login telah berakhir silahkan login kembali!');
								window.location = '<?= base_url() ?>';
							}
						}
					</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div style="margin-top: 8px" id="message">
		<?php
		if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
		?>
			<script>
				Swal.fire({
					icon: '<?php echo $_SESSION['tipe'] ?>',
					title: 'Notification',
					text: '<?php echo $_SESSION['pesan'] ?>',

				})
			</script>
		<?php
		}
		$_SESSION['pesan'] = '';

		?>
	</div>
