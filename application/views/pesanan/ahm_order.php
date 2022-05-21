<html>

<head>
	<title><?= $kode_pesanan ?></title>
	<style>
		.table-ahm tr th td {
			font-size: 16px;
			font-weight: bold;
		}

		.table-ahm {
			border: 1px solid black !important;
			border-collapse: collapse !important;
			width: 100%;
		}

		.table-ahm tr th,
		.table-ahm tr td {
			border: 1px solid black !important;
			padding: 5px 5px;
			font-size: 12px;
		}
	</style>
</head>

<body>
	<table>
		<tr>
			<th rowspan="3">
				<img src="<?= base_url('uploads/logo/ahm.png') ?>" width="30%" alt="">
			</th>
			<th rowspan="3" width="300px" style="vertical-align: bottom; margin-bottom:20px !important; font-size:20px">
				HOTLINE ORDER
			</th>
			<th width="200px" style="text-align: left;font-weight:normal;">
				<input type="checkbox">
				Resend I &nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/
			</th>
		</tr>
		<tr>
			<th width="200px" style="text-align: left;font-weight:normal;">
				<input type="checkbox">
				Resend II &nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/
			</th>
		</tr>
		<tr>
			<th width="200px" style="text-align: left;font-weight:normal;">
				<input type="checkbox">
				Resend III : &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/
			</th>
		</tr>

	</table>

	<table style="margin-top:20px;" class="table-ahm">
		<tr>
			<th style="text-align: left;" colspan="12">Diisi oleh Jaringan Resmi AHM</th>
		</tr>
		<tr>
			<th style="text-align: left;" colspan="6">Data Jaringan</th>
			<th style="text-align: left;" colspan="6">Data Konsumen</th>
		</tr>
		<tr>
			<td colspan="2">Nama Jaringan</td>
			<td colspan="4">PT. MEGA WAHANA PESONA - SIMP. RIMBO</td>
			<td colspan="2">Nama Jaringan</td>
			<td colspan="4">PT. MEGA WAHANA PESONA - SIMP. RIMBO</td>
		</tr>
		<tr>
			<td colspan="2" rowspan="2">Alamat</td>
			<td colspan="4" rowspan="2">PT. MEGA WAHANA PESONA - SIMP. RIMBO</td>
			<td colspan="2">Alamat</td>
			<td colspan="4">PT. MEGA WAHANA PESONA - SIMP. RIMBO</td>
		</tr>

		<tr>
			<td colspan="2">No. Telpon</td>
			<td colspan="4">No. Telpon</td>
		</tr>

		<tr>
			<td colspan="2">Telp</td>
			<td colspan="4">0741583518</td>
			<td colspan="6">Data S/M</td>
		</tr>
	</table>
</body>

</html>
