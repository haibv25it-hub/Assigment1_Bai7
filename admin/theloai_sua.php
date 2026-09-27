_<?php

include("../connect.php");

if (isset($_GET['idTL'])) {

    $id = $_GET['idTL'];

    $sql = "SELECT * FROM theloai WHERE idTL = $id";

    $results = mysqli_query($connect, $sql);

    $d = mysqli_fetch_assoc($results);
}
?>
<form action="" method="post" enctype="multipart/form-data">

    <table border="1">

        <tr>
            <td>Tên thể loại</td>
            <td>
                <input type="text"
                       name="TenTL"
                       value="<?php echo $d['TenTL']; ?>">
            </td>
        </tr>

        <tr>
            <td>Thứ tự</td>
            <td>
                <input type="text"
                       name="ThuTu"
                       value="<?php echo $d['ThuTu']; ?>">
            </td>
        </tr>

        <tr>
            <td>Ẩn hiện</td>
            <td>
                <select name="AnHien">

                    <option value="0"
                        <?php if ($d['AnHien'] == 0) echo "selected"; ?>>
                        Ẩn
                    </option>

                    <option value="1"
                        <?php if ($d['AnHien'] == 1) echo "selected"; ?>>
                        Hiện
                    </option>

                </select>
            </td>
        </tr>

        <tr>
            <td>Icon hiện tại</td>
            <td>
                <img src="../image/<?php echo $d['icon']; ?>"
                     width="50">
            </td>
        </tr>

        <tr>
            <td>Icon mới</td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="hidden"
                       name="idTL"
                       value="<?php echo $d['idTL']; ?>">

                <input type="hidden"
                       name="ten_anh"
                       value="<?php echo $d['icon']; ?>">

                <input type="submit"
                       name="Sua"
                       value="Sửa">
            </td>
        </tr>

    </table>

</form>

<?php

if (isset($_POST['Sua'])) {

    $id = $_POST['idTL'];
    $theloai = $_POST['TenTL'];
    $thutu = $_POST['ThuTu'];
    $an = $_POST['AnHien'];

    $icon = $_POST['ten_anh'];

    if (!empty($_FILES['image']['name'])) {

        $icon = $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../image/" . $icon
        );
    }

    $sql = "UPDATE theloai SET
            TenTL='$theloai',
            ThuTu='$thutu',
            AnHien='$an',
            icon='$icon'
            WHERE idTL='$id'";

    if (mysqli_query($connect, $sql)) {

        echo "<script>
                alert('Sửa thành công');
                location.href='theloai.php';
              </script>";

    } else {

        echo "Lỗi: " . mysqli_error($connect);
    }
}

?>