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

        public function getSubject(){
            $htmlOptions = "";
            $arrData = $this->model->searchAllSubject();
            if(count($arrData) > 0){
                for($i = 0; $i <count($arrData); $i++){
                    $htmlOptions .= '<option value="'.$arrData[$i]['codigo'].'">'.$arrData[$i]['nombre'].'</option>';
                }
            }
            echo $htmlOptions;
            die();
        }

	public function getSOTitleById(int $codeSO){
            $data = $this->model->searchSOTitleById($codeSO);
            return $data['descripcion'];
        }

        public function getSubjectById(int $codeSO){
            $arrData = $this->model->searchAllSubjectBySO($codeSO);
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
	    die();
        }
    }
?>