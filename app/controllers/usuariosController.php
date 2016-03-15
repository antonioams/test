
<?php
session_start();
    class usuarios extends Controller{

        public function Index_action(){
            $usuarios = new usuariosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $usuarios_lista = $usuarios->listausuarios("{$par}");

            $datas['usuarios'] = $usuarios_lista;

            if ($usuarios->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/usuarios/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }
        public function meuusuario(){
            $usuarios = new usuariosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $consultas = new consultasModel();
            //$usuarios_lista = $usuarios->listausuarios("cdusuario=".$_SESSION[PROJETO]['cdusuario']);
            $usuarios_lista =$consultas->rsql("SELECT u.* FROM usuario u JOIN perfil p  ON u.cdperfil=p.cdperfil
                                JOIN cliente c ON p.cdcliente = c.cdcliente 
                                WHERE 
                                c.cdcliente = ".$_SESSION[PROJETO]['cdcliente']."
                                AND p.cdperfil = ".$_SESSION[PROJETO]['cdperfil']."
                                AND u.cdusuario = ".$_SESSION[PROJETO]['cdusuario']);
          
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            

            $datas['usuarios'] = $usuarios_lista;

            if ($usuarios->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/usuarios/meuusuario', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }
        public function crop(){
    $usuarios = new usuariosModel();
           include("crop.php");
        }

        public function novo(){
           $usuarios = new usuariosModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $unidades = new setoresModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcliente') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            if ($_SESSION[PROJETO]['filtro']['cdcliente']!='') {
            $par='cdcliente='.$_SESSION[PROJETO]['filtro']['cdcliente'];
            }

            $detalhes_unidades = $unidades->listasetores("{$par}");

            $datas['unidades'] = $detalhes_unidades;
            $perfis = new perfisModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdperfil') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_perfis = $perfis->listaperfis("{$par}");

            $datas['perfis'] = $detalhes_perfis;
            if ($usuarios->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/usuarios/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $usuarios = new usuariosModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $unidades = new setoresModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcliente') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            if ($_SESSION[PROJETO]['filtro']['cdcliente']!='') {
            $par='cdcliente='.$_SESSION[PROJETO]['filtro']['cdcliente'];
            }

            $detalhes_unidades = $unidades->listasetores("{$par}");

            $datas['unidades'] = $detalhes_unidades;
            $perfis = new perfisModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdperfil') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_perfis = $perfis->listaperfis("{$par}");

            $datas['perfis'] = $detalhes_perfis;
            if ($usuarios->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/usuarios/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $usuarios = new usuariosModel();
            $id = $this->getParam('id');
            $detalhes_usuarios = $usuarios->listausuarios('cdusuario='.$id);
            $datas['usuarios'] = $detalhes_usuarios;
            $datas['vc'] = $this->modvinculados(get_class($this),$id);
            $unidades = new setoresModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcliente') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            if ($_SESSION[PROJETO]['filtro']['cdcliente']!='') {
            $par='cdcliente='.$_SESSION[PROJETO]['filtro']['cdcliente'];
            }

            $detalhes_unidades = $unidades->listasetores("{$par}");

            $datas['unidades'] = $detalhes_unidades;
            $perfis = new perfisModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdperfil') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_perfis = $perfis->listaperfis("{$par}");

            $datas['perfis'] = $detalhes_perfis;
            if ($usuarios->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/usuarios/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $usuarios = new usuariosModel();
            $dados=$_POST;
            $dados['senha']=md5($dados['senha']);
            $atualiza = $usuarios->atualizausuarios($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/usuarios/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/usuarios/" );

            }

        }

        public function atualizameu(){
            $id = $this->getParam('id');
            $usuarios = new usuariosModel();
            $dados=$_POST;
            $dados['senha']=md5($dados['senha']);
            $atualiza = $usuarios->atualizausuarios($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/usuarios/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/usuarios/meuusuario" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $usuarios = new usuariosModel();
            $atualiza = $usuarios->excluiusuarios( 'cdusuario='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($usuarios->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/usuarios/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $usuarios = new usuariosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $unidades = new setoresModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcliente') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            if ($_SESSION[PROJETO]['filtro']['cdcliente']!='') {
            $par='cdcliente='.$_SESSION[PROJETO]['filtro']['cdcliente'];
            }

            $detalhes_unidades = $unidades->listasetores("{$par}");

            $datas['unidades'] = $detalhes_unidades;
            $perfis = new perfisModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdperfil') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_perfis = $perfis->listaperfis("{$par}");

            $datas['perfis'] = $detalhes_perfis;
            if ($usuarios->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/usuarios/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $usuarios = new usuariosModel();
            $_POST['senha']=md5($_POST['senha']);
            $insere = $usuarios->insereusuarios($_POST, 'cdusuario');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/usuarios/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/usuarios/" );
            }

        }


        public function inserem( Array $dados = null ){
            $usuarios = new usuariosModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['nome'][0])) {
                $i=0;
                foreach ($dados['nome'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_usuarios[$key]=$dados[$key][$i];
                    }
                    $dados_usuarios['senha']=md5($dados_usuarios['senha']);
                    $insere = $usuarios->insereusuarios($dados_usuarios,'cdusuario');
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

            header( "Location: /".PROJETO."/usuarios/" );


        }

        public function pesquisa(){
            $usuarios = new usuariosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $unidades = new setoresModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdunidade') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $perfis = new perfisModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdperfil') ) {
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

            $pesquisa = $usuarios->pesquisausuarios($w);
            $datas['usuarios'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/usuarios/index', $datas);

    }


}