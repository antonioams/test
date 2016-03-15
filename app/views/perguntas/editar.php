
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
<header class="panel-heading">Editar Perguntas</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/perguntas/atualiza/id/<?php echo $view_perguntas[0]['cdpergunta'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Grupopergunta</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdgrupopergunta" name="cdgrupopergunta" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_perguntas[0]['cdgrupopergunta'] ) : ( $_POST['cdgrupopergunta'] ); 

 foreach ($view_grupopergunta as $grupopergunta) {
   $ch=""; 
  if ($vmarcado==$grupopergunta['cdgrupopergunta']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$grupopergunta['cdgrupopergunta'].'"'.$ch.'>'.$grupopergunta['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Tipo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="tipo" name="tipo" data-parsley-trigger="change">
  <option value=""></option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_perguntas[0]['tipo'] ) : ( $_POST['tipo'] ); ?> 
         <option value="TEXTO" <?php if ($vmarcado=='TEXTO') { echo 'selected';}?>>TEXTO</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_perguntas[0]['tipo'] ) : ( $_POST['tipo'] ); ?> 
         <option value="TEXTO LONGO" <?php if ($vmarcado=='TEXTO LONGO') { echo 'selected';}?>>TEXTO LONGO</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_perguntas[0]['tipo'] ) : ( $_POST['tipo'] ); ?> 
         <option value="DATA" <?php if ($vmarcado=='DATA') { echo 'selected';}?>>DATA</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_perguntas[0]['tipo'] ) : ( $_POST['tipo'] ); ?> 
         <option value="NUMERO" <?php if ($vmarcado=='NUMERO') { echo 'selected';}?>>NUMERO</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_perguntas[0]['tipo'] ) : ( $_POST['tipo'] ); ?> 
         <option value="LISTA" <?php if ($vmarcado=='LISTA') { echo 'selected';}?>>LISTA</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_perguntas[0]['tipo'] ) : ( $_POST['tipo'] ); ?> 
         <option value="LISTA MULTIPLA" <?php if ($vmarcado=='LISTA MULTIPLA') { echo 'selected';}?>>LISTA MULTIPLA</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_perguntas[0]['tipo'] ) : ( $_POST['tipo'] ); ?> 
         <option value="DOCUMENTO" <?php if ($vmarcado=='DOCUMENTO') { echo 'selected';}?>>DOCUMENTO</option>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="descricao" name="descricao" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_perguntas[0]['descricao'] ) : ( $_POST['descricao'] ) ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Descrição"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Ordem</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="ordem" name="ordem" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_perguntas[0]['ordem'] ) : ( $_POST['ordem'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Ordem" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Comentario</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="comentario" name="comentario" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_perguntas[0]['comentario'] ) : ( $_POST['comentario'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Comentario"/></div></div>
</div></div>

<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Ativo</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="ativo" value="1" <?php if ($view_perguntas[0]['ativo']==1) { echo 'checked';} ?>>
       </div>
      </div>
</div>

<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Visualiza</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="visualiza" value="1" <?php if ($view_perguntas[0]['visualiza']==1) { echo 'checked';} ?>>
       </div>
      </div>
</div>

<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Obrigatorio</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="obrigatorio" value="1" <?php if ($view_perguntas[0]['obrigatorio']==1) { echo 'checked';} ?>>
       </div>
      </div>
</div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/perguntas/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/perguntas/exclui/id/<?php echo $view_perguntas[0]['cdpergunta'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
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
