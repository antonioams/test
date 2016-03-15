
<?php
session_start();
    class wquadro extends Controller{

        public function Index_action(){header( "Location: /".PROJETO."/wquadro/novo/" );
            $wquadro = new wquadroModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $wquadro_lista = $wquadro->listawquadro("{$par}");

            $datas['wquadro'] = $wquadro_lista;

            if ($wquadro->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/wquadro/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $wquadro = new wquadroModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
           $quadro_logico = new quadro_logicoModel();
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
            if ($wquadro->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/wquadro/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $wquadro = new wquadroModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($wquadro->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/wquadro/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $wquadro = new wquadroModel();
            $id = $this->getParam('id');
            $detalhes_wquadro = $wquadro->listawquadro('cdquadro='.$id);
            $datas['wquadro'] = $detalhes_wquadro;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['wquadro'][0]['nome'] );
            if ($wquadro->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/wquadro/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $wquadro = new wquadroModel();
            $dados=$_POST;
            $atualiza = $wquadro->atualizawquadro($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/wquadro/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/wquadro/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $wquadro = new wquadroModel();
            $atualiza = $wquadro->excluiwquadro( 'cdquadro='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($wquadro->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/wquadro/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $wquadro = new wquadroModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            if ($wquadro->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/wquadro/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $wquadro = new wquadroModel();
            $insere = $wquadro->inserewquadro($_POST, 'cdquadro');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/wquadro/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/wquadro/" );
            }

        }


        public function inserem( Array $dados = null ){
            $wquadro = new wquadroModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['nome'][0])) {
                $i=0;
                foreach ($dados['nome'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_wquadro[$key]=$dados[$key][$i];
                    }
                    $insere = $wquadro->inserewquadro($dados_wquadro,'cdquadro');
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

            header( "Location: /".PROJETO."/wquadro/" );


        }



        public function inserew(){
            $wquadro = new wquadroModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='quadro') {
                    $dados['quadro'][$p[1]]=$value;
                }
            }

            $inserep = $wquadro->inserewquadro($dados['quadro'], 'cdquadro');
           $quadro_logico = new quadro_logicoModel();

 
            $dados_['quadro_logico']['cdquadro']=$inserep;
            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='quadro_logico') {
                    $dados['quadro_logico'][$p[1]]=$value;
                }
            }
            $i=0;
            foreach ($dados['quadro_logico']['logica']  as $key2 => $value2) {

            foreach ($dados['quadro_logico'] as $key2 => $value2) {
                        $dados_['quadro_logico'][$key2]=$dados['quadro_logico'][$key2][$i];
            }

            $insere = $quadro_logico->inserequadro_logico($dados_['quadro_logico'], 'cdquadro_logico');
            $i++;
            }
            


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/wquadro/" );
            

        }

        public function pesquisa(){
            $wquadro = new wquadroModel();
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

            $pesquisa = $wquadro->pesquisawquadro($w);
            $datas['wquadro'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/wquadro/index', $datas);

    }


}