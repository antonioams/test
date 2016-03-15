
<?php
session_start();
    class quadro_logico extends Controller{

        public function Index_action(){
            $quadro_logico = new quadro_logicoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $quadro_logico_lista = $quadro_logico->listaquadro_logico("{$par}");

            $datas['quadro_logico'] = $quadro_logico_lista;

            if ($quadro_logico->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/quadro_logico/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $quadro_logico = new quadro_logicoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $quadro = new quadroModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdquadro') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_quadro = $quadro->listaquadro("{$par}");

            $datas['quadro'] = $detalhes_quadro;
            $niveis = new niveisModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdnivel') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_niveis = $niveis->listaniveis("{$par}");

            $datas['niveis'] = $detalhes_niveis;
            $areas = new areasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdarea') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_areas = $areas->listaareas("{$par}");

            $datas['areas'] = $detalhes_areas;
            if ($quadro_logico->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/quadro_logico/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $quadro_logico = new quadro_logicoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $quadro = new quadroModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdquadro') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_quadro = $quadro->listaquadro("{$par}");

            $datas['quadro'] = $detalhes_quadro;
            $niveis = new niveisModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdnivel') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_niveis = $niveis->listaniveis("{$par}");

            $datas['niveis'] = $detalhes_niveis;
            $areas = new areasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdarea') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_areas = $areas->listaareas("{$par}");

            $datas['areas'] = $detalhes_areas;
            if ($quadro_logico->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/quadro_logico/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $quadro_logico = new quadro_logicoModel();
            $id = $this->getParam('id');
            $detalhes_quadro_logico = $quadro_logico->listaquadro_logico('cdquadro_logico='.$id);
            $datas['quadro_logico'] = $detalhes_quadro_logico;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['quadro_logico'][0]['logica'] );
            $quadro = new quadroModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdquadro') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_quadro = $quadro->listaquadro("{$par}");

            $datas['quadro'] = $detalhes_quadro;
            $niveis = new niveisModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdnivel') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_niveis = $niveis->listaniveis("{$par}");

            $datas['niveis'] = $detalhes_niveis;
            $areas = new areasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdarea') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_areas = $areas->listaareas("{$par}");

            $datas['areas'] = $detalhes_areas;
            if ($quadro_logico->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/quadro_logico/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $quadro_logico = new quadro_logicoModel();
            $dados=$_POST;
            $atualiza = $quadro_logico->atualizaquadro_logico($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/quadro_logico/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/quadro_logico/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $quadro_logico = new quadro_logicoModel();
            $atualiza = $quadro_logico->excluiquadro_logico( 'cdquadro_logico='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($quadro_logico->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/quadro_logico/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $quadro_logico = new quadro_logicoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $quadro = new quadroModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdquadro') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_quadro = $quadro->listaquadro("{$par}");

            $datas['quadro'] = $detalhes_quadro;
            $niveis = new niveisModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdnivel') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_niveis = $niveis->listaniveis("{$par}");

            $datas['niveis'] = $detalhes_niveis;
            $areas = new areasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdarea') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_areas = $areas->listaareas("{$par}");

            $datas['areas'] = $detalhes_areas;
            if ($quadro_logico->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/quadro_logico/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $quadro_logico = new quadro_logicoModel();
            $insere = $quadro_logico->inserequadro_logico($_POST, 'cdquadro_logico');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/quadro_logico/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/quadro_logico/" );
            }

        }


        public function inserem( Array $dados = null ){
            $quadro_logico = new quadro_logicoModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['logica'][0])) {
                $i=0;
                foreach ($dados['logica'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_quadro_logico[$key]=$dados[$key][$i];
                    }
                    $insere = $quadro_logico->inserequadro_logico($dados_quadro_logico,'cdquadro_logico');
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

            header( "Location: /".PROJETO."/quadro_logico/" );


        }



        public function inserew(){
            $quadro_logico = new quadro_logicoModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='quadro_logico') {
                    $dados['quadro_logico'][$p[1]]=$value;
                }
            }

            $inserep = $quadro_logico->inserequadro_logico($dados['quadro_logico'], 'cdquadro_logico');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/quadro_logico/" );
            

        }

        public function pesquisa(){
            $quadro_logico = new quadro_logicoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $quadro = new quadroModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdquadro') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $niveis = new niveisModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdnivel') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $areas = new areasModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdarea') ) {
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

            $pesquisa = $quadro_logico->pesquisaquadro_logico($w);
            $datas['quadro_logico'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/quadro_logico/index', $datas);

    }


}