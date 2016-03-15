
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
<header class="panel-heading">Cadastrar Novo Layouts</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/layouts/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>


                        <div class="row">
                    <div class="col-md-12 panel">
                            <div class="col-md-6 panel">
                                <h4><i class="fa fa-paint-brush"></i> Configurações de Layout:</h4>
                                <script src="jquery-1.10.2.js"></script>
                                    <div class="panel-body bordered widget">
										<div class="form-group">
                                        <label  class="control-label">Nome</label>
                                        <div class="controls">
                                        <div class="row"><div class="col-xs-12"><input id="nome" name="nome" type="text" value="<?php echo $_POST['nome']; ?>" class="form-control"  data-parsley-required="true"  data-parsley-trigger="change" placeholder="Descrição"/></div></div>
                                        </div></div>

                                        <div class="form-group">
                                        <label  class="control-label">Tipo</label>
                                        <div class="controls">
                                        <div class="row"><div class="col-xs-12">
                                            <div class="input-group-btn">
                                                        <button data-toggle="dropdown" class="btn btn-default btn-outline dropdown-toggle" type="button">Layout
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul role="menu" class="dropdown-menu">
                                                            <li role="presentation">
                                                                <a href="#" value="horizontal" class="layout" tabindex="-1" role="menuitem">Lateral</a>
                                                            </li>

                                                            <li role="presentation">
                                                                <a href="#" value="horizontal" class="layout" tabindex="-1" role="menuitem">Horizontal</a>
                                                            </li>
                                                        </ul>
                                                </div>
                                        </div></div>
                                        </div></div>                                        
                                    </div>

                                    <div class="panel-body bordered col-md-3 widget">
                                        <label>Topo</label>
                                        <div>
                                            <div class="col-md-6">
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm  topo" data-color-format="hex" data-color="rgb(21, 130, 220)"><i class="fa fa-eyedropper"></i></a>
                                                    </div>
                                            </div>

                                            <div class="col-md-6">
                                                    <div>
                                                         <a href="#" class="btn btn-primary btn-sm  textot" data-color-format="hex" data-color="rgb(213, 218, 218)"><i class="fa fa-font"></i></a>
                                                    </div>
                                            </div>   
                                        </div>
                                    </div>

                                     <div class="panel-body bordered col-md-3 widget">
                                        <label>Menu</label>
                                        <div>
                                            <div class="col-md-6">
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm  menu" data-color-format="hex" data-color="rgb(79, 80, 97)"><i class="fa fa-eyedropper"></i></a>
                                                    </div>
                                            </div>

                                            <div class="col-md-6">
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm  textom" data-color-format="hex" data-color="rgb(255, 255, 255)"><i class="fa fa-font"></i></a>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body bordered col-md-3 widget" >
                                        <label>Página</label>
                                        <div>
                                            <div class="col-md-6">
                                                <div>
                                                        <a href="#" class="btn btn-primary btn-sm  pagina" data-color-format="hex" data-color="rgb(255, 255, 255)"><i class="fa fa-eyedropper"></i></a>
                                                </div>
                                             </div>

                                            <div class="col-md-6">
                                                 <div>
                                                        <a href="#" class="btn btn-primary btn-sm  texto" id="tp" data-color-format="hex" data-color="rgb(255, 255, 255)"><i class="fa fa-font"></i></a>
                                              </div>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="panel-body bordered col-md-3 widget" >
                                        <label>M. Contexto</label>
                                        <div>
                                            <div class="col-md-6">
                                                <div>
                                                        <a href="#" class="btn btn-primary btn-sm batata" id="mb" data-color-format="hex" data-color="rgb(122, 173, 215)"><i class="fa fa-eyedropper"></i></a>
                                                </div>
                                             </div>

                                            <div class="col-md-6">
                                                 <div>
                                                        <a href="#" class="btn btn-primary btn-sm batata" id="mt" data-color-format="hex" data-color="rgb(255, 255, 255)"><i class="fa fa-font"></i></a>
                                              </div>
                                           </div>
                                        </div>
                                    </div>
                                            <input type="hidden" value="lateral" id="layout">
                                            <input type="hidden" value="#1582dc" name="cor_topo" id="topo"> 
                                            <input type="hidden" value="#cad0dd" name="cor_texto" id="textot">
                                            <input type="hidden" value="#4f5061" name="cor_menu" id="menu"> 
                                            <input type="hidden" value="#cad0dd" name="cor_textomenu" id="tmenu"> 
                                            <input type="hidden" value="#f1f4f9" name="cor_pagina" id="pagina">
                                            <input type="hidden" value="#777777" name="cor_textopagina" id="texto">
                                            <input type="hidden" value="#777777" name="cor_mc" id="mcon">
                                            <input type="hidden" value="#777777" name="cor_textomc" id="mfonte">

                            </div>

                            <div class="col-md-6 panel widget">
                                <h4><i class="fa fa-desktop"></i> PREVIEW</h4>
                                    <div class="panel-body col-md-12" >
                                      <div id="tudo">
                                        
                                        <div class="cores" id="span1"><div id="logo" align='center'> sig</div><div id="menutopo"><i class="ti-menu"></i></div></div>
                                        <div class="cores2" id="span2">
                                            <ul class="menuprev">
                                                <li>Menu</li>
                                                <li>Menu</li>
                                                <li>Menu</li>
                                            </ul>
                                        </div>
                                        <div class="cores" id="span3">
                                            <div id="mapa" align='center'> Mapa de navegação</div>
                                            <div id="mcontexto"><i class="fa fa-plus"></i>Novo &nbsp;&nbsp;<i class="fa fa-search"></i> Pesquisa Avançada </div>
                                            <div class="clear"></div>
                                            <div id="ctt"> Conteudo</div>
                                        </div>
                                      </div>
                                    </div>
                            </div>
                        </div>
                        </div>
                    



<br>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/layouts/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>

 </form>
  </div>
 </section>
</div>
<?php
include('app/views/rodapelayout.php');
?>
