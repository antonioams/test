
<?php
include('app/views/topo.php');
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
      Lista de Clientes/Perfis
   </header>
        <div class="panel-body">
        <div class="table-responsive no-border">
        <table id="example1" class="table table-bordered table-striped mg-t datatable">
            <thead>
            <tr>
            <th>Nome</th>
            <th>Contato</th>
            <th>Telefone</th>
            <th>Status</th>
            </tr>
            </thead>
            <tbody>
             <?php if (!empty($view_clientes)) { foreach ($view_clientes as $clientes) {?>
            <tr class="gradeA" onclick="location.href = '/<?php echo PROJETO;?>/clientes/editar/id/<?php echo $clientes['cdcliente'] ?>';" style="cursor: pointer; cursor: hand">
            <td>
                <?php 
    echo $clientes['nome'].' ';
if  ($clientes['cdcliente']==$_SESSION[PROJETO]['cdcliente']) {
    echo '<i class="fa fa-circle" style="color: #54ce0a"></i>';
}
?>
</td>
<td><?php echo $clientes['contato']; ?></td>
<td><?php echo $clientes['telefone1']; ?></td>
<td><?php if ($clientes['ativo']=='1') { echo '<span class="label label-success">Ativo</span>'; } else { echo '<span class="label label-danger">Bloqueado</span>'; }?></td>

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