
<?php
include('app/views/topo.php');
?>
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
<header class="panel-heading">Pesquisar G. Quadro Lógico</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/quadro/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdquadro" name="i1cdquadro" type="text" value="<?php echo $_POST['cdquadro']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdquadro" name="i2cdquadro" type="text" value="<?php echo $_POST['cdquadro']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Nome</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="nome" name="s0nome" type="text" value="<?php echo $_POST['nome']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Nome"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<div class="row"><div class="col-xs-12"><input id="descricao" name="s0descricao" type="text" value="<?php echo $_POST['descricao']; ?>" class="form-control" /></div></div>
</div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/quadro/" class="btn btn-default">Cancelar</a>

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
