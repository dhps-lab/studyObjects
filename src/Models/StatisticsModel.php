<?php
    class StatisticsModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }
        
        public function amountStudyObject(){
            $querySelect = "SELECT count(*) as amount FROM res_objetos_de_estudio";
            $request = $this->selectAll($querySelect);
            $amount = $request[0]['amount'];
            return $amount;
        }

        public function amountSubject(){
            $querySelect = "SELECT COUNT(*) as amount FROM res_espacio";
            $request = $this->selectAll($querySelect);
            $amount = $request[0]['amount'];
            return $amount;
        }

        public function amountTeacher(){
            $querySelect = "SELECT COUNT(*) as amount FROM res_profesor";
            $request = $this->selectAll($querySelect);
            $amount = $request[0]['amount'];
            return $amount;
        }

        public function amountAssignStudyObject(){
            $querySelect = "SELECT COUNT(*) as amount FROM res_asignacion_objetos_de_estudio";
            $request = $this->selectAll($querySelect);
            $amount = $request[0]['amount'];
            return $amount;
        }

        public function studyObjectComponent(){
            $querySelect = "SELECT c.nombre, count(ara.id) AS amount FROM res_asignacion_objetos_de_estudio ara
                            LEFT JOIN res_espacio e ON e.codigo = ara.codigo_espacio
                            LEFT JOIN res_componente c ON c.codigo = e.codigo_componente
                            GROUP BY c.codigo;";
            $request = $this->selectAll($querySelect);
            return $request;
        }

        public function studyObjectTeacherSubject(){
            $querySelect = "SELECT ra.descripcion, COUNT(distinct ara.codigo_espacio) AS amount_subject, 
                            COUNT(distinct ara.codigo_profesor) AS amount_teacher 
                            FROM res_asignacion_objetos_de_estudio ara
                            INNER JOIN res_objetos_de_estudio ra ON ara.codigo_objetos_de_estudio = ra.codigo
                            GROUP BY ra.descripcion";
            $request = $this->selectAll($querySelect);
            return $request;
        }

        public function studyObjectSubject(){
            $querySelect = "SELECT esp.nombre, count(ara.codigo_objetos_de_estudio) as amount 
                            FROM res_asignacion_objetos_de_estudio ara
                            INNER JOIN res_espacio esp ON ara.codigo_espacio = esp.codigo
                            INNER JOIN res_objetos_de_estudio ra ON ara.codigo_objetos_de_estudio = ra.codigo 
                            GROUP BY ara.codigo_espacio ORDER BY amount DESC";
            $request = $this->selectAll($querySelect);
            return $request;
        }

        public function studyObjectSubjectComponent(){
            $querySelect = "SELECT com.nombre as compo, esp.nombre, count(ara.codigo_objetos_de_estudio) as amount FROM res_asignacion_objetos_de_estudio ara
                            INNER JOIN res_espacio esp ON ara.codigo_espacio = esp.codigo
                            INNER JOIN res_objetos_de_estudio ra ON ara.codigo_objetos_de_estudio = ra.codigo 
                            INNER JOIN res_componente com ON com.codigo = esp.codigo_componente
                            GROUP BY esp.codigo_componente, ara.codigo_espacio ORDER BY com.nombre DESC;";
            $request = $this->selectAll($querySelect);
            return $request;
        }

        public function subjectComponent(){
            $querySelect = "SELECT c.nombre, count(e.codigo) AS amount FROM res_espacio e
                            LEFT JOIN res_componente c ON c.codigo = e.codigo_componente
                            GROUP BY c.codigo ORDER BY amount DESC;";
            $request = $this->selectAll($querySelect);
            return $request;
        }
    }
?>