
<?php
include('app/views/topo.php');
?>
<script type="text/javascript" src="../../inc/ckeditor/ckeditor.js"></script>

<div class="<?php echo $_SESSION['mensagem']['tipo'];?>">
                                <?php
                                echo $_SESSION['mensagem']['texto'];
                                unset( $_SESSION['mensagem'] );?>
                            </div>
<div class="col-lg-12">

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


<section class="panel">
<header class="panel-heading">Cadastrar Novo Template de Documentos</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/template_documento/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'template') ? "style='display:none'" : "" )?>>
<label  class="control-label">Template</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="ckeditor" name="template" id="template" rows="4"><?php echo $_POST['template']; ?></textarea>
</div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'titulo') ? "style='display:none'" : "" )?>>
<label  class="control-label">Titulo</label>
<div class="controls">
<div class="row">
    <div class="col-xs-12">
        <input id="titulo" name="titulo" type="text" value="<?php echo $_POST['titulo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Titulo"/>
    </div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'tabela') ? "style='display:none'" : "" )?>>
<label  class="control-label">Tabela</label>
<div class="controls">
<div class="row">
    <div class="col-xs-12">
        <!--<input id="tabela" name="tabela" type="text" value="<?php echo $_POST['tabela']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Tabela"/>-->
        <select data-placeholder="Selecione a(s) Tabela(s)" style="width:90%;" multiple class="chosen" id="tabela" name="tabela[]">
            <option value=''></option>
            <?php
            foreach ($view_tabelas as $tabelas) {
                ?>
                <option value='<?php echo $tabelas['tabela']?>'><?php echo $tabelas['tabela']?></option>
                <?php 
            } 
            ?>
        </select>
    </div></div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'variavel') ? "style='display:none'" : "" )?>>
<label  class="control-label">Variavel</label>
<div class="controls">
<div class="row">
    <div class="col-xs-12">
        <!--<input id="variavel" name="variavel" type="text" value="<?php echo $_POST['variavel']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Variavel"/>-->
        <select data-placeholder="Selecione a(s) Variavel(is)" style="width:90%;" multiple class="chosen" id="variavel" name="variavel[]">
            <option value=''></option>
            <?php
            foreach ($view_colunas as $variaveis) {
                ?>
                <option value='<?php echo $variaveis['relname'].'.'.$variaveis['column']?>'><?php echo $variaveis['relname'].'.'.$variaveis['column']?></option>
                <?php 
            } 
            ?>
        </select>
    </div>
</div>
</div></div>

<div class="form-group" <?php echo ( ($view_vc[0]['chave'] == 'parametro') ? "style='display:none'" : "" )?>>
<label  class="control-label">Parametro</label>
<div class="controls">
<div class="row">
    <div class="col-xs-12">
        <!--<input id="parametro" name="parametro" type="text" value="<?php echo $_POST['parametro']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Parametro"/>-->
        <select data-placeholder="Selecione o(s) Parametro(s)" style="width:90%;" multiple class="chosen" id="parametro" name="parametro[]">
            <option value=''></option>
            <?php
            foreach ($view_colunas as $variaveis) {
                ?>
                <option value='<?php echo $variaveis['relname'].'.'.$variaveis['column']?>'><?php echo $variaveis['relname'].'.'.$variaveis['column']?></option>
                <?php
            }
            ?>
        </select>
    </div>
</div>
</div></div>

<br>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/template_documento/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>

 </form>
  </div>
 </section>
 </div>
 <?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }  ?> 
<?php
//print_r($view_tabelas);
//print_r($view_colunas);
include('app/views/rodape.php');
?>
