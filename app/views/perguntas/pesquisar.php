
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
<header class="panel-heading">Pesquisar Perguntas</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/perguntas/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdpergunta" name="i1cdpergunta" type="text" value="<?php echo $_POST['cdpergunta']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdpergunta" name="i2cdpergunta" type="text" value="<?php echo $_POST['cdpergunta']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Grupopergunta</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdgrupopergunta" name="m3cdgrupopergunta[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_grupopergunta[1])) { $ch=' selected="selected" '; }

 foreach ($view_grupopergunta as $grupopergunta) {
  echo '<option value="'.$grupopergunta['cdgrupopergunta'].'"'.$ch.'>'.$grupopergunta['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Tipo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="tipo" name="m3tipo[]" multiple>
  <option value=""></option><option value="TEXTO" <?php if ($_POST['tipo']=='TEXTO') { echo 'selected';}?>>TEXTO</option><option value="TEXTO LONGO" <?php if ($_POST['tipo']=='TEXTO LONGO') { echo 'selected';}?>>TEXTO LONGO</option><option value="DATA" <?php if ($_POST['tipo']=='DATA') { echo 'selected';}?>>DATA</option><option value="NUMERO" <?php if ($_POST['tipo']=='NUMERO') { echo 'selected';}?>>NUMERO</option><option value="LISTA" <?php if ($_POST['tipo']=='LISTA') { echo 'selected';}?>>LISTA</option><option value="LISTA MULTIPLA" <?php if ($_POST['tipo']=='LISTA MULTIPLA') { echo 'selected';}?>>LISTA MULTIPLA</option><option value="DOCUMENTO" <?php if ($_POST['tipo']=='DOCUMENTO') { echo 'selected';}?>>DOCUMENTO</option>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="descricao" name="s0descricao" type="text" value="<?php echo $_POST['descricao']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Descrição"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Ordem</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="ordem" name="i1ordem" type="text" value="<?php echo $_POST['ordem']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="ordem" name="i2ordem" type="text" value="<?php echo $_POST['ordem']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Comentario</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="comentario" name="s0comentario" type="text" value="<?php echo $_POST['comentario']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Comentario"/></div></div>
</div></div>

<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Ativo</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="ativo" value="1">
       </div>
      </div>
</div>

<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Visualiza</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="visualiza" value="1">
       </div>
      </div>
</div>

<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Obrigatorio</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="obrigatorio" value="1">
       </div>
      </div>
</div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/perguntas/" class="btn btn-default">Cancelar</a>

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
