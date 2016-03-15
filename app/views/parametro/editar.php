
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
<header class="panel-heading">Editar Parâmetro</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/parametro/atualiza/id/<?php echo $view_parametro[0]['cdparametro'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
<div class="form-group" style='display:none'>
<label  class="control-label">Consulta</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdconsulta" name="cdconsulta" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_parametro[0]['cdconsulta'] ) : ( $_POST['cdconsulta'] ); 

 foreach ($view_consultas as $consultas) {
   $ch=""; 
  if ($vmarcado==$consultas['cdconsulta']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$consultas['cdconsulta'].'"'.$ch.'>'.$consultas['titulo'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Campo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdcampo" name="cdcampo" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( $view_parametro[0]['cdcampo']!='' ) ? ( $view_parametro[0]['cdcampo'] ) : ( $view_parametro[0]['questionario'] ); 

 foreach ($view_campos as $campos) {
   $ch=""; 
   if ($campos['cdcampo']!='') {$vl=$campos['cdcampo'];} else {$vl=$campos['questionario'];}
  if ($vmarcado==$vl) { $ch=' selected="selected" '; } 
  echo '<option value="'.$campos['cdcampo'].'"'.$ch.'>'.$campos['legendaentidade'].' - '.$campos['legendacampo'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Condicao</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="condicao" name="condicao" data-parsley-trigger="change">
  <option value=""></option>
  <?php $vmarcado = ( empty( $_POST ) ) ? ( $view_parametro[0]['condicao'] ) : ( $_POST['condicao'] ); ?> 
  <option value=""></option>
  <option value="igual" <?php if ($vmarcado=='igual') { echo 'selected';}?>>igual</option>
  <option value="maior" <?php if ($vmarcado=='maior') { echo 'selected';}?>>maior</option>  
  <option value="menor" <?php if ($vmarcado=='menor') { echo 'selected';}?>>menor</option>
  <option value="maior ou igual" <?php if ($vmarcado=='maior ou igual') { echo 'selected';}?>>maior ou igual</option>
  <option value="menor ou igual" <?php if ($vmarcado=='menor ou igual') { echo 'selected';}?>>menor ou igual</option>
  <option value="contenha" <?php if ($vmarcado=='contenha') { echo 'selected';}?>>contenha</option>
  <option value="esteja em" <?php if ($vmarcado=='esteja em') { echo 'selected';}?>>esteja em</option>
  <option value="não esteja em" <?php if ($vmarcado=='não esteja em') { echo 'selected';}?>>não esteja em</option>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Valor pré-informado</label>
<div class="controls">
<div class="row"><div class="col-xs-5"><input id="valor" name="valor" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_parametro[0]['valor'] ) : ( $_POST['valor'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Valor"/></div></div>
</div></div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/parametro/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/parametro/exclui/id/<?php echo $view_parametro[0]['cdparametro'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
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
