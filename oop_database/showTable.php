<?php
$op = isset($_GET["chon"]) ? $_GET["chon"] : "";

if ($op != "") {
    include("database.class.php");
    
    // Khởi tạo đối tượng Dao với (user, password, database_name)
    $dao = new Dao("root", "", "udn");
    
    $sql = "SELECT * FROM {$op}";
    $header = "DANH SÁCH " . strtoupper($op);
    
    // Gọi phương thức xuất bảng
    $dao->table($sql, $header);
}
?>
