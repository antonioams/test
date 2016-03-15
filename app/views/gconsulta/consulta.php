<?php
include('app/views/topo.php');
?>
<div class="<?php echo $_SESSION[PROJETO]['mensagem']['tipo'];?>">
                                <?php
                                echo $_SESSION[PROJETO]['mensagem']['texto'];
                                unset( $_SESSION[PROJETO]['mensagem'] );?>
                            </div>
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

<div class="col-lg-12">
<section class="panel panel-default">

   <header class="panel-heading">
      Resultado da consulta <?php echo $view_consultas[0]['titulo'];?>
   </header>
        <div class="panel-body">
        <div class="table-responsive no-border">
        
   
   <?php echo $view_pagina;?>
   

                              
    </div>
    <br><br>
        <div align="left">
            Exportar:
        <a href="/<?php echo PROJETO;?>/gconsulta/exportarxls/id/<?php echo $view_consultas[0]['cdconsulta'];?>" target="_blank""><img src="/<?php echo PROJETO;?>/inc/img/excel.png"></a>                
        </div>  
            

 </div>
 </section>
 </div>
 <?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>


<?php }
      // rodapé 
       echo $view_rodape;?>

