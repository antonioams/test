
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
<header class="panel-heading">Editar Fornecedores</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/fornecedores/atualiza/id/<?php echo $view_fornecedores[0]['cdfornecedor'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cnpj') ? "style='display:none'" : "" )?>>
<label  class="control-label">CNPJ</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="cnpj" name="cnpj" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_fornecedores[0]['cnpj'] ) : ( $_POST['cnpj'] ) ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="CNPJ"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'ie') ? "style='display:none'" : "" )?>>
<label  class="control-label">IE</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="ie" name="ie" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_fornecedores[0]['ie'] ) : ( $_POST['ie'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="IE"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'razao_social') ? "style='display:none'" : "" )?>>
<label  class="control-label">Razao Social</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="razao_social" name="razao_social" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_fornecedores[0]['razao_social'] ) : ( $_POST['razao_social'] ) ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Razao Social"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'fantasia') ? "style='display:none'" : "" )?>>
<label  class="control-label">Fantasia</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="fantasia" name="fantasia" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_fornecedores[0]['fantasia'] ) : ( $_POST['fantasia'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Fantasia"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'endereco') ? "style='display:none'" : "" )?>>
<label  class="control-label">Endereço</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="endereco" name="endereco" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_fornecedores[0]['endereco'] ) : ( $_POST['endereco'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Endereço"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'email') ? "style='display:none'" : "" )?>>
<label  class="control-label">Email</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="email" name="email" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_fornecedores[0]['email'] ) : ( $_POST['email'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Email" data-parsley-type="email"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'telefone1') ? "style='display:none'" : "" )?>>
<label  class="control-label">Telefone</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="telefonem" name="telefone1" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_fornecedores[0]['telefone1'] ) : ( $_POST['telefone1'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Telefone"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'telefone2') ? "style='display:none'" : "" )?>>
<label  class="control-label">Celular</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="telefonem" name="telefone2" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_fornecedores[0]['telefone2'] ) : ( $_POST['telefone2'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Celular"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'responsavel') ? "style='display:none'" : "" )?>>
<label  class="control-label">Responsável</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="responsavel" name="responsavel" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_fornecedores[0]['responsavel'] ) : ( $_POST['responsavel'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Responsável"/></div></div>
</div></div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/fornecedores/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/fornecedores/exclui/id/<?php echo $view_fornecedores[0]['cdfornecedor'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
                    Excluir</a>
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
