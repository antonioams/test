
<?php
session_start();
    class objetivos extends Controller{

        public function Index_action(){
            $objetivos = new objetivosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $objetivos_lista = $objetivos->listaobjetivos("{$par}");

            $datas['objetivos'] = $objetivos_lista;

            if ($objetivos->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/objetivos/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $objetivos = new objetivosModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $alvo = new alvoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdalvo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_alvo = $alvo->listaalvo("{$par}");

            $datas['alvo'] = $detalhes_alvo;
            $areas = new areasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdarea') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_areas = $areas->listaareas("{$par}");

            $datas['areas'] = $detalhes_areas;
            if ($objetivos->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/objetivos/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $objetivos = new objetivosModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $alvo = new alvoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdalvo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_alvo = $alvo->listaalvo("{$par}");

            $datas['alvo'] = $detalhes_alvo;
            $areas = new areasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdarea') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_areas = $areas->listaareas("{$par}");

            $datas['areas'] = $detalhes_areas;
            if ($objetivos->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/objetivos/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $objetivos = new objetivosModel();
            $id = $this->getParam('id');
            $detalhes_objetivos = $objetivos->listaobjetivos('cdobjetivo='.$id);
            $datas['objetivos'] = $detalhes_objetivos;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['objetivos'][0]['descricao'] );
            $alvo = new alvoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdalvo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_alvo = $alvo->listaalvo("{$par}");

            $datas['alvo'] = $detalhes_alvo;
            $areas = new areasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdarea') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_areas = $areas->listaareas("{$par}");

            $datas['areas'] = $detalhes_areas;
            if ($objetivos->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/objetivos/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $objetivos = new objetivosModel();
            $dados=$_POST;
            $atualiza = $objetivos->atualizaobjetivos($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/objetivos/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/objetivos/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $objetivos = new objetivosModel();
            $atualiza = $objetivos->excluiobjetivos( 'cdobjetivo='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($objetivos->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/objetivos/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $objetivos = new objetivosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $alvo = new alvoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdalvo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_alvo = $alvo->listaalvo("{$par}");

            $datas['alvo'] = $detalhes_alvo;
            $areas = new areasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdarea') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_areas = $areas->listaareas("{$par}");

            $datas['areas'] = $detalhes_areas;
            if ($objetivos->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/objetivos/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $objetivos = new objetivosModel();
            $insere = $objetivos->insereobjetivos($_POST, 'cdobjetivo');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/objetivos/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/objetivos/" );
            }

        }


        public function inserem( Array $dados = null ){
            $objetivos = new objetivosModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdobjetivo'][0])) {
                $i=0;
                foreach ($dados['cdobjetivo'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_objetivos[$key]=$dados[$key][$i];
                    }
                    $insere = $objetivos->insereobjetivos($dados_objetivos,'cdobjetivo');
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

            header( "Location: /".PROJETO."/objetivos/" );


        }



        public function inserew(){
            $objetivos = new objetivosModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='objetivo') {
                    $dados['objetivo'][$p[1]]=$value;
                }
            }

            $inserep = $objetivos->insereobjetivos($dados['objetivo'], 'cdobjetivo');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/objetivos/" );
            

        }

        public function pesquisa(){
            $objetivos = new objetivosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $alvo = new alvoModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdalvo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $areas = new areasModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdarea') ) {
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

            $pesquisa = $objetivos->pesquisaobjetivos($w);
            $datas['objetivos'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/objetivos/index', $datas);

    }


}