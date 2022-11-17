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

$id = $_GET['id'];

$cart = $_SESSION['cart'];
// print_r($cart);

//berfungsi untuk mengambil data secara spesifik
$k = array_filter($cart,function ($var) use ($id){
	return ($var['id']==$id);
});
print_r($k);

foreach ($k as $key => $value) {
	unset($_SESSION['cart'][$key]);
}

//mengembalikan urutan data
$_SESSION['cart'] = array_values($_SESSION['cart']);

header('location:index.php?p=kasir');

?>