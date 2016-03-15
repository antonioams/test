
<?php
include('app/views/topo.php');
echo '
    <script src="/'.PROJETO.'/inc/plugins/jquery-1.11.1.min.js"></script>
    <script src="/'.PROJETO.'/inc/js/jquery.maskMoney.js"></script>';
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
<header class="panel-heading">Cadastrar Novo Contratos</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/contratos/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<div class="form-group"  <?php echo ( ($view_vc[0]['chave'] == 'cdprojeto') ? "style='display:none'" : "" )?>>
<label  class="control-label">Projeto</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdprojeto" name="cdprojeto" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_projetos[1])) { $ch=' selected="selected" '; }
 foreach ($view_projetos as $projetos) {
  echo '<option value="'.$projetos['cdprojeto'].'"'.$ch.'>'.$projetos['intervencao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group"  <?php echo ( ($view_vc[0]['chave'] == 'cdfornecedor') ? "style='display:none'" : "" )?>>
<label  class="control-label">Fornecedor</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdfornecedor" name="cdfornecedor" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_fornecedores[1])) { $ch=' selected="selected" '; }
 foreach ($view_fornecedores as $fornecedores) {
  echo '<option value="'.$fornecedores['cdfornecedor'].'"'.$ch.'>'.$fornecedores['razao_social'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group"  <?php echo ( ($view_vc[0]['chave'] == 'cdlicitacao') ? "style='display:none'" : "" )?>>
<label  class="control-label">Licitacao</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="cdlicitacao" name="cdlicitacao" type="text" value="<?php echo $_POST['cdlicitacao']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Licitacao"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'data') ? "style='display:none'" : "" )?>>
<label  class="control-label">Data</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="date" name="data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control" placeholder="99/99/9999" data-parsley-trigger="change"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'prazo') ? "style='display:none'" : "" )?>>
<label  class="control-label">Prazo</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="prazo" name="prazo" type="text" value="<?php echo $_POST['prazo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Prazo" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'valor') ? "style='display:none'" : "" )?>>
<label  class="control-label">Valor</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="valor" name="valor" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Valor"/></div></div>
</div></div>
<script type="text/javascript">$("#valor").maskMoney({prefix:'R$ ', allowNegative: false, thousands:'', decimal:',', affixesStay: false});</script>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'numero') ? "style='display:none'" : "" )?>>
<label  class="control-label">Número</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="numero" name="numero" type="text" value="<?php echo $_POST['numero']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Número" data-parsley-type="digits"/></div></div>
</div></div>

 <div class="form-group">
                                                <label>Objeto do Contrato</label>
                                                <div>
                                                 <textarea class="form-control" name="objeto" rows="4"><?php echo $_POST['objeto']; ?></textarea>
                                                </div>
                                            </div>

<br>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/contratos/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>

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
