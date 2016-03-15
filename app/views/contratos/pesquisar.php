
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
<header class="panel-heading">Pesquisar Contratos</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/contratos/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdcontrato" name="i1cdcontrato" type="text" value="<?php echo $_POST['cdcontrato']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdcontrato" name="i2cdcontrato" type="text" value="<?php echo $_POST['cdcontrato']; ?>" class="form-control number" /></div><div>
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
<label  class="control-label">Fornecedor</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdfornecedor" name="m3cdfornecedor[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_fornecedores[1])) { $ch=' selected="selected" '; }

 foreach ($view_fornecedores as $fornecedores) {
  echo '<option value="'.$fornecedores['cdfornecedor'].'"'.$ch.'>'.$fornecedores['razao_social'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Licitacao</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="cdlicitacao" name="s0cdlicitacao" type="text" value="<?php echo $_POST['cdlicitacao']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Licitacao"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Data</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="date" name="d1data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control " placeholder="99/99/9999"/></div>
<div class="col-xs-3"><input id="date" name="d2data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control " placeholder="99/99/9999"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Prazo</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="prazo" name="i1prazo" type="text" value="<?php echo $_POST['prazo']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="prazo" name="i2prazo" type="text" value="<?php echo $_POST['prazo']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Valor</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="valor" name="i1valor" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="valor" name="i2valor" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Número</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="numero" name="i1numero" type="text" value="<?php echo $_POST['numero']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="numero" name="i2numero" type="text" value="<?php echo $_POST['numero']; ?>" class="form-control number" /></div><div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/contratos/" class="btn btn-default">Cancelar</a>

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
