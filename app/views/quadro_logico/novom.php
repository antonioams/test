
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
<header class="panel-heading">Cadastrar Novos Itens do Quadro Lógico</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/quadro_logico/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th>Lógica</th><th>Tipo</th><th>Indicador</th><th>Fórmula</th><th>Fontes</th><th>Descrição do Indiciador</th><th>Area</th><th>Nivel</th><th>Quadro Lógico</th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>
    <td>

<input id="logica" name="logica[]" type="text" value="<?php echo $_POST['logica']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Lógica"/>

</td><td>

<input id="tipo" name="tipo[]" type="text" value="<?php echo $_POST['tipo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Tipo"/>

</td><td>

<input id="indicador" name="indicador[]" type="text" value="<?php echo $_POST['indicador']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Indicador"/>

</td><td>

<input id="formula" name="formula[]" type="text" value="<?php echo $_POST['formula']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Fórmula"/>

</td><td>
<textarea class="form-control" name="fonte[]" rows="1"><?php echo $_POST['fonte']; ?></textarea>
</td><td>
<textarea class="form-control" name="descricao_indicador[]" rows="1"><?php echo $_POST['descricao_indicador']; ?></textarea>
</td><td>
<select id="cdarea" name="cdarea[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_areas[1])) { $ch=' selected="selected" '; }

 foreach ($view_areas as $areas) {
  echo '<option value="'.$areas['cdarea'].'"'.$ch.'>'.$areas['descricao'].'</option>';
  } ?>
 </select>
</td><td>
<select id="cdnivel" name="cdnivel[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_niveis[1])) { $ch=' selected="selected" '; }

 foreach ($view_niveis as $niveis) {
  echo '<option value="'.$niveis['cdnivel'].'"'.$ch.'>'.$niveis['nome'].'</option>';
  } ?>
 </select>
</td><td>
<select id="cdquadro" name="cdquadro[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_quadro[1])) { $ch=' selected="selected" '; }

 foreach ($view_quadro as $quadro) {
  echo '<option value="'.$quadro['cdquadro'].'"'.$ch.'>'.$quadro['nome'].'</option>';
  } ?>
 </select>
</td></tr>
</tbody></table> 
</div>


<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/quadro_logico/" class="btn btn-default">Cancelar</a>


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
