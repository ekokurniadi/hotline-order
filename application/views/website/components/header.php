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
	</style>
</head>

<body>
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
						<a class="nav-link" href="#">Cara Pemesanan</a>
					</li>
					<?php if (isset($_SESSION['user_id']) != null || isset($_SESSION['user_id']) != '') {
						echo ($_SESSION['user_id']);
					?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
								Shopping
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
								<a class="dropdown-item" href="#">Keranjang</a>
								<a class="dropdown-item" href="#">Checkout</a>
								<a class="dropdown-item" href="#">Akun Saya</a>
								<a class="dropdown-item" href="#">Logout</a>
								<a class="dropdown-item" href="#">Pesan</a>
							</div>
						</li>
					<?php } else { ?>
						<li class="nav-item">
							<a class="nav-link" href="#" onclick="openModalLogin();">Login</a>

						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Daftar</a>

						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</nav>
	<!-- end of navbar -->
	<?php $this->load->view('website/components/modal_login') ?>

	<script>
		function openModalLogin() {
			$('#modalLogin').modal('show');
		}
	</script>
