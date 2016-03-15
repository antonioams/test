
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
<header class="panel-heading">Pesquisar Template de Documentos</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/template_documento/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdtemplate" name="i1cdtemplate" type="text" value="<?php echo $_POST['cdtemplate']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdtemplate" name="i2cdtemplate" type="text" value="<?php echo $_POST['cdtemplate']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Template</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<div class="row"><div class="col-xs-12"><input id="template" name="s0template" type="text" value="<?php echo $_POST['template']; ?>" class="form-control" /></div></div>
</div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Tabela</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="tabela" name="s0tabela" type="text" value="<?php echo $_POST['tabela']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Tabela"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Variavel</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="variavel" name="s0variavel" type="text" value="<?php echo $_POST['variavel']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Variavel"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Parametro</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="parametro" name="s0parametro" type="text" value="<?php echo $_POST['parametro']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Parametro"/></div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/template_documento/" class="btn btn-default">Cancelar</a>

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
