
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
<header class="panel-heading">Pesquisar Objetivos do Produto</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/objetivo_produto/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdobjetivo_produto" name="i1cdobjetivo_produto" type="text" value="<?php echo $_POST['cdobjetivo_produto']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdobjetivo_produto" name="i2cdobjetivo_produto" type="text" value="<?php echo $_POST['cdobjetivo_produto']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Objetivo_informacao</label>
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
<label  class="control-label">Produto</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdproduto" name="m3cdproduto[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_produtos[1])) { $ch=' selected="selected" '; }

 foreach ($view_produtos as $produtos) {
  echo '<option value="'.$produtos['cdproduto'].'"'.$ch.'>'.$produtos['logica'].''.' - '.$produtos['tipo'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Peso</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="peso" name="i1peso" type="text" value="<?php echo $_POST['peso']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="peso" name="i2peso" type="text" value="<?php echo $_POST['peso']; ?>" class="form-control number" /></div><div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/objetivo_produto/" class="btn btn-default">Cancelar</a>

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
