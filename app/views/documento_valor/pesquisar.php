
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
<header class="panel-heading">Pesquisar Checklist de Documentos</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/documento_valor/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cddocumento_valor" name="i1cddocumento_valor" type="text" value="<?php echo $_POST['cddocumento_valor']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cddocumento_valor" name="i2cddocumento_valor" type="text" value="<?php echo $_POST['cddocumento_valor']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Projeto</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdprojeto" name="m3cdprojeto[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_projetos[1])) { $ch=' selected="selected" '; }

 foreach ($view_projetos as $projetos) {
  echo '<option value="'.$projetos['cdprojeto'].'"'.$ch.'>'.$projetos['intervencao'].''.' - '.$projetos['objetivo'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Campo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdcampo" name="m3cdcampo[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_documento_campos[1])) { $ch=' selected="selected" '; }

 foreach ($view_documento_campos as $documento_campos) {
  echo '<option value="'.$documento_campos['cdcampo'].'"'.$ch.'>'.$documento_campos['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Valor</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="valor" name="s0valor" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Valor"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Arquivo</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="arquivo" name="s0arquivo" type="text" value="<?php echo $_POST['arquivo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Arquivo"/></div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/documento_valor/" class="btn btn-default">Cancelar</a>

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
