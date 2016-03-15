
<?php
session_start();
    class alvo_informacao extends Controller{

        public function Index_action(){
            $alvo_informacao = new alvo_informacaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $alvo_informacao_lista = $alvo_informacao->listaalvo_informacao("{$par}");

            $datas['alvo_informacao'] = $alvo_informacao_lista;

            if ($alvo_informacao->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/alvo_informacao/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $alvo_informacao = new alvo_informacaoModel();
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
            if ($alvo_informacao->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/alvo_informacao/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $alvo_informacao = new alvo_informacaoModel();
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
            if ($alvo_informacao->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/alvo_informacao/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $alvo_informacao = new alvo_informacaoModel();
            $id = $this->getParam('id');
            $detalhes_alvo_informacao = $alvo_informacao->listaalvo_informacao('cdalvo_informacao='.$id);
            $datas['alvo_informacao'] = $detalhes_alvo_informacao;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['alvo_informacao'][0]['tipo'] );
            $alvo = new alvoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdalvo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_alvo = $alvo->listaalvo("{$par}");

            $datas['alvo'] = $detalhes_alvo;
            if ($alvo_informacao->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/alvo_informacao/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $alvo_informacao = new alvo_informacaoModel();
            $dados=$_POST;
            $atualiza = $alvo_informacao->atualizaalvo_informacao($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/alvo_informacao/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/alvo_informacao/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $alvo_informacao = new alvo_informacaoModel();
            $atualiza = $alvo_informacao->excluialvo_informacao( 'cdalvo_informacao='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($alvo_informacao->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/alvo_informacao/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $alvo_informacao = new alvo_informacaoModel();
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
            if ($alvo_informacao->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/alvo_informacao/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $alvo_informacao = new alvo_informacaoModel();
            $insere = $alvo_informacao->inserealvo_informacao($_POST, 'cdalvo_informacao');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/alvo_informacao/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/alvo_informacao/" );
            }

        }


        public function inserem( Array $dados = null ){
            $alvo_informacao = new alvo_informacaoModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['tipo'][0])) {
                $i=0;
                foreach ($dados['tipo'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_alvo_informacao[$key]=$dados[$key][$i];
                    }
                    $insere = $alvo_informacao->inserealvo_informacao($dados_alvo_informacao,'cdalvo_informacao');
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

            header( "Location: /".PROJETO."/alvo_informacao/" );


        }



        public function inserew(){
            $alvo_informacao = new alvo_informacaoModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='alvo_informacao') {
                    $dados['alvo_informacao'][$p[1]]=$value;
                }
            }

            $inserep = $alvo_informacao->inserealvo_informacao($dados['alvo_informacao'], 'cdalvo_informacao');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/alvo_informacao/" );
            

        }

        public function pesquisa(){
            $alvo_informacao = new alvo_informacaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $alvo = new alvoModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdalvo') ) {
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

            $pesquisa = $alvo_informacao->pesquisaalvo_informacao($w);
            $datas['alvo_informacao'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/alvo_informacao/index', $datas);

    }


}