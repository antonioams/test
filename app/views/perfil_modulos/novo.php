
<?php
include('app/views/topo.php');
?>
<div class="<?php echo $_SESSION[PROJETO]['mensagem']['tipo'];?>">
                                <?php
                                echo $_SESSION[PROJETO]['mensagem']['texto'];
                                unset( $_SESSION[PROJETO]['mensagem'] );?>
                            </div>
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
<header class="panel-heading">Cadastrar Novo Módulos do Perfil</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/perfil_modulos/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Perfil</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="cdperfil" name="cdperfil" type="text" value="<?php echo $_POST['cdperfil']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Perfil" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Modulo</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="cdmodulo" name="cdmodulo" type="text" value="<?php echo $_POST['cdmodulo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Modulo" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Visualizar</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="visualizar" name="visualizar" type="text" value="<?php echo $_POST['visualizar']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Visualizar" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Editar</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="editar" name="editar" type="text" value="<?php echo $_POST['editar']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Editar" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Inserir</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="inserir" name="inserir" type="text" value="<?php echo $_POST['inserir']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Inserir" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Excluir</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="excluir" name="excluir" type="text" value="<?php echo $_POST['excluir']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Excluir" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Pesquisar</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="pesquisar" name="pesquisar" type="text" value="<?php echo $_POST['pesquisar']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Pesquisar" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Inserir_mtp</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="inserir_mtp" name="inserir_mtp" type="text" value="<?php echo $_POST['inserir_mtp']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Inserir_mtp" data-parsley-type="digits"/></div></div>
</div></div>

<br>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/perfil_modulos/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>

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
