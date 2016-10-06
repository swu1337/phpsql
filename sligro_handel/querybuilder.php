<?php
    Class QueryBuilder{
        private $dbname;
        private $db;
        private $table_info;

        public function __construct($dbname) {
            $this->dbname = $dbname;
            $this->db = new PDO("mysql:host=localhost;dbname=" . $this->dbname . ",root", "");
            $this->table_info = "info";
        }

    }
?>
