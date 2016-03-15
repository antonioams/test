
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
      Lista de Itens do Contrato
   </header>
        <div class="panel-body">
        <div class="table-responsive no-border">
        <table id="example1" class="table table-bordered table-striped mg-t datatable">
            <thead>
            <tr>
            <th></th>
            <th>Descrição</th>
            <th>Quantidade</th>
            <th>Valor</th>
            <th>Data Início</th>
            <th></th>
            </tr>
            </thead>
            <tbody>
             <?php if (!empty($view_contrato_item)) { foreach ($view_contrato_item as $contrato_item) {?>
            <tr class="gradeA" onclick="location.href = '/<?php echo PROJETO;?>/contrato_item/editar/id/<?php echo $contrato_item['cdcontrato_item'] ?>';" style="cursor: pointer; cursor: hand">
            <td><?php echo $contrato_item['i']; ?></td>
            <td><?php echo $contrato_item['descricao']; ?></td>
            <td><?php echo $contrato_item['quantidade'].' '.$contrato_item['unidade']; ?></td>
            <td><?php echo 'R$' . number_format($contrato_item['valor'], 2, ',', '.'); ?></td>
            <td><?php echo $contrato_item['data']; ?></td>
            <td>
            <?php 
            
            if ($contrato_item['valor']<$contrato_item['valor_previsao']) {
             echo '<span class="label label-danger">Valor dos Itens < Previsão</span>';
            } elseif ($contrato_item['valor']>$contrato_item['valor_previsao']) {
             echo '<span class="label label-warning">Valor dos Itens > Previsão</span>';
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