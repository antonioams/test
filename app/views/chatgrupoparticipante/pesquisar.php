
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
<header class="panel-heading">Pesquisar chatgrupoparticipante</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/chatgrupoparticipante/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">cdchatgrupoparticipante</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdchatgrupoparticipante" name="i1cdchatgrupoparticipante" type="text" value="<?php echo $_POST['cdchatgrupoparticipante']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdchatgrupoparticipante" name="i2cdchatgrupoparticipante" type="text" value="<?php echo $_POST['cdchatgrupoparticipante']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">cdgrupo</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdgrupo" name="i1cdgrupo" type="text" value="<?php echo $_POST['cdgrupo']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdgrupo" name="i2cdgrupo" type="text" value="<?php echo $_POST['cdgrupo']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">cdusuario</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdusuario" name="i1cdusuario" type="text" value="<?php echo $_POST['cdusuario']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdusuario" name="i2cdusuario" type="text" value="<?php echo $_POST['cdusuario']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">datahora</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="date" name="d1datahora" type="text" value="<?php echo $_POST['datahora']; ?>" class="form-control " placeholder="99/99/9999"/></div>
<div class="col-xs-3"><input id="date" name="d2datahora" type="text" value="<?php echo $_POST['datahora']; ?>" class="form-control " placeholder="99/99/9999"/></div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/chatgrupoparticipante/" class="btn btn-default">Cancelar</a>

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
