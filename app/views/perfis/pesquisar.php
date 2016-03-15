
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
<header class="panel-heading">Pesquisar Perfis/Usuários</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/perfis/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdperfil" name="i1cdperfil" type="text" value="<?php echo $_POST['cdperfil']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdperfil" name="i2cdperfil" type="text" value="<?php echo $_POST['cdperfil']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Cliente</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdcliente" name="m3cdcliente[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_clientes[1])) { $ch=' selected="selected" '; }

 foreach ($view_clientes as $clientes) {
  echo '<option value="'.$clientes['cdcliente'].'"'.$ch.'>'.$clientes['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="descricao" name="s0descricao" type="text" value="<?php echo $_POST['descricao']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Descrição"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Tipomenu</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="tipomenu" name="m3tipomenu[]" multiple>
  <option value=""></option><option value="Lateral" <?php if ($_POST['tipomenu']=='Lateral') { echo 'selected';}?>>Lateral</option><option value="
Lateral Minimizado" <?php if ($_POST['tipomenu']=='
Lateral Minimizado') { echo 'selected';}?>>
Lateral Minimizado</option><option value="
Horizontal" <?php if ($_POST['tipomenu']=='
Horizontal') { echo 'selected';}?>>
Horizontal</option>
 </select></div></div>
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

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/perfis/" class="btn btn-default">Cancelar</a>

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
