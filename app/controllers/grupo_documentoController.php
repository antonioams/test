
<?php
session_start();
    class grupo_documento extends Controller{

        public function Index_action(){
            $grupo_documento = new grupo_documentoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $grupo_documento_lista = $grupo_documento->listagrupo_documento("{$par}");

            $datas['grupo_documento'] = $grupo_documento_lista;

            if ($grupo_documento->pacesso('visualizar',$_SESSION[PROJETO]['acesso']['cdperfil'])=='1') {
                $this->view('/grupo_documento/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $grupo_documento = new grupo_documentoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $situacao = new situacaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfase') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_situacao = $situacao->listasituacao("{$par}");

            $datas['situacao'] = $detalhes_situacao;
            if ($grupo_documento->pacesso('inserir',$_SESSION[PROJETO]['acesso']['cdperfil'])=='1') {    $this->view('/grupo_documento/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $grupo_documento = new grupo_documentoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $situacao = new situacaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfase') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_situacao = $situacao->listasituacao("{$par}");

            $datas['situacao'] = $detalhes_situacao;
            if ($grupo_documento->pacesso('inserir_mtp',$_SESSION[PROJETO]['acesso']['cdperfil'])=='1') {
                $this->view('/grupo_documento/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $grupo_documento = new grupo_documentoModel();
            $id = $this->getParam('id');
            $detalhes_grupo_documento = $grupo_documento->listagrupo_documento('cdgrupo_documento='.$id);
            $datas['grupo_documento'] = $detalhes_grupo_documento;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['grupo_documento'][0]['descricao'] );
            $situacao = new situacaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfase') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_situacao = $situacao->listasituacao("{$par}");

            $datas['situacao'] = $detalhes_situacao;
            if ($grupo_documento->pacesso('editar',$_SESSION[PROJETO]['acesso']['cdperfil'])=='1') {
                $this->view('/grupo_documento/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $grupo_documento = new grupo_documentoModel();
            $dados=$_POST;
            $atualiza = $grupo_documento->atualizagrupo_documento($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/grupo_documento/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/grupo_documento/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $grupo_documento = new grupo_documentoModel();
            $atualiza = $grupo_documento->excluigrupo_documento( 'cdgrupo_documento='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($grupo_documento->pacesso('excluir',$_SESSION[PROJETO]['acesso']['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/grupo_documento/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $grupo_documento = new grupo_documentoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $situacao = new situacaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfase') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_situacao = $situacao->listasituacao("{$par}");

            $datas['situacao'] = $detalhes_situacao;
            if ($grupo_documento->pacesso('pesquisar',$_SESSION[PROJETO]['acesso']['cdperfil'])=='1') {
                $this->view('/grupo_documento/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $grupo_documento = new grupo_documentoModel();
            $insere = $grupo_documento->inseregrupo_documento($_POST, 'cdgrupo_documento');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/grupo_documento/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/grupo_documento/" );
            }

        }


        public function inserem( Array $dados = null ){
            $grupo_documento = new grupo_documentoModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdgrupo_documento'][0])) {
                $i=0;
                foreach ($dados['cdgrupo_documento'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_grupo_documento[$key]=$dados[$key][$i];
                    }
                    $insere = $grupo_documento->inseregrupo_documento($dados_grupo_documento,'cdgrupo_documento');
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

            header( "Location: /".PROJETO."/grupo_documento/" );


        }



        public function inserew(){
            $grupo_documento = new grupo_documentoModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='grupo_documento') {
                    $dados['grupo_documento'][$p[1]]=$value;
                }
            }

            $inserep = $grupo_documento->inseregrupo_documento($dados['grupo_documento'], 'cdgrupo_documento');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/grupo_documento/" );
            

        }

        public function pesquisa(){
            $grupo_documento = new grupo_documentoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $situacao = new situacaoModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfase') ) {
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

            $pesquisa = $grupo_documento->pesquisagrupo_documento($w);
            $datas['grupo_documento'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/grupo_documento/index', $datas);

    }


}