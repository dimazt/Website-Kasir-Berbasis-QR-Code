<?php


$total = 0;
$tot_bayar = 0;
// return var_dump($view);
$hari = date('Y-m-d');

$view = mysqli_query($dbconnect, "SELECT * FROM transaksi WHERE tanggal_waktu = '$hari' ");

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    mysqli_query($dbconnect, "DELETE FROM `transaksi` WHERE id_transaksi='$id' ");
    mysqli_query($dbconnect, "DELETE FROM `transaksi_detail` WHERE id_transaksi='$id' ");

    $_SESSION['success'] = 'Berhasil menghapus data';

    echo "<meta http-equiv='refresh' content='0; url=index.php?p=riwayat'>";
}

?>

<div class="container">
	<div class="card shadow mb-4">
		<div class="card-header py-3 bg-primary">
			<h5 class="m-0 font-weight-bold text-white">Riwayat Seluruh Transaksi Hari Ini, <?php echo date('d-m-Y') ?></h5>
		</div>
		<div class="card-body">
 <?php if (isset($_SESSION['success']) && $_SESSION['success'] != '') { ?>

                <div class="alert alert-success" role="alert">
                    <?= $_SESSION['success'] ?>
                </div>

            <?php
            }
            $_SESSION['success'] = '';
            ?>
			<table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th scope="col">#Nomor</th>
						<th scope="col">Nama Cust</th>
						<th scope="col">Tanggal Transaksi</th>
						<th scope="col">Total</th>
						<th scope="col">Pembayaran</th>
						<th scope="col">Kasir</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php

					while ($row = $view->fetch_array()) {
						$total = $row['total'];
						$kembali = $row['kembali'];
						// total bayar adalah penjumlahan dari keseluruhan total
						$tot_bayar += $total;
					?>

						<tr>
							<td scope="row"> <?= $row['nomor'] ?> </td>
							<td><?= $row['cust'] ?></td>
							<td><?= $row['tanggal_waktu'] . ' ' . $row['waktu'] ?></td>
							<td><?php echo 'Rp. ' . number_format($row['total']) ?></td>
							<td><?= $row['ket'] ?></td>
							<td><?= $row['nama_kasir'] ?></td>
							<td>
								<a href="unduh_struk.php?idtrx=<?= $row['id_transaksi'] ?>" class="btn btn-sm btn-primary">Lihat</a>
								<a href="index.php?p=riwayat&id=<?= $row['id_transaksi'] ?>" onclick="return confirm('apakah anda yakin?')" class="btn btn-sm btn-danger">Hapus</a>
							</td>
						</tr>

					<?php }
					?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3"></td>
						<th colspan="3" style="background:#0bb365;color:#fff;">Pemasukan Hari Ini</td>

						<th style="background:#0bb365;color:#fff;">
							Rp. <?php echo number_format($tot_bayar) ?>,00-</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>