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

        public function getStudyObject(){
            $arrData = $this->model->searchAllStudyObject();
            for($i=0; $i<count($arrData); $i++){
                $arrData[$i]['acciones'] = '<div class="text-center">
                <button class="btn btn-outline-secondary btn-sm" id="btnEditLR" onclick="editStudyObjectModal(this)" title="Editar" lr="'.$arrData[$i]['codigo'].'"><i class="fas fa-pencil-alt"></i></button>
                <button class="btn btn-outline-danger btn-sm" id="btnDeleteLR" onclick="deleteStudyObject(this) "title="Eliminar" lr="'.$arrData[$i]['codigo'].'"><i class="far fa-trash-alt"></i></button>
                </div>';
            };
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getStudyObjectById(int $idLR){
            $id = intval(strClean($idLR));
            if($id > 0){
                $arrData = $this->model->searchStudyObjectById($idLR);
                $this->getByIdSOMessage($arrData);
            }
            die();
        }

        public function postStudyObject(){
            $code = $this->getLastCode() + 1;
            $name = strClean($_POST['txtNameAdd']);
            $description = strClean($_POST['txtDescriptionAdd']);
            $data = $this->model->saveStudyObject($code, $name, $description);
            $this->postPutSOMessage($data);
        }

        public function putStudyObject(int $id){
            $name = strClean($_POST['txtNameEdit']);
            $description = strClean($_POST['txtDescriptionEdit']);
            $data = $this->model->updateStudyObject($id, $name, $description);
            $this->postPutSOMessage($data);
        }

        public function deleteStudyObject(int $id){
            $data = $this->model->deleteStudyObject($id);
            $this->deleteSOMessage($data);
        }

        private function getLastCode(){
            $data = $this->model->searchLastCode();
            return $data[0]['code'];
        }

        private function postPutSOMessage($arrData){
            $arrResponse = "";
            if($arrData > 0){
                $arrResponse = array('status' => true, 'msg' => 'Datos procesados correctamente.');
            } else if($arrData == 'exist'){
                $arrResponse = array('status' => false, 'msg' => '¡Advertencia! El objeto de estudio ya existe.');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }

        private function getByIdSOMessage($arrData){
            $arrResponse = "";
            if (empty($arrData)){
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
            } else {
                $arrResponse = array('status' => true, 'msg' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            return $arrResponse;
        }

        private function deleteSOMessage($arrData){
            $arrResponse = "";
            if (empty($arrData)){
                $arrResponse = array('status' => false, 'msg' => 'No es poisble eliminar los datos.');
            } else {
                $arrResponse = array('status' => true, 'msg' => 'El objeto de estudio ha sido eliminado');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            return $arrResponse;
        }
    }
?>