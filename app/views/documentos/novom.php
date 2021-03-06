
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
<header class="panel-heading">Cadastrar Novos Itens do Checklist</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/documentos/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'cdgrupodocumento') ? "style='display:none'" : "" )?>>Grupo de documento</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'descricao') ? "style='display:none'" : "" )?>>Descrição</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'tipo') ? "style='display:none'" : "" )?>>Tipo</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'obrigatorio') ? "style='display:none'" : "" )?>>Obrigatorio</div></th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td>
       <input type="checkbox" checked="checked" />
   </td>
    <td>
<div <?php echo ( ($view_vc[0]['chave'] == 'cdgrupodocumento') ? "style='display:none'" : "" )?>>
<select id="cdgrupodocumento" name="cdgrupodocumento[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_grupodocumento[1])) { $ch=' selected="selected" '; }

 foreach ($view_grupodocumento as $grupodocumento) {
  echo '<option value="'.$grupodocumento['cdgrupodocumento'].'"'.$ch.'>'.$grupodocumento['descricao'].'</option>';
  } ?>
 </select>
 </div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'descricao') ? "style='display:none'" : "" )?>>
<input id="descricao" name="descricao[]" type="text" value="<?php echo $_POST['descricao']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Descrição"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'tipo') ? "style='display:none'" : "" )?>>
<select id="tipo" name="tipo[]" data-parsley-trigger="change">
  <option value=""></option><option value="TEXTO" <?php if ($_POST['tipo']=='TEXTO') { echo 'selected';}?>>TEXTO</option><option value="DATA" <?php if ($_POST['tipo']=='DATA') { echo 'selected';}?>>DATA</option><option value="NUMERO" <?php if ($_POST['tipo']=='NUMERO') { echo 'selected';}?>>NUMERO</option><option value="LISTA" <?php if ($_POST['tipo']=='LISTA') { echo 'selected';}?>>LISTA</option><option value="DOCUMENTO" <?php if ($_POST['tipo']=='DOCUMENTO') { echo 'selected';}?>>DOCUMENTO</option>
 </select>
 </div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'obrigatorio') ? "style='display:none'" : "" )?>>
<input id="obrigatorio" name="obrigatorio[]" type="text" value="<?php echo $_POST['obrigatorio']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Obrigatorio" data-parsley-type="digits"/>
</div>
</td></tr>
</tbody></table> 
</div>


<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/documentos/" class="btn btn-default">Cancelar</a>


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
