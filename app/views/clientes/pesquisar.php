
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
<header class="panel-heading">Pesquisar Clientes/Perfis</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/clientes/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdcliente" name="i1cdcliente" type="text" value="<?php echo $_POST['cdcliente']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdcliente" name="i2cdcliente" type="text" value="<?php echo $_POST['cdcliente']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">Nome</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="nome" name="s0nome" type="text" value="<?php echo $_POST['nome']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Nome"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Contato</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="contato" name="s0contato" type="text" value="<?php echo $_POST['contato']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Contato"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Telefone1</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="telefone1" name="s0telefone1" type="text" value="<?php echo $_POST['telefone1']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Telefone1"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Telefone2</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="telefone2" name="s0telefone2" type="text" value="<?php echo $_POST['telefone2']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Telefone2"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Email</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="email" name="s0email" type="text" value="<?php echo $_POST['email']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Email"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Data</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="date" name="d1data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control " placeholder="99/99/9999"/></div>
<div class="col-xs-3"><input id="date" name="d2data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control " placeholder="99/99/9999"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Endereço</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="endereco" name="s0endereco" type="text" value="<?php echo $_POST['endereco']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Endereço"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Latitude</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="latitude" name="s0latitude" type="text" value="<?php echo $_POST['latitude']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Latitude"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Longitude</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="longitude" name="s0longitude" type="text" value="<?php echo $_POST['longitude']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Longitude"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Layout</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdlayout" name="m3cdlayout[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_layouts[1])) { $ch=' selected="selected" '; }

 foreach ($view_layouts as $layouts) {
  echo '<option value="'.$layouts['cdlayout'].'"'.$ch.'>'.$layouts['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>


<div class="form-group">
<label  class="control-label">Layout Mapa</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdlayoutmapa" name="m3cdlayoutmapa[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_layoutmapa[1])) { $ch=' selected="selected" '; }

 foreach ($view_layoutmapa as $layoutmapa) {
  echo '<option value="'.$layoutmapa['cdlayoutmapa'].'"'.$ch.'>'.$layoutmapa['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Identificação</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="sigla" name="s0sigla" type="text" value="<?php echo $_POST['sigla']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Identificação"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Flickr Chave API</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="flickr_chave" name="s0flickr_chave" type="text" value="<?php echo $_POST['flickr_chave']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Flickr Chave API"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Flickr Chave Secreta</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="flickr_sec" name="s0flickr_sec" type="text" value="<?php echo $_POST['flickr_sec']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Flickr Chave Secreta"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Flickr Código Usuário</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="flickr_usuario" name="s0flickr_usuario" type="text" value="<?php echo $_POST['flickr_usuario']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Flickr Código Usuário"/></div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/clientes/" class="btn btn-default">Cancelar</a>

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
