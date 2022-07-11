<html>

<head>
	<title>
		Laporan Pembelian
	</title>
	<?php
	header("Content-type: application/octet-stream");
	$file_name = 'laporan_pembelian' . '.xls';
	header("Content-Disposition: attachment; filename=$file_name.xls");
	header("Pragma: no-cache");
	header("Expires: 0"); ?>
	<style>
		@media print {
			@page {
				sheet-size: 330mm 210mm;
				margin-left: 0.8cm;
				margin-right: 0.8cm;
				margin-bottom: 1cm;
				margin-top: 1cm;
			}

			.text-center {
				text-align: center;
			}

			.bold {
				font-weight: bold;
			}

			.table {
				width: 100%;
				max-width: 100%;
				border-collapse: collapse;
				/*border-collapse: separate;*/
			}

			.table-bordered tr td {
				border: 0.01em solid black;
				padding-left: 5px;
				padding-right: 3px;
			}

			body {
				font-family: "Arial";
				font-size: 10pt;
			}
		}
	</style>

</head>

<body>
	<br>
	<table width="100%">
		<tr >
			<td colspan="8" style="text-align:center;font-weight:bold;">Laporan Hotline Order</td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center;font-weight:bold;">Periode : <?=formatTanggal($params['start_date'])?> / <?=formatTanggal($params['end_date'])?> </td>
		</tr>
	</table>
	<br>
	<br>
	<br>
	<table class="table" border="1">
		<tr>
		<th align="center" width="25px">No</th>
		<th align="center" >Tanggal Dibuat</th>
		<th align="center" >Kode Pesanan</th>
		<th align="center" >Nama Konsumen</th>
		<th align="center" >No Telepon</th>
		<th align="center" >Kode Part</th>
		<th align="center" >Deskripsi Part</th>
		<th align="center" >Qty Part</th>
		</tr>
		<?php
		$no=1;
		foreach($details->result() as $rows):?>
		<tr style="text-align: center;">
			<td><?=$no?></td>
			<td><?=formatTanggal($rows->tanggal_dibuat)?></td>
			<td><?=$rows->kode_pesanan?></td>
			<td><?=$rows->nama_lengkap?></td>
			<td>&nbsp;<?=$rows->no_telepon?></td>
			<td><?=$rows->kode_barang?></td>
			<td><?=$rows->nama_barang?></td>
			<td><?=$rows->qty_pesanan?></td>
		</tr>
		<?php $no++; endforeach?>
	</table>
</body>

</html>
