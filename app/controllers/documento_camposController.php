
<?php
session_start();
    class documento_campos extends Controller{

        public function Index_action(){
            $documento_campos = new documento_camposModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $documento_campos_lista = $documento_campos->listadocumento_campos("{$par}");

            $datas['documento_campos'] = $documento_campos_lista;

            if ($documento_campos->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/documento_campos/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $documento_campos = new documento_camposModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $documentos = new documentosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cddocumento') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_documentos = $documentos->listadocumentos("{$par}");

            $datas['documentos'] = $detalhes_documentos;
            if ($documento_campos->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/documento_campos/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $documento_campos = new documento_camposModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $documentos = new documentosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cddocumento') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_documentos = $documentos->listadocumentos("{$par}");

            $datas['documentos'] = $detalhes_documentos;
            if ($documento_campos->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/documento_campos/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $documento_campos = new documento_camposModel();
            $id = $this->getParam('id');
            $detalhes_documento_campos = $documento_campos->listadocumento_campos('cdcampo='.$id);
            $datas['documento_campos'] = $detalhes_documento_campos;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['documento_campos'][0]['descricao'] );
            $documentos = new documentosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cddocumento') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_documentos = $documentos->listadocumentos("{$par}");

            $datas['documentos'] = $detalhes_documentos;
            if ($documento_campos->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/documento_campos/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $documento_campos = new documento_camposModel();
            $dados=$_POST;
            $atualiza = $documento_campos->atualizadocumento_campos($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/documento_campos/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/documento_campos/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $documento_campos = new documento_camposModel();
            $atualiza = $documento_campos->excluidocumento_campos( 'cdcampo='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($documento_campos->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/documento_campos/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $documento_campos = new documento_camposModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $documentos = new documentosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cddocumento') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_documentos = $documentos->listadocumentos("{$par}");

            $datas['documentos'] = $detalhes_documentos;
            if ($documento_campos->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/documento_campos/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $documento_campos = new documento_camposModel();
            $insere = $documento_campos->inseredocumento_campos($_POST, 'cdcampo');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/documento_campos/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/documento_campos/" );
            }

        }


        public function inserem( Array $dados = null ){
            $documento_campos = new documento_camposModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['descricao'][0])) {
                $i=0;
                foreach ($dados['descricao'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_documento_campos[$key]=$dados[$key][$i];
                    }
                    $insere = $documento_campos->inseredocumento_campos($dados_documento_campos,'cdcampo');
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

            header( "Location: /".PROJETO."/documento_campos/" );


        }



        public function inserew(){
            $documento_campos = new documento_camposModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='documento_campo') {
                    $dados['documento_campo'][$p[1]]=$value;
                }
            }

            $inserep = $documento_campos->inseredocumento_campos($dados['documento_campo'], 'cdcampo');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/documento_campos/" );
            

        }

        public function pesquisa(){
            $documento_campos = new documento_camposModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $documentos = new documentosModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cddocumento') ) {
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

            $pesquisa = $documento_campos->pesquisadocumento_campos($w);
            $datas['documento_campos'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/documento_campos/index', $datas);

    }


}