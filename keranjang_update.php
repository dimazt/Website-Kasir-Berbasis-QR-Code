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

$qty = $_POST['qty'];
$cart = $_SESSION['cart'];
$_SESSION['list'] = '';
// print_r($qty);

foreach ($cart as $key => $value) {
    $_SESSION['cart'][$key]['qty'] = $qty[$key];

    $idbarang = $_SESSION['cart'][$key]['id'];
    //cek diskon barang
    $disbarang = mysqli_query($dbconnect, "SELECT * FROM disbarang WHERE kode_barang='$idbarang'");
    $disb = mysqli_fetch_assoc($disbarang);

    //cek jika di keranjang sudah ada barang yang masuk
    $key = array_search($idbarang, array_column($_SESSION['cart'], 'id'));
    // return var_dump($key);
    if ($key !== false) {
        // return var_dump($_SESSION['cart']);

        //cek jika ada potongan dan cek jumlah barang lebih besar sama dengan minimum order potongan
        if ($disb['qty'] && $_SESSION['cart'][$key]['qty'] >= $disb['qty']) {

            //cek kelipatan jumlah barang dengan batas minimum order
            $mod = $_SESSION['cart'][$key]['qty'] % $disb['qty'];

            if ($mod == 0) {

                //Jika benar jumlah barang kelipatan batas minimum order
                $d = $_SESSION['cart'][$key]['qty'] / $disb['qty'];
            } else {

                //Simpan jumlah potongan yang didapat
                $d = ($_SESSION['cart'][$key]['qty'] - $mod) / $disb['qty'];
            }

            //Simpan diskon dengan jumlah kelipatan dikali potongan barang
            $_SESSION['cart'][$key]['diskon'] = $d * $disb['potongan'];
        }
    }
}
$_SESSION['pot'] = 0;
$_SESSION['potong'] = 'Tanpa Potongan';


header('location:index.php?p=kasir');
