
<?php
include('app/views/topo.php');
?>
<div class="<?php echo $_SESSION['mensagem']['tipo'];?>">
                                <?php
                                echo $_SESSION['mensagem']['texto'];
                                unset( $_SESSION['mensagem'] );?>
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
<header class="panel-heading">Cadastrar Novo Módulos</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/gmodulo/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>

<div class="form-group">
<label  class="control-label">Módulo Pai</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdmodulopai" name="cdmodulopai">
  <option value=""></option>
 <?php

 $vmarcado = $_POST['cdmodulopai']; 

 foreach ($view_lmodulos as $lmodulos) {
  echo '<option value="'.$lmodulos['cdmodulo'].'">'.$lmodulos['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'nome') ? "style='display:none'" : "" )?>>
<label  class="control-label">Nome</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="nome" name="nome" type="text" value="<?php echo $_POST['nome']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Nome"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'atalho') ? "style='display:none'" : "" )?>>
<label  class="control-label">Atalho</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="atalho" name="atalho" type="text" value="<?php echo $_POST['atalho']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Atalho"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'ordem') ? "style='display:none'" : "" )?>>
<label  class="control-label">Ordem</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="ordem" name="ordem" type="text" value="<?php echo $_POST['ordem']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Ordem" data-parsley-type="digits"/></div></div>
</div></div>

                     <div class="form-group">
                      <div class="controls icheck">

                             <input type="checkbox" id="minimal-checkbox-1" name="bloqueado" value="1">
                         
                           Bloqueado
  
                      </div>
                     </div>

<br>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/gmodulo/" class="btn btn-default">Cancelar</a>
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
