
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
<header class="panel-heading">Pesquisar Itens do Quadro Lógico</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/wquadro/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdquadro_logico" name="i1cdquadro_logico" type="text" value="<?php echo $_POST['cdquadro_logico']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdquadro_logico" name="i2cdquadro_logico" type="text" value="<?php echo $_POST['cdquadro_logico']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Lógica</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="logica" name="s0logica" type="text" value="<?php echo $_POST['logica']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Lógica"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Tipo</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="tipo" name="s0tipo" type="text" value="<?php echo $_POST['tipo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Tipo"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Indicador</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="indicador" name="s0indicador" type="text" value="<?php echo $_POST['indicador']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Indicador"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Fórmula</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="formula" name="s0formula" type="text" value="<?php echo $_POST['formula']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Fórmula"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Fontes</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<div class="row"><div class="col-xs-12"><input id="fonte" name="s0fonte" type="text" value="<?php echo $_POST['fonte']; ?>" class="form-control" /></div></div>
</div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Descrição do Indiciador</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<div class="row"><div class="col-xs-12"><input id="descricao_indicador" name="s0descricao_indicador" type="text" value="<?php echo $_POST['descricao_indicador']; ?>" class="form-control" /></div></div>
</div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Area</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdarea" name="m3cdarea[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_areas[1])) { $ch=' selected="selected" '; }

 foreach ($view_areas as $areas) {
  echo '<option value="'.$areas['cdarea'].'"'.$ch.'>'.$areas['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Nivel</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdnivel" name="m3cdnivel[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_niveis[1])) { $ch=' selected="selected" '; }

 foreach ($view_niveis as $niveis) {
  echo '<option value="'.$niveis['cdnivel'].'"'.$ch.'>'.$niveis['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Quadro Lógico</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdquadro" name="m3cdquadro[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_quadro[1])) { $ch=' selected="selected" '; }

 foreach ($view_quadro as $quadro) {
  echo '<option value="'.$quadro['cdquadro'].'"'.$ch.'>'.$quadro['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/wquadro/" class="btn btn-default">Cancelar</a>

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
