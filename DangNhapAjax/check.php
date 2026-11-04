<meta charset="utf-8">
<?php
include("connect.php");
session_start();
$us = $_GET["user"];
$pw = $_GET["pass"];
$sql = "select * from sinhvien where masv='{$us}' and masv='{$pw}'";
mysqli_query($con, "SET NAMES 'utf8'");
$rs = mysqli_query($con, $sql);
if (mysqli_num_rows($rs) > 0) {
    $row = mysqli_fetch_array($rs);
    $_SESSION["code"] = $row['masv'];
    $_SESSION["info"] = $us . " - " . $row["hoten"] . " - " . $row["lop"];
    echo $row['hoten'] . "&nbsp; &nbsp; <a href=QLSV.php>Next</a>";
} else {
    echo "Bạn nhập thông tin sai!";
}
mysqli_free_result($rs);
mysqli_close($con);
?>
