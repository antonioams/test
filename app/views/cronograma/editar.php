<!doctype html>
<html class="no-js" lang="">

<head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta name="description" content="Flat, Clean, Responsive, application admin template built with bootstrap 3">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
    <!-- /meta -->

    <title>Sublime - Web Application Admin Dashboard</title>

    <!-- page level plugin styles -->
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/plugins/table-sortable/theme.css">
    <!-- /page level plugin styles -->

    <!-- core styles -->
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/css/font-awesome.css">
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/css/themify-icons.css">
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/css/animate.min.css">
    <!-- /core styles -->

    <!-- template styles -->
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/css/skins/palette.css">
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/css/fonts/font.css">
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/css/main.css">
    <!-- template styles -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- load modernizer -->
    <script src="/<?php echo PROJETO;?>/inc/plugins/modernizr.js"></script>
</head>

<!-- body -->

<body>
    <div class="app">
        <!-- top header -->
        <header class="header header-fixed navbar">

            <div class="brand">
                <!-- toggle offscreen menu -->
                <a href="javascript:;" class="ti-menu off-left visible-xs" data-toggle="offscreen" data-move="ltr"></a>
                <!-- /toggle offscreen menu -->

                <!-- logo -->
                <a href="index.html" class="navbar-brand">
                    <img src="img/logo.png" alt="">
                    <span class="heading-font">
                        Sublime
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
                    <a href="javascript:;" class="toggle-search">
                        <i class="ti-search"></i>
                    </a>
                    <!-- /toggle search -->
                    <div class="search-container">
                        <form role="search">
                            <input type="text" class="form-control search" placeholder="type and press enter">
                        </form>
                    </div>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown hidden-xs">
                    <a href="javascript:;" data-toggle="dropdown">
                        <i class="ti-more-alt"></i>
                    </a>
                    <ul class="dropdown-menu animated zoomIn">
                        <li class="dropdown-header">Quick Links</li>
                        <li>
                            <a href="javascript:;">Start New Campaign</a>
                        </li>
                        <li>
                            <a href="javascript:;">Review Campaigns</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="javascript:;">Settings</a>
                        </li>
                        <li>
                            <a href="javascript:;">Wish List</a>
                        </li>
                        <li>
                            <a href="javascript:;">Purchases History</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="javascript:;">Activity Log</a>
                        </li>
                        <li>
                            <a href="javascript:;">Settings</a>
                        </li>
                        <li>
                            <a href="javascript:;">System Reports</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="javascript:;">Help</a>
                        </li>
                        <li>
                            <a href="javascript:;">Report a Problem</a>
                        </li>
                    </ul>
                </li>

                <li class="notifications dropdown">
                    <a href="javascript:;" data-toggle="dropdown">
                        <i class="ti-bell"></i>
                        <div class="badge badge-top bg-danger animated flash">
                            <span>3</span>
                        </div>
                    </a>
                    <div class="dropdown-menu animated fadeInLeft">
                        <div class="panel panel-default no-m">
                            <div class="panel-heading small"><b>Notifications</b>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="javascript:;">
                                        <span class="pull-left mt5 mr15">
                                            <img src="img/faceless.jpg" class="avatar avatar-sm img-circle" alt="">
                                        </span>
                                        <div class="m-body">
                                            <div class="">
                                                <small><b>CRYSTAL BROWN</b></small>
                                                <span class="label label-danger pull-right">ASSIGN AGENT</span>
                                            </div>
                                            <span>Opened a support query</span>
                                            <span class="time small">2 mins ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="javascript:;">
                                        <div class="pull-left mt5 mr15">
                                            <div class="circle-icon bg-danger">
                                                <i class="ti-download"></i>
                                            </div>
                                        </div>
                                        <div class="m-body">
                                            <span>Upload Progress</span>
                                            <div class="progress progress-xs mt5 mb5">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                </div>
                                            </div>
                                            <span class="time small">Submited 23 mins ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="javascript:;">
                                        <span class="pull-left mt5 mr15">
                                            <img src="img/faceless.jpg" class="avatar avatar-sm img-circle" alt="">
                                        </span>
                                        <div class="m-body">
                                            <em>Status Update:</em>
                                            <span>All servers now online</span>
                                            <span class="time small">5 days ago</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>

                            <div class="panel-footer">
                                <a href="javascript:;">See all notifications</a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="off-right">
                    <a href="javascript:;" data-toggle="dropdown">
                        <img src="img/faceless.jpg" class="header-avatar img-circle" alt="user" title="user">
                        <span class="hidden-xs ml10">Gerald Morris</span>
                        <i class="ti-angle-down ti-caret hidden-xs"></i>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight">
                        <li>
                            <a href="javascript:;">Settings</a>
                        </li>
                        <li>
                            <a href="javascript:;">Upgrade</a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <div class="badge bg-danger pull-right">3</div>
                                <span>Notifications</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">Help</a>
                        </li>
                        <li>
                            <a href="signin.html">Logout</a>
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
                    <p class="nav-title">MENU</p>
                    <ul class="nav">
                        <!-- dashboard -->
                        <li>
                            <a href="index.html">
                                <i class="ti-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <!-- /dashboard -->

                        <!-- ui -->
                        <li>
                            <a href="javascript:;">
                                <i class="toggle-accordion"></i>
                                <i class="ti-layout-media-overlay-alt-2"></i>
                                <span>UI Elements</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="buttons.html">
                                        <span>Buttons</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="general.html">
                                        <span>General Elements</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="typography.html">
                                        <span>Typography</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="tabs_accordion.html">
                                        <span>Tabs &amp; Accordions</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="icons.html">
                                        <span>Fontawesome</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="themify_icons.html">
                                        <span>Themify Icons</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="grid.html">
                                        <span>Grid Layout</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="widgets.html">
                                        <span>Widgets</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- /ui -->

                        <!-- Components -->
                        <li>
                            <a href="javascript:;">
                                <i class="toggle-accordion"></i>
                                <i class="ti-support"></i>
                                <span>Components</span> 
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="calendar.html">
                                        <span>Calendar</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="gallery.html">
                                        <span>Gallery</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="sortable.html">
                                        <span>Sortable &amp; Nestable Lists</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="chart.html">
                                        <span>Charts</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="progress_slider.html">
                                        <span>Progress bars &amp; Sliders</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="tree.html">
                                        <span>Tree View</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="notifications.html">
                                        <span>Notifications</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="animated.html">
                                        <span>Animated Elements</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="tour.html">
                                        <span>Tour</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- /components -->

                        <!-- forms -->
                        <li>
                            <a href="javascript:;">
                                <i class="toggle-accordion"></i>
                                <i class="ti-folder"></i>
                                <span>Forms</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="forms.html">
                                        <span>Forms Elements</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="form_custom.html">
                                        <span>Customized Elements</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="form_validation.html">
                                        <span>Form Validation</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="form_wizard.html">
                                        <span>Form Wizards</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="form_wysiwyg.html">
                                        <span>WYSIWYG/Markdown Editors</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="form_inline.html">
                                        <span>Content Editable</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="form_dropzone.html">
                                        <span>Dropzone</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="xeditable.html">
                                        <span>X-Editable</span>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="form_masks.html">
                                        <span>Input Masks</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="form_pickers.html">
                                        <span>Form Pickers</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="form_crop.html">
                                        <span>Image Crop</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- /forms -->

                        <!-- tables -->
                        <li class="open">
                            <a href="javascript:;">
                                <i class="toggle-accordion"></i>
                                <i class="ti-window"></i>
                                <span>Tables</span>
                            </a>
                            <ul class="sub-menu">
                                <li class="active">
                                    <a href="table_basic.html">
                                        <span>Basic Tables</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="table_responsive.html">
                                        <span>Resonsive Table</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="datatable.html">
                                        <span>Data Tables</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="table_editable.html">
                                        <span>Editable Table</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- /tables -->

                        <!-- maps -->
                        <li>
                            <a href="javascript:;">
                                <i class="toggle-accordion"></i>
                                <i class="ti-map"></i>
                                <span>Maps</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="google_maps.html">
                                        <span>Google Maps</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="vector.html">
                                        <span>Vector Maps</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- /maps -->
                    </ul>
                    
                    <p class="nav-title">MORE</p>
                    <ul class="nav">
                        <!-- pages -->
                        <li>
                            <a href="javascript:;">
                                <i class="toggle-accordion"></i>
                                <i class="ti-layers"></i>
                                <span>Ready Pages</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="mail.html">
                                        <span>Mailbox</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="mail_view.html">
                                        <span>Mail View</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="compose.html">
                                        <span>Compose</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="profile.html">
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="invoice.html">
                                        <span>Invoice</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="signin.html">
                                        <span>Signin</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="signup.html">
                                        <span>Signup</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="forgot.html">
                                        <span>Forgot Password</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="lock.html">
                                        <span>Lock Screen</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="404.html">
                                        <span>404 Page</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="500.html">
                                        <span>500 Page</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="changelog.html">
                                        <span class="pull-right small label label-danger">Updated</span>
                                        <span>Change Log</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="timeline.html">
                                        <span>Timeline</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="catalog.html">
                                        <span>Catalog</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="chat.html">
                                        <span>Chat</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <!-- /pages -->

                        <!-- layouts -->
                        <li>
                            <a href="javascript:;">
                                <i class="toggle-accordion"></i>
                                <i class="ti-layout"></i>
                                <span>Layouts</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="small_menu.html">
                                        <span>Small Menu</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="right_menu.html">
                                        <span>Right Side Menu</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="push_sidebar.html">
                                        <span>Chat Sidebar</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="language_bar.html">
                                        <span>Language Switcher</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="footer_layout.html">
                                        <span>Layout With Footer</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="horizontal_menu.html">
                                        <span>Horizontal Menu</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="boxed.html">
                                        <span>Boxed Layout</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="horizontal_menu_boxed.html">
                                        <span>Horizontal Boxed</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="fixed_scroll.html">
                                        <span>Fixed Header &amp; Scrollable Layout</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="blank.html">
                                        <span>Blank Page</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- /layouts -->

                        <!-- multi level menu -->
                        <li>
                            <a href="javascript:;">
                                <i class="toggle-accordion"></i>
                                <i class="ti-menu-alt"></i>
                                <span>Multi Level Menu</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="javascript:;">
                                        <i class="toggle-accordion"></i>
                                        <span>Menu Link 1</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="javascript:;">
                                                <span>Menu Link 1.1</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span>Menu Link 1.2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span>Menu Link 1.3</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="toggle-accordion"></i>
                                        <span>Menu Link 2</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="javascript:;">
                                                <span>Menu Link 2.1</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span>Menu Link 2.2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span>Menu Link 2.3</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span>Menu Link 3</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- /multi level menu -->
                    </ul>
                    <p class="nav-title">LABELS</p>
                    <ul class="nav">
                        <li>
                            <a href="javascript:;">
                                <i class="ti-control-record text-warning"></i>
                                <span>Projects</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="ti-control-record text-success"></i>
                                <span>Apps</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="ti-control-record text-danger"></i>
                                <span>Support</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside>
            <!-- /sidebar menu -->

            <!-- main content -->
            <section class="main-content">

                <!-- content wrapper -->
                <div class="content-wrap">

                    <!-- inner content wrapper -->
                    <div class="wrapper">
                        <ol class="breadcrumb">
                            <li>
                                <a href="javascript:;"><i class="ti-home mr5"></i>Dashboard</a>
                            </li>
                            <li>
                                <a href="javascript:;"><i class="ti-window mr5"></i>Tables</a>
                            </li>
                            <li class="active">Basic Table Elements</li>
                        </ol>

                        
                        <div class="row">
                            <div class="col-md-12">
                                <section class="panel">
                                    <div class="panel-heading no-b">
                                        <h5>Cronograma Fisico/Financeiro: <b>Projeto Nome do Projeto</b></h5>
                                    </div>
                                    <div class="panel-body">
                                       <table class="table table-bordered no-m">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Descrição</th>
                                                    <th></th>
                                                    <th>%</th>
                                                    
		                                      	                                                    <th>1/2014</th>
			                                                                                          <th>2/2014</th>
			                                                                                          <th>3/2014</th>
			                                                                                          <th>4/2014</th>
			                                                                                          <th>5/2014</th>
			                                                                                          <th>6/2014</th>
			                                                                                          <th>7/2014</th>
			                                                                                          <th>8/2014</th>
			                                                                                          <th>9/2014</th>
			                                                                                          <th>10/2014</th>
			                                                                                                                                              
                                                </tr>
                                            </thead>
                                            <tbody>
                                                                                            <tr>
                                                    <th colspan="100%">3655869846 - </th>
                                                </tr>
                                                                                             <tr>
                                                    <td rowspan="2">1</td>
                                                    <td rowspan="2">SERVIÇO 003 TESTE</td>
                                                    <td>Previsto</td>
                                                    <td>
                                                        <div class="small">Percentual (%)</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>Valor(R$)</small>
                                                    </td>
                                                    
		                                      	
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                       
                                                                                                     
                                                                                                        
                                                   
                                                </tr>
                                                

                                                <tr>
                                                    <td border="1">Realizado</td>
                                                    <td>
                                                        <div class="small">Percentual (%)</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>Valor(R$)</small>
                                                    </td>

		                                      	
                                                                                                <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>   
			                                                                                           
              
                                                    
                                                </tr>
                                                                                                <tr>
                                                    <th colspan="100%">1111111111111111 - teste objeto</th>
                                                </tr>
                                                                                             <tr>
                                                    <td rowspan="2">2</td>
                                                    <td rowspan="2">teste de </td>
                                                    <td>Previsto</td>
                                                    <td>
                                                        <div class="small">Percentual (%)</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>Valor(R$)</small>
                                                    </td>
                                                    
		                                      	
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-danger done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-danger done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-danger done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-danger done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-danger done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-danger done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-danger done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 25 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 25%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-danger done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 10</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 75 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 75%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-danger done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 30</small>
                                                    </td>                                                    
			                                       
                                                                                                     
                                                                                                        
                                                   
                                                </tr>
                                                

                                                <tr>
                                                    <td border="1">Realizado</td>
                                                    <td>
                                                        <div class="small">Percentual (%)</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>Valor(R$)</small>
                                                    </td>

		                                      	
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 200</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 200</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 200</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 200</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 200</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 200</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 200</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 200</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 200</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 200</small>
                                                    </td>   
			                                                                                           
              
                                                    
                                                </tr>
                                                                                                <tr>
                                                    <th colspan="100%">9999999999 - </th>
                                                </tr>
                                                                                             <tr>
                                                    <td rowspan="2">3</td>
                                                    <td rowspan="2">SERVIÇO DE PINTURA</td>
                                                    <td>Previsto</td>
                                                    <td>
                                                        <div class="small">Percentual (%)</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>Valor(R$)</small>
                                                    </td>
                                                    
		                                      	
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 30.30303030303 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 30.30303030303%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 100</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 90.909090909091 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 90.909090909091%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 300</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 600</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 600</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 600</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 600</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 600</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 600</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 600</small>
                                                    </td>                                                    
			                                       
                                                                                                     
                                                                                                        
                                                   
                                                </tr>
                                                

                                                <tr>
                                                    <td border="1">Realizado</td>
                                                    <td>
                                                        <div class="small">Percentual (%)</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>Valor(R$)</small>
                                                    </td>

		                                      	
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 500</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 500</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 500</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 500</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 500</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 500</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 500</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 500</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 500</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 500</small>
                                                    </td>   
			                                                                                           
              
                                                    
                                                </tr>
                                                                                                <tr>
                                                    <th colspan="100%">3655869846 - </th>
                                                </tr>
                                                                                             <tr>
                                                    <td rowspan="2">4</td>
                                                    <td rowspan="2">SERVIÇO 002 TESTE</td>
                                                    <td>Previsto</td>
                                                    <td>
                                                        <div class="small">Percentual (%)</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>Valor(R$)</small>
                                                    </td>
                                                    
		                                      	
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-danger done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-danger done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-danger done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-danger done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-danger done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-danger done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                      
                                                    <td>
                                                    <div class="small"> 0 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-danger done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 0</small>
                                                    </td>                                                    
			                                       
                                                                                                     
                                                                                                        
                                                   
                                                </tr>
                                                

                                                <tr>
                                                    <td border="1">Realizado</td>
                                                    <td>
                                                        <div class="small">Percentual (%)</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>Valor(R$)</small>
                                                    </td>

		                                      	
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 450</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 450</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 450</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 450</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 450</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 450</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 450</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 450</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 450</small>
                                                    </td>   
			                                      
                                                                                                <td>
                                                    <div class="small"> 100 %</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar progress-bar-success done">
                                                            </div>
                                                        </div>
                                                        <small>R$ 450</small>
                                                    </td>   
			                                                                                           
              
                                                    
                                                </tr>
                                                                                                    
                                                </tr>

    
                                                <tr colspan="4" style="background:#fafafc">
                                                    <td colspan="4" >Percentual Previsto Simples</td>
                                                    
		                                      	
                                                    <td>
                                                        0% 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        30.30303030303 % 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        60.606060606061 % 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        9.0909090909091 % 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0% 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0% 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0% 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0% 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        25 % 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        50 % 
                                                    </td>
                                                    
			                                                                                           
                                                    


                                                    
                                                </tr>


                                                <tr colspan="4" style="background:#fafafc">
                                                    <td colspan="4" >Percentual Realizado Simples</td>
                                                    
		                                      	
                                                    <td>
                                                        0%                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        100 %                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0%                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        100 %                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0%                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0%                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0%                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0%                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0%                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0%                                                    </td>
                                                    
			                                                                                           
                                                    


                                                    
                                                </tr>                                                

                                                <tr style="background:#fafafc">
                                                    <td colspan="4">Percentual Previsto Acumulado</td>
                                                    
		                                      	                                            

                                                    <td>
                                                        0% 
                                                    </td>
                                                    
			                                                                                  

                                                    <td>
                                                        30.30303030303 % 
                                                    </td>
                                                    
			                                                                                  

                                                    <td>
                                                        45.454545454545 % 
                                                    </td>
                                                    
			                                                                                  

                                                    <td>
                                                        33.333333333333 % 
                                                    </td>
                                                    
			                                                                                  

                                                    <td>
                                                        33.333333333333 % 
                                                    </td>
                                                    
			                                                                                  

                                                    <td>
                                                        33.333333333333 % 
                                                    </td>
                                                    
			                                                                                  

                                                    <td>
                                                        33.333333333333 % 
                                                    </td>
                                                    
			                                                                                  

                                                    <td>
                                                        33.333333333333 % 
                                                    </td>
                                                    
			                                                                                  

                                                    <td>
                                                        31.25 % 
                                                    </td>
                                                    
			                                                                                  

                                                    <td>
                                                        35 % 
                                                    </td>
                                                    
			                                                                                           
                                                    
                                                </tr>
                                                
                                                
                                                <tr style="background:#fafafc">
                                                    <td colspan="4">Percentual Realizado Acumulado</td>
                                                    
		                                      	                                            

                                                    <td>
                                                        0% 
                                                    </td>
                                                    
			                                                                                  

                                                    <td>
                                                        100 % 
                                                    </td>
                                                    
			                                                                                  

                                                    <td>
                                                        100 % 
                                                    </td>
                                                    
			                                                                                  

                                                    <td>
                                                        100 % 
                                                    </td>
                                                    
			                                                                                  

                                                    <td>
                                                        100 % 
                                                    </td>
                                                    
			                                                                                  

                                                    <td>
                                                        100 % 
                                                    </td>
                                                    
			                                                                                  

                                                    <td>
                                                        100 % 
                                                    </td>
                                                    
			                                                                                  

                                                    <td>
                                                        100 % 
                                                    </td>
                                                    
			                                                                                  

                                                    <td>
                                                        100 % 
                                                    </td>
                                                    
			                                                                                  

                                                    <td>
                                                        100 % 
                                                    </td>
                                                    
			                                                                                           
                                                    
                                                </tr>
                                                                                                
                                                <tr style="background:#fafafc">
                                                    <td colspan="4">Valor Previsto Simples</td>
	                                      	
                                                    <td>
                                                        0 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        100 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        200 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        300 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        10 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        20 
                                                    </td>
                                                    
			                                        
                                                    
                                                </tr>
                                                
                                                <tr style="background:#fafafc">
                                                    <td colspan="4">Valor Realizado Simples</td>
	                                      	
                                                    <td>
                                                        0 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        200 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        950 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        0 
                                                    </td>
                                                    
			                                        
                                                    
                                                </tr>
                                                
                                                <tr style="background:#fafafc">
                                                    <td colspan="4">Valor Previsto Acumulado</td>
	                                      	
                                                    <td>
                                                          
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        100  
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        300  
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        600  
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        600  
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        600  
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        600  
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        600  
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        610  
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                        630  
                                                    </td>
                                                    
			                                        
                                                    
                                                </tr>
                                                
                                                <tr style="background:#fafafc">
                                                    <td colspan="4">Valor Realizado Acumulado</td>
	                                      	
                                                    <td>
                                                          
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                         200 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                         200 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                         1150 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                         1150 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                         1150 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                         1150 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                         1150 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                         1150 
                                                    </td>
                                                    
			                                      
                                                    <td>
                                                         1150 
                                                    </td>
                                                    
			                                        
                                                    
                                                </tr>
                                                                                                
                                            </tbody>
                                        </table>

                                    </div>
                                </section>
                            </div>
                            
                        </div>
                        
                    <!-- /inner content wrapper -->

                </div>
                <!-- /content wrapper -->
                <a class="exit-offscreen"></a>
            </section>
            <!-- /main content -->
        </section>

    </div>

    <!-- core scripts -->
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery-1.11.1.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/bootstrap/js/bootstrap.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.slimscroll.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.easing.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/appear/jquery.appear.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.placeholder.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/fastclick.js"></script>
    <!-- /core scripts -->

    <!-- page level scripts -->
    <script src="/<?php echo PROJETO;?>/inc/plugins/table-sortable/sortable.min.js"></script>
    <!-- /page level scripts -->

    <!-- template scripts -->
    <script src="/<?php echo PROJETO;?>/inc/js/offscreen.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/main.js"></script>
    <!-- /template scripts -->

    <!-- page script -->
    <!-- /page script -->

</body>
<!-- /body -->

</html>
