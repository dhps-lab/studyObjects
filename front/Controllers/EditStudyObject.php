<?php
    class EditStudyObject extends Controllers{

        public function __construct(){
            parent::__construct();
        }

        public function EditStudyObject(){
            $data['page_tag'] = "Modificar Objetos de estudio";
            $data['page_title'] = "Modificación de Objetos de estudio";
            $data['page_functions_js'] = "functions_edit_so.js";
            $this->views->getView($this,"EditStudyObject",$data);
        }

    }
?>