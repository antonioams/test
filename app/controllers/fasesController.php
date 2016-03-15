
<?php
session_start();
    class fases extends Controller{

        public function Index_action(){
            $fases = new fasesModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $fases_lista = $fases->listafases("{$par}");

            $datas['fases'] = $fases_lista;

            if ($fases->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/fases/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $fases = new fasesModel();
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
            if ($fases->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/fases/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $fases = new fasesModel();
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
            if ($fases->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/fases/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $fases = new fasesModel();
            $id = $this->getParam('id');
            $detalhes_fases = $fases->listafases('cdfase='.$id);
            $datas['fases'] = $detalhes_fases;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['fases'][0]['nome'] );
            $tipos = new tiposModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdtipo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_tipos = $tipos->listatipos("{$par}");

            $datas['tipos'] = $detalhes_tipos;
            if ($fases->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/fases/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $fases = new fasesModel();
            $dados=$_POST;
            $atualiza = $fases->atualizafases($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/fases/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/fases/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $fases = new fasesModel();
            $atualiza = $fases->excluifases( 'cdfase='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($fases->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/fases/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $fases = new fasesModel();
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
            if ($fases->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/fases/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $fases = new fasesModel();
            $insere = $fases->inserefases($_POST, 'cdfase');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/fases/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/fases/" );
            }

        }


        public function inserem( Array $dados = null ){
            $fases = new fasesModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['nome'][0])) {
                $i=0;
                foreach ($dados['nome'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_fases[$key]=$dados[$key][$i];
                    }
                    $insere = $fases->inserefases($dados_fases,'cdfase');
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

            header( "Location: /".PROJETO."/fases/" );


        }



        public function inserew(){
            $fases = new fasesModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='fase') {
                    $dados['fase'][$p[1]]=$value;
                }
            }

            $inserep = $fases->inserefases($dados['fase'], 'cdfase');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/fases/" );
            

        }

        public function pesquisa(){
            $fases = new fasesModel();
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

            $pesquisa = $fases->pesquisafases($w);
            $datas['fases'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/fases/index', $datas);

    }


}