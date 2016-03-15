
<?php
session_start();
    class acao extends Controller{

        public function Index_action(){
            $acao = new acaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $acao_lista = $acao->listaacao("{$par}");

            $datas['acao'] = $acao_lista;

            if ($acao->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/acao/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $acao = new acaoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($acao->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/acao/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $acao = new acaoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($acao->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/acao/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $acao = new acaoModel();
            $id = $this->getParam('id');
            $detalhes_acao = $acao->listaacao('cdacao='.$id);
            $datas['acao'] = $detalhes_acao;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['acao'][0]['descricao'] );
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($acao->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/acao/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $acao = new acaoModel();
            $dados=$_POST;
            $atualiza = $acao->atualizaacao($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/acao/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/acao/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $acao = new acaoModel();
            $atualiza = $acao->excluiacao( 'cdacao='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($acao->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/acao/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $acao = new acaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($acao->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/acao/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $acao = new acaoModel();
            $insere = $acao->insereacao($_POST, 'cdacao');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/acao/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/acao/" );
            }

        }


        public function inserem( Array $dados = null ){
            $acao = new acaoModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['descricao'][0])) {
                $i=0;
                foreach ($dados['descricao'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_acao[$key]=$dados[$key][$i];
                    }
                    $insere = $acao->insereacao($dados_acao,'cdacao');
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

            header( "Location: /".PROJETO."/acao/" );


        }



        public function inserew(){
            $acao = new acaoModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='acao') {
                    $dados['acao'][$p[1]]=$value;
                }
            }

            $inserep = $acao->insereacao($dados['acao'], 'cdacao');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/acao/" );
            

        }

        public function pesquisa(){
            $acao = new acaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $projetos = new projetosModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
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

            $pesquisa = $acao->pesquisaacao($w);
            $datas['acao'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/acao/index', $datas);

    }


}