
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
<header class="panel-heading">Pesquisar Criar Consulta</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/consultas/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdconsulta" name="i1cdconsulta" type="text" value="<?php echo $_POST['cdconsulta']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdconsulta" name="i2cdconsulta" type="text" value="<?php echo $_POST['cdconsulta']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Titulo</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="titulo" name="s0titulo" type="text" value="<?php echo $_POST['titulo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Titulo"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Tipo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="tipo" name="m3tipo[]" multiple>
  <option value=""></option><option value="1" <?php if ($_POST['tipo']=='1') { echo 'selected';}?>>RELATÓRIO</option><option value="2" <?php if ($_POST['tipo']=='2') { echo 'selected';}?>>SALA DE SITUAÇAO</option><option value="3" <?php if ($_POST['tipo']=='3') { echo 'selected';}?>>MAPA</option><option value="4" <?php if ($_POST['tipo']=='4') { echo 'selected';}?>>DOCUMENTO</option>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Forma de visualização</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="visualizacao" name="m3visualizacao[]" multiple>
  <option value=""></option><option value="1" <?php if ($_POST['visualizacao']=='1') { echo 'selected';}?>>GRAFICO</option><option value="2" <?php if ($_POST['visualizacao']=='2') { echo 'selected';}?>>TABELA</option><option value="3" <?php if ($_POST['visualizacao']=='3') { echo 'selected';}?>>IMPRESSÃO</option>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Tipo de Gráfico</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="grafico" name="m3grafico[]" multiple>
  <option value=""></option><option value="1" <?php if ($_POST['grafico']=='1') { echo 'selected';}?>>PIZZA</option><option value="2" <?php if ($_POST['grafico']=='2') { echo 'selected';}?>>BARRA</option><option value="3" <?php if ($_POST['grafico']=='3') { echo 'selected';}?>>LINHA</option>
 </select></div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/consultas/" class="btn btn-default">Cancelar</a>

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
