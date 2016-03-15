
<?php
session_start();
    class mensagem extends Controller{

        public function Index_action(){
            $mensagem = new mensagemModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $mensagem_lista = $mensagem->listamensagem("{$par}");

            $datas['mensagem'] = $mensagem_lista;

            if ($mensagem->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/mensagem/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $mensagem = new mensagemModel();
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
            if ($mensagem->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/mensagem/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $mensagem = new mensagemModel();
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
            if ($mensagem->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/mensagem/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $mensagem = new mensagemModel();
            $id = $this->getParam('id');
            $detalhes_mensagem = $mensagem->listamensagem('='.$id);
            $datas['mensagem'] = $detalhes_mensagem;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['mensagem'][0][''] );
            $chatgrupo = new chatgrupoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_chatgrupo = $chatgrupo->listachatgrupo("{$par}");

            $datas['chatgrupo'] = $detalhes_chatgrupo;
            if ($mensagem->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/mensagem/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $mensagem = new mensagemModel();
            $dados=$_POST;
            $atualiza = $mensagem->atualizamensagem($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/mensagem/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/mensagem/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $mensagem = new mensagemModel();
            $atualiza = $mensagem->excluimensagem( '='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($mensagem->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/mensagem/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $mensagem = new mensagemModel();
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
            if ($mensagem->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/mensagem/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $mensagem = new mensagemModel();			
			
            $insere = $mensagem->inseremensagem($_POST, '');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/mensagem/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/mensagem/" );
            }

        }


        public function inserem( Array $dados = null ){
            $mensagem = new mensagemModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados[''][0])) {
                $i=0;
                foreach ($dados[''] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_mensagem[$key]=$dados[$key][$i];
                    }
                    $insere = $mensagem->inseremensagem($dados_mensagem,'');
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

            header( "Location: /".PROJETO."/mensagem/" );


        }



        public function inserew(){
            $mensagem = new mensagemModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='chatmensagem') {
                    $dados['chatmensagem'][$p[1]]=$value;
                }
            }

            $inserep = $mensagem->inseremensagem($dados['chatmensagem'], '');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/mensagem/" );
            

        }

        public function pesquisa(){
            $mensagem = new mensagemModel();
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

            $pesquisa = $mensagem->pesquisamensagem($w);
            $datas['mensagem'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/mensagem/index', $datas);

    }


}