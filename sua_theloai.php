<?php
require_once 'config.php';
require_once 'class/class.db.theloai.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
}

if (!$id || $id < 1) {
    exit('ID thể loại không hợp lệ.');
}

$db = new DB_TheLoai();
$data = $db->get_theloai($id);

if (!$data) {
    exit('Không tìm thấy thể loại.');
}

$item = $data[0];
$ten = $item['TenTL'];
$thu_tu = (string)$item['ThuTu'];
$an_hien = (string)$item['AnHien'];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten = trim($_POST['ten_theloai'] ?? '');
    $thu_tu = trim($_POST['thu_tu'] ?? '');
    $an_hien = $_POST['an_hien'] ?? '';

    if ($ten === '') {
        $error = 'Vui lòng nhập tên thể loại.';
    } elseif (!ctype_digit($thu_tu)) {
        $error = 'Thứ tự phải là số nguyên không âm.';
    } elseif (!in_array($an_hien, ['0', '1'], true)) {
        $error = 'Trạng thái không hợp lệ.';
    } else {
        if ($db->sua_theloai(
            $id,
            $ten,
            (int)$thu_tu,
            (int)$an_hien
        )) {
            header(
                'Location: theloai.php?msg=' .
                urlencode('Cập nhật thành công!')
            );
            exit;
        }

        $error = 'Cập nhật thất bại.';
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
    <title>Sửa thể loại</title>
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">

    <h1>Cập nhật thể loại</h1>

    <?php if ($error !== ''): ?>
        <div class="alert alert-danger">
            <?= e($error) ?>
        </div>
    <?php endif; ?>

    <form method="post">

        <input type="hidden" name="id"
        value="<?= (int)$id ?>">

        <div class="form-group">
            <label>Tên thể loại:</label>
            <input type="text" name="ten_theloai"
            class="form-control"
            value="<?= e($ten) ?>" required>
        </div>

        <div class="form-group">
            <label>Thứ tự:</label>
            <input type="number" name="thu_tu"
            class="form-control" min="0"
            value="<?= e($thu_tu) ?>" required>
        </div>

        <div class="form-group">
            <label>Ẩn/Hiện:</label>
            <select name="an_hien" class="form-control">
                <option value="1"
                <?= $an_hien === '1' ? 'selected' : '' ?>>
                    Hiện
                </option>

                <option value="0"
                <?= $an_hien === '0' ? 'selected' : '' ?>>
                    Ẩn
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Cập nhật thể loại
        </button>

        <a href="theloai.php" class="btn btn-secondary">
            Quay lại
        </a>

    </form>
</div>
</body>
</html>