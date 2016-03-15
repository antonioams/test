
<?php
session_start();
    class css extends Controller{

        public function Index_action(){
            $css = new cssModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            if (!empty($_SESSION[PROJETO]['filtro']['chave'])) {
                $p=$_SESSION[PROJETO]['filtro']['chave'];
                $_SESSION[PROJETO]['filtro']['valor']=$this->getParam($p);
                if (!empty($_SESSION[PROJETO]['filtro']['valor'])) {
                $par=$p.'='.$_SESSION[PROJETO]['filtro']['valor']; }
            }
            if (!empty($par)) {
            if ($_SESSION[PROJETO]['']!='') { $par.= ' and '.$_SESSION[PROJETO]['']; }
            $css_lista = $css->listacss("{$par}");
            } else {$css_lista = $css->listacss($_SESSION[PROJETO]['']);}

            $datas['css'] = $css_lista;
            $this->view('/css/index', $datas);
        }

        public function novo(){
           $datas['vc'] = $this->modvinculados(get_class($this));
            $layouts = new layoutsModel();
            if ( (!empty($_SESSION[PROJETO]['filtro']['chave'])) and (!empty($_SESSION[PROJETO]['filtro']['valor'])) and ($_SESSION[PROJETO]['filtro']['chave']=='cdlayout') ) {
                $par=$_SESSION[PROJETO]['filtro']['chave'].'='.$_SESSION[PROJETO]['filtro']['valor'];
            }
            if (!empty($par)) {
            if ($_SESSION[PROJETO]['']!='') { $par.= ' and '.$_SESSION[PROJETO]['']; }
            $detalhes_layouts = $layouts->listalayouts("{$par}");
            } else {$detalhes_layouts = $layouts->listalayouts($_SESSION[PROJETO]['']);}
            $datas['layouts'] = $detalhes_layouts;
            $this->view('/css/novo', $datas);
        }



        public function novom(){
           $datas['vc'] = $this->modvinculados(get_class($this));
            $layouts = new layoutsModel();
            if ( (!empty($_SESSION[PROJETO]['filtro']['chave'])) and (!empty($_SESSION[PROJETO]['filtro']['valor'])) and ($_SESSION[PROJETO]['filtro']['chave']=='cdlayout') ) {

                $par=$_SESSION[PROJETO]['filtro']['chave'].'='.$_SESSION[PROJETO]['filtro']['valor'];
            }
            if (!empty($par)) {
            if ($_SESSION[PROJETO]['']!='') { $par.= ' and '.$_SESSION[PROJETO]['']; }
            $detalhes_layouts = $layouts->listalayouts("{$par}");
            } else {$detalhes_layouts = $layouts->listalayouts($_SESSION[PROJETO]['']);}
            $datas['layouts'] = $detalhes_layouts;
            $this->view('/css/novom', $datas);
        }



        public function editar(){

            $css = new cssModel();
            $id = $this->getParam('id');
            $detalhes_css = $css->listacss('cdcss='.$id);
            $datas['css'] = $detalhes_css;
            $datas['vc'] = $this->modvinculados(get_class($this),$id);
            $layouts = new layoutsModel();
            if ( (!empty($_SESSION[PROJETO]['filtro']['chave'])) and (!empty($_SESSION[PROJETO]['filtro']['valor'])) and ($_SESSION[PROJETO]['filtro']['chave']=='cdlayout') ) {

                $par=$_SESSION[PROJETO]['filtro']['chave'].'='.$_SESSION[PROJETO]['filtro']['valor'];
            }
            if (!empty($par)) {
            if ($_SESSION[PROJETO]['']!='') { $par.= ' and '.$_SESSION[PROJETO]['']; }
            $detalhes_layouts = $layouts->listalayouts("{$par}");
            } else {$detalhes_layouts = $layouts->listalayouts($_SESSION[PROJETO]['']);}
            $datas['layouts'] = $detalhes_layouts;
            $this->view('/css/editar', $datas);

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $css = new cssModel();
            $dados=$_POST;
            $atualiza = $css->atualizacss($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/css/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/css/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $css = new cssModel();
            $atualiza = $css->excluicss( 'cdcss='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';
            header( "Location: /".PROJETO."/css/" );

        }

        public function pesquisar(){
            $datas['vc'] = $this->modvinculados(get_class($this));
            $layouts = new layoutsModel();
            if ( (!empty($_SESSION[PROJETO]['filtro']['chave'])) and (!empty($_SESSION[PROJETO]['filtro']['valor'])) and ($_SESSION[PROJETO]['filtro']['chave']=='cdlayout') ) {

                $par=$_SESSION[PROJETO]['filtro']['chave'].'='.$_SESSION[PROJETO]['filtro']['valor'];
            }
            if (!empty($par)) {
            if ($_SESSION[PROJETO]['']!='') { $par.= ' and '.$_SESSION[PROJETO]['']; }
            $detalhes_layouts = $layouts->listalayouts("{$par}");
            } else {$detalhes_layouts = $layouts->listalayouts($_SESSION[PROJETO]['']);}
            $datas['layouts'] = $detalhes_layouts;
            $this->view('/css/pesquisar', $datas);
        }

        public function insere(){
            $css = new cssModel();
            $insere = $css->inserecss($_POST, 'cdcss');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/css/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/css/" );
            }

        }


        public function inserem( Array $dados = null ){
            $css = new cssModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['tipo'][0])) {
                $i=0;
                foreach ($dados['tipo'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_css[$key]=$dados[$key][$i];
                    }
                    $insere = $css->inserecss($dados_css,'cdcss');
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

            header( "Location: /".PROJETO."/css/" );


        }

        public function pesquisa(){
            $css = new cssModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $layouts = new layoutsModel();
            if ( (!empty($_SESSION[PROJETO]['filtro']['chave'])) and (!empty($_SESSION[PROJETO]['filtro']['valor'])) and ($_SESSION[PROJETO]['filtro']['chave']=='cdlayout') ) {

                $par=$_SESSION[PROJETO]['filtro']['chave'].'='.$_SESSION[PROJETO]['filtro']['valor'];
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
            if ($_SESSION[PROJETO]['']!='') { if (empty($w)) { $w.= $_SESSION[PROJETO]['']; } else { $w.= ' and '.$_SESSION[PROJETO][''];} }


            $pesquisa = $css->pesquisacss($w);
            $datas['css'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/css/index', $datas);

    }


}