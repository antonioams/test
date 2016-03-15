
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



<form action="/<?php echo PROJETO;?>/clientes/insere/" role="form" method="post" name="formnovo" enctype="multipart/form-data" class="parsley-form" data-parsley-validate>



                                <div class="box-tab">

                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#t1" data-toggle="tab">Dados do Cliente</a>
                                        </li>
                                        <li><a href="#t2" data-toggle="tab">Configuraçöes</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active in" id="t1">

<div class="form-group">
<label  class="control-label">Nome</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="nome" name="nome" type="text" value="<?php echo $_POST['nome']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Nome"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Contato</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="contato" name="contato" type="text" value="<?php echo $_POST['contato']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Contato"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Telefone1</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="telefone1" name="telefone1" type="text" value="<?php echo $_POST['telefone1']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Telefone1"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Telefone2</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="telefone2" name="telefone2" type="text" value="<?php echo $_POST['telefone2']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Telefone2"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Email</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="email" name="email" type="text" value="<?php echo $_POST['email']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Email"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Data</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="date" name="data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control" placeholder="99/99/9999" data-parsley-trigger="change"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Endereço</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="endereco" name="endereco" type="text" value="<?php echo $_POST['endereco']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Endereço"/><div id="mapa"></div></div></div>
 <link href="http://fonts.googleapis.com/css?family=Open+Sans:600" type="text/css" rel="stylesheet" />
 <link href="/<?php echo PROJETO;?>/inc/mapa/estilo.css" type="text/css" rel="stylesheet" />
 <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
 <script type="text/javascript" src="/<?php echo PROJETO;?>/inc/mapa/jquery.min.js"></script>
 <script type="text/javascript" src="/<?php echo PROJETO;?>/inc/mapa/mapa.js"></script>
 <script type="text/javascript" src="/<?php echo PROJETO;?>/inc/mapa/jquery-ui.custom.min.js"></script>
</div></div>

<div class="form-group">
<label  class="control-label">Latitude</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="latitude" name="latitude" type="text" value="<?php echo $_POST['latitude']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Latitude"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Longitude</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="longitude" name="longitude" type="text" value="<?php echo $_POST['longitude']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Longitude"/></div></div>
</div></div>


                                </div>
                                <div class="tab-pane fade active" id="t2">

<div class="form-group">
<label  class="control-label">Identificação</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="sigla" name="sigla" type="text" value="<?php echo $_POST['sigla']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Identificação"/></div></div>
</div></div>



<div class="form-group">
<label  class="control-label">Logo</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="logo" name="logo" type="file" value="<?php echo $_POST['file']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Logo do Cliente"/></div></div>
</div></div>


<div class="form-group">
<label  class="control-label">Texto Mapa</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><textarea class="form-control" name="texto" rows="4"><?php echo $_POST['texto']; ?></textarea></div></div>
</div></div>


<div class="form-group">
<label  class="control-label">Layout</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdlayout" name="cdlayout" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_layouts[1])) { $ch=' selected="selected" '; }
 foreach ($view_layouts as $layouts) {
  echo '<option value="'.$layouts['cdlayout'].'"'.$ch.'>'.$layouts['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>


<div class="form-group">
<label  class="control-label">Layout Mapa</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdlayoutmapa" name="cdlayoutmapa" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_layoutmapa[1])) { $ch=' selected="selected" '; }
 foreach ($view_layoutmapa as $view_layoutmapa) {
  echo '<option value="'.$view_layoutmapa['cdlayoutmapa'].'"'.$ch.'>'.$view_layoutmapa['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>



<div class="form-group">
<label  class="control-label">Flickr Chave API</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="flickr_chave" name="flickr_chave" type="text" value="<?php echo $_POST['flickr_chave']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Flickr Chave API"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Flickr Chave Secreta</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="flickr_sec" name="flickr_sec" type="text" value="<?php echo $_POST['flickr_sec']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Flickr Chave Secreta"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Flickr Código Usuário</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="flickr_usuario" name="flickr_usuario" type="text" value="<?php echo $_POST['flickr_usuario']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Flickr Código Usuário"/></div></div>
</div></div>

 </div>
  </div>
    </div>
<br>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/clientes/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>

 </form>

 </div>
 <?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }  ?> 
<?php
include('app/views/rodape.php');
?>
