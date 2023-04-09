<?php
    class Statistics extends Controllers{

        public function __construct(){
            parent::__construct();
        }

        public function Statistics(){
            $data['page_tag'] = "Estadísticas";
            $data['page_title'] = "Tratamiento estadístico";
            $data['page_functions_js'] = "functions_stats.js";
            /*dep($data['subject_component']);
            exit;*/

            $this->views->getView($this,"Statistics",$data);
        }
    }
?>