
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
<header class="panel-heading">Pesquisar Medições</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/grupomedicao/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>

<div class="form-group">
<label  class="control-label">Contrato</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdcontrato" name="m3cdcontrato[]" multiple>
  <option value=""></option>
 <?php


 foreach ($view_contratos as $contratos) {
  echo '<option value="'.$contratos['cdcontrato'].'"'.$ch.'>'.$contratos['objeto'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Numero Medição</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="numero" name="s0numero" type="text" value="<?php echo $_POST['numero']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Numero"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Data</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="date" name="d1data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control " placeholder="99/99/9999"/></div>
<div class="col-xs-3"><input id="date" name="d2data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control " placeholder="99/99/9999"/></div></div>
</div></div>


<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/grupomedicao/" class="btn btn-default">Cancelar</a>

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
