
<?php
session_start();
    class saidas extends Controller{

        public function Index_action(){
            $consultas = new consultasModel();
            $projetos = new projetosModel();
            $saidas = new saidasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $saidas_lista = $saidas->listasaidas("{$par}");

            $datas['saidas'] = $saidas_lista;
            $i=0;
            foreach ($saidas_lista as $key => $value) {
                if ($datas['saidas'][$i]['cdcampo']!='') {
                   $detalhes_campos = $consultas->rsql(" select e.legendaentidade, c.legenda as legendacampo
                                                  from modulo e, modulo_campo c 
                                                  where
                                                  e.cdmodulo=c.cdmodulo and e.entidade is not null
                                                  and c.cdcampo= ".$datas['saidas'][$i]['cdcampo']);
                  $datas['saidas'][$i]['legendacampo']= $detalhes_campos[0]['legendaentidade'].' - '.$detalhes_campos[0]['legendacampo'];
                  
                } elseif ($datas['saidas'][$i]['questionario']{0}=='d'){
                
                  $detalhes_documento = $projetos->rsql(" select d.cddocumento, gd.descricao as grupo_documento, d.descricao as documento
                  from grupodocumento gd, documento d
                  where 
                  gd.cdgrupodocumento=d.cdgrupodocumento and d.cddocumento=".substr($datas['saidas'][$i]['questionario'],1)."
                  order by gd.cdgrupodocumento, d.cddocumento");
            
                  $datas['saidas'][$i]['legendacampo']= $detalhes_documento[0]['grupo_documento'].' - '.$detalhes_documento[0]['documento'];
                  
               } elseif ($datas['saidas'][$i]['questionario']{0}=='p'){
               
                  $detalhes_questionario = $projetos->rsql(" select d.cdpergunta, gd.descricao as grupo_pergunta, d.descricao as pergunta
                  from grupopergunta gd, pergunta d
                  where 
                  gd.cdgrupopergunta=d.cdgrupopergunta and d.cdpergunta=".substr($datas['saidas'][$i]['questionario'],1));
                  
                  $datas['saidas'][$i]['legendacampo']= $detalhes_questionario[0]['grupo_pergunta'].' - '.$detalhes_questionario[0]['pergunta'];
                  
              }
                  $i++;
             }


            if ($saidas->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                
                $this->view('/saidas/index', $datas);
                
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $saidas = new saidasModel();
           $projetos = new projetosModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $consultas = new consultasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdconsulta') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_consultas = $consultas->listaconsultas("{$par}");

            $datas['consultas'] = $detalhes_consultas;
            $detalhes_campos = $consultas->rsql(" select e.cdmodulo, e.entidade, e.legendaentidade, 
                                                  c.cdcampo, c.campo, c.legenda as legendacampo
                                                  from modulo e, modulo_campo c 
                                                  where
                                                  e.cdmodulo=c.cdmodulo and e.entidade is not null
                                                  order by e.legendaentidade, c.legenda ");

             $detalhes_documento = $projetos->rsql(" select d.cddocumento, gd.descricao as grupo_documento, d.descricao as documento
            from grupodocumento gd, documento d
            where 
            gd.cdgrupodocumento=d.cdgrupodocumento
            order by gd.cdgrupodocumento, d.cddocumento");
            
            foreach ($detalhes_documento as $documento) {
            
               $doc['cdcampo']='d'.$documento['cddocumento'];
               $doc['legendaentidade']=$documento['grupo_documento'];
               $doc['legendacampo']=$documento['documento'];
               
               $detalhes_campos[] = $doc;
            	
            }
            
            $detalhes_questionario = $projetos->rsql(" select d.cdpergunta, gd.descricao as grupo_pergunta, d.descricao as pergunta
            from grupopergunta gd, pergunta d
            where 
            gd.cdgrupopergunta=d.cdgrupopergunta ");
            
            foreach ($detalhes_questionario as $questionario) {
            
               $quest['cdcampo']='p'.$questionario['cdpergunta'];
               $quest['legendaentidade']=$questionario['grupo_pergunta'];
               $quest['legendacampo']=$questionario['pergunta'];
               
               $detalhes_campos[] = $quest;
            	
            }                                                            
            
            $datas['campos'] = $detalhes_campos;

            $datas['usuarios'] = $detalhes_usuarios;
            if ($saidas->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/saidas/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $saidas = new saidasModel();
            $projetos = new projetosModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $consultas = new consultasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdconsulta') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_consultas = $consultas->listaconsultas("{$par}");

            $datas['consultas'] = $detalhes_consultas;
            $detalhes_campos = $consultas->rsql(" select e.cdmodulo, e.entidade, e.legendaentidade, 
                                                  c.cdcampo, c.campo, c.legenda as legendacampo
                                                  from modulo e, modulo_campo c 
                                                  where
                                                  e.cdmodulo=c.cdmodulo and e.entidade is not null
                                                  order by e.legendaentidade, c.legenda ");
            
             $detalhes_documento = $projetos->rsql(" select d.cddocumento, gd.descricao as grupo_documento, d.descricao as documento
            from grupodocumento gd, documento d
            where 
            gd.cdgrupodocumento=d.cdgrupodocumento
            order by gd.cdgrupodocumento, d.cddocumento");
            
            foreach ($detalhes_documento as $documento) {
            
               $doc['cdcampo']='d'.$documento['cddocumento'];
               $doc['legendaentidade']=$documento['grupo_documento'];
               $doc['legendacampo']=$documento['documento'];
               
               $detalhes_campos[] = $doc;
            	
            }
            
            $detalhes_questionario = $projetos->rsql(" select d.cdpergunta, gd.descricao as grupo_pergunta, d.descricao as pergunta
            from grupopergunta gd, pergunta d
            where 
            gd.cdgrupopergunta=d.cdgrupopergunta ");
            
            foreach ($detalhes_questionario as $questionario) {
            
               $quest['cdcampo']='p'.$questionario['cdpergunta'];
               $quest['legendaentidade']=$questionario['grupo_pergunta'];
               $quest['legendacampo']=$questionario['pergunta'];
               
               $detalhes_campos[] = $quest;
            	
            } 
                                                                          
            $datas['campos'] = $detalhes_campos;
            $datas['usuarios'] = $detalhes_usuarios;
            if ($saidas->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/saidas/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $saidas = new saidasModel();
            $projetos = new projetosModel();
            $id = $this->getParam('id');
            $detalhes_saidas = $saidas->listasaidas('cdsaida='.$id);
            $datas['saidas'] = $detalhes_saidas;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['saidas'][0]['cdcampo'] );
            $consultas = new consultasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdconsulta') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_consultas = $consultas->listaconsultas("{$par}");

            $datas['consultas'] = $detalhes_consultas;
            $detalhes_campos = $consultas->rsql(" select e.cdmodulo, e.entidade, e.legendaentidade, 
                                                  c.cdcampo, c.campo, c.legenda as legendacampo
                                                  from modulo e, modulo_campo c 
                                                  where
                                                  e.cdmodulo=c.cdmodulo and e.entidade is not null
                                                  order by e.legendaentidade, c.legenda  ");


             $detalhes_documento = $projetos->rsql(" select d.cddocumento, gd.descricao as grupo_documento, d.descricao as documento
            from grupodocumento gd, documento d
            where 
            gd.cdgrupodocumento=d.cdgrupodocumento
            order by gd.cdgrupodocumento, d.cddocumento");
            
            foreach ($detalhes_documento as $documento) {
            
               $doc['cdcampo']='d'.$documento['cddocumento'];
               $doc['legendaentidade']=$documento['grupo_documento'];
               $doc['legendacampo']=$documento['documento'];
               
               $detalhes_campos[] = $doc;
            	
            }
            
            $detalhes_questionario = $projetos->rsql(" select d.cdpergunta, gd.descricao as grupo_pergunta, d.descricao as pergunta
            from grupopergunta gd, pergunta d
            where 
            gd.cdgrupopergunta=d.cdgrupopergunta ");
            
            foreach ($detalhes_questionario as $questionario) {
            
               $quest['cdcampo']='p'.$questionario['cdpergunta'];
               $quest['legendaentidade']=$questionario['grupo_pergunta'];
               $quest['legendacampo']=$questionario['pergunta'];
               
               $detalhes_campos[] = $quest;
            	
            }                                                               
            
            $datas['campos'] = $detalhes_campos;
            $datas['usuarios'] = $detalhes_usuarios;
            if ($saidas->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/saidas/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $saidas = new saidasModel();
            if ( ($_POST['cdcampo']{0}=='d') or ($_POST['cdcampo']{0}=='p') ) {            
                  $_POST['questionario']=$_POST['cdcampo'];
                  $_POST['cdcampo']='';                                              
            }            
            $dados=$_POST;
            $atualiza = $saidas->atualizasaidas($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/saidas/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/saidas/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $saidas = new saidasModel();
            $atualiza = $saidas->excluisaidas( 'cdsaida='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($saidas->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/saidas/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $saidas = new saidasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $consultas = new consultasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdconsulta') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_consultas = $consultas->listaconsultas("{$par}");

            $datas['consultas'] = $detalhes_consultas;
            $usuarios = new usuariosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdusuario') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_usuarios = $usuarios->listausuarios("{$par}");

            $datas['usuarios'] = $detalhes_usuarios;
            if ($saidas->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/saidas/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $saidas = new saidasModel();
            
            if ( ($_POST['cdcampo']{0}=='d') or ($_POST['cdcampo']{0}=='p') ) {            
                  $_POST['questionario']=$_POST['cdcampo'];
                  $_POST['cdcampo']='';                                              
            }
                        
            $insere = $saidas->inseresaidas($_POST, 'cdsaida');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/saidas/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/saidas/" );
            }

        }


        public function inserem( Array $dados = null ){
            $saidas = new saidasModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdsaida'][0])) {
                $i=0;
                foreach ($dados['cdsaida'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_saidas[$key]=$dados[$key][$i];
                    }
                    $insere = $saidas->inseresaidas($dados_saidas,'cdsaida');
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

            header( "Location: /".PROJETO."/saidas/" );


        }

        public function pesquisa(){
            $saidas = new saidasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $consultas = new consultasModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdconsulta') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $usuarios = new usuariosModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdusuario') ) {
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

            $pesquisa = $saidas->pesquisasaidas($w);
            $datas['saidas'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/saidas/index', $datas);

    }


}
