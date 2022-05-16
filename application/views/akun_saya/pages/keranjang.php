<script>
	Vue.use(VueNumeric.default);
	Vue.filter('toCurrency', function(value) {
		return accounting.formatMoney(value, "", 0, ".", ",");
		return value;
	});
</script>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Keranjang Belanja</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive" id="form_">
			<table class="table table-bordered">
				<tr>
					<th style="width: 20px;"><input type="checkbox" @click="selectAll" v-model="allSelected"></th>
					<th>Kode Barang</th>
					<th>Nama Barang</th>
					<th>Harga</th>
					<th style="text-align: center;">Kuantitas</th>
					<th>Subtotal</th>
					<th>Aksi</th>
				</tr>
				<tbody>
					<tr v-for="(p,index) of parts">
						<td class="text-center"><input type="checkbox" v-model="itemIds" :value="p"></td>
						<td>{{p.kode_barang}}</td>
						<td>{{p.nama_barang}}</td>
						<td>{{p.harga_barang | toCurrency}}</td>
						<td style="width: 20px;">
							<input type="number" @keypress="isNumber($event)" class="form-control" v-model="p.qty_pesanan" :empty-value="1">
						</td>
						<td>{{subtotal(p) | toCurrency}}</td>
						<td>
							<button @click.prevent="delDetails(index)" type="button" class="btn btn-danger btn-xs btn-flat"><i class="fa fa-trash"></i></button>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="6" style="text-align: right;font-weight:bold;">Total</th>
						<th>{{total |toCurrency}}</th>
					</tr>
					<tr>
						<th colspan="7" style="text-align: right;">
							<button class="btn btn-primary btn-md" type="button" id="checkoutBtn">Checkout</button>
						</th>
					</tr>
				</tfoot>
			</table>

		</div>
	</div>
</div>


<?php $parts = $this->db->get_where('keranjang', ['id_user' => $_SESSION['id']])->result(); ?>
<style>
	label {
		font-weight: bold;
		margin-top: 10px;
	}
</style>
<div class="modal fade" id="modalCheckout" tabindex="-1" aria-labelledby="modalCheckout" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-danger" id="exampleModalLabel">Mohon untuk melengkapi Form Order</h5>
				<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" id="form_checkout" class="needs-validation" novalidate="" enctype="multipart/form-data">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<h5 class="modal-title text-primary" id="exampleModalLabel" style="font-weight: bold;">Form Order</h5>
							</div>
							<div class="col-md-3">
								<label for="">Nama Lengkap</label>
								<input type="text" class="form-control" placeholder="Nama Lengkap" required value="<?= $_SESSION['nama_lengkap'] ?>">
							</div>
							<div class="col-md-3">
								<label for="">No. Telpon</label>
								<input type="text" class="form-control" placeholder="No Telpon" required value="<?= $_SESSION['no_hp'] ?>">
							</div>
							<div class="col-md-6">
								<label for="">Alamat</label>
								<input type="text" class="form-control" placeholder="Alamat" required value="<?= $_SESSION['alamat'] ?>">
							</div>
							<div class="col-md-3">
								<label for="">No. Mesin</label>
								<input type="text" class="form-control" placeholder="No. Mesin" required name="no_mesin" id="no_mesin">
							</div>
							<div class="col-md-3">
								<label for="">No. Rangka</label>
								<input type="text" class="form-control" placeholder="No. Rangka" required name="no_rangka" id="no_rangka">
							</div>
							<div class="col-md-3">
								<label for="">No. Polisi</label>
								<input type="text" class="form-control" placeholder="No. Polisi" required name="no_polisi" id="no_polisi">
							</div>
							<div class="col-md-3">
								<?php $years = range(1900, strftime("%Y", time())); ?>
								<label for="">Tahun Perakitan</label>
								<select name="tahun_perakitan" class="form-control">
									<option>Select Year</option>
									<?php foreach ($years as $year) : ?>
										<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
									<?php endforeach; ?>
								</select>

							</div>
							<div class="col-md-6">
								<label for="">Upload Foto STNK</label>
								<input type="file" ref="file1" @change="selectImage" class="form-control">
							</div>
							<div class="col-md-6">
								<label for="">Upload Foto Motor</label>
								<input type="file" ref="file2" @change="selectImageMotor" class="form-control">
							</div>
							<div class="col-md-6">
								<div v-if="imagePreviewSTNK">
									<div>
										<img class="img-fluid my-3" :src="imagePreviewSTNK" alt="" />
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div v-if="imagePreviewMOTOR">
									<div>
										<img class="img-fluid my-3" :src="imagePreviewMOTOR" alt="" />
									</div>
								</div>
							</div>

							<div class="col-md-12 mt-2 mb-4">
								<button class="btn btn-danger btn-md">Proses</button>
							</div>

						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
<script>
	var form_checkout = new Vue({
		el: '#form_checkout',
		data: {
			imageSTNK: undefined,
			imagePreviewSTNK: undefined,
			imageMOTOR: undefined,
			imagePreviewMOTOR: undefined,
		},
		methods: {
			selectImage(event) {
				this.imageSTNK = event.target.files[0]
				this.imagePreviewSTNK = URL.createObjectURL(this.imageSTNK)
			},
			selectImageMotor(event) {
				this.imageMOTOR = event.target.files[0]
				this.imagePreviewMOTOR = URL.createObjectURL(this.imageMOTOR)
			},
		}
	});
	var form = new Vue({
		el: '#form_',
		data: {

			allSelected: false,
			itemSelected: [],
			itemIds: [],
			parts: <?= isset($parts) ?  json_encode($parts) : '[]' ?>,
		},
		computed: {
			total: function() {
				return this.itemIds.reduce(function(a, c) {
					return a + Number((c.harga_barang * c.qty_pesanan) || 0)
				}, 0)
			}
		},
		methods: {

			subtotal: function(p) {
				return (p.harga_barang * p.qty_pesanan);
			},
			selectAll: function() {
				this.itemIds = [];
				if (!this.allSelected) {
					for (part in this.parts) {
						this.itemIds.push(this.parts[part]);
					}
				}
			},
			isNumber: function(evt) {
				evt = (evt) ? evt : window.event;
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
					evt.preventDefault();;
				} else {
					return true;
				}
			},
			delDetails: function(index) {
				$.ajax({
					url: '<?= base_url('akun_saya/delete_keranjang') ?>',
					data: {
						id: form.parts[index].id
					},
					type: 'POST',
					dataType: 'JSON',
					success: function(res) {
						form.parts.splice(index, 1);
						alert(res.message);
					},
					error: function() {
						alert("Opps, Something went wrong");
					}
				});
			},
		}
	});

	$('#checkoutBtn').click(function() {
		if (form.itemIds == "" || form.itemIds == []) {
			alert('Anda belum memilih barang untuk di checkout');
			return;
		} else {
			var values = {
				item: form.itemIds
			}
			$.ajax({
				url: '<?= base_url('akun_saya/send_checkout') ?>',
				type: "POST",
				data: values,
				cache: false,
				dataType: "JSON",
				success: function(response) {
					$('#modalCheckout').modal('show');
				}
			});
		}
	});
</script>
