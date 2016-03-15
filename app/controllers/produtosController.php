
<?php
session_start();
    class produtos extends Controller{

        public function Index_action(){
            $produtos = new produtosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $produtos_lista = $produtos->listaprodutos("{$par}");

            $datas['produtos'] = $produtos_lista;

            if ($produtos->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/produtos/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $produtos = new produtosModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $programas = new programasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprograma') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_programas = $programas->listaprogramas("{$par}");

            $datas['programas'] = $detalhes_programas;
            if ($produtos->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/produtos/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $produtos = new produtosModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $programas = new programasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprograma') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_programas = $programas->listaprogramas("{$par}");

            $datas['programas'] = $detalhes_programas;
            if ($produtos->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/produtos/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $produtos = new produtosModel();
            $id = $this->getParam('id');
            $detalhes_produtos = $produtos->listaprodutos('cdproduto='.$id);
            $datas['produtos'] = $detalhes_produtos;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['produtos'][0]['logica'] );
            $programas = new programasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprograma') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_programas = $programas->listaprogramas("{$par}");

            $datas['programas'] = $detalhes_programas;
            if ($produtos->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/produtos/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $produtos = new produtosModel();
            $dados=$_POST;
            $atualiza = $produtos->atualizaprodutos($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/produtos/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/produtos/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $produtos = new produtosModel();
            $atualiza = $produtos->excluiprodutos( 'cdproduto='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($produtos->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/produtos/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $produtos = new produtosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $programas = new programasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprograma') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_programas = $programas->listaprogramas("{$par}");

            $datas['programas'] = $detalhes_programas;
            if ($produtos->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/produtos/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $produtos = new produtosModel();
            $insere = $produtos->insereprodutos($_POST, 'cdproduto');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/produtos/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/produtos/" );
            }

        }


        public function inserem( Array $dados = null ){
            $produtos = new produtosModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['logica'][0])) {
                $i=0;
                foreach ($dados['logica'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_produtos[$key]=$dados[$key][$i];
                    }
                    $insere = $produtos->insereprodutos($dados_produtos,'cdproduto');
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

            header( "Location: /".PROJETO."/produtos/" );


        }



        public function inserew(){
            $produtos = new produtosModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='produto') {
                    $dados['produto'][$p[1]]=$value;
                }
            }

            $inserep = $produtos->insereprodutos($dados['produto'], 'cdproduto');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/produtos/" );
            

        }

        public function pesquisa(){
            $produtos = new produtosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $programas = new programasModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprograma') ) {
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

            $pesquisa = $produtos->pesquisaprodutos($w);
            $datas['produtos'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/produtos/index', $datas);

    }


}