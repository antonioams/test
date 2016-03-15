
<?php
session_start();
    class programasp extends Controller{

        public function consultar(){

            $programas = new programasModel();

            if ($this->getParam('alvo')!='') {

            $detalhes_programas = $programas->listaprogramas('cdprograma='.$this->getParam('alvo'));
            $datas['programas'] = $detalhes_programas;
            $datas['vc'] = $this->modvinculados(get_class($this),$this->getParam('alvo'), $datas['programas'][0]['nome'], $datas['programas'][0]['cdprograma'] );
            header( "Location: /".PROJETO."/alvo/" );

            } elseif ($this->getParam('objetivo')!='') {

            $detalhes_programas = $programas->listaprogramas('cdprograma='.$this->getParam('objetivo'));
            $datas['programas'] = $detalhes_programas;
            $datas['vc'] = $this->modvinculados(get_class($this),$this->getParam('objetivo'), $datas['programas'][0]['nome'], $datas['programas'][0]['cdprograma'] );
            header( "Location: /".PROJETO."/objetivo_informacao/" );

            } elseif ($this->getParam('produto')!='') {

            $detalhes_programas = $programas->listaprogramas('cdprograma='.$this->getParam('produto'));
            $datas['programas'] = $detalhes_programas;
            $datas['vc'] = $this->modvinculados(get_class($this),$this->getParam('produto'), $datas['programas'][0]['nome'], $datas['programas'][0]['cdprograma'] );
            header( "Location: /".PROJETO."/produtos/" );

            } elseif ($this->getParam('quadro')!='') {

            $detalhes_programas = $programas->listaprogramas('cdprograma='.$this->getParam('quadro'));
            $datas['programas'] = $detalhes_programas;
            $datas['vc'] = $this->modvinculados(get_class($this),$this->getParam('quadro'), $datas['programas'][0]['nome'], $datas['programas'][0]['cdprograma'] );
            header( "Location: /".PROJETO."/quadro/" );

            } else {

            header( "Location: /".PROJETO."/programasp/" );

            }



        }
	
        public function Index_action(){
            $programas = new programasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $programas_lista = $programas->listaprogramas("{$par}");

            $datas['programas'] = $programas_lista;
			
			$datas['op']=$this->getParam('id');

            if ($programas->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/programasp/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $programas = new programasModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($programas->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/programasp/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $programas = new programasModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($programas->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/programasp/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $programas = new programasModel();
            $id = $this->getParam('id');
            $detalhes_programas = $programas->listaprogramas('cdprograma='.$id);
            $datas['programas'] = $detalhes_programas;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['programas'][0]['nome'] );
            if ($programas->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/programasp/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $programas = new programasModel();
            $dados=$_POST;
            $atualiza = $programas->atualizaprogramas($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/programasp/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/programasp/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $programas = new programasModel();
            $atualiza = $programas->excluiprogramas( 'cdprograma='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($programas->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/programasp/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $programas = new programasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            if ($programas->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/programasp/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $programas = new programasModel();
            $insere = $programas->insereprogramas($_POST, 'cdprograma');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/programasp/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/programasp/" );
            }

        }


        public function inserem( Array $dados = null ){
            $programas = new programasModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['nome'][0])) {
                $i=0;
                foreach ($dados['nome'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_programas[$key]=$dados[$key][$i];
                    }
                    $insere = $programas->insereprogramas($dados_programas,'cdprograma');
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

            header( "Location: /".PROJETO."/programasp/" );


        }



        public function inserew(){
            $programas = new programasModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='programa') {
                    $dados['programa'][$p[1]]=$value;
                }
            }

            $inserep = $programas->insereprogramas($dados['programa'], 'cdprograma');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/programasp/" );
            

        }

        public function pesquisa(){
            $programas = new programasModel();
            $datas['vc'] = $this->modvinculados(get_class($this));$filtro='';
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

            $pesquisa = $programas->pesquisaprogramas($w);
            $datas['programas'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/programasp/index', $datas);

    }


}
