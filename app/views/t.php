


  

<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Flat, Clean, Responsive, application admin template built with bootstrap 3">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
    <title>SIG</title>
    <!-- core styles -->
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/plugins/stepy/jquery.stepy.css">
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/plugins/chosen/chosen.min.css">
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/plugins/datatables/jquery.dataTables.css">
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/css/font-awesome.css">
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/css/themify-icons.css">
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/css/animate.min.css">
    <!-- /core styles -->
    <!-- template styles -->
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/css/skins/sig9.css">
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/css/fonts/font.css">
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/css/main.css">
    <!-- load modernizer -->
    <script src="/<?php echo PROJETO;?>/inc/plugins/modernizr.js"></script>
</head><!-- body -->
<body class="skinblue">
    <div class="appsmall-menu">
        <!-- top header -->
        <header class="header header-fixed navbar">
            <div class="brand">
                <!-- toggle offscreen menu -->
                <a href="javascript:;" class="ti-menu off-left visible-xs" data-toggle="offscreen" data-move="ltr"></a>
                <!-- /toggle offscreen menu -->
                <!-- logo -->
                <a href="/<?php echo PROJETO;?>/principal/" class="navbar-brand">
                    <!--<img src="/<?php echo PROJETO;?>/inc/img/logo.png" alt="">-->
                    <span align="center" class="heading-font">
                        SIG
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
                        <img src="/<?php echo PROJETO;?>/inc/img/faceless.jpg" class="header-avatar img-circle" alt="user" title="user">
                        <span class="hidden-xs ml10"><?php echo $_SESSION[PROJETO]['nome'];?></span>
                        <i class="ti-angle-down ti-caret hidden-xs"></i>
                    </a>
                    <ul class="dropdown-menu animated fadeInLeft">
                        <li>
                            <a href="/<?php echo PROJETO;?>/modulos/">Configurações</a>
                        </li>
                        <li>
                            <a href="/<?php echo PROJETO;?>/perfis/">Perfil</a>
                        </li>
                        <li class="divider"></li>
                          <li>
                            <a href="/<?php echo PROJETO;?>/index/sair/">Sair</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </header>
        <!-- /top header -->
    <section class="layout">
            <!-- sidebar menu -->
            <aside class="sidebar offscreen-left">
                <!-- main navigation -->
                <nav class="main-navigation" data-height="auto" data-size="6px" data-distance="0" data-rail-visible="true" data-wheel-step="10">
                    <p class="nav-title"></p>
                    <ul class="nav">               <!-- item menu -->
                        <li>
                            <a href="javascript:;">
                                <i class="toggle-accordion"></i>
                                <i class="fa fa-cogs"></i>
                                <span>Configurações</span>
                            </a>
                            <ul class="sub-menu">                               <li>
                                    <a href="/<?php echo PROJETO;?>/layouts">
                                      <i class="fa fa-arrows-alt"></i>
                                        <span>Layouts</span>
                                    </a>
                                </li>                               <li>
                                    <a href="/<?php echo PROJETO;?>/inicial">
                                      <i class="fa fa-sliders"></i>
                                        <span>Tela Inicial</span>
                                    </a>
                                </li>                               <li>
                                    <a href="/<?php echo PROJETO;?>/clientes">
                                      <i class="fa fa-users"></i>
                                        <span>Clientes/Perfis</span>
                                    </a>
                                </li>                               <li>
                                    <a href="/<?php echo PROJETO;?>/logs">
                                      <i class="fa fa-spinner"></i>
                                        <span>Logs de Acesso</span>
                                    </a>
                                </li>                     </ul>
                            </li>               <!-- item menu -->
                        <li>
                            <a href="javascript:;">
                                <i class="toggle-accordion"></i>
                                <i class="fa fa-sitemap"></i>
                                <span>Cadastros Básicos</span>
                            </a>
                            <ul class="sub-menu">                               <li>
                                    <a href="/<?php echo PROJETO;?>/tipos">
                                      <i class="fa fa-tag"></i>
                                        <span>Tipo de Projeto</span>
                                    </a>
                                </li>                               <li>
                                    <a href="/<?php echo PROJETO;?>/instituicoes">
                                      <i class="fa fa-cubes"></i>
                                        <span>Instituições</span>
                                    </a>
                                </li>                               <li>
                                    <a href="/<?php echo PROJETO;?>/fases">
                                      <i class="fa fa-rss"></i>
                                        <span>Fases</span>
                                    </a>
                                </li>                               <li>
                                    <a href="/<?php echo PROJETO;?>/areas">
                                      <i class="fa fa-pie-chart"></i>
                                        <span>Áreas</span>
                                    </a>
                                </li>                               <li>
                                    <a href="/<?php echo PROJETO;?>/regioes">
                                      <i class="fa fa-thumb-tack"></i>
                                        <span>Regiões</span>
                                    </a>
                                </li>                               <li>
                                    <a href="/<?php echo PROJETO;?>/naturezas">
                                      <i class="fa fa-external-link"></i>
                                        <span>Naturezas</span>
                                    </a>
                                </li>                               <li>
                                    <a href="/<?php echo PROJETO;?>/municipios">
                                      <i class="fa fa-map-marker"></i>
                                        <span>Municípios</span>
                                    </a>
                                </li>                               <li>
                                    <a href="/<?php echo PROJETO;?>/fontes">
                                      <i class="fa fa-file-archive-o"></i>
                                        <span>Fontes</span>
                                    </a>
                                </li>                               <li>
                                    <a href="/<?php echo PROJETO;?>/fornecedores">
                                      <i class="fa fa-slideshare"></i>
                                        <span>Fornecedores</span>
                                    </a>
                                </li>                               <li>
                                    <a href="/<?php echo PROJETO;?>/niveis">
                                      <i class="fa fa-sliders"></i>
                                        <span>Níveis Planejamento</span>
                                    </a>
                                </li>                     </ul>
                            </li>                            <li>
                                   <a href="/<?php echo PROJETO;?>/programas">
                                     <i class="fa fa-tasks"></i>
                                     <span>Programas</span>
                                   </a>
                                  </li>
                                  <!-- /ui -->                            <li>
                                   <a href="/<?php echo PROJETO;?>/projetos">
                                     <i class="fa fa-star-o"></i>
                                     <span>Projetos</span>
                                   </a>
                                  </li>
                                  <!-- /ui -->                            <li>
                                   <a href="/<?php echo PROJETO;?>/consultas">
                                     <i class="fa fa-list"></i>
                                     <span>Consultas</span>
                                   </a>
                                  </li>
                                  <!-- /ui -->                 </ul>
                </nav>
            </aside>
            <!-- /sidebar menu -->
            <section class="main-content">
                <div class="content-wrap">
                    <div class="wrapper">
                    <div class="wrapper">
                        <div class="row mg-b">                     <div class="col-xs-7">
                                <ol class="breadcrumb">
                                 <h5 class="text-uppercase no-m"> <b>Cadastro de Perfis</b></h5>
                                    <li>
                                        <a href="/<?php echo PROJETO;?>/principal">Início</a>
                                    </li>
                                    <li>
                                        <a href="/<?php echo PROJETO;?>/perfis">Perfis/Usuários</a>
                                    </li>
                                    <li>
                                        <a href="/<?php echo PROJETO;?>/perfis/index">Listar Perfis/Usuários</a>
                                    </li>
                                </ol>
                            </div>  <div class="col-xs-1"></div>
                      <div class="col-xs-4 menu-acao">
                                     <div class="btn-group">
                                        <a href="/<?php echo PROJETO;?>/perfis/novo/" class="btn btn-menu-acao dropdown-toggle" type="button"> <i class="fa fa-file"></i> <br/>Novo
                                        </a>
                                    </div>
                                     <div class="btn-group">
                                        <a href="/<?php echo PROJETO;?>/perfis/novom/" class="btn btn-menu-acao dropdown-toggle" type="button"> <i class="fa fa-file-text"></i> <br/>Novos
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="/<?php echo PROJETO;?>/perfis/pesquisar/" class="btn btn-menu-acao dropdown-toggle" type="button"><i class="fa fa-search"></i> <br/>Avançada 
                                        </a>
                                    </div>
                                </ul>
                            </div>                      </div>


<div class="">
                                                            </div>
 
<div class="box-tab">
<ul class="nav nav-tabs">
<li><a href="/<?php echo PROJETO;?>/clientes/index" data-original-title="Cadastro de Clientes">Clientes/Perfis</a></li>
<li class="active"><a href="#" data-original-title="Cadastro de Perfis"><b>Perfis/Usuários</b></a></li>
</ul>

<div class="tab-content">
<div class="tab-pane fade active in">


<div class="col-lg-12">
<section class="panel panel-default">

   <header class="panel-heading">
      Lista de Perfis/Usuários
   </header>
        <div class="panel-body">
        <div class="table-responsive no-border">
        <table id="example1" class="table table-bordered table-striped mg-t datatable">
            <thead>
            <tr>
            <th>Descrição</th>
            </tr>
            </thead>
            <tbody>
                         <tr class="gradeA" onclick="location.href = '/<?php echo PROJETO;?>/perfis/editar/id/23';" style="cursor: pointer; cursor: hand">
            <td>Operador</td>

            </tr>
                        <tr class="gradeA" onclick="location.href = '/<?php echo PROJETO;?>/perfis/editar/id/1';" style="cursor: pointer; cursor: hand">
            <td>Administrador</td>

            </tr>
                    </table>
    </div>
 </div>
 </section>
 </div>
  
 </div>
</div>
</div>
 

                    </section>

    </div>
    </div>
    </div>
    </section>
    </section>
    </div>


    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery-1.11.1.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/bootstrap/js/bootstrap.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.slimscroll.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.easing.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/appear/jquery.appear.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.placeholder.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/fastclick.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/offscreen.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/main.js"></script>

    <script src="/<?php echo PROJETO;?>/inc/plugins/chosen/chosen.jquery.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/bootstrap-datatables.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.sortable.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.nestable.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/table-edit.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/script_dm.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/icheck/icheck.js"></script>

    <script src="/<?php echo PROJETO;?>/inc/plugins/parsley.min.js"></script>

    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.maskedinput.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/form-masks.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/general.js"></script>

</body>
</html>
