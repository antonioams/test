
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
<header class="panel-heading">Cadastrar Novo Usuários</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/usuarios/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<div class="form-group" style='display:none'>
<label  class="control-label">Perfil</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdperfil" name="cdperfil" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_perfis[1])) { $ch=' selected="selected" '; }
 foreach ($view_perfis as $perfis) {
  echo '<option value="'.$perfis['cdperfil'].'"'.$ch.'>'.$perfis['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Nome</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="nome" name="nome" type="text" value="<?php echo $_POST['nome']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Nome"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Login</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="login" name="login" type="text" value="<?php echo $_POST['login']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Login"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Senha</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="senha" name="senha" type="password" value="<?php echo $_POST['senha']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Senha"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Email</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="email" name="email" type="text" value="<?php echo $_POST['email']; ?>" class="form-control" data-parsley-type="email"  data-parsley-trigger="change" placeholder="Email"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'datanascimento') ? "style='display:none'" : "" )?>>
<label  class="control-label">Data de Nacimento</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="date" name="datanascimento" type="text" value="<?php echo $_POST['datanascimento']; ?>" class="form-control" placeholder="99/99/9999" data-parsley-trigger="change"/></div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'sexo') ? "style='display:none'" : "" )?>>
<label  class="control-label">Sexo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="sexo" name="sexo" data-parsley-trigger="change">
  <option value=""></option><option value="M" <?php if ($_POST['sexo']=='M') { echo 'selected';}?>>Masculino</option><option value="F" <?php if ($_POST['sexo']=='F') { echo 'selected';}?>>Feminino</option>
 </select></div></div>
</div></div>

<div class="form-group"  <?php echo ( ($view_vc[0]['chave'] == 'telefone') ? "style='display:none'" : "" )?>>
<label  class="control-label">Telefone</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="telefonem" name="telefone" type="text" value="<?php echo $_POST['telefone']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Telefone" maxlength="15"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Setor</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdunidade" name="cdunidade" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_unidades[1])) { $ch=' selected="selected" '; }
 foreach ($view_unidades as $unidades) {
  echo '<option value="'.$unidades['cdunidade'].'"'.$ch.'>'.$unidades['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>


<div class="control-group" id="positionGroup">
   <div class="controls icheck">
       <h5 class="text-uppercase mb15"><b>Ativo</b></h5>
     <div class="mb5 mt5">
         <input type="checkbox" id="minimal-checkbox-1" name="ativo" value="1" checked>
     </div>
    </div>
</div>

<br>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/usuarios/" class="btn btn-default">Cancelar</a>
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
