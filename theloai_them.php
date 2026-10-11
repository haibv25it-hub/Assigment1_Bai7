<?php
require_once 'config.php';
require_once 'class/class.db.theloai.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten = trim($_POST['ten_theloai'] ?? '');
    $thu_tu = $_POST['thu_tu'] ?? '';
    $an_hien = $_POST['an_hien'] ?? '1';

    if ($ten === '') {
        $error = 'Vui lòng nhập tên thể loại.';
    } elseif (
        !ctype_digit((string)$thu_tu)
    ) {
        $error = 'Thứ tự phải là số nguyên không âm.';
    } elseif (!in_array($an_hien, ['0', '1'], true)) {
        $error = 'Trạng thái không hợp lệ.';
    } else {
        $db = new DB_TheLoai();

        if ($db->them_theloai(
            $ten,
            (int)$thu_tu,
            (int)$an_hien
        )) {
            header(
                'Location: theloai.php?msg=' .
                urlencode('Thêm thành công!')
            );
            exit;
        }

        $error = 'Thêm thể loại thất bại.';
    }
}

function e($value) {
    return htmlspecialchars(
        (string)$value,
        ENT_QUOTES,
        'UTF-8'
    );
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm thể loại</title>
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">

    <h1>Thêm thể loại</h1>

    <?php if ($error !== ''): ?>
        <div class="alert alert-danger">
            <?= e($error) ?>
        </div>
    <?php endif; ?>

    <form method="post">

        <div class="form-group">
            <label>Tên thể loại:</label>
            <input type="text" name="ten_theloai"
            class="form-control" required>
        </div>

        <div class="form-group">
            <label>Thứ tự:</label>
            <input type="number" name="thu_tu"
            class="form-control" min="0" value="0" required>
        </div>

        <div class="form-group">
            <label>Ẩn/Hiện:</label>
            <select name="an_hien" class="form-control">
                <option value="1">Hiện</option>
                <option value="0">Ẩn</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Thêm thể loại
        </button>

        <a href="theloai.php" class="btn btn-secondary">
            Quay lại
        </a>

    </form>
</div>
</body>
</html>