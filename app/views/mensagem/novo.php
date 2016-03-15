
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
<header class="panel-heading">Cadastrar Novo Chat</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/mensagem/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdchatmensagem') ? "style='display:none'" : "" )?>>
<label  class="control-label">cdchatmensagem</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="cdchatmensagem" name="cdchatmensagem" type="text" value="<?php echo $_POST['cdchatmensagem']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="cdchatmensagem" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'mensagem') ? "style='display:none'" : "" )?>>
<label  class="control-label">mensagem</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="mensagem" rows="4"><?php echo $_POST['mensagem']; ?></textarea>
</div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdgrupo') ? "style='display:none'" : "" )?>>
<label  class="control-label">cdgrupo</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="cdgrupo" name="cdgrupo" type="text" value="<?php echo $_POST['cdgrupo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="cdgrupo" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'cdusuario') ? "style='display:none'" : "" )?>>
<label  class="control-label">cdusuario</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="cdusuario" name="cdusuario" type="text" value="<?php echo $_POST['cdusuario']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="cdusuario" data-parsley-type="digits"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'datahora') ? "style='display:none'" : "" )?>>
<label  class="control-label">datahora</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="date" name="datahora" type="text" value="<?php echo $_POST['datahora']; ?>" class="form-control" placeholder="99/99/9999" data-parsley-trigger="change"/></div></div>
</div></div>

<br>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/mensagem/" class="btn btn-default">Cancelar</a>
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
