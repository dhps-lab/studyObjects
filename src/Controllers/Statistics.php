<?php
    class Statistics extends Controllers{

        public function __construct(){
            parent::__construct();
        }

        public function Statistics(){
            $data['page_tag'] = "Estadísticas";
            $data['page_title'] = "Tratamiento estadístico";
            $data['page_functions_js'] = "functions_stats.js";
            $data['amount_study_object'] = $this->model->amountStudyObject();
            $data['amount_subject'] = $this->model->amountSubject();
            $data['amount_teacher'] = $this->model->amountTeacher();
            $data['amount_assign_study_object'] = $this->model->amountAssignStudyObject();
            $data['study_object_component'] = $this->model->studyObjectComponent();
            $data['study_object_teacher_subject'] = $this->model->studyObjectTeacherSubject();
            $data['study_object_subject'] = $this->model->studyObjectSubject();
            $data['study_object_subject_component'] = $this->model->studyObjectSubjectComponent();
            $data['subject_component'] = $this->model->subjectComponent();
            echo '$data => '.$data;
            /*dep($data['subject_component']);
            exit;*/

            $this->views->getView($this,"Statistics",$data);
        }
        public function methodStatistic($method){
            $method = $_POST['method'];

            //echo json_encode($_SERVER, JSON_UNESCAPED_UNICODE);
            $data = '';
            if(empty($method)){
                $arrResponse = array("status" => false, "msg" => "Datos incorrectos.", "data" => $data);
            }else{
                $data = $this->model->{$method}();
                $arrResponse = array("status" => True, "msg" => "Datos consultados correctamente.", "data" => $data);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            return $arrResponse;
        }
    }
?>