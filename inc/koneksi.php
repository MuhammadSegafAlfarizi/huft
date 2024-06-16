<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myfit";


$db = mysqli_connect($servername, $username, $password, $dbname);

if( !$db ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

?>
