<?php
session_start(); //memulai sesi
include ('config/connect.php'); //menghubungkan php dengan database
$username = $_POST['username']; //menangkap input username
$password = $_POST['password']; //menangkap input password
// echo $username;
// echo $password;
// $query = "SELECT * from siswa where username = '.$username.' and password = '.$password.'";
// echo $query;
$query = mysqli_query($is_connect, "SELECT * from siswa where username = '".$username."' and password = '".$password."'"); //menjalankan query
$data = mysqli_fetch_assoc($query); //mysqli_fetch_assoc untuk menyimpan/menampung query yang dijalakan

if (NULL != $data){
$_SESSION['id'] = $data['id']; //pembuatan sesi
$_SESSION['username'] = $username; //pembuatan session
header('Location: index.php'); //proses meredirect ke halaman lain
} else {
echo 'Login gagal! Username atau password salah.';
echo "<a href='login.php'>Kembali</a>";
}

?>