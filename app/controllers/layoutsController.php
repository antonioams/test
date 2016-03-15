
<?php
session_start();
    class layouts extends Controller{

        public function Index_action(){
            $layouts = new layoutsModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            if (!empty($_SESSION[PROJETO]['filtro']['chave'])) {
                $p=$_SESSION[PROJETO]['filtro']['chave'];
                $_SESSION[PROJETO]['filtro']['valor']=$this->getParam($p);
                if (!empty($_SESSION[PROJETO]['filtro']['valor'])) {
                $par=$p.'='.$_SESSION[PROJETO]['filtro']['valor']; }
            }
            if (!empty($par)) {
            if ($_SESSION[PROJETO]['']!='') { $par.= ' and '.$_SESSION[PROJETO]['']; }
            $layouts_lista = $layouts->listalayouts("{$par}");
            } else {$layouts_lista = $layouts->listalayouts($_SESSION[PROJETO]['']);}

            $consultas = new consultasModel();

            $detalhesl = $consultas->rsql(" select c.cdlayout from cliente c, perfil p where c.cdcliente=p.cdcliente and p.cdperfil=".$_SESSION[PROJETO]['cdperfil']);

            $datas['layoutc'] = $detalhesl[0]['cdlayout'];
            $datas['layouts'] = $layouts_lista;
            $this->view('/layouts/index', $datas);
        }

        public function novo(){
           $datas['vc'] = $this->modvinculados(get_class($this));
            $this->view('/layouts/novo', $datas);
        }



        public function novom(){
           $datas['vc'] = $this->modvinculados(get_class($this));
            $this->view('/layouts/novom', $datas);
        }



        public function editar(){

            $layouts = new layoutsModel();
            $id = $this->getParam('id');
            $datas['vc'] = $this->modvinculados(get_class($this),$id);
            $detalhes_layouts = $layouts->listalayouts('cdlayout='.$id);
            $clientes = new clientesModel();
            $detalhes_clientes = $clientes->listaclientes('cdlayout='.$id);
            $datas['layouts'] = $detalhes_layouts;
            $datas['clientes'] = $detalhes_clientes;


            $this->view('/layouts/editar', $datas);

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $layouts = new layoutsModel();
            $dados=$_POST;
            $atualiza = $layouts->atualizalayouts($dados, $id );

            $detalhes_layouts = $layouts->listalayouts('cdlayout='.$id);

            $this->gerarcss($detalhes_layouts[0]);

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/layouts/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/layouts/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $layouts = new layoutsModel();
            $atualiza = $layouts->excluilayouts( 'cdlayout='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';
            header( "Location: /".PROJETO."/layouts/" );

        }

        public function pesquisar(){
            $datas['vc'] = $this->modvinculados(get_class($this));
            $this->view('/layouts/pesquisar', $datas);
        }

        public function insere(){
            $layouts = new layoutsModel();
            $insere = $layouts->inserelayouts($_POST, 'cdlayout');
            $detalhes_layouts = $layouts->listalayouts('cdlayout='.$insere);

            $this->gerarcss($detalhes_layouts[0]);

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/layouts/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/layouts/" );
            }

        }


        public function inserem( Array $dados = null ){
            $layouts = new layoutsModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdlayout'][0])) {
                $i=0;
                foreach ($dados['cdlayout'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_layouts[$key]=$dados[$key][$i];
                    }
                    $insere = $layouts->inserelayouts($dados_layouts,'cdlayout');
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

            header( "Location: /".PROJETO."/layouts/" );


        }

        public function pesquisa(){
            $layouts = new layoutsModel();
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
            if ($_SESSION[PROJETO]['']!='') { if (empty($w)) { $w.= $_SESSION[PROJETO]['']; } else { $w.= ' and '.$_SESSION[PROJETO][''];} }


            $pesquisa = $layouts->pesquisalayouts($w);
            $datas['layouts'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/layouts/index', $datas);

    }


}