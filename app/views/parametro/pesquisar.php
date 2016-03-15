
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
<header class="panel-heading">Pesquisar Parâmetro</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/parametro/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdparametro" name="i1cdparametro" type="text" value="<?php echo $_POST['cdparametro']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdparametro" name="i2cdparametro" type="text" value="<?php echo $_POST['cdparametro']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Consulta</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdconsulta" name="m3cdconsulta[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_consultas[1])) { $ch=' selected="selected" '; }

 foreach ($view_consultas as $consultas) {
  echo '<option value="'.$consultas['cdconsulta'].'"'.$ch.'>'.$consultas['titulo'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Campo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdcampo" name="m3cdcampo[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_usuarios[1])) { $ch=' selected="selected" '; }

 foreach ($view_usuarios as $usuarios) {
  echo '<option value="'.$usuarios['cdcampo'].'"'.$ch.'>'.$usuarios['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Condicao</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="condicao" name="m3condicao[]" multiple>
  <option value=""></option><option value="igual
maior
menor
maior e igual
menor e igual
em
não em" <?php if ($_POST['condicao']=='igual
maior
menor
maior e igual
menor e igual
em
não em') { echo 'selected';}?>>igual
maior
menor
maior e igual
menor e igual
em
não em</option>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Valor</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="valor" name="s0valor" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Valor"/></div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/parametro/" class="btn btn-default">Cancelar</a>

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
