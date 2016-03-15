
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


<section class="panel">
<header class="panel-heading">Cadastrar Novos CSS</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/css/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th>Tipo</th><th>Referencia</th><th>Valor</th><th>Layout</th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>
    <td>
<input id="tipo" name="tipo[]" type="text" value="<?php echo $_POST['tipo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Tipo"/>

</td><td>
<input id="referencia" name="referencia[]" type="text" value="<?php echo $_POST['referencia']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Referencia"/>

</td><td>
<input id="valor" name="valor[]" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Valor"/>

</td><td>
<select id="cdlayout" name="cdlayout[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_layouts[1])) { $ch=' selected="selected" '; }

 foreach ($view_layouts as $layouts) {
  echo '<option value="'.$layouts['cdlayout'].'"'.$ch.'>'.$layouts['nome'].'</option>';
  } ?>
 </select>
</td></tr>
</tbody></table> 
</div>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/css/" class="btn btn-default">Cancelar</a>


 </form>
  </div>
 </section>
 </div>
<?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }  ?> 
<?php include('app/views/rodape.php'); ?>
