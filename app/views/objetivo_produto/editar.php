
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
<header class="panel-heading">Editar Objetivos do Produto</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/objetivo_produto/atualiza/id/<?php echo $view_objetivo_produto[0]['cdobjetivo_produto'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdobjetivo_informacao') ? "style='display:none'" : "" )?>>
<label  class="control-label">Objetivo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdobjetivo_informacao" name="cdobjetivo_informacao" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_objetivo_produto[0]['cdobjetivo_informacao'] ) : ( $_POST['cdobjetivo_informacao'] ); 

 foreach ($view_objetivo_informacao as $objetivo_informacao) {
   $ch=""; 
  if ($vmarcado==$objetivo_informacao['cdobjetivo_informacao']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$objetivo_informacao['cdobjetivo_informacao'].'"'.$ch.'>'.$objetivo_informacao['logica'].''.' - '.$objetivo_informacao['tipo'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdproduto') ? "style='display:none'" : "" )?>>
<label  class="control-label">Produto</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdproduto" name="cdproduto" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_objetivo_produto[0]['cdproduto'] ) : ( $_POST['cdproduto'] ); 

 foreach ($view_produtos as $produtos) {
   $ch=""; 
  if ($vmarcado==$produtos['cdproduto']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$produtos['cdproduto'].'"'.$ch.'>'.$produtos['logica'].''.' - '.$produtos['tipo'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'peso') ? "style='display:none'" : "" )?>>
<label  class="control-label">Peso</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="peso" name="peso" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_objetivo_produto[0]['peso'] ) : ( $_POST['peso'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Peso" data-parsley-type="digits"/></div></div>
</div></div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/objetivo_produto/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/objetivo_produto/exclui/id/<?php echo $view_objetivo_produto[0]['cdobjetivo_produto'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
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
