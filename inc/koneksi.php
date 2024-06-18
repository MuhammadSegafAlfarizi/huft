<?php

$db = mysqli_connect("localhost", "root", "", "myfit");

if( !$db ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

?>
