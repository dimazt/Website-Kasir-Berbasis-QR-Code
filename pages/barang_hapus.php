
<?php 

include 'config.php';


if (isset($_GET['id'])) {
	
	$id = $_GET['id'];
	
	mysqli_query($dbconnect, "DELETE FROM `barang` WHERE kode_barang='$id' ");
	
	$_SESSION['success'] = 'Berhasil menghapus data';

	echo "<meta http-equiv='refresh' content='0; url=index.php?p=barang'>";
}

?>