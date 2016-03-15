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
    <link rel="stylesheet" href="inc/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/css/font-awesome.css">
    <link rel="stylesheet" href="inc/css/themify-icons.css">
    <link rel="stylesheet" href="inc/css/animate.min.css">
    <!-- /core styles -->
    <!-- template styles -->
    <link rel="stylesheet" href="inc/css/skins/palette.css">
    <link rel="stylesheet" href="inc/css/fonts/font.css">
    <link rel="stylesheet" href="inc/css/main.css">
    <!-- template styles -->
    <!-- load modernizer -->
    <script src="inc/plugins/modernizr.js"></script>
</head>
<body class="bg-primary">

    <!-- error wrapper -->
    <div class="center-wrapper">

        <div class="center-content text-center">

            <div class="error-number animated bounceIn">!</div>

            <div class="mb25"><span>  <br> <?php 
                                echo $_SESSION[PROJETO]['mensagem']['texto'];
                                unset( $_SESSION[PROJETO]['mensagem'] );?>
                                        </span></div>

            

            <div class="search">
                <form role="form" id="loginform" name="loginform" method="post" action="index/pesquisa">
                    <div class="search-form">
                        <button class="search-button" type="submit" title="Search">
                            <i class="ti-search"></i>
                        </button>
                        <input class="form-control no-b" name="sigla" placeholder="Identificao do Cliente" type="text">
                    </div>
                </form>
            </div>

                    <p class="text-center">
                        <img src="/<?php echo PROJETO;?>/inc/img/sig.png" height="70" width="70"><br><b>SIG</b><br>
                        ORBITA &copy;
                        <span id="year" class="mr5"></span>
                        <span> Todos os Direitos Reservados</span>
                    </p>
        </div>
    </div>
    <!-- /error wrapper -->

    <script type="text/javascript">
        var el = document.getElementById("year"),
            year = (new Date().getFullYear());
        el.innerHTML = year;
    </script>




</body><!-- /body --></html>