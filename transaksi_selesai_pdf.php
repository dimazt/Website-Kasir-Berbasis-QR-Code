<?php
include 'config.php';
if (isset($_SESSION['userid'])) {
	if ($_SESSION['role_id'] == 1) {
		//redirect ke halaman kasir.php
		header('location:index.php');
	}
} else {
	$_SESSION['error'] = 'Anda harus login dahulu';
	header('location:halaman_login.php');
}
$data = mysqli_query($dbconnect, "SELECT * FROM transaksi WHERE id_transaksi='$id_trx'");
$trx = mysqli_fetch_assoc($data);
$query = mysqli_query($dbconnect, "SELECT * FROM user where id_user = 2");
$row = mysqli_fetch_assoc($query);
$detail = mysqli_query($dbconnect, "SELECT transaksi_detail.*, barang.nama FROM `transaksi_detail` INNER JOIN barang ON transaksi_detail.kode_barang=barang.kode_barang WHERE transaksi_detail.id_transaksi='$id_trx'");

?>


<!DOCTYPE html>
<html>

<head>
	<title>Kasir Selesai</title>
	<style type="text/css">
		body {
			color: #a7a7a7;
			padding: 0px 210px;
		}
	</style>
</head>

<body>

	<div align="left">
		<table width="100%" border="0" cellpadding="1" cellspacing="0">
			<tr align="center">
				<td style="color : black;"><strong><?= $trx['nama_kasir'] ?><br>
						<?= $row['alamat'] ?></td>
			</tr>
			<tr align="center">
				<td>
					<hr>
				</td>
			</tr>
			<tr>
				<td style="color : black;">
					#<?= $trx['nomor'] ?> | <?= date('d-m-Y', strtotime($trx['tanggal_waktu'])) ?> <?= date('H:i:s', strtotime($trx['waktu'])) ?>


				</td>

			</tr>

			<tr>

				<td style="color : black;">#<?= $trx['nama_kasir'] ?></td>
			</tr>
			<tr>

				<td style="color : black;">#Customer : <?= $trx['cust'] ?></td>
			</tr>
			<!--<tr>-->

			<!--	<td style="color : black;">#<?= $trx['ket'] ?></td>-->
			<!--</tr>-->
			<tr>
				<td>
					<hr>
				</td>
			</tr>
		</table>
		<table width="100%" border="0" cellpadding="3" cellspacing="0">
			<?php while ($row = mysqli_fetch_array($detail)) { ?>
				<tr>
					<td valign="top" style="color : black;">
						<?= $row['nama'] ?>
						<?php if ($row['diskon'] > 0) : ?>
							<br>
							<small>Diskon</small>
						<?php endif; ?>
					</td>
					<td style="color : black;" valign="top"><?= $row['qty'] ?></td>
					<td style="color : black;" valign="top" align="right"><?= number_format($row['harga']) ?></td>
					<td style="color : black;" valign="top" align="right">Rp.
						<?= number_format($row['total']) ?>
						<?php if ($row['diskon'] > 0) : ?>
							<br>
							<small>- Rp. <?= number_format($row['diskon']) ?></small>
						<?php endif; ?>
					</td>
				</tr>
			<?php } ?>
			<tr>
				<td colspan="4">
					<hr>
				</td>
			</tr>
			<tr>
				<td style="color : black;" align="right" colspan="3">Total</td>
				<td style="color : black;" align="right">Rp. <?= number_format($trx['total']) ?></td>
			</tr>
			<!--<tr>-->
			<!--	<td style="color : black;" align="right" colspan="3">Potongan</td>-->
			<!--	<td style="color : black;" align="right">- <?= $_SESSION['potong'] ?></td>-->
			<!--</tr>-->
			<!--<tr>-->
			<!--	<td style="color : black;" align="right" colspan="3">Kembali</td>-->
			<!--	<td style="color : black;" align="right"><?= number_format($trx['kembali']) ?></td>-->
			<!--</tr>-->
		</table>
		<table width="100%" border="0" cellpadding="1" cellspacing="0">
			<tr>
				<td>
					<hr>
				</td>
			</tr>
			<tr align="center">
				<td style="color : black;"><strong>
						Terimakasih, Selamat Belanja Kembali
					</strong></td>
			</tr>
			<tr align="center">
				<td style="color : black;"><strong>
						Barang yang sudah dibeli tidak dapat ditukar kembali.
					</strong></td>

			</tr>
			<!--<tr>-->
			<!--	<th style="color : black;">===== Layanan Konsumen ====</th>-->
			<!--</tr>-->
			<!--<tr>-->
			<!--	<th style="color : black;">SMS/CALL 085895986529 </th>-->
			<!--</tr>-->
		</table>
	</div>
</body>

</html>