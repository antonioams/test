
<?php
session_start();
    class projeto_quadro extends Controller{

        public function Index_action(){
            $projeto_quadro = new projeto_quadroModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $projeto_quadro_lista = $projeto_quadro->listaprojeto_quadro("{$par}");

            $datas['projeto_quadro'] = $projeto_quadro_lista;

            if ($projeto_quadro->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projeto_quadro/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $projeto_quadro = new projeto_quadroModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $quadro_logico = new quadro_logicoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdquadro_logico') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_quadro_logico = $quadro_logico->listaquadro_logico("{$par}");

            $datas['quadro_logico'] = $detalhes_quadro_logico;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($projeto_quadro->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/projeto_quadro/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $projeto_quadro = new projeto_quadroModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $quadro_logico = new quadro_logicoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdquadro_logico') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_quadro_logico = $quadro_logico->listaquadro_logico("{$par}");

            $datas['quadro_logico'] = $detalhes_quadro_logico;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($projeto_quadro->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projeto_quadro/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $projeto_quadro = new projeto_quadroModel();
            $id = $this->getParam('id');
            $detalhes_projeto_quadro = $projeto_quadro->listaprojeto_quadro('cdquadro_valor='.$id);
            $datas['projeto_quadro'] = $detalhes_projeto_quadro;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['projeto_quadro'][0]['cdquadro_logico'] );
            $quadro_logico = new quadro_logicoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdquadro_logico') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_quadro_logico = $quadro_logico->listaquadro_logico("{$par}");

            $datas['quadro_logico'] = $detalhes_quadro_logico;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($projeto_quadro->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projeto_quadro/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $projeto_quadro = new projeto_quadroModel();
            $dados=$_POST;
            $atualiza = $projeto_quadro->atualizaprojeto_quadro($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/projeto_quadro/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/projeto_quadro/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $projeto_quadro = new projeto_quadroModel();
            $atualiza = $projeto_quadro->excluiprojeto_quadro( 'cdquadro_valor='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($projeto_quadro->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/projeto_quadro/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $projeto_quadro = new projeto_quadroModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $quadro_logico = new quadro_logicoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdquadro_logico') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_quadro_logico = $quadro_logico->listaquadro_logico("{$par}");

            $datas['quadro_logico'] = $detalhes_quadro_logico;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($projeto_quadro->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projeto_quadro/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $projeto_quadro = new projeto_quadroModel();
            $insere = $projeto_quadro->insereprojeto_quadro($_POST, 'cdquadro_valor');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/projeto_quadro/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/projeto_quadro/" );
            }

        }


        public function inserem( Array $dados = null ){
            $projeto_quadro = new projeto_quadroModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdquadro_logico'][0])) {
                $i=0;
                foreach ($dados['cdquadro_logico'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_projeto_quadro[$key]=$dados[$key][$i];
                    }
                    $insere = $projeto_quadro->insereprojeto_quadro($dados_projeto_quadro,'cdquadro_valor');
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

            header( "Location: /".PROJETO."/projeto_quadro/" );


        }



        public function inserew(){
            $projeto_quadro = new projeto_quadroModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='projeto_quadro') {
                    $dados['projeto_quadro'][$p[1]]=$value;
                }
            }

            $inserep = $projeto_quadro->insereprojeto_quadro($dados['projeto_quadro'], 'cdquadro_valor');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/projeto_quadro/" );
            

        }

        public function pesquisa(){
            $projeto_quadro = new projeto_quadroModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $quadro_logico = new quadro_logicoModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdquadro_logico') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $projetos = new projetosModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
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

            $pesquisa = $projeto_quadro->pesquisaprojeto_quadro($w);
            $datas['projeto_quadro'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/projeto_quadro/index', $datas);

    }


}