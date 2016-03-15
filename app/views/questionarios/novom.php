
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
<header class="panel-heading">Cadastrar Novos Questionários</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/questionarios/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'descricao') ? "style='display:none'" : "" )?>>Descrição</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'ativo') ? "style='display:none'" : "" )?>>Ativo</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'ordem') ? "style='display:none'" : "" )?>>Ordem</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'cdtipo') ? "style='display:none'" : "" )?>>Tipo de Projeto</div></th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td>
       <input type="checkbox" checked="checked" />
   </td>
    <td>
<div <?php echo ( ($view_vc[0]['chave'] == 'descricao') ? "style='display:none'" : "" )?>>
<input id="descricao" name="descricao[]" type="text" value="<?php echo $_POST['descricao']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Descrição"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'ativo') ? "style='display:none'" : "" )?>>
<input type="checkbox" id="minimal-checkbox-1" name="ativo[]" value="1">
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'ordem') ? "style='display:none'" : "" )?>>
<input id="ordem" name="ordem[]" type="text" value="<?php echo $_POST['ordem']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Ordem" data-parsley-type="digits"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'cdtipo') ? "style='display:none'" : "" )?>>
<select id="cdtipo" name="cdtipo[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_tipos[1])) { $ch=' selected="selected" '; }

 foreach ($view_tipos as $tipos) {
  echo '<option value="'.$tipos['cdtipo'].'"'.$ch.'>'.$tipos['nome'].'</option>';
  } ?>
 </select>
 </div>
</td></tr>
</tbody></table> 
</div>


<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/questionarios/" class="btn btn-default">Cancelar</a>


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
