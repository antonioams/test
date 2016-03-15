
<?php
include('app/views/topo.php');
?>
<div class="<?php echo $_SESSION['mensagem']['tipo'];?>">
                                <?php
                                echo $_SESSION['mensagem']['texto'];
                                unset( $_SESSION['mensagem'] );?>
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
<header class="panel-heading">Cadastrar Novos Template de Documentos</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/template_documento/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'template') ? "style='display:none'" : "" )?>>Template</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'tabela') ? "style='display:none'" : "" )?>>Tabela</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'variavel') ? "style='display:none'" : "" )?>>Variavel</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'parametro') ? "style='display:none'" : "" )?>>Parametro</div></th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td>
       <div class="controls icheck">
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="ativo" checked value="1">
       </div>
      </div>
   </td>
    <td>
<div <?php echo ( ($view_vc[0]['chave'] == 'template') ? "style='display:none'" : "" )?>>
<textarea class="form-control" name="template[]" rows="1"><?php echo $_POST['template']; ?></textarea>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'tabela') ? "style='display:none'" : "" )?>>
<input id="tabela" name="tabela[]" type="text" value="<?php echo $_POST['tabela']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Tabela"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'variavel') ? "style='display:none'" : "" )?>>
<input id="variavel" name="variavel[]" type="text" value="<?php echo $_POST['variavel']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Variavel"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'parametro') ? "style='display:none'" : "" )?>>
<input id="parametro" name="parametro[]" type="text" value="<?php echo $_POST['parametro']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Parametro"/>
</div>
</td></tr>
</tbody></table> 
</div>


<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/template_documento/" class="btn btn-default">Cancelar</a>


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
