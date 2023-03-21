<?php
    class LogInModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }

        public function validatePassword(string $user, string $password){
            $querySelect = "SELECT * FROM usuarios WHERE usuario_id = '$user' and usuario_clave = '$password'";
            $request = $this->select($querySelect);
            return $request;
        }

	    public function validateUser(int $user){
            $querySelect = "SELECT usuario_display_nombre FROM usuarios WHERE usuario_id = $user";
            $request = $this->select($querySelect);
            return $request;
        }

        public function getUserDisplayName(int $user){
            $querySelect = "SELECT usuario_display_nombre FROM usuarios WHERE usuario_id = $user";
            $request = $this->select($querySelect);
            return $request;
        }

    }
?>