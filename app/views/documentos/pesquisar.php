
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
<header class="panel-heading">Pesquisar Itens do Checklist</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/documentos/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cddocumento" name="i1cddocumento" type="text" value="<?php echo $_POST['cddocumento']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cddocumento" name="i2cddocumento" type="text" value="<?php echo $_POST['cddocumento']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Grupo de documento</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdgrupodocumento" name="m3cdgrupodocumento[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_grupodocumento[1])) { $ch=' selected="selected" '; }

 foreach ($view_grupodocumento as $grupodocumento) {
  echo '<option value="'.$grupodocumento['cdgrupodocumento'].'"'.$ch.'>'.$grupodocumento['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="descricao" name="s0descricao" type="text" value="<?php echo $_POST['descricao']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Descrição"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Tipo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="tipo" name="m3tipo[]" multiple>
  <option value=""></option><option value="TEXTO" <?php if ($_POST['tipo']=='TEXTO') { echo 'selected';}?>>TEXTO</option><option value="DATA" <?php if ($_POST['tipo']=='DATA') { echo 'selected';}?>>DATA</option><option value="NUMERO" <?php if ($_POST['tipo']=='NUMERO') { echo 'selected';}?>>NUMERO</option><option value="LISTA" <?php if ($_POST['tipo']=='LISTA') { echo 'selected';}?>>LISTA</option><option value="DOCUMENTO" <?php if ($_POST['tipo']=='DOCUMENTO') { echo 'selected';}?>>DOCUMENTO</option>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Obrigatorio</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="obrigatorio" name="i1obrigatorio" type="text" value="<?php echo $_POST['obrigatorio']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="obrigatorio" name="i2obrigatorio" type="text" value="<?php echo $_POST['obrigatorio']; ?>" class="form-control number" /></div><div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/documentos/" class="btn btn-default">Cancelar</a>

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
