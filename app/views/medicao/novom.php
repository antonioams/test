
<?php
include('app/views/topo.php');
echo '
    <script src="/'.PROJETO.'/inc/plugins/jquery-1.11.1.min.js"></script>
    <script src="/'.PROJETO.'/inc/js/jquery.maskMoney.js"></script>';
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
<header class="panel-heading">Cadastrar Novos Itens da Medição</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/medicao/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'cdcontrato_item') ? "style='display:none'" : "" )?>>Contrato Item</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'cdgrupomedicao') ? "style='display:none'" : "" )?>>Medição</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'quantidade') ? "style='display:none'" : "" )?>>Quantidade</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'valor') ? "style='display:none'" : "" )?>>Valor</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'nf') ? "style='display:none'" : "" )?>>NF</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'ne') ? "style='display:none'" : "" )?>>NE</div></th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td>
       <input type="checkbox" checked="checked" />
   </td>
    <td>
<div <?php echo ( ($view_vc[0]['chave'] == 'cdcontrato_item') ? "style='display:none'" : "" )?>>
<select id="cdcontrato_item" name="cdcontrato_item[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_contrato_item[1])) { $ch=' selected="selected" '; }

 foreach ($view_contrato_item as $contrato_item) {
  echo '<option value="'.$contrato_item['cdcontrato_item'].'"'.$ch.'>'.$contrato_item['descricao'].'</option>';
  } ?>
 </select>
 </div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'cdgrupomedicao') ? "style='display:none'" : "" )?>>
<select id="cdgrupomedicao" name="cdgrupomedicao[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_grupomedicao[1])) { $ch=' selected="selected" '; }

 foreach ($view_grupomedicao as $grupomedicao) {
  echo '<option value="'.$grupomedicao['cdgrupomedicao'].'"'.$ch.'>'.$grupomedicao['numero'].''.' - '.$grupomedicao['data'].'</option>';
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
<div <?php echo ( ($view_vc[0]['chave'] == 'nf') ? "style='display:none'" : "" )?>>
<input id="nf" name="nf[]" type="text" value="<?php echo $_POST['nf']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="NF"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'ne') ? "style='display:none'" : "" )?>>
<input id="ne" name="ne[]" type="text" value="<?php echo $_POST['ne']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="NE"/>
</div>
</td></tr>
</tbody></table> 
</div>


<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/medicao/" class="btn btn-default">Cancelar</a>


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
