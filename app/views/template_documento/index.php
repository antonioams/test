<?php
include('app/views/topo.php');
?>
<div class="<?php echo $_SESSION['mensagem']['tipo'];?>">
                                <?php
                                echo $_SESSION['mensagem']['texto'];
                                unset( $_SESSION['mensagem'] );?>
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
      Lista de Template de Documentos
   </header>
        <div class="panel-body">
        <div class="table-responsive no-border">
        <table id="example1" class="table table-bordered table-striped mg-t datatable">
            <thead>
            <tr>
            <th>Template</th>
            </tr>
            </thead>
            <tbody>
             <?php if (!empty($view_template_documento)) { foreach ($view_template_documento as $template_documento) {?>
            <tr class="gradeA" onclick="location.href = '/<?php echo PROJETO;?>/template_documento/editar/id/<?php echo $template_documento['cdtemplate'] ?>';" style="cursor: pointer; cursor: hand">
            <td><?php echo $template_documento['template']; ?></td>

            </tr>
            <?php } } ?>
        </table>
    </div>
 </div>
 </section>
 </div>
 <?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }  ?> 

<?php include('app/views/rodape.php'); ?>