
<?php
session_start();
    class inicial_detalhes extends Controller{

        public function Index_action(){
            $inicial_detalhes = new inicial_detalhesModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $inicial_detalhes_lista = $inicial_detalhes->listainicial_detalhes("{$par}");

            $consultas = new consultasModel();

            $detalhes_consultas = $consultas->rsql(" select * from consulta where tipo like '%2%' and cdcliente=".$_SESSION[PROJETO]['cdcliente']);


            $datas['inicial_detalhes'] = $inicial_detalhes_lista;
            $datas['consultas'] = $detalhes_consultas;

            if ($inicial_detalhes->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/inicial_detalhes/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $inicial_detalhes = new inicial_detalhesModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $inicial = new inicialModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdinicio') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_inicial = $inicial->listainicial("{$par}");

            $datas['inicial'] = $detalhes_inicial;
            $modulos = new modulosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdteste') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_modulos = $modulos->listamodulos("{$par}");

            $datas['modulos'] = $detalhes_modulos;
            if ($inicial_detalhes->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/inicial_detalhes/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $inicial_detalhes = new inicial_detalhesModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $inicial = new inicialModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdinicio') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_inicial = $inicial->listainicial("{$par}");

            $datas['inicial'] = $detalhes_inicial;
            $modulos = new modulosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdteste') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_modulos = $modulos->listamodulos("{$par}");

            $datas['modulos'] = $detalhes_modulos;
            if ($inicial_detalhes->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/inicial_detalhes/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $inicial_detalhes = new inicial_detalhesModel();
            $id = $this->getParam('id');
            $detalhes_inicial_detalhes = $inicial_detalhes->listainicial_detalhes('cdinicio_detalhe='.$id);
            $datas['inicial_detalhes'] = $detalhes_inicial_detalhes;
            $datas['vc'] = $this->modvinculados(get_class($this),$id);
            $inicial = new inicialModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdinicio') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_inicial = $inicial->listainicial("{$par}");

            $datas['inicial'] = $detalhes_inicial;
            $modulos = new modulosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdteste') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_modulos = $modulos->listamodulos("{$par}");

            $datas['modulos'] = $detalhes_modulos;
            if ($inicial_detalhes->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/inicial_detalhes/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $inicial_detalhes = new inicial_detalhesModel();
            $dados=$_POST;
            $atualiza = $inicial_detalhes->atualizainicial_detalhes($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/inicial_detalhes/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/inicial_detalhes/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $inicial_detalhes = new inicial_detalhesModel();
            $atualiza = $inicial_detalhes->excluiinicial_detalhes( 'cdinicio_detalhe='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($inicial_detalhes->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/inicial_detalhes/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $inicial_detalhes = new inicial_detalhesModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $inicial = new inicialModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdinicio') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_inicial = $inicial->listainicial("{$par}");

            $datas['inicial'] = $detalhes_inicial;
            $modulos = new modulosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdteste') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_modulos = $modulos->listamodulos("{$par}");

            $datas['modulos'] = $detalhes_modulos;
            if ($inicial_detalhes->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/inicial_detalhes/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $inicial_detalhes = new inicial_detalhesModel();
            $insere = $inicial_detalhes->insereinicial_detalhes($_POST, 'cdinicio_detalhe');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/inicial_detalhes/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/inicial_detalhes/" );
            }

        }


        public function inserem( Array $dados = null ){
            $inicial_detalhes = new inicial_detalhesModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['ordem'][0])) {
                $i=0;
                $atualiza = $inicial_detalhes->excluiinicial_detalhes( 'cdinicio='.$_SESSION[PROJETO]['filtro']['cdinicio'] );
                foreach ($dados['ordem'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        if ($key!='submit') {
                        $dados_inicial_detalhes[$key]=$dados[$key][$i];
                    }
                    }
                    $dados_inicial_detalhes['cdinicio']=$_SESSION[PROJETO]['filtro']['cdinicio'];
                    $insere = $inicial_detalhes->insereinicial_detalhes($dados_inicial_detalhes,'cdinicio_detalhe');
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

            header( "Location: /".PROJETO."/inicial_detalhes/" );


        }

        public function pesquisa(){
            $inicial_detalhes = new inicial_detalhesModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $inicial = new inicialModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdinicio') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $modulos = new modulosModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdteste') ) {
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

            $pesquisa = $inicial_detalhes->pesquisainicial_detalhes($w);
            $datas['inicial_detalhes'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/inicial_detalhes/index', $datas);

    }


}