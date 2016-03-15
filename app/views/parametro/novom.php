
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
<header class="panel-heading">Cadastrar Novos Parâmetro</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/parametro/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th>Consulta</th><th>Campo</th><th>Condicao</th><th>Valor</th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>
    <td>
<select id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_consultas[1])) { $ch=' selected="selected" '; }

 foreach ($view_consultas as $consultas) {
  echo '<option value="'.$consultas['cdconsulta'].'"'.$ch.'>'.$consultas['titulo'].'</option>';
  } ?>
 </select>
</td><td>
<select  id="cdcampo" name="cdcampo[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_campos[1])) { $ch=' selected="selected" '; }
 foreach ($view_campos as $campos) {
  echo '<option value="'.$campos['cdcampo'].'"'.$ch.'>'.$campos['legendaentidade'].' - '.$campos['legendacampo'].'</option>';
  } ?>
 </select>
</td><td>
<select id="condicao" name="condicao[]" data-parsley-trigger="change">
  <option value=""></option>
  <option value="igual" <?php if ($_POST['condicao']=='igual') { echo 'selected';}?>>igual</option>
  <option value="maior" <?php if ($_POST['condicao']=='maior') { echo 'selected';}?>>maior</option>  
  <option value="menor" <?php if ($_POST['condicao']=='menor') { echo 'selected';}?>>menor</option>
  <option value="maior ou igual" <?php if ($_POST['condicao']=='maior ou igual') { echo 'selected';}?>>maior ou igual</option>
  <option value="menor ou igual" <?php if ($_POST['condicao']=='menor ou igual') { echo 'selected';}?>>menor ou igual</option>
  <option value="contenha" <?php if ($_POST['condicao']=='contenha') { echo 'selected';}?>>contenha</option>
  <option value="esteja em" <?php if ($_POST['condicao']=='esteja em') { echo 'selected';}?>>esteja em</option>
  <option value="não esteja em" <?php if ($_POST['condicao']=='não esteja em') { echo 'selected';}?>>não esteja em</option>
  
 </select>
</td><td>

<input id="valor" name="valor[]" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Valor"/>

</td></tr>
</tbody></table> 
</div>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/parametro/" class="btn btn-default">Cancelar</a>


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
