<?php

session_start(); //untuk memulai sesi
$_SESSION = null; //menghapus data pada variabel session

session_destroy(); //untuk menghapus sesi yang ada
header('Location: login.php') //mengarahkan ke halaman login
?>