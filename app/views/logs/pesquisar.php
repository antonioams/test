
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
<header class="panel-heading">Pesquisar Logs de Acesso</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/logs/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>


<div class="form-group">
<label  class="control-label">Usuario</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdusuario" name="m3cdusuario[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_usuarios[1])) { $ch=' selected="selected" '; }

 foreach ($view_usuarios as $usuarios) {
  echo '<option value="'.$usuarios['cdusuario'].'"'.$ch.'>'.$usuarios['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Data</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="data" name="d1data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Data"/></div></div>
<div class="row"><div class="col-xs-4"><input id="data" name="d2data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Data"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Entidade</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="entidade" name="s0entidade" type="text" value="<?php echo $_POST['entidade']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Entidade"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Operacao</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="operacao" name="s0operacao" type="text" value="<?php echo $_POST['operacao']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Operacao"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Dados</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<div class="row"><div class="col-xs-12"><input id="dados" name="s0dados" type="text" value="<?php echo $_POST['dados']; ?>" class="form-control" /></div></div>
</div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/logs/" class="btn btn-default">Cancelar</a>

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
