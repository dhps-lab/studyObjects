<?php
    class LogIn extends Controllers{
        public function __construct(){
            parent::__construct();
        }

        public function validatePassword(){
            $data = "";
            if(!isset($_POST['user']) || !isset($_POST['password'])){
                $arrResponse = array(
                    'status' => false, 
                    'msg' => 'Usuario o contraseña erroneos'
                );
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
            $arrResponse = array(
                'status' => True, 
                'msg' => 'Usuario y contraseña correctos',
                'token' => $this->generateTokenUser($data['usuario_id'],$data['usuario_rol'])
            );
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            return $arrResponse;
        }

        public function validateUser($user){
            $data = $this->model->validateUser($user);
        }

        public function getUserDisplayName($user){
            $data = $this->model->getUserDisplayName($user);
        }

        public function generateTokenUser($userId, $usuario_rol){
            $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
            $payload = json_encode(['user_id' => $userId, 'user_rol' => $usuario_rol]);
            $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
            $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
            $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'abC123!', true);
            $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
            $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
            return $jwt;
        }
    }
?>