
<?php
include('app/views/topo.php');
?>
<div class="<?php echo $_SESSION[PROJETO]['mensagem']['tipo'];?>">
                                <?php
                                echo $_SESSION[PROJETO]['mensagem']['texto'];
                                unset( $_SESSION[PROJETO]['mensagem'] );?>
                            </div>
<?php if (!empty($view_vc[1])) { ?> 
<div class="col-lg-12">
<div class="box-tab">
<ul class="nav nav-tabs">
<?php foreach ($view_vc as $vc) { ?>
<li<?php echo $vc['tipo']?>><a href="<?php echo $vc['link']?>" data-original-title="<?php echo $vc['nome']?>"><?php echo $vc['atalho']?></a></li>
<?php } ?>
</ul>

<div class="tab-content">
<div class="tab-pane fade active in">

<?php } else { echo '<div class="col-lg-12">';}?>


<section class="panel panel-default">

   <header class="panel-heading">
      Lista de Questionários
   </header>
        <div class="panel-body">
        <div class="table-responsive no-border">
                                 <div class="col-md-12 panel">




<form method="POST" name="meuFormulario" action="/<?php echo PROJETO;?>/questionarios/inserimoda/">
                             <div class="form-group">
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="descricao" name="descricao" type="text" value="Especificações Técnicas da Obra" class="form-control"  data-parsley-trigger="change" placeholder="Descrição"/></div></div>
</div></div>

<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Ativo</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="ativo" value="1" checked>
       </div>
      </div>
</div>

<div class="form-group">
<label  class="control-label">Tipo de Projeto</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="cdtipo" name="cdtipo" data-parsley-trigger="change">
  <option value=""></option>
 <option value="2">Captação de Recurso</option><option value="1" selected="selected" >Obra</option> </select></div></div>
</div></div>
                              <input type="hidden" name="campo1" id="campo1">
                             </form>


  <link rel="stylesheet" href="/<?php echo PROJETO?>/inc/vendor/css/vendor.css" />
  <link rel="stylesheet" href="/<?php echo PROJETO?>/inc/dist/formbuilder.css" />
  
</head>
<body>
  <div class='fb-main'></div>
  <script src="/<?php echo PROJETO?>/inc/vendor/js/vendor.js"></script>
  <script src="/<?php echo PROJETO?>/inc/dist/formbuilder.js"></script>

  <script>
    $(function(){
      fb = new Formbuilder({
        selector: '.fb-main',
        bootstrapData: [
         {"label":"Sem Titulo","field_type":"TEXTO LONGO","required":true,"field_options":{"size":"small"},"cid":"c2", "idb":"1"}
        ]
      });
      fb.on('save', function(payload){
        console.log(payload);
        document.meuFormulario.campo1.defaultValue  = payload ;
        document.forms["meuFormulario"].submit();
      })
    });
  </script>


                    <!-- /inner content wrapper -->

                </div>
    </div>
 </div>
 </section>
 </div>
 <?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }  ?> 

<?php include('app/views/rodape.php'); ?>