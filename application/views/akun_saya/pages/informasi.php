<div class="card shadow mb-4">
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-primary">Daftar Informasi Penting</h6>
	</div>
	<div class="card-body">
		<div class="container">
			<div class="row">
				<div class="col-md-12 mt-3">
					<div class="table-responsive">
						<table class="data-table table stripe hover nowrap" id="example1" style="min-width:100%;">
							<thead>
								<tr>
									<th>No</th>
									<th style="display: none !important">Urutan</th>
									<th>Informasi</th>
									<th style="display: none;">Action</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
						<script>
							$(document).ready(function() {
								dataTable = $('#example1').DataTable({
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
										url: "<?php echo site_url('informasi/fetch_data'); ?>",
										type: "POST",
										dataSrc: "data",
										data: function(d) {
											return d;
										},
									},
									"columnDefs": [
										{
										"targets": [0],
										"className": 'text-center'
									},
										{
										"targets": [1],
										"className": 'text-center',
										visible: false,
									},
								 ],
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
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
