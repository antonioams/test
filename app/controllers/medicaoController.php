
<?php
session_start();
    class medicao extends Controller{

        public function Index_action(){
            $projetos = new projetosModel();
            $medicao = new medicaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }       
            
            $medicao_lista =  $projetos->rsql("
                select m.cdmedicao, m.cdgrupomedicao, ci.descricao, ci.quantidade as quantidade_item, ci.valor as valor_item, m.quantidade, m.valor, u.descricao as unidade from medicao m, contrato_item ci
                left outer join unidade u on ci.cdunidade=u.cdunidade
                where m.cdcontrato_item=ci.cdcontrato_item and m.cdgrupomedicao=".$_SESSION[PROJETO]['filtro']['cdgrupomedicao']."                
                order by ci.descricao ");
                
          $datas['medicao'] = $medicao_lista;

            if ($medicao->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/medicao/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $medicao = new medicaoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $grupomedicao = new grupomedicaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdgrupomedicao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_grupomedicao = $grupomedicao->listagrupomedicao("{$par}");

            $datas['grupomedicao'] = $detalhes_grupomedicao;
            $contrato_item = new contrato_itemModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato_item') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contrato_item = $contrato_item->listacontrato_item("cdcontrato in ( select cdcontrato from grupomedicao where cdgrupomedicao=".$_SESSION[PROJETO]['filtro']['cdgrupomedicao'].")");

            $datas['contrato_item'] = $detalhes_contrato_item;
            if ($medicao->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/medicao/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $medicao = new medicaoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $grupomedicao = new grupomedicaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdgrupomedicao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_grupomedicao = $grupomedicao->listagrupomedicao("{$par}");

            $datas['grupomedicao'] = $detalhes_grupomedicao;
            $contrato_item = new contrato_itemModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato_item') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contrato_item = $contrato_item->listacontrato_item("cdcontrato in ( select cdcontrato from grupomedicao where cdgrupomedicao=".$_SESSION[PROJETO]['filtro']['cdgrupomedicao'].")");

            $datas['contrato_item'] = $detalhes_contrato_item;
            if ($medicao->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/medicao/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $medicao = new medicaoModel();
            $id = $this->getParam('id');
            $detalhes_medicao = $medicao->listamedicao('cdmedicao='.$id);
            $detalhes_medicao[0]['valor']= str_replace(".", ",", $detalhes_medicao[0]['valor']);
            $datas['medicao'] = $detalhes_medicao;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['medicao'][0]['quantidade'] );
            $grupomedicao = new grupomedicaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdgrupomedicao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_grupomedicao = $grupomedicao->listagrupomedicao("{$par}");

            $datas['grupomedicao'] = $detalhes_grupomedicao;
            $contrato_item = new contrato_itemModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato_item') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contrato_item = $contrato_item->listacontrato_item("cdcontrato in ( select cdcontrato from grupomedicao where cdgrupomedicao=".$_SESSION[PROJETO]['filtro']['cdgrupomedicao'].")");

            $datas['contrato_item'] = $detalhes_contrato_item;
            if ($medicao->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/medicao/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $medicao = new medicaoModel();
            $_POST['valor']= str_replace(",", ".", $_POST['valor']);
            $dados=$_POST;
            $atualiza = $medicao->atualizamedicao($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/medicao/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/medicao/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $medicao = new medicaoModel();
            $atualiza = $medicao->excluimedicao( 'cdmedicao='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($medicao->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/medicao/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $medicao = new medicaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $grupomedicao = new grupomedicaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdgrupomedicao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_grupomedicao = $grupomedicao->listagrupomedicao("{$par}");

            $datas['grupomedicao'] = $detalhes_grupomedicao;
            $contrato_item = new contrato_itemModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato_item') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contrato_item = $contrato_item->listacontrato_item("cdcontrato in ( select cdcontrato from contrato where cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto'].")");

            $datas['contrato_item'] = $detalhes_contrato_item;
            if ($medicao->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/medicao/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            
            $medicao = new medicaoModel();			
			      $_POST['valor']= str_replace(",", ".", $_POST['valor']);
            $insere = $medicao->inseremedicao($_POST, 'cdmedicao');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/medicao/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/medicao/" );
            }

        }


        public function inserem( Array $dados = null ){
            $medicao = new medicaoModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['quantidade'][0])) {
                $i=0;
                foreach ($dados['quantidade'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_medicao[$key]=$dados[$key][$i];
                    }
                    $dados_medicao['valor']= str_replace(",", ".", $dados_medicao['valor']);
                    $insere = $medicao->inseremedicao($dados_medicao,'cdmedicao');
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

            header( "Location: /".PROJETO."/medicao/" );


        }



        public function inserew(){
            die();
            $medicao = new medicaoModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='medicao') {
                    $dados['medicao'][$p[1]]=$value;
                }
            }

            $inserep = $medicao->inseremedicao($dados['medicao'], 'cdmedicao');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/medicao/" );
            

        }

        public function pesquisa(){
            $medicao = new medicaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $grupomedicao = new grupomedicaoModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdgrupomedicao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $contrato_item = new contrato_itemModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato_item') ) {
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

            $pesquisa = $medicao->pesquisamedicao($w);
            $datas['medicao'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/medicao/index', $datas);

    }


}
