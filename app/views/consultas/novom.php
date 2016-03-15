
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
<header class="panel-heading">Cadastrar Novos Criar Consulta</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/consultas/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th>Titulo</th><th>Tipo</th><th>Forma de visualização</th><th>Tipo de Gráfico</th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>
    <td>

<input id="titulo" name="titulo[]" type="text" value="<?php echo $_POST['titulo']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Titulo"/>

</td><td>
<select id="tipo" name="tipo[]" data-parsley-trigger="change">
  <option value=""></option><option value="1" <?php if ($_POST['tipo']=='1') { echo 'selected';}?>>RELATÓRIO</option><option value="2" <?php if ($_POST['tipo']=='2') { echo 'selected';}?>>SALA DE SITUAÇAO</option><option value="3" <?php if ($_POST['tipo']=='3') { echo 'selected';}?>>MAPA</option><option value="4" <?php if ($_POST['tipo']=='4') { echo 'selected';}?>>DOCUMENTO</option>
 </select>
</td><td>
<select id="visualizacao" name="visualizacao[]" data-parsley-trigger="change">
  <option value=""></option><option value="1" <?php if ($_POST['visualizacao']=='1') { echo 'selected';}?>>GRAFICO</option><option value="2" <?php if ($_POST['visualizacao']=='2') { echo 'selected';}?>>TABELA</option><option value="3" <?php if ($_POST['visualizacao']=='3') { echo 'selected';}?>>IMPRESSÃO</option>
 </select>
</td><td>
<select id="grafico" name="grafico[]" data-parsley-trigger="change">
  <option value=""></option><option value="1" <?php if ($_POST['grafico']=='1') { echo 'selected';}?>>PIZZA</option><option value="2" <?php if ($_POST['grafico']=='2') { echo 'selected';}?>>BARRA</option><option value="3" <?php if ($_POST['grafico']=='3') { echo 'selected';}?>>LINHA</option>
 </select>
</td></tr>
</tbody></table> 
</div>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/consultas/" class="btn btn-default">Cancelar</a>


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
