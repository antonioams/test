
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
<header class="panel-heading">Cadastrar Novos Logs de Acesso</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/logs/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th>Usuario</th><th>Data</th><th>Entidade</th><th>Operacao</th><th>Dados</th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>
    <td>
<select id="cdusuario" name="cdusuario[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_usuarios[1])) { $ch=' selected="selected" '; }

 foreach ($view_usuarios as $usuarios) {
  echo '<option value="'.$usuarios['cdusuario'].'"'.$ch.'>'.$usuarios['nome'].'</option>';
  } ?>
 </select>
</td><td>

<input id="data" name="data[]" type="text" value="<?php echo $_POST['data']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Data"/>

</td><td>

<input id="entidade" name="entidade[]" type="text" value="<?php echo $_POST['entidade']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Entidade"/>

</td><td>

<input id="operacao" name="operacao[]" type="text" value="<?php echo $_POST['operacao']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Operacao"/>

</td><td>
<textarea class="form-control" name="dados[]" rows="1"><?php echo $_POST['dados']; ?></textarea>
</td></tr>
</tbody></table> 
</div>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/logs/" class="btn btn-default">Cancelar</a>


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
