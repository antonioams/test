
<?php
include('app/views/topo.php');
?>
<div class="<?php echo $_SESSION[PROJETO]['mensagem']['tipo'];?>">
                                <?php
                                echo $_SESSION[PROJETO]['mensagem']['texto'];
                                unset( $_SESSION[PROJETO]['mensagem'] );?>
                            </div>

            <!-- main content -->
  <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/distc/cropper.min.css">
  <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/css/maincrop.css">

                            <!-- main content -->
            <section class="main-content">

                <!-- content wrapper -->
                <div class="content-wrap">

                    <!-- inner content wrapper -->
                    <div class="wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- profile information sidebar -->

                                <div class="panel overflow-hidden no-b profile p15">



                                    <div class="row mb25">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8">
                                                    <h4 class="mb0"><b><?php echo $view_usu[0]['nome']?></b></h4>
                                                    <small><?php echo $view_usu[0]['email']?></small>

                                                    <h6 class="mt15 mb15">Human Resources Manager</h6>
                                                    <ul class="user-meta">
                                                        <li>
                                                            <i class="ti-email mr5"></i>
                                                            <span>email@contact.com</span>
                                                        </li>
                                                        <li>
                                                            <i class="ti-world mr5"></i>
                                                            <a href="javascript:;">www.example.com</a>
                                                        </li>
                                                        <li>
                                                            <i class="ti-settings mr5"></i>
                                                            <a href="javascript:;">Edit Profile</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 text-center">
                                                    <figure>
  <link rel="stylesheet" href="distc/cropper.min.css">
  <link rel="stylesheet" href="css/maincrop.css">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <div class="" id="crop-avatar" align='center'>

    <!-- Current avatar -->
    <div class="avatar-view" title="Trocar foto">
      <img src="img/picture.jpg" alt="Avatar" class="avatar avatar-lg img-circle avatar-bordered">
    </div>

    <!-- Cropping modal -->
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form class="avatar-form" action="crop.php" enctype="multipart/form-data" method="post">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" id="avatar-modal-label">Trocar Foto do Perfil</h4>
            </div>
            <div class="modal-body">
              <div class="avatar-body">

                <!-- Upload image and data -->
                <div class="avatar-upload">
                  <input type="hidden" class="avatar-src" name="avatar_src">
                  <input type="hidden" class="avatar-data" name="avatar_data">
                  <label for="avatarInput">Fazer upload</label>
                  <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                </div>

                <!-- Crop and preview -->
                <div class="row">
                  <div class="col-md-9">
                    <div class="avatar-wrapper"><img src="20150907204519.original.jpeg" class="cropper-hidden"></div>
                  </div>
                  <div class="col-md-3">
                    <div class="avatar-preview preview-lg avatar avatar-lg img-circle avatar-bordered"></div>
                    <div class="avatar-preview preview-md"></div>
                    <div class="avatar-preview preview-sm"></div>
                  </div>
                </div>

                <div class="row avatar-btns">
                  <div class="col-md-9">
                    
                  <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-block avatar-save">salvar</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
          </form>
        </div>
      </div>
    </div><!-- /.modal -->

    <!-- Loading state -->
    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
  </div>

  <script src="/<?php echo PROJETO;?>/inc/assetsc/js/jquery.min.js"></script>
  <script src="/<?php echo PROJETO;?>/inc/assetsc/js/bootstrap.min.js"></script>
  <script src="/<?php echo PROJETO;?>/inc/distc/cropper.min.js"></script>
  <script src="/<?php echo PROJETO;?>/inc/js/maincrop.js"></script>
                                                   
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="row mb15">
                                        <div class="col-xs-12">
                                            <h6 class="heading-font">About Gerald Morris</h6>
                                            <p>Gary, a mere mortal man of 25. Likes skipping rope and playing with small fluffy cute toys. Enjoys the occasional UI/UX Design.</p>
                                        </div>

                                        <div class="col-xs-12 mt15">
                                            <h6 class="heading-font">Social Profiles</h6>
                                            <div class="mt10 mb10">
                                                <a class="btn btn-social btn-xs btn-facebook mr5"><i class="fa fa-facebook"></i>Facebook </a>
                                                <a class="btn btn-social btn-xs btn-twitter mr5"><i class="fa fa-twitter"></i>Twitter </a>
                                                <a class="btn btn-social btn-xs btn-github mr5"><i class="fa fa-github"></i>Github </a>
                                            </div>
                                        </div>

                                    </div>

                                    <a href="javascript:;" class="text-muted">
                                        <i class="fa fa-globe mr15"></i>www.garystone.co</a>
                                </div>

                                <!-- /profile information sidebar -->
                            </div>
                            
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
    <!-- /page level scripts -->

    <!-- template scripts -->
    <script src="/<?php echo PROJETO;?>/inc/js/offscreen.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/main.js"></script>
    <!-- /template scripts -->

    <!-- page script -->
    <script>
        $("[data-toggle=tooltip]").tooltip();
    </script>
    <!-- /page script -->

</body>
<!-- /body -->

</html>
