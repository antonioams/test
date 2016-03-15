
<?php
session_start();
    class movimentacao extends Controller{

        public function Index_action(){

             $projetos = new projetosModel();
            $movimentacao = new movimentacaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par='where m.'.$vc['chave'].'='.$vc['valor']; 
                }
            }

            $movimentacao_lista = $projetos->rsql("
                select m.* from movimentacao m
                ".$par." order by cdmovimentacao desc");


            $datas['movimentacao'] = $movimentacao_lista;
            $unidades = new setoresModel();
            $i=0;
             foreach ($movimentacao_lista as $key => $value) {
                  $detalhes_unidades = $unidades->listasetores("cdunidade=".$datas['movimentacao'][$i]['cdunidade']);
                  $datas['movimentacao'][$i]['unidade']= $detalhes_unidades[0]['nome'];
                  $i++;
             }

            if ($movimentacao->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {

                $this->view('/movimentacao/index', $datas);

            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $movimentacao = new movimentacaoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $unidades = new setoresModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdunidade') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $par='cdcliente='.$_SESSION[PROJETO]['cdcliente'];

            $detalhes_unidades = $unidades->listasetores("{$par}");

            $datas['unidades'] = $detalhes_unidades;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($movimentacao->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $movimentacao_lista = $projetos->rsql("
                select cdunidade from movimentacao where cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']." order by cdmovimentacao desc limit 1");

                if ( ($movimentacao_lista[0]['cdunidade']=='') or ($movimentacao_lista[0]['cdunidade']==$_SESSION[PROJETO]['cdunidade']) ) {
                $this->view('/movimentacao/novo', $datas);
                } else {
                header( "Location: /".PROJETO."/movimentacao/" );
                }
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $movimentacao = new movimentacaoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $unidades = new setoresModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdunidade') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $par='cdcliente='.$_SESSION[PROJETO]['cdcliente'];
            $detalhes_unidades = $unidades->listasetores("{$par}");

            $datas['unidades'] = $detalhes_unidades;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($movimentacao->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $movimentacao_lista = $projetos->rsql("
                select cdunidade from movimentacao limit 1 order by cdmovimentacao desc ");

                if ( ($movimentacao_lista[0]['cdunidade']=='') or ($movimentacao_lista[0]['cdunidade']==$_SESSION[PROJETO]['cdunidade']) ) {
                $this->view('/movimentacao/novo', $datas);
                } else {
                header( "Location: /".PROJETO."/movimentacao/" );
                }
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            header( "Location: /".PROJETO."/movimentacao/" );


        }

        public function atualiza(){
            $id = $this->getParam('id');
            $movimentacao = new movimentacaoModel();
            $dados=$_POST;
            $atualiza = $movimentacao->atualizamovimentacao($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/movimentacao/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/movimentacao/" );

            }

        }

        public function exclui(){
            header( "Location: /".PROJETO."/movimentacao/" );
            

        }

        public function pesquisar(){
            $movimentacao = new movimentacaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $unidades = new setoresModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdunidade') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $par='cdcliente='.$_SESSION[PROJETO]['cdcliente'];
            $detalhes_unidades = $unidades->listasetores("{$par}");

            $datas['unidades'] = $detalhes_unidades;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($movimentacao->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/movimentacao/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $movimentacao = new movimentacaoModel();
            $insere = $movimentacao->inseremovimentacao($_POST, 'cdmovimentacao');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/movimentacao/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/movimentacao/" );
            }

        }


        public function inserem( Array $dados = null ){
            $movimentacao = new movimentacaoModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdprojeto'][0])) {
                $i=0;
                foreach ($dados['cdprojeto'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_movimentacao[$key]=$dados[$key][$i];
                    }
                    $insere = $movimentacao->inseremovimentacao($dados_movimentacao,'cdmovimentacao');
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

            header( "Location: /".PROJETO."/movimentacao/" );


        }

        public function pesquisa(){
            $movimentacao = new movimentacaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $unidades = new setoresModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdunidade') ) {
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

            $pesquisa = $movimentacao->pesquisamovimentacao($w);
            $datas['movimentacao'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/movimentacao/index', $datas);

    }


}