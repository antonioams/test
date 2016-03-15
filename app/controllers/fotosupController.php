
<?php
session_start();
    class fotosup extends Controller{

        public function Index_action(){
            
                $this->view('/fotosup/index', $datas);
            
        }



}