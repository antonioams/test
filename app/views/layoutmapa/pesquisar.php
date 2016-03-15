
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
<header class="panel-heading">Pesquisar Layout do Mapa</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/layoutmapa/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdlayoutmapa" name="i1cdlayoutmapa" type="text" value="<?php echo $_POST['cdlayoutmapa']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdlayoutmapa" name="i2cdlayoutmapa" type="text" value="<?php echo $_POST['cdlayoutmapa']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Nome</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="nome" name="s0nome" type="text" value="<?php echo $_POST['nome']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Nome"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Cor_topo</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="cor_topo" name="s0cor_topo" type="text" value="<?php echo $_POST['cor_topo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Cor_topo"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Cor_menu</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="cor_menu" name="s0cor_menu" type="text" value="<?php echo $_POST['cor_menu']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Cor_menu"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Cor_texto</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="cor_texto" name="s0cor_texto" type="text" value="<?php echo $_POST['cor_texto']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Cor_texto"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Cor_textomenu</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="cor_textomenu" name="s0cor_textomenu" type="text" value="<?php echo $_POST['cor_textomenu']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Cor_textomenu"/></div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/layoutmapa/" class="btn btn-default">Cancelar</a>

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
