
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
<header class="panel-heading">Editar Itens do Quadro Lógico</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/wquadro/atualiza/id/<?php echo $view_wquadro[0]['cdquadro'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="cdquadro_logico" name="cdquadro_logico" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_wquadro[0]['cdquadro_logico'] ) : ( $_POST['cdquadro_logico'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Código" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Lógica</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="logica" name="logica" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_wquadro[0]['logica'] ) : ( $_POST['logica'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Lógica"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Tipo</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="tipo" name="tipo" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_wquadro[0]['tipo'] ) : ( $_POST['tipo'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Tipo"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Indicador</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="indicador" name="indicador" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_wquadro[0]['indicador'] ) : ( $_POST['indicador'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Indicador"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Fórmula</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="formula" name="formula" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_wquadro[0]['formula'] ) : ( $_POST['formula'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Fórmula"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Fontes</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="fonte" rows="4"><?php echo ( empty( $_POST ) ) ? ( $view_wquadro[0]['fonte'] ) : ( $_POST['fonte'] ) ?></textarea>
</div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Descrição do Indiciador</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="descricao_indicador" rows="4"><?php echo ( empty( $_POST ) ) ? ( $view_wquadro[0]['descricao_indicador'] ) : ( $_POST['descricao_indicador'] ) ?></textarea>
</div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Area</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdarea" name="cdarea" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_wquadro[0]['cdarea'] ) : ( $_POST['cdarea'] ); 

 foreach ($view_areas as $areas) {
   $ch=""; 
  if ($vmarcado==$areas['cdarea']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$areas['cdarea'].'"'.$ch.'>'.$areas['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Nivel</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdnivel" name="cdnivel" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_wquadro[0]['cdnivel'] ) : ( $_POST['cdnivel'] ); 

 foreach ($view_niveis as $niveis) {
   $ch=""; 
  if ($vmarcado==$niveis['cdnivel']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$niveis['cdnivel'].'"'.$ch.'>'.$niveis['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/wquadro/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/wquadro/exclui/id/<?php echo $view_wquadro[0]['cdquadro'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
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
