
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
<header class="panel-heading">Pesquisar Informações Complementares</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/resposta_projeto/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdresposta_projeto" name="i1cdresposta_projeto" type="text" value="<?php echo $_POST['cdresposta_projeto']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdresposta_projeto" name="i2cdresposta_projeto" type="text" value="<?php echo $_POST['cdresposta_projeto']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Resposta</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdresposta" name="m3cdresposta[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_respostas[1])) { $ch=' selected="selected" '; }

 foreach ($view_respostas as $respostas) {
  echo '<option value="'.$respostas['cdresposta'].'"'.$ch.'>'.$respostas['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Data</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="date" name="d1data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control " placeholder="99/99/9999"/></div>
<div class="col-xs-3"><input id="date" name="d2data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control " placeholder="99/99/9999"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Resposta</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="resposta" name="s0resposta" type="text" value="<?php echo $_POST['resposta']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Resposta"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Codigo</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="codigo" name="i1codigo" type="text" value="<?php echo $_POST['codigo']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="codigo" name="i2codigo" type="text" value="<?php echo $_POST['codigo']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Imagem</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="imagem" name="s0imagem" type="text" value="<?php echo $_POST['imagem']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Imagem"/></div></div>
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

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/resposta_projeto/" class="btn btn-default">Cancelar</a>

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
