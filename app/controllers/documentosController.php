
<?php
session_start();
    class documentos extends Controller{

        public function Index_action(){
            $documentos = new documentosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $documentos_lista = $documentos->listadocumentos("{$par}");

            $datas['documentos'] = $documentos_lista;

            if ($documentos->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/documentos/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $documentos = new documentosModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $grupodocumento = new grupodocumentoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_grupodocumento = $grupodocumento->listagrupodocumento("{$par}");

            $datas['grupodocumento'] = $detalhes_grupodocumento;
            if ($documentos->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/documentos/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $documentos = new documentosModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $grupodocumento = new grupodocumentoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_grupodocumento = $grupodocumento->listagrupodocumento("{$par}");

            $datas['grupodocumento'] = $detalhes_grupodocumento;
            if ($documentos->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/documentos/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $documentos = new documentosModel();
            $id = $this->getParam('id');
            $detalhes_documentos = $documentos->listadocumentos('cddocumento='.$id);
            $datas['documentos'] = $detalhes_documentos;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['documentos'][0]['descricao'] );
            $grupodocumento = new grupodocumentoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_grupodocumento = $grupodocumento->listagrupodocumento("{$par}");

            $datas['grupodocumento'] = $detalhes_grupodocumento;
            if ($documentos->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/documentos/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $documentos = new documentosModel();
            $dados=$_POST;
            $atualiza = $documentos->atualizadocumentos($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/documentos/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/documentos/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $documentos = new documentosModel();
            $atualiza = $documentos->excluidocumentos( 'cddocumento='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($documentos->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/documentos/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $documentos = new documentosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $grupodocumento = new grupodocumentoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_grupodocumento = $grupodocumento->listagrupodocumento("{$par}");

            $datas['grupodocumento'] = $detalhes_grupodocumento;
            if ($documentos->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/documentos/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $documentos = new documentosModel();
            $insere = $documentos->inseredocumentos($_POST, 'cddocumento');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/documentos/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/documentos/" );
            }

        }


        public function inserem( Array $dados = null ){
            $documentos = new documentosModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cddocumento'][0])) {
                $i=0;
                foreach ($dados['cddocumento'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_documentos[$key]=$dados[$key][$i];
                    }
                    $insere = $documentos->inseredocumentos($dados_documentos,'cddocumento');
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

            header( "Location: /".PROJETO."/documentos/" );


        }



        public function inserew(){
            $documentos = new documentosModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='documento') {
                    $dados['documento'][$p[1]]=$value;
                }
            }

            $inserep = $documentos->inseredocumentos($dados['documento'], 'cddocumento');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/documentos/" );
            

        }

        public function pesquisa(){
            $documentos = new documentosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $grupodocumento = new grupodocumentoModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='') ) {
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

            $pesquisa = $documentos->pesquisadocumentos($w);
            $datas['documentos'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/documentos/index', $datas);

    }


}