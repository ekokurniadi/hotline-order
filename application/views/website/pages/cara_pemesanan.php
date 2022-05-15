<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12 mt-4">
				<h3>Cara Pemesanan</h3>
			</div>
		</div>

	</div>
	</div>
</section>

<div class="container">
	<?php foreach ($data as $rows) : ?>
		<div class="step completed">
			<div class="v-stepper">
				<div class="circle"></div>
				<div class="line"></div>
			</div>

			<div class="content">
				<?= $rows->cara_pemesanan ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
