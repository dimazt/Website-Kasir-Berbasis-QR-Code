<?php

include 'config.php';


if (isset($_GET['id'])) {
	$id = $_GET['id'];

	//menampilkan data berdasarkan ID
	$data = mysqli_query($dbconnect, "SELECT * FROM barang where kode_barang='$id'");
	$data = mysqli_fetch_assoc($data);
}

if (isset($_POST['update'])) {
	$id = $_POST['kode_barang'];

	$nama = $_POST['nama'];
	$harga = preg_replace('/\D/', '', $_POST['harga']);
	$jumlah = $_POST['jumlah'];

	// Menyimpan ke database;
	$barang = mysqli_query($dbconnect, "UPDATE barang SET nama='$nama', harga='$harga', jumlah='$jumlah' where kode_barang='$id'");

	if ($barang) {
		mysqli_query($dbconnect, "UPDATE barang_km SET jumlah_masuk='$jumlah' where kode_barang='$id' ");
		$_SESSION['success'] = 'Barang Berhasil Diperbaharui';
		// mengalihkan halaman ke list barang
		echo "<meta http-equiv='refresh' content='0; url=index.php?p=barang'>";
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Perbaruhi Barang</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
	<div class="container">
		<div class="card shadow mb-4">
			<div class="card-header py-3 bg-primary">
				<h5 class="m-0 font-weight-bold text-white">TAMBAH DISKON BARANG RIFFASHOP</h5>
			</div>
			<div class="card-body">
				<form method="post">
					<div class="form-group">
						<label>Nama Barang</label>
						<input autocomplete="off" type="text" name="nama" class="form-control" placeholder="Nama barang" value="<?= $data['nama'] ?>">
					</div>
					<div class="form-group">
						<label>Kode Barang</label>
						<input autocomplete="off" type="text" readonly name="kode_barang" class="form-control" placeholder="Kode barang" value="<?= $data['kode_barang'] ?>">
					</div>
					<div class="form-group">
						<label>Harga</label>
						<input autocomplete="off" type="text" id="bayar" name="harga" class="form-control" placeholder="Harga Barang" value="<?= $data['harga'] ?>">
					</div>
					<div class="form-group">
						<label>Jumlah Stock</label>
						<input autocomplete="off" type="number" name="jumlah" class="form-control" placeholder="Jumlah Stock" value="<?= $data['jumlah'] ?>">
					</div>
					<input type="submit" name="update" value="Perbaruhi" class="btn btn-primary">
					<a href="index.php?p=barang_rusak" class="btn btn-warning">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</body>

</html>