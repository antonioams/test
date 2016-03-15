
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
                                <form id="stepy" class="stepy" action="/<?php echo PROJETO;?>/projetos/inserew/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
                                    <fieldset title="Dados do Projeto">

                                        <legend>Nome/Produtos</legend>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nome do Projeto/Intervenção</label>
                                                <div>
                                                 <textarea class="form-control" name="projeto@intervencao" rows="4"><?php echo $_POST['projeto@intervencao']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Objetivo</label>
                                                <div>
                                                 <textarea class="form-control" name="projeto@objetivo" rows="4"><?php echo $_POST['projeto@objetivo']; ?></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label  class="control-label">Data Início</label>
                                                <div class="controls">
                                                <div class="row"><div class="col-xs-4"><input id="date" name="projeto@datahora" type="text" value="<?php echo date("d/m/y"); ?>" class="form-control" placeholder="99/99/9999" data-parsley-trigger="change"/></div></div>
                                                </div>
                                            </div>
                                            
                                            
                                                <div class="form-group">
                                                <label>Programa</label>
                                                <div>
                                                <select class="chosen" id="cdprograma" name="projeto@cdprograma" data-parsley-trigger="change" data-parsley-required="true" >
                                                  <option value=""></option>
                                                     <?php

                                                     foreach ($view_programas as $programas){
                                                     echo '<option value="'.$programas['cdprograma'].'"'.$ch.'>'.$programas['nome'].'</option>';
                                                    } ?>
                                                 </select>
                                                </div>
                                            </div>   
                                        </div>
<div style="display:none" id="regula">
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable" class="table table-bordered table-striped" > 
  <thead>
  <tr>
  <th></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'cdproduto') ? "style='display:none'" : "" )?>>Produto/Serviço</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'peso') ? "style='display:none'" : "" )?>>Peso</div></th>
  </tr>
  </thead>
   <tbody>
   <tr>
<td><input type="checkbox" checked="checked" name="asd" />
</td>
    <td>
<div <?php echo ( ($view_vc[0]['chave'] == 'cdproduto') ? "style='display:none'" : "" )?>>
<select  id="cdproduto" name="projeto_produto@cdproduto[]" data-parsley-trigger="change">
  <option value=""></option>
 
 </select>
 
 </div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'peso') ? "style='display:none'" : "" )?>>
<input id="projeto_produto@peso" name="projeto_produto@peso[]" type="text" value="<?php echo $_POST['projeto_produto@peso']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Peso"/>
</div>
</td></tr>
</tbody></table> 
</div>
</div>



                                    </fieldset>
                                    <fieldset title="Identificação">

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
                                                <label>Área</label>
                                                <div>
                                                <ul class="personalradios">
                                                 <?php
                                                 if (empty($view_areas[1])) { $ch=' '; }
                                                 foreach ($view_areas as $areas) {
                                                  if(!empty($areas['icone'])){
                                                    $url ="/".PROJETO."/inc/img/area/".$areas['icone'];
                                                  }else{
                                                    $url  ="/".PROJETO."/inc/img/semcat.jpg";
                                                  }
                                                  echo '<div class="col-md-2" style="padding-bottom: 4px;"> <li class="personalradio"><input type="radio" id="'.$areas['cdarea'].'" name="cdarea" value="'.$areas['cdarea'].'"> <label style=" background-color:#fff; background-image: url(\''.$url.'\'); background-size: 70px 70px; background-repeat: no-repeat;" for="'.$areas['cdarea'].'" title="'.$areas['descricao'].'">'.$areas['descricao'].'</label></li></div>';
                                                  } ?>
                                                </ul>
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
                                        
                                            
                                            
                                        
                                        
                                        
                                                                            
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Situação</label>
                                                <div>
                                                <select class="chosen" id="cdsituacao" name="projeto@cdsituacao" data-parsley-trigger="change">
                                                  <option value=""></option>
                                                 <?php
                                                 if (empty($view_situacao[1])) { $ch=' selected="selected" '; }
                                                 foreach ($view_situacao as $situacao) {
                                                  echo '<option value="'.$situacao['cdsituacao'].'"'.$ch.'>'.$situacao['descricao'].'</option>';
                                                  } ?>
                                                 </select>
                                                </div>
                                            </div>
                                            
                                            <br>
                                            
                                      <div class="form-group">
                                                <label>Natureza</label>
                                                <div>
                                                <select class="chosen" id="cdnatureza" name="projeto@cdnatureza" data-parsley-trigger="change">
                                                  <option value=""></option>
                                                 <?php
                                                 if (empty($view_naturezas[1])) { $ch=' selected="selected" '; }
                                                 foreach ($view_naturezas as $naturezas) {
                                                  echo '<option value="'.$naturezas['cdnatureza'].'"'.$ch.'>'.$naturezas['nome'].'</option>';
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

                                        <legend>Album do Flickr</legend>

                                    <div class="form-group">
                                    <label  class="control-label">Album</label>
                                    <div class="controls">
                                        <input id="flicker" name="projeto@flicker" type="text" value="<?php echo $_POST['projeto@flicker']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Flickr"/>
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
<?php }  ?> 
<?php
//include('app/views/rodape.php');
?>
            </section>

    </div>
    </div>
    </div>
    </div>
    </section>
    </div>


    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery-1.11.1.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/bootstrap/js/bootstrap.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.slimscroll.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.easing.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/appear/jquery.appear.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.placeholder.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/fastclick.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/offscreen.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/main.js"></script>

    <script src="/<?php echo PROJETO;?>/inc/plugins/chosen/chosen.jquery.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/bootstrap-datatables.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.sortable.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.nestable.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/table-edit.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/script_dm.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/icheck/icheck.js"></script>

   

    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.maskedinput.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/form-masks.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/general.js"></script>



    <script src="/<?php echo PROJETO;?>/inc/plugins/isotope/isotope.pkgd.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/imagesloaded/imagesloaded.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/superbox/superbox.min.js"></script>

    <script src="/<?php echo PROJETO;?>/inc/js/gallery.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/dropzone/dropzone.js"></script>
        <script src="/<?php echo PROJETO;?>/inc/plugins/stepy/jquery.validate.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/stepy/jquery.stepy.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/fuelux/wizard.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/chosen/chosen.jquery.min.js"></script>
    <!-- /page level scripts -->
    <script src="/<?php echo PROJETO;?>/inc/js/form-wizard-proj.js"></script>

</body>
</html>

<!-- page level scripts --> 
<script type="text/javascript">
$(document).ready(function(){       
	
 $('#cdprograma').change(function(e) {
     deleteRow('dataTable');
     var programa = $('#cdprograma').val(); 
     $.getJSON('/<?php echo PROJETO;?>/projetos/carregaproduto/id/'+programa, function (dados) { 
        if (dados.length > 0){ 
            var option = ''; 
             $.each(dados, function(i, obj) { 
                option += '<option value="'+obj.cdproduto+'">'+obj.logica+'</option>'; 
                }) 
                 } 
                 $('#cdproduto').html(option).show();
                  $('#regula').css("display","block"); 
               }) })

  
  });
</script>    


    