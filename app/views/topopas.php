<?php
session_start();
function after ($this, $inthat)
{
        if (!is_bool(strpos($inthat, $this)))
        return substr($inthat, strpos($inthat,$this)+strlen($this));
};

function before_last ($this, $inthat)
{
       return substr($inthat, 0, strrevpos($inthat, $this));
};

function after_last ($this, $inthat)
{
        if (!is_bool(strrevpos($inthat, $this)))
        return substr($inthat, strrevpos($inthat, $this)+strlen($this));
};

function strrevpos($instr, $needle)
{
    $rev_pos = strpos (strrev($instr), strrev($needle));
    if ($rev_pos===false) return false;
    else return strlen($instr) - $rev_pos - strlen($needle);
};

function menu($con='') {

$db = new PDO('pgsql:host=localhost;dbname='.PROJETO.'conf', 'postgres', 'post82');

$acao=after_last('/',$con);
$mod=before_last('/',$con);
$modulo= after('/',$mod);

if ($acao=='index') {
    $dacao = 'Listar';
} elseif ($acao=='editar') {
    $dacao = 'Editar';
} else { $dacao = $acao; }
$matual = $db->query(" select * from modulo where upper(link)=upper('{$modulo}')");

    $matual->setFetchMode(PDO::FETCH_ASSOC);
    $amatual = $matual->fetchAll();



    
    $rcss = $db->query("select c.cdlayout, p.tipomenu, c.sigla from cliente c, perfil p where c.cdcliente=p.cdcliente and p.cdperfil=1");

    $rcss->setFetchMode(PDO::FETCH_ASSOC);
    $css = $rcss->fetchAll();


    $con = $db->query(" select * from consulta where tipo like '1%'");

    $con->setFetchMode(PDO::FETCH_ASSOC);
    $cons = $con->fetchAll();

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

    ';

if ( ($modulo=='layouts') or ($modulo=='layoutmapa') or ($modulo=='inicial_detalhes')) {
echo '
    <link rel="stylesheet" href="/'.PROJETO.'/inc/plugins/datepicker/datepicker.css">
    <link rel="stylesheet" href="/'.PROJETO.'/inc/plugins/timepicker/jquery.timepicker.css">
    <link rel="stylesheet" href="/'.PROJETO.'/inc/plugins/colorpicker/css/colorpicker.css">
    <link rel="stylesheet" href="/'.PROJETO.'/inc/plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="/'.PROJETO.'/inc/plugins/bootstrap-colorpalette/bootstrap-colorpalette.css">' ;
}

echo '
    <!-- load modernizer -->
    <script src="/'.PROJETO.'/inc/plugins/modernizr.js"></script>
</head>';

echo
'<!-- body -->
<body class="skinblue">
';

echo '
            <section class="main-content">
                <div class="content-wrap">
                    <div class="wrapper">
                    <div class="wrapper">
                        <div class="row mg-b">';
if ( ($modulo!='principal') and ($modulo!='erro') and ($modulo!='gconsulta')) {
echo '                     <div class="col-xs-7">
                                <ol class="breadcrumb">
                                 <h5 class="text-uppercase no-m"> <i class="fa fa-'.$amatual[0]['tipoimg'].'"></i> <b>'. $amatual[0]['nome'].'</b></h5>
                                    <li>
                                        <a href="/'.PROJETO.'/principal">Início</a>
                                    </li>
                                    <li>
                                        <a href="/'.PROJETO.'/'.$amatual[0]['link'].'">'.$amatual[0]['atalho'].'</a>
                                    </li>
                                    <li>
                                        <a href="/'.PROJETO.'/'.$amatual[0]['link'].'/'.$acao.'">'.$dacao.' '.$amatual[0]['atalho'].'</a>
                                    </li>
                                </ol>
                            </div>';
    if ( ($modulo!='inicial_detalhes') or ($modulo!='resposta_projeto') or ($modulo!='documento_valor') or ($modulo!='timeline') ) {
echo '  <div class="col-xs-1"></div>
                      <div class="col-xs-4 menu-acao">';

if ($acao!='index') {
    echo '                                   <div class="btn-group">
                                        <a href="/'.PROJETO.'/'.$amatual[0]['link'].'/" class="btn btn-menu-acao dropdown-toggle" type="button"> <i class="fa fa-navicon"></i> <br/>Listar
                                        </a>
                                    </div>';
}
echo '                                   <div class="btn-group">
                                        <a href="/'.PROJETO.'/'.$amatual[0]['link'].'/novo/" class="btn btn-menu-acao dropdown-toggle" type="button"> <i class="fa fa-file"></i> <br/>Novo
                                        </a>
                                    </div>';
/*echo '                                     <div class="btn-group">
                                        <a href="/'.PROJETO.'/'.$amatual[0]['link'].'/novom/" class="btn btn-menu-acao dropdown-toggle" type="button"> <i class="fa fa-file-text"></i> <br/>Novos
                                        </a>
                                    </div>';*/
                                    echo '
                                    <div class="btn-group">
                                        <a href="/'.PROJETO.'/'.$amatual[0]['link'].'/pesquisar/" class="btn btn-menu-acao dropdown-toggle" type="button"><i class="fa fa-search"></i> <br/>Avançada 
                                        </a>
                                    </div>
                                </ul>
                            </div>';
    }
}

echo '                      </div>

<div class="row">
';

 }  ?>