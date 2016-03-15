
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
<header class="panel-heading">Cadastrar Novos Chat</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/chat/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow('dataTable')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow('dataTable')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'cdchat') ? "style='display:none'" : "" )?>>Chat</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'cdusuario') ? "style='display:none'" : "" )?>>Código</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'mensagem') ? "style='display:none'" : "" )?>>Mensagem</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'cdgrupo') ? "style='display:none'" : "" )?>>Grupo</div></th><th><div <?php echo ( ($view_vc[0]['chave'] == 'datahora') ? "style='display:none'" : "" )?>>Data</div></th>
  </tr>
  </thead>
   <tbody>
   <tr>
   <td>
       <input type="checkbox" checked="checked" />
   </td>
    <td>
<div <?php echo ( ($view_vc[0]['chave'] == 'cdchat') ? "style='display:none'" : "" )?>>
<select id="cdchat" name="cdchat[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_chat[1])) { $ch=' selected="selected" '; }

 foreach ($view_chat as $chat) {
  echo '<option value="'.$chat['cdchat'].'"'.$ch.'>'.$chat[''].'</option>';
  } ?>
 </select>
 </div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'cdusuario') ? "style='display:none'" : "" )?>>
<input id="cdusuario" name="cdusuario[]" type="text" value="<?php echo $_POST['cdusuario']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Código" data-parsley-type="digits"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'mensagem') ? "style='display:none'" : "" )?>>
<textarea class="form-control" name="mensagem[]" rows="1"><?php echo $_POST['mensagem']; ?></textarea>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'cdgrupo') ? "style='display:none'" : "" )?>>
<input id="cdgrupo" name="cdgrupo[]" type="text" value="<?php echo $_POST['cdgrupo']; ?>" class="form-control"  data-parsley-trigger="change" placeholder="Grupo" data-parsley-type="digits"/>
</div>
</td><td>
<div <?php echo ( ($view_vc[0]['chave'] == 'datahora') ? "style='display:none'" : "" )?>>
<input id="date" name="datahora[]" type="text" value="<?php echo $_POST['datahora']; ?>" class="form-control" placeholder="99/99/9999" data-parsley-trigger="change"/>
</div>
</td></tr>
</tbody></table> 
</div>


<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/chat/" class="btn btn-default">Cancelar</a>


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
