
<?php
session_start();
    class perfil_modulos extends Controller{

        public function Index_action(){
            $consultas = new consultasModel();
            $perfil_modulos = new perfil_modulosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));


            $s = 'select m.cdmodulo, m.nome, p.cdperfil, p.visualizar, p.editar, 
                  p.inserir, p.excluir, p.pesquisar, p.inserir_mtp, m.ordem from modulo m 
                  left outer join perfil_modulo p on 
                  m.cdmodulo=p.cdmodulo and p.cdperfil='.$_SESSION[PROJETO]['filtro']['cdperfil'].'
                  where                   
                  m.cdmodulo not in (select cdvinculado from modulo_vinculado) and 
                  m.cdmodulopai is null and m.cdmodulo not in (1) and m.bloqueado is null
                  order by m.ordem, m.cdmodulo
                  ';
            $perfil_modulos_lista = $perfil_modulos->selperfil_modulos($s);
            
            $datas['perfil_modulos'] = $perfil_modulos_lista;
            
            $i=0;
			      foreach ($perfil_modulos_lista as $key => $value) { 
            
            
                  $s2 = 'select m.cdmodulo, m.nome, p.cdperfil, p.visualizar, p.editar, 
                  p.inserir, p.excluir, p.pesquisar, p.inserir_mtp from modulo m 
                  left outer join perfil_modulo p on 
                  m.cdmodulo=p.cdmodulo and p.cdperfil='.$_SESSION[PROJETO]['filtro']['cdperfil'].'
                  where                   
                  m.cdmodulo in (select cdvinculado from modulo_vinculado where cdmodulo='.$value['cdmodulo'].' ) and
                  m.cdmodulo not in (1) and m.bloqueado is null
                  order by m.ordem, m.cdmodulo
                  ';
            
                 $perfil_modulos_lista2 = $perfil_modulos->selperfil_modulos($s2);
                 
                  $s3 = 'select m.cdmodulo, m.nome, p.cdperfil, p.visualizar, p.editar, 
                  p.inserir, p.excluir, p.pesquisar, p.inserir_mtp from modulo m 
                  left outer join perfil_modulo p on 
                  m.cdmodulo=p.cdmodulo and p.cdperfil='.$_SESSION[PROJETO]['filtro']['cdperfil'].'
                  where                   
                  m.cdmodulo not in (select cdvinculado from modulo_vinculado) and
                  m.cdmodulopai='.$value['cdmodulo'].' and m.cdmodulo not in (1) and m.bloqueado is null
                  order by m.ordem, m.cdmodulo
                  ';
            
                 $perfil_modulos_lista3 = $perfil_modulos->selperfil_modulos($s3);   
                 
                 
                $datas['perfil_modulos'][$i]['modulosvinculados']= $perfil_modulos_lista2;            
                $datas['perfil_modulos'][$i]['modulosfilhos']= $perfil_modulos_lista3;
                 
                 
               $i2=0;
 			         foreach ($perfil_modulos_lista3 as $key2 => $value2) { 
            
            
                  $s4 = 'select m.cdmodulo, m.nome, p.cdperfil, p.visualizar, p.editar, 
                  p.inserir, p.excluir, p.pesquisar, p.inserir_mtp from modulo m 
                  left outer join perfil_modulo p on 
                  m.cdmodulo=p.cdmodulo and p.cdperfil='.$_SESSION[PROJETO]['filtro']['cdperfil'].'
                  where                   
                  m.cdmodulo in (select cdvinculado from modulo_vinculado where cdmodulo='.$value2['cdmodulo'].' ) and
                  m.cdmodulo not in (1) and m.bloqueado is null
                  order by m.ordem, m.cdmodulo
                  ';
            
                 $perfil_modulos_lista4 = $perfil_modulos->selperfil_modulos($s4);
                 
                  $s5 = 'select m.cdmodulo, m.nome, p.cdperfil, p.visualizar, p.editar, 
                  p.inserir, p.excluir, p.pesquisar, p.inserir_mtp from modulo m 
                  left outer join perfil_modulo p on 
                  m.cdmodulo=p.cdmodulo and p.cdperfil='.$_SESSION[PROJETO]['filtro']['cdperfil'].'
                  where                   
                  m.cdmodulo not in (select cdvinculado from modulo_vinculado) and
                  m.cdmodulopai='.$value2['cdmodulo'].' and m.cdmodulo not in (1) and m.bloqueado is null
                  order by m.ordem, m.cdmodulo
                  ';
            
                 $perfil_modulos_lista5 = $perfil_modulos->selperfil_modulos($s5);                 
                 
            
                $datas['perfil_modulos'][$i]['modulosfilhos'][$i2]['modulosvinculados']= $perfil_modulos_lista4;            
                $datas['perfil_modulos'][$i]['modulosfilhos'][$i2]['modulosfilhos']= $perfil_modulos_lista5;
                
                









               $i21=0; // filho, filho vinculado
 			         foreach ($perfil_modulos_lista5 as $key21 => $value21) { 
            
            
                  $s21 = 'select m.cdmodulo, m.nome, p.cdperfil, p.visualizar, p.editar, 
                  p.inserir, p.excluir, p.pesquisar, p.inserir_mtp from modulo m 
                  left outer join perfil_modulo p on 
                  m.cdmodulo=p.cdmodulo and p.cdperfil='.$_SESSION[PROJETO]['filtro']['cdperfil'].'
                  where                   
                  m.cdmodulo in (select cdvinculado from modulo_vinculado where cdmodulo='.$value21['cdmodulo'].' ) and
                  m.cdmodulo not in (1) and m.bloqueado is null
                  order by m.ordem, m.cdmodulo
                  ';
            
                 $perfil_modulos_lista21 = $perfil_modulos->selperfil_modulos($s21);
                 
           
                $datas['perfil_modulos'][$i]['modulosfilhos'][$i2]['modulosfilhos'][$i21]['modulosvinculados']= $perfil_modulos_lista21;

                       


               $i21++;				  
               }  
               
                     
               
               $i22=0;
 			         foreach ($perfil_modulos_lista4 as $key22 => $value22) { 
            
            
                  $s22 = 'select m.cdmodulo, m.nome, p.cdperfil, p.visualizar, p.editar, 
                  p.inserir, p.excluir, p.pesquisar, p.inserir_mtp from modulo m 
                  left outer join perfil_modulo p on 
                  m.cdmodulo=p.cdmodulo and p.cdperfil='.$_SESSION[PROJETO]['filtro']['cdperfil'].'
                  where                   
                  m.cdmodulo in (select cdvinculado from modulo_vinculado where cdmodulo='.$value22['cdmodulo'].' ) and
                  m.cdmodulo not in (1) and m.bloqueado is null
                  order by m.ordem, m.cdmodulo
                  ';
            
                 $perfil_modulos_lista22 = $perfil_modulos->selperfil_modulos($s22);
                 
           
                $datas['perfil_modulos'][$i]['modulosfilhos'][$i2]['modulosvinculados'][$i22]['modulosvinculados']= $perfil_modulos_lista22;
                
                
                
                
                // filho, vinculado, vinculado, vinculado
                               $i222=0;
 			         foreach ($perfil_modulos_lista22 as $key222 => $value222) { 
            
            
                  $s222 = 'select m.cdmodulo, m.nome, p.cdperfil, p.visualizar, p.editar, 
                  p.inserir, p.excluir, p.pesquisar, p.inserir_mtp from modulo m 
                  left outer join perfil_modulo p on 
                  m.cdmodulo=p.cdmodulo and p.cdperfil='.$_SESSION[PROJETO]['filtro']['cdperfil'].'
                  where                   
                  m.cdmodulo in (select cdvinculado from modulo_vinculado where cdmodulo='.$value222['cdmodulo'].' ) and
                  m.cdmodulo not in (1) and m.bloqueado is null
                  order by m.ordem, m.cdmodulo
                  ';
            
                 $perfil_modulos_lista222 = $perfil_modulos->selperfil_modulos($s222);
                 
           
                $datas['perfil_modulos'][$i]['modulosfilhos'][$i2]['modulosvinculados'][$i22]['modulosvinculados'][$i222]['modulosvinculados']= $perfil_modulos_lista222;

               $i222++;				  
               } // fim fvvv
                
                
                
                

               $i22++;				  
               }                           
                
                
                
                

               $i2++;				  
               }       
               
               
               
               
               
               
               
                 
                       
                       
                       
                       
                 


            $i++;				  
            } 
            
            $perfil_consulta_lista = $consultas->rsql("SELECT c.cdconsulta, c.titulo, pc.cdperfil FROM consulta c
                    left outer join perfil_consulta pc on c.cdconsulta=pc.cdconsulta and pc.cdperfil=".$_SESSION[PROJETO]['filtro']['cdperfil']."order by c.titulo");

            $datas['perfil_consulta']=$perfil_consulta_lista;
            
            

            if ($perfil_modulos->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/perfil_modulos/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $perfil_modulos = new perfil_modulosModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $perfis = new perfisModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdperfil') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_perfis = $perfis->listaperfis("{$par}");

            $datas['perfis'] = $detalhes_perfis;
            $modulos = new modulosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdteste') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_modulos = $modulos->listamodulos("{$par}");

            $datas['modulos'] = $detalhes_modulos;
            if ($perfil_modulos->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/perfil_modulos/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $perfil_modulos = new perfil_modulosModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $perfis = new perfisModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdperfil') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_perfis = $perfis->listaperfis("{$par}");

            $datas['perfis'] = $detalhes_perfis;
            $modulos = new modulosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdteste') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_modulos = $modulos->listamodulos("{$par}");

            $datas['modulos'] = $detalhes_modulos;
            if ($perfil_modulos->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/perfil_modulos/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $perfil_modulos = new perfil_modulosModel();
            $id = $this->getParam('id');
            $detalhes_perfil_modulos = $perfil_modulos->listaperfil_modulos('cdperfil_modulo='.$id);
            $datas['perfil_modulos'] = $detalhes_perfil_modulos;
            $datas['vc'] = $this->modvinculados(get_class($this),$id);
            $perfis = new perfisModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdperfil') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_perfis = $perfis->listaperfis("{$par}");

            $datas['perfis'] = $detalhes_perfis;
            $modulos = new modulosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdteste') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_modulos = $modulos->listamodulos("{$par}");

            $datas['modulos'] = $detalhes_modulos;
            if ($perfil_modulos->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/perfil_modulos/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $perfil_modulos = new perfil_modulosModel();
            $dados=$_POST;
            $atualiza = $perfil_modulos->atualizaperfil_modulos($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/perfil_modulos/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/perfil_modulos/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $perfil_modulos = new perfil_modulosModel();
            $atualiza = $perfil_modulos->excluiperfil_modulos( 'cdperfil_modulo='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($perfil_modulos->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/perfil_modulos/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $perfil_modulos = new perfil_modulosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $perfis = new perfisModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdperfil') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_perfis = $perfis->listaperfis("{$par}");

            $datas['perfis'] = $detalhes_perfis;
            $modulos = new modulosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdteste') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_modulos = $modulos->listamodulos("{$par}");

            $datas['modulos'] = $detalhes_modulos;
            if ($perfil_modulos->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/perfil_modulos/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }


       public function insere(){
            $perfil_modulos = new perfil_modulosModel();
            $perfil_consulta = new perfil_consultaModel();
            $modulos = new modulosModel();
            $modulos_lista = $modulos->listaModulos();
            $consultas = new consultasModel();
            
            $perm = explode(',',$_POST['perm']);
            
                        
            $pe='';
            $pc='';
            foreach ($perm as $p) {
            if ($p{0}=='c') {
               $pc[]=substr($p, 1);            
            } else {
            $pe[$p]='1';
            }            
            }
            
            $atualiza = $perfil_modulos->excluiperfil_modulos( 'cdperfil='.$_SESSION[PROJETO]['filtro']['cdperfil']);

                foreach ($modulos_lista as $key => $value) {
                
                    $v='';$a='';$i='';$e='';$m='';$p='';
                    $v=$pe['v'.$value['cdmodulo']];
                    $a=$pe['a'.$value['cdmodulo']];
                    $i=$pe['i'.$value['cdmodulo']];
                    $e=$pe['e'.$value['cdmodulo']];
                    $m=$pe['m'.$value['cdmodulo']];
                    $p=$pe['p'.$value['cdmodulo']];

                    if ( ($v!='') or ($a!='') or ($i!='') or ($e!='') or ($m!='') or ($p!='') ) {
                        $dados['cdmodulo']=$value['cdmodulo'];
                        $dados['cdperfil']=$_SESSION[PROJETO]['filtro']['cdperfil'];
                        $dados['visualizar']=$v;
                        $dados['editar']=$a;
                        $dados['inserir']=$i;
                        $dados['excluir']=$e;
                        $dados['inserir_mtp']=$m;
                        $dados['pesquisar']=$p;
                        
                       $insere = $perfil_modulos->insereperfil_modulos($dados,'cdperfil_modulo');
                                         
                 }
                        
                        
                    }


                foreach ($modulos_lista as $key => $value) {
                                        
                        
                  $sp = 'select m.cdmodulopai, p.cdmodulo from modulo m 
                  left outer join perfil_modulo p on 
                  m.cdmodulopai=p.cdmodulo and p.cdperfil='.$_SESSION[PROJETO]['filtro']['cdperfil'].'
                  where                   
                  m.cdmodulo='.$value['cdmodulo'];
            
                 $detalhes_sp = $consultas->rsql($sp);
                 
                 if ( ($detalhes_sp[0]['cdmodulopai']!='') and ($detalhes_sp[0]['cdmodulo']=='') ) {
                        
                        $dados2['cdmodulo']=$detalhes_sp[0]['cdmodulopai'];
                        $dados2['cdperfil']=$_SESSION[PROJETO]['filtro']['cdperfil'];
                        $dados2['visualizar']='1';
                                            
                     $insere2 = $perfil_modulos->insereperfil_modulos($dados2,'cdperfil_modulo');
                     
                 } 
                 
                  // terceiro nivel
                 if ($detalhes_sp[0]['cdmodulopai']!='') {
                 

                  $sp2 = 'select m.cdmodulopai, p.cdmodulo from modulo m 
                  left outer join perfil_modulo p on 
                  m.cdmodulopai=p.cdmodulo and p.cdperfil='.$_SESSION[PROJETO]['filtro']['cdperfil'].'
                  where                   
                  m.cdmodulo='.$detalhes_sp[0]['cdmodulopai'];
            
                 $detalhes_sp2 = $consultas->rsql($sp2);
                 
                 if ( ($detalhes_sp2[0]['cdmodulopai']!='') and ($detalhes_sp2[0]['cdmodulo']=='') ) {
                        
                        $dados3['cdmodulo']=$detalhes_sp2[0]['cdmodulopai'];
                        $dados3['cdperfil']=$_SESSION[PROJETO]['filtro']['cdperfil'];
                        $dados3['visualizar']='1';
                                            
                     $insere3 = $perfil_modulos->insereperfil_modulos($dados3,'cdperfil_modulo');
                     
                 }  
                 
                 
                  // quarto nivel
                 if ($detalhes_sp2[0]['cdmodulopai']!='') {
                 

                  $sp3 = 'select m.cdmodulopai, p.cdmodulo from modulo m 
                  left outer join perfil_modulo p on 
                  m.cdmodulopai=p.cdmodulo and p.cdperfil='.$_SESSION[PROJETO]['filtro']['cdperfil'].'
                  where                   
                  m.cdmodulo='.$detalhes_sp2[0]['cdmodulopai'];
            
                 $detalhes_sp3 = $consultas->rsql($sp3);
                 
                 if ( ($detalhes_sp3[0]['cdmodulopai']!='') and ($detalhes_sp3[0]['cdmodulo']=='') ) {
                        
                        $dados4['cdmodulo']=$detalhes_sp3[0]['cdmodulopai'];
                        $dados4['cdperfil']=$_SESSION[PROJETO]['filtro']['cdperfil'];
                        $dados4['visualizar']='1';
                                            
                     $insere4 = $perfil_modulos->insereperfil_modulos($dados4,'cdperfil_modulo');
                     
                 }                 
                 
                 
                 } // fim quarto nivel                                   
                 
                                
                 
                 
                 } // fim terceiro nivel
                 
                 
                 
              }
                    
                    
              $atualizac = $perfil_consulta->excluiperfil_consulta( 'cdperfil='.$_SESSION[PROJETO]['filtro']['cdperfil']);                    
                    
                    
                    
                foreach ($pc as $pcs) {                

                        $dadosconsulta['cdconsulta']=$pcs;
                        $dadosconsulta['cdperfil']=$_SESSION[PROJETO]['filtro']['cdperfil'];
                        
                       $insere = $perfil_consulta->insereperfil_consulta($dadosconsulta,'cdperfil_consulta');
                        
                    }                    

                





              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';


            header( "Location: /".PROJETO."/perfil_modulos/index/cdperfil/".$_SESSION[PROJETO]['filtro']['cdperfil'] );


        }


        public function inserem( Array $dados = null ){
            $perfil_modulos = new perfil_modulosModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdperfil_modulo'][0])) {
                $i=0;
                foreach ($dados['cdperfil_modulo'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_perfil_modulos[$key]=$dados[$key][$i];
                    }
                    $insere = $perfil_modulos->insereperfil_modulos($dados_perfil_modulos,'cdperfil_modulo');
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

            header( "Location: /".PROJETO."/perfil_modulos/" );


        }

        public function pesquisa(){
            $perfil_modulos = new perfil_modulosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $perfis = new perfisModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdperfil') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $modulos = new modulosModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdteste') ) {
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

            $pesquisa = $perfil_modulos->pesquisaperfil_modulos($w);
            $datas['perfil_modulos'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/perfil_modulos/index', $datas);

    }


}
