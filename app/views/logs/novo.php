
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
<header class="panel-heading">Cadastrar Novo Logs de Acesso</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/logs/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Usuario</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdusuario" name="cdusuario" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_usuarios[1])) { $ch=' selected="selected" '; }
 foreach ($view_usuarios as $usuarios) {
  echo '<option value="'.$usuarios['cdusuario'].'"'.$ch.'>'.$usuarios['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Data</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="data" name="data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Data"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Entidade</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="entidade" name="entidade" type="text" value="<?php echo $_POST['entidade']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Entidade"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Operacao</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="operacao" name="operacao" type="text" value="<?php echo $_POST['operacao']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Operacao"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Dados</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="dados" rows="4"><?php echo $_POST['dados']; ?></textarea>
</div></div>
</div></div>

<br>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/logs/" class="btn btn-default">Cancelar</a>
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
