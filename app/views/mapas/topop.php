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

    <link rel="stylesheet" href="/'.PROJETO.'/inc/css/skins/'.PROJETO.$css[0]['cdlayout'].'.css'.'">
    <link rel="stylesheet" href="/'.PROJETO.'/inc/css/fonts/font.css">
    <link rel="stylesheet" href="/'.PROJETO.'/inc/css/main.css">
    <link rel="stylesheet" href="/'.PROJETO.'/inc/plugins/dropzone/dropzone.css">
         <link rel="stylesheet" type="text/css" href="/'.PROJETO.'/inc/mapas/css/'.$view_css.'_m.css" />


    ';
?> 
<script type="text/javascript">
( function( $ ) {
$( document ).ready(function() {
$('#cssmenu').prepend('<div id="indicatorContainer"><div id="pIndicator"><div id="cIndicator"></div></div></div>');
    var activeElement = $('#cssmenu>ul>li:first');

    $('#cssmenu>ul>li').each(function() {
        if ($(this).hasClass('active')) {
            activeElement = $(this);
        }
    });


    var posLeft = activeElement.position().left;
    var elementWidth = activeElement.width();
    posLeft = posLeft + elementWidth/2 -6;
    if (activeElement.hasClass('has-sub')) {
        posLeft -= 6;
    }

    $('#cssmenu #pIndicator').css('left', posLeft);
    var element, leftPos, indicator = $('#cssmenu pIndicator');
    
    $("#cssmenu>ul>li").hover(function() {
        element = $(this);
        var w = element.width();
        if ($(this).hasClass('has-sub'))
        {
            leftPos = element.position().left + w/2 - 12;
        }
        else {
            leftPos = element.position().left + w/2 - 6;
        }

        $('#cssmenu #pIndicator').css('left', leftPos);
    }
    , function() {
        $('#cssmenu #pIndicator').css('left', posLeft);
    });

    $('#cssmenu>ul').prepend('<li id="menu-button"><a>Menu</a></li>');
    $( "#menu-button" ).click(function(){
            if ($(this).parent().hasClass('open')) {
                $(this).parent().removeClass('open');
            }
            else {
                $(this).parent().addClass('open');
            }
        });
});
} )( jQuery );

        </script>

<?php
echo '
    <!-- load modernizer -->
    <script src="/'.PROJETO.'/inc/plugins/modernizr.js"></script>
</head>';
    
echo
'<!-- body -->
<body class="skinblue" style="padding:20px;">
    <div class="app">
        <!-- top header -->
        <!-- /top header -->



<div class="row">
';
   ?>