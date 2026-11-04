<?php
class Dao {
    private $con;

    // Hàm khởi tạo kết nối CSDL
    public function __construct($user, $pass, $db) {
        $host = $_SERVER['SERVER_NAME'];
        $this->con = mysqli_connect($host, $user, $pass, $db);
        if (!$this->con) {
            die("Kết nối thất bại: " . mysqli_connect_error());
        }
    }

    // Hàm thực thi truy vấn SQL
    public function query($sql) {
        mysqli_query($this->con, "SET NAMES 'utf8'");
        $rs = mysqli_query($this->con, $sql);
        return $rs;
    }

    // Hàm xuất dữ liệu ra bảng HTML
    public function table($sql, $header) {
        $rs = $this->query($sql);
        if (!$rs) return;

        // Lấy thông tin các cột
        $fieldinfo = mysqli_fetch_fields($rs);
        
        $str = "<table border='1' cellspacing='0' cellpadding='5'><tr>";
        
        // Tạo tiêu đề cột (th)
        foreach ($fieldinfo as $val) {
            $name = $val->name;
            $str .= "<th>" . $name . "</th>";
        }
        $str .= "</tr>";

        // Đưa dữ liệu từ Recordset vào các dòng trong bảng (tr, td)
        while ($r = mysqli_fetch_array($rs)) {
            $str .= "<tr>";
            foreach ($fieldinfo as $val) {
                $name = $val->name;
                $str .= "<td>" . $r[$name] . "</td>";
            }
            $str .= "</tr>";
        }
        $str .= "</table>";

        // In tiêu đề và bảng
        echo "<h3>{$header}</h3>";
        echo $str;
    }
}
?>
