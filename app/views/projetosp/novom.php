
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
<header class="panel-heading">Cadastrar Novos Projetos</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/projetos/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable1')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable1')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th>Tipo</th><th>Instituicao</th><th>Fase</th><th>Area</th><th>Natureza</th><th>Municipio</th><th>Intervencao</th><th>Objetivo</th><th>Programa</th><th>Endereco</th><th>Latitude</th><th>Longitude</th><th>Flicker</th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>
    <td>
<select id="cdtipo" name="cdtipo[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_tipos[1])) { $ch=' selected="selected" '; }

 foreach ($view_tipos as $tipos) {
  echo '<option value="'.$tipos['cdtipo'].'"'.$ch.'>'.$tipos['nome'].'</option>';
  } ?>
 </select>
</td><td>
<select id="cdinstituicao" name="cdinstituicao[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_instituicoes[1])) { $ch=' selected="selected" '; }

 foreach ($view_instituicoes as $instituicoes) {
  echo '<option value="'.$instituicoes['cdinstituicao'].'"'.$ch.'>'.$instituicoes['sigla'].''.' - '.$instituicoes['nome'].'</option>';
  } ?>
 </select>
</td><td>
<select id="cdfase" name="cdfase[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_fases[1])) { $ch=' selected="selected" '; }

 foreach ($view_fases as $fases) {
  echo '<option value="'.$fases['cdfase'].'"'.$ch.'>'.$fases['nome'].'</option>';
  } ?>
 </select>
</td><td>
<select id="cdarea" name="cdarea[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_areas[1])) { $ch=' selected="selected" '; }

 foreach ($view_areas as $areas) {
  echo '<option value="'.$areas['cdarea'].'"'.$ch.'>'.$areas['descricao'].'</option>';
  } ?>
 </select>
</td><td>
<select id="cdnatureza" name="cdnatureza[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_naturezas[1])) { $ch=' selected="selected" '; }

 foreach ($view_naturezas as $naturezas) {
  echo '<option value="'.$naturezas['cdnatureza'].'"'.$ch.'>'.$naturezas['nome'].'</option>';
  } ?>
 </select>
</td><td>
<select id="cdmunicipio" name="cdmunicipio[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_municipios[1])) { $ch=' selected="selected" '; }

 foreach ($view_municipios as $municipios) {
  echo '<option value="'.$municipios['cdmunicipio'].'"'.$ch.'>'.$municipios['nome'].'</option>';
  } ?>
 </select>
</td><td>
<textarea class="form-control" name="intervencao[]" rows="1"><?php echo $_POST['intervencao']; ?></textarea>
</td><td>
<textarea class="form-control" name="objetivo[]" rows="1"><?php echo $_POST['objetivo']; ?></textarea>
</td><td>
<select id="cdprograma" name="cdprograma[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_programas[1])) { $ch=' selected="selected" '; }

 foreach ($view_programas as $programas) {
  echo '<option value="'.$programas['cdprograma'].'"'.$ch.'>'.$programas['nome'].'</option>';
  } ?>
 </select>
</td><td>
<input id="endereco" name="endereco[]" type="text" value="<?php echo $_POST['endereco']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Endereco"/>

</td><td>
<input id="latitude" name="latitude[]" type="text" value="<?php echo $_POST['latitude']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Latitude" data-parsley-type="digits"/>
</td><td>
<input id="longitude" name="longitude[]" type="text" value="<?php echo $_POST['longitude']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Longitude" data-parsley-type="digits"/>
</td><td>
<input id="flicker" name="flicker[]" type="text" value="<?php echo $_POST['flicker']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Flicker"/>

</td></tr>
</tbody></table> 
</div>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/projetos/" class="btn btn-default">Cancelar</a>


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
