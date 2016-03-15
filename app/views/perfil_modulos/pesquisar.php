
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
<header class="panel-heading">Pesquisar Módulos do Perfil</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/perfil_modulos/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdperfil_modulo" name="i1cdperfil_modulo" type="text" value="<?php echo $_POST['cdperfil_modulo']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdperfil_modulo" name="i2cdperfil_modulo" type="text" value="<?php echo $_POST['cdperfil_modulo']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Perfil</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdperfil" name="i1cdperfil" type="text" value="<?php echo $_POST['cdperfil']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdperfil" name="i2cdperfil" type="text" value="<?php echo $_POST['cdperfil']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Modulo</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdmodulo" name="i1cdmodulo" type="text" value="<?php echo $_POST['cdmodulo']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdmodulo" name="i2cdmodulo" type="text" value="<?php echo $_POST['cdmodulo']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Visualizar</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="visualizar" name="i1visualizar" type="text" value="<?php echo $_POST['visualizar']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="visualizar" name="i2visualizar" type="text" value="<?php echo $_POST['visualizar']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Editar</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="editar" name="i1editar" type="text" value="<?php echo $_POST['editar']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="editar" name="i2editar" type="text" value="<?php echo $_POST['editar']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Inserir</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="inserir" name="i1inserir" type="text" value="<?php echo $_POST['inserir']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="inserir" name="i2inserir" type="text" value="<?php echo $_POST['inserir']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Excluir</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="excluir" name="i1excluir" type="text" value="<?php echo $_POST['excluir']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="excluir" name="i2excluir" type="text" value="<?php echo $_POST['excluir']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Pesquisar</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="pesquisar" name="i1pesquisar" type="text" value="<?php echo $_POST['pesquisar']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="pesquisar" name="i2pesquisar" type="text" value="<?php echo $_POST['pesquisar']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Inserir_mtp</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="inserir_mtp" name="i1inserir_mtp" type="text" value="<?php echo $_POST['inserir_mtp']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="inserir_mtp" name="i2inserir_mtp" type="text" value="<?php echo $_POST['inserir_mtp']; ?>" class="form-control number" /></div><div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/perfil_modulos/" class="btn btn-default">Cancelar</a>

 </form>
  </div>
 </section>
 </div>
<?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }  ?> 
<?php include('app/views/rodape.php'); ?>
