<?php
include('app/views/topo.php');
?>
<script>
    view_tabelas_ref = eval('<?php echo $view_tabelas_ref ?>');
    tabelas_json = eval('<?php echo $view_tabelas_json ?>');
    view_colunas = eval('<?php echo json_encode($view_colunas) ?>');
    function filtraTabelas(){
        var array_filter=[];
        var array_filter_aux=[];
		var array_filter_aux_label=[];
        x=document.getElementById('tabela');
        for (var i=0; i < x.options.length; i++){
            for (var j=0; j < view_tabelas_ref.length; j++){
                if ((x.options[i].selected) && (view_tabelas_ref[j].tabela == x.options[i].value)){
                    array_filter.push(view_tabelas_ref[j]);
                }
            }
            if (x.options[i].selected){
                array_filter_aux[array_filter_aux.length]=x.options[i].value;
				array_filter_aux_label[array_filter_aux_label.length]=x.options[i].label;
			}

        }

        listbox_remove('tabela');
        $("#tabela").trigger("chosen:updated");

        //filtros marcados
        for (var i=0;i<array_filter_aux.length;i++){
            var opt = document.createElement('option');
            opt.value = array_filter_aux[i];
            opt.innerHTML = array_filter_aux_label[i];
            opt.selected = true;
            x.appendChild(opt);
        }

        for (var i=0; i<array_filter.length;i++){
            //addOption('tabela',array_filter[i].tabela_ref,array_filter[i].tabela_ref );
            var opt = document.createElement('option');
            opt.value = array_filter[i].tabela_ref;
            opt.innerHTML = array_filter[i].legenda_tabela_ref;
            x.appendChild(opt);
        }
        removeDuplicateOptions(x);
        $("#tabela").trigger("chosen:updated");

        if (x.length==0){
            for (var i=0; i<tabelas_json.length;i++){
                //addOption('tabela',array_filter[i].tabela_ref,array_filter[i].tabela_ref );
                var opt = document.createElement('option');
                opt.value = tabelas_json[i].tabela;
                opt.innerHTML = tabelas_json[i].legendaentidade;
                x.appendChild(opt);
            }
            removeDuplicateOptions(x);
            $("#tabela").trigger("chosen:updated");
        }

        montaFiltroVariavel();
        montaFiltroParametro();
    }

    function montaFiltroVariavel(){
		var array_filter_var=[];
        var array_filter_aux=[];
		var array_filter_aux_label=[];
        var x=document.getElementById('tabela');
        for (var i=0; i < x.options.length; i++){
            for (var j=0; j < view_colunas.length; j++){
                if ((x.options[i].selected) && (view_colunas[j].relname == x.options[i].value)){
                    array_filter_var.push(view_colunas[j]);
                }
            }
        }
		listbox_remove('variavel');
        $("#variavel").trigger("chosen:updated");

        var y=document.getElementById('variavel');
        var tabela = '';

        for (var i=0; i<array_filter_var.length;i++){
            if (array_filter_var[i].legendaentidade!=tabela){
                tabela=array_filter_var[i].legendaentidade;
                optGroup = document.createElement('optgroup');
                optGroup.label = 'Tabela '+tabela;
            }

            var opt = document.createElement('option');
            opt.value =array_filter_var[i].relname+'.'+array_filter_var[i].column;
            opt.innerHTML = array_filter_var[i].legendacampo;

            y.appendChild(optGroup);
            optGroup.appendChild(opt);
        }
		
        $("#variavel").trigger("chosen:updated");
    }

    function montaVariaveisCkEditor(){
		var y=document.getElementById('variavel');
	    //crias as variaveis no ckeditor
		if (document.getElementById('cke_66_frame')) {
			var iframe = document.getElementById('cke_66_frame');
		}else if (document.getElementById('cke_67_frame')){
			var iframe = document.getElementById('cke_67_frame');	
		}else if (document.getElementById('cke_68_frame')){
			var iframe = document.getElementById('cke_68_frame');	
		}
		
		if (iframe) {
			var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
			cke_panel = innerDoc.getElementById('cke_panel_block_id');
			cke_panel.innerHTML = '';
						
			var ul = document.createElement("ul");
			
			ul.setAttribute("class", "cke_panel_list");
			ul.setAttribute("role", "presentation");
			cke_panel.appendChild(ul);
			
			for (var i = 0; i < y.options.length; i++) {
				if (y.options[i].selected) {
				
					//cria as variaveis no ckeditor
					var li = document.createElement("li");
					li.setAttribute("id", "cke_7" + i);
					li.setAttribute("class", "cke_panel_listItem");
					li.setAttribute("role", "presentation");
					ul.appendChild(li);
					
					var a = document.createElement("a");
					a.setAttribute("id", "cke_7" + i + "_option");
					a.setAttribute("role", "option");
					a.setAttribute("onclick", "CKEDITOR.instances.template.insertText('&" + y.options[i].value.split('.')[1] + "&'); return false;");
					//a.setAttribute('onclick', 'CKEDITOR.tools.callFunction(', this._.getClick(), ',\'', value, '\');');
					a.setAttribute("href", "javascript:void('&" + y.options[i].value.split('.')[1] + "&')");
					a.setAttribute("title", y.options[i].label);
					a.setAttribute("hidefocus", true);
					a.setAttribute("_cke_focus", 1);
					a.appendChild(document.createTextNode(y.options[i].label));
					li.appendChild(a);
				}
			}
		}else{
			//CKEDITOR.plugins.load( 'strinsert', function( plugins ) {
			    //alert( plugins[ 'strinsert' ] ); // object
				//plugins['strinsert'].('someEvent', function(){
					//montaVariaveisCkEditor();	
				//});
				
			//});
		}	
    }

    function loadjscssfile(filename, filetype){
        if (filetype=="js"){ //if filename is a external JavaScript file
            var fileref=document.createElement('script')
            fileref.setAttribute("type","text/javascript")
            fileref.setAttribute("src", filename)
        }
        else if (filetype=="css"){ //if filename is an external CSS file
            var fileref=document.createElement("link")
            fileref.setAttribute("rel", "stylesheet")
            fileref.setAttribute("type", "text/css")
            fileref.setAttribute("href", filename)
        }
        if (typeof fileref!="undefined")
            document.getElementsByTagName("head")[0].appendChild(fileref)
    }

    function montaFiltroParametro(){
        var array_filter=[];
        var array_filter_aux=[];
		var array_filter_aux_label=[];
        var x=document.getElementById('tabela');
        for (var i=0; i < x.options.length; i++){
            for (var j=0; j < view_colunas.length; j++){
                if ((x.options[i].selected) && (view_colunas[j].relname == x.options[i].value)){
                    array_filter.push(view_colunas[j]);
                }
            }
        }
		listbox_remove('parametro');
        $("#parametro").trigger("chosen:updated");

        var y=document.getElementById('parametro');
        var tabela = '';
        for (var i=0; i<array_filter.length;i++){
            if (array_filter[i].legendaentidade!=tabela){
                tabela=array_filter[i].legendaentidade;
                optGroup = document.createElement('optgroup');
                optGroup.label = 'Tabela '+tabela;
            }

            var opt = document.createElement('option');
            opt.value =array_filter[i].relname+'.'+array_filter[i].column;
            opt.innerHTML = array_filter[i].legendacampo;

            y.appendChild(optGroup);
            optGroup.appendChild(opt);
        }
        $("#parametro").trigger("chosen:updated");
    }

    function listbox_remove(sourceID) {

        //get the listbox object from id.
        var src = document.getElementById(sourceID);

        //iterate through each option of the listbox
        for(var count= src.options.length-1; count >= 0; count--) {
            try {
                src.remove(count, null);
            } catch(error) {
                src.remove(count);
            }
            
        }
    }

    function addOption(selectbox,text,value ){
        var optn = document.createElement("OPTION");
        optn.text = text;
        optn.value = value;
        selectbox.options.add(optn);
    }

    function removeDuplicateOptions(s, comparitor) {
        if(s.tagName.toUpperCase() !== 'SELECT') { return false; }
        var c, i, o=s.options, sorter={};
        if(!comparitor || typeof comparitor !== 'function') {
            comparitor = function(o) { return o.value; };//by default we comare option values.
        }
        for(i=0; i<o.length; i++) {
            c = comparitor(o[i]);
            if(sorter[c]) {
                s.removeChild(o[i]);
                i--;
            }
            else { sorter[c] = true; }
        }
        return true;
    }
	
    function fnData(){
        return 'ok';
    }
</script>
<script type="text/javascript" src="../../inc/ckeditor/ckeditor.js"></script>

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
            <?php foreach ($view_vc as $vc) {
            ?>
                <li<?php echo $vc['tipo'] ?>><a href="<?php echo $vc['link'] ?>" data-original-title="<?php echo $vc['nome'] ?>"><?php echo $vc['atalho'] ?></a></li>
            <?php } ?>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade active in">

                <?php } ?>


                <section class="panel">
                    <header class="panel-heading">Cadastrar Novo Template de Documentos</header>
                    <div class="panel-body">

                        <form action="/<?php echo PROJETO; ?>/template_documento/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>

                            <div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'titulo') ? "style='display:none'" : "" ) ?>>
                                <label  class="control-label">Titulo</label>
                                <div class="controls">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <input id="titulo" name="titulo" type="text" value="<?php echo $_POST['titulo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Titulo"/>
                                        </div></div>
                                </div></div>

                            <div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'tabela') ? "style='display:none'" : "" ) ?>>
                                <label  class="control-label">Tabela</label>
                                <div class="controls">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <!--<input id="tabela" name="tabela" type="text" value="<?php echo $_POST['tabela']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Tabela"/>-->
                                            <select data-placeholder="Selecione a(s) Tabela(s)" style="width:90%;" multiple class="chosen" id="tabela" name="tabela[]" onchange="filtraTabelas();">
                                                <option value=''></option>
                                                <?php
                                                foreach ($view_tabelas as $tabelas) {
                                                ?>
                                                    <option value='<?php echo $tabelas['tabela'] ?>'><?php echo $tabelas['legendaentidade'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div></div>
                                </div></div>

                            <div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'variavel') ? "style='display:none'" : "" ) ?>>
                                <label  class="control-label">Variavel</label>
                                <div class="controls">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <!--<input id="variavel" name="variavel" type="text" value="<?php echo $_POST['variavel']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Variavel"/>-->
                                            <select data-placeholder="Selecione a(s) Variavel(is)" style="width:90%;" multiple class="chosen" id="variavel" name="variavel[]" onchange="montaVariaveisCkEditor();">
                                                <!--<option value=''></option>
                                                <?php
                                                foreach ($view_colunas as $variaveis) {
                                                ?>
                                                                    <option value='<?php echo $variaveis['relname'] . '.' . $variaveis['column'] ?>'><?php echo $variaveis['relname'] . '.' . $variaveis['column'] ?></option>
                                                <?php
                                                }
                                                ?>-->
                                            </select>
                                        </div>
                                    </div>
                                </div></div>

                            <div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'parametro') ? "style='display:none'" : "" ) ?>>
                                <label  class="control-label">Parametro</label>
                                <div class="controls">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <!--<input id="parametro" name="parametro" type="text" value="<?php echo $_POST['parametro']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Parametro"/>-->
                                            <select data-placeholder="Selecione o Parametro" style="width:90%;" multiple class="chosen" id="parametro" name="parametro[]">
                                                <!--<option value=''></option>
                                                <?php
                                                foreach ($view_colunas as $variaveis) {
                                                ?>
                                                                    <option value='<?php echo $variaveis['relname'] . '.' . $variaveis['column'] ?>'><?php echo $variaveis['relname'] . '.' . $variaveis['column'] ?></option>
                                                <?php
                                                }
                                                ?>-->
                                            </select>
                                        </div>
                                    </div>
                                </div></div>

                            <div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'template') ? "style='display:none'" : "" ) ?>>
                                <label  class="control-label">Template</label>
                                <div class="controls">
                                    <div class="row"><div class="col-xs-12">
                                            <textarea class="ckeditor" name="template" id="template" rows="4"><?php echo $_POST['template']; ?></textarea>
                                        </div></div>
                                </div></div>

                            <br>
                            <button type="submit" name="submit" class="btn btn-primary">Salvar</button>
                            <a href="/<?php echo PROJETO; ?>/template_documento/" class="btn btn-default">Cancelar</a>
                            <button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
                                Salvar e Continuar</button>

                        </form>
                    </div>
                </section>
            </div>
            <?php if (!empty($view_vc[1])) {
            ?>
                                                </div>
                                            </div>
                                        </div>
<?php } ?>
<?php
//echo $view_tabelas_ref;
//echo "<br><br>";
//echo $view_tabelas_ref1;
//print_r($view_tabelas);
include('app/views/rodape.php');
?>
