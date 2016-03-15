
<?php
session_start();
    class grupos extends Controller{

        public function Index_action(){
            $grupos = new gruposModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $grupos_lista = $grupos->listagrupos("{$par}");

            $datas['grupos'] = $grupos_lista;

            if ($grupos->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                
                $this->view('/grupos/index', $datas);
                
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $grupos = new gruposModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $tipos = new tiposModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdtipo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_tipos = $tipos->listatipos("{$par}");

            $datas['tipos'] = $detalhes_tipos;
            if ($grupos->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/grupos/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $grupos = new gruposModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $tipos = new tiposModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdtipo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_tipos = $tipos->listatipos("{$par}");

            $datas['tipos'] = $detalhes_tipos;
            if ($grupos->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/grupos/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $grupos = new gruposModel();
            $id = $this->getParam('id');
            $detalhes_grupos = $grupos->listagrupos('cdgrupo='.$id);
            $datas['grupos'] = $detalhes_grupos;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['grupos'][0]['descricao'] );
            $tipos = new tiposModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdtipo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_tipos = $tipos->listatipos("{$par}");

            $datas['tipos'] = $detalhes_tipos;
            if ($grupos->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/grupos/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $grupos = new gruposModel();
            $dados=$_POST;
            $atualiza = $grupos->atualizagrupos($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/grupos/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/grupos/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $grupos = new gruposModel();
            $atualiza = $grupos->excluigrupos( 'cdgrupo='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($grupos->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/grupos/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $grupos = new gruposModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $tipos = new tiposModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdtipo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_tipos = $tipos->listatipos("{$par}");

            $datas['tipos'] = $detalhes_tipos;
            if ($grupos->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/grupos/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $grupos = new gruposModel();
            $insere = $grupos->inseregrupos($_POST, 'cdgrupo');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/grupos/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/grupos/" );
            }

        }


        public function inserem( Array $dados = null ){
            $grupos = new gruposModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdgrupo'][0])) {
                $i=0;
                foreach ($dados['cdgrupo'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_grupos[$key]=$dados[$key][$i];
                    }
                    $insere = $grupos->inseregrupos($dados_grupos,'cdgrupo');
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

            header( "Location: /".PROJETO."/grupos/" );


        }

        public function pesquisa(){
            $grupos = new gruposModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $tipos = new tiposModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdtipo') ) {
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

            $pesquisa = $grupos->pesquisagrupos($w);
            $datas['grupos'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/grupos/index', $datas);

    }


}