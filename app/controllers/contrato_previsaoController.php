
<?php
session_start();
    class contrato_previsao extends Controller{

        public function Index_action(){
            $contrato_previsao = new contrato_previsaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $contrato_previsao_lista = $contrato_previsao->listacontrato_previsao("{$par}");

            $datas['contrato_previsao'] = $contrato_previsao_lista;

            if ($contrato_previsao->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/contrato_previsao/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $contrato_previsao = new contrato_previsaoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $contrato_item = new contrato_itemModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato_item') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contrato_item = $contrato_item->listacontrato_item("{$par}");

            $datas['contrato_item'] = $detalhes_contrato_item;
            if ($contrato_previsao->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/contrato_previsao/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $contrato_previsao = new contrato_previsaoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $contrato_item = new contrato_itemModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato_item') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contrato_item = $contrato_item->listacontrato_item("{$par}");

            $datas['contrato_item'] = $detalhes_contrato_item;
            if ($contrato_previsao->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/contrato_previsao/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $contrato_previsao = new contrato_previsaoModel();
            $id = $this->getParam('id');
            $detalhes_contrato_previsao = $contrato_previsao->listacontrato_previsao('cdcontrato_previsao='.$id);
            $datas['contrato_previsao'] = $detalhes_contrato_previsao;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['contrato_previsao'][0]['cdcontrato_item'] );
            $contrato_item = new contrato_itemModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato_item') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contrato_item = $contrato_item->listacontrato_item("{$par}");

            $datas['contrato_item'] = $detalhes_contrato_item;
            if ($contrato_previsao->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/contrato_previsao/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $contrato_previsao = new contrato_previsaoModel();
            $_POST['valor']= str_replace(",", ".", $_POST['valor']);
            $dados=$_POST;
            $atualiza = $contrato_previsao->atualizacontrato_previsao($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/contrato_previsao/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/contrato_previsao/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $contrato_previsao = new contrato_previsaoModel();
            $atualiza = $contrato_previsao->excluicontrato_previsao( 'cdcontrato_previsao='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($contrato_previsao->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/contrato_previsao/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $contrato_previsao = new contrato_previsaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $contrato_item = new contrato_itemModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato_item') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contrato_item = $contrato_item->listacontrato_item("{$par}");

            $datas['contrato_item'] = $detalhes_contrato_item;
            if ($contrato_previsao->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/contrato_previsao/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $contrato_previsao = new contrato_previsaoModel();	
            $_POST['valor']= str_replace(",", ".", $_POST['valor']);		
			
            $insere = $contrato_previsao->inserecontrato_previsao($_POST, 'cdcontrato_previsao');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/contrato_previsao/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/contrato_previsao/" );
            }

        }


        public function inserem( Array $dados = null ){
            $contrato_previsao = new contrato_previsaoModel();
            $projetos = new projetosModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdcontrato_item'][0])) {
                $i=0;
                $detalhes_contrato_previsao = $projetos->rsql("
                select max(sequencia) as seq from contrato_previsao where cdcontrato_item=".$dados['cdcontrato_item'][0]);
                if ($detalhes_contrato_previsao[0]['seq']!='') {
                $seq=$detalhes_contrato_previsao[0]['seq']+1;
                } else {$seq=1;}
                foreach ($dados['cdcontrato_item'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_contrato_previsao[$key]=$dados[$key][$i];
                    }
                    $dados_contrato_previsao['sequencia']=$seq;
                    $insere = $contrato_previsao->inserecontrato_previsao($dados_contrato_previsao,'cdcontrato_previsao');
                    $i++;
                    $seq++;
                }

            }

           if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso. Registros inseridos.';
            }

            header( "Location: /".PROJETO."/contrato_previsao/" );


        }



        public function inserew(){
            $contrato_previsao = new contrato_previsaoModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='contrato_previsao') {
                    $dados['contrato_previsao'][$p[1]]=$value;
                }
            }

            $inserep = $contrato_previsao->inserecontrato_previsao($dados['contrato_previsao'], 'cdcontrato_previsao');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/contrato_previsao/" );
            

        }

        public function pesquisa(){
            $contrato_previsao = new contrato_previsaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
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

            $pesquisa = $contrato_previsao->pesquisacontrato_previsao($w);
            $datas['contrato_previsao'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/contrato_previsao/index', $datas);

    }


}