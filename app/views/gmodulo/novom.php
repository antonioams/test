
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
<header class="panel-heading">Cadastrar Novos Módulos</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/gmodulo/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'nome') ? "style='display:none'" : "" )?>>Nome</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'atalho') ? "style='display:none'" : "" )?>>Atalho</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'tipoimg') ? "style='display:none'" : "" )?>>Tipoimg</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'cdmodulopai') ? "style='display:none'" : "" )?>>Modulopai</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'ordem') ? "style='display:none'" : "" )?>>Ordem</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'bloqueado') ? "style='display:none'" : "" )?>>Bloqueado</div></th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td>
       <div class="controls icheck">
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" checked value="1">
       </div>
      </div>
   </td>
    <td>
<div <?php echo ( ($view_vc[0]['chave'] == 'nome') ? "style='display:none'" : "" )?>>
<input id="nome" name="nome[]" type="text" value="<?php echo $_POST['nome']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Nome"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'atalho') ? "style='display:none'" : "" )?>>
<input id="atalho" name="atalho[]" type="text" value="<?php echo $_POST['atalho']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Atalho"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'tipoimg') ? "style='display:none'" : "" )?>>
<input id="tipoimg" name="tipoimg[]" type="text" value="<?php echo $_POST['tipoimg']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Tipoimg"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'cdmodulopai') ? "style='display:none'" : "" )?>>
<input id="cdmodulopai" name="cdmodulopai[]" type="text" value="<?php echo $_POST['cdmodulopai']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Modulopai" data-parsley-type="digits"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'ordem') ? "style='display:none'" : "" )?>>
<input id="ordem" name="ordem[]" type="text" value="<?php echo $_POST['ordem']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Ordem" data-parsley-type="digits"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'bloqueado') ? "style='display:none'" : "" )?>>
<input id="bloqueado" name="bloqueado[]" type="text" value="<?php echo $_POST['bloqueado']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Bloqueado" data-parsley-type="digits"/>
</div>
</td></tr>
</tbody></table> 
</div>


<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/gmodulo/" class="btn btn-default">Cancelar</a>


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
