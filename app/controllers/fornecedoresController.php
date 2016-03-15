
<?php
session_start();
    class fornecedores extends Controller{

        public function Index_action(){
            $fornecedores = new fornecedoresModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $fornecedores_lista = $fornecedores->listafornecedores("{$par}");

            $datas['fornecedores'] = $fornecedores_lista;

            if ($fornecedores->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/fornecedores/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $fornecedores = new fornecedoresModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($fornecedores->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/fornecedores/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $fornecedores = new fornecedoresModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($fornecedores->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/fornecedores/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $fornecedores = new fornecedoresModel();
            $id = $this->getParam('id');
            $detalhes_fornecedores = $fornecedores->listafornecedores('cdfornecedor='.$id);
            $datas['fornecedores'] = $detalhes_fornecedores;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['fornecedores'][0]['razao_social'] );
            if ($fornecedores->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/fornecedores/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $fornecedores = new fornecedoresModel();
            $dados=$_POST;
            $atualiza = $fornecedores->atualizafornecedores($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/fornecedores/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/fornecedores/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $fornecedores = new fornecedoresModel();
            $atualiza = $fornecedores->excluifornecedores( 'cdfornecedor='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($fornecedores->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/fornecedores/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $fornecedores = new fornecedoresModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            if ($fornecedores->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/fornecedores/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $fornecedores = new fornecedoresModel();
            $insere = $fornecedores->inserefornecedores($_POST, 'cdfornecedor');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/fornecedores/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/fornecedores/" );
            }

        }


        public function inserem( Array $dados = null ){
            $fornecedores = new fornecedoresModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['razao_social'][0])) {
                $i=0;
                foreach ($dados['razao_social'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_fornecedores[$key]=$dados[$key][$i];
                    }
                    $insere = $fornecedores->inserefornecedores($dados_fornecedores,'cdfornecedor');
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

            header( "Location: /".PROJETO."/fornecedores/" );


        }



        public function inserew(){
            $fornecedores = new fornecedoresModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='fornecedor') {
                    $dados['fornecedor'][$p[1]]=$value;
                }
            }

            $inserep = $fornecedores->inserefornecedores($dados['fornecedor'], 'cdfornecedor');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/fornecedores/" );
            

        }

        public function pesquisa(){
            $fornecedores = new fornecedoresModel();
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

            $pesquisa = $fornecedores->pesquisafornecedores($w);
            $datas['fornecedores'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/fornecedores/index', $datas);

    }


}