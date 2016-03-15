
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
<header class="panel-heading">Pesquisar G. Questionários</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/grupos/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdgrupo" name="i1cdgrupo" type="text" value="<?php echo $_POST['cdgrupo']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdgrupo" name="i2cdgrupo" type="text" value="<?php echo $_POST['cdgrupo']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="descricao" name="s0descricao" type="text" value="<?php echo $_POST['descricao']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Descrição"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Tipo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdtipo" name="m3cdtipo[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_tipos[1])) { $ch=' selected="selected" '; }

 foreach ($view_tipos as $tipos) {
  echo '<option value="'.$tipos['cdtipo'].'"'.$ch.'>'.$tipos['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/grupos/" class="btn btn-default">Cancelar</a>

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
