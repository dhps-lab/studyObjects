<?php
    class Connection{
        private $connect;

        public function __construct(){
            $connectionString = "mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";charset=".DB_CHARSET;
            try{
                $this->connect = new PDO($connectionString, DB_USER, DB_PASS);
                $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
               $this->connect = "Could not connect to database";
               echo "\n ERROR: ". $e;
            }
        }

        public function connect(){
            return $this->connect;
        }
    }
?>