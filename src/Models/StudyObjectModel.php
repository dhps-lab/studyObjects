<?php
    class StudyObjectModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }
        
        public function searchAllStudyObject($offset){
            $querySelect = "SELECT * FROM res_objetos_de_estudio LIMIT 12 OFFSET $offset";
            $request = $this->selectAll($querySelect);
            return $request;
        }

        public function searchAllStudyObjectSelect(){
            $querySelect = "SELECT * FROM res_objetos_de_estudio";
            $request = $this->selectAll($querySelect);
            return $request;
        }

        public function searchStudyObjectById(int $id){
            $querySelect = "SELECT * FROM res_objetos_de_estudio WHERE codigo = $id";;
            $request = $this->select($querySelect);
            return $request;
        }

        public function searchStudyObjectAmount(){
            $querySelect = "SELECT count(codigo) AS amount FROM res_objetos_de_estudio";
            $request = $this->selectAll($querySelect);
            return $request;
        }

        public function searchLastCode(){
            $querySelect = "SELECT max(codigo) AS code FROM res_objetos_de_estudio";
            $request = $this->selectAll($querySelect);
            return $request;
        }

        public function searchBarQuery(string $words){
            $querySelect = "SELECT * FROM res_objetos_de_estudio 
                            WHERE descripcion LIKE '%$words%' 
                            OR detalle LIKE '%$words%'";

            $request = $this->selectAll($querySelect);
            return $request;
        }
    }
?>