
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
<header class="panel-heading">Cadastrar Novos Layout do Mapa</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/layoutmapa/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th>Nome</th><th>Cor_topo</th><th>Cor_menu</th><th>Cor_texto</th><th>Cor_textomenu</th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>
    <td>

<input id="nome" name="nome[]" type="text" value="<?php echo $_POST['nome']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Nome"/>

</td><td>

<input id="cor_topo" name="cor_topo[]" type="text" value="<?php echo $_POST['cor_topo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Cor_topo"/>

</td><td>

<input id="cor_menu" name="cor_menu[]" type="text" value="<?php echo $_POST['cor_menu']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Cor_menu"/>

</td><td>

<input id="cor_texto" name="cor_texto[]" type="text" value="<?php echo $_POST['cor_texto']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Cor_texto"/>

</td><td>

<input id="cor_textomenu" name="cor_textomenu[]" type="text" value="<?php echo $_POST['cor_textomenu']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Cor_textomenu"/>

</td></tr>
</tbody></table> 
</div>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/layoutmapa/" class="btn btn-default">Cancelar</a>


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
