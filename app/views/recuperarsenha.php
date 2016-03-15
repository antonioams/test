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
    <link rel="stylesheet" href="../../inc/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../inc/css/font-awesome.css">
    <link rel="stylesheet" href="../../inc/css/themify-icons.css">
    <link rel="stylesheet" href="../../inc/css/animate.min.css">
    <!-- /core styles -->
    <!-- template styles -->
    <link rel="stylesheet" href="../../inc/css/skins/palette.css">
    <link rel="stylesheet" href="../../inc/css/fonts/font.css">
    <link rel="stylesheet" href="../../inc/css/main.css">
    <!-- template styles -->
    <!-- load modernizer -->
    <script src="../../inc/plugins/modernizr.js"></script>
</head>
<body class="bg-primary">

    <div class="cover" style="background-image: url(img/cover3.jpg)"></div>

    <div class="overlay bg-primary"></div>

    <div class="center-wrapper">
        <div class="center-content">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <section class="panel bg-white no-b">
                        <div class="p15">
                            <p class="text-center mb25">Esqueceu sua senha? insira seu e-mail no campo abaixo para recuperá-la</p>
                            <form role="form" action="signin.html">
                                <input type="email" class="form-control input-lg mb25" placeholder="e-mail" autofocus>

                                <button class="btn btn-primary btn-lg btn-block" type="submit">Enviar Senha</button>
                             <div class="show">
                             	</br>
                                    <div class="pull-left">
                                        <a href="../../">Voltar</a>
                                    </div></br>
                                </div>                                
                        </div>
   
                    </section>
                    <p class="text-center">
                        ORBITA &copy;
                        <span id="year" class="mr5"></span>
                        <span>Todos os direitos reservados</span>
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
