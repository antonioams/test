
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
<header class="panel-heading">Cadastrar Novos Objetivos do Produto</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/objetivo_produto/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'cdobjetivo_informacao') ? "style='display:none'" : "" )?>>Objetivo</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'peso') ? "style='display:none'" : "" )?>>Peso</div></th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td>
       <input type="checkbox" checked="checked" />
   </td>
    <td>
<div <?php echo ( ($view_vc[0]['chave'] == 'cdobjetivo_informacao') ? "style='display:none'" : "" )?>>
<select id="cdobjetivo_informacao" name="cdobjetivo_informacao[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_objetivo_informacao[1])) { $ch=' selected="selected" '; }

 foreach ($view_objetivo_informacao as $objetivo_informacao) {
  echo '<option value="'.$objetivo_informacao['cdobjetivo_informacao'].'"'.$ch.'>'.$objetivo_informacao['logica'].''.' - '.$objetivo_informacao['tipo'].'</option>';
  } ?>
 </select>
 </div>
 
 
 <div <?php echo ( ($view_vc[0]['chave'] == 'cdproduto') ? "style='display:none'" : "" )?>>
<select id="cdproduto" name="cdproduto[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_produtos[1])) { $ch=' selected="selected" '; }

 foreach ($view_produtos as $produtos) {
  echo '<option value="'.$produtos['cdproduto'].'"'.$ch.'>'.$produtos['logica'].''.' - '.$produtos['tipo'].'</option>';
  } ?>
 </select>
 </div>
 
 
</td>
<td>
<div <?php echo ( ($view_vc[0]['chave'] == 'peso') ? "style='display:none'" : "" )?>>
<input id="peso" name="peso[]" type="text" value="<?php echo $_POST['peso']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Peso" data-parsley-type="digits"/>
</div>
</td></tr>
</tbody></table> 
</div>


<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/objetivo_produto/" class="btn btn-default">Cancelar</a>


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
