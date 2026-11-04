<?php
/* Kết nối đến MySQL server (đổi mật khẩu nếu MySQL của bạn có pass) */
$link = mysqli_connect("localhost", "root", "", "udn");

// Kiểm tra kết nối
if($link === false){
    die("ERROR: Không thể kết nối. " . mysqli_connect_error());
}

if(isset($_REQUEST["term"])){
    // Chuẩn bị câu lệnh SQL SELECT với Prepared Statement
    $sql = "SELECT * FROM hocphan WHERE tenhp LIKE ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Gán biến tham số
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Tìm kiếm các từ bắt đầu bằng từ khóa nhập vào
        $param_term = $_REQUEST["term"] . '%';
        
        // Thực thi câu lệnh
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Kiểm tra số lượng dòng kết quả
            if(mysqli_num_rows($result) > 0){
                // Duyệt qua mảng và in ra các thẻ <p> chứa tên học phần
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo "<p>" . htmlspecialchars($row["tenhp"]) . "</p>";
                }
            } else {
                echo "<p>Không tìm thấy kết quả nào</p>";
            }
        } else {
            echo "ERROR: Không thể thực thi câu lệnh $sql. " . mysqli_error($link);
        }
        
        // Đóng câu lệnh
        mysqli_stmt_close($stmt);
    }
}

// Đóng kết nối
mysqli_close($link);
?>
