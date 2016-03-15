
<?php
include('app/views/topo.php');
?>
<div class="<?php echo $_SESSION[PROJETO]['mensagem']['tipo'];?>">
                                <?php
                                echo $_SESSION[PROJETO]['mensagem']['texto'];
                                unset( $_SESSION[PROJETO]['mensagem'] );?>
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
<header class="panel-heading">Cadastrar Novos Objetivos</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/objetivo_informacao/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'logica') ? "style='display:none'" : "" )?>>Lógica</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'cdalvo') ? "style='display:none'" : "" )?>>Alvo</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'tipo') ? "style='display:none'" : "" )?>>Tipo</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'indicador') ? "style='display:none'" : "" )?>>Indicador</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'formula') ? "style='display:none'" : "" )?>>Fórmula</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'fonte') ? "style='display:none'" : "" )?>>Fonte</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'descricao_indicador') ? "style='display:none'" : "" )?>>Descrição do Indicador</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'cdprograma') ? "style='display:none'" : "" )?>>Programa</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'meta') ? "style='display:none'" : "" )?>>Meta</div></th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td>
       <div class="controls icheck">
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="ativo" checked value="1">
       </div>
      </div>
   </td>
    <td>
<div <?php echo ( ($view_vc[0]['chave'] == 'logica') ? "style='display:none'" : "" )?>>
<input id="logica" name="logica[]" type="text" value="<?php echo $_POST['logica']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Lógica"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'cdalvo') ? "style='display:none'" : "" )?>>
<select id="cdalvo" name="cdalvo[]" data-parsley-trigger="change"  multiple>
  <option value=""></option>
 <?php
 $vmarcado = $_POST['cdalvo']; 

 foreach ($view_alvo as $alvo) {
   $ch=""; 
  if ($vmarcado==$alvo['cdalvo']) { $ch=' selected="selected" '; } 
  echo '<option value="'.$alvo['cdalvo'].'"'.$ch.'>'.$alvo['descricao'].'</option>';
  } ?>
 </select>
 </div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'tipo') ? "style='display:none'" : "" )?>>
<input id="tipo" name="tipo[]" type="text" value="<?php echo $_POST['tipo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Tipo"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'indicador') ? "style='display:none'" : "" )?>>
<input id="indicador" name="indicador[]" type="text" value="<?php echo $_POST['indicador']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Indicador"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'formula') ? "style='display:none'" : "" )?>>
<input id="formula" name="formula[]" type="text" value="<?php echo $_POST['formula']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Fórmula"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'fonte') ? "style='display:none'" : "" )?>>
<textarea class="form-control" name="fonte[]" rows="1"><?php echo $_POST['fonte']; ?></textarea>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'descricao_indicador') ? "style='display:none'" : "" )?>>
<textarea class="form-control" name="descricao_indicador[]" rows="1"><?php echo $_POST['descricao_indicador']; ?></textarea>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'cdprograma') ? "style='display:none'" : "" )?>>
<select id="cdprograma" name="cdprograma[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_programas[1])) { $ch=' selected="selected" '; }

 foreach ($view_programas as $programas) {
  echo '<option value="'.$programas['cdprograma'].'"'.$ch.'>'.$programas['nome'].'</option>';
  } ?>
 </select>
 </div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'meta') ? "style='display:none'" : "" )?>>
<input id="meta" name="meta[]" type="text" value="<?php echo $_POST['meta']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Meta" data-parsley-type="digits"/>
</div>
</td></tr>
</tbody></table> 
</div>


<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/objetivo_informacao/" class="btn btn-default">Cancelar</a>


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
include('app/views/rodape.php');
?>
