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
        }

        public function getSOTitleById(int $codeSO){
            $url = BACK_URL . "/Subject/getSOTitleById/" . $codeSO;
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            echo $response;
            curl_close($ch);
            //$data = $this->model->searchSOTitleById($codeSO);
            return $response;
        }
    }
?>