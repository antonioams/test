
<?php
session_start();
    class areas extends Controller{

        public function Index_action(){
            $areas = new areasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $areas_lista = $areas->listaareas("{$par}");

            $datas['areas'] = $areas_lista;

            if ($areas->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/areas/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $areas = new areasModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($areas->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/areas/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $areas = new areasModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($areas->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/areas/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $areas = new areasModel();
            $id = $this->getParam('id');
            $detalhes_areas = $areas->listaareas('cdarea='.$id);
            $datas['areas'] = $detalhes_areas;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['areas'][0]['descricao'] );
            if ($areas->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/areas/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $areas = new areasModel();
            $dados=$_POST;

            if(isset($_FILES['icone']['name']) && $_FILES["icone"]["error"] == 0)
        {

        $arquivo_tmp = $_FILES['icone']['tmp_name'];
        $nome = $_FILES['icone']['name'];
        $extensao = strrchr($nome, '.');
        $extensao = strtolower($extensao);
        if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
        {
        $novoNome = 'a'.$id.'.png';
        $dados['icone']=$novoNome;
        $destino = '/var/www/'.PROJETO.'/inc/img/area/' . $novoNome; 
        if( move_uploaded_file( $arquivo_tmp, $destino  ))
        {
        }
        else { echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";}
        }
        }



        if(isset($_FILES['icone_mapa']['name']) && $_FILES["icone_mapa"]["error"] == 0)
        {

        $arquivo_tmp = $_FILES['icone_mapa']['tmp_name'];
        $nome = $_FILES['icone_mapa']['name'];
        $extensao = strrchr($nome, '.');
        $extensao = strtolower($extensao);
        if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
        {
        $novoNome = 'mapa'.$id.'.png';
        $dados['icone_mapa']=$novoNome;
        $destino = '/var/www/'.PROJETO.'/inc/img/area/' . $novoNome; 
        if( move_uploaded_file( $arquivo_tmp, $destino  ))
        {
        }
        else { echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";}
        }
        }

            $atualiza = $areas->atualizaareas($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/areas/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/areas/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $areas = new areasModel();
            $atualiza = $areas->excluiareas( 'cdarea='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($areas->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/areas/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $areas = new areasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            if ($areas->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/areas/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $areas = new areasModel();
            $insere = $areas->insereareas($_POST, 'cdarea');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {

                 if(isset($_FILES['icone']['name']) && $_FILES["icone"]["error"] == 0)
        {

        $arquivo_tmp = $_FILES['icone']['tmp_name'];
        $nome = $_FILES['icone']['name'];
        $extensao = strrchr($nome, '.');
        $extensao = strtolower($extensao);
        if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
        {
        $novoNome = 'a'.$insere.'.png';
        $dados['icone']=$novoNome;
        $atualiza = $areas->atualizaareas($dados, $insere );
        $destino = '/var/www/'.PROJETO.'/inc/img/area/' . $novoNome; 
        if( move_uploaded_file( $arquivo_tmp, $destino  ))
        {
        }
        else { echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";}
        }
        }



        if(isset($_FILES['icone_mapa']['name']) && $_FILES["icone_mapa"]["error"] == 0)
        {

        $arquivo_tmp = $_FILES['icone_mapa']['tmp_name'];
        $nome = $_FILES['icone_mapa']['name'];
        $extensao = strrchr($nome, '.');
        $extensao = strtolower($extensao);
        if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
        {
        $novoNome = 'mapa'.$insere.'.png';
        $dados['icone_mapa']=$novoNome;
        $atualiza = $areas->atualizaareas($dados, $insere );
        $destino = '/var/www/'.PROJETO.'/inc/img/area/' . $novoNome; 
        if( move_uploaded_file( $arquivo_tmp, $destino  ))
        {
        }
        else { echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";}
        }
        }

              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/areas/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/areas/" );
            }

        }


        public function inserem( Array $dados = null ){
            $areas = new areasModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['descricao'][0])) {
                $i=0;
                foreach ($dados['descricao'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_areas[$key]=$dados[$key][$i];
                    }
                    $insere = $areas->insereareas($dados_areas,'cdarea');
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

            header( "Location: /".PROJETO."/areas/" );


        }

        public function pesquisa(){
            $areas = new areasModel();
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

            $pesquisa = $areas->pesquisaareas($w);
            $datas['areas'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/areas/index', $datas);

    }


}