
<?php
include('app/views/topo.php');
if ($view_clientes['flickr_chave']!='') {
require_once("phpFlickr.php");
$f = new phpFlickr($view_clientes['flickr_chave'],$view_clientes['flickr_sec']); 
//$set = $f->photosets_getList($view_clientes['flickr_usuario']); 
}


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

<div class="panel-body">

<form action="/<?php echo PROJETO;?>/projetos/atualiza/id/<?php echo $view_projetos[0]['cdprojeto'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>



  <div class="panel">

  <div class="panel-body">

<div class="form-group">
<label  class="control-label">Tipo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdtipo" name="cdtipo" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_projetos[0]['cdtipo'] ) : ( $_POST['cdtipo'] ); 

 foreach ($view_tipos as $tipos) {
   $ch=""; 
  if ($vmarcado==$tipos['cdtipo']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$tipos['cdtipo'].'"'.$ch.'>'.$tipos['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Instituição</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdinstituicao" name="cdinstituicao" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_projetos[0]['cdinstituicao'] ) : ( $_POST['cdinstituicao'] ); 

 foreach ($view_instituicoes as $instituicoes) {
   $ch=""; 
  if ($vmarcado==$instituicoes['cdinstituicao']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$instituicoes['cdinstituicao'].'"'.$ch.'>'.$instituicoes['sigla'].''.' - '.$instituicoes['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Área</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdarea" name="cdarea" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_projetos[0]['cdarea'] ) : ( $_POST['cdarea'] ); 

 foreach ($view_areas as $areas) {
   $ch=""; 
  if ($vmarcado==$areas['cdarea']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$areas['cdarea'].'"'.$ch.'>'.$areas['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Natureza</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdnatureza" name="cdnatureza" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_projetos[0]['cdnatureza'] ) : ( $_POST['cdnatureza'] ); 

 foreach ($view_naturezas as $naturezas) {
   $ch=""; 
  if ($vmarcado==$naturezas['cdnatureza']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$naturezas['cdnatureza'].'"'.$ch.'>'.$naturezas['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Município</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdmunicipio" name="cdmunicipio" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_projetos[0]['cdmunicipio'] ) : ( $_POST['cdmunicipio'] ); 

 foreach ($view_municipios as $municipios) {
   $ch=""; 
  if ($vmarcado==$municipios['cdmunicipio']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$municipios['cdmunicipio'].'"'.$ch.'>'.$municipios['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Situação</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdsituacao" name="cdsituacao" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_projetos[0]['cdsituacao'] ) : ( $_POST['cdsituacao'] ); 

 foreach ($view_situacao as $situacao) {
   $ch=""; 
  if ($vmarcado==$situacao['cdsituacao']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$situacao['cdsituacao'].'"'.$ch.'>'.$situacao['descricao'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Intervenção</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="intervencao" rows="4"><?php echo ( empty( $_POST ) ) ? ( $view_projetos[0]['intervencao'] ) : ( $_POST['intervencao'] ) ?></textarea>
</div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Objetivo</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="objetivo" rows="4"><?php echo ( empty( $_POST ) ) ? ( $view_projetos[0]['objetivo'] ) : ( $_POST['objetivo'] ) ?></textarea>
</div></div>
</div></div>


<div class="form-group">
<label  class="control-label">Data Início</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="date" name="datahora" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_projetos[0]['datahora'] ) : ( $_POST['datahora'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Data Início"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Programa</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdprograma" name="cdprograma" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_projetos[0]['cdprograma'] ) : ( $_POST['cdprograma'] ); 

 foreach ($view_programas as $programas) {
   $ch=""; 
  if ($vmarcado==$programas['cdprograma']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$programas['cdprograma'].'"'.$ch.'>'.$programas['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>



<div class="form-group">
<label  class="control-label">Endereço</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="endereco" name="endereco" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_projetos[0]['endereco'] ) : ( $_POST['endereco'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Endereco"/><div id="mapa"></div></div></div>
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
<div class="row"><div class="col-xs-4"><input id="latitude" name="latitude" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_projetos[0]['latitude'] ) : ( $_POST['latitude'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Latitude"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Longitude</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="longitude" name="longitude" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_projetos[0]['longitude'] ) : ( $_POST['longitude'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Longitude"/></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Album Flickr</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="flicker" name="flicker" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_projetos[0]['flicker'] ) : ( $_POST['flicker'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Flicker"/></div></div>
</div></div>


    </div>
  </div>
  </div>

<br>

<script type="text/javascript">
<!--
function myPopup2() {
window.open( "http://200.98.201.124/sig/fotos/", "myWindow", 
"status = 1, height = 300, width = 300, resizable = 0" )
}
//-->
</script>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/projetos/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="#"  class="btn btn-danger btn-sig" onclick="javascript: if (confirm('Deseja realmente excluir o Projeto? Todos os cadastros vinculados a ele tambem serao excluidos.'))location.href='/<?php echo PROJETO;?>/projetos/exclui/id/<?php echo $view_projetos[0]['cdprojeto'];?>'">
<i class=" fa fa-fw fa-times-circle"></i>
                    Excluir</a>
                   
<button type="button" onClick="myPopup2()" class="btn btn-default">Upload Fotos</button>

 </form>
  </div>
 </div>
 <?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }  ?> 
<?php
include('app/views/rodape.php');
?>
