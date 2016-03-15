
<?php
session_start();
    class perguntas extends Controller{

        public function Index_action(){
            $perguntas = new perguntasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $perguntas_lista = $perguntas->listaperguntas("{$par}");

            $datas['perguntas'] = $perguntas_lista;

            if ($perguntas->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/perguntas/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $perguntas = new perguntasModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $grupopergunta = new grupoperguntaModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdgrupopergunta') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_grupopergunta = $grupopergunta->listagrupopergunta("{$par}");

            $datas['grupopergunta'] = $detalhes_grupopergunta;
            if ($perguntas->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/perguntas/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $perguntas = new perguntasModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $grupopergunta = new grupoperguntaModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdgrupopergunta') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_grupopergunta = $grupopergunta->listagrupopergunta("{$par}");

            $datas['grupopergunta'] = $detalhes_grupopergunta;
            if ($perguntas->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/perguntas/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $perguntas = new perguntasModel();
            $id = $this->getParam('id');
            $detalhes_perguntas = $perguntas->listaperguntas('cdpergunta='.$id);
            $datas['perguntas'] = $detalhes_perguntas;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['perguntas'][0]['descricao'] );
            $grupopergunta = new grupoperguntaModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdgrupopergunta') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_grupopergunta = $grupopergunta->listagrupopergunta("{$par}");

            $datas['grupopergunta'] = $detalhes_grupopergunta;
            if ($perguntas->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/perguntas/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $perguntas = new perguntasModel();
            $dados=$_POST;
            $atualiza = $perguntas->atualizaperguntas($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/perguntas/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/perguntas/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $perguntas = new perguntasModel();
            $atualiza = $perguntas->excluiperguntas( 'cdpergunta='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($perguntas->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/perguntas/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $perguntas = new perguntasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $grupopergunta = new grupoperguntaModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdgrupopergunta') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_grupopergunta = $grupopergunta->listagrupopergunta("{$par}");

            $datas['grupopergunta'] = $detalhes_grupopergunta;
            if ($perguntas->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/perguntas/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $perguntas = new perguntasModel();
            $insere = $perguntas->insereperguntas($_POST, 'cdpergunta');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/perguntas/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/perguntas/" );
            }

        }


        public function inserem( Array $dados = null ){
            $perguntas = new perguntasModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['tipo'][0])) {
                $i=0;
                foreach ($dados['tipo'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_perguntas[$key]=$dados[$key][$i];
                    }
                    $insere = $perguntas->insereperguntas($dados_perguntas,'cdpergunta');
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

            header( "Location: /".PROJETO."/perguntas/" );


        }



        public function inserew(){
            $perguntas = new perguntasModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='pergunta') {
                    $dados['pergunta'][$p[1]]=$value;
                }
            }

            $inserep = $perguntas->insereperguntas($dados['pergunta'], 'cdpergunta');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/perguntas/" );
            

        }

        public function pesquisa(){
            $perguntas = new perguntasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $grupopergunta = new grupoperguntaModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdgrupopergunta') ) {
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

            $pesquisa = $perguntas->pesquisaperguntas($w);
            $datas['perguntas'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/perguntas/index', $datas);

    }


}