<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Dashboard</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url() ?>assets/vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url() ?>assets/vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/src/plugins/sweetalert2/sweetalert2.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendors/styles/style.css">
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
	<script src="<?= base_url("js/vue/qs.min.js") ?>" type="text/javascript"></script>
	<script src="<?= base_url("js/vue/vue.min.js") ?>" type="text/javascript"></script>
	<script src="<?= base_url("js/vue/axios.min.js") ?>" type="text/javascript"></script>
	<script src="<?= base_url("js/vue/accounting.js") ?>" type="text/javascript"></script>
	<script src="<?= base_url("js/vue/vue-numeric.min.js") ?>" type="text/javascript"></script>
	<script src="<?= base_url("js/lodash.min.js") ?>" type="text/javascript"></script>
	<script type="text/javascript" src="<?= base_url("js/moment.min.js") ?>"></script>
	<script type="text/javascript" src="<?= base_url("js/daterangepicker.min.js") ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?= base_url("js/daterangepicker.css") ?>" />
	<script>
		Vue.use(VueNumeric.default);
		Vue.filter('toCurrency', function(value) {
			return accounting.formatMoney(value, "", 0, ".", ",");
			return value;
		});
	</script>
</head>
<?php if ($_SESSION['role'] == "" || $_SESSION['role'] == "user") {
	redirect('auth/logout');
} ?>

<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo" style="justify-content: center;display:flex"><img src="<?php echo base_url() ?>assets/vendors/images/logo-red.png" width="10%" align="center" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>

	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			<div class="header-search">
				<form>
					<div class="form-group mb-0">
						<i class="dw dw-search2 search-icon"></i>
						<input type="text" class="form-control search-input" placeholder="Search Here">
						<div class="dropdown">
							<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
								<i class="ion-arrow-down-c"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">From</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">To</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">Subject</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="text-right">
									<button class="btn btn-primary">Search</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			</div>
			<div class="user-notification">
				<div id="expand" class="dropdown">
					<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
						<i class="icon-copy dw dw-notification"></i>
						<span id="badge" class="notification-active"></span>
					</a>
					<div id="menu-right" class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<ul class="dropdown-notif">

							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="<?php echo base_url() ?>assets/vendors/images/photo1.jpg" alt="">
						</span>
						<span class="user-name"><?= $_SESSION['nama_lengkap'] ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="<?php echo base_url() ?>panel/profile"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="<?php echo base_url() ?>auth/logout"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>

		</div>
	</div>

	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
				<div class="sidebar-radio-group pb-10 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
					</div>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
				<div class="sidebar-radio-group pb-30 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
					</div>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">Reset Settings</button>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.html">
				<img src="<?php echo base_url() ?>assets/vendors/images/logo-red.png" width="20%" alt="" class="dark-logo">
				<img src="<?php echo base_url() ?>assets/vendors/images/logo-red.png" width="20%" alt="" class="light-logo">
				<span style="font-size: 8pt;">MEGA WAHANA PESONA</span>
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href="<?= base_url('panel') ?>" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
						</a>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-option="off">
							<span class="micon dw dw-library"></span><span class="mtext">Master Data</span>
						</a>
						<ul class="submenu">
							<li><a href="<?php echo base_url('user') ?>">User</a></li>
							<li><a href="<?php echo base_url('pelanggan') ?>">Pelanggan</a></li>
							<li><a href="<?php echo base_url('tipe_kendaraan') ?>">Tipe Kendaraan</a></li>
							<li><a href="<?php echo base_url('master_parts') ?>">Parts</a></li>
							<li><a href="<?php echo base_url('katalog_produk') ?>">Katalog Produk</a></li>
							<li><a href="<?php echo base_url('profil_perusahaan') ?>">Profil Perusahaan</a></li>
							<li><a href="<?php echo base_url('slide_show') ?>">Slide Show</a></li>
							<li><a href="<?php echo base_url('cara_pemesanan') ?>">Cara Pemesanan</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-option="off">
							<span class="micon dw dw-money"></span><span class="mtext">Transaksi</span>
						</a>
						<ul class="submenu">
							<li><a href="<?php echo base_url('pesanan') ?>">Pesanan</a></li>
							<li><a href="<?php echo base_url('chat') ?>">Chat</a></li>
						</ul>
					</li>

				</ul>
			</div>
		</div>
	</div>

	<div class="mobile-menu-overlay"></div>

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

	<script>
		$(document).ready(function() {
			getPengumuman();
			setInterval(getPengumuman, 5000);

		})

		function getPengumuman() {
			$.ajax({
				url: "<?php echo site_url('api/getNotificationAdmin'); ?>",
				cache: false,
				type: "POST",
				dataType: 'JSON',
				success: function(response) {
					showPengumuman(response);
					if (response.data.length > 0) {
						$('#badge').attr('class', 'badge');

					} else {
						$('#badge').removeClass('class', 'badge');

						$(".dropdown-notif").html('');
						var html = '';
						html += "<li>Tidak ada Notifikasi</li>";
						$(".dropdown-notif").append(html);
					}
				},
			});
		}

		function showPengumuman(response) {
			$(".dropdown-notif").html('');
			var html = '';
			for (rsp of response.data) {
				html += "<li><a href='" + rsp[2] + "' onclick='updateNotif(rsp[0])'><span class='icon-copy dw dw-message-1'></span><h3>" + '<?= "Hai " . $_SESSION['nama'] ?>' + "</h3><p>" + rsp[3] + "</p><em style='font-size:12px'> <i class='fa fa-history'></i> " + rsp[1] + "</em></a></li>";

			}

			$(".dropdown-notif").append(html);
		}

		function updateNotif(id) {
			$.ajax({
				url: '<?= base_url('api/updateNotif') ?>',
				type: 'POST',
				cache: false,
				data: {
					id: id
				},
				success: function(response) {
					// alert(response);
				}
			});
		}
	</script>
