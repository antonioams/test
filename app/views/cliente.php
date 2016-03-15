<?php session_start();
?>
<!doctype html>
<html class="signin no-js" lang="">
<head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta name="description" content="Flat, Clean, Responsive, application admin template built with bootstrap 3">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
    <!-- /meta -->
    <title><?php echo PROJETO;?></title>
    <!-- core styles -->
    <link rel="stylesheet" href="/<?php echo PROJETO?>/inc/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/<?php echo PROJETO?>/inc/css/font-awesome.css">
    <link rel="stylesheet" href="/<?php echo PROJETO?>/inc/css/themify-icons.css">
    <link rel="stylesheet" href="/<?php echo PROJETO?>/inc/css/animate.min.css">
    <!-- /core styles -->
    <!-- template styles -->
    <link rel="stylesheet" href="/<?php echo PROJETO?>/inc/css/skins/palette.css">
    <link rel="stylesheet" href="/<?php echo PROJETO?>/inc/css/fonts/font.css">
    <link rel="stylesheet" href="/<?php echo PROJETO?>/inc/css/main.css">
    <!-- template styles -->
    <!-- load modernizer -->
    <script src="/<?php echo PROJETO?>/inc/plugins/modernizr.js"></script>
</head>
<body class="bg-primary">
    <div class="cover" style="background-image: url(inc/img/cover3.jpg)">
    </div>
    <div align="center" style="padding-top:10px;"></div>
    <div class="center-wrapper">
        <div class="center-content">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <section class="panel bg-white no-b">
                         <div class="topologin" align="center">
                        <img src="/<?php echo PROJETO;?>/inc/img/logindoricon.png">
                        </div>
                        <div class="p15">
                            <div class="<?php echo $_SESSION[PROJETO]['mensagem']['tipo'];?>">
                                <?php 
                                echo $_SESSION[PROJETO]['mensagem']['texto'];
                                unset( $_SESSION[PROJETO]['mensagem'] );?>
                            </div>

                            <form role="form" id="loginform" name="loginform" method="post" action="/<?php echo PROJETO; ?>/index/verifica/id/<?php echo $view_cliente;?>">
                                <input type="text" class="form-control input-lg mb25" id="usuario" name="usuario" placeholder="Usuario" autofocus>
                                <input type="password" class="form-control input-lg mb25" id="pass" name="pass" placeholder="Senha">
                                <div class="show">

                                    <label class="checkbox">

                                    </label>
                                </div>
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Entrar</button>
                            </form>
                        </div>
                    </section>
                    <p class="text-center">
                         <img src="/<?php echo PROJETO?>/inc/img/cliente/c<?php echo $view_cdcliente?>.png" width="70" height="70" alt=""><br><?php echo $view_nomecliente?>
                        <br><br><b>SIG</b><br>
                        ORBITA &copy;
                        <span id="year" class="mr5"></span>
                        <span> Todos os Direitos Reservados</span>
                    </p>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var el = document.getElementById("year"),
            year = (new Date().getFullYear());
        el.innerHTML = year;
    </script>
</body>
</html>