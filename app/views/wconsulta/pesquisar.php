
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
<header class="panel-heading">Pesquisar Saídas</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/wconsulta/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdsaida" name="i1cdsaida" type="text" value="<?php echo $_POST['cdsaida']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdsaida" name="i2cdsaida" type="text" value="<?php echo $_POST['cdsaida']; ?>" class="form-control number" /></div><div>
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
<label  class="control-label">Tipo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="tipo" name="m3tipo[]" multiple>
  <option value=""></option><option value="selecionar" <?php if ($_POST['tipo']=='selecionar') { echo 'selected';}?>>selecionar</option><option value="somar" <?php if ($_POST['tipo']=='somar') { echo 'selected';}?>>somar</option><option value="quantificar" <?php if ($_POST['tipo']=='quantificar') { echo 'selected';}?>>quantificar</option><option value="
maior valor" <?php if ($_POST['tipo']=='
maior valor') { echo 'selected';}?>>
maior valor</option><option value="menor valor" <?php if ($_POST['tipo']=='menor valor') { echo 'selected';}?>>menor valor</option>
 </select></div></div>
</div></div>

<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Chave</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="chave" value="1">
       </div>
      </div>
</div>

<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Visualiza</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="visualiza" value="1">
       </div>
      </div>
</div>

<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Totaliza</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="totaliza" value="1">
       </div>
      </div>
</div>

<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Rotulo</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="rotulo" value="1">
       </div>
      </div>
</div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/wconsulta/" class="btn btn-default">Cancelar</a>

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
