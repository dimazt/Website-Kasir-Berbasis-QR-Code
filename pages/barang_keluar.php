<div class="container">
	<div class="card shadow mb-4">
		<div class="card-header py-3 bg-primary">
			<h6 class="m-0 font-weight-bold text-white">LIST BARANG KELUAR RIFFASHOP</h6>
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
			<form method="POST" class="form-inline">
				<label style="margin-right: 10px;" for="date1">Pilih Tanggal</label>
				<input class="form-control form-control-sm" type="date" name="tanggal"">
                <button style=" margin-left: 10px;" type="submit" name="filter" class="btn btn-info btn-sm">Filter</button>
			</form>
			<hr>
			<form method="POST" action="" class="form-inline">
				<label style="margin-right: 10px;" for="date1">Tampilkan Transaksi Bulan </label>
				<select class="form-control mr-2 form-control-sm" name="bulan">

					<option value="0">Semua Transaksi</option>
					<option value="1">Januari</option>
					<option value="2">Februari</option>
					<option value="3">Maret</option>
					<option value="4">April</option>
					<option value="5">Mei</option>
					<option value="6">Juni</option>
					<option value="7">Juli</option>
					<option value="8">Agustus</option>
					<option value="9">September</option>
					<option value="10">Oktober</option>
					<option value="11">November</option>
					<option value="12">Desember</option>

				</select>
				<select class="form-control mr-2 form-control-sm" name="tahun">
					<?php
					$qry = mysqli_query($dbconnect, "SELECT tgl_keluar FROM barang_km GROUP BY YEAR(tgl_keluar)");
					echo "<option>--</option>";
					while ($t = mysqli_Fetch_array($qry)) {
						$data = explode('-', $t['tgl_keluar']);
						$tahun = $data[0];
						echo "<option value='$tahun'>$tahun</option>";
					}
					?>

				</select>
				<button type="submit" name="submit" class="btn btn-primary btn-sm">Tampilkan</button>
			</form>

			<table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Nama Barang</th>
						<th>Tanggal Keluar</th>
						<th>Harga</th>
						<th>Keterangan</th>
						<th>Jumlah</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$tot_keluar = 0;
					
					if (isset($_POST['filter'])) {
						$hari = date($_POST['tanggal']);
						if (!empty($hari)) {
							// perintah tampil data berdasarkan periode bulan
							$query = mysqli_query($dbconnect, "SELECT * FROM barang INNER JOIN barang_km ON barang.kode_barang = barang_km.kode_barang WHERE tgl_keluar = '$hari' AND barang_km.keterangan = 'Keluar' ORDER BY barang.kode_barang DESC ");
						} else {
							// perintah tampil semua data
							$query = mysqli_query($dbconnect, "SELECT * FROM barang INNER JOIN barang_km ON barang.kode_barang = barang_km.kode_barang WHERE barang_km.keterangan = 'y' ORDER BY barang.kode_barang DESC ");
						}

						$_SESSION['tanggal'] = $hari;
					} else
					if (isset($_POST['submit'])) {
						$bln = date($_POST['bulan']);
						$thn = date($_POST['tahun']);
						$bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
						if (!empty($bln)) {
							// perintah tampil data berdasarkan periode bulan
							$query = mysqli_query($dbconnect, "SELECT * FROM barang INNER JOIN barang_km ON barang.kode_barang = barang_km.kode_barang WHERE MONTH(barang_km.tgl_keluar) = '$bln' AND YEAR(barang_km.tgl_keluar) = '$thn' AND barang_km.keterangan = 'Keluar' ORDER BY barang.kode_barang DESC ");
						} else {
							// perintah tampil semua data
							$query = mysqli_query($dbconnect, "SELECT * FROM barang INNER JOIN barang_km ON barang.kode_barang = barang_km.kode_barang WHERE barang_km.keterangan = 'Keluar' ORDER BY barang.kode_barang DESC ");
						}

						// $_SESSION['bulan'] = $bulan[$bln] . ' ' . $thn;
					} else {
						// perintah tampil semua data
						$query = mysqli_query($dbconnect, "SELECT * FROM barang INNER JOIN barang_km ON barang.kode_barang = barang_km.kode_barang WHERE barang_km.keterangan = 'Keluar' ORDER BY barang.kode_barang DESC ");
					}
					// $query = mysqli_query($dbconnect, "SELECT * FROM barang INNER JOIN barang_km ON barang.kode_barang = barang_km.kode_barang WHERE barang_km.keterangan = 'Keluar' ORDER BY barang.kode_barang DESC ");
					while ($row = mysqli_fetch_assoc($query)) {
						$total = $row['jumlah_keluar'];
						// total bayar adalah penjumlahan dari keseluruhan total
						$tot_keluar += $total;
					?>


						<tr>
							<td> <?php echo $no++ ?> </td>
							<td> <?= $row['kode_barang'] ?> </td>
							<td><?= $row['nama'] ?></td>
							<td><?= $row['tgl_keluar'] ?></td>
							<td><?php echo 'Rp. ' . number_format($row['harga']) ?></td>
							<td>Barang <?= $row['keterangan'] ?></td>
							<td><?php echo $row['jumlah_keluar']; ?> Brg</td>
						<td>
								<a href="index.php?p=barang_keluar&id=<?= $row['id_barang'] ?>" onclick="return confirm('apakah anda yakin?')" class="btn btn-sm btn-danger">Hapus</a>
							</td>

						</tr>

					<?php }
					?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4"></td>
						<th colspan="2" style="background:#0bb365;color:#fff;">Total Barang Keluar</td>

						<th style="background:#0bb365;color:#fff;">
							<?php echo number_format($tot_keluar) ?> Barang</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>



	<!-- <div class="card shadow mb-4">
		<div class="card-header py-3 bg-primary">
			<h6 class="m-0 font-weight-bold text-white">LIST BARANG KELUAR RIFFASHOP 2</h6>
		</div>
		<div class="card-body">

			<table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Nama Barang</th>
						<th>Tanggal Keluar</th>
						<th>Harga</th>
						<th>Keterangan</th>
						<th>Jumlah</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$tot_keluar = 0;
					$tanggal = date('Y-m-d');
					$query = mysqli_query($dbconnect, "SELECT * FROM barang INNER JOIN transaksi_detail ON barang.kode_barang = transaksi_detail.kode_barang INNER JOIN transaksi ON transaksi.id_transaksi = transaksi_detail.id_transaksi WHERE transaksi.tanggal_waktu = '$tanggal' ORDER BY barang.kode_barang DESC ");
					while ($row = mysqli_fetch_assoc($query)) {
						$total = $row['qty'];
						// total bayar adalah penjumlahan dari keseluruhan total
						$tot_keluar += $total;

					?>


						<tr>
							<td> <?php echo $no++ ?> </td>
							<td> <?php echo $row['kode_barang']; ?> </td>
							<td><?= $row['nama'] ?></td>
							<td><?= $row['tanggal_waktu'] ?></td>
							<td><?php echo 'Rp. ' . number_format($row['harga']) ?></td>
							<td>Barang Keluar</td>
							<td><?php echo $row['qty']; ?> Brg</td>

						</tr>

					<?php }
					?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4"></td>
						<th colspan="2" style="background:#0bb365;color:#fff;">Total Barang Keluar</td>

						<th style="background:#0bb365;color:#fff;">
							<?php echo number_format($tot_keluar) ?> Barang</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div> -->
</div>


<?php


if (isset($_GET['id'])) {

	$id = $_GET['id'];

	mysqli_query($dbconnect, "DELETE FROM `barang_km` WHERE id_barang='$id' ");

	$_SESSION['success'] = 'Berhasil menghapus data';

	// echo "<meta http-equiv='refresh' content='0; url=index.php?p=barang_keluar'>";
}

?>