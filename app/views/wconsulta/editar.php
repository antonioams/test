
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
<header class="panel-heading">Editar Saídas</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/wconsulta/atualiza/id/<?php echo $view_wconsulta[0]['cdconsulta'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdsaida') ? "style='display:none'" : "" )?>>
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="cdsaida" name="cdsaida" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_wconsulta[0]['cdsaida'] ) : ( $_POST['cdsaida'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Código" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdcampo') ? "style='display:none'" : "" )?>>
<label  class="control-label">Campo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdcampo" name="cdcampo" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_wconsulta[0]['cdcampo'] ) : ( $_POST['cdcampo'] ); 

 foreach ($view_usuarios as $usuarios) {
   $ch=""; 
  if ($vmarcado==$usuarios['cdcampo']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$usuarios['cdcampo'].'"'.$ch.'>'.$usuarios['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'tipo') ? "style='display:none'" : "" )?>>
<label  class="control-label">Tipo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="tipo" name="tipo" data-parsley-trigger="change">
  <option value=""></option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_wconsulta[0]['tipo'] ) : ( $_POST['tipo'] ); ?> 
         <option value="selecionar" <?php if ($vmarcado=='selecionar') { echo 'selected';}?>>selecionar</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_wconsulta[0]['tipo'] ) : ( $_POST['tipo'] ); ?> 
         <option value="somar" <?php if ($vmarcado=='somar') { echo 'selected';}?>>somar</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_wconsulta[0]['tipo'] ) : ( $_POST['tipo'] ); ?> 
         <option value="quantificar" <?php if ($vmarcado=='quantificar') { echo 'selected';}?>>quantificar</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_wconsulta[0]['tipo'] ) : ( $_POST['tipo'] ); ?> 
         <option value="
maior valor" <?php if ($vmarcado=='
maior valor') { echo 'selected';}?>>
maior valor</option><?php $vmarcado = ( empty( $_POST ) ) ? ( $view_wconsulta[0]['tipo'] ) : ( $_POST['tipo'] ); ?> 
         <option value="menor valor" <?php if ($vmarcado=='menor valor') { echo 'selected';}?>>menor valor</option>
 </select></div></div>
</div></div>

<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Chave</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="chave" value="1" <?php if ($view_wconsulta[0]['chave']==1) { echo 'checked';} ?>>
       </div>
      </div>
</div>

<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Visualiza</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="visualiza" value="1" <?php if ($view_wconsulta[0]['visualiza']==1) { echo 'checked';} ?>>
       </div>
      </div>
</div>

<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Totaliza</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="totaliza" value="1" <?php if ($view_wconsulta[0]['totaliza']==1) { echo 'checked';} ?>>
       </div>
      </div>
</div>

<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Rotulo</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="rotulo" value="1" <?php if ($view_wconsulta[0]['rotulo']==1) { echo 'checked';} ?>>
       </div>
      </div>
</div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/wconsulta/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/wconsulta/exclui/id/<?php echo $view_wconsulta[0]['cdconsulta'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
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
