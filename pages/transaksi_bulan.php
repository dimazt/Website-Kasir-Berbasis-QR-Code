<?php

// koneksi
// $view = $dbconnect->query('SELECT * FROM transaksi');
$total = 0;
$tot_bayar = 0;

if (isset($_POST['submit'])) {
    $bln = date($_POST['bulan']);
    $thn = date($_POST['tahun']);
    $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    if (!empty($bln)) {
        // perintah tampil data berdasarkan periode bulan
        $q = mysqli_query($dbconnect, "SELECT * FROM transaksi WHERE MONTH(tanggal_waktu) = '$bln' AND YEAR(tanggal_waktu) = '$thn'");
    } else {
        // perintah tampil semua data
        $q = mysqli_query($dbconnect, "SELECT * FROM transaksi t");
    }

    $_SESSION['bulan'] = $bulan[$bln] . ' ' . $thn;
}
if (isset($_POST['filter'])) {
    $hari = date($_POST['tanggal']);
    if (!empty($hari)) {
        // perintah tampil data berdasarkan periode bulan
        $q = mysqli_query($dbconnect, "SELECT * FROM transaksi WHERE tanggal_waktu = '$hari'");
    } else {
        // perintah tampil semua data
        $q = mysqli_query($dbconnect, "SELECT * FROM transaksi t");
    }

    $_SESSION['tanggal'] = $hari;
} else {
    // perintah tampil semua data
    $q = mysqli_query($dbconnect, "SELECT * FROM transaksi");
}


// hitung jumlah baris data
$s = $q->num_rows;
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    mysqli_query($dbconnect, "DELETE FROM `transaksi` WHERE id_transaksi='$id' ");
    mysqli_query($dbconnect, "DELETE FROM `transaksi_detail` WHERE id_transaksi='$id' ");

    $_SESSION['success'] = 'Berhasil menghapus data';

    echo "<meta http-equiv='refresh' content='0; url=index.php?p=transaksi_bulan'>";
}
?>
<!-- <style>
    .close {
        float: right;
        font-size: 21px;
        font-weight: bold;
        line-height: 1;
        color: #000;
        text-shadow: 0 1px 0 #fff;
        filter: alpha(opacity=20);
        opacity: .2;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
        filter: alpha(opacity=50);
        opacity: .5;
    }

    button.close {
        -webkit-appearance: none;
        padding: 0;
        cursor: pointer;
        background: transparent;
        border: 0;
    }

    .modal-open {
        overflow: hidden;
    }

    .modal {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1050;
        display: none;
        overflow: hidden;
        -webkit-overflow-scrolling: touch;
        outline: 0;
    }

    .modal.fade .modal-dialog {
        -webkit-transition: -webkit-transform .3s ease-out;
        -o-transition: -o-transform .3s ease-out;
        transition: transform .3s ease-out;
        -webkit-transform: translate3d(0, -25%, 0);
        -o-transform: translate3d(0, -25%, 0);
        transform: translate3d(0, -25%, 0);
    }

    .modal.in .modal-dialog {
        -webkit-transform: translate3d(0, 0, 0);
        -o-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }

    .modal-open .modal {
        overflow-x: hidden;
        overflow-y: auto;
    }

    .modal-dialog {
        position: relative;
        width: auto;
        margin: 10px;
    }

    .modal-content {
        position: relative;
        background-color: #fff;
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
        border: 1px solid #999;
        border: 1px solid rgba(0, 0, 0, .2);
        border-radius: 6px;
        outline: 0;
        -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
        box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
    }

    .modal-backdrop {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1040;
        background-color: #000;
    }

    .modal-backdrop.fade {
        filter: alpha(opacity=0);
        opacity: 0;
    }

    .modal-backdrop.in {
        filter: alpha(opacity=50);
        opacity: .5;
    }

    .modal-header {
        min-height: 16.42857143px;
        padding: 15px;
        border-bottom: 1px solid #e5e5e5;
    }

    .modal-header .close {
        margin-top: -2px;
    }

    .modal-title {
        margin: 0;
        line-height: 1.42857143;
    }

    .modal-body {
        position: relative;
        padding: 15px;
    }

    .modal-footer {
        padding: 15px;
        text-align: right;
        border-top: 1px solid #e5e5e5;
    }

    .modal-footer .btn+.btn {
        margin-bottom: 0;
        margin-left: 5px;
    }

    .modal-footer .btn-group .btn+.btn {
        margin-left: -1px;
    }

    .modal-footer .btn-block+.btn-block {
        margin-left: 0;
    }

    .modal-scrollbar-measure {
        position: absolute;
        top: -9999px;
        width: 50px;
        height: 50px;
        overflow: scroll;
    }
</style> -->
<div class="container">
    <div class="card shadow mb-4  border-bottom-primary">
        <div class="card-header py-3 bg-primary">


            <h6 class="m-0 font-weight-bold text-white">Riwayat Seluruh Transaksi
                <?php if (isset($_SESSION['bulan']) && $_SESSION['bulan'] != '') {
                    echo ' Bulan ' . $_SESSION['bulan'];
                } else if (isset($_SESSION['tanggal']) && $_SESSION['tanggal'] != '') {
                    echo $_SESSION['tanggal'];
                }
                echo $_SESSION['bulan'] = '';
                echo $_SESSION['tanggal'] = ''; ?>
            </h6>
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
                    $qry = mysqli_query($dbconnect, "SELECT tanggal_waktu FROM transaksi GROUP BY YEAR(tanggal_waktu)");
                    echo "<option>--</option>";
                    while ($t = mysqli_Fetch_array($qry)) {
                        $data = explode('-', $t['tanggal_waktu']);
                        $tahun = $data[0];
                        echo "<option value='$tahun'>$tahun</option>";
                    }
                    ?>

                </select>
                <button type="submit" name="submit" class="btn btn-primary btn-sm">Tampilkan</button>
            </form>

            <hr>
            <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">#Nomor</th>
                        <th scope="col">Nama Cust</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Total</th>
                        <th scope="col">Pembayaran</th>
                        <th scope="col">Kasir</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    while ($row = $q->fetch_array()) {

                        // total adalah hasil dari harga x qty
                        $total = $row['total'];
                        $kembali = $row['kembali'];
                        // total bayar adalah penjumlahan dari keseluruhan total
                        $tot_bayar += $total;

                    ?>

                        <tr>
                            <td scope="row"> <?= $row['nomor'] ?> </td>
                            <td><?= $row['cust'] ?></td>
                            <td><?= $row['tanggal_waktu'] . ' ' . $row['waktu'] ?></td>
                            <td><?php echo 'Rp. ' . number_format($row['total']) ?></td>
                            <td><?= $row['ket'] ?></td>
                            <td><?= $row['nama_kasir'] ?></td>
                            <td>
                                <a href="unduh_struk.php?idtrx=<?= $row['id_transaksi'] ?>" class="btn btn-sm btn-primary">Lihat</a>
                                <a href="index.php?p=transaksi_bulan&id=<?= $row['id_transaksi'] ?>" onclick="return confirm('apakah anda yakin?')" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>

                    <?php }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <th colspan="3" style="background:#0bb365;color:#fff;">Total Pemasukan</td>

                        <th style="background:#0bb365;color:#fff;">
                            Rp. <?php echo number_format($tot_bayar) ?>,00-</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>