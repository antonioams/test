
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
<header class="panel-heading">Cadastrar Novos Previsão do Item</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/contrato_previsao/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'quantidade') ? "style='display:none'" : "" )?>>Quantidade</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'valor') ? "style='display:none'" : "" )?>>Valor</div></th>
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
<div <?php echo ( ($view_vc[0]['chave'] == 'quantidade') ? "style='display:none'" : "" )?>>
<input id="quantidade" name="quantidade[]" type="text" value="<?php echo $_POST['quantidade']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Quantidade"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'valor') ? "style='display:none'" : "" )?>>
<input id="valor" name="valor[]" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Valor"/>
<script type="text/javascript">$("#valor").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'', decimal:',', affixesStay: false});</script>
</div>
</td></tr>
</tbody></table> 
</div>


<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/contrato_previsao/" class="btn btn-default">Cancelar</a>


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
