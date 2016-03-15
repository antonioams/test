
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
<header class="panel-heading">Cadastrar Novos Contratos</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/contratos/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'cdprojeto') ? "style='display:none'" : "" )?>>Projeto</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'cdfornecedor') ? "style='display:none'" : "" )?>>Fornecedor</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'cdlicitacao') ? "style='display:none'" : "" )?>>Licitacao</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'data') ? "style='display:none'" : "" )?>>Data</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'prazo') ? "style='display:none'" : "" )?>>Prazo</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'valor') ? "style='display:none'" : "" )?>>Valor</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'numero') ? "style='display:none'" : "" )?>>Número</div></th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>
    <td>
<div <?php echo ( ($view_vc[0]['chave'] == 'cdprojeto') ? "style='display:none'" : "" )?>>
<select id="cdprojeto" name="cdprojeto[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_projetos[1])) { $ch=' selected="selected" '; }

 foreach ($view_projetos as $projetos) {
  echo '<option value="'.$projetos['cdprojeto'].'"'.$ch.'>'.$projetos['intervencao'].'</option>';
  } ?>
 </select>
 </div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'cdfornecedor') ? "style='display:none'" : "" )?>>
<select id="cdfornecedor" name="cdfornecedor[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_fornecedores[1])) { $ch=' selected="selected" '; }

 foreach ($view_fornecedores as $fornecedores) {
  echo '<option value="'.$fornecedores['cdfornecedor'].'"'.$ch.'>'.$fornecedores['razao_social'].'</option>';
  } ?>
 </select>
 </div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'cdlicitacao') ? "style='display:none'" : "" )?>>
<input id="cdlicitacao" name="cdlicitacao[]" type="text" value="<?php echo $_POST['cdlicitacao']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Licitacao"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'data') ? "style='display:none'" : "" )?>>
<input id="date" name="data[]" type="text" value="<?php echo $_POST['data']; ?>" class="form-control" placeholder="99/99/9999" data-parsley-trigger="change"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'prazo') ? "style='display:none'" : "" )?>>
<input id="prazo" name="prazo[]" type="text" value="<?php echo $_POST['prazo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Prazo" data-parsley-type="digits"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'valor') ? "style='display:none'" : "" )?>>
<input id="valor" name="valor[]" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Valor" data-parsley-type="digits"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'numero') ? "style='display:none'" : "" )?>>
<input id="numero" name="numero[]" type="text" value="<?php echo $_POST['numero']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Número" data-parsley-type="digits"/>
</div>
</td></tr>
</tbody></table> 
</div>


<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/contratos/" class="btn btn-default">Cancelar</a>


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
