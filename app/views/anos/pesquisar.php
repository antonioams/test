
<?php
include('app/views/topo.php');
?>
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
<header class="panel-heading">Pesquisar Anos</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/anos/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdano" name="i1cdano" type="text" value="<?php echo $_POST['cdano']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdano" name="i2cdano" type="text" value="<?php echo $_POST['cdano']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Ano</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="ano" name="i1ano" type="text" value="<?php echo $_POST['ano']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="ano" name="i2ano" type="text" value="<?php echo $_POST['ano']; ?>" class="form-control number" /></div><div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/anos/" class="btn btn-default">Cancelar</a>

 </form>
  </div>
 </section>
 </div>
 <?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }  ?> 
<?php
include('app/views/rodape.php');
?>
