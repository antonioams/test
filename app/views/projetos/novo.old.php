
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


<form action="/<?php echo PROJETO;?>/projetos/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>

                                  <div class="box-tab">

                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#t1" data-toggle="tab">Dados do Projeto</a>
                                        </li>
                                        <li><a href="#t2" data-toggle="tab">Localização</a>
                                        </li>
                                        <li><a href="#t3" data-toggle="tab">Fotos (Flickr)</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active in" id="t1">
<div class="form-group">
<label  class="control-label">Tipo</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdtipo" name="cdtipo" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_tipos[1])) { $ch=' selected="selected" '; }
 foreach ($view_tipos as $tipos) {
  echo '<option value="'.$tipos['cdtipo'].'"'.$ch.'>'.$tipos['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Instituicao</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdinstituicao" name="cdinstituicao" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_instituicoes[1])) { $ch=' selected="selected" '; }
 foreach ($view_instituicoes as $instituicoes) {
  echo '<option value="'.$instituicoes['cdinstituicao'].'"'.$ch.'>'.$instituicoes['sigla'].''.' - '.$instituicoes['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Fase</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdfase" name="cdfase" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_fases[1])) { $ch=' selected="selected" '; }
 foreach ($view_fases as $fases) {
  echo '<option value="'.$fases['cdfase'].'"'.$ch.'>'.$fases['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Area</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdarea" name="cdarea" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_areas[1])) { $ch=' selected="selected" '; }
 foreach ($view_areas as $areas) {
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
 if (empty($view_naturezas[1])) { $ch=' selected="selected" '; }
 foreach ($view_naturezas as $naturezas) {
  echo '<option value="'.$naturezas['cdnatureza'].'"'.$ch.'>'.$naturezas['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Municipio</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdmunicipio" name="cdmunicipio" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_municipios[1])) { $ch=' selected="selected" '; }
 foreach ($view_municipios as $municipios) {
  echo '<option value="'.$municipios['cdmunicipio'].'"'.$ch.'>'.$municipios['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Intervencao</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="intervencao" rows="4"><?php echo $_POST['intervencao']; ?></textarea>
</div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Objetivo</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="objetivo" rows="4"><?php echo $_POST['objetivo']; ?></textarea>
</div></div>
</div></div>

<div class="form-group">
<label  class="control-label">Programa</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdprograma" name="cdprograma" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_programas[1])) { $ch=' selected="selected" '; }
 foreach ($view_programas as $programas) {
  echo '<option value="'.$programas['cdprograma'].'"'.$ch.'>'.$programas['nome'].'</option>';
  } ?>
 </select></div></div>
</div></div>


                                        </div>
                                        <div class="tab-pane fade" id="t2">

<div class="form-group">
<label  class="control-label">Endereco</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="endereco" name="endereco" type="text" value="<?php echo $_POST['endereco']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Endereco"/><div id="mapa"></div></div></div>
 <link href="http://fonts.googleapis.com/css?family=Open+Sans:600" type="text/css" rel="stylesheet" />
 <link href="/<?php echo PROJETO;?>/inc/mapa/estilo.css" type="text/css" rel="stylesheet" />
 <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
 <script type="text/javascript" src="/<?php echo PROJETO;?>/inc/mapa/jquery.min.js"></script>
 <script type="text/javascript" src="/<?php echo PROJETO;?>/inc/mapa/mapa.js"></script>
 <script type="text/javascript" src="/<?php echo PROJETO;?>/inc/mapa/jquery-ui.custom.min.js"></script>
</div></div>
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
                                        <div class="tab-pane fade" id="t3">
<div class="form-group">
<label  class="control-label">Flicker</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="flicker" name="flicker" type="text" value="<?php echo $_POST['flicker']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Flicker"/></div></div>
</div></div>

                 </div>
                                </div>

<br>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/projetos/" class="btn btn-default">Cancelar</a>
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
