
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
      Lista de Contratos
   </header>
        <div class="panel-body">
        <div class="table-responsive no-border">
        <table id="example1" class="table table-bordered table-striped mg-t datatable">
            <thead>
            <tr>
            <th>Data</th>
            <th>Valor</th>
            <th>Número</th>
            <th>Objeto</th>
            <th></th>
            </tr>
            </thead>
            <tbody>
             <?php if (!empty($view_contratos)) { foreach ($view_contratos as $contratos) {?>
            <tr class="gradeA" onclick="location.href = '/<?php echo PROJETO;?>/contratos/editar/id/<?php echo $contratos['cdcontrato'] ?>';" style="cursor: pointer; cursor: hand">
            <td><?php echo $contratos['data']; ?></td>
            <td><?php echo 'R$' . number_format($contratos['valor'], 2, ',', '.'); ?></td>
            <td><?php echo $contratos['numero']; ?></td>
            <td><?php echo $contratos['objeto']; ?></td>
            <td>
            <?php 
            
            if ($contratos['valor']<$contratos['valor_item']) {
             echo '<span class="label label-danger">Valor Contrato < Itens</span>';
            } elseif ($contratos['valor']>$contratos['valor_item']) {
             echo '<span class="label label-warning">Valor Contrato > Itens</span>';
            } 
            
            
             ?>
            </td>

            

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