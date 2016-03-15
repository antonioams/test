
<?php
include('app/views/topo.php');
?>
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

<div class="col-lg-12">
<section class="panel panel-default">

   <header class="panel-heading">
      Quadro Lógico
   </header>
        <div class="panel-body">
        <div class="table-responsive no-border">
        <table id="example1" class="table table-bordered table-striped mg-t">
            <thead>
            <tr>
            <th><?php echo $view_programas[0]['nome'];?></th>
			<th>Lógica</th>
			<th>Tipo</th>
			<th>Indicador</th>
			<th>Fórmula</th>
			<th>Fonte</th>
			<th>Descrição do Indicador</th>
			
			<?php  foreach ($view_anos as $ano) {?>
            
			<th><?php echo $ano['ano']; ?></th>
			
			<?php } ?>
			
			
            </tr>
            </thead>
            <tbody>
            
			<tr>
			<td rowspan="<?php echo count($view_alvo_informacao);?>">Alvo Estratégico</td>	
			
			<?php $a=0;  foreach ($view_alvo_informacao as $alvo_informacao) {
			
			if ($a>0) { echo '<tr>';}
			?>
            
			

            <td><?php echo $alvo_informacao['descricao']; $a++;?></td>
            
            <td><?php echo $alvo_informacao['tipo']; ?></td>
            <td><?php echo $alvo_informacao['indicador']; ?></td>
            <td><?php echo $alvo_informacao['formula']; ?></td>
			<td><?php echo $alvo_informacao['fonte']; ?></td>
            <td><?php echo $alvo_informacao['descricao_indicador']; ?></td>
            
			
			
			<?php  foreach ($view_anos as $ano) { ?>
            
			<td><?php  foreach ($view_alvo_informacao_ano as $alvo_ano) {
						 if ( ($alvo_ano['cdalvo_informacao']==$alvo_informacao['cdalvo_informacao']) and ($alvo_ano['ano']==$ano['ano']) ) {
							echo $alvo_ano['valor'];
						} }			?>
			</td>
			
			<?php } ?>
			
			</tr>
            <?php } ?>
			
			<tr>
			<td rowspan="<?php echo count($view_objetivo_informacao);?>">Objetivo Estratégico</td>	

			        
			 <?php // inicio objetivos informações
			 $o=0;
			 foreach ($view_objetivo_informacao as $objetivo_informacao) {
			 
			 if ($o>0) { echo '<tr>';}
			 ?>

            
			<td><?php echo $objetivo_informacao['logica']; $o++;?></td>
            <td><?php echo $objetivo_informacao['tipo']; ?></td>
            <td><?php echo $objetivo_informacao['indicador']; ?></td>
            <td><?php echo $objetivo_informacao['formula']; ?></td>
			<td><?php echo $objetivo_informacao['fonte']; ?></td>
            <td><?php echo $objetivo_informacao['descricao_indicador']; ?></td>
			
			
			<?php  foreach ($view_anos as $ano) {
			
			?>
            
			<td><?php if (is_array($objetivo_informacao['peso'])) {
					foreach ($objetivo_informacao['peso'] as $peso) {
					if ($peso[$ano['ano']]<>'') {
					echo $peso[$ano['ano']].' %'; 
					}
			} }
			?></td>
			
			<?php } ?>
			
			</tr>
            <?php } // fim objetivos informações?>


			<tr>
			<td rowspan="<?php echo count($view_produtos);?>">Produtos/Serviços Entregues</td>	
			 <?php // inicio produtos
			 $p=0;
			 foreach ($view_produtos as $produtos) {
			 if ($p>0) { echo '<tr>';}
			 ?>
            
			
	
            
			<td><?php echo $produtos['logica']; $p++;?></td>
            <td><?php echo $produtos['tipo']; ?></td>
            <td><?php echo $produtos['indicador']; ?></td>
            <td><?php echo $produtos['formula']; ?></td>
			<td><?php echo $produtos['fonte']; ?></td>
            <td><?php echo $produtos['descricao_indicador']; ?></td>
			
			
			<?php  foreach ($view_anos as $ano) {
			
			?>
            
			<td><?php if (is_array($produtos['pesos'])) {
					foreach ($produtos['pesos'] as $peso) {
					if ($peso[$ano['ano']]<>'') {
					echo (($peso[$ano['ano']]/$produtos['meta'])*100)   .' %'; 
					}
			} }
			?></td>
			
			<?php } ?>
			
			</tr>
            <?php } // fim produtos ?>

			
			
			<?php // inicio projetos
			 foreach ($view_projetos as $projetos) {
			 ?>
			<tr>
			<td rowspan="<?php echo count($projetos['documentos'])+count($projetos['execucao']);?>"><?php echo $projetos['intervencao']; ?></td>				 
			 <?php
			 $d=0;
			 foreach ($projetos['documentos'] as $documentos) {
			 if ($d>0) { echo '<tr>';} 
			 ?>
            

            
			<td><?php echo $documentos['descricao']; ?></td>
            <td><?php echo $documentos['tipo']; $d++;?></td>
            <td><?php echo $documentos['indicador']; ?></td>
            <td><?php echo $documentos['formula']; ?></td>
			<td><?php echo $documentos['fonte']; ?></td>
            <td><?php echo $documentos['descricao_indicador']; ?></td>
			
			
			<?php  foreach ($view_anos as $ano) {
			
			?>
            
			<td><?php if ($ano['ano']==$documentos['ano']) {
					if ($documentos['documentos']==$documentos['preenchidos']) {
					echo '100 %'; 
					} else { echo '0 %';}
			}
			?></td>
			
			<?php } ?>
			
			
			</tr>
			<?php
			}
			foreach ($projetos['execucao'] as  $keye => $execucao) {
			 if ($d>0) { echo '<tr>';} 
			 ?>
            
            
			<td><?php echo $execucao['logica']; ?></td>
            <td><?php echo $execucao['tipo']; ?></td>
            <td><?php echo $execucao['indicador']; ?></td>
            <td><?php echo $execucao['formula']; ?></td>
			<td><?php echo $execucao['fonte']; ?></td>
            <td><?php echo $execucao['descricao_indicador']; ?></td>
			

			
			<?php  foreach ($view_anos as $ano) {
			
			?>
            
			<td><?php if (array_key_exists($ano['ano'], $execucao)) { 

					echo $execucao[$ano['ano']].' %'; 
					
			}
			?></td>
			
			<?php } ?>
			
			
			<?php } ?>
						
            <?php  } // fim produtos ?>	

 
			
			
        </table>
    </div>
 </div>
 </section>
 </div>
 <?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }  ?> 

<?php include('app/views/rodape.php'); ?>
