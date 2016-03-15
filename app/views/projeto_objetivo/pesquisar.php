
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
<header class="panel-heading">Pesquisar Objetivos do Projeto</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/projeto_objetivo/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdprojeto_objetivo" name="i1cdprojeto_objetivo" type="text" value="<?php echo $_POST['cdprojeto_objetivo']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdprojeto_objetivo" name="i2cdprojeto_objetivo" type="text" value="<?php echo $_POST['cdprojeto_objetivo']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Projeto</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdprojeto" name="m3cdprojeto[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_projetos[1])) { $ch=' selected="selected" '; }

 foreach ($view_projetos as $projetos) {
  echo '<option value="'.$projetos['cdprojeto'].'"'.$ch.'>'.$projetos['intervencao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Itens do Objetivo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdobjetivo_informacao" name="m3cdobjetivo_informacao[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_objetivo_informacao[1])) { $ch=' selected="selected" '; }

 foreach ($view_objetivo_informacao as $objetivo_informacao) {
  echo '<option value="'.$objetivo_informacao['cdobjetivo_informacao'].'"'.$ch.'>'.$objetivo_informacao['logica'].''.' - '.$objetivo_informacao['tipo'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Peso</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="peso" name="s0peso" type="text" value="<?php echo $_POST['peso']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Peso"/></div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/projeto_objetivo/" class="btn btn-default">Cancelar</a>

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
