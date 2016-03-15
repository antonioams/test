
<?php
include('app/views/topo.php');
?>

    <style type="text/css">
.personalradios {
  list-style: none ;
  margin: 0 ;
  padding: 0 ;
}

.personalradios:after {
  content: "" ;
  clear: both ;
}

.personalradio {
  border: 1px solid #ccc ;
  box-sizing: border-box ;
  float: left ;
  height: 70px ;
  position: relative ;
  width: 70px ;
}
  

.personalradio label {
  background: #fff no-repeat center center ;
  bottom: -5px ;
  cursor: pointer ;
  display: block ;
  font-size: 0 ;
  left: 0px ;
  position: absolute ;
  right: 0px ;
  text-indent: 100% ;
  top: 0px ;
  white-space: nowrap ;
}

.personalradio + .personalradio {
  margin-left: 25px ;
}

.pagseguro label {
  background-image: url(https://dl.dropbox.com/s/yvzrr9o54s2llkr/uol.png) ;
}

.paypal label {
  background-image: url(https://dl.dropbox.com/s/i4z39zy2mtb7xq1/paypal.png) ;
}

.bankslip label {
  background-image: url(https://dl.dropbox.com/s/myj41602bom0g8p/bankslip.png) ;
}

.personalradios input:focus + label {
  outline: 2px dotted #9c9c9c ;
}

.personalradios input:checked + label {
  outline: 4px solid #9c9c9c ;
}

.personalradios input:checked + label:after {
  background: url(/<?php echo PROJETO;?>/inc/img/check.png) center no-repeat #9c9c9c ;
  bottom: -10px ;
  content: "" ;
  display: inline-block ;
  height: 20px ;
  position: absolute ;
  right: -10px ;
  width: 20px ;
}

@-moz-document url-prefix() {
  .personalradios input:checked + label:after {
    bottom: 0 ;
    right: 0 ;
    background-color: #9c9c9c ;
  }
    </style>
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

 <div class="widget">
                            <div class="widget-body no-p">
                                <form id="stepy" class="stepy" action="/<?php echo PROJETO;?>/projetos/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
                                    <fieldset title="Objetivos">

                                        <legend>Objetivo</legend>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nome do Projeto/Intervenção</label>
                                                <div>
                                                 <textarea class="form-control" name="projeto@intervencao" rows="4"><?php echo $_POST['projeto@intervencao']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>

<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'cdobjetivo_informacao') ? "style='display:none'" : "" )?>>Itens do Objetivo</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'peso') ? "style='display:none'" : "" )?>>Peso</div></th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td>
       <div class="controls icheck">
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="controlecheck" checked value="1">
       </div>
      </div>
   </td>
<td>

<div <?php echo ( ($view_vc[0]['chave'] == 'cdobjetivo_informacao') ? "style='display:none'" : "" )?>>
<select id="cdobjetivo_informacao" name="projeto_objetivo@cdobjetivo_informacao[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_objetivo_informacao[1])) { $ch=' selected="selected" '; }

 foreach ($view_objetivo_informacao as $objetivo_informacao) {
  echo '<option value="'.$objetivo_informacao['cdobjetivo_informacao'].'"'.$ch.'>'.$objetivo_informacao['logica'].''.' - '.$objetivo_informacao['tipo'].'</option>';
  } ?>
 </select>
 </div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'peso') ? "style='display:none'" : "" )?>>
<input id="peso" name="projeto_objetivo@peso[]" type="text" value="<?php echo $_POST['projeto_objetivo@peso']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Peso"/>
</div>
</td></tr>
</tbody></table> 
</div>




                                    </fieldset>
                                    <fieldset title="Dados do Projeto">

                                        <legend>informações Basicas</legend>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>tipo</label>
                                                <div>
                                                <select class="chosen" id="cdtipo" name="projeto@cdtipo" data-parsley-trigger="change">
                                                  <option value=""></option>
                                                     <?php
                                                     if (empty($view_tipos[1])) { $ch=' selected="selected" '; }
                                                     foreach ($view_tipos as $tipos){
                                                     echo '<option value="'.$tipos['cdtipo'].'"'.$ch.'>'.$tipos['nome'].'</option>';
                                                    } ?>
                                                 </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Instituição</label>
                                                <div>
                                                   <select class="chosen" id="cdinstituicao" name="projeto@cdinstituicao" data-parsley-trigger="change">
                                                      <option value=""></option>
                                                     <?php
                                                     if (empty($view_instituicoes[1])) { $ch=' selected="selected" '; }
                                                     foreach ($view_instituicoes as $instituicoes) {
                                                      echo '<option value="'.$instituicoes['cdinstituicao'].'"'.$ch.'>'.$instituicoes['sigla'].''.' - '.$instituicoes['nome'].'</option>';
                                                      } ?>
                                                     </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Fase</label>
                                                <div>
                                                <select class="chosen" id="cdfase" name="projeto@cdfase" data-parsley-trigger="change">
                                                  <option value=""></option>
                                                 <?php
                                                 if (empty($view_fases[1])) { $ch=' selected="selected" '; }
                                                 foreach ($view_fases as $fases) {
                                                  echo '<option value="'.$fases['cdfase'].'"'.$ch.'>'.$fases['nome'].'</option>';
                                                  } ?>
                                                 </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Municipio</label>
                                                <div>
                                                <select class="chosen" id="cdmunicipio" name="projeto@cdmunicipio" data-parsley-trigger="change">
                                                  <option value=""></option>
                                                 <?php
                                                 if (empty($view_municipios[1])) { $ch=' selected="selected" '; }
                                                 foreach ($view_municipios as $municipios) {
                                                  echo '<option value="'.$municipios['cdmunicipio'].'"'.$ch.'>'.$municipios['nome'].'</option>';
                                                  } ?>
                                                 </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset title="Localização">

                                        <legend>Endereço do Projeto</legend>

                                    <div class="form-group">
                                    <label  class="control-label">Endereco</label>
                                    <div class="controls">
                                    <div class="row"><div class="col-xs-12"><input id="endereco" name="projeto@endereco" type="text" value="<?php echo $_POST['projeto@endereco']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Endereco"/><div id="mapa"></div></div></div>
                                     <link href="http://fonts.googleapis.com/css?family=Open+Sans:600" type="text/css" rel="stylesheet" />
                                     <link href="/<?php echo PROJETO;?>/inc/mapa/estilo.css" type="text/css" rel="stylesheet" />
                                     <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
                                     <script type="text/javascript" src="/<?php echo PROJETO;?>/inc/mapa/jquery.min.js"></script>
                                     <script type="text/javascript" src="/<?php echo PROJETO;?>/inc/mapa/mapa.js"></script>
                                     <script type="text/javascript" src="/<?php echo PROJETO;?>/inc/mapa/jquery-ui.custom.min.js"></script>
                                    </div>
                                     </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Latitude</label>
                                                <div>
                                                <input id="latitude" name="projeto@latitude" type="text" value="<?php echo $_POST['projeto@latitude']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Latitude"/>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Longitude</label>
                                                <div>
                                                <input id="longitude" name="projeto@longitude" type="text" value="<?php echo $_POST['projeto@longitude']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Longitude"/>
                                                </div>
                                            </div>
                                        </div>
                                   
                                    </fieldset>

                                    <fieldset title="Imagens">

                                        <legend>Album do Flicker</legend>

                                    <div class="form-group">
                                    <label  class="control-label">Album</label>
                                    <div class="controls">
                                        <input id="flicker" name="projeto@flicker" type="text" value="<?php echo $_POST['projeto@flicker']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Flicker"/>
                                    </div>
                                    </fieldset>


                                    <button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary stepy-finish pull-right"><i class="ti-share mr5"></i>Cadastrar</button>

                                </form>
                            </div>
                        </div>

 </div>
 <?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
      <script src="/<?php echo PROJETO;?>/inc/plugins/datatables/jquery.dataTables.js"></script>
      <script src="/<?php echo PROJETO;?>/inc/js/script_dm.js"></script>
<?php }  ?> 
<?php
include('app/views/rodape_projeto.php');
?>
<!-- page level scripts -->
    <script src="/<?php echo PROJETO;?>/inc/plugins/stepy/jquery.validate.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/stepy/jquery.stepy.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/fuelux/wizard.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/chosen/chosen.jquery.min.js"></script>

    <!-- /page level scripts -->
    <script src="/<?php echo PROJETO;?>/inc/js/form-wizard.js"></script>

    