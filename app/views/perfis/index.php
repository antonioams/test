
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
      Lista de Perfis/Usuários
   </header>
        <div class="panel-body">
        <div class="table-responsive no-border">
        <table id="example1" class="table table-bordered table-striped mg-t datatable">
            <thead>
            <tr>
            <th>Descrição</th>
            </tr>
            </thead>
            <tbody>
             <?php if (!empty($view_perfis)) { foreach ($view_perfis as $perfis) {?>
            <tr class="gradeA" onclick="location.href = '/<?php echo PROJETO;?>/perfis/editar/id/<?php echo $perfis['cdperfil'] ?>';" style="cursor: pointer; cursor: hand">
<td><?php 
    echo $perfis['descricao'].' ';
if  ($perfis['cdperfil']==$_SESSION[PROJETO]['cdperfil']) {
    echo '<i class="fa fa-circle" style="color: #54ce0a"></i>';
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