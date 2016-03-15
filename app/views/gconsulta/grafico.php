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
    <script src="plugins/modernizr.js"></script>
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
                        <li class="open">
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
                                <li class="active">
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
                        <li>
                            <a href="javascript:;">
                                <i class="toggle-accordion"></i>
                                <i class="ti-window"></i>
                                <span>Tables</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
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
                        <section class="panel">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12 mb25">
                                        <h5>Flot <b>Charts</b> - Line</h5>

                                        <div id="line-chart" class="chart"></div>

                                    </div>

                                    <div class="col-sm-6">
                                        <h5>Flot <b>Charts</b> - Bars</h5>

                                        <div id="bar-chart" class="chart mt25"></div>

                                    </div>
                                    <div class="col-sm-6">
                                        <h5>Flot <b>Charts</b> - Pie</h5>

                                        <div class="flot-pie chart mt25"></div>

                                    </div>
                                </div>
                            </div>
                        </section>

                        <div class="row">
                            <div class="col-sm-6">
                                <section class="panel">
                                    <header class="panel-heading no-b">
                                        <h5>Real<b>Time</b></h5>
                                    </header>
                                    <div class="panel-body">
                                        <div class="realtime chart"></div>
                                    </div>
                                </section>
                            </div>
                            <div class="col-sm-6">
                                <section class="panel">
                                    <header class="panel-heading no-b">
                                        <h5>Categorized <b>Charts</b></h5>
                                    </header>
                                    <div class="panel-body">
                                        <div class="category chart"></div>
                                    </div>
                                </section>
                            </div>
                        </div>

                        <section class="panel text-center">
                            <div class="panel-body text-center">

                                <div class="row">
                                    <div class="col-md-4">
                                        <section class="panel">
                                            <h5>Easypie Chart - Bounce <b>Rate</b></h5>

                                            <div class="piechart">
                                                <span class="bounce" data-percent="86">
                                                <span>
                                                    <div class="percent"></div>
                                                    <small>Bounce Rate</small>
                                                </span>
                                                </span>
                                            </div>

                                        </section>
                                    </div>
                                    <div class="col-md-4">
                                        <section class="panel">
                                            <h5>Easypie Chart - Signup <b>Rate</b></h5>

                                            <div class="piechart">
                                                <span class="total" data-percent="52">
                                                <span>
                                                    <div class="percent"></div>
                                                    <small>Sign up Rate</small>
                                                </span>
                                                </span>
                                            </div>

                                        </section>
                                    </div>
                                    <div class="col-md-4">
                                        <section class="panel">
                                            <h5>Easypie Chart - New <b>Visits</b></h5>

                                            <div class="piechart">
                                                <span class="visits" data-percent="67">
                                                <span>
                                                    <div class="percent"></div>
                                                    <small>Daily Visits</small>
                                                </span>
                                                </span>
                                            </div>

                                        </section>
                                    </div>
                                </div>

                            </div>
                        </section>

                        <div class="row">
                            <div class="col-sm-6">
                                <section class="panel">
                                    <header class="panel-heading no-b">
                                        <h5>Jaguar 'E' Type vehicles in the UK</h5>
                                    </header>
                                    <div class="panel-body">
                                        <div id="hero-graph" class="chart"></div>
                                    </div>
                                </section>
                                <section class="panel">
                                    <header class="panel-heading no-b">
                                        <h5>Quarterly Apple iOS device unit sales</h5>
                                    </header>
                                    <div class="panel-body">
                                        <div id="hero-area" class="chart"></div>
                                    </div>
                                </section>
                            </div>
                            <div class="col-sm-6">
                                <section class="panel">
                                    <header class="panel-heading no-b">
                                        <h5>iPhone CPU Benchmarks</h5>
                                    </header>
                                    <div class="panel-body">
                                        <div id="hero-bar" class="chart mb25 mt20"></div>

                                        <h5>Donut flavours</h5>
                                        <div id="hero-donut" class="chart mb25 mt25">
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>

                        <section class="panel text-center">
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-sm-6 col-md-3">

                                        <h5>Sparkline <b>Lines</b></h5>

                                        <div class="sparkline-line-bm mt5 mb5"></div>

                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <h5>Sparkline <b>Pie</b></h5>
                                        <div class="sparkpie"></div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <h5>Sparkline <b>Bars</b></h5>
                                        <div class="sparkline-bar-bm mt25"></div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <h5>Composite <b>Sparkline</b></h5>
                                        <div class="sparkline-ext"></div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <div class="row">
                            <div class="col-lg-6">
                                <section class="panel">
                                    <header class="panel-heading no-b">
                                        <h5>Chartjs Plot <b>Area</b></h5>
                                    </header>
                                    <div class="panel-body">
                                        <canvas id="plot-area" height="300" class="center-block"></canvas>
                                    </div>
                                </section>
                            </div>
                            <div class="col-lg-6">
                                <section class="panel">
                                    <header class="panel-heading no-b">
                                        <h5>Chart <b>Radar</b></h5>
                                    </header>
                                    <div class="panel-body">
                                        <canvas id="radar" height="300" class="center-block"></canvas>
                                    </div>
                                </section>
                            </div>
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
    <script src="/<?php echo PROJETO;?>/inc/plugins/flot/jquery.flot.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/flot/jquery.flot.categories.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/flot/jquery.flot.stack.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/flot/jquery.flot.time.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/flot/jquery.flot.orderBars.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/flot/jquery.flot.pie.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.sparkline.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.easing.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/easy-pie-chart/jquery.easypiechart.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/raphael.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/morris/morris.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/chartjs/Chart.min.js"></script>
    <!-- /page level scripts -->

    <!-- template scripts -->
    <script src="/<?php echo PROJETO;?>/inc/js/offscreen.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/main.js"></script>
    <!-- /template scripts -->

    <!-- page script -->
    <script>
var charts = function () {

    var data = [],
        totalPoints = 300,
        updateInterval = 30,
        plot,
        previousPoint = null;

    var categoryData = [["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9], ["July", 4], ["August", 9]];

    var browserData = [
        {
            label: "IE",
            data: 15,
            color: "#848ca1"
        },
        {
            label: "Safari",
            data: 14,
            color: "#767f96"
        },
        {
            label: "Chrome",
            data: 34,
            color: "#697289"
        },
        {
            label: "Opera",
            data: 13,
            color: "#5e667a"
        },
        {
            label: "Firefox",
            data: 24,
            color: "#535a6c"
        }
    ];

    var visits = [
            [0, 5],
            [1, 5],
            [2, 13],
            [3, 16],
            [4, 15],
            [5, 16],
            [6, 14],
            [7, 5],
            [8, 5],
            [9, 15],
            [10, 17],
            [11, 16],
            [12, 14],
            [13, 16],
            [14, 8],
            [15, 6],
            [16, 17]
            ];


    var visitors = [
            [0, 4],
            [1, 4],
            [2, 12],
            [3, 13],
            [4, 11],
            [5, 12],
            [6, 10],
            [7, 6],
            [8, 4],
            [9, 11],
            [10, 14],
            [11, 11],
            [12, 12],
            [13, 13],
            [14, 5],
            [15, 4],
            [16, 12]
            ];

    var plotdata = [{
        data: visits,
        color: '#1F9FD4'
            }, {
        data: visitors,
        color: '#28d8b3'
            }];

    var barData = [
        {
            data: [[1391761856000, 8], [1394181056000, 4], [1396859456000, 2], [1399451456000, 2], [1402129856000, 5]],
            bars: {
                show: true,
                barWidth: 7 * 24 * 60 * 60 * 1000,
                fill: true,
                lineWidth: 0,
                order: 1,
                fillColor: "#FF604F"
            },
            color: "#FF604F"
        },
        {
            data: [[1391761856000, 5], [1394181056000, 3], [1396859456000, 1], [1399451456000, 7], [1402129856000, 3]],
            bars: {
                show: true,
                barWidth: 7 * 24 * 60 * 60 * 1000,
                fill: true,
                lineWidth: 0,
                order: 2,
                fillColor: "#FFB244"
            },
            color: "#FFB244"
        },
        {
            data: [[1391761856000, 3], [1394181056000, 6], [1396859456000, 4], [1399451456000, 4], [1402129856000, 4]],
            bars: {
                show: true,
                barWidth: 7 * 24 * 60 * 60 * 1000,
                fill: true,
                lineWidth: 0,
                order: 3,
                fillColor: "#28d8b3"
            },
            color: "#28d8b3"
        }
    ];

    var sparkData = {
        one: [8, 4, 3, 8, 7, 1, 6, 1, 3],
        two: [5, 5, 7, 1, 3, 5, 1, 7, 6, 3, 8, 7, 8, 1, 7, 8, 2, 6, 9, 5, 2, 9, 7, 5, 5, 9],
        three: [4, 6, 7, 1, 4, 5, 7, 9, 6, 5, 3, 7, 1, 2, 8, 7, 3, 8, 9, 2, 1, 7, 4, 9, 1, 7],
        pie: [35, 15, 50]
    };

    var chartData = [
        {
            value: Math.random(),
            color: "#D97041"
      },
        {
            value: Math.random(),
            color: "#C7604C"
      },
        {
            value: Math.random(),
            color: "#21323D"
      },
        {
            value: Math.random(),
            color: "#9D9B7F"
      },
        {
            value: Math.random(),
            color: "#7D4F6D"
      },
        {
            value: Math.random(),
            color: "#584A5E"
      }
    ];

    var tax_data = [{
        "period": "2011 Q3",
        "licensed": 3407,
        "sorned": 660
            }, {
        "period": "2011 Q2",
        "licensed": 3351,
        "sorned": 629
            }, {
        "period": "2011 Q1",
        "licensed": 3269,
        "sorned": 618
            }, {
        "period": "2010 Q4",
        "licensed": 3246,
        "sorned": 661
            }, {
        "period": "2009 Q4",
        "licensed": 3171,
        "sorned": 676
            }, {
        "period": "2008 Q4",
        "licensed": 3155,
        "sorned": 681
            }, {
        "period": "2007 Q4",
        "licensed": 3226,
        "sorned": 620
            }, {
        "period": "2006 Q4",
        "licensed": 3245,
        "sorned": null
            }, {
        "period": "2005 Q4",
        "licensed": 3289,
        "sorned": null
            }];

    function events() {
        $('#line-chart, .realtime').bind('plothover', function (event, pos, item) {
            if (item) {
                if (previousPoint !== item.dataIndex) {
                    previousPoint = item.dataIndex;
                    $('#tooltip').remove();
                    var x = item.datapoint[0],
                        y = item.datapoint[1];
                    showTooltip(item.pageX, item.pageY, y + ' at ' + x);
                }
            } else {
                $('#tooltip').remove();
                previousPoint = null;
            }
        });
    }

    function getRandomData() {

        if (data.length > 0) {
            data = data.slice(1);
        }

        // Do a random walk

        while (data.length < totalPoints) {

            var prev = data.length > 0 ? data[data.length - 1] : 50,
                y = prev + Math.random() * 10 - 5;

            if (y < 0) {
                y = 0;
            } else if (y > 20) {
                y = 20;
            }

            data.push(y);
        }

        // Zip the generated y values with the x values

        var res = [];
        for (var i = 0; i < data.length; ++i) {
            res.push([i, data[i]]);
        }

        return res;
    }

    function update() {

        plot.setData([getRandomData()]);

        // Since the axes don't change, we don't need to call plot.setupGrid()

        plot.draw();
        setTimeout(update, updateInterval);
    }

    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css({
            top: y - 10,
            left: x + 20
        }).appendTo('body').fadeIn(200);
    }

    function initFlot() {
        $.plot($(".flot-pie"), browserData, {
            series: {
                pie: {
                    show: true
                }
            },
            legend: {
                show: false
            },
            grid: {
                hoverable: true
            },
            stroke: {
                width: 0
            }
        });

        $.plot($('#bar-chart'), barData, {
            grid: {
                hoverable: false,
                clickable: false,
                labelMargin: 8,
                color: '#c2c2c2',
                borderColor: '#f0f0f0',
                borderWidth: 0,
            },
            xaxis: {
                min: (new Date(2014, 00, 1)).getTime(),
                max: (new Date(2014, 06, 18)).getTime(),
                mode: "time",
                timeformat: "%b",
                tickSize: [1, "month"],
                monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                tickLength: 0,
                axisLabel: 'Month',
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Open Sans, Arial, Helvetica, Tahoma, sans-serif',
                axisLabelPadding: 5
            },
            stack: true
        });

        plot = $.plot(".realtime", [getRandomData()], {
            colors: ['#535a6c'],
            lines: {
                lineWidth: 1,
            },
            series: {
                shadowSize: 0
            },
            grid: {
                color: '#c2c2c2',
                borderColor: '#f0f0f0',
                borderWidth: 1,
                hoverable: true
            },
            xaxis: {
                show: false
            },
            yaxis: {
                min: 0,
                max: 20
            }

        });

        $.plot(".category", [categoryData], {
            colors: ['#24ACE5'],
            series: {
                bars: {
                    show: true,
                    barWidth: 0.5,
                    align: 'center',
                    fill: 1,
                },
                shadowSize: 0
            },
            grid: {
                color: '#c2c2c2',
                borderColor: '#f0f0f0',
                borderWidth: 1
            },
            xaxis: {
                mode: "categories",
                tickLength: 0
            }
        });

        $.plot($('#line-chart'), plotdata, {
            series: {
                points: {
                    show: true,
                    radius: 3
                },
                lines: {
                    show: true,
                    lineWidth: 1,
                },
                shadowSize: 0
            },
            grid: {
                color: '#c2c2c2',
                borderColor: '#f0f0f0',
                borderWidth: 0,
                hoverable: true
            }
        });
    }

    function initSparkchart() {
        $('.sparkline-ext').sparkline(sparkData.three, {
            type: 'line',
            width: '100%',
            height: '40',
            lineWidth: 1,
            lineColor: '#ddd',
            spotColor: '#f1f4f9',
            fillColor: '',
            spotRadius: '2',
        });

        $('.sparkline-ext').sparkline(sparkData.two, {
            composite: true,
            type: 'line',
            width: '100%',
            lineWidth: 1,
            lineColor: '#ddd',
            spotColor: '#f1f4f9',
            fillColor: '',
            spotRadius: '2',

        });


        $('.sparkpie').sparkline(sparkData.pie, {
            type: 'pie',
            height: '60',
            sliceColors: ['#FF604F', '#FFB244', '#28d8b3']
        });


        $('.sparkline-line-bm').sparkline(sparkData.two, {
            type: 'line',
            width: '100%',
            height: '40',
            lineWidth: 0.5,
            lineColor: '#ccc',
            spotColor: '#ECF0F8',
            fillColor: '',
            spotRadius: '2',
        });

        $('.sparkline-bar-bm').sparkline(sparkData.two, {
            type: 'bar',
            width: '100%',
            height: '40',
            barWidth: 5,
            barSpacing: 4,
            barColor: '#2ecc71'
        });
    }

    function initEastPie() {
        $('.bounce').easyPieChart({
            size: 150,
            lineWidth: 9,
            barColor: '#17c3e5',
            trackColor: '#F3F5F8',
            lineCap: 'butt',
            easing: 'easeOutBounce',
            onStep: function (from, to, percent) {
                $(this.el).find('.percent').text(Math.round(percent));
            }
        });

        $('.visits').easyPieChart({
            size: 150,
            lineWidth: 20,
            barColor: '#2dcb73',
            trackColor: false,
            lineCap: 'round',
            easing: 'easeOutBounce',
            onStep: function (from, to, percent) {
                $(this.el).find('.percent').text(Math.round(percent));
            }
        });

        $('.total').easyPieChart({
            size: 150,
            lineWidth: 12,
            barColor: '#FFB244',
            trackColor: '#F3F5F8',
            lineCap: 'square',
            easing: 'easeOutBounce',
            scaleColor: false,
            onStep: function (from, to, percent) {
                $(this.el).find('.percent').text(Math.round(percent));
            }
        });

        $(".piechart").each(function () {
            var canvas = $(this).find("canvas");
            $(this).css({
                "width": canvas.width(),
                "height": canvas.height()
            });
        });
    }

    function initMorris() {
        Morris.Line({
            element: 'hero-graph',
            data: tax_data,
            xkey: 'period',
            ykeys: ['licensed', 'sorned'],
            labels: ['Licensed', 'Off the road'],
            lineColors: ['#20aae5', '#bdc3c7'],
            resize: true,
        });

        Morris.Donut({
            element: 'hero-donut',
            data: [{
                label: 'Jam',
                value: 25
                }, {
                label: 'Frosted',
                value: 40
                }, {
                label: 'Custard',
                value: 25
                }, {
                label: 'Sugar',
                value: 10
                }],
            colors: ['#20aae5'],
            formatter: function (y) {
                return y + "%";
            }
        });

        Morris.Area({
            element: 'hero-area',
            data: [{
                period: '2010 Q1',
                iphone: 2666,
                ipad: null,
                itouch: 2647
                }, {
                period: '2010 Q2',
                iphone: 2778,
                ipad: 2294,
                itouch: 2441
                }, {
                period: '2010 Q3',
                iphone: 4912,
                ipad: 1969,
                itouch: 2501
                }, {
                period: '2010 Q4',
                iphone: 3767,
                ipad: 3597,
                itouch: 5689
                }, {
                period: '2011 Q1',
                iphone: 6810,
                ipad: 1914,
                itouch: 2293
                }, {
                period: '2011 Q2',
                iphone: 5670,
                ipad: 4293,
                itouch: 1881
                }, {
                period: '2011 Q3',
                iphone: 4820,
                ipad: 3795,
                itouch: 1588
                }, {
                period: '2011 Q4',
                iphone: 15073,
                ipad: 5967,
                itouch: 5175
                }, {
                period: '2012 Q1',
                iphone: 10687,
                ipad: 4460,
                itouch: 2028
                }, {
                period: '2012 Q2',
                iphone: 8432,
                ipad: 5713,
                itouch: 1791
                }],
            xkey: 'period',
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['iPhone', 'iPad', 'iPod Touch'],
            pointSize: 2,
            resize: true,
            hideHover: 'auto',
            lineColors: ['#20aae5', '#5cb85c', '#FF604F']
        });

        Morris.Bar({
            element: 'hero-bar',
            data: [{
                device: 'iPhone',
                geekbench: 136
            }, {
                device: 'iPhone 3G',
                geekbench: 137
            }, {
                device: 'iPhone 3GS',
                geekbench: 275
            }, {
                device: 'iPhone 4',
                geekbench: 380
            }, {
                device: 'iPhone 4S',
                geekbench: 655
            }, {
                device: 'iPhone 5',
                geekbench: 1571
            }],
            xkey: 'device',
            ykeys: ['geekbench'],
            labels: ['Geekbench'],
            barRatio: 0.4,
            xLabelAngle: 35,
            hideHover: 'auto',
            resize: true,
            barColors: ['#20aae5']
        });
    }

    function initChartJs() {
        var ctx = $("#plot-area").get(0).getContext("2d");

        var myPolarArea = new Chart(ctx).PolarArea(chartData);

        var radarChartData = {
            labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Partying", "Running"],
            datasets: [
                {
                    fillColor: "rgba(220,220,220,0.5)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    data: [65, 59, 90, 81, 56, 55, 40]
        },
                {
                    fillColor: "rgba(151,187,205,0.5)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    data: [28, 48, 40, 19, 96, 27, 100]
        }
      ]
        };

        var ptx = $("#radar").get(0).getContext("2d");

        var myRadar = new Chart(ptx).Radar(radarChartData, {
            scaleShowLabels: false,
            pointLabelFontSize: 10
        });
    }

    return {
        init: function () {
            events();
            initFlot();
            initSparkchart();
            initEastPie();
            initMorris();
            initChartJs();
            update();
        }
    };
}();

$(function () {
    "use strict";
    charts.init();
});
    </script>
    <!-- /page script -->

</body>
<!-- /body -->

</html>
