
<?php
include('app/views/topo.php');
            if ($_SESSION[PROJETO]['flickr_chave']!='') {
                require_once("phpFlickr.php");
                $f = new phpFlickr($_SESSION[PROJETO]['flickr_chave'],$_SESSION[PROJETO]['flickr_sec']); 
            }


?>
<div class="<?php echo $_SESSION[PROJETO]['mensagem']['tipo'];?>">
                                <?php
                                echo $_SESSION[PROJETO]['mensagem']['texto'];
                                unset( $_SESSION[PROJETO]['mensagem'] );?>
                            </div>

<div class="box-tab">
<ul class="nav nav-tabs"> 

<li><a href="<?php echo $vc['link']?>" data-original-title=""></a></li>
</ul>

<div class="tab-content">
<div class="tab-pane fade active in">





<div class="col-lg-12">
<section class="panel panel-default">

   <header class="panel-heading">
      Informações TimeLine (Cronológica)
   </header>


                        <div class="row">                        
                        <div class="col-md-12">
                            <!-- The time line -->
                            <ul class="timeline">
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-red">
                                    </span>
                                </li>


                           <!-- timeline item -->
                           <?php 
                        $arrayfotos= array();
                        $arrayitens= array();
                            foreach($view_teste as $vc){
                                foreach ($vc as $v) {
                                    switch ($v[tabela]) {

                                        case 'projeto':

                                           $icone= "fa fa-star";
                                           $style = "background: #fff600; color:#fff";
                                           $titulo = '  <h3 class="timeline-header no-border"><a href="#">O Projeto</a> foi criado.</h3>';
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
                                            $fotos[]=$f->photos_getAllContexts($v[descricao]);
                                            $icone= "fa fa-photo";
                                            $style = "background: #9c343d; color:#fff";
                                            $titulo = '<h3 class="timeline-header no-border"><a href="#">Nova(s) foto(s)</a> adicionada(s) ao projeto.</h3>';
                                            $texto = "<b>Descrição: </b>".$v[descricao]."/".$img."</br>";

                                            break;
                                        
                                        default:
                                           $icone="fa fa-user";
                                           $texto="padrão";
                                           $titulo='<h3 class="timeline-header no-border"><a href="#">'.$v['tabela'].'</a> foi adicionada ao projeto</h3>';
                                            break;
                                    }
                                    ?>
                                <li>
                                    <i class="<? echo $icone;?>" style="<? echo $style;?>"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i><? echo $v['datahoras'];?></span>
                                        <? echo $titulo;?>
                                        <div class="timeline-body">
                                            <? echo $texto ?>
                                        </div>
                                        <div class='timeline-footer'>
                                            <a class="btn btn-primary btn-xs">Visualizar</a>
                                        </div>
                                    </div>
                                </li>
                                <?

                                  }
                                    }       
                                    foreach ($fotos as $ab) {
                                      foreach ($ab as $as) {
                                        # code...
                                     
                                              foreach ($as as $foto) {
                                                
                                            echo '<img title="'.$foto[title].'"src="http://farm' . $foto['farm'] . '.static.flickr.com/' . $foto['server'] . '/' . $foto['primary'] . '_' . $foto['secret'] . '_m.jpg"  alt="" class="img-thumbnail">';
                                         
                                              }
                                            } }
                                ?>
                            
                                 
                            </ul>
                        </div><!-- /.col -->
                    </div>
                    
 </div>
</section>



<?php include('app/views/rodape.php');?>