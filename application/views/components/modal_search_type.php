<div class="modal fade" id="type_kendaraan" tabindex="-1" aria-labelledby="type_kendaraan" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Type Kendaraan</h5>
				<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="data-table table stripe hover nowrap" id="example1" style="min-width:100%;">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Motor</th>
								<th>Tipe Motor</th>
								<th>Tahun Pembuatan</th>
								<th>No Seri Mesin</th>
								<th>No Seri Rangka</th>
								<th>Action</th>
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
									url: "<?php echo site_url('tipe_kendaraan/fetch_data_modal'); ?>",
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
				</div>
			</div>
		</div>
	</div>
</div>
