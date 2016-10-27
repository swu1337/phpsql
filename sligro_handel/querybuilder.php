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

        public function getTableById($table, $id) {
            $query = $this->db->prepare("SELECT * FROM $table WHERE id=$id");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = call_user_func_array('array_merge', $result);
            return $result;
        }

        public function getBesteldeArtikelen($factuur_id) {
            $query = $this->db->prepare("SELECT `artikel_id`, `aantal` FROM $this->table_bestelde_artikel WHERE `factuur_code` = $factuur_id");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $artikelen = [];

            foreach($result as $bestelde_artikel) {
                $artikel = $this->getTableById($this->table_artikel, $bestelde_artikel["artikel_id"]);
                $merged_array = array_merge($bestelde_artikel, $artikel);
                unset($merged_array["artikel_id"]);
                array_push($artikelen, $merged_array);
            }

            return $artikelen;
        }

        public function getFacturen() {
            $query = $this->db->prepare("SELECT * FROM $this->table_factuur");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getTotaal($artikelen, $korting) {
            $totaal_details = [];
            $subtotaal = 0;


            foreach ($artikelen as $artikel) {
                    $subtotaal  += $artikel['prijs'] * $artikel['aantal'];
            }

            $totaal_details['subtotaal'] = $subtotaal;
            $totaal_details['korting'] = $korting;
            $totaal_details['totaalexc'] = $subtotaal - $korting;
            $totaal_details['btw'] = $totaal_details['totaalexc'] * 0.21;
            $totaal_details['totaal'] =  $totaal_details['totaalexc'] * 1.21;

            return $totaal_details;
        }

        /* Help Functions*/
        public function array_flatten_recursive($array) {
            if (!$array) return false;
            $flat = array();
            $RII = new RecursiveIteratorIterator(new RecursiveArrayIterator($array));
            foreach ($RII as $value) $flat[] = $value;
            return $flat;
        }
    }
?>
