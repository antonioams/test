
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
<header class="panel-heading">Editar Medições</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/grupomedicao/atualiza/id/<?php echo $view_grupomedicao[0]['cdgrupomedicao'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdcontrato') ? "style='display:none'" : "" )?>>
<label  class="control-label">Contrato</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdcontrato" name="cdcontrato" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_grupomedicao[0]['cdcontrato'] ) : ( $_POST['cdcontrato'] ); 

 foreach ($view_contratos as $contratos) {
   $ch=""; 
  if ($vmarcado==$contratos['cdcontrato']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$contratos['cdcontrato'].'"'.$ch.'>'.$contratos['objeto'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'numero') ? "style='display:none'" : "" )?>>
<label  class="control-label">Numero Medição</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="numero" name="numero" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_grupomedicao[0]['numero'] ) : ( $_POST['numero'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Numero"/></div></div>
</div></div>


<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'data') ? "style='display:none'" : "" )?>>
<label  class="control-label">Data</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="date" name="data" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_grupomedicao[0]['data'] ) : ( $_POST['data'] ) ?>" class="form-control" placeholder="99/99/9999" data-parsley-trigger="change"/></div></div>
</div></div>


<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/grupomedicao/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/grupomedicao/exclui/id/<?php echo $view_grupomedicao[0]['cdgrupomedicao'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
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
