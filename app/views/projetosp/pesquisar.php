
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
<header class="panel-heading">Pesquisar Projetos</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/projetos/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>

<div class="form-group">
<label  class="control-label">Tipo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdtipo" name="m3cdtipo[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_tipos[1])) { $ch=' selected="selected" '; }

 foreach ($view_tipos as $tipos) {
  echo '<option value="'.$tipos['cdtipo'].'"'.$ch.'>'.$tipos['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>


<div class="form-group">
<label  class="control-label">Area</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdarea" name="m3cdarea[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_areas[1])) { $ch=' selected="selected" '; }

 foreach ($view_areas as $areas) {
  echo '<option value="'.$areas['cdarea'].'"'.$ch.'>'.$areas['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Natureza</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdnatureza" name="m3cdnatureza[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_naturezas[1])) { $ch=' selected="selected" '; }

 foreach ($view_naturezas as $naturezas) {
  echo '<option value="'.$naturezas['cdnatureza'].'"'.$ch.'>'.$naturezas['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Municipio</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdmunicipio" name="m3cdmunicipio[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_municipios[1])) { $ch=' selected="selected" '; }

 foreach ($view_municipios as $municipios) {
  echo '<option value="'.$municipios['cdmunicipio'].'"'.$ch.'>'.$municipios['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Situação</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdsituacao" name="m3cdsituacao[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_situacao[1])) { $ch=' selected="selected" '; }

 foreach ($view_situacao as $situacao) {
  echo '<option value="'.$situacao['cdsituacao'].'"'.$ch.'>'.$situacao['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Intervencao</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<div class="row"><div class="col-xs-12"><input id="intervencao" name="s0intervencao" type="text" value="<?php echo $_POST['intervencao']; ?>" class="form-control" /></div></div>
</div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Programa</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdprograma" name="m3cdprograma[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_programas[1])) { $ch=' selected="selected" '; }

 foreach ($view_programas as $programas) {
  echo '<option value="'.$programas['cdprograma'].'"'.$ch.'>'.$programas['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/projetos/" class="btn btn-default">Cancelar</a>

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
