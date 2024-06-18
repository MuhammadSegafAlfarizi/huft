<?php
session_start();
session_destroy(); 
header("location: /myfit/index.php");
exit();
?>