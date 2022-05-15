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

		<div class="button-buy mt-2 ml-2 mb-2 text-center">
			<button id="btnSubmit<?= $detail->id ?>" class="btn btn-danger btn-block btn-sm rounded" onclick="addKeranjang(<?= $detail->id ?>);">Masukkan ke Keranjang</button>
		</div>
	</div>
</div>

<script>
	function addKeranjang(id) {
		var login = '<?= $_SESSION['role'] ?>';
		if (login == "" || login != "user") {
			openModalLogin();
		} else {
			prosesKeranjang(id);
		}
	}

	function prosesKeranjang(id) {
		$.ajax({
			url: '<?= base_url('website/keranjang_add') ?>',
			type: 'POST',
			data: {
				id: id
			},
			dataType: 'JSON',
			beforeSend: function() {
				$('#btnSubmit' + id).html('Process');
			},
			success: function(response) {
				if (response.status == 200) {
					alert(response.message);
					getKeranjang();
					$('#btnSubmit' + id).html('Masukkan ke Keranjang');
				}
			},
			error: function() {
				alert("Something Went Wrong !");
			}
		});
	}
</script>
