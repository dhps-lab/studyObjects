<?php
    class AssignStudyObject extends Controllers{
        public function __construct(){
            parent::__construct();
        }

        public function getAssignStudyObjectById($id){
            $data = $this->model->searchAssignStudyObjectById($id);
        }

        public function postStudyObject($codeTeacher, $codeAcademicArea, $codeStudyObject){
            $data = $this->model->saveAssignStudyObject($teacherCode, $codeAcademicArea, $codeStudyObject);
        }

        public function putAssignStudyObject($codeTeacher, $codeAcademicArea, $codeStudyObject, $id){
            $arrData = array($codeTeacher, $codeAcademicArea, $codeStudyObject, $id);
            $data = $this->model->updateAssignStudyObject($arrData);
        }

        public function deleteAssignStudyObject($id){
            $data = $this->model->deleteAssignStudyObject($id);
        }
    }
?>