
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




<form method="POST" name="meuFormulario" action="/<?php echo PROJETO;?>/grupopergunta/atualizaj/id/<?php echo $view_grupopergunta[0]['cdgrupopergunta'];?>">
<div class="form-group">
<label  class="control-label">Descrição</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="descricao" name="descricao" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_grupopergunta[0]['descricao'] ) : ( $_POST['descricao'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Descrição"/></div></div>
</div></div>

<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>Ativo</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="ativo" value="1" <?php if ($view_grupopergunta[0]['ativo']==1) { echo 'checked';} ?>>
       </div>
      </div>
</div>


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
         <?php echo $view_js;?>
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
    
<a href="#"  class="btn btn-danger btn-sig" onclick="javascript: if (confirm('Deseja realmente excluir o questionario? Todos os cadastros vinculados a ele tambem serao excluidos.'))location.href='/<?php echo PROJETO;?>/grupopergunta/exclui/id/<?php echo $view_grupopergunta[0]['cdgrupopergunta'];?>'">
<i class=" fa fa-fw fa-times-circle"></i>
        Excluir</a> 
    
 </div>
 </section>
 </div>
 <?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }  ?> 

<?php include('app/views/rodape.php'); ?>
