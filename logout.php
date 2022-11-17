<?php
session_start();
session_unset();

header("location:halaman_login.php");
