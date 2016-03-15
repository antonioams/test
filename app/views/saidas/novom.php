
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
<header class="panel-heading">Cadastrar Novos Saídas</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/saidas/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th>Consulta</th><th>Campo</th><th>Tipo</th><th>Chave</th><th>Visualiza</th><th>Totaliza</th><th>Rotulo</th>
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
<select id="tipo" name="tipo[]" data-parsley-trigger="change">
  <option value=""></option>
  <option value="selecionar" <?php if ($_POST['tipo']=='selecionar') { echo 'selected';}?>>selecionar</option>
  <option value="somar" <?php if ($_POST['tipo']=='somar') { echo 'selected';}?>>somar</option>
  <option value="quantificar" <?php if ($_POST['tipo']=='quantificar') { echo 'selected';}?>>quantificar</option>
  <option value="maior valor" <?php if ($_POST['tipo']=='maior valor') { echo 'selected';}?>>maior valor</option>
  <option value="menor valor" <?php if ($_POST['tipo']=='menor valor') { echo 'selected';}?>>menor valor</option>
 </select>
</td><td>
<select id="cdcampo" name="cdcampo[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_campos[1])) { $ch=' selected="selected" '; }
 foreach ($view_campos as $campos) {
  echo '<option value="'.$campos['cdcampo'].'"'.$ch.'>'.$campos['legendaentidade'].' - '.$campos['legendacampo'].'</option>';
  } ?>
 </select>
</td><td>
<input type="checkbox" id="minimal-checkbox-1" name="chave[]" value="1">
</td><td>
<input type="checkbox" id="minimal-checkbox-1" name="visualiza[]" value="1">
</td><td>
<input type="checkbox" id="minimal-checkbox-1" name="totaliza[]" value="1">
</td><td>
<input type="checkbox" id="minimal-checkbox-1" name="rotulo[]" value="1">
</td></tr>
</tbody></table> 
</div>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/saidas/" class="btn btn-default">Cancelar</a>


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
