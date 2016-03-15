
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
<header class="panel-heading">Cadastrar Novos Clientes/Perfis</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/clientes/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th>Nome</th><th>Contato</th><th>Telefone1</th><th>Telefone2</th><th>Email</th><th>Data</th><th>Endereço</th><th>Latitude</th><th>Longitude</th><th>Layout</th><th>Layout Mapa</th><th>Identificação</th><th>Flickr Chave API</th><th>Flickr Chave Secreta</th><th>Flickr Código Usuário</th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>
    <td>

<input id="nome" name="nome[]" type="text" value="<?php echo $_POST['nome']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Nome"/>

</td><td>

<input id="contato" name="contato[]" type="text" value="<?php echo $_POST['contato']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Contato"/>

</td><td>

<input id="telefone1" name="telefone1[]" type="text" value="<?php echo $_POST['telefone1']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Telefone1"/>

</td><td>

<input id="telefone2" name="telefone2[]" type="text" value="<?php echo $_POST['telefone2']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Telefone2"/>

</td><td>

<input id="email" name="email[]" type="text" value="<?php echo $_POST['email']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Email"/>

</td><td>
<input id="date" name="data[]" type="text" value="<?php echo $_POST['data']; ?>" class="form-control" placeholder="99/99/9999" data-parsley-trigger="change"/>
</td><td>

<input id="endereco" name="endereco[]" type="text" value="<?php echo $_POST['endereco']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Endereço"/>

</td><td>

<input id="latitude" name="latitude[]" type="text" value="<?php echo $_POST['latitude']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Latitude"/>

</td><td>

<input id="longitude" name="longitude[]" type="text" value="<?php echo $_POST['longitude']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Longitude"/>

</td><td>
<select id="cdlayout" name="cdlayout[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_layouts[1])) { $ch=' selected="selected" '; }

 foreach ($view_layouts as $layouts) {
  echo '<option value="'.$layouts['cdlayout'].'"'.$ch.'>'.$layouts['nome'].'</option>';
  } ?>
 </select>
</td><td>
<select id="cdlayoutmapa" name="cdlayoutmapa[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_layoutmapa[1])) { $ch=' selected="selected" '; }

 foreach ($view_layoutmapa as $layoutmapa) {
  echo '<option value="'.$layoutmapa['cdlayoutmapa'].'"'.$ch.'>'.$layoutmapa['nome'].'</option>';
  } ?>
 </select>
</td><td>

<input id="sigla" name="sigla[]" type="text" value="<?php echo $_POST['sigla']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Identificação"/>

</td><td>

<input id="flickr_chave" name="flickr_chave[]" type="text" value="<?php echo $_POST['flickr_chave']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Flickr Chave API"/>

</td><td>

<input id="flickr_sec" name="flickr_sec[]" type="text" value="<?php echo $_POST['flickr_sec']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Flickr Chave Secreta"/>

</td><td>

<input id="flickr_usuario" name="flickr_usuario[]" type="text" value="<?php echo $_POST['flickr_usuario']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Flickr Código Usuário"/>

</td></tr>
</tbody></table> 
</div>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/clientes/" class="btn btn-default">Cancelar</a>


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
