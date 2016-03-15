
<?php
session_start();
    class campos extends Controller{

        public function Index_action(){
            $campos = new camposModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $campos_lista = $campos->listacampos("{$par}");

            $datas['campos'] = $campos_lista;

            if ($campos->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/campos/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $campos = new camposModel();
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
            if ($campos->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/campos/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $campos = new camposModel();
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
            if ($campos->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/campos/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $campos = new camposModel();
            $id = $this->getParam('id');
            $detalhes_campos = $campos->listacampos('cdcampo='.$id);
            $datas['campos'] = $detalhes_campos;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['campos'][0]['descricao'] );
            $documentos = new documentosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cddocumento') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_documentos = $documentos->listadocumentos("{$par}");

            $datas['documentos'] = $detalhes_documentos;
            if ($campos->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/campos/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $campos = new camposModel();
            $dados=$_POST;
            $atualiza = $campos->atualizacampos($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/campos/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/campos/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $campos = new camposModel();
            $atualiza = $campos->excluicampos( 'cdcampo='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($campos->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/campos/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $campos = new camposModel();
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
            if ($campos->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/campos/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $campos = new camposModel();
            $insere = $campos->inserecampos($_POST, 'cdcampo');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/campos/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/campos/" );
            }

        }


        public function inserem( Array $dados = null ){
            $campos = new camposModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdcampo'][0])) {
                $i=0;
                foreach ($dados['cdcampo'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_campos[$key]=$dados[$key][$i];
                    }
                    $insere = $campos->inserecampos($dados_campos,'cdcampo');
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

            header( "Location: /".PROJETO."/campos/" );


        }



        public function inserew(){
            $campos = new camposModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='campo') {
                    $dados['campo'][$p[1]]=$value;
                }
            }

            $inserep = $campos->inserecampos($dados['campo'], 'cdcampo');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/campos/" );
            

        }

        public function pesquisa(){
            $campos = new camposModel();
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

            $pesquisa = $campos->pesquisacampos($w);
            $datas['campos'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/campos/index', $datas);

    }


}