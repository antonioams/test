<?php
session_start();
    class quadro extends Controller{

        public function Index_action(){
           
			$quadro = new quadroModel();
			$projetos = new projetosModel();
		    $programas = new programasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));	
			$programas_lista = $programas->listaprogramas("cdprograma=".$_SESSION[PROJETO]['filtro']['cdprograma']);
            $datas['programas'] = $programas_lista;

			$alvo = new alvoModel();
            $alvo_lista = $alvo->listaalvo("cdprograma=".$_SESSION[PROJETO]['filtro']['cdprograma']);
            $datas['alvo'] = $alvo_lista;

			$alvo_informacao = new alvo_informacaoModel();
            $alvo_informacao_lista = $projetos->rsql("SELECT a.descricao, ai.* from alvo a, alvo_informacao ai
            where a.cdalvo=ai.cdalvo and a.cdprograma=".$_SESSION[PROJETO]['filtro']['cdprograma']);
            $datas['alvo_informacao'] = $alvo_informacao_lista;			
			
			$objetivo_informacao = new objetivo_informacaoModel();
            $objetivo_informacao_lista = $objetivo_informacao->listaobjetivo_informacao("cdprograma=".$_SESSION[PROJETO]['filtro']['cdprograma']);
            $datas['objetivo_informacao'] = $objetivo_informacao_lista;

			$alvo_informacao_ano = new alvo_informacao_anoModel("cdalvo in (select cdalvo from alvo where cdprograma=".$_SESSION[PROJETO]['filtro']['cdprograma'].')');
			$alvo_informacao_ano_lista = $alvo_informacao_ano->listaalvo_informacao_ano();
            $datas['alvo_informacao_ano'] = $alvo_informacao_ano_lista;

			$produtos = new produtosModel();
            $produtos_lista = $produtos->listaprodutos("cdprograma=".$_SESSION[PROJETO]['filtro']['cdprograma']);
            $datas['produtos'] = $produtos_lista;

       $projeto_produto = new projeto_produtoModel();            
       $p=0;
       $pesos='';
       
       foreach ($produtos_lista as $pkey => $pvalue) { // inicio for produtos       
       	    
        $projeto_produto_lista = $projetos->rsql("SELECT pp.*, p.cdtipo, extract(year from p.datahora) as ano from projeto_produto pp, projeto p where pp.cdprojeto=p.cdprojeto and cdproduto=".$pvalue['cdproduto']);
                
        foreach ($projeto_produto_lista as $projeto_produto) { // inicio for projeto_produto
          
        $grupodocumento_lista1 = $projetos->rsql("
					SELECT count(d.cddocumento) AS documentos, count(dv.valor) AS preenchidos
					FROM fase f, grupodocumento gd, documento d, campo c
					LEFT JOIN documento_valor dv ON c.cdcampo = dv.cdcampo and dv.cdprojeto=".$projeto_produto['cdprojeto']."
					WHERE f.cdfase=gd.cdfase and gd.cdgrupodocumento = d.cdgrupodocumento AND d.cddocumento = c.cddocumento AND d.obrigatorio = 1 and
					f.cdtipo=".$projeto_produto['cdtipo']."
					");
					
				  $andamentoc1 = $projetos->rsql("SELECT  sum(ci.valor) as valor, sum(ci.quantidade) as qtd FROM contrato c, contrato_item ci WHERE c.cdprojeto=".$projeto_produto['cdprojeto']." and c.cdcontrato=ci.cdcontrato GROUP BY c.cdprojeto ");
					
				  $andamentom1 = $projetos->rsql("SELECT   sum(m.valor) as valor, sum(m.quantidade) as qtd FROM contrato c, contrato_item ci, medicao m WHERE c.cdprojeto=".$projeto_produto['cdprojeto']." and c.cdcontrato=ci.cdcontrato and ci.cdcontrato_item=m.cdcontrato_item GROUP BY c.cdprojeto ");					
				
				  
					$fisico = ( ($andamentoc1[0]['qtd']<=0) ? '0' : (($andamentom1[0]['qtd']/$andamentoc1[0]['qtd'])*100) );
					$financeiro = ( ($andamentoc1[0]['valor']<=0) ? '0' : (($andamentom1[0]['valor']/$andamentoc1[0]['valor'])*100) );
				
				  
				    if ($grupodocumento_lista1[0]['documentos']==$grupodocumento_lista1[0]['preenchidos']) {
				    
                    $pesos[$projeto_produto['ano']]=$pesos[$projeto_produto['ano']]+$projeto_produto['peso'];
                  
		   		   }                      
          } // fim for projeto_produto
          
          $datas['produtos'][$p]['pesos']=$pesos;
				  $pesos='';
          $p++;
          				  
      }  // fim for produtos
			
			$grupodocumento = new grupodocumentoModel();
			
			$execucao_lista = $projetos->rsql("select * from execucao_projeto");
			
            $projetos_lista = $projetos->listaprojetos("cdprojeto in (select pp.cdprojeto from projeto_produto pp, produto p
			                                            where pp.cdproduto=p.cdproduto and p.cdprograma=".$_SESSION[PROJETO]['filtro']['cdprograma'].' ) ');
            $datas['projetos'] = $projetos_lista;	
			$i=0;
			foreach ($projetos_lista as $key => $value) { // inicio for projetos
                  //$grupodocumento_lista = $grupodocumento->listagrupodocumento("cdtipo=".$value['cdtipo']);
				  $grupodocumento_lista = $projetos->rsql("
					SELECT gd.cdgrupodocumento, gd.descricao, gd.cdtipo, gd.peso, gd.logica, gd.tipo, gd.indicador, gd.formula, gd.fonte, gd.descricao_indicador,
					count(d.cddocumento) AS documentos, count(dv.valor) AS preenchidos, extract(year from max(dv.datahora)) as ano
					FROM fase f, grupodocumento gd, documento d, campo c
					LEFT JOIN documento_valor dv ON c.cdcampo = dv.cdcampo and dv.cdprojeto=".$value['cdprojeto']."
					WHERE f.cdfase=gd.cdfase and gd.cdgrupodocumento = d.cdgrupodocumento AND d.cddocumento = c.cddocumento AND d.obrigatorio = 1 and
					f.cdtipo=".$value['cdtipo']."
					GROUP BY gd.cdgrupodocumento, gd.cdtipo, gd.peso, gd.logica, gd.tipo, gd.indicador, gd.formula, gd.fonte, gd.descricao_indicador
					ORDER BY gd.cdfase, gd.cdgrupodocumento
					");
					
				$andamentoc = $projetos->rsql("SELECT extract(year from max(c.data)) as ano, sum(ci.valor) as valor, sum(ci.quantidade) as qtd,  sum(a.valor) as valoraditivo FROM contrato_item ci, contrato c left outer join aditivo a on c.cdcontrato=a.cdcontrato WHERE c.cdprojeto=".$value['cdprojeto']." and c.cdcontrato=ci.cdcontrato GROUP BY c.cdprojeto ");
					
				$andamentom = $projetos->rsql("SELECT  extract(year from max(c.data)) as ano, sum(m.valor) as valor, sum(m.quantidade) as qtd FROM contrato c, contrato_item ci, medicao m WHERE c.cdprojeto=".$value['cdprojeto']." and c.cdcontrato=ci.cdcontrato and ci.cdcontrato_item=m.cdcontrato_item GROUP BY c.cdprojeto ");					
								  
					$execucao_lista[0][$andamentoc[0]['ano']]= round(( ($andamentoc[0]['qtd']<=0) ? '0' : (($andamentom[0]['qtd']/$andamentoc[0]['qtd'])*100) ),2);
					$execucao_lista[1][$andamentoc[0]['ano']]= round(( ($andamentoc[0]['valor']<=0) ? '0' : (($andamentom[0]['valor']/$andamentoc[0]['valor'])*100) ),2);
          $execucao_lista[2][$andamentoc[0]['ano']]= round(( (($andamentoc[0]['valor']+$andamentoc[0]['valoraditivo'])<=0) ? '0' : (($andamentom[0]['valor']/($andamentoc[0]['valor']+$andamentoc[0]['valoraditivo']))*100) ),2);
					//$execucao_lista[2][$andamentom[0]['ano']]=0;
					
            
          $datas['projetos'][$i]['documentos']= $grupodocumento_lista;
				  $datas['projetos'][$i]['execucao']= $execucao_lista;
                  $i++;				  
          } // fim for projetos
			 
			$anos = new anosModel();
			$detalhes_anos = $anos->listaanos();
            $datas['anos'] = $detalhes_anos;
			
			$projeto_produto = new projeto_produtoModel();
			
			$i=0;
						
            if ($quadro->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/quadro/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
        }


        public function novom(){
        }


        public function editar(){

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