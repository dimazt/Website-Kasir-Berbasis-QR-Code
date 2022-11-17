<?php



$view = $dbconnect->query('SELECT * FROM barang');

if (isset($_POST['simpan'])) {
    // return var_dump($_POST);
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];
    $potongan = preg_replace('/\D/', '', $_POST['potongan']);

    // Menyimpan ke database;
    mysqli_query($dbconnect, "INSERT INTO disbarang VALUES (NULL,'$barang_id','$qty','$potongan')");

    $_SESSION['success'] = 'Berhasil menambahkan data';

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
                    <label>
                        <strong>
                            Barang Yang Di Diskon
                        </strong>
                    </label>
                    <select name="barang_id" id="" class="form-control">
                        <?php while ($row = $view->fetch_array()) : ?>
                            <option value="<?= $row['kode_barang'] ?>"><?= $row['nama'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>
                        <strong>
                            Qty ( Minimal Pembelian )
                        </strong>
                    </label>
                    <input type="number" name="qty" class="form-control" placeholder="Minimal Pembelian">
                </div>
                <div class="form-group">
                    <label><strong>
                            Potongan
                        </strong></label>
                    <input type="text" id="bayar" name="potongan" class="form-control" placeholder="Jumlah Potongan">
                </div>
                <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                <a href="index.php?p=barang_diskon" class="btn btn-warning">Kembali</a>
            </form>
        </div>
    </div>
</div>