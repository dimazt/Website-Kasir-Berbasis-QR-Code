<?php

$link = 'Kasir';

$barang = mysqli_query($dbconnect, 'SELECT * FROM barang');
// print_r($_SESSION);

$sum = 0;

if (isset($_POST['pot'])) {
    
    $potongan = preg_replace('/\D/', '', $_POST['bayar']);;
    $_SESSION['pot'] = $potongan;
    // $sum -=  $_SESSION['pot'];  
    // $_SESSION['potong'] = 'Rp. ' . $potongan;
    echo "<meta http-equiv='refresh' content='0; url=index.php?p=kasir'>";
}
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        
        
        $sum += ($value['harga'] * $value['qty']) - $value['diskon'];
    }
        $sum = $sum - $_SESSION['pot'];
}



?>
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">KASIR</h6>
        </div>
        <div class="card-body">
            <!-- Form Pencarian -->
            <!-- <form method="POST">
                <input name="pencarian" type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <input class="btn btn-success" type="submit" name="pencarian" value="Search">
                    </input>
                </div>
            </form> -->
            <div class="row">
                <!-- Fungsi Pencarian -->
                <!-- <div class="container-fluid">
                    <?php
                    $batas = 10;
                    extract($_GET);
                    if (empty($hal)) {
                        $posisi = 0;
                        $hal = 1;
                        $nomor = 1;
                    } else {
                        $posisi = ($hal - 1) * $batas;
                        $nomor = $posisi + 1;
                    }
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $pencarian = trim(mysqli_real_escape_string($dbconnect, $_POST['pencarian']));
                        if ($pencarian != "") {
                            $sql = "Select * from barang where nama like '%$pencarian%'";

                            $query = $sql;
                            $queryJml = $sql;
                        }
                    } else {
                        $query = "Select * from barang LIMIT $posisi, $batas";
                        $queryJml = "Select * from barang";
                        $no = $posisi * 1;
                    }

                    ?>
                </div> -->

                <div class="col-md-8">
                    <form method="post" action="keranjang_act.php">
                        <div class="form-group">
                            <input autocomplete="off" type="text" name="kode_barang" class="form-control" placeholder="Masukkan Kode / Nama Barang" autofocus>
                        </div>
                    </form>
                    <hr>
                    <form method="post" action="keranjang_update.php">
                        <div class="card mb-4 border">
                            <table class="table table-striped table-sm ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th align="center">Sub Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (isset($_SESSION['cart'])) : ?>
                                        <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td>
                                                    <?php echo $value['nama'] ?>
                                                    <?php if ($value['diskon'] > 0) : ?>
                                                        <br><small class=" label label-danger">Diskon <?php echo "Rp. " . number_format($value['diskon']) ?></small>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo "Rp. " . number_format($value['harga']) ?></td>
                                                <td class="col-md-2">
                                                    <input type="number" id="qty" name="qty[<?= $key ?>]" value="<?= $value['qty'] ?>" class="form-control form-control-sm" onkeyup="hitungSubTotal(detail_barang)">
                                                </td>
                                                <td align="center"><?php echo "Rp. " . number_format(($value['qty'] * $value['harga']) - $value['diskon']) ?></td>
                                                <td align="center"><a href="keranjang_hapus.php?id=<?= $value['id'] ?>" class="btn btn-sm btn-danger">batal</a></td>
                                            </tr>
                                        <?php } ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Refresh</button>
                        <a href="keranjang_reset.php" class="btn btn-sm btn-danger">Reset Keranjang</a>
                        <a href="#collapseCardExample" class="btn btn-sm btn-warning" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            Lihat List Barang
                        </a>
                    </form>
                </div>

                <div class="col-md-4">
                    <h3><strong>Total Rp. <?= number_format($sum) ?></strong></h3>    
                    <form method="POST"class="form-inline mb-2" id="potongan">
                         <label style="margin-right: 10px;">Potongan </label> 
                        <!--<select class="form-control form-control-sm" name="pot" onChange="document.getElementById('potongan').submit();">-->
                        <!--    <option selected disabled><?= $_SESSION['potong']; ?></option>-->
                        <!--    <option value="0">Tanpa Potongan</option>-->
                        <!--    <option value="1000">Rp. 1000</option>-->
                        <!--    <option value="2000">Rp. 2000</option>-->
                        <!--    <option value="3000">Rp. 3000</option>-->
                        <!--    <option value="4000">Rp. 4000</option>-->
                        <!--    <option value="5000">Rp. 5000</option>-->
                        <!--    <option value="6000">Rp. 6000</option>-->
                        <!--    <option value="7000">Rp. 7000</option>-->
                        <!--    <option value="8000">Rp. 8000</option>-->
                        <!--    <option value="9000">Rp. 9000</option>-->
                        <!--    <option value="10000">Rp. 10000</option>-->

                        <!--</select>-->
                                <div class="row">
                                <div class="col-7">
                                    <input autocomplete="off" type="text" id="bayar" name="bayar" class="form-control form-control-sm" placeholder="Potongan" value="<?php if(empty($_SESSION['pot'])){ echo 'Rp. 0'; } else { echo 'Rp. ' . $_SESSION['pot'];} ?>">
                                </div>
                                <div class="col-5">
                                     <button type="submit" name="pot" class="btn btn-sm btn-primary" >Potong</button>
                                </div>
                                </div>
                    </form>
                    <form action="transaksi_act.php" method="POST">
                        <input type="hidden" name="total" value="<?= $sum ?>">
                        <div class="form-group">
                            <!--<label>Bayar</label>-->
                            <!--<div class="row">-->
                                <!--<div class="col-7">-->
                                <!--    <input autocomplete="off" type="text" id="bayar" name="bayar" class="form-control form-control-sm">-->
                                <!--</div>-->
                            <!--    <div class="col-5">-->
                                    <!--<input type="checkbox" name="tf" value="Transfer">-->
                            <!--        <span class="checkmark">Transfer</span>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <input autocomplete="off" style="margin-top: 5px;" type="text" id="cust" name="cust" placeholder="Nama Pembeli" class="form-control form-control-sm">
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <button type="submit" name="selesai" class="btn btn-sm btn-primary">Selesai</button>
                            </div>
                            <div class="col-9">

                            </div>
                        </div>

                    </form>
                    
                 
                </div>

            </div>
            <br>
            <!-- Menampilkan List Barang dan Akan ditambahkan ke dalam keranjang -->

            <div class="collapse <?= $_SESSION['list']; ?>" id="collapseCardExample">
                <div class="card mb-4 py-3 border-left-primary">
                    <div class="card-body">
                        <!-- Card Content - Collapse -->


                        <form method="post" action="keranjang_act.php">
                            <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($row = $barang->fetch_array()) { ?>

                                        <tr>
                                            <td> <?= $row['kode_barang'] ?> </td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?php echo 'Rp. ' . number_format($row['harga']) ?></td>

                                            <td>
                                                <a style="align-items: center;" href="keranjang_act.php?search_barang=<?= $row['kode_barang']; ?>" class="btn btn-sm btn-success">Tambahkan Keranjang</a>
                                                <!-- <input type="submit" name="update" value="Perbaruhi" class="btn btn-primary"> -->
                                            </td>
                                        </tr>

                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    //inisialisasi inputan
    var bayar = document.getElementById('bayar');

    bayar.addEventListener('keyup', function(e) {
        bayar.value = formatRupiah(this.value, 'Rp. ');
        // harga = cleanRupiah(dengan_rupiah.value);
        // calculate(harga,service.value);
    });


    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    //generate dari inputan rupiah menjadi angka

    function cleanRupiah(rupiah) {
        var clean = rupiah.replace(/\D/g, '');
        return clean;
        // console.log(clean);
    }
</script>