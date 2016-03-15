
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
<header class="panel-heading">Cadastrar Novo Criar Consulta</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/consultas/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Titulo</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="titulo" name="titulo" type="text" value="<?php echo $_POST['titulo']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Titulo"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Tipo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="tipo" name="tipo[]" data-parsley-trigger="change" multiple>
  <option value=""></option><option value="1" <?php if ($_POST['tipo']=='1') { echo 'selected';}?>>RELATÓRIO</option><option value="2" <?php if ($_POST['tipo']=='2') { echo 'selected';}?>>SALA DE SITUAÇAO</option><option value="3" <?php if ($_POST['tipo']=='3') { echo 'selected';}?>>MAPA</option><option value="4" <?php if ($_POST['tipo']=='4') { echo 'selected';}?>>DOCUMENTO</option>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Forma de visualização</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="visualizacao" name="visualizacao[]" data-parsley-trigger="change" multiple>
  <option value=""></option><option value="1" <?php if ($_POST['visualizacao']=='1') { echo 'selected';}?>>GRAFICO</option><option value="2" <?php if ($_POST['visualizacao']=='2') { echo 'selected';}?>>TABELA</option><option value="3" <?php if ($_POST['visualizacao']=='3') { echo 'selected';}?>>IMPRESSÃO</option>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Tipo de Gráfico</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="grafico" name="grafico" data-parsley-trigger="change">
  <option value=""></option>
  <option value="1" <?php if ($_POST['grafico']=='1') { echo 'selected';}?>>PIZZA</option>
  <option value="2" <?php if ($_POST['grafico']=='2') { echo 'selected';}?>>BARRA</option>
  <option value="3" <?php if ($_POST['grafico']=='3') { echo 'selected';}?>>LINHA</option>
  <option value="4" <?php if ($_POST['grafico']=='4') { echo 'selected';}?>>LINHA 2 (ÁREA)</option>
  <option value="5" <?php if ($_POST['grafico']=='5') { echo 'selected';}?>>CAIXA</option>
  <option value="6" <?php if ($_POST['grafico']=='6') { echo 'selected';}?>>PIZZA FÁCIL</option>  
 </select></div></div>
</div></div>

<br>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/consultas/" class="btn btn-default">Cancelar</a>
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
                   