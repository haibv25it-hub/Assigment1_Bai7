<?php
require_once __DIR__ . '/class.db.php';

class DB_TheLoai extends DB {

    public function __construct() {
        parent::__construct();
    }

    // Lấy danh sách thể loại
    public function get_theloai($id = -1) {
        if ($id != -1) {
            $stmt = $this->link->prepare(
                "SELECT * FROM theloai WHERE idTL = ?"
            );
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();
            $data = [];

            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            $stmt->close();
            return $data;
        }

        $result = $this->db_query(
            "SELECT * FROM theloai ORDER BY ThuTu ASC"
        );

        $data = [];

        while ($row = $this->db_fetch($result)) {
            $data[] = $row;
        }

        return $data;
    }

    // Thêm thể loại
    public function them_theloai(
        $name,
        $sort = 0,
        $show = 1
    ) {
        $stmt = $this->link->prepare(
            "INSERT INTO theloai (TenTL, ThuTu, AnHien)
             VALUES (?, ?, ?)"
        );

        $stmt->bind_param("sii", $name, $sort, $show);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // Sửa thể loại
    public function sua_theloai(
        $id,
        $name,
        $sort,
        $show
    ) {
        $stmt = $this->link->prepare(
            "UPDATE theloai
             SET TenTL = ?, ThuTu = ?, AnHien = ?
             WHERE idTL = ?"
        );

        $stmt->bind_param(
            "siii",
            $name,
            $sort,
            $show,
            $id
        );

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // Xóa thể loại
    
    public function xoa_theloai($id) {
        $id = (int)$id;

        $query = "DELETE FROM theloai WHERE idTL = $id";

        return $this->db_query($query);
    }
}
?>