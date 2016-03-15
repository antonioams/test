
<?php
include('app/views/topo.php');
//if ($_SESSION[PROJETO]['flickr_chave']!='') {
//require_once("phpFlickr.php");
//$f = new phpFlickr($_SESSION[PROJETO]['flickr_chave'],$_SESSION[PROJETO]['flickr_sec']); 
//$set = $f->photosets_getList($view_clientes['flickr_usuario']); 
//}
//print_r($view_projetos);
//die();

echo '<link rel="stylesheet" type="text/css" href="/'.PROJETO.'/inc/css/tooltip-classic.css" />';
?>

<div class="<?php echo $_SESSION[PROJETO]['mensagem']['tipo'];?>">
                                <?php
                                echo $_SESSION[PROJETO]['mensagem']['texto'];
                                unset( $_SESSION[PROJETO]['mensagem'] );?>
                            </div>
<?php if (!empty($view_vc[1])) { ?> 
<div class="col-lg-12">
<div class="box-tab">
<ul class="nav nav-tabs">
<?php foreach ($view_vc as $vc) { ?>
<li<?php echo $vc['tipo']?>><a href="<?php echo $vc['link']?>" data-original-title="<?php echo $vc['nome']?>"><?php echo $vc['atalho']?></a></li>
<?php } ?>
</ul>

<div class="tab-content">
<div class="tab-pane fade active in">

<?php } else { echo '<div class="col-lg-12">';}?>


<section class="panel panel-default">

   <header class="panel-heading">
      Lista de Projetos
   </header>
        <div class="panel-body">
        <div class="table-responsive no-border">
        <table id="example1" class="table table-bordered table-striped mg-t datatable">
            <thead>
            <tr>
            <th>Área</th>
            <th>Intervenção</th>
            <th>Tipo</th>
            <th>Situação</th>
            <th>Município</th>
            <th></th>
            </tr>
            </thead>
            <tbody>
             <?php if (!empty($view_projetos)) { foreach ($view_projetos as $projetos) {
                if ($view_op=='') {
                    $link = '/'.PROJETO.'/projetos/visualiza/id/'.$projetos[0]['cdprojeto'];
                } else {
                    $link = '/'.PROJETO.'/projetos/consultar/'.$view_op.'/'.$projetos[0]['cdprojeto'];
                }

                ?>
            <tr class="gradeA" >
                <td onclick="location.href = '<?php echo $link;?>';" style="cursor: pointer; cursor: hand"><img height="15" width="15" src="/<?php echo PROJETO;?>/inc/img/area/<?php echo $projetos['0']['icone']?>">  <?php echo $projetos['area']; ?></td>
            <td onclick="location.href = '<?php echo $link;?>';" style="cursor: pointer; cursor: hand"><?php echo $projetos[0]['intervencao']; ?></td>
            <td onclick="location.href = '<?php echo $link;?>';" style="cursor: pointer; cursor: hand"><?php echo $projetos[0]['tipo']; ?></td>
            <td onclick="location.href = '<?php echo $link;?>';" style="cursor: pointer; cursor: hand"><?php echo $projetos[0]['fase']; ?></td>
            <td onclick="location.href = '<?php echo $link;?>';" style="cursor: pointer; cursor: hand"><?php echo $projetos[0]['municipio_nome']; ?></td>
            <td>
                <span class="t t-effect-1">
                                    <span class="t-item">detalhes</span>
                                        <span class="t-content clearfix">
                                            <span class="t-text">
                                   <div class="panel overflow-hidden no-b profile p15">
                                    <div class="row ">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-7 col-md-7">
                                                    <h4 class="mb0"><b><?php echo $projetos[0]['intervencao']; ?></b></h4>
                                                    <small><img height="15" width="15" src="/<?php echo PROJETO;?>/inc/img/area/<?php echo $projetos['0']['icone']?>"> <?php echo $projetos['0']['area']?></small>
                                                 <p><div class=""><?php echo $projetos[0]['objetivo']; ?>
                                             ..<a href="<?php echo $link?>"> Ver mais</a></div>
                                            </p>
                                                </div>
                                                <div class="col-sm-5 col-md-5 text-center">
                                                    <figure>
                                                            <?php
                                                           // $fotos=array(str_replace(array('{','}'),'',$item['texto']));
                                                                if(array_key_exists("texto",$projetos[0])){
                                                                $foto=explode(',',$projetos[0]['texto']);
                                                                $img='';
                                                                $src="http://farm".$foto[3].".static.flickr.com/".$foto[1]."/".$foto[0]."_".$foto[2]."_m.jpg";
                                                                $img.="<img title='".$foto[4]."' src='".$src."' alt='' class='img-thumbnail'>";
                                                                 echo $img;
                                                        }else{
                                                            echo "<img title='sem imagem' src='/".PROJETO."/inc/img/semfoto.jpg' alt='' class='img-thumbnail'>";
                                                        }
                                                            ?>
                                                        <small></small>
                                                    </figure>
                                                </div>

                                            </div>
                                        </div>
                                  <div class="row mb15" align="center">
                                       <div class="col-xs-12 mt15">
                                            <div class="mt10 mb10">
                                                <a class="btn btn-social btn-xs btn-facebook mr5" href="/<?php echo PROJETO?>/projetos/consultar/timeline/<?php echo $projetos[0]['cdprojeto']; ?>"><i class="fa fa-arrows-v"></i>TimeLine </a>
                                                <a class="btn btn-social btn-xs btn-twitter mr5" href="/<?php echo PROJETO?>/projetos/consultar/checklist/<?php echo $projetos[0]['cdprojeto']; ?>"><i class="fa fa-check-square-o"></i>Checklist </a>
                                                <a class="btn btn-social btn-xs btn-github mr5" href="/<?php echo PROJETO?>/projetos/consultar/contrato/<?php echo $projetos[0]['cdprojeto']; ?>"><i class="fa fa-file-text-o"></i>Contrato</a>
                                            </div>
                                        </div>

                                    </div>
                                        <?php /*
                                        <div class="col-xs-12 mt25 text-center bt">
                                            <div class="col-xs-12 col-sm-4">
                                                <h2 class="mb0"><b>R$ 100</b></h2> 
                                                <small>Investimentos</small>
                                            </div>
                                            <div class="col-xs-12 col-sm-4">
                                                <h2 class="mb0"><b>2 Meses</b></h2> 
                                                <small>Tempo</small>
                                            </div>
                                            <div class="col-xs-12 col-sm-4">
                                                <h2 class="mb0"><b>15 dias</b></h2> 
                                                <small>Previsão término</small>
                                            </div>
                                        </div>*/
                                        ?>
                                    </div>
                                  </div>
                                            </span>
                                        </span>
                                    </span>
            </td>



            </tr>
            <?php } } ?>
        </table>
    </div>
 </div>

 </section>
  <div id="gambi" style="height: 300px;">&nbsp;</div>
 </div>
 <?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }  ?> 

<?php include('app/views/rodape.php'); ?>