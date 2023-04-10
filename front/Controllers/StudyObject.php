<?php
    class StudyObject extends Controllers{

        public function __construct(){
            parent::__construct();
        }

        public function StudyObject(string $page){
            $page = intval(strClean($page));
            $data['page_tag'] = 'Objetos de estudio';
            $data['page_title'] = 'Objetos de estudio';
            //$data['pagination'] = ceil($this->getStudyObjectAmount()/12);
            $data['pagination'] = ceil(4);
            $data['page_functions_js'] = "functions_learning_result.js";
            $this->views->getView($this,"StudyObject",$data);
        }

    }
?>