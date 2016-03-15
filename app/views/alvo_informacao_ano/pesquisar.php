
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
<header class="panel-heading">Pesquisar Valores Alvo Estratégico</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/alvo_informacao_ano/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdalvo_informacao_ano" name="i1cdalvo_informacao_ano" type="text" value="<?php echo $_POST['cdalvo_informacao_ano']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdalvo_informacao_ano" name="i2cdalvo_informacao_ano" type="text" value="<?php echo $_POST['cdalvo_informacao_ano']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Alvo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdalvo" name="m3cdalvo[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_alvo[1])) { $ch=' selected="selected" '; }

 foreach ($view_alvo as $alvo) {
  echo '<option value="'.$alvo['cdalvo'].'"'.$ch.'>'.$alvo['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Alvo Informacao</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdalvo_informacao" name="m3cdalvo_informacao[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_alvo_informacao[1])) { $ch=' selected="selected" '; }

 foreach ($view_alvo_informacao as $alvo_informacao) {
  echo '<option value="'.$alvo_informacao['cdalvo_informacao'].'"'.$ch.'>'.$alvo_informacao['logica'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Ano</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="ano" name="i1ano" type="text" value="<?php echo $_POST['ano']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="ano" name="i2ano" type="text" value="<?php echo $_POST['ano']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Meta</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="meta" name="s0meta" type="text" value="<?php echo $_POST['meta']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Meta"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Valor</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="valor" name="s0valor" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Valor"/></div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/alvo_informacao_ano/" class="btn btn-default">Cancelar</a>

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
