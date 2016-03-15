
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
<header class="panel-heading">Editar Perfis/Usuários</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/perfis/atualiza/id/<?php echo $view_perfis[0]['cdperfil'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
<div class="form-group" style='display:none'>
<label  class="control-label">Cliente</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdcliente" name="cdcliente" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_perfis[0]['cdcliente'] ) : ( $_POST['cdcliente'] ); 

 foreach ($view_clientes as $clientes) {
   $ch=""; 
  if ($vmarcado==$clientes['cdcliente']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$clientes['cdcliente'].'"'.$ch.'>'.$clientes['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="descricao" name="descricao" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_perfis[0]['descricao'] ) : ( $_POST['descricao'] ) ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Descrição"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Tipomenu</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="tipomenu" name="tipomenu" data-parsley-trigger="change">
  <option value=""></option>
  <?php $vmarcado = ( empty( $_POST ) ) ? ( $view_perfis[0]['tipomenu'] ) : ( $_POST['tipomenu'] ); ?> 
         <option value="Lateral" <?php if ($vmarcado=='Lateral') { echo 'selected';}?>>Lateral</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_perfis[0]['tipomenu'] ) : ( $_POST['tipomenu'] ); ?> 
         <option value="Lateral Minimizado" <?php if ($vmarcado=='Lateral Minimizado') { echo 'selected';}?>>Lateral Minimizado</option>
         <?php $vmarcado = ( empty( $_POST ) ) ? ( $view_perfis[0]['tipomenu'] ) : ( $_POST['tipomenu'] ); ?> 
         <option value="Horizontal" <?php if ($vmarcado=='Horizontal') { echo 'selected';}?>>Horizontal</option>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Inicio</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdinicio" name="cdinicio" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_perfis[0]['cdinicio'] ) : ( $_POST['cdinicio'] ); 

 foreach ($view_inicial as $inicial) {
   $ch=""; 
  if ($vmarcado==$inicial['cdinicio']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$inicial['cdinicio'].'"'.$ch.'>'.$inicial['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/perfis/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/perfis/exclui/id/<?php echo $view_perfis[0]['cdperfil'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
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
