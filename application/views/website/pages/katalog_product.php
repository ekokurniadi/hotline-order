<section class="katalog_produk">
	<div class="container">
		<div class="row">
			<div class="col-md-12 mt-4">
				<h5>Katalog Suku Cadang Motor Honda<br>
					Berikut adalah katalog suku cadang motor Honda yang bisa anda download dan lihat.</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 mt-2">
				<div class="table-responsive">
					<table class="table table-bordered" id="katalog_table">
						<thead>
							<th>No</th>
							<th>Kode Motor</th>
							<th>Tipe Motor</th>
							<th>Tahun Pembuatan</th>
							<th>No Seri Mesin</th>
							<th>No Seri Rangka</th>
							<th>Katalog</th>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function() {
		dataTable = $('#katalog_table').DataTable({
			"processing": true,
			"serverSide": true,
			"scrollX": false,
			"language": {
				"infoFiltered": "",
				"processing": "<td style='text-align:center;width:100%;display:block;'><i class='fa fa-spinner fa-spin' style='font-size:80px'></i> </td>",
			},
			"order": [],
			"lengthMenu": [
				[10, 25, 50, 75, 100],
				[10, 25, 50, 75, 100]
			],
			"ajax": {
				url: "<?php echo site_url('website/fetch_katalog'); ?>",
				type: "POST",
				dataSrc: "data",
				data: function(d) {
					return d;
				},
			},
			"columnDefs": [{
				"targets": [0],
				"className": 'text-center'
			}, ],
		});
		dataTable.on('draw.dt', function() {
			var info = dataTable.page.info();
			dataTable.column(0, {
				search: 'applied',
				order: 'applied',
				page: 'applied'
			}).nodes().each(function(cell, i) {
				cell.innerHTML = i + 1 + info.start + ".";
			});
		});
	});
</script>
