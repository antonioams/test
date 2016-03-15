
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
<header class="panel-heading">Editar Tela Inicial</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/inicial/atualiza/id/<?php echo $view_inicial[0]['cdinicio'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
<div class="form-group">
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="descricao" name="descricao" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_inicial[0]['descricao'] ) : ( $_POST['descricao'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Descrição"/></div></div>
</div></div>

<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/inicial/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/inicial/exclui/id/<?php echo $view_inicial[0]['cdinicio'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
                    Excluir</a>
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
