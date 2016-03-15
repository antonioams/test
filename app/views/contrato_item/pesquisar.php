
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
<header class="panel-heading">Pesquisar Itens do Contrato</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/contrato_item/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdcontrato_item" name="i1cdcontrato_item" type="text" value="<?php echo $_POST['cdcontrato_item']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdcontrato_item" name="i2cdcontrato_item" type="text" value="<?php echo $_POST['cdcontrato_item']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Contrato</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdcontrato" name="m3cdcontrato[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_contratos[1])) { $ch=' selected="selected" '; }

 foreach ($view_contratos as $contratos) {
  echo '<option value="'.$contratos['cdcontrato'].'"'.$ch.'>'.$contratos['numero'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="descricao" name="s0descricao" type="text" value="<?php echo $_POST['descricao']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Descrição"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Unidade Medida</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdunidade" name="m3cdunidade[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_unidades[1])) { $ch=' selected="selected" '; }

 foreach ($view_unidades as $unidades) {
  echo '<option value="'.$unidades['cdunidade'].'"'.$ch.'>'.$unidades['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Quantidade</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="quantidade" name="i1quantidade" type="text" value="<?php echo $_POST['quantidade']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="quantidade" name="i2quantidade" type="text" value="<?php echo $_POST['quantidade']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Valor</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="valor" name="i1valor" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="valor" name="i2valor" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Data Entrega</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="date" name="d1data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control " placeholder="99/99/9999"/></div>
<div class="col-xs-3"><input id="date" name="d2data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control " placeholder="99/99/9999"/></div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/contrato_item/" class="btn btn-default">Cancelar</a>

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
