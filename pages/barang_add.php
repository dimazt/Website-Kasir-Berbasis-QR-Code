<?php


$view = $dbconnect->query('SELECT * FROM barang ORDER BY kode_barang DESC');

$hasil = $row = $view->fetch_array();

$urut = substr($hasil['kode_barang'], 2, 3);
$tambah = (int) $urut + 1;
if (strlen($tambah) == 1) {
	$format = 'BR00' . $tambah . '';
} else if (strlen($tambah) == 2) {
	$format = 'BR0' . $tambah . '';
} else {
	$ex = explode('BR', $hasil['kode_barang']);
	$no = (int) $ex[1] + 1;
	$format = 'BR' . $no . '';
}


if (isset($_POST['simpan'])) {
	$nama = $_POST['nama'];
	$kode_barang = $_POST['kode_barang'];
	$harga = preg_replace('/\D/', '', $_POST['harga']);
	$jumlah = $_POST['jumlah'];
	$keterangan = 'Masuk';
	$tanggal_masuk = date('Y-m-d');

	// Menyimpan ke database barang;
	$barang = mysqli_query($dbconnect, "INSERT INTO barang VALUES ('$nama','$harga','$jumlah','$kode_barang')");
	// echo var_dump($_POST);
	// input barang kedalam list barang masuk
	if ($barang) {
		mysqli_query($dbconnect, "INSERT INTO barang_km VALUES (null,'$kode_barang','$jumlah','','$tanggal_masuk','','','$keterangan')");
		$_SESSION['success'] = 'Barang Berhasil Ditambahkan';
		// mengalihkan halaman ke list barang
		echo "<meta http-equiv='refresh' content='0; url=index.php?p=barang'>";
	}
}

?>
<div class="container">
	<div class="card shadow mb-4">
		<div class="card-header py-3 bg-primary">
			<h6 class="m-0 font-weight-bold text-white">TAMBAH BARANG RIFFASHOP</h6>
		</div>
		<div class="card-body">

			<form method="post"">
	  <div class=" form-group">
				<label>Nama Barang</label>
				<input autocomplete="off" type="text" name="nama" class="form-control" placeholder="Nama barang">
		</div>
		<div class="form-group">
			<label>Kode Barang</label>

			<input autocomplete="off" type="text" name="kode_barang" readonly class="form-control" value="<?php echo $format ?>" placeholder="Kode barang">
		</div>
		<div class="form-group">
			<label>Harga</label>
			<input autocomplete="off" type="text" name="harga" id="bayar" class="form-control" placeholder="Harga Barang">
		</div>
		<div class="form-group">
			<label>Jumlah Stock</label>
			<input autocomplete="off" type="number" name="jumlah" class="form-control" placeholder="Jumlah Stock">
		</div>
		<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

		</form>
	</div>
</div>