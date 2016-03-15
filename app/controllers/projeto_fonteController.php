
<?php
session_start();
    class projeto_fonte extends Controller{

        public function Index_action(){
            $projeto_fonte = new projeto_fonteModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $projetos = new projetosModel();         
             
              $projeto_fonte_lista = $projetos->rsql("
                select pf.*, f.nome as fonte from projeto_fonte pf, fonte f                
                where pf.cdfonte=f.cdfonte and pf.cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']."
                order by f.nome ");

            $datas['projeto_fonte'] = $projeto_fonte_lista;
            
            

            if ($projeto_fonte->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projeto_fonte/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $projeto_fonte = new projeto_fonteModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $fontes = new fontesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfonte') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_fontes = $fontes->listafontes("{$par}");

            $datas['fontes'] = $detalhes_fontes;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($projeto_fonte->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/projeto_fonte/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $projeto_fonte = new projeto_fonteModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $fontes = new fontesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfonte') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_fontes = $fontes->listafontes("{$par}");

            $datas['fontes'] = $detalhes_fontes;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($projeto_fonte->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projeto_fonte/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $projeto_fonte = new projeto_fonteModel();
            $id = $this->getParam('id');
            $detalhes_projeto_fonte = $projeto_fonte->listaprojeto_fonte('cdprojeto_fonte='.$id);
            $detalhes_projeto_fonte[0]['valor']= str_replace(".", ",", $detalhes_projeto_fonte[0]['valor']);
            $datas['projeto_fonte'] = $detalhes_projeto_fonte;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['projeto_fonte'][0]['cdfonte'] );
            $fontes = new fontesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfonte') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_fontes = $fontes->listafontes("{$par}");

            $datas['fontes'] = $detalhes_fontes;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($projeto_fonte->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projeto_fonte/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $projeto_fonte = new projeto_fonteModel();
            $_POST['valor']= str_replace(",", ".", $_POST['valor']);
            $dados=$_POST;
            $atualiza = $projeto_fonte->atualizaprojeto_fonte($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/projeto_fonte/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/projeto_fonte/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $projeto_fonte = new projeto_fonteModel();
            $atualiza = $projeto_fonte->excluiprojeto_fonte( 'cdprojeto_fonte='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($projeto_fonte->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/projeto_fonte/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $projeto_fonte = new projeto_fonteModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $fontes = new fontesModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfonte') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_fontes = $fontes->listafontes("{$par}");

            $datas['fontes'] = $detalhes_fontes;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($projeto_fonte->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/projeto_fonte/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $projeto_fonte = new projeto_fonteModel();	
            $_POST['valor']= str_replace(",", ".", $_POST['valor']);		
			
            $insere = $projeto_fonte->insereprojeto_fonte($_POST, 'cdprojeto_fonte');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/projeto_fonte/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/projeto_fonte/" );
            }

        }


        public function inserem( Array $dados = null ){
            $projeto_fonte = new projeto_fonteModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['cdfonte'][0])) {
                $i=0;
                foreach ($dados['cdfonte'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_projeto_fonte[$key]=$dados[$key][$i];
                    }
                    $dados_projeto_fonte['valor']= str_replace(",", ".", $dados_projeto_fonte['valor']);
                    $insere = $projeto_fonte->insereprojeto_fonte($dados_projeto_fonte,'cdprojeto_fonte');
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

            header( "Location: /".PROJETO."/projeto_fonte/" );


        }



        public function inserew(){
            $projeto_fonte = new projeto_fonteModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='projeto_fonte') {
                    $dados['projeto_fonte'][$p[1]]=$value;
                }
            }

            $inserep = $projeto_fonte->insereprojeto_fonte($dados['projeto_fonte'], 'cdprojeto_fonte');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/projeto_fonte/" );
            

        }

        public function pesquisa(){
            $projeto_fonte = new projeto_fonteModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $fontes = new fontesModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfonte') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $projetos = new projetosModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
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

            $pesquisa = $projeto_fonte->pesquisaprojeto_fonte($w);
            $datas['projeto_fonte'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/projeto_fonte/index', $datas);

    }


}