
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
<header class="panel-heading">Pesquisar Detalhes Tela Inicial</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/inicial_detalhes/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdinicio_detalhe" name="i1cdinicio_detalhe" type="text" value="<?php echo $_POST['cdinicio_detalhe']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdinicio_detalhe" name="i2cdinicio_detalhe" type="text" value="<?php echo $_POST['cdinicio_detalhe']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Inicio</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdinicio" name="m3cdinicio[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_inicial[1])) { $ch=' selected="selected" '; }

 foreach ($view_inicial as $inicial) {
  echo '<option value="'.$inicial['cdinicio'].'"'.$ch.'>'.$inicial['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Ordem</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="ordem" name="i1ordem" type="text" value="<?php echo $_POST['ordem']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="ordem" name="i2ordem" type="text" value="<?php echo $_POST['ordem']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Largura</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="largura" name="s0largura" type="text" value="<?php echo $_POST['largura']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Largura"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Altura</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="altura" name="s0altura" type="text" value="<?php echo $_POST['altura']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Altura"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Modulo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdmodulo" name="m3cdmodulo[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_modulos[1])) { $ch=' selected="selected" '; }

 foreach ($view_modulos as $modulos) {
  echo '<option value="'.$modulos['cdmodulo'].'"'.$ch.'>'.$modulos['texto'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/inicial_detalhes/" class="btn btn-default">Cancelar</a>

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
