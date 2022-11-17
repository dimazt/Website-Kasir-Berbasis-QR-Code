<?php



if (isset($_GET['id'])) {
    $id = $_GET['id'];

    //menampilkan data berdasarkan ID
    $data = mysqli_query($dbconnect, "SELECT * FROM disbarang INNER JOIN barang ON disbarang.kode_barang=barang.kode_barang where disbarang.id='$id'");
    $data = mysqli_fetch_assoc($data);
}

if (isset($_POST['update'])) {
    $barang_id = $_POST['id'];
    $qty = $_POST['qty'];
    $potongan = preg_replace('/\D/', '', $_POST['potongan']);

    // Menyimpan ke database;
    mysqli_query($dbconnect, "UPDATE disbarang SET qty='$qty', potongan='$potongan' where id='$barang_id' ");

    $_SESSION['success'] = 'Berhasil memperbaruhi data';

    // mengalihkan halaman ke list barang
    echo "<meta http-equiv='refresh' content='0; url=index.php?p=barang_diskon'>";
}

?>

<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
            <h5 class="m-0 font-weight-bold text-white">TAMBAH DISKON BARANG RIFFASHOP</h5>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label>Barang Yang Di Diskon</label>
                    <input type="hidden" name="id" class="form-control" value="<?= $data['id'] ?>">
                    <input type="text" readonly name="nama" class="form-control" value="<?= $data['nama'] ?>">

                </div>
                <div class="form-group">
                    <label>Qty ( Minimal Pembelian )</label>
                    <input autocomplete="off" type="text" name="qty" class="form-control" placeholder="Minimal Pembelian" value="<?= $data['qty'] ?>">
                </div>
                <div class="form-group">
                    <label>Potongan</label>
                    <input autocomplete="off" type="text" id="bayar" name="potongan" class="form-control" placeholder="Jumlah Potongan" value="<?php echo 'Rp. ' . number_format($data['potongan']); ?>">
                </div>
                <input type="submit" name="update" value="Update" class="btn btn-primary">
                <a href="?page=dis_barang" class="btn btn-warning">Kembali</a>
            </form>
        </div>
    </div>
</div>