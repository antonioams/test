
<?php
session_start();
    class historico extends Controller{

        public function Index_action(){
            $historico = new historicoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $historico_lista = $historico->listahistorico("{$par}");

            $datas['historico'] = $historico_lista;

            if ($historico->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                
                $this->view('/historico/index', $datas);
                
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $historico = new historicoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($historico->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/historico/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $historico = new historicoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($historico->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/historico/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $historico = new historicoModel();
            $id = $this->getParam('id');
            $detalhes_historico = $historico->listahistorico('cdhistorico='.$id);
            $datas['historico'] = $detalhes_historico;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['historico'][0]['tabela'] );
            if ($historico->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/historico/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $historico = new historicoModel();
            $dados=$_POST;
            $atualiza = $historico->atualizahistorico($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/historico/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/historico/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $historico = new historicoModel();
            $atualiza = $historico->excluihistorico( 'cdhistorico='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';
            $var = "<script>javascript:history.back(-2)</script>";
            echo $var;
            

        }

        public function pesquisar(){
            $historico = new historicoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            if ($historico->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/historico/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $historico = new historicoModel();
            $insere = $historico->inserehistorico($_POST, 'cdhistorico');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/historico/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/historico/" );
            }

        }

        public function inserea(){
            $historico = new historicoModel();
            $dataHora = date("d/m/Y h:i:s");;
            $dados_historico['tabela']=$_POST['tabela'];
            $dados_historico['descricao']="Avulso";
            $dados_historico['datahora']=$dataHora;
            $dados_historico['cdprojeto']=$_POST['cdprojeto'];
            $dados_historico['texto']= $_POST['texto'];
            $dados_historico['cdusuario']=$_SESSION[PROJETO]['cdusuario'];
            $dados_historico['tipo']='I';
            $insere = $historico->inserehistorico($dados_historico, 'cdhistorico');

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/historico/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/timeline/index/cdprojeto/".$_POST['cdprojeto'] );
            }

        }


        public function inserem( Array $dados = null ){
            $historico = new historicoModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdhistorico'][0])) {
                $i=0;
                foreach ($dados['cdhistorico'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_historico[$key]=$dados[$key][$i];
                    }
                    $insere = $historico->inserehistorico($dados_historico,'cdhistorico');
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

            header( "Location: /".PROJETO."/historico/" );


        }

        public function pesquisa(){
            $historico = new historicoModel();
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

            $pesquisa = $historico->pesquisahistorico($w);
            $datas['historico'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/historico/index', $datas);

    }


}