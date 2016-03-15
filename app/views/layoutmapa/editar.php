
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
<header class="panel-heading">Editar Informações do Layout do Mapa</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/layoutmapa/atualiza/id/<?php echo $view_layoutmapa[0]['cdlayoutmapa'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>

                        <div class="row">
                   <div class="col-md-12 panel">
                            <div class="col-md-6 panel">
                                <h4><i class="fa fa-paint-brush"></i> Configurações de Layout</h4>
                                <script src="jquery-1.10.2.js"></script>
                                    <div class="panel-body bordered widget">
                                        <label>Configurações Gerais</label>
                                        <div>
                                            <div class="col-md-12">
                                                    <div>
                                                        <form>  
                                                        <input type="text" placeholder="Descrição" data-parsley-trigger="change" data-parsley-required="true" class="form-control" value="<?php echo $view_layoutmapa[0]['nome']; ?>" name="nome" id="nome">
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body bordered widget">
                                        <label>Orientação Menu</label>
                                        <div>
                                        <div class="row"><div class="col-xs-12">
                                            <div class="input-group-btn">
                                                        <button data-toggle="dropdown" class="btn btn-default btn-outline dropdown-toggle" type="button">Layout
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul role="menu" class="dropdown-menu">
                                                            <li role="presentation">
                                                                <a href="#" value="horizontal" class="orientacao" tabindex="-1" role="menuitem">Esquerda</a>
                                                            </li>

                                                            <li role="presentation">
                                                                <a href="#" value="horizontal" class="orientacao" tabindex="-1" role="menuitem">Direita</a>
                                                            </li>
                                                        </ul>
                                                </div>
                                        </div></div>
                                        </div>
                                    </div>

                                    <div class="panel-body bordered col-md-4 widget">
                                        <label>Topo</label>
                                        <div>
                                            <div class="col-md-6">
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm  mtopo" data-color-format="hex" data-color="rgb(21, 130, 220)"><i class="fa fa-eyedropper"></i></a>
                                                    </div>
                                            </div>

                                            <div class="col-md-6">
                                                    <div>
                                                         <a href="#" class="btn btn-primary btn-sm  mtextot" data-color-format="hex" data-color="rgb(213, 218, 218)"><i class="fa fa-font"></i></a>
                                                    </div>
                                            </div>   
                                        </div>
                                    </div>

                                     <div class="panel-body bordered col-md-4 widget">
                                        <label>Menu</label>
                                        <div>
                                            <div class="col-md-6">
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm  mmenu" data-color-format="hex" data-color="rgb(79, 80, 97)"><i class="fa fa-eyedropper"></i></a>
                                                    </div>
                                            </div>

                                            <div class="col-md-6">
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm  mtextom" data-color-format="hex" data-color="rgb(255, 255, 255)"><i class="fa fa-font"></i></a>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="panel-body bordered col-md-4 widget">
                                        <label>Com Aprox. Mapa</label>
                                        <div>
                                            <div class="col-md-6">
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm  fundo_mapa" data-color-format="hex" data-color="rgb(79, 80, 97)"><i class="fa fa-eyedropper"></i></a>
                                                    </div>
                                            </div>

                                        </div>
                                    </div>
                                    
                                                                  
                                            <input type="hidden" value="<?php echo $view_layoutmapa[0]['cor_topo']; ?>" name="cor_topo" id="topo"> 
                                            <input type="hidden" value="<?php echo $view_layoutmapa[0]['cor_texto']; ?>" name="cor_texto" id="textot">
                                            <input type="hidden" value="<?php echo $view_layoutmapa[0]['cor_menu']; ?>" name="cor_menu" id="menu"> 
                                            <input type="hidden" value="<?php echo $view_layoutmapa[0]['cor_textomenu']; ?>" name="cor_textomenu" id="tmenu"> 
                                            <input type="hidden" value="<?php echo $view_layoutmapa[0]['layout']; ?>" name="layout" id="layout">
                                            <input type="hidden" value="<?php echo $view_layoutmapa[0]['fundo_mapa']; ?>" name="fundo_mapa" id="fundo_mapa">
                            </div>

                            <div class="col-md-6 panel widget">
                                <h4><i class="fa fa-desktop"></i> PREVIEW</h4>
                                    <div class="panel-body col-md-12" >
                                      <div id="tudo1">
                                        
                                        <div class="cores" id="spanm1" style="background-color:<?php echo $view_layoutmapa[0]['cor_topo']; ?>; color:<?php echo $view_layoutmapa[0]['cor_texto']; ?>"><div id="logo1" align='center'>sig</div></div>
                                        <div class="cores2" id="spanm2" style="<?php if($view_layoutmapa[0]['layout']=="Esquerda"){echo "float: left;";}else{echo "float: right;";}?> background-color:<?php echo $view_layoutmapa[0]['cor_menu']; ?>; color:<?php echo $view_layoutmapa[0]['cor_textomenu']; ?>">
                                            <ul class="menuprev">
                                                <li>:)</li>
                                                <li> =)</li>
                                                <li> xD</li>
                                            </ul>
                                        </div>
                                        <div id="spanm22">&nbsp;</div>
                                        <div class="cores" id="span3">
                                            <div class="clear"></div>
                                            <div id="asd" style="background:url('/<?php echo PROJETO;?>/inc/img/fundomapa.png') <?php echo $view_layoutmapa[0]['fundo_mapa']; ?>;" > Conteudo</div>
                                          </div>
                                      </div>
                                    </div>
                            </div>
                        </div>


                        </div>
                    



<br>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/layoutmapa/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/layoutmapa/exclui/id/<?php echo $view_layoutmapa[0]['cdlayoutmapa'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
                    Excluir</a>

 </form>
  </div>
 </section>
</div>
<?php
include('app/views/rodapelayout.php');
?>
