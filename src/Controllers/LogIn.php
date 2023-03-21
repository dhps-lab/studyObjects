<?php
    class LogIn extends Controllers{
        public function __construct(){
            parent::__construct();
        }

        public function validatePassword(){
            $data = "";
            if(!isset($_POST['user']) || !isset($_POST['password'])){
                $arrResponse = array('status' => false, 'msg' => 'Usuario o contraseña erroneos');
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                return $arrResponse;
            }
            $user = strClean($_POST['user']);
            $pass = strClean($_POST['password']);
            $data = $this->model->validatePassword($user, $pass);
            if ($data == '') {
                $arrResponse = array('status' => false, 'msg' => 'Usuario o contraseña erroneos');
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                return $arrResponse;
            }
            $arrResponse = array('status' => True, 'msg' => 'Usuario y contraseña correctos');
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            return $arrResponse;
        }

        public function validateUser($user){
            $data = $this->model->validateUser($user);
        }

        public function getUserDisplayName($user){
            $data = $this->model->getUserDisplayName($user);
        }

        public function isConnectedUser($user){
            
        }
    }
?>