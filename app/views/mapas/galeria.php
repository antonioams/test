<?php

      //   foreach ($view_listagaleria as $item) {
            ?>
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

             <section class="main-content">

                

                <!-- content wrapper -->
                <div class="content-wrap">

                    <!-- inner content wrapper -->
                    <div class="wrapper">

                        <div class="gallery-loader">
                            <div class="loader"></div>
                        </div>

                        <!-- SuperBox -->
                        <div class="superbox hide">
                            <?php 
                            //print_r($view_galeria);
                            foreach ($view_galeria as $fotos) {
                                $foto=explode(',',$fotos['texto']);
                                $img='';
                                $src="http://farm".$foto[3].".static.flickr.com/".$foto[1]."/".$foto[0]."_".$foto[2]."_m.jpg";  
                                $src2 = "http://farm".$foto[3].".static.flickr.com/".$foto[1]."/".$foto[0]."_".$foto[2]."_z.jpg";  
                            ?>
                            <div class="superbox-list">
                                <img src="<?php echo $src;?>" data-img="<?php echo $src2;?>" data-text="<h4><?php echo $fotos['intervencao'];?></h4><small class='sub-title'><b>Data da Foto:</b> <?php echo $fotos['datahora'];?></small><h5>Endere&ccedil;o: <?php echo htmlentities($fotos['endereco']);?></h5><h5>Objetivo: <?php echo htmlentities($fotos['objetivo']);?></h5>" alt="" class="superbox-img">
                                <div class="gallery-description">
                                    <span class="title"><strong><?php echo $fotos["intervencao"];?></strong></span>
                                    <small class="sub-title"><?php echo $fotos["datahora"];?></small>
                                </div>
                            </div>
                            <?php
                             }
                            ?>
                            <div class="superbox-float"></div>
                        </div>
                        <!-- /SuperBox -->

                    </div>
                    <!-- /inner content wrapper -->

                </div>
                <!-- /content wrapper -->
                <a class="exit-offscreen"></a>
            </section>
            
<?php

        // }
        ?>
                    <!-- /inner content wrapper -->
   <script src="/<?php echo PROJETO;?>/inc/plugins/jquery-1.11.1.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/bootstrap/js/bootstrap.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.slimscroll.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.easing.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/appear/jquery.appear.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/jquery.placeholder.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/fastclick.js"></script>
    <!-- /core scripts -->

    <!-- page level scripts -->
    <script src="/<?php echo PROJETO;?>/inc/plugins/isotope/isotope.pkgd.min.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/imagesloaded/imagesloaded.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/plugins/superbox/superbox.js"></script>
    <!-- /page level scripts -->

    <!-- template scripts -->
    <script src="/<?php echo PROJETO;?>/inc/js/offscreen.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/main.js"></script>
    <!-- /template scripts -->

    <!-- page script -->
    <script src="/<?php echo PROJETO;?>/inc/js/gallery.js"></script>