
<?php
session_start();
    class mapas extends Controller{

function cor() {
$cor = array ( 
   '0'  => '#1E90FF', 
 '1'  => '#00BFFF', 
 '2'  => '#87CEEB', 
 '3'  => '#87CEFA', 
 '4'  => '#4682B4', 
 '5'  => '#B0C4DE', 
 '6'  => '#ADD8E6', 
 '7'  => '#B0E0E6', 
 '8'  => '#AFEEEE', 
 '9'  => '#00CED1', 
 '10'  => '#48D1CC', 
 '11'  => '#40E0D0', 
 '12'  => '#00FFFF', 
 '13'  => '#5F9EA0', 
 '14'  => '#66CDAA', 
 '15'  => '#7FFFD4', 
 '16'  => '#006400', 
 '17'  => '#556B2F', 
 '18'  => '#8FBC8F', 
 '19'  => '#2E8B57', 
 '20'  => '#3CB371', 
 '21'  => '#20B2AA', 
 '22'  => '#98FB98', 
 '23'  => '#00FF7F', 
 '24'  => '#7CFC00', 
 '25'  => '#00FF00', 
 '26'  => '#7FFF00', 
 '27'  => '#00FA9A', 
 '28'  => '#ADFF2F', 
 '29'  => '#32CD32', 
 '30'  => '#9ACD32', 
 '31'  => '#228B22', 
 '32'  => '#6B8E23', 
 '33'  => '#BDB76B', 
 '34'  => '#EEE8AA', 
 '35'  => '#FAFAD2', 
 '36'  => '#FFFFE0', 
 '37'  => '#FFFF00', 
 '38'  => '#FFD700', 
 '39'  => '#EEDD82', 
 '40'  => '#DAA520', 
 '41'  => '#B8860B', 
 '42'  => '#7FFF00', 
 '43'  => '#CD5C5C', 
 '44'  => '#8B4513', 
 '45'  => '#A0522D', 
 '46'  => '#CD853F', 
 '47'  => '#DEB887', 
 '48'  => '#F5F5DC', 
 '49'  => '#F5DEB3', 
 '50'  => '#F4A460', 
 '51'  => '#D2B48C', 
 '52'  => '#D2691E', 
 '53'  => '#B22222', 
 '54'  => '#A52A2A', 
 '55'  => '#E9967A', 
 '56'  => '#FA8072', 
 '57'  => '#FFA07A', 
 '58'  => '#FFA500', 
 '59'  => '#FF8C00', 
 '60'  => '#FF7F50', 
 '61'  => '#F08080', 
 '62'  => '#FF6347', 
 '63'  => '#FF4500', 
 '64'  => '#FF0000', 
 '65'  => '#6495ED', 
 '66'  => '#483D8B', 
 '67'  => '#6A5ACD', 
 '68'  => '#7B68EE', 
 '69'  => '#8470FF', 
 '70'  => '#696969', 
 '71'  => '#708090', 
 '72'  => '#778899', 
 '73'  => '#BEBEBE'); 

 return $cor[array_rand($cor)];
}

        public function Index_action(){

            
            $id = $this->getParam('id');
            $modal = $this->getParam('p');
            if ($id!='') {
            $_SESSION[PROJETO]['clientemapa']=$id;    
            } 
            
          
            $datas['modal'] =$modal;


            $projetos = new projetosmapaModel();

            $layoutmapa = new layoutmapamapaModel();

            $programas = new programasmapaModel();
            $detalhes_programas = $programas->listaprogramas();
            $datas['programas'] = $detalhes_programas;

            $municipios = new municipiosmapaModel();
            $detalhes_municipios = $municipios->listamunicipios();
            $datas['municipios'] = $detalhes_municipios;

            $naturezas = new naturezasmapaModel();
            $detalhes_naturezas = $naturezas->listanaturezas();
            $datas['naturezas'] = $detalhes_naturezas;

            $areas = new areasmapaModel();
            $detalhes_areas = $areas->listaareas();
            $datas['areas'] = $detalhes_areas;

            $fases = new fasesmapaModel();
            $detalhes_fases = $fases->listafases();
            $datas['fases'] = $detalhes_fases;

            $instituicoes = new instituicoesmapaModel();
            $detalhes_instituicoes = $instituicoes->listainstituicoes();
            $datas['instituicoes'] = $detalhes_instituicoes;

            $tipos = new tiposmapaModel();
            $detalhes_tipos = $tipos->listatipos();
            $datas['tipos'] = $detalhes_tipos;


            $clientes = new clientesModel();
            $detalhes_clientes = $clientes->listaclientes("sigla='{$id}'");
            $datas['css'] = PROJETO.$detalhes_clientes[0]['cdlayoutmapa'];
            $cdlay = $detalhes_clientes[0]['cdlayoutmapa'];
            $cor_mapa = $layoutmapa->listalayoutmapa("cdlayoutmapa='{$cdlay}'");
            $datas['cormapa'] = $cor_mapa[0]['fundo_mapa'];
            $datas['cliente'] = $detalhes_clientes;
			      $_SESSION[PROJETO]['m_flickr_chave']=$detalhes_clientes[0]['flickr_chave'];
			      $_SESSION[PROJETO]['m_flickr_sec']=$detalhes_clientes[0]['flickr_sec'];
            
            $datas['mapacliente'] =$id;

            $w='';
            $filtro='';
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


          //  $projetos_lista = $projetos->listaprojetos($w);
                $projetos_lista = $projetos->rsql("SELECT p.*, a.* FROM projeto p 
												   LEFT OUTER JOIN area a ON p.cdarea=a.cdarea");
                $lista_galeria = $projetos->rsql("SELECT p.*, h.texto, f.nome AS fase_nome, m.nome AS municipio_nome, a.nome AS area_nome FROM projeto p 
LEFT JOIN historico h ON p.cdprojeto = h.cdprojeto 
JOIN fase f ON p.cdfase = f.cdfase 
JOIN municipio m ON p.cdmunicipio = m.cdmunicipio
JOIN area a ON p.cdarea = a.cdarea
");


            $datas['projetos'] = $projetos_lista;

            $consultas = new consultasModel();


            $detalhes_consultas = $consultas->rsql("select * from consulta where cdcliente=".$detalhes_clientes[0]['cdcliente']." and tipo like '%3%'");
           
            $datas['consultas'] = $detalhes_consultas;

            $datas['listagaleria'] = $lista_galeria;

            $_SESSION[PROJETO]['mgrafico']='';


                    $u=0;
            foreach ($detalhes_consultas as $key => $value) {
                if ($datas['consultas'][$u]['cdconsulta']!='') {
                        $infconsulta = $this->gera_consulta_publica($datas['consultas'][$u]['cdconsulta']);
                        $datas['consultas'][$u]['consulta']= $infconsulta;
                }
                  $u++;
             }
             
             
             
$rodape2 = '
    </section>

    </div>
    </div>
    </div>
    </div>
    </section>
    </div>
    

    <script src="/'.PROJETO.'/inc/plugins/jquery-1.11.1.min.js"></script>
    <script src="/'.PROJETO.'/inc/bootstrap/js/bootstrap.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.slimscroll.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.easing.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/appear/jquery.appear.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.placeholder.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/fastclick.js"></script>
    <script src="/'.PROJETO.'/inc/js/offscreen.js"></script>
    <script src="/'.PROJETO.'/inc/js/main.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/chosen/chosen.jquery.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/'.PROJETO.'/inc/js/bootstrap-datatables.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.sortable.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.nestable.js"></script>
    <script src="/'.PROJETO.'/inc/js/table-edit.js"></script>
    <script src="/'.PROJETO.'/inc/js/script_dm.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/icheck/icheck.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/parsley.min.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/jquery.maskedinput.min.js"></script>
    <script src="/'.PROJETO.'/inc/js/form-masks.js"></script>
    <script src="/'.PROJETO.'/inc/js/general.js"></script>



    <script src="/'.PROJETO.'/inc/plugins/isotope/isotope.pkgd.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/imagesloaded/imagesloaded.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/superbox/superbox.min.js"></script>

    <script src="/'.PROJETO.'/inc/js/gallery.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/dropzone/dropzone.js"></script>

 <!-- page level scripts -->
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.categories.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.stack.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.time.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.orderBars.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.pie.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.sparkline.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.easing.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/easy-pie-chart/jquery.easypiechart.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/raphael.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/morris/morris.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/chartjs/Chart.min.js"></script>
    </body>
<!-- /body -->
</html>';
    
             $datas['rodape']=$rodape2;             
             
             

            $this->view('/mapas/index', $datas);
    }
    
    
    
    
    

       public function teste(){

            $projetos = new projetosmapaModel();

          //  $projetos_lista = $projetos->listaprojetos($w);
            $lista = array();
            $consultar = $projetos->rsql("select cdprojeto from projeto");
            $historico = $projetos->rsql("SELECT cdprojeto FROM historico GROUP BY cdprojeto");
            $hist = array();
            foreach ($historico as $h) {
              array_push($hist, $h['cdprojeto']);
            }
            foreach ($consultar as $con) {
            $a = $con['cdprojeto'];
            if(in_array($a,$hist)){
                        $aux = $projetos->rsql("select max(cdhistorico) as cdhistorico from historico where cdprojeto =".$a);
                        $b= $aux[0]['cdhistorico'];
                        $conan = $projetos->rsql("SELECT p.*, h.texto, a.nome AS area_nome, m.nome AS municipio_nome, f.nome AS fase_nome  FROM projeto p 
                                                  LEFT JOIN area a ON p.cdarea = a.cdarea
                                                  left join historico h on p.cdprojeto = h.cdprojeto
                                                  LEFT JOIN municipio m ON p.cdmunicipio = m.cdmunicipio
                                                  LEFT JOIN fase f ON p.cdfase = f.cdfase
                                                  where p.cdprojeto = ".$a."
                                                  and h.cdhistorico = ".$b."
                                                  ORDER BY p.cdprojeto");
                          array_push($lista, $conan);
              }else{
                 $conan = $projetos->rsql("SELECT p.*, a.nome AS area_nome, m.nome AS municipio_nome, f.nome AS fase_nome  FROM projeto p 
                                                  LEFT JOIN area a ON p.cdarea = a.cdarea
                                                  LEFT JOIN municipio m ON p.cdmunicipio = m.cdmunicipio
                                                  LEFT JOIN fase f ON p.cdfase = f.cdfase
                                                  where p.cdprojeto = ".$a."
                                                  ORDER BY p.cdprojeto");
                  array_push($lista, $conan);
             }
            }



            $datas['listagaleria'] = $lista;

            $this->view('/mapas/lista', $datas);
    }

public function galeria(){

            $projetos = new projetosmapaModel();

          //  $projetos_lista = $projetos->listaprojetos($w);
           
            $lista = $projetos->rsql("SELECT h.cdhistorico, 
h.tabela, 
h.descricao, 
h.datahora, 
h.cdprojeto, 
h.texto, 
p.* 
FROM  historico h 
LEFT JOIN projeto p ON h.cdprojeto=p.cdprojeto 
WHERE h.tabela = 'Fotos Flickr'");



            $datas['galeria'] = $lista;

            $this->view('/mapas/galeria', $datas);
    }

    //caij
        public function visualiza(){

            $projetos = new projetosmapaModel();
            $id = $this->getParam('id');
            $projeto = $this->getParam('projeto');
            $detalhes_projetos = $projetos->rsql("
                SELECT p.*, 
                a.nome AS area, 
                a.icone, 
                t.nome AS tipo, 
                f.descricao AS situacao,
                n.nome AS natureza,
                m.nome AS municipio, 
                pr.descricao AS programa
                FROM projeto p
                LEFT OUTER JOIN area a ON p.cdarea=a.cdarea
                LEFT OUTER JOIN tipo t ON p.cdtipo=t.cdtipo
                LEFT OUTER JOIN situacao f ON p.cdsituacao=f.cdsituacao
                LEFT OUTER JOIN natureza n ON p.cdnatureza=n.cdnatureza
                LEFT OUTER JOIN municipio m ON p.cdmunicipio=m.cdmunicipio
                LEFT OUTER JOIN programa pr ON p.cdprograma=pr.cdprograma
                WHERE p.cdprojeto=".$projeto." LIMIT 1");
            $datas['projetos'] = $detalhes_projetos;

            $aux = $projetos->rsql("select max(cdhistorico) as cdhistorico from historico where tabela ='Fotos Flickr' and cdprojeto =". $projeto );
            $b= $aux[0]['cdhistorico'];

            $fotoprojeto= $projetos->rsql("select * from historico where cdhistorico =".$b);

            $datas['fotoexibe'] = $fotoprojeto;

            $arfotos =array();

            $fkl = $projetos->rsql("select flicker from projeto where cdprojeto =". $projeto );
            $fkl= $fkl[0]['flicker'];



            $detalhes_historico = $projetos->rsql("SELECT * FROM historico WHERE cdprojeto =".$projeto);
            $datas['historico'] = $fkl;

            $detalhes_contratos = $projetos->rsql("
                select c.cdcontrato, c.numero, c.valor, a.fantasia as fornecedor,
                sum(ci.valor) as valor1, sum(ci.quantidade) as qtd1,
                sum(m.valor) as valor2, sum(m.quantidade) as qtd2 
                from contrato c
                left outer join fornecedor a on c.cdfornecedor=a.cdfornecedor
                left outer join contrato_item ci on c.cdcontrato=ci.cdcontrato
                left outer join medicao m on ci.cdcontrato_item=m.cdcontrato_item 
                where c.cdprojeto=".$projeto." GROUP BY c.cdcontrato, c.numero, c.valor, a.fantasia");
            $datas['contratos'] = $detalhes_contratos;

            $indicadores = $projetos->rsql("
                SELECT 'valor' AS indicador, cdprojeto ,sum(valor) FROM contrato WHERE cdprojeto=".$projeto." GROUP BY cdprojeto 
                UNION ALL 
                SELECT 'medicao' AS indicador, cdprojeto, count(cdmedicao) FROM medicao  WHERE cdprojeto=".$projeto." GROUP BY cdprojeto

                ");
            $datas['indicadores'] = $indicadores;

            $andamento = $projetos->rsql("
                SELECT 'contrato' AS andamento, c.cdprojeto , sum(ci.valor) as valor, sum(ci.quantidade) as qtd FROM contrato c, contrato_item ci WHERE c.cdprojeto=".$projeto." and c.cdcontrato=ci.cdcontrato GROUP BY c.cdprojeto 
                UNION ALL 
                SELECT 'medicao' AS andamento, c.cdprojeto, sum(m.valor) as valor, sum(m.quantidade) as qtd FROM contrato c, contrato_item ci, medicao m WHERE c.cdprojeto=".$projeto." and c.cdcontrato=ci.cdcontrato and ci.cdcontrato_item=m.cdcontrato_item GROUP BY c.cdprojeto 

                ");
            $datas['andamento'] = $andamento;

            $acao = new acaomapaModel();

            $acao_lista = $acao->listaacao("cdprojeto=".$projeto);

            $datas['ocorrencias'] = $acao_lista;




            if ($_SESSION[PROJETO]['m_flickr_chave']!='') {
                require_once("phpFlickr.php");
                $f = new phpFlickr($_SESSION[PROJETO]['m_flickr_chave'],$_SESSION[PROJETO]['m_flickr_sec']); 
            }
            $arrayfotos= array();
          // consulta ordem;
            $projetos_lista = $projetos->rsql("SELECT CAST(cdprojeto AS TEXT) AS cd, to_char(datahora, 'DD/MM/YYYY') AS datahora, 'projeto' AS tabela FROM projeto WHERE cdprojeto ='".$projeto."'
                        UNION ALL 
                        SELECT CAST(cdcontrato AS TEXT) AS cd, to_char(datahora, 'DD/MM/YYYY') AS datahora, 'contrato' AS tabela FROM contrato WHERE cdprojeto ='".$projeto."'
                        UNION ALL 
                        SELECT CAST(cdcontrato_item AS TEXT) AS cd, to_char(ci.datahora, 'DD/MM/YYYY'), 'contrato_item' AS tabela FROM contrato_item ci 
                        JOIN contrato c ON ci.cdcontrato= c.cdcontrato  WHERE c.cdprojeto = '".$projeto."'
                       UNION ALL 
                       SELECT CAST(texto AS TEXT) AS cd, datahoras , 'historico' AS tabela FROM foto_flickr WHERE cdprojeto='".$projeto."'
                       UNION ALL
                       SELECT CAST(cdmovimentacao AS TEXT) AS cd, to_char(datahora, 'DD/MM/YYYY') AS datahora, 'movimentacao' AS tabela FROM movimentacao WHERE cdprojeto='".$projeto."'

                       ORDER BY 2 DESC");
            $sql = array();
           $textoarray = array();
            foreach ($projetos_lista as $pj){
                    // consulta detalhes
                if($pj[tabela]=='historico'){
                    $condetalhes ="SELECT *, 'Fotos Flickr' AS tabela FROM foto_flickr WHERE texto='".$pj[cd]."'";
                }else{
                 $condetalhes = "select '".$pj[tabela]."' as tabela, to_char(datahora, 'DD/MM/YYYY') AS datahoras,* from ".$pj[tabela]." where cd".$pj[tabela]."=".$pj[cd];
                 }
                 $c = $projetos->rsql($condetalhes);
                 $sql[]=$c;
            }
           if ($_SESSION[PROJETO]['m_flickr_chave']!='') {
            foreach ($c as $condet){
                if($condet['tabela']=='projeto'){
                    if ($condet['flicker']!=null){
                         $fotos = $f->photosets_getPhotos($condet[flicker]);    
                                            foreach($fotos['photoset']['photo'] as $foto){
                                                $infofoto=$f->photos_getInfo($foto[id]);
                                                $array=Array($infofoto);
                                                       
                                                       for ($i=0;$i<count($array);$i++){
                                                        //$inseri=$projetos->rsql('');
                                                        $datahora=$array[$i]['photo']['dates']['taken'];
                                                        $idfoto=$array[$i]['photo']['id'];
                                                        $batata=$idfoto.','.$array[$i]['photo']['server'].','.$array[$i]['photo']['secret'].','.$array[$i]['photo']['farm'].','.$array[$i]['photo']['title'];
                                                        $verifica = $projetos->rsql("select descricao from historico where descricao='".$idfoto."'");
                                                        if($verifica[0][descricao]==null){
                                                        $inseri="insert into historico (tabela, descricao, datahora,texto,cdprojeto) values('Fotos Flickr','".$idfoto."','".$datahora."','".$batata."',".$id.")";
                                                        $inseri=$projetos->rsql($inseri);
                                                        } 

                                                      }

                                                }
                                             
                                            }
                }
            }
        }



            $datas['teste'] = $sql;
            $datas['fotos'] =$textoarray;
            if ($id=='') {
            $datas['css']="default";    
            } else {
            $clientes = new clientesModel();
            $detalhes_clientes = $clientes->listaclientes("sigla='{$id}'");
            $datas['css'] = PROJETO.$detalhes_clientes[0]['cdlayoutmapa'];
            $datas['cliente'] = $detalhes_clientes;
            }



            $datas['vc'] = $this->modvinculados(get_class($this),$projeto, $datas['projetos'][0]['intervencao'], $datas['projetos'][0]['cdtipo'] );



                $this->view('/mapas/visualiza', $datas);

        }
        
        
        
        
  function gera_consulta_publica($codconsulta) {
  
  $datas['pagina']='';
 $datas['graficos']='';
 $rodape='';


// aqui 
$id = $codconsulta;

$modulos = new modulosModel();
$moduloscampo = new moduloscamposModel();
$consultas = new consultasModel();

$projetos = new projetosmapaModel();

$detalhes_consultas = $consultas->listaconsultas("cdconsulta=".$id);


$vconsulta = $id;
  
  
    // seleciona as tabelas

  
  $sqltabelas = " select e.entidade as nome, e.cdmodulo from modulo e where cdmodulo in (
           select e.cdmodulo from modulo e, modulo_campo c, saida s
           where e.cdmodulo=c.cdmodulo and c.cdcampo=s.cdcampo and s.cdconsulta=".$vconsulta ."
           union
            select e.cdmodulo from modulo e, modulo_campo c, parametro p 
           where e.cdmodulo=c.cdmodulo and c.cdcampo=p.cdcampo  and p.cdconsulta=".$vconsulta." )"; 

$rstabelas = $consultas->rsql($sqltabelas);
  
    
  $tabela='';
  $relacionamento='';
  $i = 0;
  foreach ($rstabelas as $tabelas ) {
         // adiciona tabelas envolvidas
  if ($i>0) {
        $tabela=$tabela.', '.$tabelas['nome'];
        $lmodulo=$lmodulo.', '.$tabelas['cdmodulo'];
  } else {
        $tabela=' FROM '.$tabelas['nome'];
        $lmodulo=$tabelas['cdmodulo'];
     }
    $i++;
  }



   foreach ($rstabelas as $tabelas ) {
      $refcampos = $moduloscampo->listaModuloscampos('cdmodulo='.$tabelas['cdmodulo'].' and cdmodulo_referencia in ('.$lmodulo.')');

      foreach ($refcampos as $refcampo) {
            if ($relacionamento!='') {$relacionamento.=' and ';}
                $moduloref = $modulos->listaModulos('cdmodulo='.$refcampo['cdmodulo_referencia']);
                $chave = $moduloscampo->pesquisaModuloscampos('cdmodulo='.$refcampo['cdmodulo_referencia'].' and cchave=1');
                $relacionamento.= $tabelas['nome'].'.'.$refcampo['campo'].' = '.$moduloref[0]['entidade'].'.'.$chave[0]['campo'];
      }
   }

  
  
  
  
  
// seleciona as saida 
  
  $sqlsaida = "select e.entidade ||'.'|| c.campo as nome, s.tipo, c.legenda, s.cdsaida, s.chave, s.visualiza, s.rotulo, s.totaliza, e.entidade as tabela, 1 as cod, e.legendaentidade ||'.'|| c.legenda as gdesc from modulo e, modulo_campo c, saida s
           where e.cdmodulo=c.cdmodulo and c.cdcampo=s.cdcampo and s.cdconsulta=".$vconsulta ."  
           union
           select s.questionario ||'.'|| 'informacao' as nome, s.tipo, s.questionario as legenda, s.cdsaida, s.chave, s.visualiza, s.rotulo, s.totaliza, s.questionario as tabela, 2 as cod, s.questionario ||'.'|| 'informacao' as gdesc from saida s
           where  s.cdcampo is null and s.cdconsulta=".$vconsulta ."                        
           order by 4";
           
           

  $rssaidas = $consultas->rsql($sqlsaida);

  //$rc = $rs->RowCount();  
  $saida='';
  $grupo='';
  $ordem='';
  $tab='';
  $agrupar=0;
  $rotulo='';
  $totaliza='';
  $i3=0;
   $i = 0;
  foreach ($rssaidas as $saidas ) {
  
    
if ( $saidas['cod']=='2' ){



      if ($saidas['tabela']{0}=='d') {
      $detalhes_documento = $projetos->rssql("select descricao from documento where cddocumento=".substr($saidas['tabela'],1));
      $saidas['legenda']=$detalhes_documento[0]['descricao'];
      }
      
      if ($saidas['tabela']{0}=='p') {
      $detalhes_pergunta = $projetos->rssql("select descricao from pergunta where cdpergunta=".substr($saidas['tabela'],1));
      $saidas['legenda']=$detalhes_pergunta[0]['descricao'];
      }
      
      
      $pos = strpos($tabela2, $saidas['tabela']);
      if ($pos == false) {      
      if ($tabela2==''){
      $tabela2='vquestionario '.$saidas['tabela'];
      } else {
      $tabela2=$tabela2.', vquestionario '.$saidas['tabela'];
      }
      
      $pos2 = strpos($tabela, 'projeto');
      if ($pos2 == true) {
      if ($relacionamento2==''){
      $relacionamento2=' projeto.cdprojeto = '.$saidas['tabela'].'.cdprojeto '; 
      } else {
      $relacionamento2=$relacionamento2.' and projeto.cdprojeto = '.$saidas['tabela'].'.cdprojeto ';
      }       
      }        
            
      }      
      
      
      $tab3=$saidas['tabela'];
      if ($parametro3=='') {
      $parametro3=$parametro3." ".$saidas['tabela'].".codigo='{$tab3}' ";
      } else {
      $parametro3=$parametro3." and ".$saidas['tabela'].".codigo='{$tab3}' ";
      }
      
      
  
  
  
  }  
  
  
  
  
        $sel=trim($saidas['tipo']);
         if ($sel=='somar') {
         $sel='SUM(';
         $leg='Soma '.$saidas['gdesc'];
         } elseif ($sel=='maior valor') {
         $sel='MAX(';
         $leg='Maior Valor '.$saidas['gdesc'];
         } elseif ($sel=='menor valor') {
         $sel='MIN(';
         $leg='Menor Valor '.$saidas['gdesc'];
         } elseif ($sel=='média') {
         $sel='AVG(';
         $leg='Média '.$saidas['gdesc'];
         } elseif ($sel=='quantificar') {
         $sel='COUNT(';
         $leg='Qtde '.$saidas['gdesc'];
         } else {
         $sel='(';
         $leg=$saidas['gdesc'];
         }
  
  
  if ($saidas['visualiza']=='1') {
   $tab=$tab.'<th>'.$leg.'</th>';
  }
  if ($saidas['rotulo']=='1') {
   $rotulo=$saidas['cdsaida'];
  }
  if ($saidas['totaliza']=='1') {
   $totaliza=$saidas['cdsaida'];
  }

  
  
     if ($i>0) {
        if ($sel!='(') {
        $agrupar=1;
        } else {
         $grupo=$grupo.', '.$saidas['nome'];
         $ordem=$ordem.', '.$saidas['nome']; 
        } 
        $saida=$saida.', '.$sel.$saidas['nome'].') AS '.'"'.$saidas['cdsaida'].'"'; 
     } else {
      if ($sel!='(') {
        $agrupar=1;
        } else {
        $saida=' SELECT '.$saidas['nome'];
        $grupo=' GROUP BY '.$saidas['nome']; 
        $ordem=' ORDER BY '.$saidas['nome'];     
        }
        $saida=' SELECT '.$sel.$saidas['nome'].') AS '.'"'.$saidas['cdsaida'].'"'; 
     }
     
     
  $i++;  
   
           
  } // saidas
  
  

  
  
  
  // seleciona os parametros
  
  $sqlparametros = "select e.entidade ||'.'|| c.campo as nome, p.condicao, c.tipo, p.cdparametro, c.legenda, p.valor from modulo e, modulo_campo c, parametro p 
           where e.cdmodulo=c.cdmodulo and c.cdcampo=p.cdcampo and p.cdconsulta=".$vconsulta ." order by p.cdparametro";               
   $rsparametros = $consultas->rsql($sqlparametros);
   


  $parametro='';
  $i=0;
  $lparametro='';

foreach ($rsparametros as $parametros) {

      $p='p'.$parametros['cdparametro'];
        
       if ($parametros['valor']!='') {
       
           if ($parametros['valor']{0}=='$') {
              $svalor=substr($parametros['valor'], 1);
              $sessao="'{$svalor}'";
              $par = $_SESSION[PROJETO]['{$sessao}'];
           
           } else {
           
            $par = $parametros['valor'];
           
           } 
       
       
       
         
       } else {
        $par = $_POST[$p];
       }
        
        if ($par!='') {
        $condicao=$parametros['condicao'];
        $lparametro.=$parametros['legenda'].' '.$condicao.' '.$par.'<br>';
        if ($condicao=='igual') {
         $condicao='=';
         } elseif ($condicao=='maior') {
         $condicao='>';
         } elseif ($condicao=='menor') {
         $condicao='<';
         } elseif ($condicao=='maior ou igual') {
         $condicao='>=';
         } elseif ($condicao=='menor ou igual') {
         $condicao='<=';
         } elseif ($condicao=='contenha') {
         $condicao='LIKE';
         } elseif ($condicao=='esteja em') {
         $condicao='IN';
         }  elseif ($condicao=='não esteja em') {
         $condicao='NOT IN';
         }


     if ($parametro!='') {
         if (($condicao=='IN') || ($condicao=='NOT IN')) {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par = str_replace( ',', "','", $par);
                $par="'".$par."'";
            }
                $parametro=$parametro." and ".$parametros['nome']." ".$condicao." ( ".$par." ) ";
         } else {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par="'".$par."'";
              if ( $parametros['tipo']=='data' ) {
              $parametro=$parametro." and ".$parametros['nome']." ".$condicao." ".$par." ";
              }  else { 
              $parametro=$parametro." and upper(".$parametros['nome'].") ".$condicao." upper(".$par.") ";
              }
             } else {
                 $parametro=$parametro." and ".$parametros['nome']." ".$condicao." ".$par." ";
            }
         }
     } else {
         if (($condicao=='IN') || ($condicao=='NOT IN')) {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par = str_replace( ',', "','", $par);
                $par="'".$par."'";
            }
                $parametro=$parametro." WHERE ".$parametros['nome']." ".$condicao." ( ".$par." ) ";
         } else {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par="'".$par."'";
              if ( $parametros['tipo']=='data' ) {
                $parametro=$parametro." WHERE ".$parametros['nome']." ".$condicao." ".$par." ";
              } else {
                $parametro=$parametro." WHERE upper(".$parametros['nome'].") ".$condicao." upper(".$par.") ";
              }
             
           } else {
                 $parametro=$parametro." WHERE ".$parametros['nome']." ".$condicao." ".$par." ";
          }
         }
     }
    
    }
     $i++;

  }
  
  


    $sqlparametro2 = "select questionario, condicao from parametro where cdcampo is null and cdconsulta=".$vconsulta ." order by cdparametro";       
    $rsparametros2 = $consultas->rsql($sqlparametro2);   
  
  

  if ($rsparametros2[0]['questionario']!='') {
    
 
  foreach ($rsparametros2 as $parametros2) {
  

  
  $codigo=$parametros2['questionario'];
  if ($parametros2['questionario']{0}=='p') {$v='r';} else {$v=$parametros2['questionario']{0};}  
  $p2=$v.substr($parametros2['questionario'],1);               
  $par2 = $_POST[$p2];
  
          if ($par2!='') {
        $condicao=$parametros2['condicao'];
        //$lparametro.=$parametros2['legenda'].' '.$condicao.' '.$par2.'<br>';
        if ($condicao=='igual') {
         $condicao='=';
         } elseif ($condicao=='maior') {
         $condicao='>';
         } elseif ($condicao=='menor') {
         $condicao='<';
         } elseif ($condicao=='maior ou igual') {
         $condicao='>=';
         } elseif ($condicao=='menor ou igual') {
         $condicao='<=';
         } elseif ($condicao=='contenha') {
         $condicao='LIKE';
         } elseif ($condicao=='esteja em') {
         $condicao='IN';
         }  elseif ($condicao=='não esteja em') {
         $condicao='NOT IN';
         }  
         
         
      $par2="'".$par2."'";
      if ($parametro2=='') {
      $parametro2=$parametro2." ( ".$parametros2[questionario].".codigo='{$codigo}' and upper(".$parametros2[questionario].".informacao) ".$condicao." upper(".$par2.") )";
      } else {
      $parametro2=$parametro2." or ( ".$parametros2[questionario].".codigo='{$codigo}' and upper(".$parametros2[questionario].".informacao) ".$condicao." upper(".$par2.") )";
      }
      
      
      $pos = strpos($tabela2, $parametros2[questionario]);
      if ($pos == false) {      
      if ($tabela2==''){
      $tabela2='vquestionario '.$parametros2[questionario];
      } else {
      $tabela2=$tabela2.', vquestionario '.$parametros2[questionario];
      }
      
      $pos = strpos($tabela, 'projeto');
      if ($pos == true) {
      if ($relacionamento2==''){
      $relacionamento2=' projeto.cdprojeto = '.$parametros2[questionario].'.cdprojeto '; 
      } else {
      $relacionamento2=$relacionamento2.' and projeto.cdprojeto = '.$parametros2[questionario].'.cdprojeto ';
      }       
      }        
            
      }
      

       
        
  }
  }


  
   if ($parametro2!='') {
   
      $parametro2=" ( ".$parametro2." ) ";
      if ($parametro=='') {
        $parametro=' WHERE '.$parametro2;
      } else { 
      $parametro=$parametro.' and '.$parametro2; 
      }
      
 
        
           
  }
  
  
}


  
   
     if ($parametro3!='') {
      if  ($parametro=='') {
        $parametro=' WHERE '.$parametro3;
      } else { 
      $parametro=$parametro.' and '.$parametro3; 
      }
      }  

    if ($relacionamento=='') {
         $relacionamento=$relacionamento2;
       } elseif ($relacionamento2!='') { $relacionamento=$relacionamento.' and '.$relacionamento2; }
 
      
  if ($tabela=='') { $tabela=' FROM '.$tabela2; } elseif ($tabela2!='') { $tabela=$tabela.', '.$tabela2; }
 

  if ($parametro=='') {     
    if ($relacionamento!='') {
    $relacionamento=' WHERE '.$relacionamento;
    }
  } else {
    if ($relacionamento!='') {
  $relacionamento=' and '.$relacionamento;
}}





  $sqlrel=$saida.$tabela.$parametro.' '.$relacionamento;

  if ($agrupar==1) {
   $sqlrel=$sqlrel.$grupo;
  }

   $sqlrel=$sqlrel.$ordem;
 
    //die($sqlrel);
  $rscon = $projetos->rsql($sqlrel);
  
  if ($rscon) {

  $titulo=' 
               <h5><b>'.$detalhes_consultas[0]['titulo'].'</b></h5>
           ';



$tabelav= '<table id="example1" class="table table-striped no-m">
            <thead>
            <tr>'.$tab.'
            </tr>
            </thead>
            <tbody>
            ';

$dadosgrafico1='[';
$dadosgrafico2='{ labels : [';
$dadosgrafico21=', datasets : [ {	fillColor : "rgba(151,187,205,0.5)", strokeColor : "rgba(151,187,205,0.8)", highlightFill : "rgba(151,187,205,0.75)", highlightStroke : "rgba(151,187,205,1)", data : [';
$dadosgrafico3='{ labels : [';
$dadosgrafico31=', datasets : [ {	fillColor : "rgba(151,187,205,0.5)", strokeColor : "rgba(151,187,205,0.8)", highlightFill : "rgba(151,187,205,0.75)", highlightStroke : "rgba(151,187,205,1)", data : [';
$dadosgrafico4='[';
$dadosgrafico6='[';
$i=0;
$dados5='';
  foreach ($rscon as $con ) {

 $tabelav.= ' <tr>';
  $saidas = $consultas->rsql($sqlsaida);

  foreach ($saidas as $saida ) {
      if ($saida['visualiza']=='1') {
        $tabelav.= '     <td>'.$con[$saida['cdsaida']].'</td>';
      }

 if ($detalhes_consultas[0]['grafico']=='1') {

      if ($saida['rotulo']=='1') {
           if ($dadosgrafico1!='[') {$dadosgrafico1.=',';};
           $dadosgrafico1.='{
                              label: "'.$con[$saida['cdsaida']].'",';
      }

      if ($saida['totaliza']=='1') {
           $cor=$this->cor();
           $dadosgrafico1.='   value: '.$con[$saida['cdsaida']].',
                              color: "'.$cor.'",
                              highlight: "'.$cor.'"
                            }';
      }
      
   }
  
  if ($detalhes_consultas[0]['grafico']=='2') {      
       if ($saida['rotulo']=='1') {
           if ($dadosgrafico2!='{ labels : [') {$dadosgrafico2.=',';}; 
           $dadosgrafico2.='"'.$con[$saida['cdsaida']].'"';
      }

      if ($saida['totaliza']=='1') {
       if ($dadosgrafico21!=', datasets : [ {	fillColor : "rgba(151,187,205,0.5)", strokeColor : "rgba(151,187,205,0.8)", highlightFill : "rgba(151,187,205,0.75)", highlightStroke : "rgba(151,187,205,1)", data : [') {$dadosgrafico21.=',';}; 
           $dadosgrafico21.=$con[$saida['cdsaida']];
      }
    }    
    
    		

  if ($detalhes_consultas[0]['grafico']=='3') {      
       if ($saida['rotulo']=='1') {
           if ($dadosgrafico3!='{ labels : [') {$dadosgrafico3.=',';}; 
           $dadosgrafico3.='"'.$con[$saida['cdsaida']].'"';
      }

      if ($saida['totaliza']=='1') {
       if ($dadosgrafico31!=', datasets : [ {	fillColor : "rgba(151,187,205,0.5)", strokeColor : "rgba(151,187,205,0.8)", highlightFill : "rgba(151,187,205,0.75)", highlightStroke : "rgba(151,187,205,1)", data : [') {$dadosgrafico31.=',';}; 
           $dadosgrafico31.=$con[$saida['cdsaida']];
      }
    }

  if ($detalhes_consultas[0]['grafico']=='4') {      
       if ($saida['totaliza']=='1') {

           if ( ($dadosgrafico4!='[') and ($i3==0) ) {$dadosgrafico4.=',';}; 
 
            if ($i3==0) {
              $dadosgrafico4.='[
                                "'.$con[$saida['cdsaida']].'",';
              $i3=1;
            } else {
              $dadosgrafico4.='   '.$con[$saida['cdsaida']].'
                            ]';
              $i3=0;
            }
      }

    }

  if ($detalhes_consultas[0]['grafico']=='5') {

       if ($saida['rotulo']=='1') {
           $dados5[$i]['legenda'] = $con[$saida['cdsaida']];
      }

      if ($saida['totaliza']=='1') {
        $dados5[$i]['valor'] = $con[$saida['cdsaida']];
      }
    }
    
    
    
    
 if ($detalhes_consultas[0]['grafico']=='6') {

      if ($saida['rotulo']=='1') {
           if ($dadosgrafico6!='[') {$dadosgrafico6.=',';};
           $dadosgrafico6.='{
                              label: "'.$con[$saida['cdsaida']].'",';
      }

      if ($saida['totaliza']=='1') {
           $cor=$this->cor();
           $dadosgrafico6.='   value: '.$con[$saida['cdsaida']].',
                              color: "'.$cor.'",
                              highlight: "'.$cor.'"
                            }';
      }
    }    




  }
$tabelav.= ' </tr>';
$i++;
}
$tabelav.=' </table>';
$dadosgrafico1.=']';
$dadosgrafico2.=']'.$dadosgrafico21.'] }	]	}';
$dadosgrafico3.=']'.$dadosgrafico31.'] }	]	}';
$dadosgrafico4.=']';
$dadosgrafico6.=']';
}

//$_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
//$_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong><br>'.$lparametro;
$visualizacao = explode(',', $detalhes_consultas[0]['visualizacao']);
if (in_array('2', $visualizacao)) {
$datas['pagina']=$tabelav;
}

$datas['consultas']=$detalhes_consultas;
$vgrafico = '';


  if ($detalhes_consultas[0]['grafico']=='1') {

     $vgrafico = '
            <div id="canvas-holder" align="center">
			         <canvas id="pizza'.$codconsulta.'" width="300" height="300"/>
		        </div>
            ';
  
     $_SESSION[PROJETO]['mgrafico'].='     
        var pieData'.$codconsulta.' = '.$dadosgrafico1.';
				var ctx'.$codconsulta.' = document.getElementById("pizza'.$codconsulta.'").getContext("2d");
				window.myPie = new Chart(ctx'.$codconsulta.').Pie(pieData'.$codconsulta.');';     
  }

  if ($detalhes_consultas[0]['grafico']=='2') {

     $vgrafico .= '     
     <div style="width: 95%">
			<canvas id="barra'.$codconsulta.'" style="width: 800px; height: 350px;"></canvas>
		</div>';

  $_SESSION[PROJETO]['mgrafico'].='   
  	var barChartData'.$codconsulta.' = '.$dadosgrafico2.' 
		var ctx'.$codconsulta.' = document.getElementById("barra'.$codconsulta.'").getContext("2d");
		window.myBar = new Chart(ctx'.$codconsulta.').Bar(barChartData'.$codconsulta.', {
			responsive : true
		});';      
  }

  if ($detalhes_consultas[0]['grafico']=='3') {

     $vgrafico .= '
     
     <div style="width: 95%">
			<canvas id="linha'.$codconsulta.'" style="width: 800px; height: 350px;"></canvas>
		</div>';

  $_SESSION[PROJETO]['mgrafico'].='   
  	var lineChartData'.$codconsulta.' = '.$dadosgrafico3.' 
		var ctx'.$codconsulta.' = document.getElementById("linha'.$codconsulta.'").getContext("2d");
		window.myLine  = new Chart(ctx'.$codconsulta.').Line(lineChartData'.$codconsulta.', {
			responsive : true
		});';      
  }

    if ($detalhes_consultas[0]['grafico']=='4') {

     $vgrafico .= '


                                <section class="panel">
                                    <header class="panel-heading no-b">
                                        <h5>Quarterly Apple iOS device unit sales</h5>
                                    </header>
                                    <div class="panel-body">
                                        <div id="hero-area'.$codconsulta.'" class="chart"></div>
                                    </div>
                                </section>
                                    ';


  }


    if ($detalhes_consultas[0]['grafico']=='5') {
foreach ($dados5 as $d5) {
     $vgrafico .= '<div class="col-md-4 widget"> 
<div class="col-md-12" style="border:1px solid #f9f7f7; border-left: 5px solid '.$this->cor().'; border-radius: 3px; background:#fff;"><h3>'.$d5['valor'].'</h3><span>'.$d5['legenda'].'</span></div>
</div>
';


}

  }

  

  if ($detalhes_consultas[0]['grafico']=='6') {

     $vgrafico = '
		<style>
			body{
				padding: 0;
				margin: 0;
			}
			#canvas-holder{
				width:30%;
			}
		</style>     
            <div id="canvas-holder" align="center">
			         <canvas id="pizzafacil'.$codconsulta.'" width="300" height="300"/>
		        </div>
            ';
  
     $_SESSION[PROJETO]['mgrafico'].='     
        var doughnutData'.$codconsulta.' = '.$dadosgrafico6.';
				var ctx'.$codconsulta.' = document.getElementById("pizzafacil'.$codconsulta.'").getContext("2d");
				window.myDoughnut = new Chart(ctx'.$codconsulta.').Doughnut(doughnutData'.$codconsulta.');';     
  }

            
  


if (in_array('1', $visualizacao)) {
  $datas['graficos']=$vgrafico;
}


  $infconsulta= $titulo.$datas['pagina']. $datas['graficos'];


   return $infconsulta; 
   //fim aqui

  }        


}
