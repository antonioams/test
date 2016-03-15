
<?php
session_start();
    class wconsulta extends Controller{

        public function Index_action(){header( "Location: /".PROJETO."/wconsulta/novo/" );
            $wconsulta = new wconsultaModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $wconsulta_lista = $wconsulta->listawconsulta("{$par}");

            $datas['wconsulta'] = $wconsulta_lista;

            if ($wconsulta->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/wconsulta/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){

           header( "Location: /".PROJETO."/consultas/novo" );            
           $wconsulta = new wconsultaModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
           $saidas = new saidasModel();
            $consultas = new consultasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdconsulta') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_consultas = $consultas->listaconsultas("{$par}");

            $datas['consultas'] = $detalhes_consultas;
            $usuarios = new usuariosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdusuario') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_usuarios = $usuarios->listausuarios("{$par}");

            $datas['usuarios'] = $detalhes_usuarios;
            if ($wconsulta->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/wconsulta/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $wconsulta = new wconsultaModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($wconsulta->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/wconsulta/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $wconsulta = new wconsultaModel();
            $id = $this->getParam('id');
            $detalhes_wconsulta = $wconsulta->listawconsulta('cdconsulta='.$id);
            $datas['wconsulta'] = $detalhes_wconsulta;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['wconsulta'][0][''] );
            if ($wconsulta->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/wconsulta/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $wconsulta = new wconsultaModel();
            $dados=$_POST;
            $atualiza = $wconsulta->atualizawconsulta($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/wconsulta/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/wconsulta/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $wconsulta = new wconsultaModel();
            $atualiza = $wconsulta->excluiwconsulta( 'cdconsulta='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($wconsulta->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/wconsulta/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $wconsulta = new wconsultaModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            if ($wconsulta->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/wconsulta/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $wconsulta = new wconsultaModel();
            $insere = $wconsulta->inserewconsulta($_POST, 'cdconsulta');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/wconsulta/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/wconsulta/" );
            }

        }


        public function inserem( Array $dados = null ){
            $wconsulta = new wconsultaModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdconsulta'][0])) {
                $i=0;
                foreach ($dados['cdconsulta'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_wconsulta[$key]=$dados[$key][$i];
                    }
                    $insere = $wconsulta->inserewconsulta($dados_wconsulta,'cdconsulta');
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

            header( "Location: /".PROJETO."/wconsulta/" );


        }



        public function inserew(){
            $wconsulta = new wconsultaModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='consulta') {
                    $dados['consulta'][$p[1]]=$value;
                }
            }

            $inserep = $wconsulta->inserewconsulta($dados['consulta'], 'cdconsulta');
           $saidas = new saidasModel();

 
            $dados_['saida']['cdconsulta']=$inserep;
            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='saida') {
                    $dados['saida'][$p[1]]=$value;
                }
            }
            $i=0;
            foreach ($dados['saida']['cdsaida']  as $key2 => $value2) {

            foreach ($dados['saida'] as $key2 => $value2) {
                        $dados_['saida'][$key2]=$dados['saida'][$key2][$i];
            }

            $insere = $saidas->inseresaidas($dados_['saida'], 'cdsaida');
            $i++;
            }
            


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/wconsulta/" );
            

        }

        public function pesquisa(){
            $wconsulta = new wconsultaModel();
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

            $pesquisa = $wconsulta->pesquisawconsulta($w);
            $datas['wconsulta'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/wconsulta/index', $datas);

    }


}