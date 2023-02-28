<?php
    class EditStudyObjectModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }
        
        public function searchAllStudyObject(){
            $querySelect = "SELECT * FROM res_objetos_de_estudio";
            $request = $this->selectAll($querySelect);
            return $request;
        }

        public function searchStudyObjectById(int $id){
            $querySelect = "SELECT * FROM res_objetos_de_estudio WHERE codigo = $id";
            $request = $this->select($querySelect);
            return $request;
        }

        public function searchLastCode(){
            $querySelect = "SELECT max(codigo) AS code FROM res_objetos_de_estudio";
            $request = $this->selectAll($querySelect);
            return $request;
        }

        public function saveStudyObject(int $code, string $name, string $description){
            $return = "";
            $requestSelect = $this->searchStudyObjectByName($name);
            if(empty($requestSelect)){
                $queryInsert = "INSERT INTO res_objetos_de_estudio(codigo,descripcion,detalle) VALUES(?,?,?)";
                $arrData = array($code, $name, $description);
                $request = $this->insert($queryInsert, $arrData);
                $return = $request;
            }else{
                $return = "exist";
            }        
            return $return;   
        }
        
        public function updateStudyObject(int $code, string $name, string $description){
            $queryUpdate = "UPDATE res_objetos_de_estudio SET descripcion = ?, detalle = ?  WHERE codigo = ?";
            $arrData = array($name, $description, $code);
            $request = $this->update($queryUpdate, $arrData);
            return $request;
        }

        public function deleteStudyObject(int $code){
            $sql = "DELETE FROM res_objetos_de_estudio WHERE codigo = $code";
            $request = $this->delete($sql);
            return $request;
        }

        private function searchStudyObjectByName(string $name){
            $querySelect = "SELECT * FROM res_objetos_de_estudio WHERE descripcion = '$name'";
            $request = $this->select($querySelect);
            return $request;
        }
    }
?>