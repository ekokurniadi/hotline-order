<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">

				<div class="carousel-inner">
					<?php foreach ($slide_show as $keys => $value) : ?>
						<div class="carousel-item <?php echo $keys == 0 ? "active" : "" ?>">
							<img src="<?= base_url('uploads/slide_show/') . $value['gambar'] ?>" width="120px" class="img-c d-block w-100" alt="...">
							<div class="carousel-caption d-none d-md-block">
								<h5><?= $value['judul'] ?></h5>
								<p><?= $value['deskripsi'] ?></p>
							</div>
						</div>
					<?php endforeach; ?>


				</div>
				<button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</button>
			</div>

		</div>
	</div>
</div>
<style>
	.carousel-control-prev {
		background-color: transparent !important;
		border: none !important;
	}

	.carousel-control-next {
		background-color: transparent !important;
		border: none !important;
	}
</style>
