
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
<header class="panel-heading">Cadastrar Novos Valores Alvo Estratégico</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/alvo_informacao_ano/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>

 <div id="tabela1" class="form-group"> <br>
<table id="dataTable" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th><div <?php echo ( ($view_vc[0]['chave'] == 'cdalvo') ? "style='display:none'" : "" )?>>Alvo</div></th>
  <th><div <?php echo ( ($view_vc[0]['chave'] == 'cdalvo_informacao') ? "style='display:none'" : "" )?>>Alvo</div></th>
   <?php
  foreach ($view_anos as $ano) {
  echo '<th><div>'.$ano['ano'].'</div></th>';
  } ?>

  </tr>
  </thead>
   <tbody>
 <?php
   foreach ($view_alvo_informacao as $alvo_informacao) {
   ?>   
   <tr>

    <td>
<div <?php echo ( ($view_vc[0]['chave'] == 'cdalvo') ? "style='display:none'" : "" )?>>
<select id="cdalvo" name="cdalvo[]" data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_alvo[1])) { $ch=' selected="selected" '; }

 foreach ($view_alvo as $alvo) {
  echo '<option value="'.$alvo['cdalvo'].'"'.$ch.'>'.$alvo['descricao'].'</option>';
  } ?>
 </select>
 </div>
</td>
<td>
<div>
 <?php
 echo '<input id="cdalvo_informacao" name="cdalvo_informacao[]" type="hidden" value="'.$alvo_informacao['cdalvo_informacao'].'" class="form-control"  data-parsley-trigger="change"/>'; 
 echo $alvo_informacao['logica'].' - '.$alvo_informacao['tipo'].' - '.$alvo_informacao['indicador'];
 ?>
 </div>
</td>
   <?php
  foreach ($view_anos as $ano) {
  
  $valor='';
  foreach ($view_alvo_informacao_ano as $alvo_informacao_ano) {
    
	 if ( ($alvo_informacao_ano['cdalvo_informacao']==$alvo_informacao['cdalvo_informacao']) and ($alvo_informacao_ano['ano']==$ano['ano'])) {
	     $valor=$alvo_informacao_ano['valor'];
	 }
  }
  
  
  echo '<td><div><input id="valor'.$ano['ano'].'" name="valor'.$ano['ano'].'[]" type="text" value="'.$valor.'" class="form-control"  data-parsley-trigger="change" placeholder="Valor"/></div></td>';
  
  } ?>

</tr>
<?php } ?>
</tbody></table> 
</div>


<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/alvo_informacao_ano/" class="btn btn-default">Cancelar</a>


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
