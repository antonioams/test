
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
<header class="panel-heading">Editar Movimentações</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/movimentacao/atualiza/id/<?php echo $view_movimentacao[0]['cdmovimentacao'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Unidade</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdunidade" name="cdunidade" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_movimentacao[0]['cdunidade'] ) : ( $_POST['cdunidade'] ); 

 foreach ($view_unidades as $unidades) {
   $ch=""; 
  if ($vmarcado==$unidades['cdunidade']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$unidades['cdunidade'].'"'.$ch.'>'.$unidades['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="descricao" rows="4"><?php echo ( empty( $_POST ) ) ? ( $view_movimentacao[0]['descricao'] ) : ( $_POST['descricao'] ) ?></textarea>
</div></div>
</div></div>

<div class="form-group" style='display:none'>
<label  class="control-label">Projeto</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdprojeto" name="cdprojeto" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_movimentacao[0]['cdprojeto'] ) : ( $_POST['cdprojeto'] ); 

 foreach ($view_projetos as $projetos) {
   $ch=""; 
  if ($vmarcado==$projetos['cdprojeto']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$projetos['cdprojeto'].'"'.$ch.'>'.$projetos['intervencao'].''.' - '.$projetos['objetivo'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/movimentacao/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/movimentacao/exclui/id/<?php echo $view_movimentacao[0]['cdmovimentacao'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
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
