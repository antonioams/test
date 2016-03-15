
<?php
session_start();
    class meusprojetos extends Controller{

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

            if ($_SESSION[PROJETO]['cdunidade']=='') {
                $und='0';
            } else {
                $und=$_SESSION[PROJETO]['cdunidade'];
            }

           //$projetos_lista = $projetos->listaprojetos("{$par}");
            $lista = array();
            $consultar = $projetos->rsql("select cdprojeto from projeto where cdprojeto in (select cdprojeto from movimentacao where cdunidade=".$und.")");
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

            if ($projetos->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {

                $this->view('/projetos/index', $datas);
                
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
            if ($projetos->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projetos/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function visualiza(){

            $projetos = new projetosModel();
            $id = $this->getParam('id');
            $detalhes_projetos = $projetos->rsql("
                SELECT p.*, t.nome AS tipo, f.nome AS fase,
                n.nome AS natureza, m.nome AS municipio, h.texto AS foto
                FROM projeto p
                LEFT OUTER JOIN tipo t ON p.cdtipo=t.cdtipo
                LEFT OUTER JOIN fase f ON p.cdfase=f.cdfase
                LEFT OUTER JOIN natureza n ON p.cdnatureza=n.cdnatureza
                LEFT OUTER JOIN municipio m ON p.cdmunicipio=m.cdmunicipio
                LEFT OUTER JOIN historico h ON p.cdprojeto=h.cdprojeto
                WHERE p.cdprojeto=".$id." LIMIT 1");
            $datas['projetos'] = $detalhes_projetos;

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
                SELECT 'medicao' AS indicador, cdprojeto, count(cdmedicao) FROM medicao  WHERE cdprojeto=".$id." GROUP BY cdprojeto

                ");
            $datas['indicadores'] = $indicadores;

            $andamento = $projetos->rsql("
                SELECT 'contrato' AS andamento, c.cdprojeto , sum(ci.valor) as valor, sum(ci.quantidade) as qtd FROM contrato c, contrato_item ci WHERE c.cdprojeto=".$id." and c.cdcontrato=ci.cdcontrato GROUP BY c.cdprojeto 
                UNION ALL 
                SELECT 'medicao' AS andamento, c.cdprojeto, sum(m.valor) as valor, sum(m.quantidade) as qtd FROM contrato c, contrato_item ci, medicao m WHERE c.cdprojeto=".$id." and c.cdcontrato=ci.cdcontrato and ci.cdcontrato_item=m.cdcontrato_item GROUP BY c.cdprojeto 

                ");
            $datas['andamento'] = $andamento;




            if ($_SESSION[PROJETO]['flickr_chave']!='') {
                require_once("phpFlickr.php");
                $f = new phpFlickr($_SESSION[PROJETO]['flickr_chave'],$_SESSION[PROJETO]['flickr_sec']); 
            }
            $arrayfotos= array();
          // consulta ordem;
            $projetos_lista = $projetos->rsql("SELECT CAST(cdprojeto AS TEXT) AS cd, to_char(datahora, 'DD/MM/YYYY') AS datahora, 'projeto' AS tabela FROM projeto WHERE cdprojeto ='".$id."'
                        UNION ALL 
                        SELECT CAST(cdcontrato AS TEXT) AS cd, to_char(datahora, 'DD/MM/YYYY') AS datahora, 'contrato' AS tabela FROM contrato WHERE cdprojeto ='".$id."'
                        UNION ALL 
                        SELECT CAST(cdcontrato_item AS TEXT) AS cd, to_char(ci.datahora, 'DD/MM/YYYY'), 'contrato_item' AS tabela FROM contrato_item ci 
                        JOIN contrato c ON ci.cdcontrato= c.cdcontrato  WHERE c.cdprojeto = '".$id."'
                       UNION ALL 
                       SELECT CAST(texto AS TEXT) AS cd, datahoras , 'historico' AS tabela FROM foto_flickr WHERE cdprojeto='".$id."'
                       UNION ALL
                       SELECT CAST(cdmovimentacao AS TEXT) AS cd, to_char(datahora, 'DD/MM/YYYY') AS datahora, 'movimentacao' AS tabela FROM movimentacao WHERE cdprojeto='".$id."'

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



            $datas['teste'] = $sql;
            $datas['fotos'] =$textoarray;




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

            $detalhes_tipos = $tipos->listatipos("{$par}");

            $datas['tipos'] = $detalhes_tipos;

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
            header( "Location: /".PROJETO."/projetos/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $projetos = new projetosModel();
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
            if ($projetos->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projetos/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $projetos = new projetosModel();
            $insere = $projetos->insereprojetos($_POST, 'cdprojeto');

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

            $pesquisa = $projetos->pesquisaprojetos($w);
            $datas['projetos'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/projetos/index', $datas);

    }


}
