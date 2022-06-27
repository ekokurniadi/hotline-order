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
			<td colspan="2">Nama </td>
			<td colspan="4"><?=$nama_lengkap?></td>
		</tr>
		<tr>
			<td colspan="2" rowspan="2"  style="vertical-align: top;">Alamat</td>
			<td colspan="4" rowspan="2"  style="vertical-align: top;">PT. MEGA WAHANA PESONA - SIMP. RIMBO</td>
			<td colspan="2">Alamat</td>
			<td colspan="4"  width="293px"><?=$alamat?></td>
		</tr>

		<tr>
			<td colspan="2">No. Telpon</td>
			<td colspan="4"><?=$no_telepon?></td>
		</tr>

		<tr>
			<td colspan="2">Telp</td>
			<td colspan="4">0741583518</td>
			<td colspan="6">Data S/M</td>
		</tr>
		<tr>
			<td colspan="2">Faximile</td>
			<td colspan="4">-</td>
			<td colspan="3">Type / No.Pol</td>
			<td colspan="3"><?=$no_polisi?></td>
		</tr>
		<tr>
			<td colspan="2">No. Order</td>
			<td colspan="4"><?=$kode_pesanan?></td>
			<td colspan="3">Tahun Perakitan</td>
			<td colspan="3"><?=$tahun_perakitan?></td>
		</tr>
		<tr>
			<td colspan="2">Tanggal Order</td>
			<td colspan="4"><?=formatTanggal($tanggal_dibuat)?></td>
			<td colspan="3">No. Rangka</td>
			<td colspan="3"><?=$no_rangka?></td>
		</tr>
		<tr>
			<td colspan="6">&nbsp;</td>
			<td colspan="3">No. Mesin</td>
			<td colspan="3"><?=$no_mesin?></td>
		</tr>
	</table>
	<table class="table-ahm">
		<tr>
			<th width="51px">No</th>
			<th width="250px">Part No</th>
			<th>Deskripsi Part</th>
			<th width="40px">Qty</th>
		</tr>
		<?php $dt = $this->db->get_where('pesanan_detail_barang',['kode_pesanan'=>$kode_pesanan])->result();?>
		<?php
		$no=1;
		foreach($dt as $rows):?>
		<tr>
			<td><?=$no?></td>
			<td><?=$rows->kode_barang?></td>
			<td><?=$rows->nama_barang?></td>
			<td><?=$rows->qty_pesanan?></td>
		
		</tr>
		<?php
	$no++;
	endforeach;?>
	</table>
	<table class="table-ahm">
		<tr>
			<td colspan="6" width="280px" style="vertical-align: top;">Keterangan :</td>
			<td colspan="6" style="text-align: center;">
				<p>CAP & TANDA TANGAN JARINGAN</p>
				<br>
				<br>
				<br>
				<br>
				<br>
				<p>(&nbsp;&nbsp;&nbsp;<?=$_SESSION['nama_lengkap']?>&nbsp;&nbsp;&nbsp;)</p>
			</td>
		</tr>
	</table>
	<table class="table-ahm" style="margin-top: 30px;">
		<tr>
			<th colspan="3" align="left">Diisi oleh AHM </th>
		</tr>
		<tr>
			<td width="150px">Tanggal Terima</td>
			<td>&nbsp;</td>
			<td>ETD :</td>
		</tr>
		<tr>
			<td>Tanggal Terima</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
</body>

</html>
