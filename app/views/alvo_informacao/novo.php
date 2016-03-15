
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
<header class="panel-heading">Cadastrar Novo Composição do Alvo Estratégico</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/alvo_informacao/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<div class="form-group"  <?php echo ( ($view_vc[0]['chave'] == 'cdalvo') ? "style='display:none'" : "" )?>>
<label  class="control-label">Alvo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdalvo" name="cdalvo" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_alvo[1])) { $ch=' selected="selected" '; }
 foreach ($view_alvo as $alvo) {
  echo '<option value="'.$alvo['cdalvo'].'"'.$ch.'>'.$alvo['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'tipo') ? "style='display:none'" : "" )?>>
<label  class="control-label">Tipo</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="tipo" name="tipo" type="text" value="<?php echo $_POST['tipo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Tipo"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'indicador') ? "style='display:none'" : "" )?>>
<label  class="control-label">Indicador</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="indicador" name="indicador" type="text" value="<?php echo $_POST['indicador']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Indicador"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'formula') ? "style='display:none'" : "" )?>>
<label  class="control-label">Formula</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="formula" name="formula" type="text" value="<?php echo $_POST['formula']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Formula"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'fonte') ? "style='display:none'" : "" )?>>
<label  class="control-label">Fonte</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="fonte" rows="4"><?php echo $_POST['fonte']; ?></textarea>
</div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'descricao_indicador') ? "style='display:none'" : "" )?>>
<label  class="control-label">Descrição do Indicador</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="descricao_indicador" rows="4"><?php echo $_POST['descricao_indicador']; ?></textarea>
</div></div>
</div></div>

<br>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/alvo_informacao/" class="btn btn-default">Cancelar</a>
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
