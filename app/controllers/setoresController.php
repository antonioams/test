
<?php
session_start();
    class setores extends Controller{

        public function Index_action(){
            $setores = new setoresModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $setores_lista = $setores->listasetores("{$par}");

            $datas['setores'] = $setores_lista;

            if ($setores->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/setores/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $setores = new setoresModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $clientes = new clientesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcliente') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_clientes = $clientes->listaclientes("{$par}");

            $datas['clientes'] = $detalhes_clientes;
            if ($setores->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/setores/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $setores = new setoresModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $clientes = new clientesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcliente') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_clientes = $clientes->listaclientes("{$par}");

            $datas['clientes'] = $detalhes_clientes;
            if ($setores->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/setores/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $setores = new setoresModel();
            $id = $this->getParam('id');
            $detalhes_setores = $setores->listasetores('cdunidade='.$id);
            $datas['setores'] = $detalhes_setores;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['setores'][0]['nome'] );
            $clientes = new clientesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcliente') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_clientes = $clientes->listaclientes("{$par}");

            $datas['clientes'] = $detalhes_clientes;
            if ($setores->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/setores/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $setores = new setoresModel();
            $dados=$_POST;
            $atualiza = $setores->atualizasetores($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/setores/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/setores/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $setores = new setoresModel();
            $atualiza = $setores->excluisetores( 'cdunidade='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($setores->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/setores/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $setores = new setoresModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $clientes = new clientesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcliente') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_clientes = $clientes->listaclientes("{$par}");

            $datas['clientes'] = $detalhes_clientes;
            if ($setores->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/setores/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $setores = new setoresModel();
            $insere = $setores->inseresetores($_POST, 'cdunidade');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/setores/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/setores/" );
            }

        }


        public function inserem( Array $dados = null ){
            $setores = new setoresModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['nome'][0])) {
                $i=0;
                foreach ($dados['nome'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_setores[$key]=$dados[$key][$i];
                    }
                    $insere = $setores->inseresetores($dados_setores,'cdunidade');
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

            header( "Location: /".PROJETO."/setores/" );


        }



        public function inserew(){
            $setores = new setoresModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='unidade') {
                    $dados['unidade'][$p[1]]=$value;
                }
            }

            $inserep = $setores->inseresetores($dados['unidade'], 'cdunidade');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/setores/" );
            

        }

        public function pesquisa(){
            $setores = new setoresModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
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

            $pesquisa = $setores->pesquisasetores($w);
            $datas['setores'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/setores/index', $datas);

    }


}