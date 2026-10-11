<?php
class DB {
    protected $link;

    public function __construct() {
        global $config;

        $this->link = new mysqli(
            $config['host'],
            $config['user'],
            $config['pass'],
            $config['data']
        );

        if ($this->link->connect_error) {
            die("Không thể kết nối database: "
                . $this->link->connect_error);
        }

        $this->link->set_charset("utf8mb4");
    }

    public function db_query($query) {
        return mysqli_query($this->link, $query);
    }

    public function db_fetch($result) {
        return mysqli_fetch_assoc($result);
    }
}
?>