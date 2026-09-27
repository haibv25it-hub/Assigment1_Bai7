<?php

include_once('../connect.php');

// Lấy tên file ảnh
$icon = $_FILES['image']['name'];

// Lấy file tạm
$anh_tmp = $_FILES['image']['tmp_name'];

// Đưa ảnh vào thư mục image
move_uploaded_file($anh_tmp, "../image/" . $icon);

// Lấy dữ liệu từ form
$theloai = $_POST['TenTL'];
$thutu = $_POST['ThuTu'];
$an = $_POST['AnHien'];

// Câu lệnh INSERT
$sql = "INSERT INTO theloai
        (TenTL, ThuTu, AnHien, icon)
        VALUES
        ('$theloai', '$thutu', '$an', '$icon')";

// Thực hiện
if (mysqli_query($connect, $sql)) {

    echo "<script>
            alert('Thêm thành công');
            location.href='theloai.php';
          </script>";

} else {

    echo "Lỗi: " . mysqli_error($connect);

}

?>