
<?php
session_start();
    class fotos extends Controller{

        public function Index_action(){
			$projetos = new projetosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));


            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $projeto_lista = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $projeto_lista;

       		$clientes = new clientesModel();

            $detalhes_clientes = $clientes->listaclientes("cdcliente=".$_SESSION[PROJETO]['cdcliente']);

            $datas['clientes']['flickr_chave'] = $detalhes_clientes[0]['flickr_chave'];
            $datas['clientes']['flickr_sec'] = $detalhes_clientes[0]['flickr_sec'];
            $datas['clientes']['flickr_usuario'] = $detalhes_clientes[0]['flickr_usuario'];

            $this->view('/fotos/index', $datas);

        }



}