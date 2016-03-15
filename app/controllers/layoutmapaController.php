
<?php
session_start();
    class layoutmapa extends Controller{

        public function Index_action(){
            $layoutmapa = new layoutmapaModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $layoutmapa_lista = $layoutmapa->listalayoutmapa("{$par}");

            $consultas = new consultasModel();

            $detalhesl = $consultas->rsql(" select c.cdlayoutmapa from cliente c, perfil p where c.cdcliente=p.cdcliente and p.cdperfil=".$_SESSION[PROJETO]['cdperfil']);

            $datas['layoutc'] = $detalhesl[0]['cdlayoutmapa'];            

            $datas['layoutmapa'] = $layoutmapa_lista;

            if ($layoutmapa->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                
                $this->view('/layoutmapa/index', $datas);
                
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $layoutmapa = new layoutmapaModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($layoutmapa->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/layoutmapa/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $layoutmapa = new layoutmapaModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($layoutmapa->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/layoutmapa/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $layoutmapa = new layoutmapaModel();
            $id = $this->getParam('id');
            $detalhes_layoutmapa = $layoutmapa->listalayoutmapa('cdlayoutmapa='.$id);
            $datas['layoutmapa'] = $detalhes_layoutmapa;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['layoutmapa'][0]['nome'] );
            if ($layoutmapa->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/layoutmapa/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $layoutmapa = new layoutmapaModel();
            $dados=$_POST;
            $atualiza = $layoutmapa->atualizalayoutmapa($dados, $id );

            $detalhes_layoutmapa = $layoutmapa->listalayoutmapa('cdlayoutmapa='.$id);

            $this->gerarcssmapa($detalhes_layoutmapa[0]);

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/layoutmapa/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/layoutmapa/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $layoutmapa = new layoutmapaModel();
            $atualiza = $layoutmapa->excluilayoutmapa( 'cdlayoutmapa='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($layoutmapa->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/layoutmapa/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $layoutmapa = new layoutmapaModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            if ($layoutmapa->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/layoutmapa/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $layoutmapa = new layoutmapaModel();
            $insere = $layoutmapa->inserelayoutmapa($_POST, 'cdlayoutmapa');

            $detalhes_layoutmapa = $layoutmapa->listalayoutmapa('cdlayoutmapa='.$insere);

            $this->gerarcssmapa($detalhes_layoutmapa[0]);

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/layoutmapa/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/layoutmapa/" );
            }

        }


        public function inserem( Array $dados = null ){
            $layoutmapa = new layoutmapaModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdlayoutmapa'][0])) {
                $i=0;
                foreach ($dados['cdlayoutmapa'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_layoutmapa[$key]=$dados[$key][$i];
                    }
                    $insere = $layoutmapa->inserelayoutmapa($dados_layoutmapa,'cdlayoutmapa');
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

            header( "Location: /".PROJETO."/layoutmapa/" );


        }

        public function pesquisa(){
            $layoutmapa = new layoutmapaModel();
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

            $pesquisa = $layoutmapa->pesquisalayoutmapa($w);
            $datas['layoutmapa'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/layoutmapa/index', $datas);

    }


}