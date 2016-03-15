
<?php
include('app/views/topo.php');
?>
    <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/plugins/jstree/themes/default/style.min.css" />
<div class="<?php echo $_SESSION[PROJETO]['mensagem']['tipo'];?>">
                                <?php
                                echo $_SESSION[PROJETO]['mensagem']['texto'];
                                unset( $_SESSION[PROJETO]['mensagem'] );?>
                            </div>
<?php if (!empty($view_vc[1])) { ?> 
<div class="box-tab">
<ul class="nav nav-tabs">
<?php foreach ($view_vc as $vc) { ?>
<li<?php echo $vc['tipo']?>><a href="<?php echo $vc['link']?>" data-original-title="<?php echo $vc['nome']?>"><?php echo $vc['atalho']?></a></li>
<?php } ?>
</ul>

<div class="tab-content">
<div class="tab-pane fade active in">

<?php } ?>

<script>
function marcardesmarcar(){
       if ($("#todos").attr("checked")){
      $('.marcar').each(
         function(){
            $(this).attr("checked", true);
         }
      );
   }else{
      $('.marcar').each(
         function(){
            $(this).attr("checked", false);
         }
      );
   }
}

</script>
<?php 
$selecionado = '"selected" : true';
$nselecionado = '"selected" : false';
?>
<div class="panel">

                                <div class="panel-body">
                                                                                                                        <div class="col-md-12 mt25 mb25">
                                                <input type="text" value="" class="form-control input-xs" id="jstree2_q" placeholder="Pesquisar permissão">
                                            </div>
                                <div class="demo jstree jstree-2 jstree-default jstree-checkbox-selection" id="jstree2" role="tree" aria-multiselectable="true" tabindex="0" aria-activedescendant="j2_7" aria-busy="false" aria-selected="false">
                                        
                                             <ul id="batata">
                                                <?php if (!empty($view_perfil_modulos)) { foreach ($view_perfil_modulos as $perfil_modulos) {?>
                                                <li id="v<?php echo $perfil_modulos['cdmodulo'];?>"><?php echo '1-'.$perfil_modulos['nome']; ?>

                                                    <!--Vinculados-->
                                                    <?php if (is_array($perfil_modulos['modulosvinculados'])) { foreach ($perfil_modulos['modulosvinculados'] as $perfil_modulosv1) { ?>
                                                    <ul>
                                                        <li data-jstree='{ "icon" : "fa fa-key" }'><a href="#"><?php echo '2v-'.$perfil_modulosv1['nome']; ?></a>
                                                        <!--<li data-jstree='{ "icon" : "http://jstree.com/tree-icon.png" }'>custom icon URL</li> -->
                                                        <li id="v<?php echo $perfil_modulosv1['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-eye", <?php if ($perfil_modulosv1["visualizar"]==1) { echo $selecionado;} ?> }'>Visualizar</li>
                                                        <li id="a<?php echo $perfil_modulosv1['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-edit", <?php if ($perfil_modulosv1["editar"]==1) { echo $selecionado;} ?> }'>Editar</li>
                                                        <li id="i<?php echo $perfil_modulosv1['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-plus", <?php if ($perfil_modulosv1["inserir"]==1) { echo $selecionado;} ?> }'>Inserir</li>
                                                        <li id="e<?php echo $perfil_modulosv1['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-times", <?php if ($perfil_modulosv1["excluir"]==1) { echo $selecionado;} ?> }'>Excluir</li>
                                                        <li id="m<?php echo $perfil_modulosv1['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-list-ol", <?php if ($perfil_modulosv1["inserir_mtp"]==1) { echo $selecionado;} ?> }'>Inserir Multiplos</li>
                                                        <li id="p<?php echo $perfil_modulosv1['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-search", <?php if ($perfil_modulosv1["pesquisar"]==1) { echo $selecionado;} ?> }'>Pesquisar</li>
                                                        
                                                        <ul>
                                                        <?php if (is_array($perfil_modulosv1['modulosvinculados'])) { foreach ($perfil_modulosv1['modulosvinculados'] as $perfil_modulosv2) { ?>
                                                            
                                                                <li><?php echo '3v-'.$perfil_modulosv2['nome']; ?>
                                                        <li id="v<?php echo $perfil_modulosv2['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-eye", <?php if ($perfil_modulosv2["visualizar"]==1) { echo $selecionado;} ?> }'>Visualizar</li>
                                                        <li id="a<?php echo $perfil_modulosv2['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-edit", <?php if ($perfil_modulosv2["editar"]==1) { echo $selecionado;} ?> }'>Editar</li>
                                                        <li id="i<?php echo $perfil_modulosv2['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-plus", <?php if ($perfil_modulosv2["inserir"]==1) { echo $selecionado;} ?> }'>Inserir</li>
                                                        <li id="e<?php echo $perfil_modulosv2['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-times", <?php if ($perfil_modulosv2["excluir"]==1) { echo $selecionado;} ?> }'>Excluir</li>
                                                        <li id="m<?php echo $perfil_modulosv2['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-list-ol", <?php if ($perfil_modulosv2["inserir_mtp"]==1) { echo $selecionado;} ?> }'>Inserir Multiplos</li>
                                                        <li id="p<?php echo $perfil_modulosv2['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-search", <?php if ($perfil_modulosv2["pesquisar"]==1) { echo $selecionado;} ?> }'>Pesquisar</li>
                                                                </li>
                                                            
                                                            <?php }}?>
                                                        </ul>
                                                        </li>
                                                    </ul>
                                                    <?php }}?>
                                                    <!--Filhos-->
                                                    <?php if (is_array($perfil_modulos['modulosfilhos'])) { foreach ($perfil_modulos['modulosfilhos'] as $perfil_modulosf1) { ?>
                                                    <ul>
                                                        <li ><a href="#"><?php echo '2f-'.$perfil_modulosf1['nome']; ?></a>
                                                            <ul>
                                                                <li id="v<?php echo $perfil_modulosf1['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-eye", <?php if ($perfil_modulosf1["visualizar"]==1) { echo $selecionado;} ?> }'>Visualizar</li>
                                                                <li id="a<?php echo $perfil_modulosf1['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-edit", <?php if ($perfil_modulosf1["editar"]==1) { echo $selecionado;} ?> }'>Editar</li>
                                                                <li id="i<?php echo $perfil_modulosf1['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-plus", <?php if ($perfil_modulosf1["inserir"]==1) { echo $selecionado;} ?> }'>Inserir</li>
                                                                <li id="e<?php echo $perfil_modulosf1['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-times", <?php if ($perfil_modulosf1["excluir"]==1) { echo $selecionado;} ?> }'>Excluir</li>
                                                                <li id="m<?php echo $perfil_modulosf1['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-list-ol", <?php if ($perfil_modulosf1["inserir_mtp"]==1) { echo $selecionado;} ?> }'>Inserir Multiplos</li>
                                                                <li id="p<?php echo $perfil_modulosf1['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-search", <?php if ($perfil_modulosf1["pesquisar"]==1) { echo $selecionado;} ?> }'>Pesquisar</li>
                                                        <!--<li data-jstree='{ "icon" : "http://jstree.com/tree-icon.png" }'>custom icon URL</li> -->
                                                        <?php if (is_array($perfil_modulosf1['modulosvinculados'])) { foreach ($perfil_modulosf1['modulosvinculados'] as $perfil_modulosv2) { ?>
                                                            
                                                                <li><?php echo '3v-'.$perfil_modulosv2['nome']; ?>
                                                                    <ul>
                                                                <li id="v<?php echo $perfil_modulosv2['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-eye", <?php if ($perfil_modulosv2["visualizar"]==1) { echo $selecionado;} ?> }'>Visualizar</li>
                                                                <li id="a<?php echo $perfil_modulosv2['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-edit", <?php if ($perfil_modulosv2["editar"]==1) { echo $selecionado;} ?> }'>Editar</li>
                                                                <li id="i<?php echo $perfil_modulosv2['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-plus", <?php if ($perfil_modulosv2["inserir"]==1) { echo $selecionado;} ?> }'>Inserir</li>
                                                                <li id="e<?php echo $perfil_modulosv2['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-times", <?php if ($perfil_modulosv2["excluir"]==1) { echo $selecionado;} ?> }'>Excluir</li>
                                                                <li id="m<?php echo $perfil_modulosv2['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-list-ol", <?php if ($perfil_modulosv2["inserir_mtp"]==1) { echo $selecionado;} ?> }'>Inserir Multiplos</li>
                                                                <li id="p<?php echo $perfil_modulosv2['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-search", <?php if ($perfil_modulosv2["pesquisar"]==1) { echo $selecionado;} ?> }'>Pesquisar</li>
                                                                <?php if (is_array($perfil_modulosv2['modulosvinculados'])) { foreach ($perfil_modulosv2['modulosvinculados'] as $perfil_modulosv3) { ?>
                                                                    
                                                                        <li><?php echo '4v-'.$perfil_modulosv3['nome']; ?>
                                                                            <ul>
                                                                <li id="v<?php echo $perfil_modulosv3['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-eye", <?php if ($perfil_modulosv3["visualizar"]==1) { echo $selecionado;} ?> }'>Visualizar</li>
                                                                <li id="a<?php echo $perfil_modulosv3['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-edit", <?php if ($perfil_modulosv3["editar"]==1) { echo $selecionado;} ?> }'>Editar</li>
                                                                <li id="i<?php echo $perfil_modulosv3['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-plus", <?php if ($perfil_modulosv3["inserir"]==1) { echo $selecionado;} ?> }'>Inserir</li>
                                                                <li id="e<?php echo $perfil_modulosv3['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-times", <?php if ($perfil_modulosv3["excluir"]==1) { echo $selecionado;} ?> }'>Excluir</li>
                                                                <li id="m<?php echo $perfil_modulosv3['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-list-ol", <?php if ($perfil_modulosv3["inserir_mtp"]==1) { echo $selecionado;} ?> }'>Inserir Multiplos</li>
                                                                <li id="p<?php echo $perfil_modulosv3['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-search", <?php if ($perfil_modulosv3["pesquisar"]==1) { echo $selecionado;} ?> }'>Pesquisar</li>
                                                                
                                                                
                                                                  <?php if (is_array($perfil_modulosv3['modulosvinculados'])) { foreach ($perfil_modulosv3['modulosvinculados'] as $perfil_modulosv4) { ?>
                                                                    
                                                                        <li><?php echo '5v-'.$perfil_modulosv4['nome']; ?>
                                                                            <ul>
                                                                <li id="v<?php echo $perfil_modulosv4['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-eye", <?php if ($perfil_modulosv4["visualizar"]==1) { echo $selecionado;} ?> }'>Visualizar</li>
                                                                <li id="a<?php echo $perfil_modulosv4['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-edit", <?php if ($perfil_modulosv4["editar"]==1) { echo $selecionado;} ?> }'>Editar</li>
                                                                <li id="i<?php echo $perfil_modulosv4['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-plus", <?php if ($perfil_modulosv4["inserir"]==1) { echo $selecionado;} ?> }'>Inserir</li>
                                                                <li id="e<?php echo $perfil_modulosv4['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-times", <?php if ($perfil_modulosv4["excluir"]==1) { echo $selecionado;} ?> }'>Excluir</li>
                                                                <li id="m<?php echo $perfil_modulosv4['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-list-ol", <?php if ($perfil_modulosv4["inserir_mtp"]==1) { echo $selecionado;} ?> }'>Inserir Multiplos</li>
                                                                <li id="p<?php echo $perfil_modulosv4['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-search", <?php if ($perfil_modulosv4["pesquisar"]==1) { echo $selecionado;} ?> }'>Pesquisar</li>
                                                                
                                                                            </ul>

                                                                        </li>
                                                                    
                                                                <?php }}?>
                                                                
                                                                
                                                                
                                                                            </ul>
                                                                        </li>

                                                                    
                                                                <?php }}?>
                                                                    </ul>
                                                                </li>
                                                             
                                                            <?php }}?>
                                                        </ul>

                                                            <?php if (is_array($perfil_modulosf1['modulosfilhos'])) { foreach ($perfil_modulosf1['modulosfilhos'] as $perfil_modulosf2) { ?>
                                                            <ul>
                                                                <li><?php echo '3f-'.$perfil_modulosf2['nome']; ?>
                                                                    <ul>
                                                                <li id="v<?php echo $perfil_modulosf2['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-eye", <?php if ($perfil_modulosf2["visualizar"]==1) { echo $selecionado;} ?> }'>Visualizar</li>
                                                                <li id="a<?php echo $perfil_modulosf2['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-edit", <?php if ($perfil_modulosf2["editar"]==1) { echo $selecionado;} ?> }'>Editar</li>
                                                                <li id="i<?php echo $perfil_modulosf2['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-plus", <?php if ($perfil_modulosf2["inserir"]==1) { echo $selecionado;} ?> }'>Inserir</li>
                                                                <li id="e<?php echo $perfil_modulosf2['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-times", <?php if ($perfil_modulosf2["excluir"]==1) { echo $selecionado;} ?> }'>Excluir</li>
                                                                <li id="m<?php echo $perfil_modulosf2['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-list-ol", <?php if ($perfil_modulosf2["inserir_mtp"]==1) { echo $selecionado;} ?> }'>Inserir Multiplos</li>
                                                                <li id="p<?php echo $perfil_modulosf2['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-search", <?php if ($perfil_modulosf2["pesquisar"]==1) { echo $selecionado;} ?> }'>Pesquisar</li>
                                                                
                                                               <?php if (is_array($perfil_modulosf2['modulosvinculados'])) { foreach ($perfil_modulosf2['modulosvinculados'] as $perfil_modulosf3) { ?>
                                                                    
                                                                        <li><?php echo '4v-'.$perfil_modulosf3['nome']; ?>
                                                                            <ul>
                                                                <li id="v<?php echo $perfil_modulosf3['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-eye", <?php if ($perfil_modulosf3["visualizar"]==1) { echo $selecionado;} ?> }'>Visualizar</li>
                                                                <li id="a<?php echo $perfil_modulosf3['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-edit", <?php if ($perfil_modulosf3["editar"]==1) { echo $selecionado;} ?> }'>Editar</li>
                                                                <li id="i<?php echo $perfil_modulosf3['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-plus", <?php if ($perfil_modulosf3["inserir"]==1) { echo $selecionado;} ?> }'>Inserir</li>
                                                                <li id="e<?php echo $perfil_modulosf3['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-times", <?php if ($perfil_modulosf3["excluir"]==1) { echo $selecionado;} ?> }'>Excluir</li>
                                                                <li id="m<?php echo $perfil_modulosf3['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-list-ol", <?php if ($perfil_modulosf3["inserir_mtp"]==1) { echo $selecionado;} ?> }'>Inserir Multiplos</li>
                                                                <li id="p<?php echo $perfil_modulosf3['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-search", <?php if ($perfil_modulosf3["pesquisar"]==1) { echo $selecionado;} ?> }'>Pesquisar</li>
                                                                
                                                                
                                                                
                                                                <?php if (is_array($perfil_modulosf3['modulosvinculados'])) { foreach ($perfil_modulosf3['modulosvinculados'] as $perfil_modulosf4) { ?>
                                                                    
                                                                        <li><?php echo '5v-'.$perfil_modulosf4['nome']; ?>
                                                                            <ul>
                                                                <li id="v<?php echo $perfil_modulosf4['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-eye", <?php if ($perfil_modulosf4["visualizar"]==1) { echo $selecionado;} ?> }'>Visualizar</li>
                                                                <li id="a<?php echo $perfil_modulosf4['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-edit", <?php if ($perfil_modulosf4["editar"]==1) { echo $selecionado;} ?> }'>Editar</li>
                                                                <li id="i<?php echo $perfil_modulosf4['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-plus", <?php if ($perfil_modulosf4["inserir"]==1) { echo $selecionado;} ?> }'>Inserir</li>
                                                                <li id="e<?php echo $perfil_modulosf4['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-times", <?php if ($perfil_modulosf4["excluir"]==1) { echo $selecionado;} ?> }'>Excluir</li>
                                                                <li id="m<?php echo $perfil_modulosf4['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-list-ol", <?php if ($perfil_modulosf4["inserir_mtp"]==1) { echo $selecionado;} ?> }'>Inserir Multiplos</li>
                                                                <li id="p<?php echo $perfil_modulosf4['cdmodulo'];?>" data-jstree='{ "icon" : "fa fa-search", <?php if ($perfil_modulosf4["pesquisar"]==1) { echo $selecionado;} ?> }'>Pesquisar</li>
                                                                
                                                                            </ul>

                                                                        </li>
                                                                    
                                                                <?php }}?>
                                                                
                                                                
                                                                
                                                                
                                                                            </ul>

                                                                        </li>
                                                                    
                                                                <?php }}?>
                                                            </ul>
                                                            </li>
                                                            </ul>
                                                            <?php }}?>
                                                        </li>
                                                    </ul>
                                                    <?php }}?>

                                                </li>
                                                <?php }}?>
                                                
                                            </ul>
                                            

                                            <ul>
                                                                <li>Consultas
                                                                    <ul>
                                                                    <?php foreach ($view_perfil_consulta as $perfil_consulta) { ?>
                                                                <li id="c<?php echo $perfil_consulta['cdconsulta'];?>" data-jstree='{ "icon" : "fa fa-search", <?php if ($perfil_consulta['cdperfil']!='') { echo $selecionado;} else { echo $nselecionado;} ?> }'><?php echo $perfil_consulta['titulo'];?></li>
                                                                    <?php } ?>
                                                                     </ul>                                       
                                                                 </li>
                                            </ul>
                                            
                                            
                                            
                                            
                                     </div> <!--FIM JSTREE-->
                                     <form action="/<?php echo PROJETO;?>/perfil_modulos/insere/" role="form" method="post" name="target" id="target">
                                        <input type="hidden" name="perm" id="perm">
                                    </form>
                                    <br><br>
                                     <button id="btn" class="btn btn-primary">Salvar</button>
                            </div> <!--FIM PANEL BODY-->
                        </div><!--FIM PANEL-->
  
<?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }  ?> 

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
    <script src="/<?php echo PROJETO;?>/inc/plugins/jstree/jstree.min.js"></script>
    <!-- /page level scripts -->

    <!-- template scripts -->
    <script src="/<?php echo PROJETO;?>/inc/js/offscreen.js"></script>
    <script src="/<?php echo PROJETO;?>/inc/js/main.js"></script>
    <!-- /template scripts -->

    <!-- page script 
    <script src="/<?php echo PROJETO;?>/inc/js/jstree.js"></script>-->
    <script type="text/javascript">
        var treeViewDemo = function () {

    var to = false;

    function events() {
        $('#demo_q').keyup(function () {
            if (to) {
                clearTimeout(to);
            }
            to = setTimeout(function () {
                var v = $('#demo_q').val();
                $('#jstree_demo').jstree(true).search(v);
            }, 250);
        });
        $('#jstree2_q').keyup(function () {
            if (to) {
                clearTimeout(to);
            }
            to = setTimeout(function () {
                var v = $('#jstree2_q').val();
                $('#jstree2').jstree(true).search(v);
            }, 250);
        });
        $(document).on("click", "#node-create", function () {
            demo_create();
        });

        $(document).on("click", "#node-rename", function () {
            demo_rename();
        });

        $(document).on("click", "#node-delete", function () {
            demo_delete();
        });
    }

    function demo_create() {
        var ref = $('#jstree_demo').jstree(true),
            sel = ref.get_selected();
        if (!sel.length) {
            return false;
        }
        sel = sel[0];
        sel = ref.create_node(sel, {
            "type": "file"
        });
        if (sel) {
            ref.edit(sel);
        }
    }

    function demo_rename() {
        var ref = $('#jstree_demo').jstree(true),
            sel = ref.get_selected();
        if (!sel.length) {
            return false;
        }
        sel = sel[0];
        ref.edit(sel);
    }

    function demo_delete() {
        var ref = $('#jstree_demo').jstree(true),
            sel = ref.get_selected();
        if (!sel.length) {
            return false;
        }
        ref.delete_node(sel);
    }

    function plugins() {
        $('#jstree1').jstree();

        $('#jstree2').jstree({
            'plugins': ["wholerow", "checkbox", "search"],
        });

        $("#jstree_demo")
            .jstree({
                "core": {
                    "animation": 0,
                    "check_callback": true,
                    'data': [{
                            "text": "Same but with checkboxes",
                            "children": [
                                {
                                    "text": "initially selected",
                                    "state": {
                                        "selected": true
                                    }
                                },
                                {
                                    "text": "custom icon URL",
                                    "icon": "./img/tree-icon.png"
                                },
                                {
                                    "text": "initially open",
                                    "state": {
                                        "opened": true
                                    },
                                    "children": ["Another node"]
                                },
                                {
                                    "text": "custom icon class",
                                    "icon": "glyphicon glyphicon-leaf"
                                }
                        ]
                    },
                    "And wholerow selection"
                ]
                },
                "plugins": ["contextmenu", "dnd", "search", "state", "types", "wholerow"]
            });
    }

    return {
        init: function () {
            events();
            plugins();
        }
    };
}();

$(function () {
    "use strict";
    treeViewDemo.init();
});

$("#btn").click(function () {
    var a = [];
    a = ($('#jstree2').jstree(true).get_selected());
    console.log($('#jstree2').jstree(true).get_selected());
    $('#perm').val(a);
    $( "#target" ).submit();
     //    a.forEach(function(entry) {
       //     console.log($('#jstree2').jstree(true).get_node(entry));
       //     });
});
    </script>
    <!-- /page script -->
