
<?php
session_start();
    class documento_valor extends Controller{

        public function Index_action(){            
            $documento_valor = new documento_valorModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor'];
                }
            }
            
            $projetos = new projetosModel();
            $detalhes_projetos = $projetos->listaprojetos('cdprojeto='.$_SESSION[PROJETO]['filtro']['cdprojeto']);
            

            $fases = new fasesModel();
            $detalhes_fases = $fases->listafases('cdtipo='.$detalhes_projetos[0]['cdtipo']);

            $datas['pagina']='  <div class="box-tab">
                                    <ul class="nav nav-tabs">';
            $i=0;
            foreach ($detalhes_fases as $fase) {
            if ($i==0) {$ac=' class="active"';} else {$ac='';}
            $datas['pagina'].='     <li'.$ac.'><a href="#q'.$fase['cdfase'].'" data-toggle="tab">'.$fase['nome'].'</a></li>';
            $i++;
            }

            $datas['pagina'].='     </ul>
                                    <div class="tab-content">';

            $i=0;
            foreach ($detalhes_fases as $fase) {
            if ($i==0) {$ac='  active in';} else {$ac='';}
            $datas['pagina'].='    <div class="tab-pane fade'.$ac.'" id="q'.$fase['cdfase'].'">';

            // grupos de documentos
            $grupodocumento = new grupodocumentoModel();
            $detalhes_grupodocumento = $grupodocumento->listagrupodocumento("ativo=1 and cdfase=".$fase['cdfase']);


            $datas['pagina'].='       <div class="panel-group" id="accordion">';

            $i=0;
            foreach ($detalhes_grupodocumento as $grupo) {
            if ($i==0) {$ac=' in';} else {$ac='';}

            $datas['pagina'].='
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#g'.$grupo['cdgrupodocumento'].'">
                                                    '.$grupo['descricao'].'
                                                </a>
                                            </div>
                                            <div id="g'.$grupo['cdgrupodocumento'].'" class="panel-collapse collapse'.$ac.'">
                                                <div class="panel-body">';

            // documentos
            $documentos = new documentosModel();
            $detalhes_documentos = $documentos->listadocumentos("cdgrupodocumento=".$grupo['cdgrupodocumento']);


            foreach ($detalhes_documentos as $documento) {

            // campos
            $campos = new camposModel();
            $detalhes_campos = $campos->listacampos("cddocumento=".$documento['cddocumento']);

$ob='';
if ($documento['obrigatorio']=='1') {$ob='*';}
if ($documento['tipo']=='DATA'){
$documento_valor_lista = $documento_valor->listadocumento_valor("cdcampo=".$detalhes_campos[0]['cdcampo']." and cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']);
$datas['pagina'] .= '
<div class="form-group">
<label  class="control-label">'.$documento['descricao'].$ob.'</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="date" name="r'.$detalhes_campos[0]['cdcampo'].'" type="text" value="'.$documento_valor_lista[0]['valor'].'" class="form-control" placeholder="99/99/9999"'.$ob.' data-parsley-trigger="change"/></div></div>
</div></div>
';
} elseif ( ($documento['tipo']=='NUMERO')){
$documento_valor_lista = $documento_valor->listadocumento_valor("cdcampo=".$detalhes_campos[0]['cdcampo']." and cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']);
$datas['pagina'] .= '
<div class="form-group">
<label  class="control-label">'.$documento['descricao'].$ob.'</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="'.$detalhes_campos[0]['cdcampo'].'" name="r'.$detalhes_campos[0]['cdcampo'].'" type="text" value="'.$documento_valor_lista[0]['valor'].'" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$documento['descricao'].'" data-parsley-type="digits"/></div></div>
</div></div>
';
} elseif ( $documento['tipo']=='TEXTO LONGO'){
$documento_valor_lista = $documento_valor->listadocumento_valor("cdcampo=".$detalhes_campos[0]['cdcampo']." and cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']);
$datas['pagina'] .= '
<div class="form-group">
<label  class="control-label">'.$documento['descricao'].$ob.'</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="r'.$detalhes_campos[0]['cdcampo'].'" rows="4">'.$documento_valor_lista[0]['valor'].'</textarea>
</div></div>
</div></div>
';
} elseif ( $documento['tipo']=='ANEXO'){
$documento_valor_lista = $documento_valor->listadocumento_valor("cdcampo=".$detalhes_campos[0]['cdcampo']." and cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']);
$datas['pagina'] .= '
<div class="form-group">
<label  class="control-label">'.$documento['descricao'].$ob.'</label>
<div class="controls">
<div class="row"><div class="col-xs-12">';
if ($documento_valor_lista[0]['valor']!='') {

$datas['pagina'] .= '
<div class="col-md-6">
<table class="table no-m">
 <tbody>';

foreach ($documento_valor_lista as $dvl) {

$datas['pagina'] .= '
    <tr>
       <td>'.date('d/m/Y H:i:s', strtotime( $dvl['datahora'])).'</td>
       <td>'.$dvl['valor'].'</td>
       <td><a class="btn btn-default btn-xs" href="http://200.98.201.124/'.PROJETO.'/inc/arquivo/checklist/'.$dvl['cdcampo'].'_'.$dvl['valor'].'" target="_blank""><i class="fa fa fa-search"> visualizar</i></a> <a class="btn btn-danger btn-xs" href="/'.PROJETO.'/documento_valor/exclui/id/'.$dvl['cddocumento_valor'].'" ><i class="fa fa fa-remove"> excluir</i></a></td>       
    </tr>
';
}
$datas['pagina'] .= '
  </tbody>
</table>
</div>';

}
$datas['pagina'] .= '
<input id="'.$detalhes_campos[0]['cdcampo'].'" name="r'.$detalhes_campos[0]['cdcampo'].'[]" type="file" value="" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$documento['descricao'].'" multiple/></div></div>
</div></div>                               
';
} elseif (( $documento['tipo']=='LISTA') ) {

$datas['pagina'] .= '
<div class="form-group">
<label  class="control-label">'.$documento['descricao'].$ob.'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$detalhes_campos[0]['cdcampo'].'" name="c'.$detalhes_campos[0]['cdcampo'].'" data-parsley-trigger="change">
  <option value=""></option>';

    foreach ($detalhes_campos as $campo) {

        $documento_valor_lista = $documento_valor->listadocumento_valor("cdcampo=".$campo['cdcampo']." and cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']);

       if ($documento_valor_lista[0]['cdcampo']!='') {$ch=' selected';} else {$ch='';}
       $datas['pagina'] .= '<option value="'.$campo['cdcampo'].'"'.$ch.'>'.$campo['descricao'].'</option>';
    }
    $datas['pagina'] .= '   </select></div></div>
                        </div></div>';

} elseif (( $documento['tipo']=='LISTA MULTIPLA') ) {


$datas['pagina'] .= '
<div class="form-group">
<label  class="control-label">'.$documento['descricao'].$ob.'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$detalhes_campos[0]['cdcampo'].'" name="c'.$detalhes_campos[0]['cdcampo'].'[]" data-parsley-trigger="change" multiple>
  <option value=""></option>';
  
    $documento_valor_lista = $documento_valor->listadocumento_valor("cdcampo=".$detalhes_campos[0]['cdcampo']." and cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']);
    $respmarc = explode( ',' , $documento_valor_lista[0]['valor']);

    foreach ($detalhes_campos as $campo) {

      if (in_array($campo['cdcampo'],$respmarc)) {$ch=' selected';} else {$ch='';}      

       $datas['pagina'] .= '<option value="'.$campo['cdcampo'].'"'.$ch.'>'.$campo['descricao'].'</option>';
    }
    $datas['pagina'] .= '   </select></div></div>
                        </div></div>';

}   else {
    $documento_valor_lista = $documento_valor->listadocumento_valor("cdcampo=".$detalhes_campos[0]['cdcampo']." and cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']);
$datas['pagina'] .= '
<div class="form-group">
<label  class="control-label">'.$documento['descricao'].$ob.'</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="'.$detalhes_campos[0]['cdcampo'].'" name="r'.$detalhes_campos[0]['cdcampo'].'" type="text" value="'.$documento_valor_lista[0]['valor'].'" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$documento['descricao'].'"/></div></div>
</div></div>
';
}

            } // fim documento


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


            if ($documento_valor->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/documento_valor/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }


        public function novo(){
           $documento_valor = new documento_valorModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $documento_campos = new documento_camposModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcampo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_documento_campos = $documento_campos->listadocumento_campos("{$par}");

            $datas['documento_campos'] = $detalhes_documento_campos;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($documento_valor->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/documento_valor/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $documento_valor = new documento_valorModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $documento_campos = new documento_camposModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcampo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_documento_campos = $documento_campos->listadocumento_campos("{$par}");

            $datas['documento_campos'] = $detalhes_documento_campos;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($documento_valor->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/documento_valor/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $documento_valor = new documento_valorModel();
            $id = $this->getParam('id');
            $detalhes_documento_valor = $documento_valor->listadocumento_valor('cddocumento_valor='.$id);
            $datas['documento_valor'] = $detalhes_documento_valor;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['documento_valor'][0]['valor'] );
            $documento_campos = new documento_camposModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcampo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_documento_campos = $documento_campos->listadocumento_campos("{$par}");

            $datas['documento_campos'] = $detalhes_documento_campos;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($documento_valor->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/documento_valor/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $documento_valor = new documento_valorModel();
            $dados=$_POST;
            $atualiza = $documento_valor->atualizadocumento_valor($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/documento_valor/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/documento_valor/" );

            }

        }

        public function exclui(){

            $documento_valor = new documento_valorModel();
            $id = $this->getParam('id');
            $atualiza = $documento_valor->excluidocumento_valor( 'cdprojeto='.$_SESSION[PROJETO]['filtro']['cdprojeto'].' and cddocumento_valor ='.$id  );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($documento_valor->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/documento_valor/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }

        }

        public function pesquisar(){
            $documento_valor = new documento_valorModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $documento_campos = new documento_camposModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcampo') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_documento_campos = $documento_campos->listadocumento_campos("{$par}");

            $datas['documento_campos'] = $detalhes_documento_campos;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($documento_valor->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/documento_valor/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $documento_valor = new documento_valorModel();

        $ida ='0';
        
        //print_r($_FILES);die();
        
        
        $atualiza = $documento_valor->excluidocumento_valor("cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']." and cdcampo not in ( select c.cdcampo from campo c, documento d where c.cddocumento=d.cddocumento and d.tipo='ANEXO')"  );
         

        foreach ( $_FILES as $varq => $arq ){
        $i=0;
        foreach ( $_FILES[$varq]['name'] as $varquivo => $arquivo) {
        	
        
        
        if(isset($_FILES[$varq]['name'][$i]) && $_FILES[$varq]['error'][$i] == 0)
        {

        $arquivo_tmp = $_FILES[$varq]['tmp_name'][$i];
        $nome = $_FILES[$varq]['name'][$i];
        $destino = '/var/www/'.PROJETO.'/inc/arquivo/checklist/' .substr($varq, 1).'_'. $nome; 
        
        if( move_uploaded_file( $arquivo_tmp, $destino  ))
        {
            $ida .=','.substr($varq, 1);
            $dados['cdcampo']=substr($varq, 1);
            $dados['valor']=$nome;
            $dados['cdprojeto']=$_SESSION[PROJETO]['filtro']['cdprojeto'];
            //$atualiza = $documento_valor->excluidocumento_valor( 'cdprojeto='.$_SESSION[PROJETO]['filtro']['cdprojeto'].' and cdcampo='.substr($varq, 1) );
            $insere = $documento_valor->inseredocumento_valor($dados, 'cddocumento_valor');
        }
        else { die("Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />");}
        }
        $i++;
    }
    }
		

           foreach ( $_POST as $key => $value ){
            $dados='';
                if ( ( $key !='submit') and ( $value !='') ) {
                    if ($key{0}=='r') {
                        $dados['cdcampo']=substr($key, 1);
                        $dados['valor']=$value;
                        $dados['cdprojeto']=$_SESSION[PROJETO]['filtro']['cdprojeto'];
                        $insere = $documento_valor->inseredocumento_valor($dados, 'cddocumento_valor');
                    } elseif ($key{0}=='c') {
                        if (is_array($value)) {
                        $dados['cdcampo']=substr($key, 1);
                        $value=implode( ',' , $value);
                        $dados['valor']=$value;
                        } else {
                        $dados['cdcampo']=$value;
                        }                         

                        $dados['cdprojeto']=$_SESSION[PROJETO]['filtro']['cdprojeto'];
                        $insere = $documento_valor->inseredocumento_valor($dados, 'cddocumento_valor');
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
            header( "Location: /".PROJETO."/documento_valor/" );
            } else {
            header( "Location: /".PROJETO."/documento_valor/" );
            }

        }


        public function inserem( Array $dados = null ){
            $documento_valor = new documento_valorModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['valor'][0])) {
                $i=0;
                foreach ($dados['valor'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_documento_valor[$key]=$dados[$key][$i];
                    }
                    $insere = $documento_valor->inseredocumento_valor($dados_documento_valor,'cddocumento_valor');
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

            header( "Location: /".PROJETO."/documento_valor/" );


        }

        public function pesquisa(){
            $documento_valor = new documento_valorModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $documento_campos = new documento_camposModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcampo') ) {
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

            $pesquisa = $documento_valor->pesquisadocumento_valor($w);
            $datas['documento_valor'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/documento_valor/index', $datas);

    }


}
