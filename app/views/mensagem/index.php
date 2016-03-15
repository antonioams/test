
<?php
include('app/views/toposnovo.php'); 
?>
<script type="text/javascript" language="javascript">
$(function($) {
    // Quando o formulário for enviado, essa função é chamada
    $("#formulario").submit(function() {
        // Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
        var cdusuario = $("#cdusuario").val();
        var cdgrupo = $("#cdgrupo").val();
        var mensagem = $("#mensagem").val();
        // Exibe mensagem de carregamento
        $("#status").html("<img src='loader.gif' alt='Enviando' />");
        // Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
        $.post('/<?php echo PROJETO;?>/mensagem/insere/', {cdgrupo: cdgrupo, cdusuario: cdusuario, datahora:'<?php echo date("d/m/Y h:i:s");?>',mensagem: mensagem }, function(resposta) {
                // Quando terminada a requisição
                // Exibe a div status
            // $("#status").slideDown();
                // Se a resposta é um erro
                if (resposta != false) {
                    // Exibe o erro na div
                    $("#mensagem").html(resposta);
                } 
                // Se resposta for false, ou seja, não ocorreu nenhum erro
                else {
                    // Exibe mensagem de sucesso
                    $("#recebe").html("Mensagem enviada com sucesso!");
                    // Coloca a mensagem no div de mensagens
                    $("#mensagens").prepend("<strong>"+ nome +"</strong> disse: <em>" + mensagem + "</em><br />");
                    // Limpando todos os campos
                    $("#nome").val("");
                    $("#email").val("");
                    $("#mensagem").val("");
                }
        });
    });
});
</script>
 <!-- main content -->
            <section class="main-content">

                <!-- content wrapper -->
                <div class="content-wrap">

                    <!-- inner content wrapper -->
                    <div class="wrapper">
                        <div class="chat-box">

                            <div class="chatbox-user">
                                <a href="javascript:;" class="chat-avatar pull-left">
                                    <img src="img/faceless.jpg" class="img-circle" title="user name" alt="">
                                </a>
                                <div class="message">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <p>How are the wife and kids, Taylor?</p>
                                        </div>
                                    </div>
                                    <small class="chat-time">
                                        <i class="ti-time mr5"></i>
                                        <b>10 minutes ago</b>
                                        <i class="ti-check text-success"></i>
                                    </small>
                                </div>
                            </div>
                            <div class="chatbox-user right">
                                <a href="javascript:;" class="chat-avatar pull-right">
                                    <img src="img/faceless.jpg" class="img-circle" title="user name" alt="">
                                </a>
                                <div class="message">
                                    <div class="panel">
                                        <div class="panel-body" id="recebe">
                                            <p>Pretty good, Gary. What are you working on?</p>
                                        </div>
                                    </div>
                                    <small class="chat-time">
                                        <i class="ti-time mr5"></i>
                                        <b>10 minutes ago</b>
                                        <i class="ti-check text-success"></i>
                                    </small>
                                </div>
                            </div>
                            

                        </div>
                    </div>
                    <!-- /inner content wrapper -->

                </div>
                <!-- /content wrapper -->

                <footer class="bt">
                    <form id="formulario" action="" method="post">
                    <input type="hidden" name="cdusuario" id="cdusuario" value="1">
                    <input type="hidden" name="cdgrupo" id="cdgrupo" value="1">
                    <div class="form-input clearfix mt10 mb10">
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" id="mensagem" name="mensagem" placeholder="Digite a mensagem...">
                            <span class="input-group-btn">
                                <input type="submit" class="btn btn-default btn-sm" type="button" value='>'>
                            </span>
                        </div>
                    </form>
                    </div>
                </footer>

                <a class="exit-offscreen"></a>
            </section>
            <!-- /main content -->

            <!-- chat panel -->
            <aside class="sidebar-300 offscreen-right bg-white">
                <div class="content-wrap">
                    <div class="wrapper">
                        <div class="slimscroll" data-height="auto" data-size="6px" data-distance="0">

                            <div class="pt15 pl15 pr15 pb0 clearfix">
                                <h3 class="mt0">
                                    <div class="pull-right">
                                        <a class="small mr5" href="javascript:;">
                                            <i class="ti-info-alt"></i>
                                        </a>
                                        <a class="small mr5" href="javascript:;">
                                            <i class="ti-time text-primary"></i>
                                        </a>
                                        <a class="small" href="javascript:;">
                                            <i class="ti-settings"></i>
                                        </a>
                                    </div>
                                    <span class="small">
                                        <i class="ti-arrow-circle-up text-success"></i>
                                        <small>YOU'RE ONLINE</small>
                                    </span>
                                </h3> 
                            </div>

                            <div class="p15 text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-outline btn-sm">Recent</button>
                                    <button type="button" class="btn btn-default btn-outline btn-sm">Favourite</button>
                                    <button type="button" class="btn btn-default btn-outline btn-sm">Blocked</button>
                                </div>
                            </div>

                            <div class="pt15 pl15 pr15 pb0">
                                <div class="h6 text-muted"><b>ONLINE</b>
                                </div>
                            </div>

                            <div class="chat-user">
                                <div href="javascript:;" class="user-avatar">
                                    <img src="img/faceless.jpg" class="img-circle" alt="">
                                    <div class="status bg-success"></div>
                                </div>
                                <div class="user-details">
                                    <p>Robert McCoy</p>
                                    <small class="user-department">Human Resources</small>
                                </div>
                            </div>

                            <div class="chat-user">
                                <a href="javascript:;" class="user-avatar">
                                    <img src="img/faceless.jpg" class="avatar avatar-sm img-circle" alt="">
                                    <div class="status bg-success"></div>
                                </a>
                                <div class="user-details">
                                    <p>Douglas Powell</p>
                                    <small class="user-department">Human Resources</small>
                                </div>
                            </div>

                            <div class="chat-user">
                                <a href="javascript:;" class="user-avatar">
                                    <img src="img/faceless.jpg" class="avatar avatar-sm img-circle" alt="">
                                    <div class="status bg-primary"></div>
                                </a>
                                <div class="user-details">
                                    <p>Harold Brown</p>
                                    <small class="user-department">Human Resources</small>
                                </div>
                            </div>

                            <div class="chat-user">
                                <a href="javascript:;" class="user-avatar">
                                    <img src="img/faceless.jpg" class="avatar avatar-sm img-circle" alt="">
                                    <div class="status bg-danger"></div>
                                </a>
                                <div class="user-details">
                                    <p>Brandon Cruz</p>
                                    <small class="user-department">Human Resources</small>
                                </div>
                            </div>

                            <div class="pt15 pl15 pr15 pb0">
                                <div class="h6 text-muted"><b>OFFLINE</b>
                                </div>
                            </div>

                            <div class="chat-user">
                                <a href="javascript:;" class="user-avatar">
                                    <img src="img/faceless.jpg" class="avatar avatar-sm img-circle" alt="">
                                    <div class="status bg-color"></div>
                                </a>
                                <div class="user-details">
                                    <p>Jason Holmes</p>
                                    <small class="user-department">Human Resources</small>
                                </div>
                            </div>

                            <div class="chat-user">
                                <a href="javascript:;" class="user-avatar">
                                    <img src="img/faceless.jpg" class="avatar avatar-sm img-circle" alt="">
                                    <div class="status bg-danger"></div>
                                </a>
                                <div class="user-details">
                                    <p>Gerald Simpson</p>
                                    <small class="user-department">Human Resources</small>
                                </div>
                            </div>

                            <div class="chat-user">
                                <a href="javascript:;" class="user-avatar">
                                    <img src="img/faceless.jpg" class="avatar avatar-sm img-circle" alt="">
                                    <div class="status bg-color"></div>
                                </a>
                                <div class="user-details">
                                    <p>Aaron Nguyen</p>
                                    <small class="user-department">Human Resources</small>
                                </div>
                            </div>

                            <div class="chat-user">
                                <a href="javascript:;" class="user-avatar">
                                    <img src="img/faceless.jpg" class="avatar avatar-sm img-circle" alt="">
                                    <div class="status bg-color"></div>
                                </a>
                                <div class="user-details">
                                    <p>Jason Henderson</p>
                                    <small class="user-department">Human Resources</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <!-- /chat panel -->

        </section>

    </div>
<?php include('app/views/rodape.php'); ?>