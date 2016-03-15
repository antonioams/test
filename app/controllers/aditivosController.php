
<?php
session_start();
    class aditivos extends Controller{

        public function Index_action(){
            $aditivos = new aditivosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $aditivos_lista = $aditivos->listaaditivos("{$par}");

            $datas['aditivos'] = $aditivos_lista;

            if ($aditivos->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/aditivos/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $aditivos = new aditivosModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $contratos = new contratosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contratos = $contratos->listacontratos("{$par}");

            $datas['contratos'] = $detalhes_contratos;
            if ($aditivos->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/aditivos/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $aditivos = new aditivosModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $contratos = new contratosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contratos = $contratos->listacontratos("{$par}");

            $datas['contratos'] = $detalhes_contratos;
            if ($aditivos->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/aditivos/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $aditivos = new aditivosModel();
            $id = $this->getParam('id');
            $detalhes_aditivos = $aditivos->listaaditivos('cdaditivo='.$id);
            $datas['aditivos'] = $detalhes_aditivos;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['aditivos'][0]['cdaditivo'] );
            $contratos = new contratosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contratos = $contratos->listacontratos("{$par}");

            $datas['contratos'] = $detalhes_contratos;
            if ($aditivos->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/aditivos/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $aditivos = new aditivosModel();
            $dados=$_POST;
            $atualiza = $aditivos->atualizaaditivos($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/aditivos/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/aditivos/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $aditivos = new aditivosModel();
            $atualiza = $aditivos->excluiaditivos( 'cdaditivo='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($aditivos->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/aditivos/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $aditivos = new aditivosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $contratos = new contratosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contratos = $contratos->listacontratos("{$par}");

            $datas['contratos'] = $detalhes_contratos;
            if ($aditivos->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/aditivos/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $aditivos = new aditivosModel();
            $insere = $aditivos->insereaditivos($_POST, 'cdaditivo');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/aditivos/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/aditivos/" );
            }

        }


        public function inserem( Array $dados = null ){
            $aditivos = new aditivosModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['data'][0])) {
                $i=0;
                foreach ($dados['data'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_aditivos[$key]=$dados[$key][$i];
                    }
                    $insere = $aditivos->insereaditivos($dados_aditivos,'cdaditivo');
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

            header( "Location: /".PROJETO."/aditivos/" );


        }



        public function inserew(){
            $aditivos = new aditivosModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='aditivo') {
                    $dados['aditivo'][$p[1]]=$value;
                }
            }

            $inserep = $aditivos->insereaditivos($dados['aditivo'], 'cdaditivo');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/aditivos/" );
            

        }

        public function pesquisa(){
            $aditivos = new aditivosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $contratos = new contratosModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato') ) {
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

            $pesquisa = $aditivos->pesquisaaditivos($w);
            $datas['aditivos'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/aditivos/index', $datas);

    }


}