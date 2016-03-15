
<?php
include('app/views/topo.php');
?>
<style type="text/css">
.niceform input[type=checkbox] {
    opacity: 0;
    margin-right: -12px;
    cursor: pointer;
    width: 12px;
    height: 12px;
}
 
.niceform input[type=checkbox] + span:before {
    content: "\00a0";
    display: inline-block;
    margin-right: 15px;
    width: 12px;
    height: 12px;
    visibility: visible;
    border: 2px solid #999;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    line-height: 12px;
    font-size: 14px;
    text-align: center;
    font-weight: bold;
    color: #052;
}
 
.niceform input[type=checkbox]:checked + span:before {
    content: "\00d7";
}
</style>
<div class="<?php echo $_SESSION[PROJETO]['mensagem']['tipo'];?>">
                                <?php
                                echo $_SESSION[PROJETO]['mensagem']['texto'];
                                unset( $_SESSION[PROJETO]['mensagem'] );?>
                            </div>
<div class="col-lg-12">


 <div class="widget">
                <div class="widget-body no-p">

<form id="stepy" class="stepy"  action="/<?php echo PROJETO;?>/alvo/inserew/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
    <fieldset title="Alvo Estratégico">
    <legend>Cadastrar Alvo Estratégico</legend>

<div class="form-group">
<label  class="control-label">Programa</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdprograma" name="alvo@cdprograma" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_programas[1])) { $ch=' selected="selected" '; }
 foreach ($view_programas as $programas) {
  echo '<option value="'.$programas['cdprograma'].'"'.$ch.'>'.$programas['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Lógica da Intervenção</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="descricao" name="alvo@descricao" type="text" value="<?php echo $_POST['alvo@descricao']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Lógica da Intervenção"/></div></div>
</div></div>
</fieldset>
  <fieldset title="Composição do Alvo Estratégico">
    <legend>Informações do Alvo Estratégico</legend>


<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th>Tipo</th><th>Indicador</th><th>Formula</th><th>Fonte</th><th>Descrição do Indicador</th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input class="niceform" type="checkbox" checked="checked" /></td>
    <td>

<input id="tipo" name="alvo_informacao@tipo[]" type="text" value="<?php echo $_POST['alvo_informacao@tipo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Tipo"/>

</td><td>

<input id="indicador" name="alvo_informacao@indicador[]" type="text" value="<?php echo $_POST['alvo_informacao@indicador']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Indicador"/>

</td><td>

<input id="formula" name="alvo_informacao@formula[]" type="text" value="<?php echo $_POST['alvo_informacao@formula']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Formula"/>

</td><td>
<textarea class="form-control" name="alvo_informacao@fonte[]" rows="1"><?php echo $_POST['alvo_informacao@fonte']; ?></textarea>
</td><td>
<textarea class="form-control" name="alvo_informacao@descricao_indicador[]" rows="1"><?php echo $_POST['alvo_informacao@descricao_indicador']; ?></textarea>
</td></tr>
</tbody></table> 
</div>
</fieldset>

<button type="submit" name="submit" value="Salvar e Objetivo" class="btn btn-primary stepy-finish pull-right"><i class="ti-share mr5"></i>Salvar, ir para Objetivo</button>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary stepy-finish pull-right"><i class="ti-share mr5"></i>Salvar</button>

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
