
<?php
include('app/views/topo.php');
?>
<div class="<?php echo $_SESSION[PROJETO]['mensagem']['tipo'];?>">
                                <?php
                                echo $_SESSION[PROJETO]['mensagem']['texto'];
                                unset( $_SESSION[PROJETO]['mensagem'] );?>
                            </div>
<div class="col-lg-12">


 <div class="widget">
                <div class="widget-body no-p">

<form id="stepy" class="stepy"  action="/<?php echo PROJETO;?>/wquadro/inserew/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
    <fieldset title="Novo Quadro Lógico">
    <legend>Quadro Lógico</legend>

<div class="form-group">
<label  class="control-label">Nome</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="nome" name="quadro@nome" type="text" value="<?php echo $_POST['quadro@nome']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Nome"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="quadro@descricao" rows="4"><?php echo $_POST['quadro@descricao']; ?></textarea>
</div></div>
</div></div>
</fieldset>
  <fieldset title="Itens do Quadro Lógico">
    <legend>Cadastro de Itens Quadro Lógico</legend>


<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th>Lógica</th><th>Tipo</th><th>Indicador</th><th>Fórmula</th><th>Fontes</th><th>Descrição do Indiciador</th><th>Area</th><th>Nivel</th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>
    <td>

<input id="logica" name="quadro_logico@logica[]" type="text" value="<?php echo $_POST['quadro_logico@logica']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Lógica"/>

</td><td>

<input id="tipo" name="quadro_logico@tipo[]" type="text" value="<?php echo $_POST['quadro_logico@tipo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Tipo"/>

</td><td>

<input id="indicador" name="quadro_logico@indicador[]" type="text" value="<?php echo $_POST['quadro_logico@indicador']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Indicador"/>

</td><td>

<input id="formula" name="quadro_logico@formula[]" type="text" value="<?php echo $_POST['quadro_logico@formula']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Fórmula"/>

</td><td>
<textarea class="form-control" name="quadro_logico@fonte[]" rows="1"><?php echo $_POST['quadro_logico@fonte']; ?></textarea>
</td><td>
<textarea class="form-control" name="quadro_logico@descricao_indicador[]" rows="1"><?php echo $_POST['quadro_logico@descricao_indicador']; ?></textarea>
</td><td>
<select id="cdarea" name="quadro_logico@cdarea[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_areas[1])) { $ch=' selected="selected" '; }

 foreach ($view_areas as $areas) {
  echo '<option value="'.$areas['cdarea'].'"'.$ch.'>'.$areas['descricao'].'</option>';
  } ?>
 </select>
</td><td>
<select id="cdnivel" name="quadro_logico@cdnivel[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_niveis[1])) { $ch=' selected="selected" '; }

 foreach ($view_niveis as $niveis) {
  echo '<option value="'.$niveis['cdnivel'].'"'.$ch.'>'.$niveis['nome'].'</option>';
  } ?>
 </select>
</td></tr>
</tbody></table> 
</div>

</fieldset>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary stepy-finish pull-right"><i class="ti-share mr5"></i>Cadastrar</button>

 </form>
  </div>
 </div>
  </div>
<?php
include('app/views/rodape.php');
?>
<!-- page level scripts -->
    <script src="/<?php echo PROJETO;?>/inc/plugins/stepy/jquery.validate.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/stepy/jquery.stepy.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/fuelux/wizard.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/chosen/chosen.jquery.min.js"></script>
    <!-- /page level scripts -->
    <script src="/<?php echo PROJETO;?>/inc/js/form-wizard.js"></script>
