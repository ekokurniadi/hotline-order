<div class="card-product shadow">
	<div class="card-product-image">
		<img src="<?= $detail->foto  == "" ? base_url('uploads/parts/no_image.jpg') : base_url('uploads/parts/') . $detail->foto  ?>" alt="">
	</div>
	<div class="card-content">
		<div class="card-product-brand py-2">
			<span><?= $detail->kode_barang ?></span>
		</div>
		<div class="card-product-brand mb-2">
			<span><?= $detail->nama_barang ?></span>
		</div>

		<div class="card-product-price">
			Rp <?= number_format($detail->harga, 0, ',', '.') ?>
		</div>

		<div class="button-buy mt-2 ml-2 mb-2">
			<button class="btn btn-danger btn-sm rounded" onclick="checkLogin();">Pesan Sekarang</button>
		</div>
	</div>
</div>

<script>
	function checkLogin() {
		var login = "<?= isset($_SESSION['user_id']) ?>";

		if (login == "") {
			openModalLogin();
		}
	}
</script>
