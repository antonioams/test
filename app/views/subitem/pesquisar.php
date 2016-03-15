
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
<header class="panel-heading">Pesquisar Subitem</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/subitem/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdcontrato_item" name="i1cdcontrato_item" type="text" value="<?php echo $_POST['cdcontrato_item']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdcontrato_item" name="i2cdcontrato_item" type="text" value="<?php echo $_POST['cdcontrato_item']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Contrato</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdcontrato" name="i1cdcontrato" type="text" value="<?php echo $_POST['cdcontrato']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdcontrato" name="i2cdcontrato" type="text" value="<?php echo $_POST['cdcontrato']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Projeto</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdprojeto" name="i1cdprojeto" type="text" value="<?php echo $_POST['cdprojeto']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdprojeto" name="i2cdprojeto" type="text" value="<?php echo $_POST['cdprojeto']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="descricao" name="s0descricao" type="text" value="<?php echo $_POST['descricao']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Descrição"/></div></div>
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
<label  class="control-label">Data</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="date" name="d1data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control " placeholder="99/99/9999"/></div>
<div class="col-xs-3"><input id="date" name="d2data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control " placeholder="99/99/9999"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Unidade</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdunidade" name="i1cdunidade" type="text" value="<?php echo $_POST['cdunidade']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdunidade" name="i2cdunidade" type="text" value="<?php echo $_POST['cdunidade']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Contrato_item_sup</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdcontrato_item_sup" name="i1cdcontrato_item_sup" type="text" value="<?php echo $_POST['cdcontrato_item_sup']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdcontrato_item_sup" name="i2cdcontrato_item_sup" type="text" value="<?php echo $_POST['cdcontrato_item_sup']; ?>" class="form-control number" /></div><div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/subitem/" class="btn btn-default">Cancelar</a>

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
