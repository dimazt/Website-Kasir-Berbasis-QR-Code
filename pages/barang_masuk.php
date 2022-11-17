<div class="container">
	<div class="card shadow mb-4">
		<div class="card-header py-3 bg-primary">
			<h6 class="m-0 font-weight-bold text-white">LIST BARANG MASUK RIFFASHOP</h6>
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


			<a href="barang_cetak_barcode.php" class="btn btn-sm btn-secondary">Cetak Barcode</a>
			<hr>

			<table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Nama Barang</th>
						<th>Tanggal Masuk</th>
						<th>Harga</th>
						<th>Keterangan</th>
						<th>Jumlah Stok</th>
						 <th></th> 
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$tot_masuk = 0;
					$query = mysqli_query($dbconnect, "SELECT * FROM barang INNER JOIN barang_km ON barang.kode_barang = barang_km.kode_barang WHERE barang_km.keterangan = 'Masuk' ORDER BY barang.kode_barang DESC ");
					while ($row = mysqli_fetch_assoc($query)) {
						$total = $row['jumlah_masuk'];
						// total bayar adalah penjumlahan dari keseluruhan total
						$tot_masuk += $total;

					?>

						<tr>
							<td> <?php echo $no++ ?> </td>
							<td> <?= $row['kode_barang'] ?> </td>
							<td><?= $row['nama'] ?></td>
							<td><?= $row['tgl_masuk'] ?></td>
							<td><?php echo 'Rp. ' . number_format($row['harga']) ?></td>
							<td>Barang <?= $row['keterangan'] ?></td>
							<td><?php echo number_format($row['jumlah_masuk']); ?></td>
							<!-- <td>
								<a href="index.php?p=barang_edit&id=<?= $row['id_barang'] ?>" class="btn btn-sm btn-warning">Edit</a> |
								<a href="index.php?p=barang_hapus&id=<?= $row['id_barang'] ?>" onclick="return confirm('apakah anda yakin?')" class="btn btn-sm btn-danger">Hapus</a>
							</td> -->
							<td>
								<a href="index.php?p=barang_masuk&id=<?= $row['id_barang'] ?>" onclick="return confirm('apakah anda yakin?')" class="btn btn-sm btn-danger">Hapus</a>
							</td>
						</tr>

					<?php }
					?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3"></td>
						<th colspan="3" style="background:#0bb365;color:#fff;">Total Barang Masuk</td>

						<th style="background:#0bb365;color:#fff;">
							<?php echo number_format($tot_masuk) ?> Barang</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<?php


if (isset($_GET['id'])) {

	$id = $_GET['id'];

	mysqli_query($dbconnect, "DELETE FROM `barang_km` WHERE id_barang='$id' ");

	$_SESSION['success'] = 'Berhasil menghapus data';

	// echo "<meta http-equiv='refresh' content='0; url=index.php?p=barang_keluar'>";
}

?>