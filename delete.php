
```php
<?php
include 'config.php';
include 'class/class.db.theloai.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

    if ($id === false || $id === null || $id <= 0) {
        echo '<script>
            alert("ID thể loại không hợp lệ!");
            window.location="theloai.php";
        </script>';
        exit;
    }

    $db_theloai = new DB_TheLoai();

    $result = $db_theloai->xoa_theloai($id);

    if ($result) {
        echo '<script>
            alert("Xóa thành công!");
            window.location="theloai.php";
        </script>';
    } else {
        echo '<script>
            alert("Xóa không thành công!");
            window.location="theloai.php";
        </script>';
    }
} else {
    header('Location: theloai.php');
    exit;
}
?>
```
