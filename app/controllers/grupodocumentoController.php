
<?php
session_start();
    class grupodocumento extends Controller{

        public function Index_action(){
            $grupodocumento = new grupodocumentoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $grupodocumento_lista = $grupodocumento->listagrupodocumento("{$par}");

            $datas['grupodocumento'] = $grupodocumento_lista;

            if ($grupodocumento->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/grupodocumento/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $grupodocumento = new grupodocumentoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $fases = new fasesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfase') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_fases = $fases->listafases("{$par}");

            $datas['fases'] = $detalhes_fases;
			
			$tipos = new tiposModel();
            $tipos_lista = $tipos->listatipos();
            $datas['tipos'] = $tipos_lista;
			
            if ($grupodocumento->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/grupodocumento/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }




    public function inserej(){
            $fases = new fasesModel();
            $grupodocumento = new grupodocumentoModel();
            $documentos = new documentosModel();
            $campos = new camposModel();
            foreach ($_POST as $key => $value) {
                      if (($key!='submit') and ($key!='campo1')) {
                        $dados_fases[$key]=$_POST[$key];
                    }
                    }
            $dados_fases['cdfase']=$_SESSION[PROJETO]['filtro']['cdfase'];
            $inseregrupo = $grupodocumento->inseregrupodocumento($dados_fases, 'cdgrupodocumento');

            $ee = $_POST['campo1'];
            $ee =json_decode($ee,true);
            //print_r($ee['fields']);die();
            $e = $ee['fields'];

     $o=1;
    foreach ($e as $key) {
        $dados_documento['cdgrupodocumento']=$inseregrupo;
        $dados_documento['descricao']=$key['label'];
        if ($key['required']==true) {
            $dados_documento['obrigatorio']=1;
        } else { $dados_documento['obrigatorio'] ='';}
        $dados_documento['tipo']=$key['field_type'];
        $dados_documento['ordem']=$o;        
        $inseredocumento = $documentos->inseredocumentos($dados_documento, 'cddocumento');
        foreach ($key['field_options'] as $key2) {
                if (is_array($key2)) {
                    // Insere multiplo
                    foreach ($key2 as $opcao) {
                      
                      $resp =  $opcao['label'];
                      $dados_campo['cddocumento']=$inseredocumento;
                      $dados_campo['descricao']=$resp;
                      $inserer = $campos->inserecampos($dados_campo, 'cdcampo');
                    }
                } else {
                    $dados_campo['cddocumento']=$inseredocumento;
                    $dados_campo['descricao']=$key['label'];
                    $inserer = $campos->inserecampos($dados_campo, 'cdcampo');
                }
        }  
        $o++;
    } 

                if ($grupodocumento->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
            header( "Location: /".PROJETO."/grupodocumento/" );
            }


        }


  public function atualizaj(){
            $id = $this->getParam('id');
            $fases = new fasesModel();
            $grupodocumento = new grupodocumentoModel();
            $documentos = new documentosModel();
            $campos = new camposModel();
            
            $documento_valor = new documento_valorModel();
            
            if (empty($_POST['ativo'])) {$_POST['ativo']='';}
            
            foreach ($_POST as $key => $value) {
                      if (($key!='submit') and ($key!='campo1')) {
                        $dados_fases[$key]=$_POST[$key];
                    }
                    }
                    

            $atualiza = $grupodocumento->atualizagrupodocumento($dados_fases, $id );
            $inseregrupo = $id;

            $ee = $_POST['campo1'];
            $ee =json_decode($ee,true);
            //print_r($ee);die();
            $e = $ee['fields'];
            $p='0';
            $r='0';

    $o=1;
    foreach ($e as $key) {
        $dados_documento['cdgrupodocumento']=$inseregrupo;
        $dados_documento['descricao']=$key['label'];
        if ($key['required']==true) {
            $dados_documento['obrigatorio']=1;
        } else { $dados_documento['obrigatorio'] ='';}
        $dados_documento['tipo']=$key['field_type'];
        $dados_documento['ordem']=$o;
        if ($key['id']!='') {        
        $atualizadocumento = $documentos->atualizadocumentos($dados_documento, $key['id']);
        $p=$p.','.$key['id'];
        $inseredocumento=$key['id'];
        } else {
        $inseredocumento = $documentos->inseredocumentos($dados_documento, 'cddocumento');
        $p=$p.','.$inseredocumento;
        }
        foreach ($key['field_options'] as $key2) {
                if (is_array($key2)) {
                    // Insere multiplo
                    foreach ($key2 as $opcao) {                    
                      $resp =  $opcao['label'];
                      $dados_campo['cddocumento']=$inseredocumento;
                      $dados_campo['descricao']=$resp;
                      if ($opcao['id2']!='') {
                        $atualizar = $campos->atualizacampos($dados_campo, $opcao['id2']);
                        $r=$r.','.$opcao['id2'];                      
                      } else {
                        $inserer = $campos->inserecampos($dados_campo, 'cdcampo');
                        $r=$r.','.$inserer; 
                      }
                    }
                } else {
                    $dados_campo['cddocumento']=$inseredocumento;
                    $dados_campo['descricao']=$key['label'];
                    if ($key['field_options']['id2']!='') {
                      $atualizar = $campos->atualizacampos($dados_campo, $key['field_options']['id2']); 
                      $r=$r.','.$key['field_options']['id2'];                     
                    } else {
                      $inserer = $campos->inserecampos($dados_campo, 'cdcampo');
                      $r=$r.','.$inserer; 
                    }
                }
        }
        $o++;
    }


    $ecampos = $campos->excluicampos( 'cddocumento in ( select cddocumento from documento where cdgrupodocumento='.$id.') and cdcampo not in ('.$r.')' );
            $ecampos = $campos->excluicampos( 'cddocumento in ( select cddocumento from documento where cdgrupodocumento='.$id.') and cdcampo not in ('.$r.')' );
            $edocumentos = $documentos->excluidocumentos( 'cdgrupodocumento='.$id.' and cddocumento not in ('.$p.')' );
            
            if ($grupodocumento->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
            header( "Location: /".PROJETO."/grupodocumento/" );
            }


        }


        public function novom(){
            $grupodocumento = new grupodocumentoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $fases = new fasesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfase') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_fases = $fases->listafases("{$par}");

            $datas['fases'] = $detalhes_fases;
            if ($grupodocumento->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/grupodocumento/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $grupodocumento = new grupodocumentoModel();
            $id = $this->getParam('id');
            $detalhes_grupodocumento = $grupodocumento->listagrupodocumento('cdgrupodocumento='.$id);
            $datas['grupodocumento'] = $detalhes_grupodocumento;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['grupodocumento'][0]['descricao'] );
            $fases = new fasesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfase') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_fases = $fases->listafases("{$par}");

            $datas['fases'] = $detalhes_fases;
			
			$tipos = new tiposModel();
            $tipos_lista = $tipos->listatipos();
            $datas['tipos'] = $tipos_lista;
            
            $documentos = new documentosModel();
            $campos = new camposModel();
            $detalhes_documentos = $documentos->listadocumentos('cdgrupodocumento='.$id);
            $js='';
            foreach ($detalhes_documentos as $documento) {
                 if ($documento['obrigatorio']=='1') { $ob='true';} else {$ob='false';}
                 if ($js!='') {$js.=',';}
                 $js .= '{"label":"'.$documento['descricao'].'","field_type":"'.$documento['tipo'].'","required":'.$ob.',"field_options":{';
                 $detalhes_campos = $campos->listacampos('cddocumento='.$documento['cddocumento']);                 
                        if ( ($documento['tipo']=='LISTA') or ($documento['tipo']=='LISTA MULTIPLA') ) {
                            $js .= '"options":[';                             
                             $r='';
                             foreach ($detalhes_campos as $campo) {
                                  if ($r!='') {$r.=',';}
                                    $r .= '{"label":"'.$campo['descricao'].'","checked":false, "id2":'.$campo['cdcampo'].'}';
                             }
                             $js .= $r.']},';
                        } elseif ($documento['tipo']=='DATA') {
                            $js .= '}, ';
                        } else {
                            $js .= '"size":"small", "id2":'.$detalhes_campos[0]['cdcampo'].'}, ';
                        }
                 $js .= '"id":"'.$documento['cddocumento'].'"}';

            }
                $datas['js'] = $js;

            
            if ($grupodocumento->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/grupodocumento/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $grupodocumento = new grupodocumentoModel();
            $dados=$_POST;
            $atualiza = $grupodocumento->atualizagrupodocumento($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/grupodocumento/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/grupodocumento/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $grupodocumento = new grupodocumentoModel();
            $documentos = new documentosModel();
            $campos = new camposModel();
            
            $atualiza2 = $campos->excluicampos( 'cdcampo in (select r.cdcampo from campo r, documento p where r.cddocumento=p.cddocumento and p.cdgrupodocumento='.$id.')');
            $atualiza3 = $documentos->excluidocumentos( 'cddocumento in (select cddocumento documento where cdgrupodocumento='.$id.')');
            $atualiza = $grupodocumento->excluigrupodocumento( 'cdgrupodocumento='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($grupodocumento->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/grupodocumento/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $grupodocumento = new grupodocumentoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $fases = new fasesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfase') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_fases = $fases->listafases("{$par}");

            $datas['fases'] = $detalhes_fases;
            if ($grupodocumento->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/grupodocumento/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $grupodocumento = new grupodocumentoModel();
            $insere = $grupodocumento->inseregrupodocumento($_POST, 'cdgrupodocumento');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/grupodocumento/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/grupodocumento/" );
            }

        }


        public function inserem( Array $dados = null ){
            $grupodocumento = new grupodocumentoModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['descricao'][0])) {
                $i=0;
                foreach ($dados['descricao'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_grupodocumento[$key]=$dados[$key][$i];
                    }
                    $insere = $grupodocumento->inseregrupodocumento($dados_grupodocumento,'cdgrupodocumento');
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

            header( "Location: /".PROJETO."/grupodocumento/" );


        }



        public function inserew(){
            $grupodocumento = new grupodocumentoModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='grupodocumento') {
                    $dados['grupodocumento'][$p[1]]=$value;
                }
            }

            $inserep = $grupodocumento->inseregrupodocumento($dados['grupodocumento'], 'cdgrupodocumento');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/grupodocumento/" );
            

        }

        public function pesquisa(){
            $grupodocumento = new grupodocumentoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $fases = new fasesModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfase') ) {
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

            $pesquisa = $grupodocumento->pesquisagrupodocumento($w);
            $datas['grupodocumento'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/grupodocumento/index', $datas);

    }


}
