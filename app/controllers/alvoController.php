
<?php
session_start();
    class alvo extends Controller{

        public function Index_action(){
            $alvo = new alvoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $alvo_lista = $alvo->listaalvo("{$par}");

            $datas['alvo'] = $alvo_lista;

            if ($alvo->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/alvo/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $alvo = new alvoModel();
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
           $alvo_informacao = new alvo_informacaoModel();
            $alvo = new alvoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdalvo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_alvo = $alvo->listaalvo("{$par}");

            $datas['alvo'] = $detalhes_alvo;
           $alvo_informacao_ano = new alvo_informacao_anoModel();
            $alvo_informacao = new alvo_informacaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdalvo_informacao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_alvo_informacao = $alvo_informacao->listaalvo_informacao("{$par}");

            $datas['alvo_informacao'] = $detalhes_alvo_informacao;
            $alvo = new alvoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdalvo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_alvo = $alvo->listaalvo("{$par}");

            $datas['alvo'] = $detalhes_alvo;
            if ($alvo->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/alvo/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $alvo = new alvoModel();
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
            if ($alvo->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/alvo/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $alvo = new alvoModel();
            $id = $this->getParam('id');
            $detalhes_alvo = $alvo->listaalvo('cdalvo='.$id);
            $datas['alvo'] = $detalhes_alvo;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['alvo'][0]['descricao'] );
            $programas = new programasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprograma') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_programas = $programas->listaprogramas("{$par}");

            $datas['programas'] = $detalhes_programas;
            if ($alvo->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/alvo/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $alvo = new alvoModel();
            $dados=$_POST;
            $atualiza = $alvo->atualizaalvo($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/alvo/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/alvo/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $alvo = new alvoModel();
            $atualiza = $alvo->excluialvo( 'cdalvo='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($alvo->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/alvo/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $alvo = new alvoModel();
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
            if ($alvo->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/alvo/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $alvo = new alvoModel();			
			
            $insere = $alvo->inserealvo($_POST, 'cdalvo');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/alvo/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/alvo/" );
            }

        }


        public function inserem( Array $dados = null ){
            $alvo = new alvoModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['descricao'][0])) {
                $i=0;
                foreach ($dados['descricao'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_alvo[$key]=$dados[$key][$i];
                    }
                    $insere = $alvo->inserealvo($dados_alvo,'cdalvo');
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

            header( "Location: /".PROJETO."/alvo/" );


        }



        public function inserew(){
            $alvo = new alvoModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='alvo') {
                    $dados['alvo'][$p[1]]=$value;
                }
            }

            $inserep = $alvo->inserealvo($dados['alvo'], 'cdalvo');
           $alvo_informacao = new alvo_informacaoModel();

 
            $dados_['alvo_informacao']['cdalvo']=$inserep;
            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='alvo_informacao') {
                    $dados['alvo_informacao'][$p[1]]=$value;
                }
            }
            $i=0;
            foreach ($dados['alvo_informacao']['tipo']  as $key2 => $value2) {

            foreach ($dados['alvo_informacao'] as $key2 => $value2) {
                        $dados_['alvo_informacao'][$key2]=$dados['alvo_informacao'][$key2][$i];
            }

            $insere = $alvo_informacao->inserealvo_informacao($dados_['alvo_informacao'], 'cdalvo_informacao');
            $i++;
            }
            
           $alvo_informacao_ano = new alvo_informacao_anoModel();

 
            $dados_['alvo_informacao_ano']['cdalvo']=$inserep;
            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='alvo_informacao_ano') {
                    $dados['alvo_informacao_ano'][$p[1]]=$value;
                }
            }
            $i=0;
            foreach ($dados['alvo_informacao_ano']['ano']  as $key2 => $value2) {

            foreach ($dados['alvo_informacao_ano'] as $key2 => $value2) {
                        $dados_['alvo_informacao_ano'][$key2]=$dados['alvo_informacao_ano'][$key2][$i];
            }

            $insere = $alvo_informacao_ano->inserealvo_informacao_ano($dados_['alvo_informacao_ano'], 'cdalvo_informacao_ano');
            $i++;
            }
            


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Objetivo') {

            header( "Location: /".PROJETO."/objetivo_informacao/novo" );
            } else {
            header( "Location: /".PROJETO."/alvo/" );
            }

        }

        public function pesquisa(){
            $alvo = new alvoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
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

            $pesquisa = $alvo->pesquisaalvo($w);
            $datas['alvo'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/alvo/index', $datas);

    }


}
