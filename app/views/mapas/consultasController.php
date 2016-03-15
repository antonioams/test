
<?php
session_start();
    class consultas extends Controller{

        public function Index_action(){
            $consultas = new consultasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $consultas_lista = $consultas->listaconsultas("{$par}");

            $datas['consultas'] = $consultas_lista;

            if ($consultas->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
               
                $this->view('/consultas/index', $datas);
                
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $consultas = new consultasModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($consultas->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/consultas/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $consultas = new consultasModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($consultas->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/consultas/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $consultas = new consultasModel();
            $id = $this->getParam('id');
            $detalhes_consultas = $consultas->listaconsultas('cdconsulta='.$id);
            $datas['consultas'] = $detalhes_consultas;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['consultas'][0]['titulo'] );
            if ($consultas->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/consultas/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $consultas = new consultasModel();
            $dados=$_POST;
            $dados['tipo']=implode( ',' , $_POST['tipo']);
            $dados['visualizacao']=implode( ',' , $_POST['visualizacao']);
            $atualiza = $consultas->atualizaconsultas($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/consultas/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/consultas/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $consultas = new consultasModel();
            $atualiza = $consultas->excluiconsultas( 'cdconsulta='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($consultas->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/consultas/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $consultas = new consultasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            if ($consultas->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/consultas/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $consultas = new consultasModel();
            $_POST['tipo']=implode( ',' , $_POST['tipo']);
            $_POST['visualizacao']=implode( ',' , $_POST['visualizacao']);
            $insere = $consultas->insereconsultas($_POST, 'cdconsulta');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/consultas/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/consultas/" );
            }

        }


        public function inserem( Array $dados = null ){
            $consultas = new consultasModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['titulo'][0])) {
                $i=0;
                foreach ($dados['titulo'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_consultas[$key]=$dados[$key][$i];
                    }
                    $insere = $consultas->insereconsultas($dados_consultas,'cdconsulta');
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

            header( "Location: /".PROJETO."/consultas/" );


        }

        public function pesquisa(){
            $consultas = new consultasModel();
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

            $pesquisa = $consultas->pesquisaconsultas($w);
            $datas['consultas'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/consultas/index', $datas);

    }


}