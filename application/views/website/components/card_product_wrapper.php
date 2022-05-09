<?php
$batas = 16;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
$previous = $halaman - 1;
$next = $halaman + 1;

$all_data = $this->db->query("SELECT * FROM master_parts");
$jumlah_data = $all_data->num_rows();
$jumlah_halaman = ceil($jumlah_data / $batas);

if (isset($_POST['tombol_search'])) {
	$cari = $_POST['search'];
	$_SESSION['search'] = $cari;
} else {
	$cari = $_SESSION['search'];
}
if (isset($_POST['tombol_reset'])) {
	$cari = "";
	$_SESSION['search'] = $cari;
} else {
	$cari = $_SESSION['search'];
}

$where = "WHERE 1=1 ";

if ($cari != '') {
	$where .= " AND (kode_barang like '%$cari%' OR nama_barang like '%$cari%') ";
} else {
	$where .= " ";
}
$data = $this->db->query("SELECT * FROM master_parts $where LIMIT $halaman_awal, $batas")->result();

$nomor = $halaman_awal + 1;

$jumlah_link = 3;
if ($halaman > $jumlah_link) {
	$start_number = $halaman - $jumlah_link;
	if ($halaman - $jumlah_link == 1) {
		$dot_start = "";
	} else {
		$dot_start = "...";
	}
} else {
	$dot_start = "";
	$start_number = 1;
}

if ($halaman < ($jumlah_halaman - $jumlah_link)) {
	$end_number = $halaman + $jumlah_link;

	$dot_end = "...";
} else {
	$dot_end = "";

	$end_number = $jumlah_halaman;
}

?>
<div class="container">
	<div class="row">
		<div class="col-md-6 offset-md-6 justify-content-end">
			<p>
			<form action="" method="post">
				<div class="col-md-6 p-0">
					<label for="">Pencarian Barang</label>
				</div>
				<div class="input-group">
					<input type="text" class="form-control" value="<?= $cari ?>" placeholder="Pencarian Barang" name="search">
					<div class="input-group-append">
						<input class="btn btn-primary" name="tombol_search" value="Search" type="submit" />
						<input class="btn btn-warning" name="tombol_reset" value="Reset" type="submit" />
					</div>
				</div>
			</form>
			</p>
		</div>
	</div>
	<div class="row">
		<?php foreach ($data as $rows) : ?>
			<?php $d['detail'] = $rows ?>
			<div class="col-md-3">
				<?php $this->load->view('website/components/card_product', $d) ?>
			</div>
		<?php endforeach; ?>
	</div>


</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-3">
			<nav>
				<ul class="pagination pagination-sm justify-content-center">
					<li class="page-item">
						<a class="page-link" <?php if ($halaman > 1) {
													echo "href='?halaman=$previous'";
												} ?>>Previous</a>
					</li>
					<?php if ($dot_start != "") { ?>
						<li class="page-item">
							<a class="page-link"><?= $dot_start ?></a>

						</li>
					<?php } ?>
					<?php
					for ($x = $start_number; $x <= $end_number; $x++) {
					?>


						<li class="page-item <?php echo $x == $halaman ? 'active' : '' ?>"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>

					<?php
					}
					?>
					<?php if ($dot_end != "") { ?>
						<li class="page-item">
							<a class="page-link"><?= $dot_end ?></a>
						</li>
					<?php } ?>
					<li class="page-item">
						<a class="page-link" <?php if ($halaman < $jumlah_halaman) {
													echo "href='?halaman=$next'";
												} ?>>Next</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</div>
