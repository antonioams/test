
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
<header class="panel-heading">Editar Valores Alvo Estratégico</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/alvo_informacao_ano/atualiza/id/<?php echo $view_alvo_informacao_ano[0]['cdalvo_informacao_ano'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdalvo') ? "style='display:none'" : "" )?>>
<label  class="control-label">Alvo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdalvo" name="cdalvo" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_alvo_informacao_ano[0]['cdalvo'] ) : ( $_POST['cdalvo'] ); 

 foreach ($view_alvo as $alvo) {
   $ch=""; 
  if ($vmarcado==$alvo['cdalvo']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$alvo['cdalvo'].'"'.$ch.'>'.$alvo['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdalvo_informacao') ? "style='display:none'" : "" )?>>
<label  class="control-label">Alvo Informacao</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdalvo_informacao" name="cdalvo_informacao" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_alvo_informacao_ano[0]['cdalvo_informacao'] ) : ( $_POST['cdalvo_informacao'] ); 

 foreach ($view_alvo_informacao as $alvo_informacao) {
   $ch=""; 
  if ($vmarcado==$alvo_informacao['cdalvo_informacao']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$alvo_informacao['cdalvo_informacao'].'"'.$ch.'>'.$alvo_informacao['logica'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'ano') ? "style='display:none'" : "" )?>>
<label  class="control-label">Ano</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="ano" name="ano" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_alvo_informacao_ano[0]['ano'] ) : ( $_POST['ano'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Ano" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'meta') ? "style='display:none'" : "" )?>>
<label  class="control-label">Meta</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="meta" name="meta" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_alvo_informacao_ano[0]['meta'] ) : ( $_POST['meta'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Meta"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'valor') ? "style='display:none'" : "" )?>>
<label  class="control-label">Valor</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="valor" name="valor" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_alvo_informacao_ano[0]['valor'] ) : ( $_POST['valor'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Valor"/></div></div>
</div></div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/alvo_informacao_ano/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/alvo_informacao_ano/exclui/id/<?php echo $view_alvo_informacao_ano[0]['cdalvo_informacao_ano'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
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
