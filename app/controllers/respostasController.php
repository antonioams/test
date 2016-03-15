
<?php
session_start();
    class respostas extends Controller{

        public function Index_action(){
            $respostas = new respostasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $respostas_lista = $respostas->listarespostas("{$par}");

            $datas['respostas'] = $respostas_lista;

            if ($respostas->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                
                $this->view('/respostas/index', $datas);
                
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $respostas = new respostasModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $perguntas = new perguntasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdpergunta') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_perguntas = $perguntas->listaperguntas("{$par}");

            $datas['perguntas'] = $detalhes_perguntas;
            if ($respostas->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/respostas/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $respostas = new respostasModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $perguntas = new perguntasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdpergunta') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_perguntas = $perguntas->listaperguntas("{$par}");

            $datas['perguntas'] = $detalhes_perguntas;
            if ($respostas->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/respostas/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $respostas = new respostasModel();
            $id = $this->getParam('id');
            $detalhes_respostas = $respostas->listarespostas('cdresposta='.$id);
            $datas['respostas'] = $detalhes_respostas;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['respostas'][0]['descricao'] );
            $perguntas = new perguntasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdpergunta') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_perguntas = $perguntas->listaperguntas("{$par}");

            $datas['perguntas'] = $detalhes_perguntas;
            if ($respostas->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/respostas/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $respostas = new respostasModel();
            $dados=$_POST;
            $atualiza = $respostas->atualizarespostas($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/respostas/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/respostas/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $respostas = new respostasModel();
            $atualiza = $respostas->excluirespostas( 'cdresposta='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($respostas->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/respostas/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $respostas = new respostasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $perguntas = new perguntasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdpergunta') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_perguntas = $perguntas->listaperguntas("{$par}");

            $datas['perguntas'] = $detalhes_perguntas;
            if ($respostas->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/respostas/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $respostas = new respostasModel();
            $insere = $respostas->insererespostas($_POST, 'cdresposta');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/respostas/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/respostas/" );
            }

        }


        public function inserem( Array $dados = null ){
            $respostas = new respostasModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdresposta'][0])) {
                $i=0;
                foreach ($dados['cdresposta'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_respostas[$key]=$dados[$key][$i];
                    }
                    $insere = $respostas->insererespostas($dados_respostas,'cdresposta');
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

            header( "Location: /".PROJETO."/respostas/" );


        }

        public function pesquisa(){
            $respostas = new respostasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $perguntas = new perguntasModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdpergunta') ) {
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

            $pesquisa = $respostas->pesquisarespostas($w);
            $datas['respostas'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/respostas/index', $datas);

    }


}