
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
<header class="panel-heading">Editar Informações Complementares</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/resposta_projeto/atualiza/id/<?php echo $view_resposta_projeto[0]['cdresposta_projeto'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Resposta</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdresposta" name="cdresposta" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_resposta_projeto[0]['cdresposta'] ) : ( $_POST['cdresposta'] ); 

 foreach ($view_respostas as $respostas) {
   $ch=""; 
  if ($vmarcado==$respostas['cdresposta']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$respostas['cdresposta'].'"'.$ch.'>'.$respostas['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Data</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="date" name="data" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_resposta_projeto[0]['data'] ) : ( $_POST['data'] ) ?>" class="form-control" placeholder="99/99/9999" data-parsley-trigger="change"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Resposta</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="resposta" name="resposta" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_resposta_projeto[0]['resposta'] ) : ( $_POST['resposta'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Resposta"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Codigo</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="codigo" name="codigo" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_resposta_projeto[0]['codigo'] ) : ( $_POST['codigo'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Codigo" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Imagem</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="imagem" name="imagem" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_resposta_projeto[0]['imagem'] ) : ( $_POST['imagem'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Imagem"/></div></div>
</div></div>

<div class="form-group" style='display:none'>
<label  class="control-label">Projeto</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdprojeto" name="cdprojeto" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_resposta_projeto[0]['cdprojeto'] ) : ( $_POST['cdprojeto'] ); 

 foreach ($view_projetos as $projetos) {
   $ch=""; 
  if ($vmarcado==$projetos['cdprojeto']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$projetos['cdprojeto'].'"'.$ch.'>'.$projetos['intervencao'].''.' - '.$projetos['objetivo'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/resposta_projeto/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/resposta_projeto/exclui/id/<?php echo $view_resposta_projeto[0]['cdresposta_projeto'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
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
