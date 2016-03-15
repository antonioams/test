
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
<header class="panel-heading">Cadastrar Novos Ocorrências</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/acao/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th>Tipo</th><th>Descrição</th><th>Status</th><th>Data</th><th>Projeto</th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>
    <td>
<select id="tipo" name="tipo[]" data-parsley-trigger="change">
  <option value=""></option><option value="REUNIÃO" <?php if ($_POST['tipo']=='REUNIÃO') { echo 'selected';}?>>REUNIÃO</option><option value="
PROBLEMA" <?php if ($_POST['tipo']=='
PROBLEMA') { echo 'selected';}?>>
PROBLEMA</option>
 </select>
</td><td>
<textarea class="form-control" name="descricao[]" rows="1"><?php echo $_POST['descricao']; ?></textarea>
</td><td>
<select id="status" name="status[]" data-parsley-trigger="change">
  <option value=""></option><option value="1" <?php if ($_POST['status']=='1') { echo 'selected';}?>>PENDENTE</option><option value="
2" <?php if ($_POST['status']=='
2') { echo 'selected';}?>>CONCLUÍDO</option><option value="
3" <?php if ($_POST['status']=='
3') { echo 'selected';}?>>AGUARDANDO TERCEIRO</option>
 </select>
</td><td>
<input id="date" name="data[]" type="text" value="<?php echo $_POST['data']; ?>" class="form-control" placeholder="99/99/9999" data-parsley-trigger="change"/>
</td><td>
<select id="cdprojeto" name="cdprojeto[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_projetos[1])) { $ch=' selected="selected" '; }

 foreach ($view_projetos as $projetos) {
  echo '<option value="'.$projetos['cdprojeto'].'"'.$ch.'>'.$projetos['intervencao'].'</option>';
  } ?>
 </select>
</td></tr>
</tbody></table> 
</div>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/acao/" class="btn btn-default">Cancelar</a>


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
