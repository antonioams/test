
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
<header class="panel-heading">Pesquisar Itens da Medição</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/medicao/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdmedicao" name="i1cdmedicao" type="text" value="<?php echo $_POST['cdmedicao']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdmedicao" name="i2cdmedicao" type="text" value="<?php echo $_POST['cdmedicao']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Contrato Item</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdcontrato_item" name="m3cdcontrato_item[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_contrato_item[1])) { $ch=' selected="selected" '; }

 foreach ($view_contrato_item as $contrato_item) {
  echo '<option value="'.$contrato_item['cdcontrato_item'].'"'.$ch.'>'.$contrato_item['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Medição</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdgrupomedicao" name="m3cdgrupomedicao[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_grupomedicao[1])) { $ch=' selected="selected" '; }

 foreach ($view_grupomedicao as $grupomedicao) {
  echo '<option value="'.$grupomedicao['cdgrupomedicao'].'"'.$ch.'>'.$grupomedicao['numero'].''.' - '.$grupomedicao['data'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Quantidade</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="quantidade" name="s0quantidade" type="text" value="<?php echo $_POST['quantidade']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Quantidade"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Valor</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="valor" name="s0valor" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Valor"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">NF</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="nf" name="s0nf" type="text" value="<?php echo $_POST['nf']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="NF"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">NE</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="ne" name="s0ne" type="text" value="<?php echo $_POST['ne']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="NE"/></div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/medicao/" class="btn btn-default">Cancelar</a>

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
