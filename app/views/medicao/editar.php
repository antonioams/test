
<?php
include('app/views/topo.php');
echo '
    <script src="/'.PROJETO.'/inc/plugins/jquery-1.11.1.min.js"></script>
    <script src="/'.PROJETO.'/inc/js/jquery.maskMoney.js"></script>';
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
<header class="panel-heading">Editar Itens da Medição</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/medicao/atualiza/id/<?php echo $view_medicao[0]['cdmedicao'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdcontrato_item') ? "style='display:none'" : "" )?>>
<label  class="control-label">Contrato Item</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdcontrato_item" name="cdcontrato_item" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_medicao[0]['cdcontrato_item'] ) : ( $_POST['cdcontrato_item'] ); 

 foreach ($view_contrato_item as $contrato_item) {
   $ch=""; 
  if ($vmarcado==$contrato_item['cdcontrato_item']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$contrato_item['cdcontrato_item'].'"'.$ch.'>'.$contrato_item['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdgrupomedicao') ? "style='display:none'" : "" )?>>
<label  class="control-label">Medição</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdgrupomedicao" name="cdgrupomedicao" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_medicao[0]['cdgrupomedicao'] ) : ( $_POST['cdgrupomedicao'] ); 

 foreach ($view_grupomedicao as $grupomedicao) {
   $ch=""; 
  if ($vmarcado==$grupomedicao['cdgrupomedicao']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$grupomedicao['cdgrupomedicao'].'"'.$ch.'>'.$grupomedicao['numero'].''.' - '.$grupomedicao['data'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'quantidade') ? "style='display:none'" : "" )?>>
<label  class="control-label">Quantidade</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="quantidade" name="quantidade" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_medicao[0]['quantidade'] ) : ( $_POST['quantidade'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Quantidade"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'valor') ? "style='display:none'" : "" )?>>
<label  class="control-label">Valor</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="valor" name="valor" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_medicao[0]['valor'] ) : ( $_POST['valor'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Valor"/></div></div>
</div></div>
<script type="text/javascript">$("#valor").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'', decimal:',', affixesStay: false});</script>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'nf') ? "style='display:none'" : "" )?>>
<label  class="control-label">NF</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="nf" name="nf" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_medicao[0]['nf'] ) : ( $_POST['nf'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="NF"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'ne') ? "style='display:none'" : "" )?>>
<label  class="control-label">NE</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="ne" name="ne" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_medicao[0]['ne'] ) : ( $_POST['ne'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="NE"/></div></div>
</div></div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/medicao/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/medicao/exclui/id/<?php echo $view_medicao[0]['cdmedicao'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
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
