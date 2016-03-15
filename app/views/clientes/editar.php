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



<form action="/<?php echo PROJETO;?>/clientes/atualiza/id/<?php echo $view_clientes[0]['cdcliente'];?>" role="form" method="post" enctype="multipart/form-data" name="formeditar" class="parsley-form" data-parsley-validate>


                                <div class="box-tab">

                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#t1" data-toggle="tab">Dados do Cliente</a>
                                        </li>
                                        <li><a href="#t2" data-toggle="tab">Configuraçöes</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content"  style="padding-left:10px;">
                                        <div class="tab-pane fade active in" id="t1">


<div class="form-group">
<label  class="control-label">Nome</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="nome" name="nome" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_clientes[0]['nome'] ) : ( $_POST['nome'] ) ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Nome"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Contato</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="contato" name="contato" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_clientes[0]['contato'] ) : ( $_POST['contato'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Contato"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Telefone1</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="telefonem" name="telefone1" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_clientes[0]['telefone1'] ) : ( $_POST['telefone1'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Telefone1" maxlength="15"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Telefone2</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="telefonem" name="telefone2" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_clientes[0]['telefone2'] ) : ( $_POST['telefone2'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Telefone2" maxlength="15"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Email</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="email" name="email" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_clientes[0]['email'] ) : ( $_POST['email'] ) ?>" class="form-control" data-parsley-type="email" data-parsley-trigger="change" placeholder="Email"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Data</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="date" name="data" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_clientes[0]['data'] ) : ( $_POST['data'] ) ?>" class="form-control" placeholder="99/99/9999" data-parsley-trigger="change"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Endereço</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="endereco" name="endereco" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_clientes[0]['endereco'] ) : ( $_POST['endereco'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Endereço"/><div id="mapa"></div></div></div>
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
<div class="row"><div class="col-xs-4"><input id="latitude" name="latitude" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_clientes[0]['latitude'] ) : ( $_POST['latitude'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Latitude"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Longitude</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="longitude" name="longitude" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_clientes[0]['longitude'] ) : ( $_POST['longitude'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Longitude"/></div></div>
</div></div>

                                </div>
                                <div class="tab-pane fade" id="t2">


<div class="form-group">
<label  class="control-label">Identificação</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="sigla" name="sigla" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_clientes[0]['sigla'] ) : ( $_POST['sigla'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Identificação"/></div></div>
</div></div>



<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Ativo</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="ativo" value="1" <?php if ($view_clientes[0]['ativo']==1) { echo 'checked';} ?>>
       </div>
      </div>
</div>


<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Marcar Cliente como Template</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="template" value="1" <?php if ($view_clientes[0]['template']==1) { echo 'checked';} ?>>
       </div>
      </div>
</div>

<div class="form-group">
<label  class="control-label">Logo</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
  <img class="avatar avatar-lg img-thumbnail" src="/<?php echo PROJETO?>/inc/img/cliente/c<?php echo $view_clientes[0]['cdcliente']?>.png"> <br>
  <input id="logo" name="logo" type="file"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Texto Mapa</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
  <textarea class="form-control" name="texto" rows="4"><?php echo ( empty( $_POST ) ) ? ( $view_clientes[0]['texto'] ) : ( $_POST['texto'] ) ?></textarea></div></div>
</div></div>



<div class="form-group">
<label  class="control-label">Layout</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdlayout" name="cdlayout" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_clientes[0]['cdlayout'] ) : ( $_POST['cdlayout'] ); 

 foreach ($view_layouts as $layouts) {
   $ch=""; 
  if ($vmarcado==$layouts['cdlayout']) { $ch=' selected="selected" '; } 
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
 $vmarcado = ( empty( $_POST ) ) ? ( $view_clientes[0]['cdlayoutmapa'] ) : ( $_POST['cdlayoutmapa'] ); 

 foreach ($view_layoutmapa as $layoutmapa) {
   $ch=""; 
  if ($vmarcado==$layoutmapa['cdlayoutmapa']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$layoutmapa['cdlayoutmapa'].'"'.$ch.'>'.$layoutmapa['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>




<div class="form-group">
<label  class="control-label">Flickr Chave API</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="flickr_chave" name="flickr_chave" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_clientes[0]['flickr_chave'] ) : ( $_POST['flickr_chave'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Flickr Chave API"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Flickr Chave Secreta</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="flickr_sec" name="flickr_sec" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_clientes[0]['flickr_sec'] ) : ( $_POST['flickr_sec'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Flickr Chave Secreta"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Flickr Código Usuário</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="flickr_usuario" name="flickr_usuario" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_clientes[0]['flickr_usuario'] ) : ( $_POST['flickr_usuario'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Flickr Código Usuário"/></div></div>
</div></div>

 </div>
  </div>
    </div>
<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/clientes/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/clientes/exclui/id/<?php echo $view_clientes[0]['cdcliente'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
                    Excluir</a>
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
