
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
<header class="panel-heading">Cadastrar Novo CSS</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/css/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Tipo</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="tipo" name="tipo" type="text" value="<?php echo $_POST['tipo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Tipo"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Referencia</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="referencia" name="referencia" type="text" value="<?php echo $_POST['referencia']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Referencia"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Valor</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="valor" name="valor" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Valor"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Layout</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdlayout" name="cdlayout" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_layouts[1])) { $ch=' selected="selected" '; }
 foreach ($view_layouts as $layouts) {
  echo '<option value="'.$layouts['cdlayout'].'"'.$ch.'>'.$layouts['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<br>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/css/" class="btn btn-default">Cancelar</a>
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
<?php include('app/views/rodape.php'); ?>
