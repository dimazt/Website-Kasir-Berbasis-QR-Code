<?php

include 'config.php';


if (isset($_GET['id'])) {
	$id = $_GET['id'];

	//menampilkan data berdasarkan ID
	$data = mysqli_query($dbconnect, "SELECT * FROM barang_km where id_barang='$id'");
	$data = mysqli_fetch_assoc($data);
}

if (isset($_POST['update'])) {
	$id = $_POST['id_barang'];
	$jumlah = $_POST['jumlah'];

	mysqli_query($dbconnect, "UPDATE barang_km SET jumlah_masuk='$jumlah' where id_barang='$id' ");
	$_SESSION['success'] = 'Barang Berhasil Diperbaharui';
	// mengalihkan halaman ke list barang
	echo "<meta http-equiv='refresh' content='0; url=index.php?p=barang_rusak'>";
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
		<h1>Edit Barang</h1>
		<form method="post">

			<div class="form-group">
				<label>Kode Barang</label>
				<input autocomplete="off" type="text" readonly name="kode_barang" class="form-control" placeholder="Kode barang" value="<?= $data['kode_barang'] ?>">
			</div>

			<div class="form-group">
				<label>Jumlah Stock</label>
				<input autocomplete="off" type="number" name="jumlah" class="form-control" placeholder="Jumlah Stock" value="<?= $data['jumlah_rusak'] ?>">
			</div>
			<input type="submit" name="update" value="Perbaruhi" class="btn btn-primary">
			<a href="index.php?p=barang_rusak" class="btn btn-warning">Kembali</a>
		</form>
	</div>
</body>

</html>