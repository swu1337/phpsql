<?php
    Class QueryBuilder{
        private $db;
        private $table_artikel;
        private $table_bedrijf;
        private $table_bestelde_artikel;
        private $table_factuur;
        private $table_klant;

        public function __construct($dbname) {
            $this->db = new PDO("mysql:host=localhost;dbname=$dbname","root", "");
            $this->table_artikel = "artikel";
            $this->table_bedrijf = "bedrijf";
            $this->table_bestelde_artikel = "bestelde_artikel";
            $this->table_factuur = "factuur";
            $this->table_klant = "klant";
        }

        public function getBesteldeArtikel($factuur_id) {
            $query = $this->db->prepare("SELECT * FROM `bestelde_artikel` WHERE factuur_code = $factuur_id");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $artikelen = [];
            //$result = call_user_func_array('array_merge', $result);
            foreach($result as $artikel) {
                print_r($artikel);
            }
            return $result;//$this->array_flatten_recursive($result);
        }


        public function array_flatten_recursive($array) {
            if (!$array) return false;
            $flat = array();
            $RII = new RecursiveIteratorIterator(new RecursiveArrayIterator($array));
            foreach ($RII as $value) $flat[] = $value;
            return $flat;
        }


        public function getFacturen() {
            $query = $this->db->prepare("SELECT * FROM $this->table_factuur");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getTableById($table, $id) {
            $query = $this->db->prepare("SELECT * FROM $table WHERE id=" . $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = call_user_func_array('array_merge', $result);
            return $result;
        }
    }
?>
