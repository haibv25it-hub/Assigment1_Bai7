<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thêm thể loại</title>
</head>

<body>

<form action="theloai_them_xl.php"
      method="post"
      enctype="multipart/form-data">

    <table align="center" border="1">

        <tr>
            <td>Tên thể loại</td>
            <td>
                <input type="text" name="TenTL">
            </td>
        </tr>

        <tr>
            <td>Thứ tự</td>
            <td>
                <input type="text" name="ThuTu">
            </td>
        </tr>

        <tr>
            <td>Ẩn hiện</td>
            <td>
                <select name="AnHien">
                    <option value="0">Ẩn</option>
                    <option value="1">Hiện</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>Icon</td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>

        <tr>
            <td>
                <input type="submit" name="Them" value="Thêm">
            </td>

            <td>
                <input type="reset" value="Hủy">
            </td>
        </tr>

    </table>

</form>

</body>
</html>