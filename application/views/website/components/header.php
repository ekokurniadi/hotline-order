<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap CSS -->
	<!-- General CSS Files -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	<!-- CSS Libraries -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

	<!-- load jquery CDN -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">

	<title>Website</title>

	<style>
		.nav-link {
			color: white !important;
		}

		.carousel-item {
			height: 70vh;
			width: 100%;
		}

		.img-c {
			height: 100%;
			width: 100%;
			object-fit: cover;
			object-position: center;
		}

		.badge {
			position: absolute;
			top: 7px;
			background: yellow;
		}

		.float {
			position: fixed;
			width: 150px;
			height: 37;
			bottom: 40px;
			right: 40px;
			background-color: #25d366;
			padding-bottom: 13px;
			color: #FFF;
			border-radius: 50px;
			text-align: center;
			font-size: 30px;
			box-shadow: 2px 2px 3px #999;
			z-index: 100;
			display: flex;
			align-items: center;
			justify-content: center;
			text-decoration: none;
		}

		.float:hover{
			text-decoration: none;
			color: white;
		}

		.tanya {
			align-self: center;
			font-size: 15px;
			margin-top: 12px;
			margin-left: 10px;

		}

		.my-float {
			margin-top: 16px;
		}
	</style>
</head>

<body onload="getKeranjang();">
	<!-- navbar -->
	<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #c01d02;">
		<div class="container">

			<a class="navbar-brand" href="#">
				<img src="<?php echo base_url('uploads/logo/honda-white.png') ?>" alt="" style="width:150px;">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse " id="navbarNavDropdown">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a class="nav-link" href="<?= base_url('website') ?>">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('website/katalog') ?>">Katalog Produk</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('website/cara_pemesanan') ?>">Cara Pemesanan</a>
					</li>


					<?php if (isset($_SESSION['id']) != null || isset($_SESSION['id']) != '' && isset($_SESSION['role']) == "user") {

					?>

						<li class="nav-item">
							<a class="nav-link" href="<?= base_url('akun_saya/keranjang') ?>">
								<i class="fa fa-shopping-cart"></i>
								Keranjang
							</a>
							<span class="badge" id="badge"></span>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url('akun_saya') ?>">
								<i class="fa fa-user"></i> Akun Saya
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" onclick="return confirm('Anda yakin ingin logout?')" href="<?= base_url('auth_client/logout') ?>">
								<i class="fa fa-sign-out"></i>
							</a>
						</li>
					<?php } else { ?>
						<li class="nav-item">
							<a class="nav-link" href="#" onclick="openModalLogin();">Login</a>

						</li>
						<li class="nav-item">
							<a class="nav-link" href="#" onclick="openModalRegister();">Daftar</a>

						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</nav>
	<!-- end of navbar -->
	<?php $this->load->view('website/components/modal_login') ?>
	<?php $this->load->view('website/components/modal_register') ?>

	<script>
		function openModalLogin() {
			$('#modalLogin').modal('show');
		}

		function openModalRegister() {
			$('#modalRegister').modal('show');
		}

		$('#nx').on('click', function(w) {
			$('.dropdown').toggleClass('show');
			$('.dropdown-menu').toggleClass('show');
		});

		function getKeranjang() {
			$.ajax({
				url: '<?= base_url('website/get_keranjang') ?>',
				type: 'POST',
				data: {
					id: '<?= $_SESSION['id'] ?>'
				},
				dataType: 'JSON',
				success: function(response) {
					$('#badge').html(response.total);
				},
				error: function() {
					alert("Something Went Wrong !");
				}
			});
		}
	</script>

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

<?php $data = $this->db->get('profil_perusahaan')->row();?>
	<a href="https://wa.me/<?=$data->whatsapp_admin?>?text=Hallo Admin, saya memerlukan bantuan." class="float" target="_blank">
		<i class="fa fa-whatsapp my-float"></i>
		<span class="tanya">Tanya Admin</span>
	</a>
