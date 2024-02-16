<?php
    class Ingredien{
        private $codeIngr;
        private $nomIngr;

        public function __construct($codeIngr, $nomIngr){
            $this->codeIngr = $codeIngr;
            $this->nomIngr = $nomIngr;
        }

        public function getCodeIngr(){
            return $this->codeIngr;
        }

        public function getNomIngr(){
            return $this->nomIngr;
        }

        public function setCodeIngr($codeIngr){
            $this->codeIngr = $codeIngr;
        }

        public function setNomIngr($nomIngr){
            $this->nomIngr = $nomIngr;
        }
    }


    function get_all_ingredient(){
        $sql_ingerdient_all = "SELECT CODEINGR, NOMINGR FROM ingredient";
        $ingredientList = [];
        $server_name = "localhost";
        $user_name = "root";
        
        try {
            $conn_mysqli = new mysqli($server_name, $user_name, "", "pizza");
            $result = $conn_mysqli->query($sql_ingerdient_all);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $ingredient = new Ingredien($row["CODEINGR"], $row["NOMINGR"]);
                    array_push($ingredientList, $ingredient);
                }
            }
            $conn_mysqli->close();
        } catch (Exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $ingredientList;
    }
?>