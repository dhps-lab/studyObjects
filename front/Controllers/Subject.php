<?php
    class Subject extends Controllers{
        public function __construct(){
            parent::__construct();
        }

        public function Subject(int $codeSO){
            $data['page_tag'] = $this->getSOTitleById($codeSO);
            $data['page_title'] = $this->getSOTitleById($codeSO);
            $data['page_functions_js'] = "functions_subjects_so.js";
            $this->views->getView($this,"Subject",$data);
            echo 'load';
        }
    }
?>