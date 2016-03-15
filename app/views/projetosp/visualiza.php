
<?php
include('app/views/topo.php');
?>
<div class="<?php echo $_SESSION[PROJETO]['mensagem']['tipo'];?>">
                                <?php
                                echo $_SESSION[PROJETO]['mensagem']['texto'];
                                unset( $_SESSION[PROJETO]['mensagem'] );?>
                            </div>
<div class="col-lg-12">

<?php if (!empty($view_vc[1])) { ?> 
<div class="box-tab">
<div >
<ul class="nav nav-tabs">
<?php foreach ($view_vc as $vc) { ?>
<li<?php echo $vc['tipo']?>><a href="<?php echo $vc['link']?>" data-original-title="<?php echo $vc['nome']?>"><?php echo $vc['atalho']?></a></li>
<?php } ?>
</ul>
</div>

<div class="tab-content">
<div class="tab-pane fade active in">

<?php } ?>


                        <div class="row">
                            <div class='col-md-12'>
                            <div class="col-md-4">
                                <!-- profile information sidebar -->

                                <div class="panel overflow-hidden no-b profile p15">



                                    <div class="row mb25">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8">
                                                    <h4 class="mb0"><?php echo $view_projetos[0]['intervencao'];?> </h4>
                                                    <small><img height="20" width="20"  src="/<?php echo PROJETO;?>/inc/img/area/<?php echo $view_projetos[0]['icone']?>">  <?php echo $view_projetos[0]['area'];?></small>

                                                    <h6 class="mt15 mb15">Tipo: <?php echo $view_projetos[0]['tipo'];?></h6>
                                                    <ul class="user-meta">
                                                        <li>
                                                            <i class="fa fa-rss"></i>
                                                            <a href="javascript:;">Situação: <?php echo $view_projetos[0]['situacao'];?></a>
                                                        </li>
                                                         <li>
                                                            <i class="fa fa-globe"></i>
                                                            <a href="javascript:;">Municipio: <?php echo $view_projetos[0]['municipio'];?></a>
                                                        </li>
                                                         <li>
                                                            <i class="fa fa-tasks"></i>
                                                            <a href="javascript:;">Programa: <?php echo $view_projetos[0]['programa'];?></a>
                                                        </li>
                                                         <li>
                                                            <i class="fa fa-tasks"></i>
                                                            <a href="javascript:;">Natureza: <?php echo $view_projetos[0]['natureza'];?></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 text-center">
                                                    <figure>
                                                        <?php 

                                                       
                                                        if(!empty($view_fotos[0]['texto'])){
                                                        $ffoto=$view_fotos[0]['texto'];

                                                        $foto=explode(",",$ffoto);
                                                        $src="http://farm".$foto[3].".static.flickr.com/".$foto[1]."/".$foto[0]."_".$foto[2]."_m.jpg";
                                                        echo '<img src='."$src".' >';
                                                        }else{
                                                              echo "<img title='sem imagem' src='/".PROJETO."/inc/img/semfoto.jpg' alt='' class='img-thumbnail'>";
                                                        }
                                                        ?>
                                                        
                                                        <div class="small mt10">Andamento</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo ( ($view_andamento[0]['qtd']<=0) ? '0' : (($view_andamento[1]['qtd']/$view_andamento[0]['qtd'])*100) ); ?>" aria-valuemin="0" aria-valuemax="100" 
                                                                style="width: <?php echo ( ($view_andamento[0]['qtd']<=0) ? '0' : (($view_andamento[1]['qtd']/$view_andamento[0]['qtd'])*100) ); ?>%">
                                                            </div>
                                                        </div>
                                                        <small><?php echo ( ($view_andamento[0]['qtd']<=0) ? '0' : round((($view_andamento[1]['qtd']/$view_andamento[0]['qtd'])*100),2) ); ?>%</small>
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                     <div class="col-xs-12 mt25 text-center bt">

                                            <div class="col-xs-12 col-sm-4">
                                                <h2 class="mb0"><b><?php 
                                                $quanto = $view_andamento[1]['valor']/1000;
                                                if($quanto<1){
                                                    echo number_format($view_andamento[1]['valor'], 2, ',', '.');
                                                }
                                                else if($quanto >1 && $quanto<1000){
                                                echo round($quanto)."MIL";
                                            }
                                                else if($quanto >=1000 && $quanto<1000000){
                                                    $quanto = $quanto/1000;
                                                    echo round($quanto)."mi";
                                                } else if($quanto >=1000000 && $quanto<1000000000){
                                                    $quanto = ($quanto/1000)/1000;
                                                     echo round($quanto)."bi";
                                                }
                                                else if($quanto >=1000000000 && $quanto<1000000000000){
                                                    $quanto = (($quanto/1000)/1000)/1000;
                                                     echo round($quanto)."tri";
                                                }
                                                ?>
                                                </b></h2> 
                                                <small>R$ Investidos</small>
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                                <h2 class="mb0"><b><?php 

                                                if(!empty($view_indicadores[1]['sum'])){
                                            echo $view_indicadores[1]['sum'];
                                                }else{
                                                    echo "0";
                                                }
                                                ?></b></h2> 
                                                <small>Medições</small>
                                            </div>
                                            <div class="col-xs-12 col-sm-5">
                                                <h2 class="mb0"><b><?php echo substr($view_projetos[0]['datahora'],0,6).substr($view_projetos[0]['datahora'],8,2);?></b></h2> 
                                                <small>Inicio do Projeto</small>
                                            </div>
                                        </div>
                                    </div>


                                    
                                    <div class="row mb15 bt">
                                        <div class="col-xs-12">
                                            <h6 class="heading-font"><b>Objetivo</b></h6>
                                            <p><?php if($view_projetos[0]['objetivo']==''){ echo "Objetivo não cadastrado";}else{ echo $view_projetos[0]['objetivo'];}?></p>
                                        </div>

                                    </div>
                                    <!--<a href=""><i class="fa fa-map-marker"></i> Ver no mapa </a>-->
                                </div>
								
          
                            <div class="panel overflow-hidden no-b profile p15">        
                             <div class="media p15">
                                    <h4 class="mb0">Fases/Checklist</h4>
                                    <small></small>
                                    <div class="panel-body">
                                        <table class="table table-striped no-m">
                                            <thead>
                                                 <tr>
                                                    <th class="col-md-5 pd-l-lg">
                                                        <span class="pd-l-sm"></span>Fase</th>
                                                    <th class="col-md-2">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
          	             <?php if (!empty($view_fases)) { foreach ($view_fases as $view_fase) {?>
                                 
                                                <tr>
                                                    <td>
                                                        <span class="pd-l-sm"></span><?php echo $view_fase['nome'];?></td>                                                    
                                                    <td>
                                                        <div class="progress progress-sm no-m">
                                                            <div style="width: <?php echo $view_fase['percentual']; ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $view_fase['percentual']; ?>" role="progressbar" class="progress-bar progress-bar-success done">
                                                                <span class="sr-only"></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                             <?php }} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    </div> 
                                </div>
									
									
                                <div class="panel overflow-hidden no-b profile p15">
								<div class="media p15">
                                    <h4 class="mb0">Andamento Projeto</h4>
                                    <small></small>
                                    <div class="panel-body">
                                        <table class="table table-striped no-m">
            
                                            <tbody>
                
                                                <tr>
                                                    <td>
                                <div class="clearfix">
                                                    <span class="pull-left"></span>
                                                    
                                                </div>
                                                    <div class="progress xs">
                                                    <div class="progress-bar progress-bar-warning" style="width: <?php echo $view_check+(($view_peso_contrato*(( ($view_andamento[0]['qtd']<=0) ? '0' : round((($view_andamento[1]['qtd']/$view_andamento[0]['qtd'])*100),2) )))/100); ?>%"></div>
                                                </div><?php echo "Concluidos ";?> (<b><?php echo $view_check+(($view_peso_contrato*(( ($view_andamento[0]['qtd']<=0) ? '0' : round((($view_andamento[1]['qtd']/$view_andamento[0]['qtd'])*100),2) )))/100); ?>%</b>)
                                                    </td>
                                                      </tr>
                                                       
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>	
                                    </div>								
                                <!-- /fim da primeira coluna do lado esquerdo-->
                            </div>
							
							
							
							
							
                            <div class="col-md-4 mb25">

                                <section class="panel bordered  post-comments">


                                    <div class="media p15">
                                    <h4 class="mb0">Contratos</h4>
                                    <small></small>
                                    <div class="panel-body">
                                        <table class="table table-striped no-m">
                                            <thead>
                                                 <tr>
                                                    <th class="col-md-5 pd-l-lg">
                                                        <span class="pd-l-sm"></span>Fornecedor</th>
                                                    <th class="col-md-2">Numero</th>
                                                    <th class="col-md-2">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
          	             <?php if (!empty($view_contratos)) { foreach ($view_contratos as $view_contrato) {?>
                                 
                                                <tr>
                                                    <td>
                                                        <span class="pd-l-sm"></span><?php echo $view_contrato['fornecedor'];?></td>
                                                    <td><a href="/<?php echo PROJETO;?>/contratos/editar/id/<?php echo $view_contrato['cdcontrato'];?>"><?php echo $view_contrato['numero'];?></a></td>
                                                    <td>
                                                        <div class="progress progress-sm no-m">
                                                            <div style="width: <?php echo ( ($view_contrato['qtd1']<=0) ? '0' : (($view_contrato['qtd2']/$view_contrato['qtd1'])*100) ); ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo ( ($view_contrato['qtd1']<=0) ? '0' : (($view_contrato['qtd2']/$view_contrato['qtd1'])*100) ); ?>" role="progressbar" class="progress-bar progress-bar-success done">
                                                                <span class="sr-only"></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                             <?php }} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>



                                </section>



<section class="panel bordered  post-comments">


                                    <div class="media p15">
                                    <h4 class="mb0">Andamento Contrato</h4>
                                    <small></small>
                                    <div class="panel-body">
                                        <table class="table table-striped no-m">
            
                                            <tbody>
                
                                                <tr>
                                                    <td>
                                <div class="clearfix">
                                                    <span class="pull-left"></span>
                                                    <small class="pull-right"><?php echo 'Valor Contratado R$ '.number_format($view_andamento[0]['valor'], 2, ',', '.'); ?></small>
                                                </div>
                                                    <div class="progress xs">
                                                    <div class="progress-bar progress-bar-sucess" style="width: <?php echo ( ($view_andamento[0]['valor']<=0) ? '0' : round((($view_andamento[1]['valor']/$view_andamento[0]['valor'])*100),2) ); ?>%"></div>
                                                </div><?php echo 'Pago R$ '.number_format($view_andamento[1]['valor'], 2, ',', '.'); ?> (<b><?php echo ( ($view_andamento[0]['valor']<=0) ? '0' : round((($view_andamento[1]['valor']/$view_andamento[0]['valor'])*100),2) ); ?>%</b>)
                                                    </td>
                                                      </tr>
                                                                                                        <tr>
                                                    <td>
                                <div class="clearfix">
                                                    <span class="pull-left"></span>
                                                    <small class="pull-right"><?php echo "Itens Contratados "; ?></small>
                                                </div>
                                                    <div class="progress xs">
                                                    <div class="progress-bar progress-bar-warning" style="width: <?php echo ( ($view_andamento[0]['valor']<=0) ? '0' : round((($view_andamento[1]['valor']/$view_andamento[0]['valor'])*100),2) ); ?>%"></div>
                                                    </div><?php echo "Concluidos ";?> (<b><?php echo ( ($view_andamento[0]['qtd']<=0) ? '0' : round((($view_andamento[1]['qtd']/$view_andamento[0]['qtd'])*100),2) ); ?>%</b>)
                                                    </td>
                                                      </tr>
                                                       
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>



                                </section>




                                 <section class="panel bordered  post-comments">


                                    <div class="media p15">
                                    <h4 class="mb0">Ocorrências</h4>
                                    <small></small>
                                    <div class="panel-body">
                                        <table class="table table-striped no-m">
                                            <thead>
                                                 <tr>
                                                    <th class="col-md-5 pd-l-lg">
                                                        <span class="pd-l-sm"></span>Tipo</th>
                                                    <th class="col-md-2">Data</th>
                                                    <th class="col-md-2">Descrição</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                         <?php if (!empty($view_ocorrencias)) { foreach ($view_ocorrencias as $view_ocorrencia) {?>
                                 
                                                <tr>
                                                    <td>
                                                        <span class="pd-l-sm"></span><?php echo $view_ocorrencia['tipo'];?></td>
                                                    <td><?php echo substr($view_ocorrencia['data'],0,10);?></td>
                                                    <td><?php echo $view_ocorrencia['descricao'];?></td>
                                                </tr>
                                                             <?php }} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>



                                </section>

                            </div>

                            <div class="col-md-4">

                                <section class="panel panel-defaul">
                                                                        <div class="media p15">
                                    <h4 class="mb0">Timeline</h4>
                                    <small></small>
     



                            <div class="row">                        
                        <div class="col-md-12" style="max-height: 820px; overflow:auto;">
                            <!-- The time line -->
                            <ul class="timeline">
                                <!-- timeline time label -->
                                <li class="time-label">

                                </li>


                          <!-- timeline item -->
                            <?php 
                            foreach($view_teste as $vc){
                                  $icone='';
                                  $style='';
                                  $titulo='';
                                  $foto = $vc['texto'];
                                  $texto = $vc['texto']."<br/>";
                                  if ($vc[0]['nome']!=''){
                                       $texto .= "<b>Usuário:</b> ".$vc[0]['nome'];
                                  }
                                  $acao = '';

                                    switch ($vc['tipo']) {
                                      case 'I':
                                        $acao =' foi adicionado.</h3>';
                                        break;
                                       case 'A':
                                        $acao =' foi alterado.</h3>';
                                        break;
                                        case 'D':
                                        $acao =' foi deletado.</h3>';
                                        break;
                                      default:
                                       $acao ='';
                                        break;
                                    }

                                    switch($vc[tabela]) {
                                        case 'projeto':
                                           $icone= "fa fa-star";
                                           $style = "background: #fff600; color:#fff";
                                           $titulo = '<h3 class="timeline-header no-border"><a href="#">O Projeto</a>';
                                            break;
                                        case 'contrato':
                                           $icone= "fa fa-edit";
                                           $style = "background: #35bd00; color:#fff";
                                           $titulo = '<h3 class="timeline-header no-border"><a href="#">Um contrato</a>';
                                           $texto = $vc['texto'];
                                            break;
                                        case 'contrato_item':
                                           $icone= "fa fa-plus";
                                           $style = "background: #005aff; color:#fff";
                                           $titulo = '<h3 class="timeline-header no-border"><a href="#">Um item</a>';
                                            break;
                                         case 'youtube':
                                           $icone= "fa fa-youtube-play";
                                           $style = "background: #b31217; color:#fff";
                                           $titulo = '<h3 class="timeline-header no-border"><a href="#">Um video</a>';
                                            break;
                                          case 'texto':
                                           $icone= "fa fa-file-text";
                                           $style = "background: #6cbfff; color:#fff";
                                           $titulo = '<h3 class="timeline-header no-border"><a href="#">Um texto</a>';
                                            break;
                                         case 'link':
                                           $texto = '<img src="'.$foto.'" width="280">';
                                           if ($vc[0]['nome']!=''){
                                                 $texto .= "<br/><b>Usuário:</b> ".$vc[0]['nome'];
                                            }
                                           $icone= "fa fa-photo";
                                           $style = "background: #f8b014; color:#fff";
                                           $titulo = '<h3 class="timeline-header no-border"><a href="#">Uma foto de um link</a>';
                                            break;
                                        case 'Fotos Flickr':
                            
                                            $fotos=explode('","',$vc['texto']);
                                            $img='';
                                            for ($i=0;$i<count($fotos);$i++){
                                              $foto=explode(',',str_replace('"','',$fotos[$i]));
                                              $src="http://farm".$foto[3].".static.flickr.com/".$foto[1]."/".$foto[0]."_".$foto[2]."_m.jpg";
                                              $img.="<img title='".$foto[4]."' src='".$src."' alt='' class='img-thumbnail'>";
                                            }
                                            $icone= "fa fa-flickr";
                                            $style = "background: #ff0085; color:#fff";
                                            $titulo = '<h3 class="timeline-header no-border"><a href="#">Nova(s) foto(s)</a>';
                                            $texto = "<b></b>".$img."&nbsp;";
                                        $arrayfotos='';
                                            break;
                                          case 'linka':
                                          // Pegar título de um site com cURL
                                           $site_url = $foto; //URL do site que se quer pegar informações
                                           
                                           $ch = curl_init();
                                           curl_setopt ($ch, CURLOPT_URL, $site_url);
                                           curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
                                          ob_start();
                                           curl_exec($ch); 
                                           curl_close($ch);
                                           $file_contents = ob_get_contents();
                                          ob_end_clean();
                                                 
                                           if (preg_match('/<title>([^<]++)/', $file_contents, $matches) == FALSE)
                                           $erro = "Erro ao resgatar o titulo do site"; // se der algum erro

                                           $texto = "<a href='".$foto."' target='_BLANK'>".htmlentities($matches[1],  ENT_COMPAT,'ISO-8859-1', true)."</a>";
                                           if ($vc[0]['nome']!=''){
                                                 $texto .= "<br/><b>Usuário:</b> ".$vc[0]['nome'];
                                            }
                                           $icone= "fa fa-link";
                                           $style = "background: #006198; color:#fff";
                                           $titulo = '<h3 class="timeline-header no-border"><a href="#">Um link</a>';

                                            break;
                                        default:
                                           $icone="fa fa-user";
                                           $titulo='<h3 class="timeline-header no-border"><a href="#">'.$vc['tabela'].'</a>';
                                            break;
                                    }
                                    ?>
                                <li>
                                    <i class="<?php echo $icone;?>" style="<?php echo $style;?>"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i><?php echo $vc['datahora'];?></span>
                                        <?php echo $titulo.$acao;?>
                                        <div class="timeline-body">
                                            <?php echo $texto ?>
                                        </div>
                                       <?php /* <div class='timeline-footer'>
                                            <a class="btn btn-primary btn-xs">Visualizar</a>
                                        </div>*/?>
                                    </div>
                                </li>
                                <?php

                                  }      
                                
                                ?>
                                 
                            </ul>
                        </div><!-- /.col -->
                    </div>

                                    </div>
                                </section>

                            </div>
                        </div>
                    </div></div>
                    <!-- /inner content wrapper -->
<div class="col-md-12  p15">
<a href="/<?php echo PROJETO;?>/projetos/editar/id/<?php echo $view_projetos[0]['cdprojeto'];?>"  class="btn btn-primary btn-sig">
                    Editar</a>
                </div>
 <?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }  ?> 
<?php
include('app/views/rodape.php');
?>
