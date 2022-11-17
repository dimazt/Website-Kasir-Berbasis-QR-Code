<?php

$view = $dbconnect->query('SELECT * FROM barang');

?>


<div class="container">
	<div class="card shadow mb-4">
		<div class="card-header py-3 bg-primary">
			<h6 class="m-0 font-weight-bold text-white">LIST BARANG RUSAK RIFFASHOP</h6>
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

			<a href="index.php?p=rusak_add" class="btn btn-sm btn-primary"> + Tambah data</a>

			<hr>

			<table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Nama Barang</th>
						<th>Tanggal</th>
						<th>Harga</th>
						<th>Total</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$query = mysqli_query($dbconnect, "SELECT * FROM barang INNER JOIN barang_km ON barang.kode_barang = barang_km.kode_barang WHERE barang_km.keterangan = 'Rusak' ORDER BY barang.kode_barang DESC ");
					while ($row = mysqli_fetch_assoc($query)) { ?>

						<tr>
							<td> <?php echo $no++ ?> </td>
							<td> <?= $row['kode_barang'] ?> </td>
							<td><?= $row['nama'] ?></td>
							<td><?= $row['tgl_masuk'] ?></td>
							<td><?php echo "Rp. " . number_format($row['harga']) ?></td>
							<td><?= $row['jumlah_rusak'] ?></td>
							<td>
								<a href="index.php?p=rusak_edit&id=<?= $row['id_barang'] ?>" class="btn btn-sm btn-warning">Edit</a> |
								<a href="index.php?p=barang_rusak&id=<?= $row['id_barang'] ?>" onclick="return confirm('apakah anda yakin?')" class="btn btn-sm btn-danger">Hapus</a>
								<?php
								if (isset($_GET['id'])) {

									$id = $_GET['id'];

									mysqli_query($dbconnect, "DELETE FROM `barang_km` WHERE id_barang='$id' ");

									$_SESSION['success'] = 'Berhasil menghapus data';

									echo "<meta http-equiv='refresh' content='0; url=index.php?p=barang_rusak'>";
								} ?>
							</td>
						</tr>

					<?php }
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>