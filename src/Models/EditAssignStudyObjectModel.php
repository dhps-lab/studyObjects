<?php
    class EditAssignStudyObjectModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }

        public function searchAssignStudyObject(){
            $querySelect = "SELECT ara.id, ra.descripcion AS study_object,
             prof.nombre AS teacher_firstname,
             prof.apellido AS teacher_lastname,
            esp.nombre as subject 
            from res_asignacion_objetos_de_estudio ara
            LEFT JOIN res_espacio esp ON ara.codigo_espacio = esp.codigo
            LEFT JOIN res_profesor prof ON ara.codigo_profesor = prof.codigo
            LEFT JOIN res_objetos_de_estudio ra ON ara.codigo_objetos_de_estudio = ra.codigo";
            $request = $this->selectAll($querySelect);
            return $request;
        }

        public function searchAssignStudyObjectById(int $id){
            $querySelect = "SELECT * FROM res_asignacion_objetos_de_estudio WHERE id = $id";
            $request = $this->select($querySelect);
            return $request;
        }

        public function saveAssignStudyObject(int $codeTeacher, int $codeSubject, int $codeStudyObject){
            $queryInsert = "INSERT INTO res_asignacion_objetos_de_estudio(codigo_profesor,codigo_espacio,codigo_resultados) VALUES(?,?,?)";
            $arrData = array($codeTeacher, $codeSubject, $codeStudyObject);
            $resInsert = $this->insert($queryInsert, $arrData);
            return $resInsert;
        }

        public function updateAssignStudyObject(int $intTeacher, int $intSubject, int $intStudyObject, int $intId){
            $queryUpdate = "UPDATE res_asignacion_objetos_de_estudio SET codigo_profesor = ?, codigo_espacio = ?, codigo_resultados = ? WHERE id = ?";
            $arrData = array($intTeacher, $intSubject, $intStudyObject, $intId);
            $request = $this->update($queryUpdate, $arrData);
            return $request;
        }

        public function deleteAssignStudyObject(int $id){
            $sql = "DELETE FROM res_asignacion_objetos_de_estudio WHERE id = $id";
            $request = $this->delete($sql);
            return $request;
        }
    }
?>