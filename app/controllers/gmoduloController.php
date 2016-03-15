
<?php
session_start();
    class gmodulo extends Controller{

        public function Index_action(){
            $gmodulo = new gmoduloModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $gmodulo_lista = $gmodulo->listagmodulo("{$par}");

            $datas['gmodulo'] = $gmodulo_lista;

            if ($gmodulo->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/gmodulo/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){

            $lmodulos = new modulosModel();
            $detalhes_lmodulo = $lmodulos->listaModulos();
            $datas['lmodulos'] = $detalhes_lmodulo;        
        
           $gmodulo = new gmoduloModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($gmodulo->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/gmodulo/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $gmodulo = new gmoduloModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($gmodulo->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/gmodulo/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){


            $lmodulos = new modulosModel();
            $detalhes_lmodulo = $lmodulos->listaModulos();
            $datas['lmodulos'] = $detalhes_lmodulo;

            $gmodulo = new gmoduloModel();
            $id = $this->getParam('id');
            $detalhes_gmodulo = $gmodulo->listagmodulo('cdmodulo='.$id);
            $datas['gmodulo'] = $detalhes_gmodulo;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['gmodulo'][0]['nome'] );
            if ($gmodulo->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/gmodulo/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $gmodulo = new gmoduloModel();
            
            if (empty($_POST['bloqueado'])) {$_POST['bloqueado']='';}
            
            $dados=$_POST;
            $atualiza = $gmodulo->atualizagmodulo($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/gmodulo/editar/id/{$id}" );

            } else {

            $_SESSION['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/gmodulo/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $gmodulo = new gmoduloModel();
            $atualiza = $gmodulo->excluigmodulo( 'cdmodulo='.$id );
            $_SESSION['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($gmodulo->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/gmodulo/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $gmodulo = new gmoduloModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            if ($gmodulo->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/gmodulo/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $gmodulo = new gmoduloModel();			
			
            $insere = $gmodulo->inseregmodulo($_POST, 'cdmodulo');

            if ($insere==0) {
              $_SESSION['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/gmodulo/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/gmodulo/" );
            }

        }


        public function inserem( Array $dados = null ){
            $gmodulo = new gmoduloModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdmodulo'][0])) {
                $i=0;
                foreach ($dados['cdmodulo'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_gmodulo[$key]=$dados[$key][$i];
                    }
                    $insere = $gmodulo->inseregmodulo($dados_gmodulo,'cdmodulo');
                    $i++;
                }

            }

           if ($insere==0) {
              $_SESSION['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso. Registros inseridos.';
            }

            header( "Location: /".PROJETO."/gmodulo/" );


        }



        public function inserew(){
            $gmodulo = new gmoduloModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='modulo') {
                    $dados['modulo'][$p[1]]=$value;
                }
            }

            $inserep = $gmodulo->inseregmodulo($dados['modulo'], 'cdmodulo');


            if ($insere==0) {
              $_SESSION['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/gmodulo/" );
            

        }

        public function pesquisa(){
            $gmodulo = new gmoduloModel();
            $datas['vc'] = $this->modvinculados(get_class($this));$filtro='';
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

            $pesquisa = $gmodulo->pesquisagmodulo($w);
            $datas['gmodulo'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/gmodulo/index', $datas);

    }


}
