<?php
$server = $_SERVER['SERVER_NAME'];
$user = "root";
$pass = "";
$db = "udn";

$con = mysqli_connect($server, $user, $pass, $db);
mysqli_query($con, "SET NAMES 'utf8'");
?>
