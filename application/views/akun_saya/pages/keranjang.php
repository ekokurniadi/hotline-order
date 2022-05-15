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
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="5" style="text-align: right;font-weight:bold;">Total</th>
						<th>{{total |toCurrency}}</th>
					</tr>
					<tr>

						<th colspan="6" style="text-align: right;">
							<button class="btn btn-danger btn-md" id="hapusBtn">Hapus Keranjang</button>
							<button class="btn btn-primary btn-md" id="checkoutBtn">Checkout</button>
						</th>
					</tr>
				</tfoot>
			</table>

		</div>
	</div>
</div>


<?php $parts = $this->db->get_where('keranjang', ['id_user' => $_SESSION['id']])->result(); ?>
<?php $this->load->view('akun_saya/components/modal_checkout'); ?>
<script>
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
			}
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
