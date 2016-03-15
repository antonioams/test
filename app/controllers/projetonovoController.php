
<?php
session_start();
    class projetonovo extends Controller{

        public function Index_action(){

             header( "Location: /".PROJETO."/projetos/novo/" );
 
 }
}