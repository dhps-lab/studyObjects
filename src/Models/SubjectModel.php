<?php
    class SubjectModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }

        public function searchAllSubject(){
            $querySelect = "SELECT codigo, nombre FROM res_espacio";
            $request = $this->selectAll($querySelect);
            return $request;
        }

	public function searchSOTitleById(int $codeSO){
            $querySelect = "SELECT descripcion FROM res_objetos_de_estudio WHERE codigo = $codeSO";
            $request = $this->select($querySelect);
            return $request;
        }

        public function searchAllSubjectBySO(int $codeSO){
            $querySelect = "SELECT esp.codigo, esp.nombre AS name_subject, prof.nombre AS name_teacher, prof.apellido AS lastname_teacher
                            FROM res_asignacion_objetos_de_estudio ara
                            INNER JOIN res_espacio esp ON ara.codigo_espacio = esp.codigo
                            INNER JOIN res_profesor prof ON ara.codigo_profesor = prof.codigo
                            INNER JOIN res_objetos_de_estudio ra ON ara.codigo_objetos_de_estudio = ra.codigo 
                            WHERE ra.codigo = $codeSO;";
            $request = $this->selectAll($querySelect);
            return $request;
        }
    }
?>