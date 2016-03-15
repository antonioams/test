
<?php
session_start();
    class subitem extends Controller{


        public function atualizar_item($idcontrato){
        
            $contrato_item = new contrato_itemModel();
            $projetos = new projetosModel();
            
            $contrato_item_lista = $projetos->rsql("
                select sum(quantidade) as quantidade, sum(valor) as valor from contrato_item
                where cdcontrato_item_sup=".$idcontrato);
                  if ($contrato_item_lista[0]['valor']!='') {
            $dados_item['quantidade']=$contrato_item_lista[0]['quantidade'];
            $dados_item['valor']=$contrato_item_lista[0]['valor'];
            $dados_item['subitem']=0;
            $atualiza = $contrato_item->atualizacontrato_item($dados_item, $idcontrato );
            }     
        }



        public function Index_action(){
            $subitem = new subitemModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $subitem_lista = $subitem->listasubitem("cdcontrato_item_sup=".$_SESSION[PROJETO]['filtro']['cdcontrato_item']);

            $datas['subitem'] = $subitem_lista;

            if ($subitem->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/subitem/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $subitem = new subitemModel(); 
           $unidades = new unidadesModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
           
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdunidade') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_unidades = $unidades->listaunidades("{$par}");

            $datas['unidades'] = $detalhes_unidades;
            $contratos = new contratosModel();          
          
            if ($subitem->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/subitem/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $subitem = new subitemModel();
            $unidades = new unidadesModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
      
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdunidade') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_unidades = $unidades->listaunidades("{$par}");

            $datas['unidades'] = $detalhes_unidades;
            $contratos = new contratosModel();      
      
            if ($subitem->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/subitem/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $subitem = new subitemModel();
            $unidades = new unidadesModel();
            $id = $this->getParam('id');
            $detalhes_subitem = $subitem->listasubitem('cdcontrato_item='.$id);
            $datas['subitem'] = $detalhes_subitem;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['subitem'][0]['descricao'] );
            
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdunidade') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_unidades = $unidades->listaunidades("{$par}");

            $datas['unidades'] = $detalhes_unidades;
            $contratos = new contratosModel();            
            
            if ($subitem->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/subitem/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $subitem = new subitemModel();
            
            $_POST['cdcontrato_item_sup']=$_SESSION[PROJETO]['filtro']['cdcontrato_item'];
            
            $dados=$_POST;
            $atualiza = $subitem->atualizasubitem($dados, $id );
            
            if ($dados['cdcontrato_item_sup']!='') {
                $this->atualizar_item($dados['cdcontrato_item_sup']);
            }

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/subitem/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/subitem/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $subitem = new subitemModel();
            
            $projetos = new projetosModel();

            $contrato_item_lista = $projetos->rsql("
                select ci.cdcontrato_item_sup from contrato_item ci                
                where ci.cdcontrato_item=".$id);
                
            $dados_item = $contrato_item_lista[0]['cdcontrato_item_sup'];
            
            
            $atualiza = $subitem->excluisubitem('cdcontrato_item='.$id );
            
            if ($dados_item!='') {
                $this->atualizar_item($dados_item);
            }            
            
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($subitem->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/subitem/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $subitem = new subitemModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            if ($subitem->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/subitem/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $subitem = new subitemModel();			
			
            $_POST['cdcontrato_item_sup']=$_SESSION[PROJETO]['filtro']['cdcontrato_item'];
            
            $insere = $subitem->inseresubitem($_POST, 'cdcontrato_item');
            
            if ($_POST['cdcontrato_item_sup']!='') {
                $this->atualizar_item($_POST['cdcontrato_item_sup']);
            }            

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/subitem/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/subitem/" );
            }

        }


        public function inserem( Array $dados = null ){
            $subitem = new subitemModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['descricao'][0])) {
                $i=0;
                foreach ($dados['descricao'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_subitem[$key]=$dados[$key][$i];
                    }
                    $dados_subitem['cdcontrato_item_sup']=$_SESSION[PROJETO]['filtro']['cdcontrato_item'];
                    $insere = $subitem->inseresubitem($dados_subitem,'cdcontrato_item');
                    
                    if ($dados_subitem['cdcontrato_item_sup']!='') {
                        $this->atualizar_item($dados_subitem['cdcontrato_item_sup']);
                    }                    
                    
                    
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

            header( "Location: /".PROJETO."/subitem/" );


        }



        public function inserew(){
            $subitem = new subitemModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='contrato_item') {
                    $dados['contrato_item'][$p[1]]=$value;
                }
            }

            $inserep = $subitem->inseresubitem($dados['contrato_item'], 'cdcontrato_item');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/subitem/" );
            

        }

        public function pesquisa(){
            $subitem = new subitemModel();
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

            $pesquisa = $subitem->pesquisasubitem($w);
            $datas['subitem'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/subitem/index', $datas);

    }


}