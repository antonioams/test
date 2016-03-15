
<?php
session_start();
    class resposta_projeto extends Controller{

        public function Index_action(){
            $resposta_projeto = new resposta_projetoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor'];
                }
            }
            $projetos = new projetosModel();
            $detalhes_projetos = $projetos->listaprojetos('cdprojeto='.$_SESSION[PROJETO]['filtro']['cdprojeto']);

            $questionarios = new questionariosModel('cdtipo='.$detalhes_projetos[0]['cdtipo']);
            $detalhes_questionarios = $questionarios->listaquestionarios();

            $datas['pagina']='  <div class="box-tab">
                                    <ul class="nav nav-tabs">';
            $i=0;
            foreach ($detalhes_questionarios as $questionario) {
            if ($i==0) {$ac=' class="active"';} else {$ac='';}
            $datas['pagina'].='     <li'.$ac.'><a href="#q'.$questionario['cdquestionario'].'" data-toggle="tab">'.$questionario['descricao'].'</a></li>';
            $i++;
            }

            $datas['pagina'].='     </ul>
                                    <div class="tab-content">';

            $i=0;
            foreach ($detalhes_questionarios as $questionario) {
            if ($i==0) {$ac='  active in';} else {$ac='';}
            $datas['pagina'].='    <div class="tab-pane fade'.$ac.'" id="q'.$questionario['cdquestionario'].'">';

            // grupos de perguntas
            $grupopergunta = new grupoperguntaModel();
            $detalhes_grupopergunta = $grupopergunta->listagrupopergunta("ativo=1 and cdquestionario=".$questionario['cdquestionario']);


            $datas['pagina'].='       <div class="panel-group" id="accordion">';

            $i=0;
            foreach ($detalhes_grupopergunta as $grupo) {
            if ($i==0) {$ac=' in';} else {$ac='';}

            $datas['pagina'].='
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#g'.$grupo['cdgrupopergunta'].'">
                                                    '.$grupo['descricao'].'
                                                </a>
                                            </div>
                                            <div id="g'.$grupo['cdgrupopergunta'].'" class="panel-collapse collapse'.$ac.'">
                                                <div class="panel-body">';

            // perguntas
            $perguntas = new perguntasModel();
            $detalhes_perguntas = $perguntas->listaperguntas("cdgrupopergunta=".$grupo['cdgrupopergunta']);


            foreach ($detalhes_perguntas as $pergunta) {

            // respostas
            $respostas = new respostasModel();
            $detalhes_respostas = $respostas->listarespostas("cdpergunta=".$pergunta['cdpergunta']);

$ob='';
if ($pergunta['obrigatorio']=='1') {$ob='*';}
if ($pergunta['tipo']=='DATA'){
$resposta_projeto_lista = $resposta_projeto->listaresposta_projeto("cdresposta=".$detalhes_respostas[0]['cdresposta']." and cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']);
$datas['pagina'] .= '
<div class="form-group">
<label  class="control-label">'.$pergunta['descricao'].$ob.'</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="date" name="r'.$detalhes_respostas[0]['cdresposta'].'" type="text" value="'.$resposta_projeto_lista[0]['resposta'].'" class="form-control" placeholder="99/99/9999"'.$ob.' data-parsley-trigger="change"/></div></div>
</div></div>
';
} elseif ( ($pergunta['tipo']=='NUMERO')){
$resposta_projeto_lista = $resposta_projeto->listaresposta_projeto("cdresposta=".$detalhes_respostas[0]['cdresposta']." and cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']);
$datas['pagina'] .= '
<div class="form-group">
<label  class="control-label">'.$pergunta['descricao'].$ob.'</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="'.$detalhes_respostas[0]['cdresposta'].'" name="r'.$detalhes_respostas[0]['cdresposta'].'" type="text" value="'.$resposta_projeto_lista[0]['resposta'].'" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$pergunta['descricao'].'" data-parsley-type="digits"/></div></div>
</div></div>
';
} elseif ( $pergunta['tipo']=='TEXTO LONGO'){
$resposta_projeto_lista = $resposta_projeto->listaresposta_projeto("cdresposta=".$detalhes_respostas[0]['cdresposta']." and cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']);
$datas['pagina'] .= '
<div class="form-group">
<label  class="control-label">'.$pergunta['descricao'].$ob.'</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="r'.$detalhes_respostas[0]['cdresposta'].'" rows="4">'.$resposta_projeto_lista[0]['resposta'].'</textarea>
</div></div>
</div></div>
';
} elseif ( $pergunta['tipo']=='ANEXO'){
$resposta_projeto_lista = $resposta_projeto->listaresposta_projeto("cdresposta=".$detalhes_respostas[0]['cdresposta']." and cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']);
$datas['pagina'] .= '
<div class="form-group">
<label  class="control-label">'.$pergunta['descricao'].$ob.'</label>
<div class="controls">
<div class="row"><div class="col-xs-12">';
if ($resposta_projeto_lista[0]['resposta']!='') {
$datas['pagina'] .= '
<a href="http://200.98.201.124/'.PROJETO.'/inc/arquivo/complemento/'.$resposta_projeto_lista[0]['cdresposta'].'_'.$resposta_projeto_lista[0]['resposta'].'" target="_blank""><img src="/'.PROJETO.'/inc/img/download.jpg" width="30" height="30"><br>'.$resposta_projeto_lista[0]['resposta'].'</a>
<a href="/'.PROJETO.'/resposta_projeto/exclui/id/'.$resposta_projeto_lista[0]['cdresposta'].'" ><img src="/'.PROJETO.'/inc/img/del.jpg" width="15" height="15"></a><br>
';
}
$datas['pagina'] .= '
<input id="'.$detalhes_respostas[0]['cdresposta'].'" name="r'.$detalhes_respostas[0]['cdresposta'].'" type="file" value="" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$pergunta['descricao'].'"/></div></div>
</div></div>
';
} elseif (( $pergunta['tipo']=='LISTA') ) {

$datas['pagina'] .= '
<div class="form-group">
<label  class="control-label">'.$pergunta['descricao'].$ob.'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$detalhes_respostas[0]['cdresposta'].'" name="c'.$detalhes_respostas[0]['cdresposta'].'" data-parsley-trigger="change">
  <option value=""></option>';

    foreach ($detalhes_respostas as $resposta) {

        $resposta_projeto_lista = $resposta_projeto->listaresposta_projeto("cdresposta=".$resposta['cdresposta']." and cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']);

       if ($resposta_projeto_lista[0]['cdresposta']!='') {$ch=' selected';} else {$ch='';}
       $datas['pagina'] .= '<option value="'.$resposta['cdresposta'].'"'.$ch.'>'.$resposta['descricao'].'</option>';
    }
    $datas['pagina'] .= '   </select></div></div>
                        </div></div>';

} elseif (( $pergunta['tipo']=='LISTA MULTIPLA') ) {


$datas['pagina'] .= '
<div class="form-group">
<label  class="control-label">'.$pergunta['descricao'].$ob.'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$detalhes_respostas[0]['cdresposta'].'" name="c'.$detalhes_respostas[0]['cdresposta'].'[]" data-parsley-trigger="change" multiple>
  <option value=""></option>';

    $resposta_projeto_lista = $resposta_projeto->listaresposta_projeto("cdresposta=".$detalhes_respostas[0]['cdresposta']." and cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']);
    $respmarc = explode( ',' , $resposta_projeto_lista[0]['resposta']);    
    foreach ($detalhes_respostas as $resposta) {
     
          if (in_array($resposta['cdresposta'],$respmarc)) {$ch=' selected';} else {$ch='';}  
       
       $datas['pagina'] .= '<option value="'.$resposta['cdresposta'].'"'.$ch.'>'.$resposta['descricao'].'</option>';
    }
    $datas['pagina'] .= '   </select></div></div>
                        </div></div>';

}   else {
    $resposta_projeto_lista = $resposta_projeto->listaresposta_projeto("cdresposta=".$detalhes_respostas[0]['cdresposta']." and cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']);
$datas['pagina'] .= '
<div class="form-group">
<label  class="control-label">'.$pergunta['descricao'].$ob.'</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="'.$detalhes_respostas[0]['cdresposta'].'" name="r'.$detalhes_respostas[0]['cdresposta'].'" type="text" value="'.$resposta_projeto_lista[0]['resposta'].'" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$pergunta['descricao'].'"/></div></div>
</div></div>
';
}

            } // fim pergunta


            $datas['pagina'].='              </div>
                                            </div>
                                        </div>';
            $i++;
            }

             $datas['pagina'].='       </div>';


            $datas['pagina'].='     </div>';
            $i++;
            }

            $datas['pagina'].='     </div>
                                    </div>';


            if ($resposta_projeto->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/resposta_projeto/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }








        public function novo(){
           $resposta_projeto = new resposta_projetoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $respostas = new respostasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdresposta') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_respostas = $respostas->listarespostas("{$par}");

            $datas['respostas'] = $detalhes_respostas;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($resposta_projeto->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/resposta_projeto/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $resposta_projeto = new resposta_projetoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $respostas = new respostasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdresposta') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_respostas = $respostas->listarespostas("{$par}");

            $datas['respostas'] = $detalhes_respostas;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($resposta_projeto->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/resposta_projeto/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $resposta_projeto = new resposta_projetoModel();
            $id = $this->getParam('id');
            $detalhes_resposta_projeto = $resposta_projeto->listaresposta_projeto('cdresposta_projeto='.$id);
            $datas['resposta_projeto'] = $detalhes_resposta_projeto;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['resposta_projeto'][0]['resposta'] );
            $respostas = new respostasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdresposta') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_respostas = $respostas->listarespostas("{$par}");

            $datas['respostas'] = $detalhes_respostas;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($resposta_projeto->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/resposta_projeto/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $resposta_projeto = new resposta_projetoModel();
            $dados=$_POST;
            $atualiza = $resposta_projeto->atualizaresposta_projeto($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/resposta_projeto/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/resposta_projeto/" );

            }

        }

        public function exclui(){
            $resposta_projeto = new resposta_projetoModel();
            $id = $this->getParam('id');
            $atualiza = $resposta_projeto->excluiresposta_projeto( 'cdprojeto='.$_SESSION[PROJETO]['filtro']['cdprojeto'].' and cdresposta ='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($resposta_projeto->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/resposta_projeto/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $resposta_projeto = new resposta_projetoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $respostas = new respostasModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdresposta') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_respostas = $respostas->listarespostas("{$par}");

            $datas['respostas'] = $detalhes_respostas;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($resposta_projeto->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/resposta_projeto/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){

        $resposta_projeto = new resposta_projetoModel();

        foreach ( $_FILES as $varq => $arq ){
        if(isset($arq['name']) && $arq["error"] == 0)
        {

        $arquivo_tmp = $arq['tmp_name'];
        $nome = $arq['name'];
        $destino = '/var/www/'.PROJETO.'/inc/arquivo/complemento/' .substr($varq, 1).'_'.$nome;
        $ida ='0';
        if( move_uploaded_file( $arquivo_tmp, $destino  ))
        {
            $ida .=','.substr($varq, 1);
            $dados['cdresposta']=substr($varq, 1);
            $dados['resposta']=$nome;
            $dados['cdprojeto']=$_SESSION[PROJETO]['filtro']['cdprojeto'];
            $atualiza = $resposta_projeto->excluiresposta_projeto( 'cdprojeto='.$_SESSION[PROJETO]['filtro']['cdprojeto'].' and cdresposta='.substr($varq, 1) );
            $insere = $resposta_projeto->insereresposta_projeto($dados, 'cdresposta_projeto');
        }
        else { die("Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />");}
        }
    }


    $atualiza = $resposta_projeto->excluiresposta_projeto( 'cdprojeto='.$_SESSION[PROJETO]['filtro']['cdprojeto'].' and cdresposta not in ('.$ida.')' );

           foreach ( $_POST as $key => $value ){
            $dados='';
                if ( ( $key !='submit') and ( $value !='') ) {
                    if ($key{0}=='r') {
                        $dados['cdresposta']=substr($key, 1);
                        $dados['resposta']=$value;
                        $dados['cdprojeto']=$_SESSION[PROJETO]['filtro']['cdprojeto'];
                        $insere = $resposta_projeto->insereresposta_projeto($dados, 'cdresposta_projeto');

                    } elseif ($key{0}=='c') {
                        if (is_array($value)) {
                        $dados['cdresposta']=substr($key, 1);
                        $value=implode( ',' , $value);
                        $dados['resposta']=$value;
                        } else {
                        $dados['cdresposta']=$value;
                        }                         

                        $dados['cdprojeto']=$_SESSION[PROJETO]['filtro']['cdprojeto'];
                        $insere = $resposta_projeto->insereresposta_projeto($dados, 'cdresposta_projeto');
                    }

            }
        }

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/resposta_projeto/" );
            } else {
            header( "Location: /".PROJETO."/resposta_projeto/" );
            }

        }


        public function inserem( Array $dados = null ){
            $resposta_projeto = new resposta_projetoModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['resposta'][0])) {
                $i=0;
                foreach ($dados['resposta'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_resposta_projeto[$key]=$dados[$key][$i];
                    }
                    $insere = $resposta_projeto->insereresposta_projeto($dados_resposta_projeto,'cdresposta_projeto');
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

            header( "Location: /".PROJETO."/resposta_projeto/" );


        }

        public function pesquisa(){
            $resposta_projeto = new resposta_projetoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $respostas = new respostasModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdresposta') ) {
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

            $pesquisa = $resposta_projeto->pesquisaresposta_projeto($w);
            $datas['resposta_projeto'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/resposta_projeto/index', $datas);

    }


}
