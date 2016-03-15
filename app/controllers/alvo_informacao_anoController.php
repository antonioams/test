
<?php
session_start();
    class alvo_informacao_ano extends Controller{

        public function Index_action(){
		
		    header( "Location: /".PROJETO."/alvo_informacao_ano/novom" );
			 
            $alvo_informacao_ano = new alvo_informacao_anoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $alvo_informacao_ano_lista = $alvo_informacao_ano->listaalvo_informacao_ano("{$par}");

            $datas['alvo_informacao_ano'] = $alvo_informacao_ano_lista;

            if ($alvo_informacao_ano->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/alvo_informacao_ano/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $alvo_informacao_ano = new alvo_informacao_anoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
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
            if ($alvo_informacao_ano->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/alvo_informacao_ano/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $alvo_informacao_ano = new alvo_informacao_anoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $alvo_informacao = new alvo_informacaoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdalvo_informacao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_alvo_informacao = $alvo_informacao->listaalvo_informacao("cdalvo in (select cdalvo from alvo where cdprograma=".$_SESSION[PROJETO]['filtro']['cdprograma'].")");

            $datas['alvo_informacao'] = $detalhes_alvo_informacao;

			
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdalvo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
			 
            $alvo_informacao_ano_lista = $alvo_informacao_ano->listaalvo_informacao_ano("{$par}");

            $datas['alvo_informacao_ano'] = $alvo_informacao_ano_lista;

			
			$anos = new anosModel();
			$detalhes_anos = $anos->listaanos();
            $datas['anos'] = $detalhes_anos;
			
            $alvo = new alvoModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdalvo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_alvo = $alvo->listaalvo("{$par}");

            $datas['alvo'] = $detalhes_alvo;
            if ($alvo_informacao_ano->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/alvo_informacao_ano/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $alvo_informacao_ano = new alvo_informacao_anoModel();
            $id = $this->getParam('id');
            $detalhes_alvo_informacao_ano = $alvo_informacao_ano->listaalvo_informacao_ano('cdalvo_informacao_ano='.$id);
            $datas['alvo_informacao_ano'] = $detalhes_alvo_informacao_ano;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['alvo_informacao_ano'][0]['ano'] );
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
            if ($alvo_informacao_ano->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/alvo_informacao_ano/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $alvo_informacao_ano = new alvo_informacao_anoModel();
            $dados=$_POST;
            $atualiza = $alvo_informacao_ano->atualizaalvo_informacao_ano($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/alvo_informacao_ano/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/alvo_informacao_ano/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $alvo_informacao_ano = new alvo_informacao_anoModel();
            $atualiza = $alvo_informacao_ano->excluialvo_informacao_ano( 'cdalvo_informacao_ano='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($alvo_informacao_ano->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/alvo_informacao_ano/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $alvo_informacao_ano = new alvo_informacao_anoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
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
            if ($alvo_informacao_ano->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/alvo_informacao_ano/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $alvo_informacao_ano = new alvo_informacao_anoModel();
            $insere = $alvo_informacao_ano->inserealvo_informacao_ano($_POST, 'cdalvo_informacao_ano');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/alvo_informacao_ano/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/alvo_informacao_ano/" );
            }

        }


        public function inserem( Array $dados = null ){
            $alvo_informacao_ano = new alvo_informacao_anoModel();
            if ($dados == null) {$dados=$_POST;}

			$atualiza = $alvo_informacao_ano->excluialvo_informacao_ano( 'cdalvo='.$_SESSION[PROJETO]['filtro']['cdalvo'] );
            
			
			$anos = new anosModel();
			$detalhes_anos = $anos->listaanos();

            if (!empty($dados['cdalvo_informacao'][0])) {
                $i=0;
                foreach ($dados['cdalvo_informacao'] as $key2 => $value2) {
                
					foreach ($detalhes_anos as $ano) {	
					
				    $dados_alvo_informacao_ano['valor']=0;
					
					foreach ($dados as $key => $value) {
					    if (substr($key, 0, 5)=='valor') {
						     if (substr($key, 5, 4)==$ano['ano'])
						    $dados_alvo_informacao_ano['valor']=$dados[$key][$i];
							$dados_alvo_informacao_ano['ano']=$ano['ano'];
						} else {						
                        $dados_alvo_informacao_ano[$key]=$dados[$key][$i];
						}
                    }
                    $insere = $alvo_informacao_ano->inserealvo_informacao_ano($dados_alvo_informacao_ano,'cdalvo_informacao_ano');
                    
                
				}
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

            header( "Location: /".PROJETO."/alvo_informacao_ano/" );


        }



        public function inserew(){
            $alvo_informacao_ano = new alvo_informacao_anoModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='alvo_informacao_ano') {
                    $dados['alvo_informacao_ano'][$p[1]]=$value;
                }
            }

            $inserep = $alvo_informacao_ano->inserealvo_informacao_ano($dados['alvo_informacao_ano'], 'cdalvo_informacao_ano');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/alvo_informacao_ano/" );
            

        }

        public function pesquisa(){
            $alvo_informacao_ano = new alvo_informacao_anoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $alvo_informacao = new alvo_informacaoModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdalvo_informacao') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
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

            $pesquisa = $alvo_informacao_ano->pesquisaalvo_informacao_ano($w);
            $datas['alvo_informacao_ano'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/alvo_informacao_ano/index', $datas);

    }


}
