
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
<ul class="nav nav-tabs">
<?php foreach ($view_vc as $vc) { ?>
<li<?php echo $vc['tipo']?>><a href="<?php echo $vc['link']?>" data-original-title="<?php echo $vc['nome']?>"><?php echo $vc['atalho']?></a></li>
<?php } ?>
</ul>

<div class="tab-content">
<div class="tab-pane fade active in">

<?php } ?>


                        <div class="row">
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
                                                            <a href="javascript:;">Fase: <?php echo $view_projetos[0]['fase'];?></a>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-external-link"></i>
                                                            <a href="javascript:;">Natureza: <?php echo $view_projetos[0]['natureza'];?></a>
                                                        </li>
                                                         <li>
                                                            <i class="fa fa-globe"></i>
                                                            <a href="javascript:;">Municipio: <?php echo $view_projetos[0]['municipio'];?></a>
                                                        </li>
                                                         <li>
                                                            <i class="fa fa-tasks"></i>
                                                            <a href="javascript:;">Programa: <?php echo $view_projetos[0]['programa'];?></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 text-center">
                                                    <figure>
                                                        <?php 
                                                        $ffoto=$view_projetos[0]['foto'];
                                                        $foto=explode(",",$ffoto);
                                                        $src="http://farm".$foto[3].".static.flickr.com/".$foto[1]."/".$foto[0]."_".$foto[2]."_m.jpg";
                                                        ?>
                                                        <img src="<?php echo $src;?>" >
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
                                                <h2 class="mb0"><b><?php echo number_format($view_indicadores[0]['sum'], 2, ',', '.');?></b></h2> 
                                                <small>R$ Investidos</small>
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                                <h2 class="mb0"><b><?php echo $view_indicadores[1]['sum'];?></b></h2> 
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
                                    <div class="row mb15">
                                        <div class="col-xs-12">
                                            <h6 class="heading-font"><b>Informações Adicionais</b></h6>
                                            Informações adicionais não cadastradas
                                        </div>

                                    </div>
                                    <!--<a href=""><i class="fa fa-map-marker"></i> Ver no mapa </a>-->
                                </div>

                                <!-- /profile information sidebar -->
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
                                    <h4 class="mb0">Andamento</h4>
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
                        <div class="col-md-12" style="max-height: 500px; overflow:auto;">
                            <!-- The time line -->
                            <ul class="timeline">
                                <!-- timeline time label -->
                                <li class="time-label">

                                </li>


                           <!-- timeline item -->
                           <?php 
                        $arrayfotos= array();
                        $arrayitens= array();
                            foreach($view_teste as $vc){
                                foreach ($vc as $v) {
                                  $icone='';
                                  $style='';
                                  $titulo='';
                                  $texto='';

                                    switch($v[tabela]) {
                                        case 'projeto':
                                           $icone= "fa fa-star";
                                           $style = "background: #fff600; color:#fff";
                                           $titulo = '<h3 class="timeline-header no-border"><a href="#">O Projeto</a> foi criado.</h3>';
                                           $texto = "Criado projeto ".$v[intervencao]."<br><b>Obejetivo: </b>".$v[objetivo]."<br><b>Endereço: </b>".$v[endereco];
                                            break;
                                        case 'contrato':
                                           $icone= "fa fa-edit";
                                           $style = "background: #35bd00; color:#fff";
                                           $titulo = '<h3 class="timeline-header no-border"><a href="#">Um contrato</a> foi adicionado ao projeto.</h3>';
                                           $texto = "<b>Numero: </b>".$v[numero]."<br><b>Prazo: </b>".$v[prazo]."<br><b>Valor: </b>".$v[valor]."<br><b>Fornecedor: </b>".$v[razao_social];

                                            break;
                                        case 'contrato_item':
                                           $icone= "fa fa-plus";
                                           $style = "background: #005aff; color:#fff";
                                           $titulo = '<h3 class="timeline-header no-border"><a href="#">Um item</a> foi adicionado ao contrato.</h3>';
                                            $texto = "<b>Descrição: </b>".$v[descricao]."</br><b>Número do Contrato: </b>".$v[contrato]."</br><b>Quantidade: </b>".$v[quantidade]."</br><b>Valor: </b>".$v[valor]."</br>";
                                            break;
                                        case 'Fotos Flickr':
                                          $fotos=array(str_replace(array('{','}'),'',$v[texto]));
                                            $fotos=explode('","',$fotos[0]);
                                            $img='';
                                            for ($i=0;$i<count($fotos);$i++){
                                              $foto=explode(',',str_replace('"','',$fotos[$i]));
                                              $src="http://farm".$foto[3].".static.flickr.com/".$foto[1]."/".$foto[0]."_".$foto[2]."_m.jpg";
                                              $img.="<img title='".$foto[4]."' src='".$src."' alt='' class='img-thumbnail'>";
                                            }
                                            $icone= "fa fa-photo";
                                            $style = "background: #9c343d; color:#fff";
                                            $titulo = '<h3 class="timeline-header no-border"><a href="#">Nova(s) foto(s)</a> adicionada(s) ao projeto.</h3>';
                                            $texto = "<b></b>".$img."&nbsp;";
                                        $arrayfotos='';
                                            break;
                                        default:
                                           $icone="fa fa-user";
                                           $texto="padrão";
                                           $titulo='<h3 class="timeline-header no-border"><a href="#">'.$v['tabela'].'</a> foi adicionada ao projeto</h3>';
                                            break;
                                    }
                                    ?>
                                <li>
                                    <i class="<?php echo $icone;?>" style="<?php echo $style;?>"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i><?php echo $v['datahoras'];?></span>
                                        <?php echo $titulo;?>
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
                                    }       
                                
                                ?>
                            
                                 
                            </ul>
                        </div><!-- /.col -->
                    </div>

                                    </div>
                                </section>

                            </div>
                        </div>
                    </div>
                    <!-- /inner content wrapper -->

<a href="/<?php echo PROJETO;?>/projetos/editar/id/<?php echo $view_projetos[0]['cdprojeto'];?>"  class="btn btn-info btn-sig">
                    Editar</a>
 <?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }  ?> 
<?php
include('app/views/rodape.php');
?>
