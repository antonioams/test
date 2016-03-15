
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
<header class="panel-heading">Cadastrar Novo Informações Complementares</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/resposta_projeto/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Resposta</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdresposta" name="cdresposta" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_respostas[1])) { $ch=' selected="selected" '; }
 foreach ($view_respostas as $respostas) {
  echo '<option value="'.$respostas['cdresposta'].'"'.$ch.'>'.$respostas['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Data</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="date" name="data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control" placeholder="99/99/9999" data-parsley-trigger="change"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Resposta</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="resposta" name="resposta" type="text" value="<?php echo $_POST['resposta']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Resposta"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Codigo</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="codigo" name="codigo" type="text" value="<?php echo $_POST['codigo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Codigo" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Imagem</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="imagem" name="imagem" type="text" value="<?php echo $_POST['imagem']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Imagem"/></div></div>
</div></div>

<div class="form-group" style='display:none'>
<label  class="control-label">Projeto</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdprojeto" name="cdprojeto" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_projetos[1])) { $ch=' selected="selected" '; }
 foreach ($view_projetos as $projetos) {
  echo '<option value="'.$projetos['cdprojeto'].'"'.$ch.'>'.$projetos['intervencao'].''.' - '.$projetos['objetivo'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<br>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/resposta_projeto/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>

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
