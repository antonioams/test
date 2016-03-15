
<?php
session_start();
    class naturezas extends Controller{

        public function Index_action(){
            $naturezas = new naturezasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $naturezas_lista = $naturezas->listanaturezas("{$par}");

            $datas['naturezas'] = $naturezas_lista;

            if ($naturezas->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/naturezas/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $naturezas = new naturezasModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($naturezas->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/naturezas/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $naturezas = new naturezasModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($naturezas->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/naturezas/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $naturezas = new naturezasModel();
            $id = $this->getParam('id');
            $detalhes_naturezas = $naturezas->listanaturezas('cdnatureza='.$id);
            $datas['naturezas'] = $detalhes_naturezas;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['naturezas'][0]['nome'] );
            if ($naturezas->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/naturezas/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $naturezas = new naturezasModel();
            $dados=$_POST;
            $atualiza = $naturezas->atualizanaturezas($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/naturezas/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/naturezas/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $naturezas = new naturezasModel();
            $atualiza = $naturezas->excluinaturezas( 'cdnatureza='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($naturezas->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/naturezas/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $naturezas = new naturezasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            if ($naturezas->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/naturezas/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $naturezas = new naturezasModel();			
			
            $insere = $naturezas->inserenaturezas($_POST, 'cdnatureza');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/naturezas/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/naturezas/" );
            }

        }


        public function inserem( Array $dados = null ){
            $naturezas = new naturezasModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['nome'][0])) {
                $i=0;
                foreach ($dados['nome'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_naturezas[$key]=$dados[$key][$i];
                    }
                    $insere = $naturezas->inserenaturezas($dados_naturezas,'cdnatureza');
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

            header( "Location: /".PROJETO."/naturezas/" );


        }



        public function inserew(){
            $naturezas = new naturezasModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='natureza') {
                    $dados['natureza'][$p[1]]=$value;
                }
            }

            $inserep = $naturezas->inserenaturezas($dados['natureza'], 'cdnatureza');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/naturezas/" );
            

        }

        public function pesquisa(){
            $naturezas = new naturezasModel();
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

            $pesquisa = $naturezas->pesquisanaturezas($w);
            $datas['naturezas'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/naturezas/index', $datas);

    }


}