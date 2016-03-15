
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
<header class="panel-heading">Cadastrar Novos Perfis/Usuários</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/perfis/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th>Cliente</th><th>Descrição</th><th>Tipomenu</th><th>Inicio</th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>
    <td>
<select id="cdcliente" name="cdcliente[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_clientes[1])) { $ch=' selected="selected" '; }

 foreach ($view_clientes as $clientes) {
  echo '<option value="'.$clientes['cdcliente'].'"'.$ch.'>'.$clientes['nome'].'</option>';
  } ?>
 </select>
</td><td>

<input id="descricao" name="descricao[]" type="text" value="<?php echo $_POST['descricao']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Descrição"/>

</td><td>
<select id="tipomenu" name="tipomenu[]" data-parsley-trigger="change">
  <option value=""></option><option value="Lateral" <?php if ($_POST['tipomenu']=='Lateral') { echo 'selected';}?>>Lateral</option><option value="
Lateral Minimizado" <?php if ($_POST['tipomenu']=='
Lateral Minimizado') { echo 'selected';}?>>
Lateral Minimizado</option><option value="
Horizontal" <?php if ($_POST['tipomenu']=='
Horizontal') { echo 'selected';}?>>
Horizontal</option>
 </select>
</td><td>
<select id="cdinicio" name="cdinicio[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_inicial[1])) { $ch=' selected="selected" '; }

 foreach ($view_inicial as $inicial) {
  echo '<option value="'.$inicial['cdinicio'].'"'.$ch.'>'.$inicial['descricao'].'</option>';
  } ?>
 </select>
</td></tr>
</tbody></table> 
</div>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/perfis/" class="btn btn-default">Cancelar</a>


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
