
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
<header class="panel-heading">Cadastrar Novos Fornecedores</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/fornecedores/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'cnpj') ? "style='display:none'" : "" )?>>CNPJ</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'ie') ? "style='display:none'" : "" )?>>IE</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'razao_social') ? "style='display:none'" : "" )?>>Razao Social</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'fantasia') ? "style='display:none'" : "" )?>>Fantasia</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'endereco') ? "style='display:none'" : "" )?>>Endereço</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'email') ? "style='display:none'" : "" )?>>Email</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'telefone1') ? "style='display:none'" : "" )?>>Telefone</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'telefone2') ? "style='display:none'" : "" )?>>Celular</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'responsavel') ? "style='display:none'" : "" )?>>Responsável</div></th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>
    <td>
<div <?php echo ( ($view_vc[0]['chave'] == 'cnpj') ? "style='display:none'" : "" )?>>
<input id="cnpj" name="cnpj[]" type="text" value="<?php echo $_POST['cnpj']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="CNPJ"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'ie') ? "style='display:none'" : "" )?>>
<input id="ie" name="ie[]" type="text" value="<?php echo $_POST['ie']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="IE"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'razao_social') ? "style='display:none'" : "" )?>>
<input id="razao_social" name="razao_social[]" type="text" value="<?php echo $_POST['razao_social']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Razao Social"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'fantasia') ? "style='display:none'" : "" )?>>
<input id="fantasia" name="fantasia[]" type="text" value="<?php echo $_POST['fantasia']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Fantasia"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'endereco') ? "style='display:none'" : "" )?>>
<input id="endereco" name="endereco[]" type="text" value="<?php echo $_POST['endereco']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Endereço"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'email') ? "style='display:none'" : "" )?>>
<input id="email" name="email[]" type="text" value="<?php echo $_POST['email']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Email" data-parsley-type="email"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'telefone1') ? "style='display:none'" : "" )?>>
<input id="telefone1" name="telefone1[]" type="text" value="<?php echo $_POST['telefone1']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Telefone"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'telefone2') ? "style='display:none'" : "" )?>>
<input id="telefone2" name="telefone2[]" type="text" value="<?php echo $_POST['telefone2']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Celular"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'responsavel') ? "style='display:none'" : "" )?>>
<input id="responsavel" name="responsavel[]" type="text" value="<?php echo $_POST['responsavel']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Responsável"/>
</div>
</td></tr>
</tbody></table> 
</div>


<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
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
