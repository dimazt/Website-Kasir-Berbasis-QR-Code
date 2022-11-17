<?php
include 'config.php';
session_start();
if (isset($_SESSION['userid'])) {
	if ($_SESSION['role_id'] == 1) {
		//redirect ke halaman kasir.php
		header('location:index.php');
	}
} else {
	$_SESSION['error'] = 'Anda harus login dahulu';
	header('location:halaman_login.php');
}

//menghilangkan Rp pada nominal

// print_r(preg_replace('/\D/', '', $_POST['total']));

// print_r($_SESSION['cart']) ;
$view = $dbconnect->query('SELECT * FROM transaksi ORDER BY id_transaksi DESC');

$hasil = $row = $view->fetch_array();

$tanggal_waktu = date('Y-m-d');
$waktu = date('H:i:s');

$format = 'TR' . date('m') . '-' . $row['id_transaksi'];


$nomor = $format;
$total = $_POST['total'];
$nama = $_SESSION['nama'];

$cust = $_POST['cust'];
//insert ke tabel transaksi
// if (isset($_POST['tf'])) {
// 	$bayar = $total;
// 	$kembali = $bayar - $total;
// 	mysqli_query($dbconnect, "INSERT INTO transaksi (id_transaksi,tanggal_waktu,waktu,nomor,total,nama_kasir,cust,bayar,ket,kembali) VALUES (NULL,'$tanggal_waktu','$waktu','$nomor','$total','$nama','$cust','$bayar','Transfer','$kembali')");
// } else {
    // $bayar = preg_replace('/\D/', '', $_POST['bayar']);
    // $kembali = $bayar - $total;
	mysqli_query($dbconnect, "INSERT INTO transaksi (id_transaksi,tanggal_waktu,waktu,nomor,total,nama_kasir,cust,bayar,ket,kembali) VALUES (NULL,'$tanggal_waktu','$waktu','$nomor','$total','$nama','$cust','0','Cash','0')");
// }



//mendapatkan id transaksi baru
$id_transaksi = mysqli_insert_id($dbconnect);

//insert ke detail transaksi
foreach ($_SESSION['cart'] as $key => $value) {

	$id_barang = $value['id'];
	$harga = $value['harga'];
	$qty = $value['qty'];
	$tot = $harga * $qty;
	$disk = $value['diskon'];

	mysqli_query($dbconnect, "INSERT INTO transaksi_detail (id_transaksi_detail,id_transaksi,kode_barang,harga,qty,total,diskon) VALUES (NULL,'$id_transaksi','$id_barang','$harga','$qty','$tot','$disk')");

	// $sum += $value['harga']*$value['qty'];
	if (isset($_POST['selesai'])) {
		mysqli_query($dbconnect, "UPDATE barang SET jumlah = jumlah - '$qty' where kode_barang='$id_barang' ");
		// mysqli_query($dbconnect, "INSERT INTO barang_km VALUES (Null,'$id_barang','','$qty','','$tanggal_waktu','','Keluar')");
		$query = mysqli_query($dbconnect, "SELECT * FROM barang_km where kode_barang = '$id_barang' and keterangan = 'Keluar' ORDER BY id_barang DESC");
		$coba = mysqli_fetch_array($query);
		if ($coba['kode_barang'] == $id_barang && $coba['tgl_keluar'] == $tanggal_waktu) {
			 //echo 'Jika ada - ' . $id_barang;
			 //echo ' - ' . $coba['kode_barang'] . ' Ada karena sama seperti query';
			mysqli_query($dbconnect, "UPDATE barang_km SET jumlah_keluar = jumlah_keluar + '$qty' where kode_barang='$id_barang' and keterangan = 'Keluar' ");

			// if ($coba['tgl_keluar'] == $tanggal_waktu) {
			// 	echo 'Jika ada - ' . $id_barang;
			// 	echo ' - ' . $coba['kode_barang'] . ' Ada karena sama seperti query 2';
			// 	// mysqli_query($dbconnect, "UPDATE barang_km SET jumlah_keluar = jumlah_keluar + '$qty' where kode_barang='$id_barang' ");
			// } else {
			// 	echo 'Ga ada ';
			// 	// mysqli_query($dbconnect, "INSERT INTO barang_km VALUES (Null,'$id_barang','','$qty','','$tanggal_waktu','','Keluar')");
			// }
		} 
		else {
// 			echo 'Jika tidak ada - ' . $id_barang . ' - ';
// 			echo '-' . $coba['kode_barang'] . ' Gaenek';
			mysqli_query($dbconnect, "INSERT INTO barang_km VALUES (Null,'$id_barang','','$qty','','$tanggal_waktu','','Keluar')");
		}
	}
}




$potongan = $_POST['pot'];
$_SESSION['pot'] = $potongan;
$_SESSION['cart'] = [];

//redirect ke halaman transaksi selesai
header("location:transaksi_selesai.php?idtrx=" . $id_transaksi);
