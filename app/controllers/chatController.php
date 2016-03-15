
<?php
session_start();
    class chat extends Controller{

        public function Index_action(){
            $chat = new chatModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $chat_lista = $chat->listachat("{$par}");

            $datas['chat'] = $chat_lista;

            if ($chat->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/chat/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $chat = new chatModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $chat = new chatModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_chat = $chat->listachat("{$par}");

            $datas['chat'] = $detalhes_chat;
            if ($chat->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/chat/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $chat = new chatModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $chat = new chatModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_chat = $chat->listachat("{$par}");

            $datas['chat'] = $detalhes_chat;
            if ($chat->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/chat/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $chat = new chatModel();
            $id = $this->getParam('id');
            $detalhes_chat = $chat->listachat('='.$id);
            $datas['chat'] = $detalhes_chat;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['chat'][0][''] );
            $chat = new chatModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_chat = $chat->listachat("{$par}");

            $datas['chat'] = $detalhes_chat;
            if ($chat->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/chat/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $chat = new chatModel();
            $dados=$_POST;
            $atualiza = $chat->atualizachat($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/chat/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/chat/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $chat = new chatModel();
            $atualiza = $chat->excluichat( '='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($chat->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/chat/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $chat = new chatModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $chat = new chatModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_chat = $chat->listachat("{$par}");

            $datas['chat'] = $detalhes_chat;
            if ($chat->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/chat/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $chat = new chatModel();			
			
            $insere = $chat->inserechat($_POST, '');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/chat/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/chat/" );
            }

        }


        public function inserem( Array $dados = null ){
            $chat = new chatModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados[''][0])) {
                $i=0;
                foreach ($dados[''] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_chat[$key]=$dados[$key][$i];
                    }
                    $insere = $chat->inserechat($dados_chat,'');
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

            header( "Location: /".PROJETO."/chat/" );


        }



        public function inserew(){
            $chat = new chatModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='chat') {
                    $dados['chat'][$p[1]]=$value;
                }
            }

            $inserep = $chat->inserechat($dados['chat'], '');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/chat/" );
            

        }

        public function pesquisa(){
            $chat = new chatModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $chat = new chatModel();
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

            $pesquisa = $chat->pesquisachat($w);
            $datas['chat'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/chat/index', $datas);

    }


}