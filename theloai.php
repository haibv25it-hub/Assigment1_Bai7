<?php
require_once 'config.php';
require_once 'class/class.db.theloai.php';

$db_theloai = new DB_TheLoai();
$theloai_arr = $db_theloai->get_theloai();

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
    <title>Quản trị thể loại</title>
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">

    <h1>Quản trị thể loại</h1>

    <p>
        <a href="theloai_them.php"
           class="btn btn-primary">
            Thêm thể loại
        </a>
    </p>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-info">
            <?= e($_GET['msg']) ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên thể loại</th>
            <th>Thứ tự</th>
            <th>Ẩn/Hiện</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($theloai_arr as $item): ?>
        <tr>
            <td><?= (int)$item['idTL'] ?></td>

            <td>
                <?= e($item['TenTL']) ?>
            </td>

            <td>
                <?= (int)$item['ThuTu'] ?>
            </td>

            <td>
                <?= (int)$item['AnHien'] === 1
                    ? 'Hiện' : 'Ẩn' ?>
            </td>

            <td>
                <a class="btn btn-warning btn-sm"
                   href="sua_theloai.php?id=<?= (int)$item['idTL'] ?>">
                    Sửa
                </a>
            </td>

            <td>
                <form method="POST" action="delete.php"
                    onsubmit="return confirm('Bạn có thực sự muốn xóa?');">
                <input type="hidden" name="id"
                    value="<?php echo (int)$item['idTL']; ?>">
                <button type="submit" class="btn btn-danger btn-sm">
                    xoá
                </button>
                </form>
            </td>

        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
</body>
</html>