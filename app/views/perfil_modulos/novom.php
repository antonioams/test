
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
<header class="panel-heading">Cadastrar Novos Módulos do Perfil</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/perfil_modulos/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th>Perfil</th><th>Modulo</th><th>Visualizar</th><th>Editar</th><th>Inserir</th><th>Excluir</th><th>Pesquisar</th><th>Inserir_mtp</th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>
    <td>
<input id="cdperfil" name="cdperfil[]" type="text" value="<?php echo $_POST['cdperfil']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Perfil" data-parsley-type="digits"/>
</td><td>
<input id="cdmodulo" name="cdmodulo[]" type="text" value="<?php echo $_POST['cdmodulo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Modulo" data-parsley-type="digits"/>
</td><td>
<input id="visualizar" name="visualizar[]" type="text" value="<?php echo $_POST['visualizar']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Visualizar" data-parsley-type="digits"/>
</td><td>
<input id="editar" name="editar[]" type="text" value="<?php echo $_POST['editar']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Editar" data-parsley-type="digits"/>
</td><td>
<input id="inserir" name="inserir[]" type="text" value="<?php echo $_POST['inserir']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Inserir" data-parsley-type="digits"/>
</td><td>
<input id="excluir" name="excluir[]" type="text" value="<?php echo $_POST['excluir']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Excluir" data-parsley-type="digits"/>
</td><td>
<input id="pesquisar" name="pesquisar[]" type="text" value="<?php echo $_POST['pesquisar']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Pesquisar" data-parsley-type="digits"/>
</td><td>
<input id="inserir_mtp" name="inserir_mtp[]" type="text" value="<?php echo $_POST['inserir_mtp']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Inserir_mtp" data-parsley-type="digits"/>
</td></tr>
</tbody></table> 
</div>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/perfil_modulos/" class="btn btn-default">Cancelar</a>


 </form>
  </div>
 </section>
 </div>
<?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }  ?> 
<?php include('app/views/rodape.php'); ?>
