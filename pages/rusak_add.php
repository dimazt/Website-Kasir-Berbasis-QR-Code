<?php


$view = $dbconnect->query('SELECT * FROM barang ORDER BY kode_barang DESC');

$hasil = $row = $view->fetch_array();

$urut = substr($hasil['kode_barang'], 2, 3);

if (isset($_POST['simpan'])) {
	$kode_barang = $_POST['kode_barang'];
	$jumlah = $_POST['jumlah'];
	$keterangan = 'Rusak';
	$tanggal_masuk = date('Y-m-d');


	// echo var_dump($_POST);
	// input barang kedalam list barang masuk

	mysqli_query($dbconnect, "INSERT INTO barang_km VALUES (null,'$kode_barang','','','$tanggal_masuk','','$jumlah','$keterangan')");
	$_SESSION['success'] = 'Barang Rusak Berhasil Ditambahkan';
	// mengalihkan halaman ke list barang
	echo "<meta http-equiv='refresh' content='0; url=index.php?p=barang_rusak'>";
}

?>
<div class="container">
	<h1>Tambah Barang</h1>
	<form method="post"">

<div class=" form-group">
		<label>Kode Barang</label>

		<input autocomplete="off" type="text" name="kode_barang" class="form-control" placeholder="Kode barang">
</div>
<div class="form-group">
	<label>Jumlah Stock</label>
	<input autocomplete="off" type="number" name="jumlah" class="form-control" placeholder="Jumlah Stock">
</div>
<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

</form>
</div>