
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
<header class="panel-heading">Editar Objetivos</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/objetivo_informacao/atualiza/id/<?php echo $view_objetivo_informacao[0]['cdobjetivo_informacao'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'logica') ? "style='display:none'" : "" )?>>
<label  class="control-label">Lógica</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="logica" name="logica" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_objetivo_informacao[0]['logica'] ) : ( $_POST['logica'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Lógica"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdalvo') ? "style='display:none'" : "" )?>>
<label  class="control-label">Alvo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdalvo" name="cdalvo[]" data-parsley-trigger="change"  multiple>
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( explode( ',' ,  $view_objetivo_informacao[0]['cdalvo'] ) ) : ( $_POST['cdalvo'] ); 

 foreach ($view_alvo as $alvo) {
   $ch=""; 
     
  if (in_array($alvo['cdalvo'],$vmarcado)) { $ch=' selected="selected" '; } 
  echo '<option value="'.$alvo['cdalvo'].'"'.$ch.'>'.$alvo['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'tipo') ? "style='display:none'" : "" )?>>
<label  class="control-label">Tipo</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="tipo" name="tipo" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_objetivo_informacao[0]['tipo'] ) : ( $_POST['tipo'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Tipo"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'indicador') ? "style='display:none'" : "" )?>>
<label  class="control-label">Indicador</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="indicador" name="indicador" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_objetivo_informacao[0]['indicador'] ) : ( $_POST['indicador'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Indicador"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'formula') ? "style='display:none'" : "" )?>>
<label  class="control-label">Fórmula</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="formula" name="formula" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_objetivo_informacao[0]['formula'] ) : ( $_POST['formula'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Fórmula"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'fonte') ? "style='display:none'" : "" )?>>
<label  class="control-label">Fonte</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="fonte" rows="4"><?php echo ( empty( $_POST ) ) ? ( $view_objetivo_informacao[0]['fonte'] ) : ( $_POST['fonte'] ) ?></textarea>
</div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'descricao_indicador') ? "style='display:none'" : "" )?>>
<label  class="control-label">Descrição do Indicador</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="descricao_indicador" rows="4"><?php echo ( empty( $_POST ) ) ? ( $view_objetivo_informacao[0]['descricao_indicador'] ) : ( $_POST['descricao_indicador'] ) ?></textarea>
</div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdprograma') ? "style='display:none'" : "" )?>>
<label  class="control-label">Programa</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdprograma" name="cdprograma" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_objetivo_informacao[0]['cdprograma'] ) : ( $_POST['cdprograma'] ); 

 foreach ($view_programas as $programas) {
   $ch=""; 
  if ($vmarcado==$programas['cdprograma']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$programas['cdprograma'].'"'.$ch.'>'.$programas['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'meta') ? "style='display:none'" : "" )?>>
<label  class="control-label">Meta</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="meta" name="meta" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_objetivo_informacao[0]['meta'] ) : ( $_POST['meta'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Meta" data-parsley-type="digits"/></div></div>
</div></div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/objetivo_informacao/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/objetivo_informacao/exclui/id/<?php echo $view_objetivo_informacao[0]['cdobjetivo_informacao'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
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
