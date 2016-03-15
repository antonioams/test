
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
<header class="panel-heading">Cadastrar Novos Usuários</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/usuarios/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th>Perfil</th><th>Nome</th><th>Login</th><th>Senha</th><th>Email</th><th>Ativo</th><th>Setor</th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>
    <td>
<select id="cdperfil" name="cdperfil[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_perfis[1])) { $ch=' selected="selected" '; }

 foreach ($view_perfis as $perfis) {
  echo '<option value="'.$perfis['cdperfil'].'"'.$ch.'>'.$perfis['descricao'].'</option>';
  } ?>
 </select>
</td><td>
<input id="nome" name="nome[]" type="text" value="<?php echo $_POST['nome']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Nome"/>

</td><td>
<input id="login" name="login[]" type="text" value="<?php echo $_POST['login']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Login"/>

</td><td>
<input id="senha" name="senha[]" type="password" value="<?php echo $_POST['senha']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Senha"/>

</td><td>
<input id="email" name="email[]" type="text" value="<?php echo $_POST['email']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Email" data-parsley-type="email"/>
</td><td>
<select id="cdunidade" name="cdunidade[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_unidades[1])) { $ch=' selected="selected" '; }

 foreach ($view_unidades as $unidades) {
  echo '<option value="'.$unidades['cdunidade'].'"'.$ch.'>'.$unidades['nome'].'</option>';
  } ?>
 </select>
</td>
<td>
<div class="control-group" id="positionGroup">
   <div class="controls icheck">
       <h5 class="text-uppercase mb15"><b>Ativo</b></h5>
     <div class="mb5 mt5">
         <input type="checkbox" id="minimal-checkbox-1" name="ativo" value="1" checked>
     </div>
    </div>
</div>

</td>
</tr>
</tbody></table> 
</div>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/usuarios/" class="btn btn-default">Cancelar</a>


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
