
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
<header class="panel-heading">Editar Questionários</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/questionarios/atualiza/id/<?php echo $view_questionarios[0]['cdquestionario'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'descricao') ? "style='display:none'" : "" )?>>
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="descricao" name="descricao" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_questionarios[0]['descricao'] ) : ( $_POST['descricao'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Descrição"/></div></div>
</div></div>

<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Ativo</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="ativo" value="1" <?php if ($view_questionarios[0]['ativo']==1) { echo 'checked';} ?>>
       </div>
      </div>
</div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'ordem') ? "style='display:none'" : "" )?>>
<label  class="control-label">Ordem</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="ordem" name="ordem" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_questionarios[0]['ordem'] ) : ( $_POST['ordem'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Ordem" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdtipo') ? "style='display:none'" : "" )?>>
<label  class="control-label">Tipo de Projeto</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdtipo" name="cdtipo" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_questionarios[0]['cdtipo'] ) : ( $_POST['cdtipo'] ); 

 foreach ($view_tipos as $tipos) {
   $ch=""; 
  if ($vmarcado==$tipos['cdtipo']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$tipos['cdtipo'].'"'.$ch.'>'.$tipos['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/questionarios/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/questionarios/exclui/id/<?php echo $view_questionarios[0]['cdquestionario'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
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
