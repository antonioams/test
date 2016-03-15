
<?php
session_start();
    class projeto_objetivo extends Controller{

        public function Index_action(){
            $projeto_objetivo = new projeto_objetivoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $projeto_objetivo_lista = $projeto_objetivo->listaprojeto_objetivo("{$par}");

            $datas['projeto_objetivo'] = $projeto_objetivo_lista;

            $objetivo_informacao = new objetivo_informacaoModel();
            $i=0;
             foreach ($projeto_objetivo_lista as $key => $value) {
                  $detalhes_projeto_objetivo_lista = $objetivo_informacao->listaobjetivo_informacao("cdobjetivo_informacao=".$datas['projeto_objetivo'][$i]['cdobjetivo_informacao']);
                  $datas['projeto_objetivo'][$i]['objetivo_informacao']= $detalhes_projeto_objetivo_lista[0]['logica'].' - '.$detalhes_projeto_objetivo_lista[0]['tipo'];
                  $i++;
             }

            

            if ($projeto_objetivo->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projeto_objetivo/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $projeto_objetivo = new projeto_objetivoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $objetivo_informacao = new objetivo_informacaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdobjetivo_informacao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_objetivo_informacao = $objetivo_informacao->listaobjetivo_informacao("{$par}");

            $datas['objetivo_informacao'] = $detalhes_objetivo_informacao;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($projeto_objetivo->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/projeto_objetivo/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $projeto_objetivo = new projeto_objetivoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $objetivo_informacao = new objetivo_informacaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdobjetivo_informacao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_objetivo_informacao = $objetivo_informacao->listaobjetivo_informacao("{$par}");

            $datas['objetivo_informacao'] = $detalhes_objetivo_informacao;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($projeto_objetivo->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projeto_objetivo/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $projeto_objetivo = new projeto_objetivoModel();
            $id = $this->getParam('id');
            $detalhes_projeto_objetivo = $projeto_objetivo->listaprojeto_objetivo('cdprojeto_objetivo='.$id);
            $datas['projeto_objetivo'] = $detalhes_projeto_objetivo;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['projeto_objetivo'][0]['cdobjetivo_informacao'] );
            $objetivo_informacao = new objetivo_informacaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdobjetivo_informacao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_objetivo_informacao = $objetivo_informacao->listaobjetivo_informacao("{$par}");

            $datas['objetivo_informacao'] = $detalhes_objetivo_informacao;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($projeto_objetivo->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projeto_objetivo/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $projeto_objetivo = new projeto_objetivoModel();
            $dados=$_POST;
            $atualiza = $projeto_objetivo->atualizaprojeto_objetivo($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/projeto_objetivo/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/projeto_objetivo/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $projeto_objetivo = new projeto_objetivoModel();
            $atualiza = $projeto_objetivo->excluiprojeto_objetivo( 'cdprojeto_objetivo='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($projeto_objetivo->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/projeto_objetivo/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $projeto_objetivo = new projeto_objetivoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $objetivo_informacao = new objetivo_informacaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdobjetivo_informacao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_objetivo_informacao = $objetivo_informacao->listaobjetivo_informacao("{$par}");

            $datas['objetivo_informacao'] = $detalhes_objetivo_informacao;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($projeto_objetivo->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projeto_objetivo/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $projeto_objetivo = new projeto_objetivoModel();
            $insere = $projeto_objetivo->insereprojeto_objetivo($_POST, 'cdprojeto_objetivo');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/projeto_objetivo/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/projeto_objetivo/" );
            }

        }


        public function inserem( Array $dados = null ){
            $projeto_objetivo = new projeto_objetivoModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdobjetivo_informacao'][0])) {
                $i=0;
                foreach ($dados['cdobjetivo_informacao'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_projeto_objetivo[$key]=$dados[$key][$i];
                    }
                    $insere = $projeto_objetivo->insereprojeto_objetivo($dados_projeto_objetivo,'cdprojeto_objetivo');
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

            header( "Location: /".PROJETO."/projeto_objetivo/" );


        }



        public function inserew(){
            $projeto_objetivo = new projeto_objetivoModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='projeto_objetivo') {
                    $dados['projeto_objetivo'][$p[1]]=$value;
                }
            }

            $inserep = $projeto_objetivo->insereprojeto_objetivo($dados['projeto_objetivo'], 'cdprojeto_objetivo');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/projeto_objetivo/" );
            

        }

        public function pesquisa(){
            $projeto_objetivo = new projeto_objetivoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $objetivo_informacao = new objetivo_informacaoModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdobjetivo_informacao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
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

            $pesquisa = $projeto_objetivo->pesquisaprojeto_objetivo($w);
            $datas['projeto_objetivo'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/projeto_objetivo/index', $datas);

    }


}