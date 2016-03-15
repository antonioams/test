
<?php
session_start();
    class chatgrupoparticipante extends Controller{

        public function Index_action(){
            $chatgrupoparticipante = new chatgrupoparticipanteModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $chatgrupoparticipante_lista = $chatgrupoparticipante->listachatgrupoparticipante("{$par}");

            $datas['chatgrupoparticipante'] = $chatgrupoparticipante_lista;

            if ($chatgrupoparticipante->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/chatgrupoparticipante/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $chatgrupoparticipante = new chatgrupoparticipanteModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $chatgrupo = new chatgrupoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_chatgrupo = $chatgrupo->listachatgrupo("{$par}");

            $datas['chatgrupo'] = $detalhes_chatgrupo;
            if ($chatgrupoparticipante->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/chatgrupoparticipante/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $chatgrupoparticipante = new chatgrupoparticipanteModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $chatgrupo = new chatgrupoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_chatgrupo = $chatgrupo->listachatgrupo("{$par}");

            $datas['chatgrupo'] = $detalhes_chatgrupo;
            if ($chatgrupoparticipante->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/chatgrupoparticipante/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $chatgrupoparticipante = new chatgrupoparticipanteModel();
            $id = $this->getParam('id');
            $detalhes_chatgrupoparticipante = $chatgrupoparticipante->listachatgrupoparticipante('='.$id);
            $datas['chatgrupoparticipante'] = $detalhes_chatgrupoparticipante;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['chatgrupoparticipante'][0][''] );
            $chatgrupo = new chatgrupoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_chatgrupo = $chatgrupo->listachatgrupo("{$par}");

            $datas['chatgrupo'] = $detalhes_chatgrupo;
            if ($chatgrupoparticipante->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/chatgrupoparticipante/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $chatgrupoparticipante = new chatgrupoparticipanteModel();
            $dados=$_POST;
            $atualiza = $chatgrupoparticipante->atualizachatgrupoparticipante($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/chatgrupoparticipante/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/chatgrupoparticipante/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $chatgrupoparticipante = new chatgrupoparticipanteModel();
            $atualiza = $chatgrupoparticipante->excluichatgrupoparticipante( '='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($chatgrupoparticipante->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/chatgrupoparticipante/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $chatgrupoparticipante = new chatgrupoparticipanteModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $chatgrupo = new chatgrupoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_chatgrupo = $chatgrupo->listachatgrupo("{$par}");

            $datas['chatgrupo'] = $detalhes_chatgrupo;
            if ($chatgrupoparticipante->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/chatgrupoparticipante/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $chatgrupoparticipante = new chatgrupoparticipanteModel();			
			
            $insere = $chatgrupoparticipante->inserechatgrupoparticipante($_POST, '');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/chatgrupoparticipante/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/chatgrupoparticipante/" );
            }

        }


        public function inserem( Array $dados = null ){
            $chatgrupoparticipante = new chatgrupoparticipanteModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados[''][0])) {
                $i=0;
                foreach ($dados[''] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_chatgrupoparticipante[$key]=$dados[$key][$i];
                    }
                    $insere = $chatgrupoparticipante->inserechatgrupoparticipante($dados_chatgrupoparticipante,'');
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

            header( "Location: /".PROJETO."/chatgrupoparticipante/" );


        }



        public function inserew(){
            $chatgrupoparticipante = new chatgrupoparticipanteModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='chatgrupoparticipante') {
                    $dados['chatgrupoparticipante'][$p[1]]=$value;
                }
            }

            $inserep = $chatgrupoparticipante->inserechatgrupoparticipante($dados['chatgrupoparticipante'], '');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/chatgrupoparticipante/" );
            

        }

        public function pesquisa(){
            $chatgrupoparticipante = new chatgrupoparticipanteModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $chatgrupo = new chatgrupoModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='') ) {
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

            $pesquisa = $chatgrupoparticipante->pesquisachatgrupoparticipante($w);
            $datas['chatgrupoparticipante'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/chatgrupoparticipante/index', $datas);

    }


}