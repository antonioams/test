
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
<header class="panel-heading">Pesquisar Objetivos</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/objetivo_informacao/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdobjetivo_informacao" name="i1cdobjetivo_informacao" type="text" value="<?php echo $_POST['cdobjetivo_informacao']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdobjetivo_informacao" name="i2cdobjetivo_informacao" type="text" value="<?php echo $_POST['cdobjetivo_informacao']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Lógica</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="logica" name="s0logica" type="text" value="<?php echo $_POST['logica']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Lógica"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Alvo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdalvo" name="m3cdalvo[]" multiple>
  <option value=""></option>
 <?php
 $vmarcado = $_POST['cdalvo']; 

 foreach ($view_alvo as $alvo) {
   $ch=""; 
  if ($vmarcado==$alvo['cdalvo']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$alvo['cdalvo'].'"'.$ch.'>'.$alvo['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Tipo</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="tipo" name="s0tipo" type="text" value="<?php echo $_POST['tipo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Tipo"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Indicador</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="indicador" name="s0indicador" type="text" value="<?php echo $_POST['indicador']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Indicador"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Fórmula</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="formula" name="s0formula" type="text" value="<?php echo $_POST['formula']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Fórmula"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Fonte</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<div class="row"><div class="col-xs-12"><input id="fonte" name="s0fonte" type="text" value="<?php echo $_POST['fonte']; ?>" class="form-control" /></div></div>
</div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Descrição do Indicador</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<div class="row"><div class="col-xs-12"><input id="descricao_indicador" name="s0descricao_indicador" type="text" value="<?php echo $_POST['descricao_indicador']; ?>" class="form-control" /></div></div>
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

<div class="form-group">
<label  class="control-label">Meta</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="meta" name="i1meta" type="text" value="<?php echo $_POST['meta']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="meta" name="i2meta" type="text" value="<?php echo $_POST['meta']; ?>" class="form-control number" /></div><div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/objetivo_informacao/" class="btn btn-default">Cancelar</a>

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
