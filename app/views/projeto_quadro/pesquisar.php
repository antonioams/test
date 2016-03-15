
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
<header class="panel-heading">Pesquisar Valores dos Projetos</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/projeto_quadro/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdquadro_valor" name="i1cdquadro_valor" type="text" value="<?php echo $_POST['cdquadro_valor']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdquadro_valor" name="i2cdquadro_valor" type="text" value="<?php echo $_POST['cdquadro_valor']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Quadro_logico</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdquadro_logico" name="m3cdquadro_logico[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_quadro_logico[1])) { $ch=' selected="selected" '; }

 foreach ($view_quadro_logico as $quadro_logico) {
  echo '<option value="'.$quadro_logico['cdquadro_logico'].'"'.$ch.'>'.$quadro_logico['logica'].''.' - '.$quadro_logico['tipo'].'</option>';
  } ?>
 </select></div></div>
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
<label  class="control-label">Ano</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="ano" name="m3ano[]" multiple>
  <option value=""></option><option value="2014" <?php if ($_POST['ano']=='2014') { echo 'selected';}?>>2014</option><option value="2015" <?php if ($_POST['ano']=='2015') { echo 'selected';}?>>2015</option><option value="2016" <?php if ($_POST['ano']=='2016') { echo 'selected';}?>>2016</option><option value="2017" <?php if ($_POST['ano']=='2017') { echo 'selected';}?>>2017</option><option value="2018" <?php if ($_POST['ano']=='2018') { echo 'selected';}?>>2018</option><option value="2019" <?php if ($_POST['ano']=='2019') { echo 'selected';}?>>2019</option><option value="2020" <?php if ($_POST['ano']=='2020') { echo 'selected';}?>>2020</option><option value="2021" <?php if ($_POST['ano']=='2021') { echo 'selected';}?>>2021</option><option value="2022" <?php if ($_POST['ano']=='2022') { echo 'selected';}?>>2022</option><option value="2023" <?php if ($_POST['ano']=='2023') { echo 'selected';}?>>2023</option><option value="2024" <?php if ($_POST['ano']=='2024') { echo 'selected';}?>>2024</option><option value="2025" <?php if ($_POST['ano']=='2025') { echo 'selected';}?>>2025</option><option value="2026" <?php if ($_POST['ano']=='2026') { echo 'selected';}?>>2026</option><option value="2027" <?php if ($_POST['ano']=='2027') { echo 'selected';}?>>2027</option><option value="2028" <?php if ($_POST['ano']=='2028') { echo 'selected';}?>>2028</option><option value="2029" <?php if ($_POST['ano']=='2029') { echo 'selected';}?>>2029</option><option value="2030" <?php if ($_POST['ano']=='2030') { echo 'selected';}?>>2030</option>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Valor</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="valor" name="i1valor" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="valor" name="i2valor" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Meta</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="meta" name="i1meta" type="text" value="<?php echo $_POST['meta']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="meta" name="i2meta" type="text" value="<?php echo $_POST['meta']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Peso</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="peso" name="i1peso" type="text" value="<?php echo $_POST['peso']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="peso" name="i2peso" type="text" value="<?php echo $_POST['peso']; ?>" class="form-control number" /></div><div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/projeto_quadro/" class="btn btn-default">Cancelar</a>

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
