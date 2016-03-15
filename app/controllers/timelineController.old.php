<?php
session_start();
    class timeline extends Controller{

        public function Index_action(){
            $id = $this->getParam('id');
            if ($id!='') {
            $_SESSION[PROJETO]['filtro']['cdprojeto']=$id;
            $projetos = new projetosModel();
            $detalhes_projetos = $projetos->listaprojetos('cdprojeto='.$id);
            }

            $datas['vc'] = $this->modvinculados(get_class($this));
            $this->view('/timeline/index', $datas);


        }


     public function teste(){
        $id = $this->getParam('cdprojeto');
            if ($_SESSION[PROJETO]['flickr_chave']!='') {
                require_once("phpFlickr.php");
                $f = new phpFlickr($_SESSION[PROJETO]['flickr_chave'],$_SESSION[PROJETO]['flickr_sec']); 
            }
            $projetos = new projetosModel();
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
            $this->view('/timeline/teste', $datas);
    }
} 
?>