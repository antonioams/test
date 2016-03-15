
<?php
session_start();
    class logs extends Controller{

        public function Index_action(){
            $logs = new logsModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $logs_lista = $logs->listalogs("{$par}");

            $datas['logs'] = $logs_lista;

            if ($logs->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
            
              if (count($logs_lista)>1000) {
                 header( "Location: /".PROJETO."/logs/pesquisar/" );
              } else {
                $this->view('/logs/index', $datas);
              }
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $logs = new logsModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $usuarios = new usuariosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdusuario') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_usuarios = $usuarios->listausuarios("{$par}");

            $datas['usuarios'] = $detalhes_usuarios;
            if ($logs->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/logs/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $logs = new logsModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $usuarios = new usuariosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdusuario') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_usuarios = $usuarios->listausuarios("{$par}");

            $datas['usuarios'] = $detalhes_usuarios;
            if ($logs->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/logs/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $logs = new logsModel();
            $id = $this->getParam('id');
            $detalhes_logs = $logs->listalogs('cdlog='.$id);
            $datas['logs'] = $detalhes_logs;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['logs'][0]['data'] );
            $usuarios = new usuariosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdusuario') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_usuarios = $usuarios->listausuarios("{$par}");

            $datas['usuarios'] = $detalhes_usuarios;
            if ($logs->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/logs/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $logs = new logsModel();
            $dados=$_POST;
            $atualiza = $logs->atualizalogs($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/logs/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/logs/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $logs = new logsModel();
            $atualiza = $logs->excluilogs( 'cdlog='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($logs->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/logs/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $logs = new logsModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $usuarios = new usuariosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdusuario') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_usuarios = $usuarios->listausuarios("{$par}");

            $datas['usuarios'] = $detalhes_usuarios;
            if ($logs->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/logs/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $logs = new logsModel();
            $insere = $logs->inserelogs($_POST, 'cdlog');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/logs/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/logs/" );
            }

        }


        public function inserem( Array $dados = null ){
            $logs = new logsModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['entidade'][0])) {
                $i=0;
                foreach ($dados['entidade'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_logs[$key]=$dados[$key][$i];
                    }
                    $insere = $logs->inserelogs($dados_logs,'cdlog');
                    $i++;
                }

            }

           if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso. Registros inseridos.';
            }

            header( "Location: /".PROJETO."/logs/" );


        }



        public function inserew(){
            $logs = new logsModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='log') {
                    $dados['log'][$p[1]]=$value;
                }
            }

            $inserep = $logs->inserelogs($dados['log'], 'cdlog');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/logs/" );
            

        }

        public function pesquisa(){
            $logs = new logsModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $usuarios = new usuariosModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdusuario') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }$filtro='';
            foreach ($_POST as $key => $value) {
                    if ( ($key!="submit") and ($value!="")) {
                              $vop='';
                              if (is_array($value)) { $value=implode( ',' , $value); }
                         if (substr($key, 1, 1)=="1") { $op=" >= "; } elseif (substr($key, 1, 1)=="2") { $op=" <= "; } elseif (substr($key, 1, 1)=="3") { $op=" in "; $vop=" Esteja em "; } else { $op=" = "; }
                        if (substr($key, 0, 1)=="s"){
                            $vop=' Contenha ';
                            $w .= ($w=="") ? "upper(".substr($key, 2).") like upper("."'%".$value."%')" : " and upper(".substr($key, 2).") like upper("."'%".$value."%')" ;
                        } else if (substr($key, 0, 1)=="d") {
                            $w .= ($w=="") ? substr($key, 2).$op."'".$value."'" : " and ".substr($key, 2).$op."'".$value."'" ;
                        } else if (substr($key, 0, 1)=="i") {
                            $w .= ($w=="") ? substr($key, 2).$op.$value : " and ".substr($key, 2).$op.$value ;
                        } else if (substr($key, 0, 1)=="m") {
                            $val = str_replace(",", "','", $value);
                            $w .= ($w=="") ? substr($key, 2).$op."('".$val."')" : " and ".substr($key, 2).$op."('".$val."')" ;
                        }
                          if ($vop!='') {$op=$vop;}
                          $filtro .= '<br>'.substr($key, 2).$op.$value;

                    }
                }
            if ($w!='') { if ($par!='') { $w.=' and '.$par; } }
            else { if ($par!='') {$w=$par;} }

            $pesquisa = $logs->pesquisalogs($w,500);
            $datas['logs'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/logs/index', $datas);

    }


}
