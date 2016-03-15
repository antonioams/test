
<?php
session_start();
    class contrato_item extends Controller{


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
            $projetos = new projetosModel();
            $contrato_item = new contrato_itemModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            /*$contrato_item_lista = $projetos->rsql("
                select ci.cdcontrato_item as codigo, 1 as tipo ,ci.cdcontrato_item, ci.cdcontrato, ci.descricao, ci.quantidade, ci.valor, ci.data, u.descricao as unidade, ci.cdcontrato_item_sup, sum(cp.valor) as valor_previsao from contrato_item ci
                left outer join contrato_previsao cp on ci.cdcontrato_item=cp.cdcontrato_item
                left outer join unidade u on ci.cdunidade=u.cdunidade
                where ci.cdcontrato_item_sup is null and ci.cdcontrato=".$_SESSION[PROJETO]['filtro']['cdcontrato']."
                group by ci.cdcontrato_item, ci.cdcontrato, ci.descricao, ci.quantidade, ci.valor, ci.data, u.descricao, ci.cdcontrato_item_sup
                union
                select ci.cdcontrato_item_sup as codigo, 2 as tipo ,ci.cdcontrato_item, ci.cdcontrato, '&nbsp;&nbsp;&nbsp;&nbsp;' || ci.descricao as descricao, ci.quantidade, ci.valor, ci.data, u.descricao as unidade, ci.cdcontrato_item_sup,  sum(cp.valor) as valor_previsao from contrato_item ci
                left outer join contrato_previsao cp on ci.cdcontrato_item=cp.cdcontrato_item
                left outer join unidade u on ci.cdunidade=u.cdunidade
                where ci.cdcontrato_item_sup is not null and ci.cdcontrato=".$_SESSION[PROJETO]['filtro']['cdcontrato']."
                group by ci.cdcontrato_item, ci.cdcontrato, ci.descricao, ci.quantidade, ci.valor, ci.data, u.descricao, ci.cdcontrato_item_sup 
                order by 1,2,3 "); */
                
                $contrato_item_lista = $projetos->rsql("
                select ci.cdcontrato_item as codigo, 1 as tipo ,ci.cdcontrato_item, ci.cdcontrato, ci.descricao, ci.quantidade, ci.valor, ci.data, u.descricao as unidade, ci.cdcontrato_item_sup, sum(cp.valor) as valor_previsao from contrato_item ci
                left outer join contrato_previsao cp on ci.cdcontrato_item=cp.cdcontrato_item
                left outer join unidade u on ci.cdunidade=u.cdunidade
                where ci.cdcontrato_item_sup is null and ci.cdcontrato=".$_SESSION[PROJETO]['filtro']['cdcontrato']."
                group by ci.cdcontrato_item, ci.cdcontrato, ci.descricao, ci.quantidade, ci.valor, ci.data, u.descricao, ci.cdcontrato_item_sup ");
                                
                
            $datas['contrato_item'] = $contrato_item_lista;
            
            $u=0;
            $i=0;
            $ii=0;
            
            foreach ($contrato_item_lista as $key => $value) {            
                if ($datas['contrato_item'][$u]['cdcontrato_item_sup']!='') {
                  $datas['contrato_item'][$u]['i']= ($i).'.'.($ii+1);
                  $ii++;
                } else {
                  $datas['contrato_item'][$u]['i']= $i+1;
                  $ii=0;
                  $i++;
                }
              $u++;
              
          }    
                   

            if ($contrato_item->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/contrato_item/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $contrato_item = new contrato_itemModel();           
           $datas['vc'] = $this->modvinculados(get_class($this));
            $unidades = new unidadesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdunidade') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_unidades = $unidades->listaunidades("{$par}");

            $datas['unidades'] = $detalhes_unidades;
            $contratos = new contratosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contratos = $contratos->listacontratos("{$par}");

            $datas['contratos'] = $detalhes_contratos;

            $projetos = new projetosModel();
            $contrato_item_lista = $projetos->rsql("
                select ci.cdcontrato_item, ci.cdcontrato, ci.descricao, ci.quantidade, ci.valor, ci.data, u.descricao as unidade from contrato_item ci
                left outer join unidade u on ci.cdunidade=u.cdunidade                
                where  ci.cdcontrato_item_sup is null and ci.cdcontrato=".$_SESSION[PROJETO]['filtro']['cdcontrato']."                
                order by ci.descricao ");               
     
            $datas['contrato_item_sup'] = $contrato_item_lista;
            
     
          
                        
            if ($contrato_item->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/contrato_item/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $contrato_item = new contrato_itemModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $unidades = new unidadesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdunidade') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_unidades = $unidades->listaunidades("{$par}");

            $datas['unidades'] = $detalhes_unidades;
            $contratos = new contratosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contratos = $contratos->listacontratos("{$par}");

            $datas['contratos'] = $detalhes_contratos;
            
            $projetos = new projetosModel();
            $contrato_item_lista = $projetos->rsql("
                select ci.cdcontrato_item, ci.cdcontrato, ci.descricao, ci.quantidade, ci.valor, ci.data, u.descricao as unidade from contrato_item ci
                left outer join unidade u on ci.cdunidade=u.cdunidade                
                where  ci.cdcontrato_item_sup is null and ci.cdcontrato=".$_SESSION[PROJETO]['filtro']['cdcontrato']."                
                order by ci.descricao ");               
     
            $datas['contrato_item_sup'] = $contrato_item_lista;
  
            
            if ($contrato_item->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/contrato_item/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $contrato_item = new contrato_itemModel();
            $id = $this->getParam('id');
            $detalhes_contrato_item = $contrato_item->listacontrato_item('cdcontrato_item='.$id);
            $detalhes_contrato_item[0]['valor']= str_replace(".", ",", $detalhes_contrato_item[0]['valor']);
            $datas['contrato_item'] = $detalhes_contrato_item;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['contrato_item'][0]['descricao'] );
            $unidades = new unidadesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdunidade') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_unidades = $unidades->listaunidades("{$par}");

            $datas['unidades'] = $detalhes_unidades;
            $contratos = new contratosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contratos = $contratos->listacontratos("{$par}");

            $datas['contratos'] = $detalhes_contratos;
            
            $projetos = new projetosModel();
            $contrato_item_lista = $projetos->rsql("
                select ci.cdcontrato_item, ci.cdcontrato, ci.descricao, ci.quantidade, ci.valor, ci.data, u.descricao as unidade from contrato_item ci
                left outer join unidade u on ci.cdunidade=u.cdunidade                
                where  ci.cdcontrato_item_sup is null and ci.cdcontrato=".$_SESSION[PROJETO]['filtro']['cdcontrato']."                
                order by ci.descricao ");               
     
            $datas['contrato_item_sup'] = $contrato_item_lista;
                        
            
            if ($contrato_item->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/contrato_item/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $contrato_item = new contrato_itemModel();
            $_POST['valor']= str_replace(",", ".", $_POST['valor']);
            $dados=$_POST;
            $atualiza = $contrato_item->atualizacontrato_item($dados, $id );
            
            $this->atualizar_item($id);
            

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/contrato_item/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/contrato_item/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $contrato_item = new contrato_itemModel();          
            
            $atualiza = $contrato_item->excluicontrato_item( 'cdcontrato_item='.$id );
                        
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($contrato_item->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/contrato_item/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $contrato_item = new contrato_itemModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $unidades = new unidadesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdunidade') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_unidades = $unidades->listaunidades("{$par}");

            $datas['unidades'] = $detalhes_unidades;
            $contratos = new contratosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contratos = $contratos->listacontratos("{$par}");

            $datas['contratos'] = $detalhes_contratos;
            if ($contrato_item->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/contrato_item/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $contrato_item = new contrato_itemModel();
            $_POST['valor']= str_replace(",", ".", $_POST['valor']); 
            
            $insere = $contrato_item->inserecontrato_item($_POST, 'cdcontrato_item');
            
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
            header( "Location: /".PROJETO."/contrato_item/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/contrato_item/" );
            }

        }


        public function inserem( Array $dados = null ){
            $contrato_item = new contrato_itemModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['descricao'][0])) {
                $i=0;
                foreach ($dados['descricao'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_contrato_item[$key]=$dados[$key][$i];
                    }
                    $dados_contrato_item['valor']= str_replace(",", ".", $dados_contrato_item['valor']); 
            
                    $insere = $contrato_item->inserecontrato_item($dados_contrato_item,'cdcontrato_item');
                    

                    
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

            header( "Location: /".PROJETO."/contrato_item/" );


        }



        public function inserew(){
            $contrato_item = new contrato_itemModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='contrato_item') {
                    $dados['contrato_item'][$p[1]]=$value;
                }
            }

            $inserep = $contrato_item->inserecontrato_item($dados['contrato_item'], 'cdcontrato_item');
            
                  if ($dados['cdcontrato_item_sup']!='') {
                        $this->atualizar_item($dados['cdcontrato_item_sup']);
                    }
            
            


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/contrato_item/" );
            

        }

        public function pesquisa(){
            $contrato_item = new contrato_itemModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $unidades = new unidadesModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdunidade') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $contratos = new contratosModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato') ) {
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

            $pesquisa = $contrato_item->pesquisacontrato_item($w);
            $datas['contrato_item'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/contrato_item/index', $datas);

    }


}
