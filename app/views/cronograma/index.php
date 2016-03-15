
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

        <div class="panel-body" style="overflow:auto">
        <div class="table-responsive no-border">
        
        
                          <table class="table table-bordered no-m">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Descrição</th>
                                                    <th></th>
                                                    <th>%</th>
                                                    
		                                      	<?php                                            
                                                    $mes = $view_mesi;
                                                    $ano = $view_anoi; 
                                          
                                            for($i = 0; $view_mesf.'/'.$view_anof != $mes.'/'.$ano; ++$i) {
                                            ?>
                                                    <th><?php echo $mes.'/'.$ano; ?></th>
			                                      <?php                                                 
                                                 if ($mes<12) {
                                                    $mes=$mes+1;
                                                 } else {
                                                    $mes=1;
                                                    $ano = $ano+1;
                                                 } } ?>                                                                                                        
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php  
                                            $cdcontrato = $view_contratos[0]['cdcontrato'];
                                            $c=1;                                            
                                            $previsao_quantidade_item=0;
                                            $previsao_valor_item=0;
                                            foreach ($view_contrato as $contratos) { 
                                             if ($contratos['cdcontrato']!=$cdcontrato) {
                                                 $c=1; 
                                                 $cdcontrato=$contratos['cdcontrato'];
                                            ?>
                                                <tr>
                                                    <th colspan="100%"><?php echo $contratos['numero'].' - '.$contratos['objeto']?></th>
                                                </tr>
                                             <?php } ?>
                                                <tr>
                                                    <td rowspan="2"><?php echo $contratos['i'];//$c;  $c++; ?></td>
                                                    <td rowspan="2"><?php echo $contratos['descricao']; ?></td>
                                                    <td>Previsto</td>
                                                    <td>
                                                        <div class="small">Físico </div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>Financeiro</small>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    
		                                      	<?php                                            
                                                    $mes = $view_mesi;
                                                    $ano = $view_anoi; 
                                          
                                            for($i = 0; $view_mesf.'/'.$view_anof != $mes.'/'.$ano; ++$i) {
                                            
                                              if (($view_previsao_total[$contratos['cdcontrato_item']]['quantidade'])>0) {
                                                $prev = ((($view_previsao[$contratos['cdcontrato_item']][$ano][$mes]['quantidade'])*100)/($view_previsao_total[$contratos['cdcontrato_item']]['quantidade']));
                                              } else {
                                                $prev =0;
                                              }
                                              
                                              if (($view_previsao_total[$contratos['cdcontrato_item']]['valor'])>0) {
                                                $prevv = ((($view_previsao[$contratos['cdcontrato_item']][$ano][$mes]['valor'])*100)/($view_previsao_total[$contratos['cdcontrato_item']]['valor']));
                                              } else {
                                                $prevv =0;
                                              }
                                              
                                              $previsao_item_quantidade[$contratos['cdcontrato_item']] = $previsao_item_quantidade[$contratos['cdcontrato_item']] + $prev ; 
                                              
                                                
                                              if ($contratos['subitem']=='1') {                                              
                                              $previsao_mes[$ano][$mes]=($previsao_mes[$ano][$mes])+$prev;                                             
                                              
                                              }
                                              $prev_valor = ($view_previsao[$contratos['cdcontrato_item']][$ano][$mes]['valor']);
                                              
                                              $previsao_item_valor[$contratos['cdcontrato_item']] = $previsao_item_valor[$contratos['cdcontrato_item']] + $prevv ;
                                              
                                              $previsao_item_quantidadema[$contratos['cdcontrato_item']][$ano][$mes] =  $prev ;
                                              $previsao_item_valorma[$contratos['cdcontrato_item']][$ano][$mes] =  $prev_valor ;
                                               
                                              if ($contratos['subitem']=='1') {
                                              
                                              $previsao_mes_quantidade[$ano][$mes]=$previsao_mes_quantidade[$ano][$mes]+$prev;                                              
                                              $previsao_mes_valor[$ano][$mes]=$previsao_mes_valor[$ano][$mes]+$prev_valor;
                                              
                                              }                                              
                                              
                                              if ($prev>0) {
                                              if ($contratos['subitem']=='1') {
                                              
                                              $prev_mes_quantidade[$ano][$mes]=$prev_mes_quantidade[$ano][$mes]+1;                                               
                                              }
                                              }   
                                            
                                            
                                              
                                              
                                              
                                              
                                              
                                               
                                              
                                                                                          
                                            ?>

                                                    <td>
                                                    <?php if ($contratos['subitem']=='1') { ?>
                                                    <div class="small"> <?php echo ( $previsao_item_quantidadema[$contratos['cdcontrato_item']][$ano][$mes] > 0 ? round($view_previsao[$contratos['cdcontrato_item']][$ano][$mes]['quantidade']).' / '.round($view_previsao_total[$contratos['cdcontrato_item']]['quantidade']).' - '.round($previsao_item_quantidade[$contratos['cdcontrato_item']]).' %' : '-' );?></div>
                                                    <?php } else { ?>
                                                    <div class="small"> <?php echo ( $previsao_item_quantidadema[$contratos['cdcontrato_item']][$ano][$mes] > 0 ? round($previsao_item_quantidade[$contratos['cdcontrato_item']]).' %' : '-' );?></div>
                                                    <?php } ?>
                                                        <?php if($previsao_item_quantidadema[$contratos['cdcontrato_item']][$ano][$mes]>0){?>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: <?php echo $previsao_item_quantidade[$contratos['cdcontrato_item']];?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $previsao_item_quantidade[$contratos['cdcontrato_item']];?>" role="progressbar" class="progress-bar<?php echo $pq;?> done">
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                        <small><?php if($previsao_item_valorma[$contratos['cdcontrato_item']][$ano][$mes]>0){ echo 'R$ '.$previsao_item_valorma[$contratos['cdcontrato_item']][$ano][$mes].' / '.round($previsao_item_valor[$contratos['cdcontrato_item']]).' %';}?></small>
                                                       <?php if($previsao_item_valorma[$contratos['cdcontrato_item']][$ano][$mes]>0){?>
                                                        <div class="progress progress-xs mt5 mb5">
                                                        <div style="width: <?php echo $previsao_item_valor[$contratos['cdcontrato_item']];?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $previsao_item_valor[$contratos['cdcontrato_item']];?>" role="progressbar" class="progress-bar<?php echo $pq;?> done">
                                                            </div>  </div>
                                                            <?php } ?>
                                                            
                                                    </td>                                                    
			                                      <?php                                                 
                                                 if ($mes<12) {
                                                    $mes=$mes+1;
                                                 } else {
                                                    $mes=1;
                                                    $ano = $ano+1;
                                                 } } ?> 
                                                                                                     
                                                                                                        
                                                   
                                                </tr>
                                                

                                                <tr>
                                                    <td border="1">Realizado</td>
                                                    <td>
                                                        <div class="small">Físico</div>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>
                                                        <small>Financeiro</small>
                                                        
                   <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar done">
                                                            </div>
                                                        </div>                                                        
                                                    </td>

		                                      	<?php                                            
                                                    $mes = $view_mesi;
                                                    $ano = $view_anoi; 
                                          
                                            for($i = 0; $view_mesf.'/'.$view_anof != $mes.'/'.$ano; ++$i) {
                                            


                                              if (($view_medicao_total[$contratos['cdcontrato_item']]['quantidade'])>0) {
                                                $med = ((($view_medicao[$contratos['cdcontrato_item']][$ano][$mes]['quantidade'])*100)/($view_medicao_total[$contratos['cdcontrato_item']]['quantidade']));
                                              } else {
                                                $med =0;
                                              }
                                              
                                              
                                              if (($view_medicao_total[$contratos['cdcontrato_item']]['valor'])>0) {
                                                $medpv = ((($view_medicao[$contratos['cdcontrato_item']][$ano][$mes]['valor'])*100)/($view_medicao_total[$contratos['cdcontrato_item']]['valor']));
                                              } else {
                                                $medpv =0;
                                              }
                                              
                                              $medicao_item_quantidade[$contratos['cdcontrato_item']] = $medicao_item_quantidade[$contratos['cdcontrato_item']] + $med ; 
                                              
                                              
                                              if ($contratos['subitem']=='1') {
                                              
                                              $medicao_mes_quantidade[$ano][$mes]=$medicao_mes_quantidade[$ano][$mes]+$med;
                                              
                                              
                                              
                                              
                                              }
                                              
                                              $med_valor = ($view_medicao[$contratos['cdcontrato_item']][$ano][$mes]['valor']);
                                              
                                              $medicao_item_valor[$contratos['cdcontrato_item']] = $medicao_item_valor[$contratos['cdcontrato_item']] + $med_valor ;
                                              $medicao_item_pvalor[$contratos['cdcontrato_item']] = $medicao_item_pvalor[$contratos['cdcontrato_item']] + $medpv ;
                                              
                                              $medicao_item_quantidadema[$contratos['cdcontrato_item']][$ano][$mes] = $med ;
                                              $medicao_item_valorma[$contratos['cdcontrato_item']][$ano][$mes] =  $med_valor ;
                                               
                                                                                            
                                              if ($contratos['subitem']=='1') {
                                              
                                              $medicao_mes_valor[$ano][$mes]=$medicao_mes_valor[$ano][$mes]+$med_valor;
                                              
                                              }
                                              if ($med>0) { 
                                              if ($contratos['subitem']=='1') {
                                              
                                              $med_mes_quantidade[$ano][$mes]=$med_mes_quantidade[$ano][$mes]+1;
                                              }
                                              } 
                                              
                                              $pq=''; $mq='';
                                              if ($previsao_item_quantidade[$contratos['cdcontrato_item']]>$medicao_item_quantidade[$contratos['cdcontrato_item']]) {
                                                   $mq=' progress-bar-danger';
                                              } elseif ($previsao_item_quantidade[$contratos['cdcontrato_item']]<=$medicao_item_quantidade[$contratos['cdcontrato_item']]) {
                                                   $mq=' progress-bar-success';
                                              }                                             
                                              
                                            
                                            
                                            ?>

                                                                                                <td>
                                                    <?php if ($contratos['subitem']=='1') { ?>
                                                    <div class="small"> <?php echo ( $medicao_item_quantidadema[$contratos['cdcontrato_item']][$ano][$mes] > 0 ? round($view_medicao[$contratos['cdcontrato_item']][$ano][$mes]['quantidade']).' / '.round($view_medicao_total[$contratos['cdcontrato_item']]['quantidade']).' - '.round($medicao_item_quantidade[$contratos['cdcontrato_item']]).' %' : '-' );?></div>
                                                    <?php } else { ?>
                                                    <div class="small"> <?php echo ( $medicao_item_quantidadema[$contratos['cdcontrato_item']][$ano][$mes] > 0 ? round($medicao_item_quantidade[$contratos['cdcontrato_item']]).' %' : '-' );?></div>
                                                    <?php } ?>
                                                                                                                                                    
                                                    
                                                    <?php if($medicao_item_quantidadema[$contratos['cdcontrato_item']][$ano][$mes]>0){?>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: <?php echo $medicao_item_quantidade[$contratos['cdcontrato_item']];?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $medicao_item_quantidade[$contratos['cdcontrato_item']];?>" role="progressbar" class="progress-bar<?php echo $mq;?> done">
                                                            
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                        <small><?php if($medicao_item_valorma[$contratos['cdcontrato_item']][$ano][$mes]>0){ echo 'R$ '.$medicao_item_valor[$contratos['cdcontrato_item']].' / '.round($medicao_item_pvalor[$contratos['cdcontrato_item']]).' %'; } ?></small>
                                                          <?php if($medicao_item_quantidadema[$contratos['cdcontrato_item']][$ano][$mes]>0){?>
                                                        <div class="progress progress-xs mt5 mb5">
                                                            <div style="width: <?php echo $medicao_item_pvalor[$contratos['cdcontrato_item']];?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $medicao_item_pvalor[$contratos['cdcontrato_item']];?>" role="progressbar" class="progress-bar<?php echo $mq;?> done">
                                                            
                                                            </div>
                                                        </div>
                                                        <?php } ?>                                                        
                                                    </td>   
			                                      <?php                                                 
                                                 if ($mes<12) {
                                                    $mes=$mes+1;
                                                 } else {
                                                    $mes=1;
                                                    $ano = $ano+1;
                                                 } } ?>                                                     
              
                                                    
                                                </tr>
                                                <?php } ?>
                                                    
                                                </tr>

    
                                                <tr colspan="4" style="background:#fafafc">
                                                    <td colspan="4" >Percentual Previsto Simples</td>
                                                    
		                                      	<?php                                            
                                                    $mes = $view_mesi;
                                                    $ano = $view_anoi; 
                                          
                                            for($i = 0; $view_mesf.'/'.$view_anof != $mes.'/'.$ano; ++$i) {
                                            ?>

                                                    <td>
                                                        <?php
                                                        if ($prev_mes_quantidade[$ano][$mes]>0) {
                                                          echo round((($previsao_mes_quantidade[$ano][$mes])/$prev_mes_quantidade[$ano][$mes])).' %';
                                                        } else { echo '0%';} 
                                                         ?> 
                                                    </td>
                                                    
			                                      <?php                                                 
                                                 if ($mes<12) {
                                                    $mes=$mes+1;
                                                 } else {
                                                    $mes=1;
                                                    $ano = $ano+1;
                                                 } } ?>                                                     
                                                    


                                                    
                                                </tr>


                                                <tr colspan="4" style="background:#fafafc">
                                                    <td colspan="4" >Percentual Realizado Simples</td>
                                                    
		                                      	<?php                                            
                                                    $mes = $view_mesi;
                                                    $ano = $view_anoi; 
                                          
                                            for($i = 0; $view_mesf.'/'.$view_anof != $mes.'/'.$ano; ++$i) {
                                            ?>

                                                    <td>
                                                        <?php
                                                        if ($med_mes_quantidade[$ano][$mes]>0) {
                                                          echo round((($medicao_mes_quantidade[$ano][$mes])/$med_mes_quantidade[$ano][$mes])).' %';
                                                        } else { echo '-';} 
                                                         ?>
                                                    </td>
                                                    
			                                      <?php                                                 
                                                 if ($mes<12) {
                                                    $mes=$mes+1;
                                                 } else {
                                                    $mes=1;
                                                    $ano = $ano+1;
                                                 } } ?>                                                     
                                                    


                                                    
                                                </tr>                                                

                                                <tr style="background:#fafafc">
                                                    <td colspan="4">Percentual Previsto Acumulado</td>
                                                    
		                                      	<?php                                            
                                                    $mes = $view_mesi;
                                                    $ano = $view_anoi; 
                                          
                                            for($i = 0; $view_mesf.'/'.$view_anof != $mes.'/'.$ano; ++$i) {                                           
                                            
                                              if ($previsao_mes_quantidade[$ano][$mes]>0) {
                                              $previsao_quantidade=$previsao_quantidade+$previsao_mes_quantidade[$ano][$mes];                                                                                           
                                                                                             
                                              }
                                              
                                              if ($prev_mes_quantidade[$ano][$mes]>0) {
                                                $prev_quantidade=$prev_quantidade+$prev_mes_quantidade[$ano][$mes];
                                              }
                                              
                                              
                                              
                                            
                                            ?>                                            

                                                    <td>
                                                        <?php
                                                        if ($prev_quantidade>0) {
                                                          echo round((($previsao_quantidade)/$prev_quantidade)).' %';
                                                        } else { echo '-';} 
                                                         ?> 
                                                    </td>
                                                    
			                                      <?php                                                 
                                                 if ($mes<12) {
                                                    $mes=$mes+1;
                                                 } else {
                                                    $mes=1;
                                                    $ano = $ano+1;
                                                 } } ?>                                                     
                                                    
                                                </tr>
                                                
                                                
                                                <tr style="background:#fafafc">
                                                    <td colspan="4">Percentual Realizado Acumulado</td>
                                                    
		                                      	<?php                                            
                                                    $mes = $view_mesi;
                                                    $ano = $view_anoi;

                                          
                                            for($i = 0; $view_mesf.'/'.$view_anof != $mes.'/'.$ano; ++$i) {
                                            
                                             if ($medicao_mes_quantidade[$ano][$mes]>0) {                                                 
                                                 $medicao_quantidade=$medicao_quantidade+$medicao_mes_quantidade[$ano][$mes];                                                                                           
                                                                                             
                                              }                                           
                                              if ($med_mes_quantidade[$ano][$mes]>0) {
                                                $med_quantidade=$med_quantidade+$med_mes_quantidade[$ano][$mes];
                                              }
                                            
                                              
                                            
                                            ?>                                            

                                                    <td>
                                                        <?php
                                                        if ($med_quantidade>0) {
                                                          echo round((($medicao_quantidade)/$med_quantidade)).' %';
                                                        } else { echo '-';} 
                                                         ?> 
                                                    </td>
                                                    
			                                      <?php                                                 
                                                 if ($mes<12) {
                                                    $mes=$mes+1;
                                                 } else {
                                                    $mes=1;
                                                    $ano = $ano+1;
                                                 } } ?>                                                     
                                                    
                                                </tr>
                                                                                                
                                                <tr style="background:#fafafc">
                                                    <td colspan="4">Valor Previsto Simples</td>
	                                      	<?php                                            
                                                    $mes = $view_mesi;
                                                    $ano = $view_anoi; 
                                          
                                            for($i = 0; $view_mesf.'/'.$view_anof != $mes.'/'.$ano; ++$i) {
                                            ?>

                                                    <td>
                                                        <?php echo $previsao_mes_valor[$ano][$mes]; ?> 
                                                    </td>
                                                    
			                                      <?php                                                 
                                                 if ($mes<12) {
                                                    $mes=$mes+1;
                                                 } else {
                                                    $mes=1;
                                                    $ano = $ano+1;
                                                 } } ?>  
                                                    
                                                </tr>
                                                
                                                <tr style="background:#fafafc">
                                                    <td colspan="4">Valor Realizado Simples</td>
	                                      	<?php                                            
                                                    $mes = $view_mesi;
                                                    $ano = $view_anoi; 
                                          
                                            for($i = 0; $view_mesf.'/'.$view_anof != $mes.'/'.$ano; ++$i) {
                                            ?>

                                                    <td>
                                                        <?php echo $medicao_mes_valor[$ano][$mes]; ?> 
                                                    </td>
                                                    
			                                      <?php                                                 
                                                 if ($mes<12) {
                                                    $mes=$mes+1;
                                                 } else {
                                                    $mes=1;
                                                    $ano = $ano+1;
                                                 } } ?>  
                                                    
                                                </tr>
                                                
                                                <tr style="background:#fafafc">
                                                    <td colspan="4">Valor Previsto Acumulado</td>
	                                      	<?php                                            
                                                    $mes = $view_mesi;
                                                    $ano = $view_anoi; 
                                          
                                            for($i = 0; $view_mesf.'/'.$view_anof != $mes.'/'.$ano; ++$i) {
                                            
                                            
                                              if ($previsao_mes_valor[$ano][$mes]>0) {
                                                 $previsao_valor=$previsao_valor+$previsao_mes_valor[$ano][$mes];                                                                                                                                        
                                              }
                                                 
                                            
                                            ?>

                                                    <td>
                                                        <?php echo $previsao_valor; ?>  
                                                    </td>
                                                    
			                                      <?php                                                 
                                                 if ($mes<12) {
                                                    $mes=$mes+1;
                                                 } else {
                                                    $mes=1;
                                                    $ano = $ano+1;
                                                 } } ?>  
                                                    
                                                </tr>
                                                
                                                <tr style="background:#fafafc">
                                                    <td colspan="4">Valor Realizado Acumulado</td>
	                                      	<?php                                            
                                                    $mes = $view_mesi;
                                                    $ano = $view_anoi; 
                                          
                                            for($i = 0; $view_mesf.'/'.$view_anof != $mes.'/'.$ano; ++$i) {
                                            
                                              if ($medicao_mes_valor[$ano][$mes]>0) {
                                                 $medicao_valor=$medicao_valor+$medicao_mes_valor[$ano][$mes];                                                                                                                                        
                                              }
                                            ?>

                                                    <td>
                                                         <?php echo $medicao_valor; ?> 
                                                    </td>
                                                    
			                                      <?php                                                 
                                                 if ($mes<12) {
                                                    $mes=$mes+1;
                                                 } else {
                                                    $mes=1;
                                                    $ano = $ano+1;
                                                 } } ?>  
                                                    
                                                </tr>
                                                                                                
                                            </tbody>
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
