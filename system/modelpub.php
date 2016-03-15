<?php
session_start();

    class Modelpub{
        public $_db;
        public $_db2;
        public $_tabela;
        public $_conexao;
        public function  __construct(){
        try {           

            $this->_db = new PDO('pgsql:host=localhost;dbname='.PROJETO.'conf', 'postgres', 'post82');
            $this->_db2 = $this->_db;
            
        } catch (PDOException  $e) {

            }
        }

        public function read( $where = null, $limit = null, $offset = null, $orderby = null ){   
            $where = ($where != null ? "WHERE {$where}" : "");
            $limit = ($limit != null ? "LIMIT {$limit}" : "");
            $offset = ($offset != null ? "OFFSET {$offset}" : "");
            $orderby = ($orderby != null ? "ORDER BY {$orderby}" : "");
            //echo " SELECT * FROM {$this->_tabela} {$where} {$orderby} {$limit} {$offset} ";               
            $q = $this->_db->prepare(" SELECT * FROM {$this->_tabela} {$where} {$orderby} {$limit} {$offset} ");
            if ($q) {
            $q->execute();
            $q->setFetchMode(PDO::FETCH_ASSOC);
            return $q->fetchAll();
            } else { return null; }            
            
        }

        public function rssql( $sql, $conex = '2' ){
            if ($conex=='2') {
            $this->_dbc = new PDO('pgsql:host=localhost;dbname='.PROJETO.$_SESSION[PROJETO]['cliente'], 'postgres', 'post82');
            } else {
            $this->_dbc = new PDO('pgsql:host=localhost;dbname='.PROJETO.'conf', 'postgres', 'post82');
            }
            //echo $sql;
            $q = $this->_dbc->prepare("{$sql}");
            if ($q) {
            $q->execute();
            $q->setFetchMode(PDO::FETCH_ASSOC);
            return $q->fetchAll();
            } else { return null; }
        }
        
               

       



        public function acesso( $modulo, $op, $perfil ){

        if ($perfil=='') {
           $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
           $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Sua sessão foi encerrada, efetue o login novamente.';
            header( "Location: /".PROJETO."/" );
        }
            $q = $this->_db2->query(" SELECT p.{$op} as acesso FROM modulo m, perfil_modulo p where m.cdmodulo=p.cdmodulo and m.link='{$modulo}' and p.cdperfil={$perfil} ");            
            $q->setFetchMode(PDO::FETCH_ASSOC);
            $r = $q->fetchAll();
            return $r[0]['acesso'];
        }





 
        
           


    }
