
<?php
session_start();
    class instituicoes extends Controller{

        public function Index_action(){
            $instituicoes = new instituicoesModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $instituicoes_lista = $instituicoes->listainstituicoes("{$par}");

            $datas['instituicoes'] = $instituicoes_lista;

            if ($instituicoes->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/instituicoes/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $instituicoes = new instituicoesModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($instituicoes->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/instituicoes/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $instituicoes = new instituicoesModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($instituicoes->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/instituicoes/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $instituicoes = new instituicoesModel();
            $id = $this->getParam('id');
            $detalhes_instituicoes = $instituicoes->listainstituicoes('cdinstituicao='.$id);
            $datas['instituicoes'] = $detalhes_instituicoes;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['instituicoes'][0]['sigla'] );
            if ($instituicoes->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/instituicoes/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $instituicoes = new instituicoesModel();
            $dados=$_POST;
            $atualiza = $instituicoes->atualizainstituicoes($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/instituicoes/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/instituicoes/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $instituicoes = new instituicoesModel();
            $atualiza = $instituicoes->excluiinstituicoes( 'cdinstituicao='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($instituicoes->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/instituicoes/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $instituicoes = new instituicoesModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            if ($instituicoes->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/instituicoes/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $instituicoes = new instituicoesModel();
            $insere = $instituicoes->insereinstituicoes($_POST, 'cdinstituicao');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/instituicoes/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/instituicoes/" );
            }

        }


        public function inserem( Array $dados = null ){
            $instituicoes = new instituicoesModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['sigla'][0])) {
                $i=0;
                foreach ($dados['sigla'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_instituicoes[$key]=$dados[$key][$i];
                    }
                    $insere = $instituicoes->insereinstituicoes($dados_instituicoes,'cdinstituicao');
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

            header( "Location: /".PROJETO."/instituicoes/" );


        }



        public function inserew(){
            $instituicoes = new instituicoesModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='instituicao') {
                    $dados['instituicao'][$p[1]]=$value;
                }
            }

            $inserep = $instituicoes->insereinstituicoes($dados['instituicao'], 'cdinstituicao');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/instituicoes/" );
            

        }

        public function pesquisa(){
            $instituicoes = new instituicoesModel();
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

            $pesquisa = $instituicoes->pesquisainstituicoes($w);
            $datas['instituicoes'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/instituicoes/index', $datas);

    }


}