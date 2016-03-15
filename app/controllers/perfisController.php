
<?php
session_start();
    class perfis extends Controller{

        public function Index_action(){
            $perfis = new perfisModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $perfis_lista = $perfis->listaperfis("{$par}");

            $datas['perfis'] = $perfis_lista;

            if ($perfis->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
               
                $this->view('/perfis/index', $datas);
                
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $perfis = new perfisModel();
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
            $clientes = new clientesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcliente') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_clientes = $clientes->listaclientes("{$par}");

            $datas['clientes'] = $detalhes_clientes;
            if ($perfis->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/perfis/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $perfis = new perfisModel();
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
            $clientes = new clientesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcliente') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_clientes = $clientes->listaclientes("{$par}");

            $datas['clientes'] = $detalhes_clientes;
            if ($perfis->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/perfis/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $perfis = new perfisModel();
            $id = $this->getParam('id');
            $detalhes_perfis = $perfis->listaperfis('cdperfil='.$id);
            $datas['perfis'] = $detalhes_perfis;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['perfis'][0]['descricao'] );
            $inicial = new inicialModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdinicio') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_inicial = $inicial->listainicial("{$par}");

            $datas['inicial'] = $detalhes_inicial;
            $clientes = new clientesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcliente') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_clientes = $clientes->listaclientes("{$par}");

            $datas['clientes'] = $detalhes_clientes;
            if ($perfis->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/perfis/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $perfis = new perfisModel();
            $dados=$_POST;
            $atualiza = $perfis->atualizaperfis($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/perfis/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/perfis/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $perfis = new perfisModel();
            $atualiza = $perfis->excluiperfis( 'cdperfil='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($perfis->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/perfis/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $perfis = new perfisModel();
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
            $clientes = new clientesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcliente') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_clientes = $clientes->listaclientes("{$par}");

            $datas['clientes'] = $detalhes_clientes;
            if ($perfis->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/perfis/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $perfis = new perfisModel();
            $insere = $perfis->insereperfis($_POST, 'cdperfil');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/perfis/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/perfis/" );
            }

        }


        public function inserem( Array $dados = null ){
            $perfis = new perfisModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdperfil'][0])) {
                $i=0;
                foreach ($dados['cdperfil'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_perfis[$key]=$dados[$key][$i];
                    }
                    $insere = $perfis->insereperfis($dados_perfis,'cdperfil');
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

            header( "Location: /".PROJETO."/perfis/" );


        }

        public function pesquisa(){
            $perfis = new perfisModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $inicial = new inicialModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdinicio') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $clientes = new clientesModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcliente') ) {
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

            $pesquisa = $perfis->pesquisaperfis($w);
            $datas['perfis'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/perfis/index', $datas);

    }


}