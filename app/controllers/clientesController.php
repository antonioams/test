
<?php
session_start();
    class clientes extends Controller{

        public function Index_action(){
            $clientes = new clientesModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            if ($_SESSION[PROJETO]['cdcliente']=='1') {
            $clientes_lista = $clientes->listaclientes("{$par}");
            } else {
            $clientes_lista = $clientes->listaclientes("cdcliente=".$_SESSION[PROJETO]['cdcliente']);
            }
            

            $datas['clientes'] = $clientes_lista;

            if ($clientes->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
               
                $this->view('/clientes/index', $datas);
               
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $clientes = new clientesModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $layouts = new layoutsModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdlayout') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_layouts = $layouts->listalayouts("{$par}");

            $datas['layouts'] = $detalhes_layouts;

            $layoutmapa = new layoutmapaModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdlayoutmapa') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_layoutmapa = $layoutmapa->listalayoutmapa("{$par}");

            $datas['layoutmapa'] = $detalhes_layoutmapa;
            

            $detalhes_clientest = $clientes->listaclientes("template=1");
            
            $datas['clientetemplates'] = $detalhes_clientest;            

            if ($clientes->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/clientes/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $clientes = new clientesModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $layouts = new layoutsModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdlayout') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_layouts = $layouts->listalayouts("{$par}");

            $datas['layouts'] = $detalhes_layouts;

            $layoutmapa = new layoutmapaModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdlayoutmapa') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_layoutmapa = $layoutmapa->listalayoutmapa("{$par}");
            $datas['layoutmapa'] = $detalhes_layoutmapa;
            if ($clientes->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/clientes/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $clientes = new clientesModel();
            $id = $this->getParam('id');
            $detalhes_clientes = $clientes->listaclientes('cdcliente='.$id);
            $datas['clientes'] = $detalhes_clientes;
            $_SESSION[PROJETO]['mapa']['latitude']=$detalhes_clientes[0]['latitude'];
            $_SESSION[PROJETO]['mapa']['longitude']=$detalhes_clientes[0]['longitude'];
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['clientes'][0]['nome'] );
            $layouts = new layoutsModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdlayout') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_layouts = $layouts->listalayouts("{$par}");

            $datas['layouts'] = $detalhes_layouts;

            $layoutmapa = new layoutmapaModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdlayoutmapa') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_layoutmapa = $layoutmapa->listalayoutmapa("{$par}");

            $datas['layoutmapa'] = $detalhes_layoutmapa;

            if ($clientes->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/clientes/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $clientes = new clientesModel();
            
            $_POST['sigla']=strtolower($_POST['sigla']);
                       
            if (empty($_POST['ativo'])) {$_POST['ativo']='';}
            if (empty($_POST['template'])) {$_POST['template']='';}            
            
            $dados=$_POST;

        if(isset($_FILES['logo']['name']) && $_FILES["logo"]["error"] == 0)
        {

        $arquivo_tmp = $_FILES['logo']['tmp_name'];
        $nome = $_FILES['logo']['name'];
        $extensao = strrchr($nome, '.');
        $extensao = strtolower($extensao);
        if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
        {
        $novoNome = 'c'.$id.'.png';
        $dados['logo']=$novoNome;
        $destino = '/var/www/'.PROJETO.'/inc/img/cliente/' . $novoNome; 
        if( move_uploaded_file( $arquivo_tmp, $destino  ))
        {
        }
        else { echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";}
        }
        }
        
         if ($id==$_SESSION[PROJETO]['cdcliente']) {
         $_SESSION[PROJETO]['flickr_chave']==$dados['flickr_chave'];
         $_SESSION[PROJETO]['flickr_sec']==$dados['flickr_sec'];
         $_SESSION[PROJETO]['cliente']==$dados['sigla'];
         }
         $atualiza = $clientes->atualizaclientes($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/clientes/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/clientes/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $clientes = new clientesModel();
            $atualiza = $clientes->excluiclientes( 'cdcliente='.$id );
            if ($atualiza) {    
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';
            } else 
            {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Erro ao excluir informações.';
            }

            if ($clientes->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/clientes/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $clientes = new clientesModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $layouts = new layoutsModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdlayout') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_layouts = $layouts->listalayouts("{$par}");

            $datas['layouts'] = $detalhes_layouts;
            if ($clientes->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/clientes/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $clientes = new clientesModel();

            $_POST['sigla']=strtolower($_POST['sigla']);    
             
            $insere = $clientes->insereclientes($_POST, 'cdcliente');
        
            
        if(isset($_FILES['logo']['name']))
        {

        $arquivo_tmp = $_FILES['logo']['tmp_name'];
        $nome = $_FILES['logo']['name'];
        $extensao = strrchr($nome, '.');
        $extensao = strtolower($extensao);
        if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
        {
        $novonome = 'c'.$insere.'.png';
        $dados['logo']=$novonome;
        $destino = '/var/www/'.PROJETO.'/inc/img/cliente/' . $novonome;
        $atualiza = $clientes->atualizaclientes($dados, $insere ); 
        
        if( move_uploaded_file( $arquivo_tmp, $destino  ))
        {
        }
        else { echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";}
        
        
        }
        
        
        
        }            
     

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
            
            $adb = $clientes->adicionarbanco($_POST['sigla'],1, $_POST['clientetemplate'] );

            

              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/clientes/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/clientes/" );
            }

        }


        public function inserem( Array $dados = null ){
            $clientes = new clientesModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['nome'][0])) {
                $i=0;
                foreach ($dados['nome'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_clientes[$key]=$dados[$key][$i];
                    }
                    $insere = $clientes->insereclientes($dados_clientes,'cdcliente');
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

            header( "Location: /".PROJETO."/clientes/" );


        }

        public function pesquisa(){
            $clientes = new clientesModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $layouts = new layoutsModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdlayout') ) {
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

            $pesquisa = $clientes->pesquisaclientes($w);
            $datas['clientes'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/clientes/index', $datas);

    }


}
