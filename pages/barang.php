<?php

$view = $dbconnect->query('SELECT * FROM barang');

?>


<div class="container">
	<div class="card shadow mb-4">
		<div class="card-header py-3 bg-primary">
			<h6 class="m-0 font-weight-bold text-white">LIST BARANG RIFFASHOP</h6>
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

			<a href="index.php?p=barang_add" class="btn btn-sm btn-primary">Tambah data</a>
			<a href="barang_cetak_barcode.php" class="btn btn-sm btn-success">Cetak Barcode</a>
			<hr>
			
			<table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Nama</th>
						<th>Harga</th>
						<th>Jumlah Stok</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					while ($row = $view->fetch_array()) { ?>

						<tr>
							<td> <?php echo $no++ ?> </td>
							<td> <?= $row['kode_barang'] ?> </td>
							<td><?= $row['nama'] ?></td>
							<td><?php echo 'Rp. ' . number_format($row['harga']) ?></td>
							<td><?php if ($row['jumlah'] < 1) { ?>
									<form method="POST">
										Stock habis
										<input type="text" name="stock_baru" class="form-control">
										<input type="hidden" name="kode_brg" value="<?php echo $row['kode_barang']; ?>">
										<input type="submit" class="btn btn-primary btn-sm" name="restock" value="Restock">
									<?php

								} else {
									echo $row['jumlah'];
								} ?>
							</td>
							<td>
								<a href="index.php?p=barang_edit&id=<?php echo $row['kode_barang'] ?>" class="btn btn-sm btn-warning">Edit</a> |
								<a href="index.php?p=barang_hapus&id=<?= $row['kode_barang'] ?>" onclick="return confirm('apakah anda yakin?')" class="btn btn-sm btn-danger">Hapus</a>
							</td>
						</tr>

					<?php }

					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php
if (isset($_POST['restock'])) {
	$id = $_POST['kode_brg'];

	$tanggal_masuk = date('Y-m-d');
	$jumlah = $_POST['stock_baru'];
	$keterangan = 'Masuk';
	// Menyimpan ke database;
	$barang = mysqli_query($dbconnect, "UPDATE barang SET jumlah='$jumlah' where kode_barang='$id' ");

	if ($barang) {
		mysqli_query($dbconnect, "INSERT INTO barang_km VALUES (null,'$id','$jumlah','','$tanggal_masuk','','','$keterangan')");
		$_SESSION['success'] = 'Barang Berhasil Direstock';
		// mengalihkan halaman ke list barang
		echo "<meta http-equiv='refresh' content='0; url=index.php?p=barang'>";
	}
} ?>