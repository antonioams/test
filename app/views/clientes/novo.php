
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
                                <form id="stepy" class="stepy" action="/<?php echo PROJETO;?>/clientes/insere/"  role="form" method="post" enctype="multipart/form-data" name="formeditar" class="parsley-form" data-parsley-validate>
                                     <fieldset title="dados">

                                        <legend>Novo Cliente</legend>

                                        <div class="form-group">
                                            <div class="form-group">
                                                <label  class="control-label">Nome</label>
                                                 <div class="controls">
                                                 <div class="row"><div class="col-xs-12"><input id="nome" name="nome" type="text" value="<?php echo $_POST['nome']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Nome"/></div></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label  class="control-label">Identificação</label>
                                                <div class="controls">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <input id="sigla" name="sigla" type="text" value="<?php echo $_POST['sigla']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Identificação"/>
                                                        </div>
                                                    </div>
                                            </div></div>
                                            
                                            <div class="control-group" id="positionGroup">
                                            <div class="controls icheck">
                                             <h5>Ativo</h5>
                                             <div class="mb5 mt5">
                                              <input type="checkbox" id="minimal-checkbox-1" name="ativo" value="1">
                                              </div>
                                            </div>
                                    </div>                                            
                                            
                                            <div class="control-group" id="positionGroup">
                                            <div class="controls icheck">
                                             <h5>Marcar Cliente como Template</h5>
                                             <div class="mb5 mt5">
                                              <input type="checkbox" id="minimal-checkbox-1" name="template" value="1">
                                              </div>
                                            </div>
                                    </div>
                                    

                                                                        
                                    </fieldset>

                                    <fieldset title="contato">

                                        <legend>Informações de Contato</legend>

                                        <div class="form-group">
                                        <label  class="control-label">Contato</label>
                                        <div class="controls">
                                        <div class="row"><div class="col-xs-12"><input id="contato" name="contato" type="text" value="<?php echo $_POST['contato']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Contato"/></div></div>
                                        </div></div>

                                        <div class="form-group">
                                        <label  class="control-label">Telefone1</label>
                                        <div class="controls">
                                        <div class="row"><div class="col-xs-12"><input id="telefonem" name="telefone1" type="text" value="<?php echo $_POST['telefone1']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Telefone1" maxlength="15"/></div></div>
                                        </div></div>

                                        <div class="form-group">
                                        <label  class="control-label">Telefone2</label>
                                        <div class="controls">
                                        <div class="row"><div class="col-xs-12"><input id="telefonem" name="telefone2" type="text" value="<?php echo $_POST['telefone2']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Telefone2" maxlength="15"/></div></div>
                                        </div></div>

                                        <div class="form-group">
                                        <label  class="control-label">Email</label>
                                        <div class="controls">
                                        <div class="row"><div class="col-xs-12"><input id="email" name="email" type="text" value="<?php echo $_POST['email']; ?>" class="form-control"  data-parsley-type="email" data-parsley-trigger="change" placeholder="Email"/></div></div>
                                        </div></div>

                                        <div class="form-group">
                                        <label  class="control-label">Data</label>
                                        <div class="controls">
                                        <div class="row"><div class="col-xs-4"><input id="date" name="data" type="text" value="<?php echo $_POST['data']; ?>" class="form-control" placeholder="99/99/9999" data-parsley-trigger="change"/></div></div>
                                        </div></div>

                                    </fieldset>

                                    <fieldset title="endereco">

                                        <legend>Localização</legend>
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
                                    </fieldset>

                                     <fieldset title="Definições">

                                        <legend>Visuais</legend>
                                     <div class="form-group">
                                            <label  class="control-label">Logo</label>
                                            <div class="controls">
                                            <div class="row"><div class="col-xs-12"><input id="logo" name="logo" type="file" value="<?php echo $_POST['logo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Logo do Cliente"/></div></div>
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
                                    </fieldset>


                                     <fieldset title="Parametrizações">

                                        <legend>Técnicas</legend>     
                                        
                                       <div class="form-group">
                                            <label  class="control-label">Criar Cliente Baseado no Template</label>
                                            <div class="controls">
                                             <div class="row"><div class="col-xs-12"><select class="chosen" id="clientetemplate" name="clientetemplate" data-parsley-trigger="change">
                                              <option value=""></option>
                                             <?php
                                             if (empty($view_clientetemplates[1])) { $ch=' selected="selected" '; }
                                             foreach ($view_clientetemplates as $clientetemplates) {
                                              echo '<option value="'.$clientetemplates['sigla'].'"'.$ch.'>'.$clientetemplates['nome'].'</option>';
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
include('app/views/rodape.php');
?>
<!-- page level scripts -->
    <script src="/<?php echo PROJETO;?>/inc/plugins/stepy/jquery.validate.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/stepy/jquery.stepy.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/fuelux/wizard.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/chosen/chosen.jquery.min.js"></script>
    <!-- /page level scripts -->
    <script src="/<?php echo PROJETO;?>/inc/js/form-wizard_cli.js"></script>

    