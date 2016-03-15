<?php
session_start();
    class Index extends Controller{

        public function Index_action(){
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
            $_SESSION[PROJETO]['mensagem']['texto'] = 'Cliente não encontrado.<br> Informe a identificação do cliente:';
            $this->view('index', $datas);
        }
        
        public function cliente(){
            $id = strtolower($this->getParam('id'));
            $datas['cliente'] = $id;
            if ($id=='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
            $_SESSION[PROJETO]['mensagem']['texto'] = 'Cliente não encontrado.<br> Informe a identificação do cliente:';
            header( "Location: /".PROJETO."/" );            
            } else {
            $clientes = new clientesModelpub();
            $clientes_lista = $clientes->listaclientes("ativo=1 and lower(sigla)='".$id."'");
            if ($clientes_lista[0]['cdcliente']!='') {
                 $datas['cdcliente']=$clientes_lista[0]['cdcliente'];
                 $datas['nomecliente']=$clientes_lista[0]['nome'];
                $this->view('cliente', $datas);
            } else {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
            $_SESSION[PROJETO]['mensagem']['texto'] = 'Cliente não informado.<br> Informe a identificação do cliente:';
            header( "Location: /".PROJETO."/" ); 
            }
            }
        }            
            
        

        public function pesquisa(){
            $sigla = strtolower($_POST['sigla']);
            
            if ($sigla=='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
            $_SESSION[PROJETO]['mensagem']['texto'] = 'Cliente não informado.<br> Informe a identificação do cliente:';
            header( "Location: /".PROJETO."/" );            
            } else {
            
            $clientes = new clientesModelpub();
            $clientes_lista = $clientes->listaclientes("ativo=1 and lower(sigla)='".$sigla."'");
            if ($clientes_lista[0]['cdcliente']!='') {
            header( "Location: /".PROJETO."/index/cliente/id/".$sigla );
            } else {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
            $_SESSION[PROJETO]['mensagem']['texto'] = 'Cliente não informado.<br> Informe a identificação do cliente:';
            header( "Location: /".PROJETO."/" ); 
            }
            }
        }

        public function verifica(){
 
            $id = strtolower($this->getParam('id'));   
            if ($id!='') {                                                
            $clientes = new clientesModelpub();
            $clientes_lista = $clientes->listaclientes("ativo=1 and lower(sigla)='".$id."'");
            if ($clientes_lista[0]['cdcliente']!='') {
            unset( $_SESSION[PROJETO] );
            $usuario = $_POST['usuario'];
            $pass = md5($_POST['pass']);
            $usuarios = new usuariosModelpub();
          
            $usuarios_lista = $usuarios->listaUsuarios("ativo=1 and login='{$usuario}' and senha='{$pass}' and cdperfil in 
            ( select p.cdperfil from perfil p, cliente c where p.cdcliente=c.cdcliente and c.ativo=1 and lower(c.sigla)='{$id}')");
            if (!(empty($usuarios_lista))) {
      
            $unidades = new setoresModelpub();
            if ($usuarios_lista[0]['cdunidade']!='') {
            $unidades_lista = $unidades->listasetores("cdunidade=".$usuarios_lista[0]['cdunidade']);
            }
            $_SESSION[PROJETO]['cdusuario'] = $usuarios_lista[0]['cdusuario'];
            $_SESSION[PROJETO]['nome'] = $usuarios_lista[0]['nome'];            
            $_SESSION[PROJETO]['login'] = $usuarios_lista[0]['login'];
            $_SESSION[PROJETO]['foto'] = $usuarios_lista[0]['foto'];
            $_SESSION[PROJETO]['cdperfil'] = $usuarios_lista[0]['cdperfil'];
            $_SESSION[PROJETO]['cdcliente'] = $clientes_lista[0]['cdcliente'];
            $_SESSION[PROJETO]['cliente'] = $clientes_lista[0]['sigla'];
            $_SESSION[PROJETO]['flickr_chave'] = $clientes_lista[0]['flickr_chave'];
            $_SESSION[PROJETO]['flickr_sec'] = $clientes_lista[0]['flickr_sec'];

            $_SESSION[PROJETO]['cdunidade'] = $unidades_lista[0]['cdunidade'];
            $_SESSION[PROJETO]['unidade'] = $unidades_lista[0]['nome'];
            //$_SESSION[PROJETO]['css'] = PROJETO.$clientes_lista[0]['cdlayout'].'.css';
            $_SESSION[PROJETO]['time'] = time();
            
            
            
            header( "Location: /".PROJETO."/principal/" );
            }
            else {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Usuário ou senha inválidos.';
            header( "Location: /".PROJETO."/index/cliente/id/".$id );
            }
            } else {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
            $_SESSION[PROJETO]['mensagem']['texto'] = 'Cliente não informado.<br> Informe a identificação do cliente:';
            header( "Location: /".PROJETO."/" ); 
            }
            }  else {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
            $_SESSION[PROJETO]['mensagem']['texto'] = 'Cliente não informado.<br> Informe a identificação do cliente:';
            header( "Location: /".PROJETO."/" ); 
            } 
        }

        public function recuperarsenha(){
            $this->view('/'.PROJETO.'/recuperarsenha.php', $datas);
        }

        public function sair(){
            $id = strtolower($this->getParam('id'));
            unset( $_SESSION[PROJETO] );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atenção!</strong>&nbsp;A sessão do usuário foi finalizada.';            
            header( "Location: /".PROJETO."/index/cliente/id/".$id );
            }


    }