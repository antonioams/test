<?php
session_start();

    class Model{
        public $_db;
        public $_db2;
        public $_tabela;
        public $_conexao;
        public function  __construct(){
        try {      

		if ($_SESSION[PROJETO]['cdperfil']=='') {
    		$_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
   		    $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Sua sessão foi encerrada, efetue o login novamente.';
    		header( "Location: /".PROJETO."/" );
		}        
                  
                
		     if ($this->_conexao=='2') {
            $this->_db = new PDO('pgsql:host=localhost;dbname='.PROJETO.$_SESSION[PROJETO]['cliente'], 'postgres', 'post82');
            $this->_db2 = new PDO('pgsql:host=localhost;dbname='.PROJETO.'conf', 'postgres', 'post82');
            } else {
            $this->_db = new PDO('pgsql:host=localhost;dbname='.PROJETO.'conf', 'postgres', 'post82');
            $this->_db2 = $this->_db;
            }
        } catch (PDOException  $e) {
          //$_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
   		    //$_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Sua sessão foi encerrada, efetue o login novamente.';
            //header( "Location: /".PROJETO."/" );
            //print $e->getMessage();
            }
        }

        public function insert( Array $dados, $chave ){      
            $i=0;
            $pr='';

            foreach ( $dados as $ind => $val ){
                if ( (!(is_array($val))) and ($ind!='submit')) {
                    if ($val!='') {
                        $camposa[$i] = $ind;
                        $val = str_replace("'", "", $val);
                        $valoresa[$i] = $val;
                        $dadoslog .= $ind.'='.$val.chr(13);
                        if ($ind=='cdprojeto') {
                           $pr=$val;
                        }
                    }
                }
                $i++;
            }
            $campos = implode(", ", array_values($camposa));
            $valores = "'".implode("','", array_values($valoresa))."'";
//              echo " INSERT INTO {$this->_tabela} ({$campos}) VALUES ({$valores}) returning ".$chave;
              $q = $this->_db->prepare(" INSERT INTO {$this->_tabela} ({$campos}) VALUES ({$valores}) returning ".$chave);              
              $q->execute();
              $q->setFetchMode(PDO::FETCH_ASSOC);
              $r = $q->fetchAll();              
              $res=$r[0][$chave];
              //if ($this->_db->errorInfo()[2]!='') {              
              //$res = ''; }              
              
              $log = $this->_db->query(" INSERT INTO LOG (cdusuario, data, entidade, operacao, dados, cdprojeto ) values (".$_SESSION[PROJETO]['cdusuario'].", current_timestamp, '{$this->_tabela}', 'inserir', '{$dadoslog}', '{$pr}'  )");            
                return $res;             
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
        
        
        public function rsjs( $sql, $conex = '2' ){
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
            return json_encode($q->fetchAll());
            } else { return null; }
            
                        
        }        

        public function sel( $sql ){
            //echo $sql;
            $q = $this->_db->query("{$sql}");
            $q->setFetchMode(PDO::FETCH_ASSOC);
            return $q->fetchAll();
        }

        public function update( Array $dados, $where ){
        $pr='';
            foreach ( $dados as $ind => $val ){
            if ( (!(is_array($val))) and ($ind!='submit')) {
                $val = str_replace("'", "", $val);
                $dadoslog .= $ind.'='.$val.chr(13);
                        if ($ind=='cdprojeto') {
                           $pr=$val;
                        }
                
                if ($val!='') { $campos[] = "{$ind} = '{$val}'"; } 
                else { $campos[] = "{$ind} = null"; }
            }
        }
            $campos = implode(", ", $campos);
            //die" UPDATE {$this->_tabela} SET {$campos} WHERE {$where} ");
            
            $q = $this->_db->prepare(" UPDATE {$this->_tabela} SET {$campos} WHERE {$where} ");
            $q->execute();
            $res='1';
            if ($this->_db->errorInfo()[2]!='') {
            $res = ''; }
            $q->setFetchMode(PDO::FETCH_ASSOC);
            $log = $this->_db->query(" INSERT INTO LOG (cdusuario, data, entidade, operacao, dados, cdprojeto ) values (".$_SESSION[PROJETO]['cdusuario'].", current_timestamp, '{$this->_tabela}', 'editar', '{$dadoslog}', '{$pr}' )");        
            return $res;                    

        }

        public function delete( $where ){ 
            $q = $this->_db->prepare(" DELETE FROM {$this->_tabela} WHERE {$where} ");            
            $q->execute();
            $res='1';
            if ($this->_db->errorInfo()[2]!='') {
            $res = ''; }
            $q->setFetchMode(PDO::FETCH_ASSOC);
            $log = $this->_db->query(" INSERT INTO LOG (cdusuario, data, entidade, operacao, dados ) values (".$_SESSION[PROJETO]['cdusuario'].", current_timestamp, '{$this->_tabela}', 'excluir', '{$where}' )");
            return $res;
     
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


        public function listcol($tab, $conexaog){

          if ($conexaog=='2') {
                $db = new PDO('pgsql:host=localhost;dbname='.PROJETO.$_SESSION[PROJETO]['cliente'], 'postgres', 'post82');
            } else {
                $db = new PDO('pgsql:host=localhost;dbname='.PROJETO.'conf', 'postgres', 'post82');
            }

            $stmt = $db->query(" SELECT * FROM {$tab} LIMIT 1 ");

            $cnt_columns = $stmt->columnCount();
            for($i = 0; $i < $cnt_columns; $i++) {
            $metadata[$i]['nome'] = $stmt->getColumnMeta($i)['name'];
            $metadata[$i]['tipo'] = $stmt->getColumnMeta($i)['native_type'];
            }

            return $metadata;
        }

        public function adtab( $tab, $conexaog ){

          if ($conexaog=='2') {
                $db = new PDO('pgsql:host=localhost;dbname='.PROJETO.$_SESSION[PROJETO]['cliente'], 'postgres', 'post82');
            } else {
                $db = new PDO('pgsql:host=localhost;dbname='.PROJETO.'conf', 'postgres', 'post82');
            }

            return $db->query(" CREATE TABLE {$tab} (cd{$tab} SERIAL PRIMARY KEY); ");
        }

        public function adcol( $tab, $coluna, $tipo, $conexaog ){

          if ($conexaog=='2') {
                $db = new PDO('pgsql:host=localhost;dbname='.PROJETO.$_SESSION[PROJETO]['cliente'], 'postgres', 'post82');
            } else {
                $db = new PDO('pgsql:host=localhost;dbname='.PROJETO.'conf', 'postgres', 'post82');
            }

            return $db->query(" ALTER TABLE {$tab} ADD {$coluna} {$tipo} ");
        }
        
        
        public function addb( $cliente, $conexaog, $temp ){

          if ($conexaog=='2') {
                $db = new PDO('pgsql:host=localhost;dbname='.PROJETO.$_SESSION[PROJETO]['cliente'], 'postgres', 'post82');
            } else {
                $db = new PDO('pgsql:host=localhost;dbname='.PROJETO.'conf', 'postgres', 'post82');
            }
            $template='TEMPLATE = '.PROJETO.'baselimpa';
            
            if ($temp!='') {
            
            $template='TEMPLATE = '.PROJETO.$temp;
            
            }
            $cliente = strtolower($cliente);         

             $db->query(" 
       CREATE DATABASE ".PROJETO.$cliente."
       WITH OWNER = postgres
       ENCODING = 'UTF8'
       ".$template."
       TABLESPACE = pg_default
       LC_COLLATE = 'en_US.UTF-8'
       LC_CTYPE = 'en_US.UTF-8'       
       CONNECTION LIMIT = -1; ");
       
       
       return $db->query("ALTER DATABASE ".PROJETO.$cliente." SET DateStyle='sql, dmy';");
	   
	
        }        


    }
