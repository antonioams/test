<?php
session_start();
    class principal extends Controller{

function cor() {
$cor = array ( 
 '0' => '#da5b43',
'1' => '#ecd179',
'2' => '#c03442',
'3' => '#542437',
'4' => '#53777b',
'5' => '#69d3e9',
'6' => '#a7dcd9',
'7' => '#e1e5cd',
'8' => '#ef8633',
'9' => '#ec6833',
'10' => '#e94363',
'11' => '#f19d9a',
'12' => '#f8ceae', 
'13' => '#c8c8aa',
'14' => '#84b09c',
'15' => '#d0f19f',
'16' => '#a9dca8',
'17' => '#7abe9b',
'18' => '#3e8787',
'19' => '#17496c',
'20' => '#566371',
'21' => '#c8f464',
'22' => '#eb6769', 
'23' => '#c54d58',
'24' => '#61cdc5',
'25' => '#4a153d',
'26' => '#bf3550',
'27' => '#e98032',
'28' => '#f8cc33',
'29' => '#8b9c14');

 return $cor[array_rand($cor)];
}



public function Index_action(){

		if ($_SESSION[PROJETO]['cdperfil']=='') {
    		$_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
   		    $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Sua sessão foi encerrada, efetue o login novamente.';
    		header( "Location: /".PROJETO."/" );
		}
    
    $_SESSION[PROJETO]['grafico']='';

 		$perfis = new perfisModel();
 		$detalhes_perfis = $perfis->listaperfis("cdperfil=".$_SESSION[PROJETO]['cdperfil']);

 		$inicial_detalhes = new inicial_detalhesModel();
 		$inicial_detalhes_lista = $inicial_detalhes->listainicial_detalhes("cdinicio=".$detalhes_perfis[0]['cdinicio']);

 		$datas['inicial_detalhes'] = $inicial_detalhes_lista;

                    $u=0;
            foreach ($inicial_detalhes_lista as $key => $value) {
            
    if ($datas['inicial_detalhes'][$u]['cdconsulta']!='') {

      $infconsulta = $this->gera_consulta($datas['inicial_detalhes'][$u]['cdconsulta']);
      $datas['inicial_detalhes'][$u]['consulta']= $infconsulta;
    }
                  $u++;
  }
  $rodape2 = '
    </section>

    </div>
    </div>
    </div>
    </div>
    </section>
    </div>
    
    <script>
     window.onload = function(){
     '.$_SESSION[PROJETO]['grafico'].'
     }
     </script>
    <script src="/'.PROJETO.'/inc/plugins/jquery-1.11.1.min.js"></script>
    <script src="/'.PROJETO.'/inc/bootstrap/js/bootstrap.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.slimscroll.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.easing.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/appear/jquery.appear.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.placeholder.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/fastclick.js"></script>
    <script src="/'.PROJETO.'/inc/js/offscreen.js"></script>
    <script src="/'.PROJETO.'/inc/js/main.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/chosen/chosen.jquery.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/'.PROJETO.'/inc/js/bootstrap-datatables.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.sortable.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.nestable.js"></script>
    <script src="/'.PROJETO.'/inc/js/table-edit.js"></script>
    <script src="/'.PROJETO.'/inc/js/script_dm.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/icheck/icheck.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/parsley.min.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/jquery.maskedinput.min.js"></script>
    <script src="/'.PROJETO.'/inc/js/form-masks.js"></script>
    <script src="/'.PROJETO.'/inc/js/general.js"></script>



    <script src="/'.PROJETO.'/inc/plugins/isotope/isotope.pkgd.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/imagesloaded/imagesloaded.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/superbox/superbox.min.js"></script>

    <script src="/'.PROJETO.'/inc/js/gallery.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/dropzone/dropzone.js"></script>

 <!-- page level scripts -->
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.categories.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.stack.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.time.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.orderBars.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.pie.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.sparkline.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.easing.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/easy-pie-chart/jquery.easypiechart.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/raphael.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/morris/morris.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/chartjs/Chart.min.js"></script>
    </body>
<!-- /body -->
</html>';
    
             $datas['rodape']=$rodape2;

            $this->view('/principal/index', $datas);
  }
  
  
  
  
  
  
  function gera_consulta($codconsulta) {
  
  $datas['pagina']='';
 $datas['graficos']='';
 $rodape='';


// aqui 
$id = $codconsulta;

$modulos = new modulosModel();
$moduloscampo = new moduloscamposModel();
$consultas = new consultasModel();
$projetos = new projetosModel();

$detalhes_consultas = $consultas->listaconsultas("cdconsulta=".$id);


$vconsulta = $id;
  
  
    // seleciona as tabelas

  
  $sqltabelas = " select e.entidade as nome, e.cdmodulo from modulo e where cdmodulo in (
           select e.cdmodulo from modulo e, modulo_campo c, saida s
           where e.cdmodulo=c.cdmodulo and c.cdcampo=s.cdcampo and s.cdconsulta=".$vconsulta ."
           union
            select e.cdmodulo from modulo e, modulo_campo c, parametro p 
           where e.cdmodulo=c.cdmodulo and c.cdcampo=p.cdcampo  and p.cdconsulta=".$vconsulta." )"; 

$rstabelas = $consultas->rsql($sqltabelas);
  
    
  $tabela='';
  $relacionamento='';
  $i = 0;
  foreach ($rstabelas as $tabelas ) {
         // adiciona tabelas envolvidas
  if ($i>0) {
        $tabela=$tabela.', '.$tabelas['nome'];
        $lmodulo=$lmodulo.', '.$tabelas['cdmodulo'];
  } else {
        $tabela=' FROM '.$tabelas['nome'];
        $lmodulo=$tabelas['cdmodulo'];
     }
    $i++;
  }



   foreach ($rstabelas as $tabelas ) {
      $refcampos = $moduloscampo->listaModuloscampos('cdmodulo='.$tabelas['cdmodulo'].' and cdmodulo_referencia in ('.$lmodulo.')');

      foreach ($refcampos as $refcampo) {
            if ($relacionamento!='') {$relacionamento.=' and ';}
                $moduloref = $modulos->listaModulos('cdmodulo='.$refcampo['cdmodulo_referencia']);
                $chave = $moduloscampo->pesquisaModuloscampos('cdmodulo='.$refcampo['cdmodulo_referencia'].' and cchave=1');
                $relacionamento.= $tabelas['nome'].'.'.$refcampo['campo'].' = '.$moduloref[0]['entidade'].'.'.$chave[0]['campo'];
      }
   }

  
  
  
  
  
// seleciona as saida 
  
  $sqlsaida = "select e.entidade ||'.'|| c.campo as nome, s.tipo, c.legenda, s.cdsaida, s.chave, s.visualiza, s.rotulo, s.totaliza, e.entidade as tabela, 1 as cod, e.legendaentidade ||'.'|| c.legenda as gdesc from modulo e, modulo_campo c, saida s
           where e.cdmodulo=c.cdmodulo and c.cdcampo=s.cdcampo and s.cdconsulta=".$vconsulta ."  
           union
           select s.questionario ||'.'|| 'informacao' as nome, s.tipo, s.questionario as legenda, s.cdsaida, s.chave, s.visualiza, s.rotulo, s.totaliza, s.questionario as tabela, 2 as cod, s.questionario ||'.'|| 'informacao' as gdesc from saida s
           where  s.cdcampo is null and s.cdconsulta=".$vconsulta ."                        
           order by 4";
           
           

  $rssaidas = $consultas->rsql($sqlsaida);

  //$rc = $rs->RowCount();  
  $saida='';
  $grupo='';
  $ordem='';
  $tab='';
  $agrupar=0;
  $rotulo='';
  $totaliza='';
  $i3=0;
   $i = 0;
  foreach ($rssaidas as $saidas ) {
  
    
if ( $saidas['cod']=='2' ){



      if ($saidas['tabela']{0}=='d') {
      $detalhes_documento = $projetos->rssql("select descricao from documento where cddocumento=".substr($saidas['tabela'],1));
      $saidas['legenda']=$detalhes_documento[0]['descricao'];
      }
      
      if ($saidas['tabela']{0}=='p') {
      $detalhes_pergunta = $projetos->rssql("select descricao from pergunta where cdpergunta=".substr($saidas['tabela'],1));
      $saidas['legenda']=$detalhes_pergunta[0]['descricao'];
      }
      
      
      $pos = strpos($tabela2, $saidas['tabela']);
      if ($pos == false) {      
      if ($tabela2==''){
      $tabela2='vquestionario '.$saidas['tabela'];
      } else {
      $tabela2=$tabela2.', vquestionario '.$saidas['tabela'];
      }
      
      $pos2 = strpos($tabela, 'projeto');
      if ($pos2 == true) {
      if ($relacionamento2==''){
      $relacionamento2=' projeto.cdprojeto = '.$saidas['tabela'].'.cdprojeto '; 
      } else {
      $relacionamento2=$relacionamento2.' and projeto.cdprojeto = '.$saidas['tabela'].'.cdprojeto ';
      }       
      }        
            
      }      
      
      
      $tab3=$saidas['tabela'];
      if ($parametro3=='') {
      $parametro3=$parametro3." ".$saidas['tabela'].".codigo='{$tab3}' ";
      } else {
      $parametro3=$parametro3." and ".$saidas['tabela'].".codigo='{$tab3}' ";
      }
      
      
  
  
  
  }  
  
  
  
  
        $sel=trim($saidas['tipo']);
         if ($sel=='somar') {
         $sel='SUM(';
         $leg='Soma '.$saidas['gdesc'];
         } elseif ($sel=='maior valor') {
         $sel='MAX(';
         $leg='Maior Valor '.$saidas['gdesc'];
         } elseif ($sel=='menor valor') {
         $sel='MIN(';
         $leg='Menor Valor '.$saidas['gdesc'];
         } elseif ($sel=='média') {
         $sel='AVG(';
         $leg='Média '.$saidas['gdesc'];
         } elseif ($sel=='quantificar') {
         $sel='COUNT(';
         $leg='Qtde '.$saidas['gdesc'];
         } else {
         $sel='(';
         $leg=$saidas['gdesc'];
         }
  
  
  if ($saidas['visualiza']=='1') {
   $tab=$tab.'<th>'.$leg.'</th>';
  }
  if ($saidas['rotulo']=='1') {
   $rotulo=$saidas['cdsaida'];
  }
  if ($saidas['totaliza']=='1') {
   $totaliza=$saidas['cdsaida'];
  }

  
  
     if ($i>0) {
        if ($sel!='(') {
        $agrupar=1;
        } else {
         $grupo=$grupo.', '.$saidas['nome'];
         $ordem=$ordem.', '.$saidas['nome']; 
        } 
        $saida=$saida.', '.$sel.$saidas['nome'].') AS '.'"'.$saidas['cdsaida'].'"'; 
     } else {
      if ($sel!='(') {
        $agrupar=1;
        } else {
        $saida=' SELECT '.$saidas['nome'];
        $grupo=' GROUP BY '.$saidas['nome']; 
        $ordem=' ORDER BY '.$saidas['nome'];     
        }
        $saida=' SELECT '.$sel.$saidas['nome'].') AS '.'"'.$saidas['cdsaida'].'"'; 
     }
     
     
  $i++;  
   
           
  } // saidas
  
  

  
  
  
  // seleciona os parametros
  
  $sqlparametros = "select e.entidade ||'.'|| c.campo as nome, p.condicao, c.tipo, p.cdparametro, c.legenda, p.valor from modulo e, modulo_campo c, parametro p 
           where e.cdmodulo=c.cdmodulo and c.cdcampo=p.cdcampo and p.cdconsulta=".$vconsulta ." order by p.cdparametro";               
   $rsparametros = $consultas->rsql($sqlparametros);
   


  $parametro='';
  $i=0;
  $lparametro='';

foreach ($rsparametros as $parametros) {

      $p='p'.$parametros['cdparametro'];
        
       if ($parametros['valor']!='') {
       
           if ($parametros['valor']{0}=='$') {
              $svalor=substr($parametros['valor'], 1);
              $sessao="'{$svalor}'";
              $par = $_SESSION[PROJETO]['{$sessao}'];
           
           } else {
           
            $par = $parametros['valor'];
           
           } 
       
       
       
         
       } else {
        $par = $_POST[$p];
       }
        
        if ($par!='') {
        $condicao=$parametros['condicao'];
        $lparametro.=$parametros['legenda'].' '.$condicao.' '.$par.'<br>';
        if ($condicao=='igual') {
         $condicao='=';
         } elseif ($condicao=='maior') {
         $condicao='>';
         } elseif ($condicao=='menor') {
         $condicao='<';
         } elseif ($condicao=='maior ou igual') {
         $condicao='>=';
         } elseif ($condicao=='menor ou igual') {
         $condicao='<=';
         } elseif ($condicao=='contenha') {
         $condicao='LIKE';
         } elseif ($condicao=='esteja em') {
         $condicao='IN';
         }  elseif ($condicao=='não esteja em') {
         $condicao='NOT IN';
         }


     if ($parametro!='') {
         if (($condicao=='IN') || ($condicao=='NOT IN')) {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par = str_replace( ',', "','", $par);
                $par="'".$par."'";
            }
                $parametro=$parametro." and ".$parametros['nome']." ".$condicao." ( ".$par." ) ";
         } else {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par="'".$par."'";
              if ( $parametros['tipo']=='data' ) {
              $parametro=$parametro." and ".$parametros['nome']." ".$condicao." ".$par." ";
              }  else { 
              $parametro=$parametro." and upper(".$parametros['nome'].") ".$condicao." upper(".$par.") ";
              }
             } else {
                 $parametro=$parametro." and ".$parametros['nome']." ".$condicao." ".$par." ";
            }
         }
     } else {
         if (($condicao=='IN') || ($condicao=='NOT IN')) {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par = str_replace( ',', "','", $par);
                $par="'".$par."'";
            }
                $parametro=$parametro." WHERE ".$parametros['nome']." ".$condicao." ( ".$par." ) ";
         } else {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par="'".$par."'";
              if ( $parametros['tipo']=='data' ) {
                $parametro=$parametro." WHERE ".$parametros['nome']." ".$condicao." ".$par." ";
              } else {
                $parametro=$parametro." WHERE upper(".$parametros['nome'].") ".$condicao." upper(".$par.") ";
              }
             
           } else {
                 $parametro=$parametro." WHERE ".$parametros['nome']." ".$condicao." ".$par." ";
          }
         }
     }
    
    }
     $i++;

  }
  
  


    $sqlparametro2 = "select questionario, condicao from parametro where cdcampo is null and cdconsulta=".$vconsulta ." order by cdparametro";       
    $rsparametros2 = $consultas->rsql($sqlparametro2);   
  
  

  if ($rsparametros2[0]['questionario']!='') {
    
 
  foreach ($rsparametros2 as $parametros2) {
  

  
  $codigo=$parametros2['questionario'];
  if ($parametros2['questionario']{0}=='p') {$v='r';} else {$v=$parametros2['questionario']{0};}  
  $p2=$v.substr($parametros2['questionario'],1);               
  $par2 = $_POST[$p2];
  
          if ($par2!='') {
        $condicao=$parametros2['condicao'];
        //$lparametro.=$parametros2['legenda'].' '.$condicao.' '.$par2.'<br>';
        if ($condicao=='igual') {
         $condicao='=';
         } elseif ($condicao=='maior') {
         $condicao='>';
         } elseif ($condicao=='menor') {
         $condicao='<';
         } elseif ($condicao=='maior ou igual') {
         $condicao='>=';
         } elseif ($condicao=='menor ou igual') {
         $condicao='<=';
         } elseif ($condicao=='contenha') {
         $condicao='LIKE';
         } elseif ($condicao=='esteja em') {
         $condicao='IN';
         }  elseif ($condicao=='não esteja em') {
         $condicao='NOT IN';
         }  
         
         
      $par2="'".$par2."'";
      if ($parametro2=='') {
      $parametro2=$parametro2." ( ".$parametros2[questionario].".codigo='{$codigo}' and upper(".$parametros2[questionario].".informacao) ".$condicao." upper(".$par2.") )";
      } else {
      $parametro2=$parametro2." or ( ".$parametros2[questionario].".codigo='{$codigo}' and upper(".$parametros2[questionario].".informacao) ".$condicao." upper(".$par2.") )";
      }
      
      
      $pos = strpos($tabela2, $parametros2[questionario]);
      if ($pos == false) {      
      if ($tabela2==''){
      $tabela2='vquestionario '.$parametros2[questionario];
      } else {
      $tabela2=$tabela2.', vquestionario '.$parametros2[questionario];
      }
      
      $pos = strpos($tabela, 'projeto');
      if ($pos == true) {
      if ($relacionamento2==''){
      $relacionamento2=' projeto.cdprojeto = '.$parametros2[questionario].'.cdprojeto '; 
      } else {
      $relacionamento2=$relacionamento2.' and projeto.cdprojeto = '.$parametros2[questionario].'.cdprojeto ';
      }       
      }        
            
      }
      

       
        
  }
  }


  
   if ($parametro2!='') {
   
      $parametro2=" ( ".$parametro2." ) ";
      if ($parametro=='') {
        $parametro=' WHERE '.$parametro2;
      } else { 
      $parametro=$parametro.' and '.$parametro2; 
      }
      
 
        
           
  }
  
  
}


  
   
     if ($parametro3!='') {
      if  ($parametro=='') {
        $parametro=' WHERE '.$parametro3;
      } else { 
      $parametro=$parametro.' and '.$parametro3; 
      }
      }  

    if ($relacionamento=='') {
         $relacionamento=$relacionamento2;
       } elseif ($relacionamento2!='') { $relacionamento=$relacionamento.' and '.$relacionamento2; }
 
      
  if ($tabela=='') { $tabela=' FROM '.$tabela2; } elseif ($tabela2!='') { $tabela=$tabela.', '.$tabela2; }
 

  if ($parametro=='') {     
    if ($relacionamento!='') {
    $relacionamento=' WHERE '.$relacionamento;
    }
  } else {
    if ($relacionamento!='') {
  $relacionamento=' and '.$relacionamento;
}}





  $sqlrel=$saida.$tabela.$parametro.' '.$relacionamento;

  if ($agrupar==1) {
   $sqlrel=$sqlrel.$grupo;
  }

   $sqlrel=$sqlrel.$ordem;
 
    //die($sqlrel);
  $rscon = $projetos->rsql($sqlrel);
  
  if ($rscon) {

  $titulo=' 
               <h5><b>'.$detalhes_consultas[0]['titulo'].'</b></h5>
           ';



$tabelav= '<table id="example1" class="table table-striped no-m">
            <thead>
            <tr>'.$tab.'
            </tr>
            </thead>
            <tbody>
            ';

$dadosgrafico1='[';
$dadosgrafico2='{ labels : [';
$dadosgrafico21=', datasets : [ {	fillColor : "rgba(151,187,205,0.5)", strokeColor : "rgba(151,187,205,0.8)", highlightFill : "rgba(151,187,205,0.75)", highlightStroke : "rgba(151,187,205,1)", data : [';
$dadosgrafico3='{ labels : [';
$dadosgrafico31=', datasets : [ {	fillColor : "rgba(151,187,205,0.5)", strokeColor : "rgba(151,187,205,0.8)", highlightFill : "rgba(151,187,205,0.75)", highlightStroke : "rgba(151,187,205,1)", data : [';
$dadosgrafico4='[';
$dadosgrafico6='[';
$i=0;
$dados5='';
  foreach ($rscon as $con ) {

 $tabelav.= ' <tr>';
  $saidas = $consultas->rsql($sqlsaida);

  foreach ($saidas as $saida ) {
      if ($saida['visualiza']=='1') {
        $tabelav.= '     <td>'.$con[$saida['cdsaida']].'</td>';
      }

 if ($detalhes_consultas[0]['grafico']=='1') {

      if ($saida['rotulo']=='1') {
           if ($dadosgrafico1!='[') {$dadosgrafico1.=',';};
           $dadosgrafico1.='{
                              label: "'.$con[$saida['cdsaida']].'",';
      }

      if ($saida['totaliza']=='1') {
           $cor=$this->cor();
           $dadosgrafico1.='   value: '.$con[$saida['cdsaida']].',
                              color: "'.$cor.'",
                              highlight: "'.$cor.'"
                            }';
      }
      
   }
  
  if ($detalhes_consultas[0]['grafico']=='2') {      
       if ($saida['rotulo']=='1') {
           if ($dadosgrafico2!='{ labels : [') {$dadosgrafico2.=',';}; 
           $dadosgrafico2.='"'.$con[$saida['cdsaida']].'"';
      }

      if ($saida['totaliza']=='1') {
       if ($dadosgrafico21!=', datasets : [ {	fillColor : "rgba(151,187,205,0.5)", strokeColor : "rgba(151,187,205,0.8)", highlightFill : "rgba(151,187,205,0.75)", highlightStroke : "rgba(151,187,205,1)", data : [') {$dadosgrafico21.=',';}; 
           $dadosgrafico21.=$con[$saida['cdsaida']];
      }
    }    
    
    		

  if ($detalhes_consultas[0]['grafico']=='3') {      
       if ($saida['rotulo']=='1') {
           if ($dadosgrafico3!='{ labels : [') {$dadosgrafico3.=',';}; 
           $dadosgrafico3.='"'.$con[$saida['cdsaida']].'"';
      }

      if ($saida['totaliza']=='1') {
       if ($dadosgrafico31!=', datasets : [ {	fillColor : "rgba(151,187,205,0.5)", strokeColor : "rgba(151,187,205,0.8)", highlightFill : "rgba(151,187,205,0.75)", highlightStroke : "rgba(151,187,205,1)", data : [') {$dadosgrafico31.=',';}; 
           $dadosgrafico31.=$con[$saida['cdsaida']];
      }
    }

  if ($detalhes_consultas[0]['grafico']=='4') {      
       if ($saida['totaliza']=='1') {

           if ( ($dadosgrafico4!='[') and ($i3==0) ) {$dadosgrafico4.=',';}; 
 
            if ($i3==0) {
              $dadosgrafico4.='[
                                "'.$con[$saida['cdsaida']].'",';
              $i3=1;
            } else {
              $dadosgrafico4.='   '.$con[$saida['cdsaida']].'
                            ]';
              $i3=0;
            }
      }

    }

  if ($detalhes_consultas[0]['grafico']=='5') {

       if ($saida['rotulo']=='1') {
           $dados5[$i]['legenda'] = $con[$saida['cdsaida']];
      }

      if ($saida['totaliza']=='1') {
        $dados5[$i]['valor'] = $con[$saida['cdsaida']];
      }
    }
    
    
    
    
 if ($detalhes_consultas[0]['grafico']=='6') {

      if ($saida['rotulo']=='1') {
           if ($dadosgrafico6!='[') {$dadosgrafico6.=',';};
           $dadosgrafico6.='{
                              label: "'.$con[$saida['cdsaida']].'",';
      }

      if ($saida['totaliza']=='1') {
           $cor=$this->cor();
           $dadosgrafico6.='   value: '.$con[$saida['cdsaida']].',
                              color: "'.$cor.'",
                              highlight: "'.$cor.'"
                            }';
      }
    }    




  }
$tabelav.= ' </tr>';
$i++;
}
$tabelav.=' </table>';
$dadosgrafico1.=']';
$dadosgrafico2.=']'.$dadosgrafico21.'] }	]	}';
$dadosgrafico3.=']'.$dadosgrafico31.'] }	]	}';
$dadosgrafico4.=']';
$dadosgrafico6.=']';
}

//$_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
//$_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong><br>'.$lparametro;
$visualizacao = explode(',', $detalhes_consultas[0]['visualizacao']);
if (in_array('2', $visualizacao)) {
$datas['pagina']=$tabelav;
}

$datas['consultas']=$detalhes_consultas;
$vgrafico = '';


  if ($detalhes_consultas[0]['grafico']=='1') {

     $vgrafico = '
            <div id="canvas-holder" align="center">
			         <canvas id="pizza'.$codconsulta.'" width="300" height="300"/>
		        </div>
            ';
  
     $_SESSION[PROJETO]['grafico'].='     
        var pieData'.$codconsulta.' = '.$dadosgrafico1.';
				var ctx'.$codconsulta.' = document.getElementById("pizza'.$codconsulta.'").getContext("2d");
				window.myPie = new Chart(ctx'.$codconsulta.').Pie(pieData'.$codconsulta.');';     
  }

  if ($detalhes_consultas[0]['grafico']=='2') {

     $vgrafico .= '     
     <div style="width: 95%">
			<canvas id="barra'.$codconsulta.'" style="width: 800px; height: 350px;"></canvas>
		</div>';

  $_SESSION[PROJETO]['grafico'].='   
  	var barChartData'.$codconsulta.' = '.$dadosgrafico2.' 
		var ctx'.$codconsulta.' = document.getElementById("barra'.$codconsulta.'").getContext("2d");
		window.myBar = new Chart(ctx'.$codconsulta.').Bar(barChartData'.$codconsulta.', {
			responsive : true
		});';      
  }

  if ($detalhes_consultas[0]['grafico']=='3') {

     $vgrafico .= '
     
     <div style="width: 95%">
			<canvas id="linha'.$codconsulta.'" style="width: 800px; height: 350px;"></canvas>
		</div>';

  $_SESSION[PROJETO]['grafico'].='   
  	var lineChartData'.$codconsulta.' = '.$dadosgrafico3.' 
		var ctx'.$codconsulta.' = document.getElementById("linha'.$codconsulta.'").getContext("2d");
		window.myLine  = new Chart(ctx'.$codconsulta.').Line(lineChartData'.$codconsulta.', {
			responsive : true
		});';      
  }

    if ($detalhes_consultas[0]['grafico']=='4') {

     $vgrafico .= '


                                <section class="panel">
                                    <header class="panel-heading no-b">
                                        <h5>Quarterly Apple iOS device unit sales</h5>
                                    </header>
                                    <div class="panel-body">
                                        <div id="hero-area'.$codconsulta.'" class="chart"></div>
                                    </div>
                                </section>
                                    ';


  }


    if ($detalhes_consultas[0]['grafico']=='5') {
foreach ($dados5 as $d5) {
     $vgrafico .= '<div class="col-md-4 widget"> 
<div class="col-md-12" style="border:1px solid #f9f7f7; border-left: 5px solid '.$this->cor().'; border-radius: 3px; background:#fff;"><h3>'.$d5['valor'].'</h3><span>'.$d5['legenda'].'</span></div>
</div>
';


}

  }

  

  if ($detalhes_consultas[0]['grafico']=='6') {

     $vgrafico = '
		<style>
			body{
				padding: 0;
				margin: 0;
			}
			#canvas-holder{
				width:30%;
			}
		</style>     
            <div id="canvas-holder" align="center">
			         <canvas id="pizzafacil'.$codconsulta.'" width="300" height="300"/>
		        </div>
            ';
  
     $_SESSION[PROJETO]['grafico'].='     
        var doughnutData'.$codconsulta.' = '.$dadosgrafico6.';
				var ctx'.$codconsulta.' = document.getElementById("pizzafacil'.$codconsulta.'").getContext("2d");
				window.myDoughnut = new Chart(ctx'.$codconsulta.').Doughnut(doughnutData'.$codconsulta.');';     
  }

            
  


if (in_array('1', $visualizacao)) {
  $datas['graficos']=$vgrafico;
}


  $infconsulta= $titulo.$datas['pagina']. $datas['graficos'];


   return $infconsulta; 
   //fim aqui

  }

  } 
