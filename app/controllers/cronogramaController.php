<?php
session_start();
    class cronograma extends Controller {

        public function Index_action(){
        $cronograma = new cronogramaModel();   
			  $projetos = new projetosModel();
		    $datas['vc'] = $this->modvinculados(get_class($this));	
        
        
			  
        $mes_lista =  $projetos->rsql("SELECT extract(month from min(data)) as mesi, extract(year from min(data)) as anoi  from contrato_item where cdcontrato in (select cdcontrato from contrato where cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto'].')');
        
        $datas['mesi'] = $mes_lista[0]['mesi'];
        $datas['anoi'] = $mes_lista[0]['anoi'];
        
              
        
        
        $contrato_lista =  $projetos->rsql("
        SELECT c.cdcontrato, c.numero, c.objeto,  ci.cdcontrato_item as codigo, 1 as tipo ,ci.cdcontrato_item, ci.descricao, ci.data, ci.cdcontrato_item_sup, ci.subitem, extract(month from ci.data) as mes, extract(year from ci.data) as ano, max(cp.sequencia) as sequencia, sum(cp.quantidade) as previsao_quantidade, sum(cp.valor) as previsao_valor
         from contrato c, contrato_item ci 
         left outer join contrato_previsao cp on cp.cdcontrato_item=ci.cdcontrato_item
         
         where ci.cdcontrato_item_sup is null and c.cdcontrato=ci.cdcontrato and c.cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']."
         group by c.cdcontrato, c.numero, c.objeto,  ci.cdcontrato_item, ci.descricao, ci.data, ci.cdcontrato_item_sup, ci.subitem
         union
         SELECT c.cdcontrato, c.numero, c.objeto,  ci.cdcontrato_item_sup as codigo, 2 as tipo ,ci.cdcontrato_item, ci.descricao, ci.data, ci.cdcontrato_item_sup, ci.subitem, extract(month from ci.data) as mes, extract(year from ci.data) as ano, max(cp.sequencia) as sequencia, sum(cp.quantidade) as previsao_quantidade, sum(cp.valor) as previsao_valor
         from contrato c, contrato_item ci 
         left outer join contrato_previsao cp on cp.cdcontrato_item=ci.cdcontrato_item
         
         where ci.cdcontrato_item_sup is not null and c.cdcontrato=ci.cdcontrato and c.cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']."
         group by c.cdcontrato, c.numero, c.objeto,  ci.cdcontrato_item, ci.descricao, ci.data, ci.cdcontrato_item_sup, ci.subitem
         order by 1,2,3,4,5,6");
         
        $datas['contrato'] = $contrato_lista;
        
        
        $mesf = $contrato_lista[0]['mes'];
        $anof = $contrato_lista[0]['ano'];
        
        $su=0;
        $si=0;
        $sii=0;
              
        foreach ($contrato_lista as $key) {
        
        
              if ($key['cdcontrato_item_sup']!='') {
                  $datas['contrato'][$su]['i']= ($si).'.'.($sii+1);
                  $sii++;
                } else {
                  $datas['contrato'][$su]['i']= $si+1;
                  $sii=0;
                  $si++;
                }
              $su++;
        
        
          if ($key['data']!='') {
        
            
            

                   
                   if ($key['subitem']==0) {
                   
                   $previsao =  $projetos->rsql("select ci.cdcontrato_item, extract(month from ci.data) as mes, extract(year from ci.data) as ano, cp.quantidade, cp.valor from contrato_previsao cp, contrato_item ci where cp.cdcontrato_item=ci.cdcontrato_item and ci.cdcontrato_item_sup=".$key['cdcontrato_item']." order by ci.data, cp.sequencia");                  

                   $mespr = $previsao[0]['mes']; 
                   $anopr = $previsao[0]['ano'];
                                     
                   foreach ($previsao as $previsoes) {
                   
                   $previsao_lista[$key['cdcontrato_item']][$anopr][$mespr]['quantidade']= $previsoes['quantidade'];
                   $previsao_lista[$key['cdcontrato_item']][$anopr][$mespr]['valor']= $previsoes['valor'];
           
                   if ($mespr<12) {
                      $mespr=$mespr+1;
                   } else {
                      $mespr=1;
                      $anopr = $anopr+1;
                   } 
                  
                   }
                                                                    
                  
                  } else {
                  
                  
                  $mesc = $key['mes']; 
                  $anoc = $key['ano'];

                  for ($i = 1; $i <= $key['sequencia']; $i++) {
                              
                   $previsao =  $projetos->rsql("select quantidade, valor from contrato_previsao where cdcontrato_item=".$key['cdcontrato_item']." and sequencia=".$i);
                   
                   $previsao_lista[$key['cdcontrato_item']][$anoc][$mesc]['quantidade']= $previsao[0]['quantidade'];
                   $previsao_lista[$key['cdcontrato_item']][$anoc][$mesc]['valor']= $previsao[0]['valor'];
                                    
                   
                 if ($mesc<12) {
                    $mesc=$mesc+1;
                 } else {
                   $mesc=1;
                   $anoc = $anoc+1;
                 }
                 
                  }
                   
                     
            }                        
        
        
           if ($anoc>$anof) {
               $anof=$anoc;
               $mesf=$mesc;           
           } elseif ($anoc==$anof) {          
                if ($mesc>$mesf) {
                    $mesf=$mesc;
                }          
           
           } 
        	   
           if ($key['subitem']==0) {
                $previsaot =  $projetos->rsql("select sum(quantidade) as quantidade, sum(valor) as valor from contrato_previsao where cdcontrato_item in ( select cdcontrato_item from contrato_item where cdcontrato_item_sup=".$key['cdcontrato_item'].")");                  
                $previsao_total_lista[$key['cdcontrato_item']]['quantidade']= $previsaot[0]['quantidade'];
                $previsao_total_lista[$key['cdcontrato_item']]['valor']= $previsaot[0]['valor'];
            } else {
                $previsao_total_lista[$key['cdcontrato_item']]['quantidade']= $key['previsao_quantidade'];
                $previsao_total_lista[$key['cdcontrato_item']]['valor']= $key['previsao_valor'];
            }      
        
        
            if ($key['subitem']==0) {
            $medicao =  $projetos->rsql("select extract(month from g.data) as mes, extract(year from g.data) as ano, sum(m.quantidade) as quantidade, sum(m.valor) as valor 
            from medicao m, grupomedicao g where g.cdgrupomedicao=m.cdgrupomedicao and m.cdcontrato_item in ( select cdcontrato_item from contrato_item where cdcontrato_item_sup=".$key['cdcontrato_item'].")
            group by extract(month from g.data), extract(year from g.data)");
            } else {       
            $medicao =  $projetos->rsql("select extract(month from g.data) as mes, extract(year from g.data) as ano, sum(m.quantidade) as quantidade, sum(m.valor) as valor 
            from medicao m, grupomedicao g where g.cdgrupomedicao=m.cdgrupomedicao and m.cdcontrato_item =".$key['cdcontrato_item']."
            group by extract(month from g.data), extract(year from g.data)");
            }          
            foreach ($medicao as $medicoes) {
                  
                  $medicao_lista[$key['cdcontrato_item']][$medicoes['ano']][$medicoes['mes']]['quantidade'] = $medicoes['quantidade'];
                  $medicao_lista[$key['cdcontrato_item']][$medicoes['ano']][$medicoes['mes']]['valor'] = $medicoes['valor'];            
            }
            
            if ($key['subitem']==0) {
            $medicao_total =  $projetos->rsql("select sum(quantidade) as quantidade, sum(valor) as valor 
            from medicao where cdcontrato_item in ( select cdcontrato_item from contrato_item where cdcontrato_item_sup=".$key['cdcontrato_item'].")");            
            } else {
            $medicao_total =  $projetos->rsql("select sum(quantidade) as quantidade, sum(valor) as valor 
            from medicao where cdcontrato_item=".$key['cdcontrato_item']);            
            }
            $medicao_total_lista[$key['cdcontrato_item']]['quantidade']= $medicao_total[0]['quantidade'];
            $medicao_total_lista[$key['cdcontrato_item']]['valor']= $medicao_total[0]['valor'];
            
            
            
                    
        }
        
        }
        
        $datas['mesf'] = $mesf;
        $datas['anof'] = $anof;
        $datas['previsao'] = $previsao_lista;
        $datas['medicao'] = $medicao_lista;  
        $datas['previsao_total'] = $previsao_total_lista;
        $datas['medicao_total'] = $medicao_total_lista; 
        
        //print_r($datas['previsao']);
        //die();     
                     
 			
  		
            if ($cronograma->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/cronograma/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
        }


        public function novom(){
        }


        public function editar(){
          $this->view('/cronograma/editar', $datas);
        }

        public function atualiza(){

        }

        public function exclui(){
           
        }

        public function pesquisar(){
        }

        public function insere(){
        }

        public function inserem( Array $dados = null ){

        }

        public function inserew(){
        }

        public function pesquisa(){
    }


}