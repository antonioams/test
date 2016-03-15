
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
<header class="panel-heading">Editar Detalhes Tela Inicial</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/inicial_detalhes/atualiza/id/<?php echo $view_inicial_detalhes[0]['cdinicio_detalhe'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Inicio</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdinicio" name="cdinicio" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_inicial_detalhes[0]['cdinicio'] ) : ( $_POST['cdinicio'] ); 

 foreach ($view_inicial as $inicial) {
   $ch=""; 
  if ($vmarcado==$inicial['cdinicio']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$inicial['cdinicio'].'"'.$ch.'>'.$inicial['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Ordem</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="ordem" name="ordem" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_inicial_detalhes[0]['ordem'] ) : ( $_POST['ordem'] ) ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Ordem" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Largura</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="largura" name="largura" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_inicial_detalhes[0]['largura'] ) : ( $_POST['largura'] ) ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Largura"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Altura</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="altura" name="altura" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_inicial_detalhes[0]['altura'] ) : ( $_POST['altura'] ) ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Altura"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Modulo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdmodulo" name="cdmodulo" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_inicial_detalhes[0]['cdmodulo'] ) : ( $_POST['cdmodulo'] ); 

 foreach ($view_modulos as $modulos) {
   $ch=""; 
  if ($vmarcado==$modulos['cdmodulo']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$modulos['cdmodulo'].'"'.$ch.'>'.$modulos['texto'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/inicial_detalhes/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/inicial_detalhes/exclui/id/<?php echo $view_inicial_detalhes[0]['cdinicio_detalhe'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
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
