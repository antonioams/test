
<?php
include('app/views/topop.php');
?>
               <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/mapas/css/jquery.kyco.easyshare.css">
<div id="tudo">
<div class="col-lg-12">
                        <div class="">
                            <div class="col-md-4">
                                <!-- profile information sidebar -->

                                <div class="panel bordered overflow-hidden no-b profile p15">



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
                                                            <a href="javascript:;">Natureza: <?php echo $view_projetos[0]['situacao'];?></a>
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
                                                        $ffoto=$view_fotoexibe[0]['texto'];
                                                        $foto=explode(",",$ffoto);
                                                        if($foto[3] != ''){
                                                        $src="http://farm".$foto[3].".static.flickr.com/".$foto[1]."/".$foto[0]."_".$foto[2]."_m.jpg";
                                                    } else{
                                                        $src="/".PROJETO."/inc/img/semfoto.jpg";
                                                    }
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
                                                <h2 class="mb0"><b><?php 
                                                $quanto = $view_indicadores[0]['sum']/1000;
                                                if($quanto<1){
                                                    echo number_format($view_indicadores[0]['sum'], 2, ',', '.');
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
                                                <h2 class="mb0"><b><?php if($view_indicadores[1]['sum']==''){echo "0";}else{echo $view_indicadores[1]['sum'];}?></b></h2> 
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

                                <!-- /profile information sidebar -->
                            </div>
                            <div class="col-md-4 mb25">



<section class="panel bordered  post-comments">


                                    <div class="media p15">
                                    <h4 class="mb0">Contrato</h4>
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
                                                    <small class="pull-right"><?php echo "Execução Itens Contratados "; ?></small>
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




                            </div>


                            <div class="col-md-4 mb25">



<section class="panel bordered  post-comments">


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



                                </section>




                            </div>
            <div class="col-md-8 mb25 h-md-1">
                <section class="panel bordered  post-comments">
                    <div class="media p15">
                        <h4 class="mb0">Fotos</h4>
                            <small></small>
                                <div class="panel-body" style="max-height: 300px; overflow: auto;">
                                                    <!-- content wrapper -->



                        <!-- SuperBox
                        <div class="superbox" style="overflow: auto">
                            <?php 
                            //print_r($view_galeria);
                            foreach ($view_historico as $fotos) {
                                $foto=explode(',',$fotos['texto']);
                                $img='';
                                $src="http://farm".$foto['farm'].".static.flickr.com/".$foto['server']."/".$foto['id']."_".$foto['secret']."_m.jpg";  
                                $src2 = "http://farm".$foto[3].".static.flickr.com/".$foto[1]."/".$foto[0]."_".$foto[2]."_z.jpg";  
                            ?>
                            <div class="superbox-list">
                                <img src="<?php echo $src;?>" data-img="<?php echo $src2;?>" data-text="" alt="" class="superbox-img">
                                <div class="gallery-description">
                                    <span class="title"><strong><?php echo $fotos["intervencao"];?></strong></span>
                                    <small class="sub-title"><?php echo $fotos["datahora"];?></small>
                                </div>
                            </div>
                            <?php
                             }
                            ?>
                            <div class="superbox-float" style="overflow: auto"></div>
                        </div> -->
                        <div class="gallery-loader hide">
                            <div class="loader"></div>
                        </div>

                        <!-- SuperBox -->
                        <div style="display: block;" class="superbox">
  
                        <?php 
                        if ($view_historico!=''){
                        if ($_SESSION[PROJETO]['m_flickr_chave']!='') {
                              require_once("phpFlickr.php");
                              $f = new phpFlickr($_SESSION[PROJETO]['m_flickr_chave'],$_SESSION[PROJETO]['m_flickr_sec']); 
                            }

                         $fotos = $f->photosets_getPhotos($view_historico);   
                                            foreach($fotos['photoset']['photo'] as $foto){

                                                $infofoto=$f->photos_getInfo($foto[id]);


                                                $src= "http://farm".$infofoto['photo']['farm'].".static.flickr.com/".$infofoto['photo']['server']."/".$infofoto['photo']['id']."_".$infofoto['photo']['secret']."_m.jpg";  
                                                $src2 ="http://farm".$infofoto['photo']['farm'].".static.flickr.com/".$infofoto['photo']['server']."/".$infofoto['photo']['id']."_".$infofoto['photo']['secret']."_z.jpg";
                                                
                          ?>
                            <div class="superbox-list" style="width: 229px; float: left;">
                                <img src="<?php echo $src;?>" data-img="<?php echo $src2;?>" data-text="" alt="" class="superbox-img">
                                <div class="gallery-description">
                                    <span class="title"><strong><?php echo $fotos["intervencao"];?></strong></span>
                                    <small class="sub-title"><?php echo $fotos["datahora"];?></small>
                                </div>
                            </div>
                            <?php
                                              }
                                              //print_r($arfotos); die();
                              }


                              ?>
                            <div class="superbox-float" style="overflow: auto"></div>
                        </div>
                        <!-- /SuperBox -->

                    <!-- /inner content wrapper -->

                </div>
                                <a class="exit-offscreen"></a>
           
                                    
                                    </div>



                                </section>




                            </div>

                            
                        </div>
                        <div class="col-lg-12">
        <div data-easyshare data-easyshare-url="http://200.98.201.124/<?php echo PROJETO?>/mapas/index/id/orbita/p/<?php echo $view_projetos[0][cdprojeto]?>" style="float:left;">
        <!-- Total 
        <button data-easyshare-button="total">
            <span>Total</span>
        </button>
        <span data-easyshare-total-count>0</span>
-->
        <!-- Facebook -->
        <button data-easyshare-button="facebook">
            <span class="fa fa-facebook"></span>
            <span>Compartilhar</span>
        </button>
        <span data-easyshare-button-count="facebook">0</span> 

         <!--Twitter -->
        <button data-easyshare-button="twitter" data-easyshare-tweet-text="">
            <span class="fa fa-twitter"></span>
            <span>Tweet</span>
        </button>
        <span data-easyshare-button-count="twitter">0</span>

        <!-- Google+ -->
        <button data-easyshare-button="google">
            <span class="fa fa-google-plus"></span>
            <span>+1</span>
        </button><!---->
         <span data-easyshare-button-count="google">0</span>

        <div data-easyshare-loader>Carregando...</div>
    </div>



            <script src="/<?php echo PROJETO;?>/inc/mapas/js/jquery-1.11.2.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/mapas/js/jquery.kyco.easyshare.js"></script>
                    </div></div>
                    <!-- /inner content wrapper -->
<?php
include('app/views/rodape.php');
?>
    <!-- page level scripts -->
    <script src="/<?php echo PROJETO;?>/inc/plugins/isotope/isotope.pkgd.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/imagesloaded/imagesloaded.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/superbox/superbox.js"></script>
    <!-- /page level scripts -->
        <script src="/<?php echo PROJETO;?>/inc/js/gallery.js"></script>
