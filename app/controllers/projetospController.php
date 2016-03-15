
<?php
session_start();
    class projetosp extends Controller{

        public function consultar(){

            $projetos = new projetosModel();

            if ($this->getParam('timeline')!='') {

            $detalhes_projetos = $projetos->listaprojetos('cdprojeto='.$this->getParam('timeline'));
            $datas['projetos'] = $detalhes_projetos;
            $datas['vc'] = $this->modvinculados(get_class($this),$this->getParam('timeline'), $datas['projetos'][0]['intervencao'], $datas['projetos'][0]['cdtipo'] );
            header( "Location: /".PROJETO."/timeline/" );

            } elseif ($this->getParam('questionarios')!='') {

            $detalhes_projetos = $projetos->listaprojetos('cdprojeto='.$this->getParam('questionarios'));
            $datas['projetos'] = $detalhes_projetos;
            $datas['vc'] = $this->modvinculados(get_class($this),$this->getParam('questionarios'), $datas['projetos'][0]['intervencao'], $datas['projetos'][0]['cdtipo'] );
            header( "Location: /".PROJETO."/resposta_projeto/" );

            } elseif ($this->getParam('contratos')!='') {

            $detalhes_projetos = $projetos->listaprojetos('cdprojeto='.$this->getParam('contratos'));
            $datas['projetos'] = $detalhes_projetos;
            $datas['vc'] = $this->modvinculados(get_class($this),$this->getParam('contratos'), $datas['projetos'][0]['intervencao'], $datas['projetos'][0]['cdtipo'] );
            header( "Location: /".PROJETO."/contratos/" );

            } elseif ($this->getParam('checklist')!='') {

            $detalhes_projetos = $projetos->listaprojetos('cdprojeto='.$this->getParam('checklist'));
            $datas['projetos'] = $detalhes_projetos;
            $datas['vc'] = $this->modvinculados(get_class($this),$this->getParam('checklist'), $datas['projetos'][0]['intervencao'], $datas['projetos'][0]['cdtipo'] );
            header( "Location: /".PROJETO."/documento_valor/" );

            } elseif ($this->getParam('ocorrencia')!='') {

            $detalhes_projetos = $projetos->listaprojetos('cdprojeto='.$this->getParam('ocorrencia'));
            $datas['projetos'] = $detalhes_projetos;
            $datas['vc'] = $this->modvinculados(get_class($this),$this->getParam('ocorrencia'), $datas['projetos'][0]['intervencao'], $datas['projetos'][0]['cdtipo'] );
            header( "Location: /".PROJETO."/acao/" );

            }  elseif ($this->getParam('movimentacao')!='') {

            $detalhes_projetos = $projetos->listaprojetos('cdprojeto='.$this->getParam('movimentacao'));
            $datas['projetos'] = $detalhes_projetos;
            $datas['vc'] = $this->modvinculados(get_class($this),$this->getParam('movimentacao'), $datas['projetos'][0]['intervencao'], $datas['projetos'][0]['cdtipo'] );
            header( "Location: /".PROJETO."/movimentacao/" );

            } elseif ($this->getParam('medicao')!='') {

            $detalhes_projetos = $projetos->listaprojetos('cdprojeto='.$this->getParam('medicao'));
            $datas['projetos'] = $detalhes_projetos;
            $datas['vc'] = $this->modvinculados(get_class($this),$this->getParam('medicao'), $datas['projetos'][0]['intervencao'], $datas['projetos'][0]['cdtipo'] );
            header( "Location: /".PROJETO."/medicao/" );

            } else {

            header( "Location: /".PROJETO."/projetos/" );

            }



        }


        public function Index_action(){
            $projetos = new projetosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

           //$projetos_lista = $projetos->listaprojetos("{$par}");
            $lista = array();
            
            if ($this->getParam('id')=='questionarios') {
                $consultar = $projetos->rsql("select distinct p.cdprojeto from projeto p, resposta_projeto a where p.cdprojeto=a.cdprojeto ");
            } elseif ($this->getParam('id')=='checklist') {
                $consultar = $projetos->rsql("select distinct  p.cdprojeto from projeto p, documento_valor a where p.cdprojeto=a.cdprojeto ");
            } elseif ($this->getParam('id')=='contratos') {
                $consultar = $projetos->rsql("select distinct  p.cdprojeto from projeto p, contrato a where p.cdprojeto=a.cdprojeto ");
            } elseif ($this->getParam('id')=='ocorrencia') {
                $consultar = $projetos->rsql("select distinct  p.cdprojeto from projeto p, acao a where p.cdprojeto=a.cdprojeto ");
            } elseif ($this->getParam('id')=='movimentacao') {
                $consultar = $projetos->rsql("select distinct  p.cdprojeto from projeto p, movimentacao a where p.cdprojeto=a.cdprojeto ");
            } elseif ($this->getParam('id')=='timeline') {
                $consultar = $projetos->rsql("select distinct  p.cdprojeto from projeto p, historico a where p.cdprojeto=a.cdprojeto ");
            } else {
                $consultar = $projetos->rsql("select dprojeto from projeto ");
            } 
            
            
            $historico = $projetos->rsql("SELECT cdprojeto FROM historico  where tabela ='Fotos Flickr' GROUP BY cdprojeto");
            $hist = array();
            foreach ($historico as $h) {
              array_push($hist, $h['cdprojeto']);
            }
            foreach ($consultar as $con) {
            $a = $con['cdprojeto'];
            if(in_array($a,$hist)){
                        $aux = $projetos->rsql("select max(cdhistorico) as cdhistorico from historico where tabela ='Fotos Flickr' and cdprojeto =".$a);
                        $b= $aux[0]['cdhistorico'];
                        $conan = $projetos->rsql("SELECT p.*, h.texto, a.nome AS area, a.icone AS icone,  m.nome AS municipio_nome, f.nome AS fase, t.nome AS tipo FROM projeto p 
                                                 LEFT JOIN tipo t ON p.cdtipo = t.cdtipo
                                                  LEFT JOIN area a ON p.cdarea = a.cdarea
                                                  LEFT JOIN historico h ON p.cdprojeto = h.cdprojeto
                                                  LEFT JOIN municipio m ON p.cdmunicipio = m.cdmunicipio
                                                  LEFT JOIN fase f ON p.cdfase = f.cdfase
                                                  WHERE p.cdprojeto = ".$a."
                                                  AND h.cdhistorico = ".$b."
                                                  ORDER BY p.cdprojeto");
                          array_push($lista, $conan);
              }else{
             //   print_r($a); echo "<br>"; 
                 $conan = $projetos->rsql("SELECT p.*, a.nome AS area, a.icone AS icone,  m.nome AS municipio_nome, f.nome AS fase ,t.nome AS tipo FROM projeto p
                                                LEFT JOIN tipo t ON p.cdtipo = t.cdtipo 
                                                  LEFT JOIN area a ON p.cdarea = a.cdarea
                                                  LEFT JOIN municipio m ON p.cdmunicipio = m.cdmunicipio
                                                  LEFT JOIN fase f ON p.cdfase = f.cdfase
                                                  where p.cdprojeto = ".$a."
                                                  ORDER BY p.cdprojeto");
                  array_push($lista, $conan);
             }
            }
        //die();
            

            $datas['op']=$this->getParam('id');

            $datas['projetos'] = $lista;

            if ($projetos->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
               /* if ($datas['projetos'][0]['cdprojeto']=='') {
                    header( "Location: /".PROJETO."/projetos/novo" );
                } elseif ($datas['projetos'][1]['cdprojeto']=='') {
                    header( "Location: /".PROJETO."/projetos/editar/id/".$datas['projetos'][0]['cdprojeto'] );
                } else {*/
                $this->view('/projetosp/index', $datas);
                //}
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $projetos = new projetosModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $programas = new programasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprograma') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_programas = $programas->listaprogramas(" cdprograma in (select cdprograma from produto)");

            $datas['programas'] = $detalhes_programas;
            $municipios = new municipiosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdmunicipio') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_municipios = $municipios->listamunicipios("{$par}");

            $datas['municipios'] = $detalhes_municipios;
            $naturezas = new naturezasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdnatureza') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_naturezas = $naturezas->listanaturezas("{$par}");

            $datas['naturezas'] = $detalhes_naturezas;
            $areas = new areasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdarea') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_areas = $areas->listaareas("{$par}");

            $datas['areas'] = $detalhes_areas;
            $fases = new fasesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfase') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_fases = $fases->listafases("{$par}");

            $datas['fases'] = $detalhes_fases;
            $instituicoes = new instituicoesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdinstituicao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_instituicoes = $instituicoes->listainstituicoes("{$par}");

            $datas['instituicoes'] = $detalhes_instituicoes;
            $tipos = new tiposModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdtipo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            //$detalhes_tipos = $tipos->listatipos("{$par}");
            $detalhes_tipos = $projetos->rsql("select * from tipo where cdtipo in(select cdtipo from fase)");

            $datas['tipos'] = $detalhes_tipos;
            
            $situacao = new situacaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdsituacao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_situacao = $situacao->listasituacao("");

            $datas['situacao'] = $detalhes_situacao;            

            $produtos = new produtosModel();


            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdproduto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $produtos_lista = $produtos->listaprodutos("{$par}");

             $datas['produtos'] = $produtos_lista;



            if ($projetos->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projetos/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $projetos = new projetosModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $programas = new programasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprograma') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_programas = $programas->listaprogramas("{$par}");

             $detalhes_programas = $programas->listaprogramas(" cdprograma in (select cdprograma from produto)");
            $municipios = new municipiosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdmunicipio') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_municipios = $municipios->listamunicipios("{$par}");

            $datas['municipios'] = $detalhes_municipios;
            $naturezas = new naturezasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdnatureza') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_naturezas = $naturezas->listanaturezas("{$par}");

            $datas['naturezas'] = $detalhes_naturezas;
            $areas = new areasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdarea') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_areas = $areas->listaareas("{$par}");

            $datas['areas'] = $detalhes_areas;
            $fases = new fasesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfase') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_fases = $fases->listafases("{$par}");

            $datas['fases'] = $detalhes_fases;
            $instituicoes = new instituicoesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdinstituicao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_instituicoes = $instituicoes->listainstituicoes("{$par}");

            $datas['instituicoes'] = $detalhes_instituicoes;
            $tipos = new tiposModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdtipo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_tipos = $tipos->listatipos("{$par}");

            $datas['tipos'] = $detalhes_tipos;
            
            $situacao = new situacaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdsituacao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_situacao = $situacao->listasituacao("");

            $datas['situacao'] = $detalhes_situacao;  
                        
            if ($projetos->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projetos/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function visualiza(){

            $projetos = new projetosModel();
            $id = $this->getParam('id');
            $fotoprojeto = $projetos->rsql("SELECT texto FROM historico WHERE cdprojeto ='".$id."' AND tabela ='Fotos Flickr' ORDER BY cdhistorico ASC  LIMIT 1 ");
            $detalhes_projetos = $projetos->rsql("
                SELECT p.*,  t.nome AS tipo, s.descricao AS situacao,
                n.nome AS natureza, m.nome AS municipio, a.icone, a.descricao AS area, pg.nome AS programa 
                FROM projeto p
                LEFT OUTER JOIN tipo t ON p.cdtipo=t.cdtipo
                LEFT OUTER JOIN situacao s ON p.cdsituacao=s.cdsituacao
                LEFT OUTER JOIN programa pg ON p.cdprograma=pg.cdprograma
                LEFT OUTER JOIN natureza n ON p.cdnatureza=n.cdnatureza
                LEFT OUTER JOIN municipio m ON p.cdmunicipio=m.cdmunicipio
                LEFT OUTER JOIN area a ON p.cdarea=a.cdarea
                WHERE p.cdprojeto=".$id." 
                LIMIT 1");
            $datas['projetos'] = $detalhes_projetos;
            
            $datas['fotos'] = $fotoprojeto;
            
			$qfases = $projetos->rsql("SELECT f.cdfase, f.nome, count(gd.cdgrupodocumento) as qgrupo from fase f, grupodocumento gd
       where f.cdfase=gd.cdfase and f.cdtipo=".$detalhes_projetos[0]['cdtipo']." group by f.cdfase, f.nome" );
      
      
       $datas['fases'] = $qfases;
      
      $qtdefases=0;
      $totalfases=0;
      $f=0;          
       foreach ( $qfases as $qf) {
       
       if ($qf['qgrupo']>0) {
       
			$lista_check = $projetos->rsql("
         SELECT gd.cdgrupodocumento, gd.cdtipo, count(d.cddocumento) AS documentos, count(dv.valor) AS preenchidos
				 FROM grupodocumento gd, documento d, campo c
				 LEFT JOIN documento_valor dv ON c.cdcampo = dv.cdcampo and dv.cdprojeto=".$id."
				 WHERE gd.cdgrupodocumento = d.cdgrupodocumento AND d.cddocumento = c.cddocumento AND d.obrigatorio = 1 and
				 gd.cdfase=".$qf['cdfase']." 
				 GROUP BY gd.cdgrupodocumento, gd.cdtipo
				 ORDER BY gd.cdgrupodocumento, gd.cdtipo
                "); 
                
     
        
        $qgrupo = $qf['qgrupo'];
        $qgrupook = 0;
        
			   foreach ($lista_check as $check){
				  if ($check['documentos']==$check['preenchidos']) {
				     $qgrupook++;
			      }
		    	}
        
        $totalfases = $totalfases +  (($qgrupook / $qgrupo )*100);
        
        $datas['fases'][$f]['percentual']=(($qgrupook / $qgrupo )*100);
         
         }  
         
         $qtdefases++; 
         $f++;
       	
       }


      
      
      $pe = ( 100 / ($qtdefases+1) ); 
      
     /* print('qtdefases: '.$qtdefases.'<br>');
      print('totalfases: '.$totalfases.'<br>');
      print('pe: '.$pe.'<br>');
      print('qgrupo: '.$qgrupo.'<br>');
      print('qgrupook: '.$qgrupook.'<br>');
      die();*/
      
      if ($qtdefases>0) {
      $datas['check'] = (($totalfases/$qtdefases)*($pe*$qtdefases)/100);
      } else {
      $datas['check'] = 0;      
      }
			
      

		 $datas['peso_contrato'] = $pe;

			
            $detalhes_contratos = $projetos->rsql("
                select c.cdcontrato, c.numero, c.valor, a.fantasia as fornecedor,
                sum(ci.valor) as valor1, sum(ci.quantidade) as qtd1,
                sum(m.valor) as valor2, sum(m.quantidade) as qtd2 
                from contrato c
                left outer join fornecedor a on c.cdfornecedor=a.cdfornecedor
                left outer join contrato_item ci on c.cdcontrato=ci.cdcontrato
                left outer join medicao m on ci.cdcontrato_item=m.cdcontrato_item 
                where c.cdprojeto=".$id." GROUP BY c.cdcontrato, c.numero, c.valor, a.fantasia");
            $datas['contratos'] = $detalhes_contratos;

            $indicadores = $projetos->rsql("
                SELECT 'valor' AS indicador, cdprojeto ,sum(valor) FROM contrato WHERE cdprojeto=".$id." GROUP BY cdprojeto 
                UNION ALL 
                SELECT 'medicao' AS indicador, cdprojeto, count(cdmedicao) FROM medicao  WHERE cdgrupomedicao in (select cdgrupomedicao from grupomedicao where cdprojeto=".$id.") GROUP BY cdprojeto

                ");
            $datas['indicadores'] = $indicadores;

            $andamento = $projetos->rsql("
                SELECT 'contrato' AS andamento, c.cdprojeto , sum(ci.valor) as valor, sum(ci.quantidade) as qtd FROM contrato c, contrato_item ci WHERE c.cdprojeto=".$id." and c.cdcontrato=ci.cdcontrato GROUP BY c.cdprojeto 
                UNION ALL 
                SELECT 'medicao' AS andamento, c.cdprojeto, sum(m.valor) as valor, sum(m.quantidade) as qtd FROM contrato c, contrato_item ci, medicao m WHERE c.cdprojeto=".$id." and c.cdcontrato=ci.cdcontrato and ci.cdcontrato_item=m.cdcontrato_item GROUP BY c.cdprojeto 

                ");
            $datas['andamento'] = $andamento;

            $acao = new acaoModel();

            $acao_lista = $acao->listaacao("cdprojeto=".$id);

            $datas['ocorrencias'] = $acao_lista;




            if ($_SESSION[PROJETO]['flickr_chave']!='') {
                require_once("phpFlickr.php");
                $f = new phpFlickr($_SESSION[PROJETO]['flickr_chave'],$_SESSION[PROJETO]['flickr_sec']); 
            }
            $projetos_lista = $projetos->rsql("SELECT * FROM historico WHERE cdprojeto ='".$id."' ORDER BY cdhistorico DESC");
            foreach ($projetos_lista as $condet){
                if($condet['tabela']=='projeto' && $condet['tipo']=='I'){
                  $consulta = $projetos->rsql("SELECT flicker FROM projeto WHERE cdprojeto =".$condet['cdprojeto']);
                    if ($consulta[0]['flicker']!=null){
                         $fotos = $f->photosets_getPhotos($consulta[0]['flicker']);    
                                            foreach($fotos['photoset']['photo'] as $foto){

                                                $infofoto=$f->photos_getInfo($foto[id]);

                                                $array=Array($infofoto);
                                                         
                                                       for ($i=0;$i<count($array);$i++){
                                                        //$inseri=$projetos->rsql('');
                                                        $datahora=$array[$i]['photo']['dates']['taken'];
                                                        $datahora = date('d/m/Y', strtotime($datahora));

                                                        $idfoto=$array[$i]['photo']['id'];
                                                        
                                                        $batata=$idfoto.','.$array[$i]['photo']['server'].','.$array[$i]['photo']['secret'].','.$array[$i]['photo']['farm'].','.$array[$i]['photo']['title'];
                                                        $verifica = $projetos->rsql("select descricao from historico where descricao='".$idfoto."'");
                                                        $verifica2 = $projetos->rsql("select datahora from historico where datahora='".$datahora."'");
                                                        if($verifica[0]['descricao']==null && $verifica2[0]['datahora']==null){
                                                        $inseri="insert into historico (tabela, descricao, datahora,texto,cdprojeto,cdusuario,tipo) values('Fotos Flickr','".$idfoto."','".$datahora."','".$batata."',".$id.",'0','I')";
                                                        $inseri=$projetos->rsql($inseri);
                                                        } 

                                                      }

                                                }
                                             
                                            }
                }
            }


          
            $datas['teste'] = $projetos_lista; 
            //$datas['foto'] =$fotoprojeto;




            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['projetos'][0]['intervencao'], $datas['projetos'][0]['cdtipo'] );


            if ($projetos->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projetos/visualiza', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }


        public function editar(){

            $projetos = new projetosModel();
            $id = $this->getParam('id');
            $detalhes_projetos = $projetos->listaprojetos('cdprojeto='.$id);
            $datas['projetos'] = $detalhes_projetos;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['projetos'][0]['intervencao'], $datas['projetos'][0]['cdtipo'] );
            $programas = new programasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprograma') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_programas = $programas->listaprogramas("{$par}");

            $datas['programas'] = $detalhes_programas;
            $municipios = new municipiosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdmunicipio') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_municipios = $municipios->listamunicipios("{$par}");

            $datas['municipios'] = $detalhes_municipios;
            $naturezas = new naturezasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdnatureza') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_naturezas = $naturezas->listanaturezas("{$par}");

            $datas['naturezas'] = $detalhes_naturezas;
            $areas = new areasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdarea') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_areas = $areas->listaareas("{$par}");

            $datas['areas'] = $detalhes_areas;
            $fases = new fasesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfase') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_fases = $fases->listafases("{$par}");

            $datas['fases'] = $detalhes_fases;
            $instituicoes = new instituicoesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdinstituicao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_instituicoes = $instituicoes->listainstituicoes("{$par}");

            $datas['instituicoes'] = $detalhes_instituicoes;
            $tipos = new tiposModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdtipo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_tipos = $tipos->listatipos("");

            $datas['tipos'] = $detalhes_tipos;
            
            $situacao = new situacaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdsituacao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_situacao = $situacao->listasituacao("{$par}");

            $datas['situacao'] = $detalhes_situacao;              

            $clientes = new clientesModel();
            $detalhes_clientes = $clientes->listaclientes("cdcliente=".$_SESSION[PROJETO]['cdcliente']);

            $datas['clientes']['flickr_chave'] = $detalhes_clientes[0]['flickr_chave'];
            $datas['clientes']['flickr_sec'] = $detalhes_clientes[0]['flickr_sec'];
            $datas['clientes']['flickr_usuario'] = $detalhes_clientes[0]['flickr_usuario'];

            if ($projetos->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projetos/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $projetos = new projetosModel();
            $dados=$_POST;
            $atualiza = $projetos->atualizaprojetos($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/projetos/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/projetos/visualiza/id/".$id);

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $projetos = new projetosModel();  
            $projeto_produto = new projeto_produtoModel();
            $projeto_fonte = new projeto_fonteModel();
            $projeto_quadro = new projeto_quadroModel();
            $projeto_objetivo = new projeto_objetivoModel();
            $resposta_projeto = new resposta_projetoModel();
            $documento_valor = new documento_valorModel();
            $contratos = new contratosModel();
            $aditivos = new aditivosModel();
            $contrato_item = new contrato_itemModel();
            $contrato_previsao = new contrato_previsaoModel();
            $grupomedicao = new grupomedicaoModel();
            $medicao = new medicaoModel();
            $acao = new acaoModel();
            $movimentacao = new movimentacaoModel();
            $historico = new historicoModel();
            
            
            

            $detalhes_projeto_produto = $projeto_produto->listaprojeto_produto("cdprojeto=".$id);
            if ($detalhes_projeto_produto[0]['cdprojeto']!='') {
               $atualiza = $projeto_produto->excluiprojeto_produto( 'cdprojeto='.$id );
            }
            
            $detalhes_projeto_fonte = $projeto_fonte->listaprojeto_fonte("cdprojeto=".$id);
            if ($detalhes_projeto_fonte[0]['cdprojeto']!='') {
               $atualiza = $projeto_fonte->excluiprojeto_fonte( 'cdprojeto='.$id );
            }            
            
            $detalhes_projeto_quadro = $projeto_quadro->listaprojeto_quadro("cdprojeto=".$id);
            if ($detalhes_projeto_quadro[0]['cdprojeto']!='') {
               $atualiza = $projeto_quadro->excluiprojeto_quadro( 'cdprojeto='.$id );
            }
            
            $detalhes_projeto_objetivo = $projeto_objetivo->listaprojeto_objetivo("cdprojeto=".$id);
            if ($detalhes_projeto_objetivo[0]['cdprojeto']!='') {
               $atualiza = $projeto_objetivo->excluiprojeto_objetivo( 'cdprojeto='.$id );
            }                        
            
            $detalhes_resposta_projeto = $resposta_projeto->listaresposta_projeto("cdprojeto=".$id);
            if ($detalhes_resposta_projeto[0]['cdprojeto']!='') {
               $atualiza = $resposta_projeto->excluiresposta_projeto( 'cdprojeto='.$id );
            }              

            $detalhes_documento_valor = $documento_valor->listadocumento_valor("cdprojeto=".$id);
            if ($detalhes_documento_valor[0]['cdprojeto']!='') {
               $atualiza = $documento_valor->excluidocumento_valor( 'cdprojeto='.$id );
            }
            
            $detalhes_historico = $historico->listahistorico("cdprojeto=".$id);
            if ($detalhes_historico[0]['cdprojeto']!='') {
               $atualiza = $historico->excluihistorico( 'cdprojeto='.$id );
            }
            
            $detalhes_contratos = $contratos->listacontratos("cdprojeto=".$id);
            if ($detalhes_contratos[0]['cdprojeto']!='') {

                $atualiza = $contrato_item->excluicontrato_item( 'cdcontrato in (select cdcontrato from contrato where cdprojeto='.$id.' )' );
                $atualiza = $contrato_previsao->excluicontrato_previsao( 'cdcontrato_item in (select ci.cdcontrato_item from contrato c, contrato_item ci where c.cdcontrato=ci.cdcontrato and c.cdprojeto='.$id.' )' );
                $atualiza = $aditivos->excluiaditivos( 'cdcontrato in (select cdcontrato from contrato where cdprojeto='.$id.' )' );
                $atualiza = $contratos->excluicontratos( 'cdprojeto='.$id );               
                           
            }
            
            
            $detalhes_grupomedicao = $grupomedicao->listagrupomedicao("cdprojeto=".$id);
            if ($detalhes_grupomedicao[0]['cdprojeto']!='') {
                $atualiza = $medicao->excluimedicao( 'cdgrupomedicao in (select cdgrupomedicao from grupomedicao where cdprojeto='.$id.' )' );            
                $atualiza = $grupomedicao->excluigrupomedicao( 'cdprojeto='.$id );
            }
            
            $detalhes_acao = $acao->listaacao("cdprojeto=".$id);
            if ($detalhes_acao[0]['cdprojeto']!='') {
               $atualiza = $acao->excluiacao( 'cdprojeto='.$id );
            }
            
            $detalhes_movimentacao = $movimentacao->listamovimentacao("cdprojeto=".$id);
            if ($detalhes_movimentacao[0]['cdprojeto']!='') {
               $atualiza = $movimentacao->excluimovimentacao( 'cdprojeto='.$id );
            }            
                                                                        
            $atualiza = $projetos->excluiprojetos( 'cdprojeto='.$id );
            
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($projetos->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/projetos/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $projetos = new projetosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $programas = new programasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprograma') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_programas = $programas->listaprogramas("{$par}");

            $datas['programas'] = $detalhes_programas;
            $municipios = new municipiosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdmunicipio') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_municipios = $municipios->listamunicipios("{$par}");

            $datas['municipios'] = $detalhes_municipios;
            $naturezas = new naturezasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdnatureza') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_naturezas = $naturezas->listanaturezas("{$par}");

            $datas['naturezas'] = $detalhes_naturezas;
            $areas = new areasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdarea') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_areas = $areas->listaareas("{$par}");

            $datas['areas'] = $detalhes_areas;
            $fases = new fasesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfase') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_fases = $fases->listafases("{$par}");

            $datas['fases'] = $detalhes_fases;
            $instituicoes = new instituicoesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdinstituicao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_instituicoes = $instituicoes->listainstituicoes("{$par}");

            $datas['instituicoes'] = $detalhes_instituicoes;
            $tipos = new tiposModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdtipo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_tipos = $tipos->listatipos("{$par}");

            $datas['tipos'] = $detalhes_tipos;
            
            $situacao = new situacaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdsituacao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_situacao = $situacao->listasituacao("");

            $datas['situacao'] = $detalhes_situacao;  
                        
            if ($projetos->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projetos/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $projetos = new projetosModel();
            $insere = $projetos->insereprojetos($_POST, 'cdprojeto');

            //historico    

            $consulta = $contratos->listacontratos('cdprojeto='.$insere);
            $texto = '<b>Intervenção: </b>'.$consulta[0]['intervencao'].'<br/> <b> Objetivo: </b>'.$consulta[0]['objetivo'].'<br/> <b> Endereço: </b>'.$consulta[0]['endereco'];
            $historico = new historicoModel();
            $dataHora = date("d/m/Y h:i:s");
            $dados_historico['tabela']='projeto';
            $dados_historico['descricao']=$consulta[0]['cdprojeto'];
            $dados_historico['datahora']=$dataHora;
            $dados_historico['cdprojeto']=$_SESSION[filtro]['cdprojeto'];
            $dados_historico['texto']= $texto;
            $dados_historico['cdusuario']=$_SESSION[PROJETO]['cdusuario'];
            $dados_historico['tipo']='I';
            $insere = $historico->inserehistorico($dados_historico, 'cdhistorico');

            //fim historico

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/projetos/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/projetos/" );
            }

        }


        public function inserem( Array $dados = null ){
            $projetos = new projetosModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['intervencao'][0])) {
                $i=0;
                foreach ($dados['intervencao'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_projetos[$key]=$dados[$key][$i];
                    }
                    $insere = $projetos->insereprojetos($dados_projetos,'cdprojeto');
                    $i++;
                }

            }

           if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso. Registros inseridos.';
            }

            header( "Location: /".PROJETO."/projetos/" );


        }


        public function inserew(){
            $projetos = new projetosModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='projeto') {
                    $dados['projeto'][$p[1]]=$value;
                }
            }
            
            $dados['projeto']['cdarea']=$_POST['cdarea'];

            $inserep = $projetos->insereprojetos($dados['projeto'], 'cdprojeto');

           $projeto_produto = new projeto_produtoModel();

 
            $dados_['projeto_produto']['cdprojeto']=$inserep;
            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='projeto_produto') {
                    $dados['projeto_produto'][$p[1]]=$value;
                }
            }
            $i=0;
            foreach ($dados['projeto_produto']['cdproduto']  as $key2 => $value2) {

            foreach ($dados['projeto_produto'] as $key2 => $value2) {
                        $dados_['projeto_produto'][$key2]=$dados['projeto_produto'][$key2][$i];
            }

            $insere = $projeto_produto->insereprojeto_produto($dados_['projeto_produto'], 'cdproduto');
            $i++;
            }




            if ($inserep==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
            //historico        
            $consulta = $projetos->listaprojetos('cdprojeto='.$inserep);
            $texto = '<b>Intervenção: </b>'.$consulta[0]['intervencao'].'<br/> <b> Objetivo: </b>'.$consulta[0]['objetivo'].'<br/> <b> Endereço: </b>'.$consulta[0]['endereco'];
            $historico = new historicoModel();
            $dataHora = date("d/m/Y h:i:s");
            $dados_historico['tabela']='projeto';
            $dados_historico['descricao']=$inserep;
            $dados_historico['datahora']=$dataHora;
            $dados_historico['cdprojeto']=$inserep;
            $dados_historico['texto']= $texto;
            $dados_historico['cdusuario']=$_SESSION[PROJETO]['cdusuario'];
            $dados_historico['tipo']='I';
            $insereh = $historico->inserehistorico($dados_historico, 'cdhistorico');

            //fim historico

              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/projetos/visualiza/id/".$inserep);


        }

        public function pesquisa(){
            $projetos = new projetosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $programas = new programasModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprograma') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $municipios = new municipiosModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdmunicipio') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $naturezas = new naturezasModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdnatureza') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $areas = new areasModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdarea') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $fases = new fasesModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfase') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $instituicoes = new instituicoesModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdinstituicao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $tipos = new tiposModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdtipo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }$filtro='';
            $w='';
            foreach ($_POST as $key => $value) {
                    if ( ($key!="submit") and ($value!="")) {
                              $vop='';
                              if (is_array($value)) { $value=implode( ',' , $value); }
                         if (substr($key, 1, 1)=="1") { $op=" >= "; } elseif (substr($key, 1, 1)=="2") { $op=" <= "; } elseif (substr($key, 1, 1)=="3") { $op=" in "; $vop=" Esteja em "; } else { $op=" = "; }
                        if (substr($key, 0, 1)=="s"){
                            $vop=' Contenha ';
                            $w .= ($w=="") ? "upper(".substr($key, 2).") like upper("."'%".$value."%')" : " and upper(".substr($key, 2).") like upper("."'%".$value."%')" ;
                        } else if (substr($key, 0, 1)=="d") {
                            $w .= ($w=="") ? substr($key, 2).$op."'".$value."'" : " and ".substr($key, 2).$op."'".$value."'" ;
                        } else if (substr($key, 0, 1)=="i") {
                            $w .= ($w=="") ? substr($key, 2).$op.$value : " and ".substr($key, 2).$op.$value ;
                        } else if (substr($key, 0, 1)=="m") {
                            $val = str_replace(",", "','", $value);
                            $w .= ($w=="") ? substr($key, 2).$op."('".$val."')" : " and ".substr($key, 2).$op."('".$val."')" ;
                        }
                          if ($vop!='') {$op=$vop;}
                          $filtro .= '<br>'.substr($key, 2).$op.$value;

                    }
                }
            if ($w!='') { if ($par!='') { $w.=' and '.$par; } }
            else { if ($par!='') {$w=$par;} }
            
            if ($w!='') { $w = ' where '.$w;} 
            

            //$pesquisa = $projetos->pesquisaprojetos($w);
            
                                    
            //$projetos_lista = $projetos->listaprojetos("{$par}");
            $lista = array();
            $consultar = $projetos->rsql("select cdprojeto from projeto".$w);
            $historico = $projetos->rsql("SELECT cdprojeto FROM historico ".$w." GROUP BY cdprojeto");
            $hist = array();
            foreach ($historico as $h) {
              array_push($hist, $h['cdprojeto']);
            }
            foreach ($consultar as $con) {
            $a = $con['cdprojeto'];
            if(in_array($a,$hist)){
                        $aux = $projetos->rsql("select max(cdhistorico) as cdhistorico from historico where tabela='Fotos Flickr' and cdprojeto =".$a);
                        $b= $aux[0]['cdhistorico'];
                        $conan = $projetos->rsql("SELECT p.*, h.texto, a.nome AS area, a.icone AS icone,  m.nome AS municipio_nome, f.nome AS fase, t.nome AS tipo FROM projeto p 
                                                 LEFT JOIN tipo t ON p.cdtipo = t.cdtipo
                                                  LEFT JOIN area a ON p.cdarea = a.cdarea
                                                  LEFT JOIN historico h ON p.cdprojeto = h.cdprojeto
                                                  LEFT JOIN municipio m ON p.cdmunicipio = m.cdmunicipio
                                                  LEFT JOIN fase f ON p.cdfase = f.cdfase
                                                  WHERE p.cdprojeto = ".$a."
                                                  AND h.cdhistorico = ".$b."
                                                  ORDER BY p.cdprojeto");
                          array_push($lista, $conan);
              }else{
                 $conan = $projetos->rsql("SELECT p.*, a.nome AS area, a.icone AS icone,  m.nome AS municipio_nome, f.nome AS fase ,t.nome AS tipo FROM projeto p
                                                LEFT JOIN tipo t ON p.cdtipo = t.cdtipo 
                                                  LEFT JOIN area a ON p.cdarea = a.cdarea
                                                  LEFT JOIN municipio m ON p.cdmunicipio = m.cdmunicipio
                                                  LEFT JOIN fase f ON p.cdfase = f.cdfase
                                                  where p.cdprojeto = ".$a."
                                                  ORDER BY p.cdprojeto");
                  array_push($lista, $conan);
             }
            }
            $datas['op']=$this->getParam('id');

            $datas['projetos'] = $lista;            
            
            
            
            
            //$datas['projetos'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/projetos/index', $datas);

    }
    
    
    
    
      public function carregaproduto(){

           
            $projetos = new projetosModel();
            $id = $this->getParam('id');
            $detalhes_projetos = $projetos->rjs("
                select * from produto where cdprograma=".$id);
            echo $detalhes_projetos;
            


        }


}
