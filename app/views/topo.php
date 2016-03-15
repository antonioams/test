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

    $m = $db->query("
        select
        m.cdmodulo,
        m.nome,
        m.link,
        m.tipoimg,
        m.atalho,
        m.restrito,
        m.cdmodulopai,
        m.ordem,
        count(m2.cdmodulo) as qtde
        from perfil_modulo mc, modulo m
        left outer join modulo m2 on m.cdmodulo=m2.cdmodulopai
        where
        m.cdmodulo=mc.cdmodulo and mc.cdperfil=".$_SESSION[PROJETO]['cdperfil']." and
        m.cdmodulo not in (select cdvinculado from modulo_vinculado) and
        m.cdmodulopai is null and m.cdmodulo not in (1) and m.bloqueado is null
        group by m.cdmodulo, m.nome, m.link, m.tipoimg,
                 m.atalho, m.restrito, m.cdmodulopai, m.ordem
        order by m.ordem, m.cdmodulo
         ");
    
    $m->setFetchMode(PDO::FETCH_ASSOC);
    $am = $m->fetchAll();

    
    $rcss = $db->query("select c.cdlayout, p.tipomenu, c.sigla from cliente c, perfil p where c.cdcliente=p.cdcliente and p.cdperfil=".$_SESSION[PROJETO]['cdperfil']);

    $rcss->setFetchMode(PDO::FETCH_ASSOC);
    $css = $rcss->fetchAll();


    $con = $db->query(" select c.cdconsulta, c.titulo from consulta c, perfil_consulta pc 
    where c.cdconsulta=pc.cdconsulta and c.tipo like '1%' and c.cdcliente=".$_SESSION[PROJETO]['cdcliente']." and pc.cdperfil=".$_SESSION[PROJETO]['cdperfil']."order by titulo");                    

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
        <link rel="stylesheet" href="/'.PROJETO.'/inc/css/main.css">
    <link rel="stylesheet" href="/'.PROJETO.'/inc/css/skins/cs'.$css[0]['cdlayout'].'.css'.'">
    <link rel="stylesheet" href="/'.PROJETO.'/inc/css/fonts/font.css">

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


// inicio menu lateral
if ( ($css[0]['tipomenu']=='Lateral') or ($css[0]['tipomenu']=='Lateral Minimizado') ) {

if ($css[0]['tipomenu']=='Lateral Minimizado') {
    $me = 'small-menu';
} else {
    $me = '';
}

    
echo
' <body class="skinblue">
<div class="app '.$me.'">
        <!-- top header -->
        <header class="header header-fixed navbar">
            <div class="brand">
                <!-- toggle offscreen menu -->
                <a href="javascript:;" class="ti-menu off-left visible-xs" data-toggle="offscreen" data-move="ltr"></a>
                <!-- /toggle offscreen menu -->
                <!-- logo -->
                <a href="/'.PROJETO.'/principal/" class="navbar-brand">
                    <img src="/'.PROJETO.'/inc/img/cliente/c'.$_SESSION[PROJETO]['cdcliente'].'.png"   alt="">
                    <span align="center" class="heading-font">
                        '.$_SESSION[PROJETO]['cliente'].'
                    </span>
                </a>
                <!-- /logo -->
            </div>

            <ul class="nav navbar-nav">
                <li class="hidden-xs">
                    <!-- toggle small menu -->
                    <a href="javascript:;" class="toggle-sidebar">
                        <i class="ti-menu"></i>
                    </a>
                    <!-- /toggle small menu -->
                </li>
                <li class="header-search">
                    <!-- toggle search -->
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                 <li class="off-right">
                    <a href="javascript:;" data-toggle="dropdown">
                        <span class="hidden-xs ml10">'.$_SESSION[PROJETO]['nome'];
                        echo ( ($_SESSION[PROJETO]['unidade']=='') ? '' : (' - '.$_SESSION[PROJETO]['unidade']) );
                        if(!empty($_SESSION[PROJETO]['foto'])){
                            $foto = $_SESSION[PROJETO]['foto'];
                        } else{
                            $foto = '/'.PROJETO.'/inc/img/usuarios/faceless.jpg';
                        }
echo '</span>
                <img src="'.$foto.'" class="header-avatar img-circle" alt="user" title="user">
                        <i class="ti-angle-down ti-caret hidden-xs"></i>
                    </a>
                    <ul class="dropdown-menu animated fadeInLeft">

                        <li>
                            <a href="/'.PROJETO.'/usuarios/meuusuario" rel="modal">Meu Usuário</a>
                        </li>
                        <li>
                            <a href="/'.PROJETO.'/mapas/index/id/'.$css[0]['sigla'].'" target="_blank">Mapa do Cliente</a>
                        </li>
                        <li class="divider"></li>
                          <li>
                            <a href="/'.PROJETO.'/index/sair/id/'.$_SESSION[PROJETO]['cliente'].'">Sair</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </header>
        <!-- /top header -->
';



echo '    <section class="layout">
            <!-- sidebar menu -->
            <aside class="sidebar offscreen-left">
                <!-- main navigation -->
                <nav class="main-navigation" data-height="auto" data-size="6px" data-distance="0" data-rail-visible="true" data-wheel-step="10">
                    <p class="nav-title"></p>
                    <ul class="nav">';

    foreach ($am as $key ) {
        $pai = '';
        $pai1 = '';
        if($amatual[0]['cdmodulopai']==''){
          $pai =  $amatual[0]['cdmodulo'];
        } else{  
            $pai = $amatual[0]['cdmodulopai'];
        }
        if($key['cdmodulopai']==''){
            $pai1 =$key['cdmodulo'];
        } else {
            $pai1 = $key['cdmodulopai'];
        }
        if ($pai==$pai1) {
           $act = ' class="hig"';
                               $open = 'class="open active"';
                               $display = 'style="display: block;"';
        } else {
              $act= '';
                                $open = '';
                               $display = '';
        }

        if ($key['qtde']>0) {
            $cdm = $key['cdmodulo'];

            $m2 = $db->query("
        select
        m.cdmodulo,
        m.nome,
        m.link,
        m.tipoimg,
        m.atalho,
        m.restrito,
        m.cdmodulopai,
        m.ordem,
        count(m2.cdmodulo) as qtde
        from perfil_modulo mc, modulo m
        left outer join modulo m2 on m.cdmodulo=m2.cdmodulopai
        where
        m.cdmodulo=mc.cdmodulo and mc.cdperfil=".$_SESSION[PROJETO]['cdperfil']." and
        m.cdmodulo not in (select cdvinculado from modulo_vinculado) and
        m.cdmodulopai={$cdm} and m.cdmodulo not in (1)  and m.bloqueado is null
        group by m.cdmodulo, m.nome, m.link, m.tipoimg,
                 m.atalho, m.restrito, m.cdmodulopai, m.ordem
        order by m.ordem, m.cdmodulo
                 ");

        $m2->setFetchMode(PDO::FETCH_ASSOC);
        $am2 = $m2->fetchAll();


 echo '               <!-- item menu -->
                        <li '.$open.'>
                            <a href="javascript:;">
                                <i class="toggle-accordion"></i>
                                <i style="font-size:18px;" class="fa fa-'.$key['tipoimg'].'"></i>
                                <span>'.$key['atalho'].'</span>
                            </a>
                       <ul class="sub-menu" '.$display.'>'; 
                        foreach ($am2 as $key2 ) {
                           if ($amatual[0]['cdmodulo']==$key2['cdmodulo']) {
                            $act = ' class="active"';
                               $open = 'class="open active"';
                               $display = 'style="display: block;"';
                               
                            } else {
                              $act= '';
                                $open = '';
                               $display = '';
                            }

                            if ($key2['qtde']>0) {
                            $cdm2 = $key2['cdmodulo'];

$m3 = $db->query("
        select
        m.cdmodulo,
        m.nome,
        m.link,
        m.tipoimg,
        m.atalho,
        m.restrito,
        m.cdmodulopai,
        m.ordem
        from perfil_modulo mc, modulo m
        where
        m.cdmodulo=mc.cdmodulo and mc.cdperfil=".$_SESSION[PROJETO]['cdperfil']." and
        m.cdmodulo not in (select cdvinculado from modulo_vinculado) and
        m.cdmodulopai={$cdm2} and m.cdmodulo not in (1)  and m.bloqueado is null
        group by m.cdmodulo, m.nome, m.link, m.tipoimg,
                 m.atalho, m.restrito, m.cdmodulopai, m.ordem
        order by m.ordem, m.cdmodulo
                 ");

        $m3->setFetchMode(PDO::FETCH_ASSOC);
        $am3 = $m3->fetchAll();


 echo '               <!-- item menu -->
                         <li '.$open.'>
                            <a href="javascript:;">
                                <i class="toggle-accordion"></i>
                                <div style="width:30px; float: left;"><i style="font-size:16px;"  class="fa fa-'.$key2['tipoimg'].'"></i></div>
                                <span>'.$key2['atalho'].'</span>
                            </a>
                              <ul class="sub-menu" '.$display.'>'; 

                        foreach ($am3 as $key3 ) {
                                if ($amatual[0]['cdmodulo']==$key3['cdmodulo']) {
                                   $act = ' class="cai"';
                                } else {
                                   $act= '';
                                }
echo '                          <li'.$act.'>
                                    <a href="/'.PROJETO.'/'.$key3['link'].'">
                                      <div style="width:30px; float: left;"><i class="fa fa-'.$key3['tipoimg'].'"></i></div>
                                        <span>'.$key3['atalho'].'</span>
                                    </a>
                                </li>';
                        }

echo '                     </ul>
                            </li>';
                        } else {
echo '                          <li'.$act.'>
                                    <a href="/'.PROJETO.'/'.$key2['link'].'">
                                      <div style="width:30px; float: left;"><i style="font-size:16px;"  class="fa fa-'.$key2['tipoimg'].'"></i></div>
                                        <span>'.$key2['atalho'].'</span>
                                    </a>
                                </li>';
                              }
                          }

echo '                     </ul>
                            </li>';
                        } else {
echo '                            <li'.$act.'>
                                   <a href="/'.PROJETO.'/'.$key['link'].'">
                                     <div style="width:30px; float: left;"><i style="font-size:16px;"  class="fa fa-'.$key['tipoimg'].'"></i></div>
                                     <span>'.$key['atalho'].'</span>
                                   </a>
                                  </li>
                                  <!-- /ui -->';
             }
         }



//consultas
//
echo '               <!-- item menu -->
                        <li>
                            <a href="javascript:;">
                                <i class="toggle-accordion"></i>
                                <i style="font-size:18px;" class="fa fa-search "></i>
                                <span>Consultas</span>
                            </a>
                            <ul class="sub-menu">';

                        foreach ($cons as $keycons ) {
echo '                          <li'.$act.'>
                                    <a href="/'.PROJETO.'/gconsulta/index/id/'.$keycons['cdconsulta'].'">
                                        <span>'.$keycons['titulo'].'</span>
                                    </a>
                                </li>';

                        }
echo '                      </ul>';





echo '                 </ul>
                </nav>
            </aside>
            <!-- /sidebar menu -->';
// fim menu lateral
}
// inicio menu horizontal
elseif ( ($css[0]['tipomenu']=='Horizontal') ) {

echo
'
    <style>

    @media screen and (min-width: 771px) {

    .dropdown-submenu1{position:relative; list-style-type: none;clear:both;}
    .dropdown-submenu1>.dropdown-menu1{
        position: absolute;
        width: 100%;
        list-style-type: none;
        background-color: #fff;
        top:2px;
        left:100%;
        margin-left:0px;
        border: 1px solid #dcdff0;
        
        border-radius: 0 2px 2px 0 ;
        box-shadow: none;
        z-index: 9999;}
    .dropdown-submenu1>.dropdown-menu1{display:none;}
    .dropdown-submenu1:hover>.dropdown-menu1{display: block;}

    .dropdown-submenu1>a:after {
        content:" ";
        float:right;
        width:0;
        height:0;
        border-color:transparent;
        border-style:solid;
        border-width:5px 0 5px 5px;
        border-left-color:#cccccc;
        margin-top:5px;
        margin-right:-10px;
    }

    .dropdown-submenu1:hover>a:after{border-left-color:#999;}
    .teste{float:none;}
    .teste  {
        position:relative;
        left:100%;
        margin-left:10px;
        -webkit-border-radius:6px 0 6px 6px;
        -moz-border-radius:6px 0 6px 6px;
        border-radius:6px 0 6px 6px;
    }

    .dropdown-menu1 > li {
        margin-left: -40px;
        padding-left: 20px;
    }
    .dropdown-menu1 > li > a:hover, .dropdown-menu1 > li > a:focus {
    color: inherit;
    }
    .dropdown-menu1 > li:hover, .dropdown-menu1 > li:focus {
    background-color: #dcdff0;
    color: inherit;
    }
    .ativa{
        display: none;
    }

}

@media screen and (max-width: 770px) {
        .dropdown-submenu1{position:relative; list-style-type: none;clear:both;}
    .dropdown-submenu1>.dropdown-menu1{
        position: relative;
        width: 100%;
        list-style-type: none;
        background-color: #f3f3f3;
        top:0px;
        left:0;
        margin-left:0px;
        z-index: 9999;}
    .dropdown-submenu1>.dropdown-menu1{display:none;}
    .dropdown-submenu1:hover>.dropdown-menu1{display: block;}
    
    .ativa{
        display: inline-block;
    }

    .dropdown-submenu1>a:after {
      
    }

    .dropdown-submenu1:hover>a:after{border-left-color:#999;}
    .teste{float:none;}
    .teste  {
        display: block;
        position:relative;
        left:0%;
        margin-left:10px;
        -webkit-border-radius:6px 0 6px 6px;
        -moz-border-radius:6px 0 6px 6px;
        border-radius:6px 0 6px 6px;
    }

    .dropdown-menu1 > li {
        margin-left: -40px;
        padding-left: 20px;
    }
    .dropdown-menu1 > li > a:hover, .dropdown-menu1 > li > a:focus {
    color: inherit;
    }
    .dropdown-menu1 > li:hover, .dropdown-menu1 > li:focus {
    background-color: #dcdff0;
    color: inherit;
    }
    
}


    

    </style>

<body class="skinblue">
    <div class="app horizontal-layout">
        <!-- top header -->
        <header class="header header-fixed navbar">

            <div class="brand">
                <!-- toggle offscreen menu -->
                <a href="javascript:;" class="ti-menu navbar-toggle off-left visible-xs" data-toggle="collapse" data-target="#hor-menu"></a>
                <!-- /toggle offscreen menu -->

                <!-- logo -->
                <a href="/'.PROJETO.'/principal/" class="navbar-brand">
                                       <span class="heading-font">
                        SIG
                    </span>
                </a>
                <!-- /logo -->
            </div>
';



echo '  <div class="collapse navbar-collapse pull-left" id="hor-menu">
                <ul class="nav navbar-nav">';

        foreach ($am as $key ) {
        $pai = '';
        $pai1 = '';
        if($amatual[0]['cdmodulopai']==''){
          $pai =  $amatual[0]['cdmodulo'];
        } else{  
            $pai = $amatual[0]['cdmodulopai'];
        }
        if($key['cdmodulopai']==''){
            $pai1 =$key['cdmodulo'];
        } else {
            $pai1 = $key['cdmodulopai'];
        }
        if ($pai==$pai1) {
           $act = ' class="hig"';
                               $open = 'class="open active"';
                               $display = 'style="display: block;"';
        } else {
              $act= '';
                                $open = '';
                               $display = '';
        }

        if ($key['qtde']>0) {
            $cdm = $key['cdmodulo'];

            $m2 = $db->query("
        select
        m.cdmodulo,
        m.nome,
        m.link,
        m.tipoimg,
        m.atalho,
        m.restrito,
        m.cdmodulopai,
        m.ordem,
        count(m2.cdmodulo) as qtde
        from perfil_modulo mc, modulo m
        left outer join modulo m2 on m.cdmodulo=m2.cdmodulopai
        where
        m.cdmodulo=mc.cdmodulo and mc.cdperfil=".$_SESSION[PROJETO]['cdperfil']." and
        m.cdmodulo not in (select cdvinculado from modulo_vinculado) and
        m.cdmodulopai={$cdm} and m.cdmodulo not in (1)  and m.bloqueado is null
        group by m.cdmodulo, m.nome, m.link, m.tipoimg,
                 m.atalho, m.restrito, m.cdmodulopai, m.ordem
        order by m.ordem, m.cdmodulo
                 ");

        $m2->setFetchMode(PDO::FETCH_ASSOC);
        $am2 = $m2->fetchAll();


 echo '                <li class="dropdown">
                            <a href="javascript:;" data-toggle="dropdown">
                                <i class="fa fa-'.$key['tipoimg'].'"></i>
                                <span>'.$key['atalho'].'</span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">';
                        foreach ($am2 as $key2 ) {
                             if ($key2['qtde']>0) {
                            $cdm2 = $key2['cdmodulo'];
                            $m3 = $db->query("
        select
        m.cdmodulo,
        m.nome,
        m.link,
        m.tipoimg,
        m.atalho,
        m.restrito,
        m.cdmodulopai,
        m.ordem
        from perfil_modulo mc, modulo m
        where
        m.cdmodulo=mc.cdmodulo and mc.cdperfil=".$_SESSION[PROJETO]['cdperfil']." and
        m.cdmodulo not in (select cdvinculado from modulo_vinculado) and
        m.cdmodulopai={$cdm2} and m.cdmodulo not in (1)  and m.bloqueado is null
        group by m.cdmodulo, m.nome, m.link, m.tipoimg,
                 m.atalho, m.restrito, m.cdmodulopai, m.ordem
        order by m.ordem, m.cdmodulo
                 ");


        $m3->setFetchMode(PDO::FETCH_ASSOC);
        $am3 = $m3->fetchAll();

echo '                              

                             <li class="dropdown-submenu1">
                                    <a tabindex="-1" ref="/'.PROJETO.'/'.$key2['link'].'"> <i class="fa fa-'.$key2['tipoimg'].'"></i><span> &nbsp;'.$key2['atalho'].'<b class="caret ativa"></b></span></a>
                                    <ul class="dropdown-menu1 teste" style="clear:both;">
                                    ';

                                     foreach ($am3 as $key3 ) {
                                    echo'
                                    
                                      <li class=""><a tabindex="-1" href="/'.PROJETO.'/'.$key3['link'].'"><i class="fa fa-'.$key3['tipoimg'].'"></i><span> &nbsp;'.$key3['atalho'].'</span></a></li>
                                      ';
                                        }
                                      echo'
                                     <!-- <li class="dropdown-submenu1">
                                        <a href="#" style="">More..</a>
                                        <ul class="dropdown-menu1 teste">
                                            <li><a href="#">3rd level</a></li>
                                            <li><a href="#">3rd level</a></li>
                                        </ul>
                                      </li>
                                      <li class="batata" ><a  href="#">Second level</a></li>
                                      <li><a href="#">Second level</a></li> -->
                                    </ul>
                             </li> 



 <li>
                                ';


                        } else{
                            echo '                            <li>
                                   <a href="/'.PROJETO.'/'.$key2['link'].'">
                                     <i class="fa fa-'.$key2['tipoimg'].'"></i>
                                     <span>'.$key2['atalho'].'</span>
                                   </a>
                                  </li>
                                  <!-- /ui -->';

                        }

                              }





echo '                     </ul>
                            </li>

                            ';

                        } 
         }

echo '                 
';
//consultas
//
echo '         
                            <li class="dropdown">
                            <a href="javascript:;" data-toggle="dropdown">
                              <i style="font-size:18px;" class="fa fa-search "></i>
                                <span>Consultas</span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">';



                           

                        foreach ($cons as $keycons ) {
echo '                          <li'.$act.'>
                                    <a href="/'.PROJETO.'/gconsulta/index/id/'.$keycons['cdconsulta'].'">
                                        <span>'.$keycons['titulo'].'</span>
                                    </a>
                                </li>';

                        }

echo '</ul>';
echo'
                </div>

            <ul class="nav navbar-nav navbar-right">

                 <li class="off-right">
                    <a href="javascript:;" data-toggle="dropdown">
                        <img src="/'.PROJETO.'/inc/img/faceless.jpg" class="header-avatar img-circle" alt="user" title="user">
                        <span class="hidden-xs ml10"><?php echo $_SESSION[\'acesso\'][\'nome\'];?></span>
                        <i class="ti-angle-down ti-caret hidden-xs"></i>
                    </a>
                    <ul class="dropdown-menu animated fadeInLeft">
                        <li>
                            <a href="/'.PROJETO.'/perfis/">Perfil</a>
                        </li>
                        <li class="divider"></li>
                          <li>
                            <a href="/'.PROJETO.'/index/sair/id/'.$_SESSION[PROJETO]['cliente'].'">Sair</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </header>
        <!-- /top header -->
';
echo '<section class="layout">';
// fim menu lateral horizontal
}


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
    if ( ($modulo!='inicial_detalhes') and ($modulo!='resposta_projeto') and ($modulo!='documento_valor') and ($modulo!='timeline')  and ($modulo!='programasp') and ($modulo!='projetosp') ) {
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


  }


 menu($con);
   ?>



