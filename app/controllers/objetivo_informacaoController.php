
<?php
session_start();
    class objetivo_informacao extends Controller{

        public function Index_action(){
            $objetivo_informacao = new objetivo_informacaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $objetivo_informacao_lista = $objetivo_informacao->listaobjetivo_informacao("{$par}");

            $datas['objetivo_informacao'] = $objetivo_informacao_lista;

            if ($objetivo_informacao->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/objetivo_informacao/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $objetivo_informacao = new objetivo_informacaoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $alvo = new alvoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdalvo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_alvo = $alvo->listaalvo("cdprograma=".$_SESSION[PROJETO]['filtro']['cdprograma']);

            $datas['alvo'] = $detalhes_alvo;
            $programas = new programasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprograma') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_programas = $programas->listaprogramas("{$par}");

            $datas['programas'] = $detalhes_programas;
            if ($objetivo_informacao->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/objetivo_informacao/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $objetivo_informacao = new objetivo_informacaoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $alvo = new alvoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdalvo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_alvo = $alvo->listaalvo("cdprograma=".$_SESSION[PROJETO]['filtro']['cdprograma']);

            $datas['alvo'] = $detalhes_alvo;
            $programas = new programasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprograma') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_programas = $programas->listaprogramas("{$par}");

            $datas['programas'] = $detalhes_programas;
            if ($objetivo_informacao->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/objetivo_informacao/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $objetivo_informacao = new objetivo_informacaoModel();
            $id = $this->getParam('id');
            $detalhes_objetivo_informacao = $objetivo_informacao->listaobjetivo_informacao('cdobjetivo_informacao='.$id);
            $datas['objetivo_informacao'] = $detalhes_objetivo_informacao;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['objetivo_informacao'][0]['logica'] );
            $alvo = new alvoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdalvo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_alvo = $alvo->listaalvo("cdprograma=".$_SESSION[PROJETO]['filtro']['cdprograma']);

            $datas['alvo'] = $detalhes_alvo;
            $programas = new programasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprograma') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_programas = $programas->listaprogramas("{$par}");

            $datas['programas'] = $detalhes_programas;
            if ($objetivo_informacao->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/objetivo_informacao/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $objetivo_informacao = new objetivo_informacaoModel();
            $dados=$_POST;      $dados['cdalvo']=implode( ',' , $dados['cdalvo']);
            $atualiza = $objetivo_informacao->atualizaobjetivo_informacao($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/objetivo_informacao/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/objetivo_informacao/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $objetivo_informacao = new objetivo_informacaoModel();
            $atualiza = $objetivo_informacao->excluiobjetivo_informacao( 'cdobjetivo_informacao='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($objetivo_informacao->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/objetivo_informacao/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $objetivo_informacao = new objetivo_informacaoModel();
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
            $programas = new programasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprograma') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_programas = $programas->listaprogramas("{$par}");

            $datas['programas'] = $detalhes_programas;
            if ($objetivo_informacao->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/objetivo_informacao/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $objetivo_informacao = new objetivo_informacaoModel();      $_POST['cdalvo']=implode( ',' , $_POST['cdalvo']);			
			
            $insere = $objetivo_informacao->insereobjetivo_informacao($_POST, 'cdobjetivo_informacao');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/objetivo_informacao/editar/id/{$insere}" );
            } elseif ($_POST['submit']=='Salvar e Inserir') {
            header( "Location: /".PROJETO."/objetivo_informacao/novo/" );
            } elseif ($_POST['submit']=='Salvar e Produtos') {
            header( "Location: /".PROJETO."/produtos/" );
            } else {
            header( "Location: /".PROJETO."/objetivo_informacao/" );
            }

        }


        public function inserem( Array $dados = null ){
            $objetivo_informacao = new objetivo_informacaoModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['logica'][0])) {
                $i=0;
                foreach ($dados['logica'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_objetivo_informacao[$key]=$dados[$key][$i];
                    }
                    $insere = $objetivo_informacao->insereobjetivo_informacao($dados_objetivo_informacao,'cdobjetivo_informacao');
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

            header( "Location: /".PROJETO."/objetivo_informacao/" );


        }



        public function inserew(){
            $objetivo_informacao = new objetivo_informacaoModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='objetivo_informacao') {
                    $dados['objetivo_informacao'][$p[1]]=$value;
                }
            }

            $inserep = $objetivo_informacao->insereobjetivo_informacao($dados['objetivo_informacao'], 'cdobjetivo_informacao');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/objetivo_informacao/" );
            

        }

        public function pesquisa(){
            $objetivo_informacao = new objetivo_informacaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $alvo = new alvoModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdalvo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
            $programas = new programasModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprograma') ) {
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

            $pesquisa = $objetivo_informacao->pesquisaobjetivo_informacao($w);
            $datas['objetivo_informacao'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/objetivo_informacao/index', $datas);

    }


}