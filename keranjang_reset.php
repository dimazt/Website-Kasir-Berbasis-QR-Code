<?php
session_start();

$_SESSION['cart'] = [];
$_SESSION['pot'] = 0;
$_SESSION['potong'] = 'Tanpa Potongan';


header('location:index.php?p=kasir');
?>