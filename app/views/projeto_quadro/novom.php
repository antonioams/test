
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
<header class="panel-heading">Cadastrar Novos Valores dos Projetos</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/projeto_quadro/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th>Quadro_logico</th><th>Projeto</th><th>Ano</th><th>Valor</th><th>Meta</th><th>Peso</th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>
    <td>
<select id="cdquadro_logico" name="cdquadro_logico[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_quadro_logico[1])) { $ch=' selected="selected" '; }

 foreach ($view_quadro_logico as $quadro_logico) {
  echo '<option value="'.$quadro_logico['cdquadro_logico'].'"'.$ch.'>'.$quadro_logico['logica'].''.' - '.$quadro_logico['tipo'].'</option>';
  } ?>
 </select>
</td><td>
<select id="cdprojeto" name="cdprojeto[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_projetos[1])) { $ch=' selected="selected" '; }

 foreach ($view_projetos as $projetos) {
  echo '<option value="'.$projetos['cdprojeto'].'"'.$ch.'>'.$projetos['intervencao'].'</option>';
  } ?>
 </select>
</td><td>
<select id="ano" name="ano[]" data-parsley-trigger="change">
  <option value=""></option><option value="2014" <?php if ($_POST['ano']=='2014') { echo 'selected';}?>>2014</option><option value="2015" <?php if ($_POST['ano']=='2015') { echo 'selected';}?>>2015</option><option value="2016" <?php if ($_POST['ano']=='2016') { echo 'selected';}?>>2016</option><option value="2017" <?php if ($_POST['ano']=='2017') { echo 'selected';}?>>2017</option><option value="2018" <?php if ($_POST['ano']=='2018') { echo 'selected';}?>>2018</option><option value="2019" <?php if ($_POST['ano']=='2019') { echo 'selected';}?>>2019</option><option value="2020" <?php if ($_POST['ano']=='2020') { echo 'selected';}?>>2020</option><option value="2021" <?php if ($_POST['ano']=='2021') { echo 'selected';}?>>2021</option><option value="2022" <?php if ($_POST['ano']=='2022') { echo 'selected';}?>>2022</option><option value="2023" <?php if ($_POST['ano']=='2023') { echo 'selected';}?>>2023</option><option value="2024" <?php if ($_POST['ano']=='2024') { echo 'selected';}?>>2024</option><option value="2025" <?php if ($_POST['ano']=='2025') { echo 'selected';}?>>2025</option><option value="2026" <?php if ($_POST['ano']=='2026') { echo 'selected';}?>>2026</option><option value="2027" <?php if ($_POST['ano']=='2027') { echo 'selected';}?>>2027</option><option value="2028" <?php if ($_POST['ano']=='2028') { echo 'selected';}?>>2028</option><option value="2029" <?php if ($_POST['ano']=='2029') { echo 'selected';}?>>2029</option><option value="2030" <?php if ($_POST['ano']=='2030') { echo 'selected';}?>>2030</option>
 </select>
</td><td>
<input id="valor" name="valor[]" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Valor" data-parsley-type="digits"/>
</td><td>
<input id="meta" name="meta[]" type="text" value="<?php echo $_POST['meta']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Meta" data-parsley-type="digits"/>
</td><td>
<input id="peso" name="peso[]" type="text" value="<?php echo $_POST['peso']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Peso" data-parsley-type="digits"/>
</td></tr>
</tbody></table> 
</div>


<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/projeto_quadro/" class="btn btn-default">Cancelar</a>


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
