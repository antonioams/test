
<?php
session_start();
    class objetivo_produto extends Controller{

        public function Index_action(){
            $objetivo_produto = new objetivo_produtoModel();
            $projetos = new projetosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                      $par='and op.'.$vc['chave'].'='.$vc['valor']; 
                }
            }

               //$projeto_produto_lista = $projeto_produto->listaprojeto_produto("{$par}");
			   $objetivo_produto_lista = $projetos->rsql("
                select op.*, o.logica as plogica, o.tipo as ptipo from objetivo_produto op, objetivo_informacao o
				where op.cdobjetivo_informacao=o.cdobjetivo_informacao
                ".$par." order by op.cdobjetivo_informacao desc");
                
              $datas['objetivo_produto'] = $objetivo_produto_lista;

            if ($objetivo_produto->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/objetivo_produto/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $objetivo_produto = new objetivo_produtoModel();
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
            $objetivo_informacao = new objetivo_informacaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdobjetivo_informacao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            
            $detalhes_objetivo_informacao = $objetivo_informacao->listaobjetivo_informacao("cdprograma=".$_SESSION[PROJETO]['filtro']['cdprograma']);

            $datas['objetivo_informacao'] = $detalhes_objetivo_informacao;
            if ($objetivo_produto->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/objetivo_produto/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $objetivo_produto = new objetivo_produtoModel();
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
            $objetivo_informacao = new objetivo_informacaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdobjetivo_informacao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_objetivo_informacao = $objetivo_informacao->listaobjetivo_informacao("cdprograma=".$_SESSION[PROJETO]['filtro']['cdprograma']);

            $datas['objetivo_informacao'] = $detalhes_objetivo_informacao;
            if ($objetivo_produto->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/objetivo_produto/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $objetivo_produto = new objetivo_produtoModel();
            $id = $this->getParam('id');
            $detalhes_objetivo_produto = $objetivo_produto->listaobjetivo_produto('cdobjetivo_produto='.$id);
            $datas['objetivo_produto'] = $detalhes_objetivo_produto;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['objetivo_produto'][0]['cdobjetivo_informacao'] );
            $produtos = new produtosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdproduto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_produtos = $produtos->listaprodutos("{$par}");

            $datas['produtos'] = $detalhes_produtos;
            $objetivo_informacao = new objetivo_informacaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdobjetivo_informacao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_objetivo_informacao = $objetivo_informacao->listaobjetivo_informacao("cdprograma=".$_SESSION[PROJETO]['filtro']['cdprograma']);

            $datas['objetivo_informacao'] = $detalhes_objetivo_informacao;
            if ($objetivo_produto->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/objetivo_produto/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $objetivo_produto = new objetivo_produtoModel();
            $dados=$_POST;
            $atualiza = $objetivo_produto->atualizaobjetivo_produto($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/objetivo_produto/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/objetivo_produto/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $objetivo_produto = new objetivo_produtoModel();
            $atualiza = $objetivo_produto->excluiobjetivo_produto( 'cdobjetivo_produto='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($objetivo_produto->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/objetivo_produto/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $objetivo_produto = new objetivo_produtoModel();
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
            $objetivo_informacao = new objetivo_informacaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdobjetivo_informacao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_objetivo_informacao = $objetivo_informacao->listaobjetivo_informacao("{$par}");

            $datas['objetivo_informacao'] = $detalhes_objetivo_informacao;
            if ($objetivo_produto->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/objetivo_produto/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $objetivo_produto = new objetivo_produtoModel();			
			
            $insere = $objetivo_produto->insereobjetivo_produto($_POST, 'cdobjetivo_produto');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/objetivo_produto/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/objetivo_produto/" );
            }

        }


        public function inserem( Array $dados = null ){
            $objetivo_produto = new objetivo_produtoModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdobjetivo_informacao'][0])) {
                $i=0;
                foreach ($dados['cdobjetivo_informacao'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_objetivo_produto[$key]=$dados[$key][$i];
                    }
                    $insere = $objetivo_produto->insereobjetivo_produto($dados_objetivo_produto,'cdobjetivo_produto');
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

            header( "Location: /".PROJETO."/objetivo_produto/" );


        }



        public function inserew(){
            $objetivo_produto = new objetivo_produtoModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='objetivo_produto') {
                    $dados['objetivo_produto'][$p[1]]=$value;
                }
            }

            $inserep = $objetivo_produto->insereobjetivo_produto($dados['objetivo_produto'], 'cdobjetivo_produto');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/objetivo_produto/" );
            

        }

        public function pesquisa(){
            $objetivo_produto = new objetivo_produtoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $produtos = new produtosModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdproduto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $objetivo_informacao = new objetivo_informacaoModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdobjetivo_informacao') ) {
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

            $pesquisa = $objetivo_produto->pesquisaobjetivo_produto($w);
            $datas['objetivo_produto'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/objetivo_produto/index', $datas);

    }


}
