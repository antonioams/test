<?php
echo '
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Flat, Clean, Responsive, application admin template built with bootstrap 3">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
    <title>SIG</title>
    <!-- core styles -->

    <link rel="stylesheet" href="/'.PROJETO.'/inc/plugins/stepy/jquery.stepy.css">
    <link rel="stylesheet" href="/'.PROJETO.'/inc/plugins/chosen/chosen.min.css">
    <link rel="stylesheet" href="/'.PROJETO.'/inc/plugins/datatables/jquery.dataTables.css">
    <link rel="stylesheet" href="/'.PROJETO.'/inc/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/'.PROJETO.'/inc/css/font-awesome.css">
    <link rel="stylesheet" href="/'.PROJETO.'/inc/css/themify-icons.css">
    <link rel="stylesheet" href="/'.PROJETO.'/inc/css/animate.min.css"> 
    <!-- /core styles -->
    <!-- template styles -->
        <link rel="stylesheet" href="/'.PROJETO.'/inc/css/main.css">
    <link rel="stylesheet" href="/'.PROJETO.'/inc/css/skins/cs'.$css[0]['cdlayout'].'.css'.'">
    <link rel="stylesheet" href="/'.PROJETO.'/inc/css/fonts/font.css">

    <link rel="stylesheet" href="/'.PROJETO.'/inc/plugins/dropzone/dropzone.css">

    ';

  
echo '
    <!-- load modernizer -->
    <script src="/'.PROJETO.'/inc/plugins/modernizr.js"></script>
    
</head>
<body>';
?>

<div class="col-lg-12">
<section class="panel panel-default">

   <header class="panel-heading">
      Resultado da consulta <?php echo $view_consultas[0]['titulo'];?>
   </header>
        <div class="panel-body">
        <div class="table-responsive no-border">
        
   <div id="teste">
   <?php echo $view_pagina;?>
   </div>

                              
    </div>
    <br><br>
        <div align="left">
            Exportar:
        <a href="/<?php echo PROJETO;?>/gconsulta/exportarxls/id/<?php echo $view_consultas[0]['cdconsulta'];?>" target="_blank""><img src="/<?php echo PROJETO;?>/inc/img/excel.png"></a>                
        </div>  
            

 </div>
 </section>
 </div>


  
  <?php
      // rodapé 
       echo $view_rodape;?>



