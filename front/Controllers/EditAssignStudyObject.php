<?php
    class EditAssignStudyObject extends Controllers{
        public function __construct(){
            parent::__construct();
        }

        public function EditAssignStudyObject(){
            $data['page_tag'] = "Modificar Asignación de Objetos de Estudio";
            $data['page_title'] = "Modificación Asignación de Objetos de Estudio";
            $data['page_functions_js'] = "functions_assign_so.js";
            $this->views->getView($this,"EditAssignStudyObject",$data);
        }
        
    }
?>