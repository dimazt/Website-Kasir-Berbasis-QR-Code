<?php

$query = mysqli_query($dbconnect, "SELECT * FROM user where id_user = 2");
$row = mysqli_fetch_assoc($query);
if (isset($_POST['simpan'])) {
	$id = $_POST['id'];
	$nama = $_POST['nama_toko'];
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$alamat = $_POST['alamat'];

	// Menyimpan ke database barang;
	mysqli_query($dbconnect, "UPDATE user SET nama='$nama', username='$user', pass='$pass', alamat='$alamat' where id_user = '$id'");

	echo "<meta http-equiv='refresh' content='0; url=index.php?p=settings'>";

}

?>
<div class="container">
	<div class="card shadow mb-4">
		<div class="card-header py-3 bg-primary">
			<h6 class="m-0 font-weight-bold text-white">Settings</h6>
		</div>
		<div class="card-body">

			<form method="post"">
			<input autocomplete="off" type="hidden" name="id" class="form-control" value="<?php echo $row['id_user'] ?>">
				<div class=" form-group">
					<label>Nama Toko</label>
					<input autocomplete="off" type="text" name="nama_toko" class="form-control" value="<?php echo $row['nama'] ?>">
				</div>
				<div class="form-group">
					<label>Username</label>

					<input autocomplete="off" type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input autocomplete="off" type="password" name="password" class="form-control" value="<?php echo $row['pass'] ?>">
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<input autocomplete="off" type="text" name="alamat" class="form-control" value="<?php echo $row['alamat'] ?>">
				</div>

				<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

			</form>
		</div>
	</div>