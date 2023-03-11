<?php
    class AssignStudyObjecttModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }

        public function searchAssignStudyObjecttById(int $id){
            $querySelect = "SELECT prof.nombre AS teacher_name, prof.apellido AS teacher_lastname,
            esp.nombre AS academic_area 
            FROM res_asignacion_objetos_de_estudio ara
            LEFT JOIN res_espacio esp ON ara.codigo_espacio = esp.codigo
            LEFT JOIN res_profesor prof ON ara.codigo_profesor = prof.codigo
            LEFT JOIN res_objetos_de_estudio ra ON ara.codigo_objetos_de_estudio = ra.codigo WHERE ara.codigo_objetos_de_estudio = $id";
            $request = $this->selectAll($querySelect);
            return $request;
        }

        public function saveAssignStudyObjectt(int $codeTeacher, int $codeAcademicArea, int $codeStudyObjectt){
            $queryInsert = "INSERT INTO res_asignacion_objetos_de_estudio(codigo_profesor,codigo_espacio,codigo_objetos_de_estudio) VALUES(?,?,?)";
            $arrData = array($codeTeacher, $codeAcademicArea, $codeStudyObjectt);
            $resInsert = $this->insert($queryInsert, $arrData);
            return $resInsert;
        }

        public function updateAssignStudyObjectt(array $arrData){
            $queryUpdate = "UPDATE res_asignacion_objetos_de_estudio SET codigo_profesor = ?, codigo_espacio = ?, codigo_objetos_de_estudio = ? WHERE id = ?";
            $request = $this->update($queryUpdate, $arrData);
            return $request;
        }

        public function deleteAssignStudyObjectt(int $id){
            $sql = "DELETE FROM res_asignacion_objetos_de_estudio WHERE id = $id";
            $request = $this->delete($sql);
            return $request;
        }
    }
?>