
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
<header class="panel-heading">Cadastrar Novos Subitem</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/subitem/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'descricao') ? "style='display:none'" : "" )?>>Descrição</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'cdunidade') ? "style='display:none'" : "" )?>>Unidade Medida</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'quantidade') ? "style='display:none'" : "" )?>>Quantidade</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'valor') ? "style='display:none'" : "" )?>>Valor</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'data') ? "style='display:none'" : "" )?>>Data Início</div></th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>


<td>
<div <?php echo ( ($view_vc[0]['chave'] == 'descricao') ? "style='display:none'" : "" )?>>
<input id="descricao" name="descricao[]" type="text" value="<?php echo $_POST['descricao']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Descrição"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'cdunidade') ? "style='display:none'" : "" )?>>
<select id="cdunidade" name="cdunidade[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_unidades[1])) { $ch=' selected="selected" '; }

 foreach ($view_unidades as $unidades) {
  echo '<option value="'.$unidades['cdunidade'].'"'.$ch.'>'.$unidades['descricao'].'</option>';
  } ?>
 </select>
 </div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'quantidade') ? "style='display:none'" : "" )?>>
<input id="quantidade" name="quantidade[]" type="text" value="<?php echo $_POST['quantidade']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Quantidade"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'valor') ? "style='display:none'" : "" )?>>
<input id="valor" name="valor[]" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Valor"/>
</div>
<script type="text/javascript">$("#valor").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'', decimal:',', affixesStay: false});</script>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'data') ? "style='display:none'" : "" )?>>
<input id="date" name="data[]" type="text" value="<?php echo $_POST['data']; ?>" class="form-control" placeholder="99/99/9999" data-parsley-trigger="change"/>
</div>
</td></tr>
</tbody></table> 
</div>


<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/subitem/" class="btn btn-default">Cancelar</a>


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
