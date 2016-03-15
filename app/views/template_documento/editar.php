<?php
include('app/views/topo.php');
?>
<script type="text/javascript" src="http://200.98.201.124/sig2/inc/ckeditor/ckeditor.js"></script>
<div class="<?php echo $_SESSION['mensagem']['tipo']; ?>">
    <?php
    echo $_SESSION['mensagem']['texto'];
    unset($_SESSION['mensagem']); ?>
</div>
<div class="col-lg-12">

    <?php if (!empty($view_vc[1])) {
 ?>
        <div class="box-tab">
            <ul class="nav nav-tabs">
<?php foreach ($view_vc as $vc) { ?>
            <li<?php echo $vc['tipo'] ?>><a href="<?php echo $vc['link'] ?>" data-original-title="<?php echo $vc['nome'] ?>"><?php echo $vc['atalho'] ?></a></li>
<?php } ?>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade active in">

<?php } ?>

                <section class="panel">
                    <header class="panel-heading">Editar Template de Documentos</header>
                    <div class="panel-body">

                        <form action="/<?php echo PROJETO; ?>/template_documento/atualiza/id/<?php echo $view_template_documento[0]['cdtemplate']; ?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>
                            <div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'template') ? "style='display:none'" : "" ) ?>>
                                <label  class="control-label">Template</label>
                                <div class="controls">
                                    <div class="row"><div class="col-xs-12">
                                            <textarea class="ckeditor" name="template" id="template" rows="4"><?php echo ( empty($_POST) ) ? ( $view_template_documento[0]['template'] ) : ( $_POST['template'] ) ?></textarea>

                                        </div></div>
                                </div></div>

                            <div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'tabela') ? "style='display:none'" : "" ) ?>>
                                <label  class="control-label">Tabela</label>
                                <div class="controls">
                                    <div class="row"><div class="col-xs-12"><input id="tabela" name="tabela" type="text" value="<?php echo ( empty($_POST) ) ? ( $view_template_documento[0]['tabela'] ) : ( $_POST['tabela'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Tabela"/></div></div>
                                </div></div>

                            <div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'variavel') ? "style='display:none'" : "" ) ?>>
                                <label  class="control-label">Variavel</label>
                                <div class="controls">
                                    <div class="row"><div class="col-xs-12"><input id="variavel" name="variavel" type="text" value="<?php echo ( empty($_POST) ) ? ( $view_template_documento[0]['variavel'] ) : ( $_POST['variavel'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Variavel"/></div></div>
                                </div></div>

                            <div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'parametro') ? "style='display:none'" : "" ) ?>>
                                <label  class="control-label">Parametro</label>
                                <div class="controls">
                                    <div class="row"><div class="col-xs-12"><input id="parametro" name="parametro" type="text" value="<?php echo ( empty($_POST) ) ? ( $view_template_documento[0]['parametro'] ) : ( $_POST['parametro'] ) ?>" class="form-control"  data-parsley-trigger="change" placeholder="Parametro"/></div></div>
                                </div></div>

                            <br>

                            <button type="submit" name="submit" class="btn btn-primary">Salvar</button>
                            <a href="/<?php echo PROJETO; ?>/template_documento/" class="btn btn-default">Cancelar</a>
                            <button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
                                Salvar e Continuar</button>
                            <a href="/<?php echo PROJETO; ?>/template_documento/exclui/id/<?php echo $view_template_documento[0]['cdtemplate']; ?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
                                Excluir</a>
                        </form>
                    </div>
                </section>
            </div>
<?php if (!empty($view_vc[1])) { ?>
        </div>
    </div>
</div>
<?php } ?>
<?php
    include('app/views/rodape.php');
?>
