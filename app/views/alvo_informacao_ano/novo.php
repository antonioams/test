
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
<header class="panel-heading">Cadastrar Novo Valores Alvo Estratégico</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/alvo_informacao_ano/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
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

<div class="form-group"  <?php echo ( ($view_vc[0]['chave'] == 'cdalvo_informacao') ? "style='display:none'" : "" )?>>
<label  class="control-label">Alvo Informacao</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdalvo_informacao" name="cdalvo_informacao" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_alvo_informacao[1])) { $ch=' selected="selected" '; }
 foreach ($view_alvo_informacao as $alvo_informacao) {
  echo '<option value="'.$alvo_informacao['cdalvo_informacao'].'"'.$ch.'>'.$alvo_informacao['logica'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'ano') ? "style='display:none'" : "" )?>>
<label  class="control-label">Ano</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="ano" name="ano" type="text" value="<?php echo $_POST['ano']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Ano" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group"  <?php echo ( ($view_vc[0]['chave'] == 'meta') ? "style='display:none'" : "" )?>>
<label  class="control-label">Meta</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="meta" name="meta" type="text" value="<?php echo $_POST['meta']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Meta"/></div></div>
</div></div>

<div class="form-group"  <?php echo ( ($view_vc[0]['chave'] == 'valor') ? "style='display:none'" : "" )?>>
<label  class="control-label">Valor</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="valor" name="valor" type="text" value="<?php echo $_POST['valor']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Valor"/></div></div>
</div></div>

<br>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/alvo_informacao_ano/" class="btn btn-default">Cancelar</a>
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
