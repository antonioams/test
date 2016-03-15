
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

<form action="/<?php echo PROJETO;?>/layoutmapa/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>


                        <div class="row">
                    <div class="col-md-12 panel">
                            <div class="col-md-6 panel">
                                <h4><i class="fa fa-paint-brush"></i> Configurações de Layout Mapa:</h4>
                                <script src="jquery-1.10.2.js"></script>
                                    <div class="panel-body bordered widget">
                                        <label>Configurações Gerais</label>
                                        <div>
                                            <div class="col-md-12">
                                                    <div>
                                                        <form>  
                                                        <input type="text" placeholder="Descrição" data-parsley-trigger="change" data-parsley-required="true" class="form-control" value="" name="nome" id="nome">
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-body bordered col-md-6 widget">
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

                                     <div class="panel-body bordered col-md-6 widget">
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
                                    
                                                                  
                                            <input type="hidden" value="#1582dc" name="cor_topo" id="topo"> 
                                            <input type="hidden" value="#cad0dd" name="cor_texto" id="textot">
                                            <input type="hidden" value="#4f5061" name="cor_menu" id="menu"> 
                                            <input type="hidden" value="#cad0dd" name="cor_textomenu" id="tmenu"> 
                            </div>

                            <div class="col-md-6 panel widget">
                                <h4><i class="fa fa-desktop"></i> PREVIEW</h4>
                                    <div class="panel-body col-md-12" >
                                      <div id="tudo1">
                                        
                                        <div class="cores" id="spanm1"><div id="logo1" align='center'>sig</div></div>
                                        <div class="cores2" id="spanm2">
                                            <ul class="menuprev">
                                                <li>:)</li>
                                                <li> =)</li>
                                                <li> xD</li>
                                            </ul>
                                        </div>
                                        <div id="spanm22">&nbsp;</div>
                                        <div class="cores" id="span3">
                                            <div class="clear"></div>
                                            <div id="asd"> Conteudo</div>
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

 </form>
  </div>
 </section>
</div>
<?php
include('app/views/rodapelayout.php');
?>
