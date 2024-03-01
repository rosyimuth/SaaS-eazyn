<?php

$username = "root";
$password = "";
$host = 'localhost';

$is_connect = mysqli_connect($host, $username, $password); 
//mysql -u root -h localhost -p
//line 11 bisa ditaruh line 9 dengan alasan harus/sudah connect 
if($is_connect){
    mysqli_select_db($is_connect, "izin_db");
    //use izin_db di mysql
}else{
        echo "Oops...";
}