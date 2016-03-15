
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
<header class="panel-heading">Editar Áreas</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/areas/atualiza/id/<?php echo $view_areas[0]['cdarea'];?>" role="form" method="post" name="formeditar" enctype="multipart/form-data" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Nome</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="nome" name="nome" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_areas[0]['nome'] ) : ( $_POST['nome'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Nome"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="descricao" name="descricao" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_areas[0]['descricao'] ) : ( $_POST['descricao'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Descrição"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Icone</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
	<img class="avatar avatar-lg img-thumbnail" src="/<?php echo PROJETO?>/inc/img/area/a<?php echo $view_areas[0]['cdarea']?>.png"> <br>
	<input id="icone" name="icone" type="file" value="<?php echo ( empty( $_POST ) ) ? ( $view_areas[0]['icone'] ) : ( $_POST['icone'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Icone"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Icone_mapa</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
	<img class="avatar avatar-lg img-thumbnail" src="/<?php echo PROJETO?>/inc/img/area/mapa<?php echo $view_areas[0]['cdarea']?>.png"> <br>
	<input id="icone_mapa" name="icone_mapa" type="file" value="<?php echo ( empty( $_POST ) ) ? ( $view_areas[0]['icone_mapa'] ) : ( $_POST['icone_mapa'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Icone_mapa"/></div></div>
</div></div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/areas/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/areas/exclui/id/<?php echo $view_areas[0]['cdarea'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
                    Excluir</a>
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
