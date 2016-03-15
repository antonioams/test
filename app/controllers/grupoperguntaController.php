
<?php
session_start();
    class grupopergunta extends Controller{

        public function Index_action(){
            $grupopergunta = new grupoperguntaModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $grupopergunta_lista = $grupopergunta->listagrupopergunta("{$par}");

            $datas['grupopergunta'] = $grupopergunta_lista;

            if ($grupopergunta->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/grupopergunta/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $grupopergunta = new grupoperguntaModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $questionarios = new questionariosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdquestionario') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_questionarios = $questionarios->listaquestionarios("{$par}");

            $datas['questionarios'] = $detalhes_questionarios;
            if ($grupopergunta->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/grupopergunta/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



    public function inserej(){
        $questionarios = new questionariosModel();
            $grupopergunta = new grupoperguntaModel();
            $perguntas = new perguntasModel();
            $respostas = new respostasModel();
            foreach ($_POST as $key => $value) {
                      if (($key!='submit') and ($key!='campo1')) {
                        $dados_questionarios[$key]=$_POST[$key];
                    }
                    }
            $dados_questionarios['cdquestionario']=$_SESSION[PROJETO]['filtro']['cdquestionario'];
            $inseregrupo = $grupopergunta->inseregrupopergunta($dados_questionarios, 'cdgrupopergunta');

            $ee = $_POST['campo1'];
            $ee =json_decode($ee,true);
            $e = $ee['fields'];

$o=1;
foreach ($e as $key) {
        $dados_pergunta['cdgrupopergunta']=$inseregrupo;
        $dados_pergunta['descricao']=$key['label'];
        if ($key['required']==true) {
            $dados_pergunta['obrigatorio']=1;
        } else { $dados_pergunta['obrigatorio'] ='';}
        $dados_pergunta['tipo']=$key['field_type'];
        $dados_pergunta['ordem']=$o;
        $inserepergunta = $perguntas->insereperguntas($dados_pergunta, 'cdpergunta');
        foreach ($key['field_options'] as $key2) {
                if (is_array($key2)) {
                    // Insere multiplo
                    foreach ($key2 as $opcao) {
                      $resp =  $opcao['label'];
                      $dados_resposta['cdpergunta']=$inserepergunta;
                      $dados_resposta['descricao']=$resp;
                      $inserer = $respostas->insererespostas($dados_resposta, 'cdresposta');
                    }
                } else {
                    $dados_resposta['cdpergunta']=$inserepergunta;
                    $dados_resposta['descricao']=$key['label'];
                    $inserer = $respostas->insererespostas($dados_resposta, 'cdresposta');
                }
        }
        $o++;
    }

                if ($grupopergunta->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
            header( "Location: /".PROJETO."/grupopergunta/" );
            }


        }


  public function atualizaj(){
            $id = $this->getParam('id');
            $questionarios = new questionariosModel();
            $grupopergunta = new grupoperguntaModel();
            $perguntas = new perguntasModel();
            $respostas = new respostasModel();
                        
            if (empty($_POST['ativo'])) {$_POST['ativo']='';}
            
            foreach ($_POST as $key => $value) {
                      if (($key!='submit') and ($key!='campo1')) {
                        $dados_questionarios[$key]=$_POST[$key];
                    }
                    }
                    

            $atualiza = $grupopergunta->atualizagrupopergunta($dados_questionarios, $id );
            $inseregrupo = $id;

            $ee = $_POST['campo1'];
            $ee =json_decode($ee,true);
            //print_r($ee);die();
            $e = $ee['fields'];
            $p='0';
            $r='0';

    $o=1;
    foreach ($e as $key) {
        $dados_pergunta['cdgrupopergunta']=$inseregrupo;
        $dados_pergunta['descricao']=$key['label'];
        if ($key['required']==true) {
            $dados_pergunta['obrigatorio']=1;
        } else { $dados_pergunta['obrigatorio'] ='';}
        $dados_pergunta['tipo']=$key['field_type'];
        $dados_pergunta['ordem']=$o;
        if ($key['id']!='') {        
        $atualizapergunta = $perguntas->atualizaperguntas($dados_pergunta, $key['id']);
        $p=$p.','.$key['id'];
        $inserepergunta=$key['id'];
        } else {
        $inserepergunta = $perguntas->insereperguntas($dados_pergunta, 'cdpergunta');
        $p=$p.','.$inserepergunta;
        }
        foreach ($key['field_options'] as $key2) {
                if (is_array($key2)) {
                    // Insere multiplo
                    foreach ($key2 as $opcao) {                    
                      $resp =  $opcao['label'];
                      $dados_resposta['cdpergunta']=$inserepergunta;
                      $dados_resposta['descricao']=$resp;
                      if ($opcao['id2']!='') {
                        $atualizar = $respostas->atualizarespostas($dados_resposta, $opcao['id2']);
                        $r=$r.','.$opcao['id2'];                      
                      } else {
                        $inserer = $respostas->insererespostas($dados_resposta, 'cdresposta');
                        $r=$r.','.$inserer; 
                      }
                    }
                } else {
                    $dados_resposta['cdpergunta']=$inserepergunta;
                    $dados_resposta['descricao']=$key['label'];
                    if ($key['field_options']['id2']!='') {
                      $atualizar = $respostas->atualizarespostas($dados_resposta, $key['field_options']['id2']); 
                      $r=$r.','.$key['field_options']['id2'];                     
                    } else {
                      $inserer = $respostas->insererespostas($dados_resposta, 'cdresposta');
                      $r=$r.','.$inserer; 
                    }
                }
        }
        $o++;
    }


            $erespostas = $respostas->excluirespostas( 'cdpergunta in ( select cdpergunta from pergunta where cdgrupopergunta='.$id.') and cdresposta not in ('.$r.')' );
            $eperguntas = $perguntas->excluiperguntas( 'cdgrupopergunta='.$id.' and cdpergunta not in ('.$p.')' );
            
            if ($grupopergunta->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
            header( "Location: /".PROJETO."/grupopergunta/" );
            }


        }


        public function novom(){
            $grupopergunta = new grupoperguntaModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $questionarios = new questionariosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdquestionario') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_questionarios = $questionarios->listaquestionarios("{$par}");

            $datas['questionarios'] = $detalhes_questionarios;
            if ($grupopergunta->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/grupopergunta/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $grupopergunta = new grupoperguntaModel();
            $id = $this->getParam('id');
            $detalhes_grupopergunta = $grupopergunta->listagrupopergunta('cdgrupopergunta='.$id);
            $datas['grupopergunta'] = $detalhes_grupopergunta;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['grupopergunta'][0]['descricao'] );
            $questionarios = new questionariosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdquestionario') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_questionarios = $questionarios->listaquestionarios("{$par}");

            $datas['questionarios'] = $detalhes_questionarios;
            
            
            $tipos = new tiposModel();


            $detalhes_tipos = $tipos->listatipos("");

            $datas['tipos'] = $detalhes_tipos;

            $perguntas = new perguntasModel();
            $respostas = new respostasModel();
            $detalhes_perguntas = $perguntas->listaperguntas('cdgrupopergunta='.$id);
            $js='';
            foreach ($detalhes_perguntas as $pergunta) {
                 if ($pergunta['obrigatorio']=='1') { $ob='true';} else {$ob='false';}
                 if ($js!='') {$js.=',';}
                 $js .= '{"label":"'.$pergunta['descricao'].'","field_type":"'.$pergunta['tipo'].'","required":'.$ob.',"field_options":{';
                 $detalhes_respostas = $respostas->listarespostas('cdpergunta='.$pergunta['cdpergunta']);                 
                        if ( ($pergunta['tipo']=='LISTA') or ($pergunta['tipo']=='LISTA MULTIPLA') ) {
                            $js .= '"options":[';                             
                             $r='';
                             foreach ($detalhes_respostas as $resposta) {
                                  if ($r!='') {$r.=',';}
                                    $r .= '{"label":"'.$resposta['descricao'].'","checked":false, "id2":'.$resposta['cdresposta'].'}';
                             }
                             $js .= $r.']},';
                        } elseif ($pergunta['tipo']=='DATA') {
                            $js .= '}, ';
                        } else {
                            $js .= '"size":"small", "id2":'.$detalhes_respostas[0]['cdresposta'].'}, ';
                        }
                 $js .= '"id":"'.$pergunta['cdpergunta'].'"}';

            }
                $datas['js'] = $js;
                            
            if ($grupopergunta->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/grupopergunta/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $grupopergunta = new grupoperguntaModel();
            $dados=$_POST;
            $atualiza = $grupopergunta->atualizagrupopergunta($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/grupopergunta/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/grupopergunta/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $grupopergunta = new grupoperguntaModel();
            $perguntas = new perguntasModel();
            $respostas = new respostasModel();
            
            $atualiza2 = $respostas->excluirespostas( 'cdresposta in (select r.cdresposta from resposta r, pergunta p where r.cdpergunta=p.cdpergunta and p.cdgrupopergunta='.$id.')');
            $atualiza3 = $perguntas->excluiperguntas( 'cdpergunta in (select cdpergunta pergunta where cdgrupopergunta='.$id.')');
            $atualiza = $grupopergunta->excluigrupopergunta( 'cdgrupopergunta='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($grupopergunta->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/grupopergunta/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $grupopergunta = new grupoperguntaModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $questionarios = new questionariosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdquestionario') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_questionarios = $questionarios->listaquestionarios("{$par}");

            $datas['questionarios'] = $detalhes_questionarios;
            if ($grupopergunta->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/grupopergunta/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $grupopergunta = new grupoperguntaModel();
            $insere = $grupopergunta->inseregrupopergunta($_POST, 'cdgrupopergunta');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/grupopergunta/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/grupopergunta/" );
            }

        }


        public function inserem( Array $dados = null ){
            $grupopergunta = new grupoperguntaModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['descricao'][0])) {
                $i=0;
                foreach ($dados['descricao'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_grupopergunta[$key]=$dados[$key][$i];
                    }
                    $insere = $grupopergunta->inseregrupopergunta($dados_grupopergunta,'cdgrupopergunta');
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

            header( "Location: /".PROJETO."/grupopergunta/" );


        }



        public function inserew(){
            $grupopergunta = new grupoperguntaModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='grupopergunta') {
                    $dados['grupopergunta'][$p[1]]=$value;
                }
            }

            $inserep = $grupopergunta->inseregrupopergunta($dados['grupopergunta'], 'cdgrupopergunta');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/grupopergunta/" );
            

        }

        public function pesquisa(){
            $grupopergunta = new grupoperguntaModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $questionarios = new questionariosModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdquestionario') ) {
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

            $pesquisa = $grupopergunta->pesquisagrupopergunta($w);
            $datas['grupopergunta'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/grupopergunta/index', $datas);

    }


}
