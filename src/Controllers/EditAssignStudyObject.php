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

        public function getAssignStudyObjectById(int $idASO){
            $id = intval(strClean($idASO));
            if($id > 0){
                $arrData = $this->model->searchAssignStudyObjectById($idASO);
                $this->getByIdASOMessage($arrData);
            }
            die();
        }

        public function getAssignStudyObject(){
            $arrData = $this->model->searchAssignStudyObject();
            for($i=0; $i<count($arrData); $i++){
                $arrData[$i]['acciones'] = '<div class="text-center">
                <button class="btn btn-outline-secondary btn-sm" id="btnEditSO" onclick="editAssignStudyObjectModal(this)" title="Editar" alr="'.$arrData[$i]['id'].'"><i class="fas fa-pencil-alt"></i></button>
                <button class="btn btn-outline-danger btn-sm" id="btnDeleteSO" onclick="deleteAssignStudyObject(this) "title="Eliminar" alr="'.$arrData[$i]['id'].'"><i class="far fa-trash-alt"></i></button>
                </div>';
            };
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function postAssignStudyObject(){
            if($_POST){
                if(empty($_POST['listStudyObject']) || empty($_POST['listTeacher']) || empty($_POST['listSubject'])){
                    $arrResponse = array("status" => false, "msg" => "Datos incorrectos.");
                } else {
                    $intStudyObject = intval(strClean($_POST['listStudyObject']));
                    $intTeacher = intval(strClean($_POST['listTeacher']));
                    $intSubject = intval(strClean($_POST['listSubject']));
                    $requestASO = $this->model->saveAssignStudyObject($intTeacher, $intSubject, $intStudyObject);
                    $arrResponse = $this->postPutAssignSOMessage($requestASO);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function putAssignStudyObject(int $intId){
            $intStudyObject = intval(strClean($_POST['listEditStudyObject']));
            $intTeacher = intval(strClean($_POST['listEditTeacher']));
            $intSubject = intval(strClean($_POST['listEditSubject']));
            $requestASO = $this->model->updateAssignStudyObject($intTeacher, $intSubject, $intStudyObject, $intId);
            $arrResponse = $this->postPutAssignSOMessage($requestASO);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function deleteAssignStudyObject($id){
            $data = $this->model->deleteAssignStudyObject($id);
            $this->deleteAssignSOMessage($data);
        }

        private function getByIdASOMessage($arrData){
            $arrResponse = "";
            if (empty($arrData)){
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
            } else {
                $arrResponse = array('status' => true, 'msg' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            return $arrResponse;
        }

        private function postPutAssignSOMessage($arrData){
            $arrResponse = "";
            if($arrData > 0){
                $arrResponse = array('status' => true, 'msg' => 'Datos procesados correctamente.');
            } else if($arrData == 'exist'){
                $arrResponse = array('status' => false, 'msg' => '¡Advertencia! La asignación ya existe.');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
            }
            return $arrResponse;
        }

        private function deleteAssignSOMessage($arrData){
            $arrResponse = "";
            if (empty($arrData)){
                $arrResponse = array('status' => false, 'msg' => 'No es poisble eliminar los datos.');
            } else {
                $arrResponse = array('status' => true, 'msg' => 'El objeto de estudio a sido eliminado');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            return $arrResponse;
        }
    }
?>