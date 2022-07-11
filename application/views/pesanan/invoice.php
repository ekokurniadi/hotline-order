<html>

<head>
	<title><?= $kode_pesanan ?></title>
	<style>
		.table-a tr th td {
			font-size: 16px;
			font-weight: bold;
		}

		.table-a {
			
			border-collapse: collapse !important;
			width: 100%;
		}

		.table-a tr th,
		.table-a tr td {
			
			padding: 5px 5px;
			font-size: 12px;
		}
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
				<img src="<?= base_url('assets/vendors/images/logo-red.png') ?>" width="50px" alt="" style="margin-bottom: -20px;">
				<span style="font-size:20px;text-decoration:underline">PT Mega Wahana Pesona</span>
				<br>
				<span style="font-weight:normal">Jl. Patimura RT. 02 No. 315</span>
			</th>
		</tr>
</table>
<br>
<br>
<br>
<br>
<br>
<table width="100%">
	<tr>
		<th><span>INVOICE HOTLINE ORDER</span></th>
	</tr>
</table>
<br>
<br>
<table width="100%" class="table-a" >
	<tr>
		<th align="left">Nama</th>
		<th colspan="3" width="150px" align="left">: <?=$nama_lengkap?></th>
		<th align="left">Tanggal Pembuatan</th>
		<th colspan="3" align="left" width="150px">: <?=formatTanggal($tanggal_dibuat)?></th>
	</tr>
	<tr>
		<th align="left">Alamat</th>
		<th colspan="3" align="left">: Nama</th>
		<th align="left">Status Pembayaran</th>
		<th colspan="3" align="left">: Nama</th>
	</tr>
	<tr>
	<tr>
		<th align="left">No Pesanan</th>
		<th colspan="3" align="left">: <?=$kode_pesanan?></th>
		<th></th>
		<th colspan="3" align="left"></th>
	</tr>
	</tr>
</table>
	<br>
	<br>
	<br>
	<table class="table-ahm">
		<tr>
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Harga</th>
			<th>Kuantitas</th>
			<th>Subtotal</th>
		</tr>
		<?php $query = $this->db->query("SELECT * FROM pesanan_detail_barang where kode_pesanan='$kode_pesanan'")->result()?>
		<?php foreach($query as $rows):?>
		<tr>
			<td><?=$rows->kode_barang?></td>
			<td><?=$rows->nama_barang?></td>
			<td><?=$rows->harga_barang?></td>
			<td style="text-align: center;"><?=$rows->qty_pesanan?></td>
			<td><?=$rows->subtotal?></td>
		</tr>
		<?php endforeach?>
	</table>
</body>
</html>
