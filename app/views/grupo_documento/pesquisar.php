
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
<header class="panel-heading">Pesquisar Checklist</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/grupo_documento/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdgrupo_documento" name="i1cdgrupo_documento" type="text" value="<?php echo $_POST['cdgrupo_documento']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdgrupo_documento" name="i2cdgrupo_documento" type="text" value="<?php echo $_POST['cdgrupo_documento']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="descricao" name="s0descricao" type="text" value="<?php echo $_POST['descricao']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Descrição"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Fase</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdfase" name="m3cdfase[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_situacao[1])) { $ch=' selected="selected" '; }

 foreach ($view_situacao as $situacao) {
  echo '<option value="'.$situacao['cdfase'].'"'.$ch.'>'.$situacao['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/grupo_documento/" class="btn btn-default">Cancelar</a>

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
