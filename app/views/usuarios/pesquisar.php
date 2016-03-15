
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
<header class="panel-heading">Pesquisar Usuários</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/usuarios/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdusuario" name="i1cdusuario" type="text" value="<?php echo $_POST['cdusuario']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdusuario" name="i2cdusuario" type="text" value="<?php echo $_POST['cdusuario']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Perfil</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdperfil" name="m3cdperfil[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_perfis[1])) { $ch=' selected="selected" '; }

 foreach ($view_perfis as $perfis) {
  echo '<option value="'.$perfis['cdperfil'].'"'.$ch.'>'.$perfis['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Nome</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="nome" name="s0nome" type="text" value="<?php echo $_POST['nome']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Nome"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Login</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="login" name="s0login" type="text" value="<?php echo $_POST['login']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Login"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Senha</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="senha" name="s0senha" type="text" value="<?php echo $_POST['senha']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Senha"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Email</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="email" name="s0email" type="text" value="<?php echo $_POST['email']; ?>" class="form-control" /></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Ativo</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="ativo" name="s0ativo" type="text" value="<?php echo $_POST['ativo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Ativo"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Setor</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdunidade" name="m3cdunidade[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_unidades[1])) { $ch=' selected="selected" '; }

 foreach ($view_unidades as $unidades) {
  echo '<option value="'.$unidades['cdunidade'].'"'.$ch.'>'.$unidades['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/usuarios/" class="btn btn-default">Cancelar</a>

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
