
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
<header class="panel-heading">Cadastrar Novo Subitem</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/subitem/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdcontrato') ? "style='display:none'" : "" )?>>
<label  class="control-label">Contrato</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="cdcontrato" name="cdcontrato" type="text" value="<?php echo $_POST['cdcontrato']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Contrato" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdprojeto') ? "style='display:none'" : "" )?>>
<label  class="control-label">Projeto</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="cdprojeto" name="cdprojeto" type="text" value="<?php echo $_POST['cdprojeto']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Projeto" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'descricao') ? "style='display:none'" : "" )?>>
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="descricao" name="descricao" type="text" value="<?php echo $_POST['descricao']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Descrição"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'quantidade') ? "style='display:none'" : "" )?>>
<label  class="control-label">Quantidade</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="quantidade" name="quantidade" type="text" value="<?php echo $_POST['quantidade']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Quantidade" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'valor') ? "style='display:none'" : "" )?>>
<label  class="control-label">Valor</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="valor" name="valor" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Valor" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'data') ? "style='display:none'" : "" )?>>
<label  class="control-label">Data</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="date" name="data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control" placeholder="99/99/9999" data-parsley-trigger="change"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdunidade') ? "style='display:none'" : "" )?>>
<label  class="control-label">Unidade</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="cdunidade" name="cdunidade" type="text" value="<?php echo $_POST['cdunidade']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Unidade" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdcontrato_item_sup') ? "style='display:none'" : "" )?>>
<label  class="control-label">Contrato_item_sup</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="cdcontrato_item_sup" name="cdcontrato_item_sup" type="text" value="<?php echo $_POST['cdcontrato_item_sup']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Contrato_item_sup" data-parsley-type="digits"/></div></div>
</div></div>

<br>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/subitem/" class="btn btn-default">Cancelar</a>
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
