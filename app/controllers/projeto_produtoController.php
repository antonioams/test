
<?php
session_start();
    class projeto_produto extends Controller{

        public function Index_action(){
            $projeto_produto = new projeto_produtoModel();
			$projetos = new projetosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par='and pp.'.$vc['chave'].'='.$vc['valor']; 
                }
            }

               //$projeto_produto_lista = $projeto_produto->listaprojeto_produto("{$par}");
			   $projeto_produto_lista = $projetos->rsql("
                select pp.*, p.logica as plogica, p.tipo as ptipo from projeto_produto pp, produto p
				where pp.cdproduto=p.cdproduto
                ".$par." order by pp.cdprojeto_produto desc");

            $datas['projeto_produto'] = $projeto_produto_lista;

            if ($projeto_produto->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projeto_produto/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $projeto_produto = new projeto_produtoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $produtos = new produtosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdproduto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_produtos = $produtos->listaprodutos("cdprograma in (select cdprograma from projeto where cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto'].")");

            $datas['produtos'] = $detalhes_produtos;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($projeto_produto->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/projeto_produto/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $projeto_produto = new projeto_produtoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $produtos = new produtosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdproduto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_produtos = $produtos->listaprodutos("cdprograma in (select cdprograma from projeto where cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto'].")");

            $datas['produtos'] = $detalhes_produtos;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($projeto_produto->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projeto_produto/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $projeto_produto = new projeto_produtoModel();
            $id = $this->getParam('id');
            $detalhes_projeto_produto = $projeto_produto->listaprojeto_produto('cdprojeto_produto='.$id);
            $datas['projeto_produto'] = $detalhes_projeto_produto;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['projeto_produto'][0]['cdproduto'] );
            $produtos = new produtosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdproduto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_produtos = $produtos->listaprodutos("cdprograma in (select cdprograma from projeto where cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto'].")");

            $datas['produtos'] = $detalhes_produtos;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($projeto_produto->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projeto_produto/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $projeto_produto = new projeto_produtoModel();
            $dados=$_POST;
            $atualiza = $projeto_produto->atualizaprojeto_produto($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/projeto_produto/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/projeto_produto/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $projeto_produto = new projeto_produtoModel();
            $atualiza = $projeto_produto->excluiprojeto_produto( 'cdprojeto_produto='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($projeto_produto->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/projeto_produto/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $projeto_produto = new projeto_produtoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $produtos = new produtosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdproduto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_produtos = $produtos->listaprodutos("{$par}");

            $datas['produtos'] = $detalhes_produtos;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($projeto_produto->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projeto_produto/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $projeto_produto = new projeto_produtoModel();			
			
            $insere = $projeto_produto->insereprojeto_produto($_POST, 'cdprojeto_produto');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/projeto_produto/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/projeto_produto/" );
            }

        }


        public function inserem( Array $dados = null ){
            $projeto_produto = new projeto_produtoModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdproduto'][0])) {
                $i=0;
                foreach ($dados['cdproduto'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_projeto_produto[$key]=$dados[$key][$i];
                    }
                    $insere = $projeto_produto->insereprojeto_produto($dados_projeto_produto,'cdprojeto_produto');
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

            header( "Location: /".PROJETO."/projeto_produto/" );


        }



        public function inserew(){
            $projeto_produto = new projeto_produtoModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='projeto_produto') {
                    $dados['projeto_produto'][$p[1]]=$value;
                }
            }

            $inserep = $projeto_produto->insereprojeto_produto($dados['projeto_produto'], 'cdprojeto_produto');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/projeto_produto/" );
            

        }

        public function pesquisa(){
            $projeto_produto = new projeto_produtoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $produtos = new produtosModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdproduto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $projetos = new projetosModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
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

            $pesquisa = $projeto_produto->pesquisaprojeto_produto($w);
            $datas['projeto_produto'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/projeto_produto/index', $datas);

    }


}