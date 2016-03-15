
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
<ul id="stepy-header" class="stepy-header"><li id="stepy-head-0" class="stepy-active" style="cursor: default;"><div>>Criar Consulta</div><span>Consulta</span></li><li id="stepy-head-1" style="cursor: default;"><div>Saídas da Consulta</div><span>Incluir saídas da consulta</span></li></ul>
<form id="stepy" class="stepy"  action="/<?php echo PROJETO;?>/wconsulta/inserew/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
    <fieldset title="Criar Consulta">
    <legend>Criar Consulta</legend>

<div class="form-group">
<label  class="control-label">Titulo</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="titulo" name="consulta@titulo" type="text" value="<?php echo $_POST['consulta@titulo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Titulo"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Tipo</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="tipo" name="consulta@tipo" type="text" value="<?php echo $_POST['consulta@tipo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Tipo"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Visualizacao</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="visualizacao" name="consulta@visualizacao" type="text" value="<?php echo $_POST['consulta@visualizacao']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Visualizacao"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Grafico</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="grafico" name="consulta@grafico" type="text" value="<?php echo $_POST['consulta@grafico']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Grafico"/></div></div>
</div></div>
</fieldset>
  <fieldset title="Saídas">
    <legend>Saídas da Consulta</legend>


<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th>Campo</th><th>Tipo</th><th>Chave</th><th>Visualiza</th><th>Totaliza</th><th>Rotulo</th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>
    <td>
<select id="cdcampo" name="saida@cdcampo[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_usuarios[1])) { $ch=' selected="selected" '; }

 foreach ($view_usuarios as $usuarios) {
  echo '<option value="'.$usuarios['cdcampo'].'"'.$ch.'>'.$usuarios['nome'].'</option>';
  } ?>
 </select>
</td><td>
<select id="tipo" name="saida@tipo[]" data-parsley-trigger="change">
  <option value=""></option>
  <option value="selecionar" <?php if ($_POST['saida@tipo']=='selecionar') { echo 'selected';}?>>selecionar</option>
  <option value="somar" <?php if ($_POST['saida@tipo']=='somar') { echo 'selected';}?>>somar</option>
  <option value="quantificar" <?php if ($_POST['saida@tipo']=='quantificar') { echo 'selected';}?>>quantificar</option>
  <option value="maior valor" <?php if ($_POST['saida@tipo']=='maior valor') { echo 'selected';}?>>maior valor</option>
  <option value="menor valor" <?php if ($_POST['saida@tipo']=='menor valor') { echo 'selected';}?>>menor valor</option>
 </select>
</td><td>
<input type="checkbox" id="minimal-checkbox-1" name="saida@chave[]" value="1">
</td><td>
<input type="checkbox" id="minimal-checkbox-1" name="saida@visualiza[]" value="1">
</td><td>
<input type="checkbox" id="minimal-checkbox-1" name="saida@totaliza[]" value="1">
</td><td>
<input type="checkbox" id="minimal-checkbox-1" name="saida@rotulo[]" value="1">
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
