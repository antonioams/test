
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
<header class="panel-heading">Editar Campos do Documento</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/documento_campos/atualiza/id/<?php echo $view_documento_campos[0]['cdcampo'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cddocumento') ? "style='display:none'" : "" )?>>
<label  class="control-label">Documento</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cddocumento" name="cddocumento" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_documento_campos[0]['cddocumento'] ) : ( $_POST['cddocumento'] ); 

 foreach ($view_documentos as $documentos) {
   $ch=""; 
  if ($vmarcado==$documentos['cddocumento']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$documentos['cddocumento'].'"'.$ch.'>'.$documentos['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'descricao') ? "style='display:none'" : "" )?>>
<label  class="control-label">Campo</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="descricao" name="descricao" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_documento_campos[0]['descricao'] ) : ( $_POST['descricao'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Campo"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'tipo') ? "style='display:none'" : "" )?>>
<label  class="control-label">Tipo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="tipo" name="tipo" data-parsley-trigger="change">
  <option value=""></option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_documento_campos[0]['tipo'] ) : ( $_POST['tipo'] ); ?> 
         <option value="NUMERO" <?php if ($vmarcado=='NUMERO') { echo 'selected';}?>>NUMERO</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_documento_campos[0]['tipo'] ) : ( $_POST['tipo'] ); ?> 
         <option value="DATA" <?php if ($vmarcado=='DATA') { echo 'selected';}?>>DATA</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_documento_campos[0]['tipo'] ) : ( $_POST['tipo'] ); ?> 
         <option value="TEXTO" <?php if ($vmarcado=='TEXTO') { echo 'selected';}?>>TEXTO</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_documento_campos[0]['tipo'] ) : ( $_POST['tipo'] ); ?> 
         <option value="ANEXO" <?php if ($vmarcado=='ANEXO') { echo 'selected';}?>>ANEXO</option>
 </select></div></div>
</div></div>

<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Obrigatorio</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="obrigatorio" value="1" <?php if ($view_documento_campos[0]['obrigatorio']==1) { echo 'checked';} ?>>
       </div>
      </div>
</div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/documento_campos/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/documento_campos/exclui/id/<?php echo $view_documento_campos[0]['cdcampo'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
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
