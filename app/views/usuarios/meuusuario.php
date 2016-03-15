
<?php
include('app/views/topousu.php');
?>
   <!-- main content -->
            <section class="main-content">

                <!-- content wrapper -->
                <div class="content-wrap">

                    <!-- inner content wrapper -->
                    <div class="wrapper">
                        <div class="row">

            <!-- main content -->

                            <div class="col-md-12">
                                <!-- profile information sidebar -->

                                <div class="panel overflow-hidden no-b profile p15">



                                    <div class="row mb25">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8">
                                                    <h4 class="mb0"><b><?php echo $view_usuarios[0]['nome']?></b></h4>
                                                    <small><?php echo $view_usuarios[0]['email']?></small>

                                                    <h6 class="mt15 mb15"></h6>
                                                     <ul class="user-meta">
                                                        <li>
                                                          <div id="altebotao">
                                                            <i class="ti-email mr5"></i>
                                                            <span id="emai"><a href="javascript:;">Alterar E-mail</a></span>
                                                          </div>
                                                            <div id="altemail" style="display:none">
                                                              <form action="/<?php echo PROJETO;?>/usuarios/atualizameu/id/<?php echo $view_usuarios[0]['cdusuario'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
                                                                <div class="col-md-8">
                                                              <input type="email" class="form-control" name="email" id="email" value="<?php echo $view_usuarios[0]['email']?>" placeholder="fulano@email.com">
                                                                </div>
                                                                <div class="col-md-4">
                                                                  <button type="submit" name="submit" class="btn btn-primary">Salvar</button>
                                                                </div>
                                                              </form>
                                                            </div>
                                                        </li>
                                                        <li>
                                                          <div id="altersenha">
                                                            <i class="ti-key mr5"></i>
                                                            <span id="sss"><a href="javascript:;">trocar senha</a></span>
                                                          </div>
                                                            <div id="altesenha" style="padding-top: 30px; display:none">
                                                              <form action="/<?php echo PROJETO;?>/usuarios/atualizameu/id/<?php echo $view_usuarios[0]['cdusuario'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
                                                                <div class="col-md-8">
                                                              <input type="password" class="form-control" name="senha" id="senha" value="" placeholder="***">
                                                                </div>
                                                                <div class="col-md-4">
                                                                  <button type="submit" name="submit" class="btn btn-primary">Salvar</button>
                                                                </div>
                                                              </form>
                                                            </div>
                                                        </li>
                                                    </ul>

                                                </div>
                                                <div class="col-xs-12 col-sm-4 text-center">
                                                    <figure>
  <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/distc/cropper.min.css">
  <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/css/maincrop.css">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <div class="" id="crop-avatar" align='center'>

    <!-- Current avatar -->
    <div class="avatar-view" title="Trocar foto">

      <?php 
      if($view_usuarios[0]['foto']!=''){ ?>
      <img src="<?php echo $view_usuarios[0]['foto']?>" alt="Avatar" class="avatar avatar-lg img-circle avatar-bordered">
      <?php
      }else{ ?>
      <img src="/<?php echo PROJETO;?>/inc/img/faceless.jpg" alt="Avatar" class="avatar avatar-lg img-circle avatar-bordered">
      <?php } ?>
    </div>

    <!-- Cropping modal -->
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form class="avatar-form" action="/<?php echo PROJETO;?>/usuarios/crop" enctype="multipart/form-data" method="post">
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
                    <div class="avatar-wrapper"></div>
                  </div>
                  <div class="col-md-3">
                    <h4>Foto atual:</h4>
                    <div class="avatar-preview preview-lg"></div>
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
<script type="text/javascript">
$(document).ready(function(){       
 $('#emai').click(function(e) {
                  $('#altemail').css("display","block"); 
                  $('#altebotao').css("display","none"); 
               }) });
</script>    
<script type="text/javascript">
$(document).ready(function(){ 
 $('#sss').click(function(e) {
                  $('#altersenha').css("display","none"); 
                  $('#altesenha').css("display","block"); 
               }) });
</script>  
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