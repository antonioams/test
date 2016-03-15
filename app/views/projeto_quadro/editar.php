
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
<header class="panel-heading">Editar Valores dos Projetos</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/projeto_quadro/atualiza/id/<?php echo $view_projeto_quadro[0]['cdquadro_valor'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
<div class="form-group" style='display:none'>
<label  class="control-label">Quadro_logico</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdquadro_logico" name="cdquadro_logico" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['cdquadro_logico'] ) : ( $_POST['cdquadro_logico'] ); 

 foreach ($view_quadro_logico as $quadro_logico) {
   $ch=""; 
  if ($vmarcado==$quadro_logico['cdquadro_logico']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$quadro_logico['cdquadro_logico'].'"'.$ch.'>'.$quadro_logico['logica'].''.' - '.$quadro_logico['tipo'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Projeto</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdprojeto" name="cdprojeto" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['cdprojeto'] ) : ( $_POST['cdprojeto'] ); 

 foreach ($view_projetos as $projetos) {
   $ch=""; 
  if ($vmarcado==$projetos['cdprojeto']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$projetos['cdprojeto'].'"'.$ch.'>'.$projetos['intervencao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Ano</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="ano" name="ano" data-parsley-trigger="change">
  <option value=""></option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['ano'] ) : ( $_POST['ano'] ); ?> 
         <option value="2014" <?php if ($vmarcado=='2014') { echo 'selected';}?>>2014</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['ano'] ) : ( $_POST['ano'] ); ?> 
         <option value="2015" <?php if ($vmarcado=='2015') { echo 'selected';}?>>2015</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['ano'] ) : ( $_POST['ano'] ); ?> 
         <option value="2016" <?php if ($vmarcado=='2016') { echo 'selected';}?>>2016</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['ano'] ) : ( $_POST['ano'] ); ?> 
         <option value="2017" <?php if ($vmarcado=='2017') { echo 'selected';}?>>2017</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['ano'] ) : ( $_POST['ano'] ); ?> 
         <option value="2018" <?php if ($vmarcado=='2018') { echo 'selected';}?>>2018</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['ano'] ) : ( $_POST['ano'] ); ?> 
         <option value="2019" <?php if ($vmarcado=='2019') { echo 'selected';}?>>2019</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['ano'] ) : ( $_POST['ano'] ); ?> 
         <option value="2020" <?php if ($vmarcado=='2020') { echo 'selected';}?>>2020</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['ano'] ) : ( $_POST['ano'] ); ?> 
         <option value="2021" <?php if ($vmarcado=='2021') { echo 'selected';}?>>2021</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['ano'] ) : ( $_POST['ano'] ); ?> 
         <option value="2022" <?php if ($vmarcado=='2022') { echo 'selected';}?>>2022</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['ano'] ) : ( $_POST['ano'] ); ?> 
         <option value="2023" <?php if ($vmarcado=='2023') { echo 'selected';}?>>2023</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['ano'] ) : ( $_POST['ano'] ); ?> 
         <option value="2024" <?php if ($vmarcado=='2024') { echo 'selected';}?>>2024</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['ano'] ) : ( $_POST['ano'] ); ?> 
         <option value="2025" <?php if ($vmarcado=='2025') { echo 'selected';}?>>2025</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['ano'] ) : ( $_POST['ano'] ); ?> 
         <option value="2026" <?php if ($vmarcado=='2026') { echo 'selected';}?>>2026</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['ano'] ) : ( $_POST['ano'] ); ?> 
         <option value="2027" <?php if ($vmarcado=='2027') { echo 'selected';}?>>2027</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['ano'] ) : ( $_POST['ano'] ); ?> 
         <option value="2028" <?php if ($vmarcado=='2028') { echo 'selected';}?>>2028</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['ano'] ) : ( $_POST['ano'] ); ?> 
         <option value="2029" <?php if ($vmarcado=='2029') { echo 'selected';}?>>2029</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['ano'] ) : ( $_POST['ano'] ); ?> 
         <option value="2030" <?php if ($vmarcado=='2030') { echo 'selected';}?>>2030</option>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Valor</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="valor" name="valor" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['valor'] ) : ( $_POST['valor'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Valor" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Meta</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="meta" name="meta" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['meta'] ) : ( $_POST['meta'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Meta" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Peso</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="peso" name="peso" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_projeto_quadro[0]['peso'] ) : ( $_POST['peso'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Peso" data-parsley-type="digits"/></div></div>
</div></div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/projeto_quadro/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/projeto_quadro/exclui/id/<?php echo $view_projeto_quadro[0]['cdquadro_valor'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
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
