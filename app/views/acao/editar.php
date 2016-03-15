
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
<header class="panel-heading">Editar Ocorrências</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/acao/atualiza/id/<?php echo $view_acao[0]['cdacao'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Tipo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="tipo" name="tipo" data-parsley-trigger="change">
  <option value=""></option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_acao[0]['tipo'] ) : ( $_POST['tipo'] ); ?> 
         <option value="REUNIÃO" <?php if ($vmarcado=='REUNIÃO') { echo 'selected';}?>>REUNIÃO</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_acao[0]['tipo'] ) : ( $_POST['tipo'] ); ?> 
         <option value="
PROBLEMA" <?php if ($vmarcado=='
PROBLEMA') { echo 'selected';}?>>
PROBLEMA</option>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="descricao" rows="4"><?php echo ( empty( $_POST ) ) ? ( $view_acao[0]['descricao'] ) : ( $_POST['descricao'] ) ?></textarea>
</div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Status</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="status" name="status" data-parsley-trigger="change">
  <option value=""></option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_acao[0]['status'] ) : ( $_POST['status'] ); ?> 
         <option value="1" <?php if ($vmarcado=='1') { echo 'selected';}?>>PENDENTE</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_acao[0]['status'] ) : ( $_POST['status'] ); ?> 
         <option value="
2" <?php if ($vmarcado=='
2') { echo 'selected';}?>>CONCLUÍDO</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_acao[0]['status'] ) : ( $_POST['status'] ); ?> 
         <option value="
3" <?php if ($vmarcado=='
3') { echo 'selected';}?>>AGUARDANDO TERCEIRO</option>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Data</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="date" name="data" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_acao[0]['data'] ) : ( $_POST['data'] ) ?>" class="form-control" placeholder="99/99/9999" data-parsley-trigger="change"/></div></div>
</div></div>

<div class="form-group" style='display:none'>
<label  class="control-label">Projeto</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdprojeto" name="cdprojeto" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_acao[0]['cdprojeto'] ) : ( $_POST['cdprojeto'] ); 

 foreach ($view_projetos as $projetos) {
   $ch=""; 
  if ($vmarcado==$projetos['cdprojeto']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$projetos['cdprojeto'].'"'.$ch.'>'.$projetos['intervencao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/acao/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/acao/exclui/id/<?php echo $view_acao[0]['cdacao'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
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
