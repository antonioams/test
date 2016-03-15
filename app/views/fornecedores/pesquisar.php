
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
<header class="panel-heading">Pesquisar Fornecedores</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/fornecedores/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Código</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="cdfornecedor" name="i1cdfornecedor" type="text" value="<?php echo $_POST['cdfornecedor']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="cdfornecedor" name="i2cdfornecedor" type="text" value="<?php echo $_POST['cdfornecedor']; ?>" class="form-control number" /></div><div>
</div></div>

<div class="form-group">
<label  class="control-label">CNPJ</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="cnpj" name="s0cnpj" type="text" value="<?php echo $_POST['cnpj']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="CNPJ"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">IE</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="ie" name="s0ie" type="text" value="<?php echo $_POST['ie']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="IE"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Razao Social</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="razao_social" name="s0razao_social" type="text" value="<?php echo $_POST['razao_social']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Razao Social"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Fantasia</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="fantasia" name="s0fantasia" type="text" value="<?php echo $_POST['fantasia']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Fantasia"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Endereço</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="endereco" name="s0endereco" type="text" value="<?php echo $_POST['endereco']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Endereço"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Email</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="email" name="s0email" type="text" value="<?php echo $_POST['email']; ?>" class="form-control" /></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Telefone</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="telefone1" name="s0telefone1" type="text" value="<?php echo $_POST['telefone1']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Telefone"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Celular</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="telefone2" name="s0telefone2" type="text" value="<?php echo $_POST['telefone2']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Celular"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Responsável</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="responsavel" name="s0responsavel" type="text" value="<?php echo $_POST['responsavel']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Responsável"/></div></div>
</div></div>

<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/fornecedores/" class="btn btn-default">Cancelar</a>

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
