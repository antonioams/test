<?php
    class Controller extends System{

        protected function view( $nome, $vars = null ){
            if( is_array($vars) && count($vars) > 0 )
                extract ($vars, EXTR_PREFIX_ALL, 'view');

            $file = VIEWS .$nome. '.php';
            $con = $nome;

                if ( !file_exists($file) )
                    die("Houve um erro. View nao existe.");

                require_once( $file );
        }




        protected function importarcampos($dados, $id, $colunas_modulo, $moduloscampos ){

            $del_modulocampo = $moduloscampos->excluiModuloscampos('cdmodulo='.$id);
            foreach ($colunas_modulo as $key => $value) {
                $dadoscampo='';
                $dadoscampo['cdmodulo']= $id;
                $dadoscampo['campo']= $colunas_modulo[$key]['nome'];

                if ($colunas_modulo[$key]['nome']=='descricao') {
                    $dadoscampo['legenda']= 'Descrição';
                } elseif ( substr($colunas_modulo[$key]['nome'],0,2)=='cd') {
                    $dadoscampo['legenda']= strtoupper ($colunas_modulo[$key]['nome']{2}).substr($colunas_modulo[$key]['nome'],3);
                } else {
                $dadoscampo['legenda']= strtoupper ($colunas_modulo[$key]['nome']{0}).substr($colunas_modulo[$key]['nome'],1);
                }

                if ($key==0) {
                    $dadoscampo['cchave']=1;
                    $dadoscampo['visual']=1;
                    $dadoscampo['legenda']='Código';
                } elseif ($key==1) {
                    $dadoscampo['cdescritivo']=1;
                    $dadoscampo['visual']=1;
                    $dadoscampo['cordem']=1;
                }

                if (substr($colunas_modulo[$key]['tipo'],0,3)=='int') {
                    $dadoscampo['tipo']='inteiro';
                } elseif (substr($colunas_modulo[$key]['tipo'],0,5)=='float') {
                    $dadoscampo['tipo']='numero';
                } elseif (substr($colunas_modulo[$key]['tipo'],0,4)=='text') {
                    $dadoscampo['tipo']='texto longo';
                } elseif (substr($colunas_modulo[$key]['tipo'],0,4)=='date') {
                    $dadoscampo['tipo']='data';
                } elseif (substr($colunas_modulo[$key]['tipo'],0,5)=='times') {
                    $dadoscampo['tipo']='data/hora';
                } else {
                $dadoscampo['tipo']= 'texto';
                }

                $detalhes_modulocampo = $moduloscampos->insereModuloscampos($dadoscampo,'cdcampo');
            }

        }



    protected function gerarmodel($dir, $entidade, $chave){

           $codigo = '
  <?php
    class '.$dir.'Model extends Model{
        public $_tabela = "'.$entidade.'";

        public function lista'.$dir.'( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, \''.$chave.' DESC\' );
        }

        public function atualiza'.$dir.'( $dados, $where ){
            return $this->update( $dados, \''.$chave.'=\'.$where );
        }

        public function insere'.$dir.'( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function exclui'.$dir.'( $id ){
            return $this->delete( $id );
        }

        public function pesquisa'.$dir.'( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, \''.$chave.' DESC\' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( \''.$dir.'\', $op, $perfil );
        }

    }   ';
     
           $arquivo = "app/models/".$dir."Model.php";

           $ponteiro = fopen($arquivo, 'w+');
           fwrite($ponteiro, $codigo);
           fclose($ponteiro);
        }


       protected function gerarcontroller($dir, $chave, $tabelas, $visual, $filtro, $moduloscampo){

        $fi='$_SESSION[\'acesso\'][\'';
        $ff='\']';
        $filtro=$fi.$filtro.$ff;
           $codigo = '
<?php
session_start();
    class '.$dir.' extends Controller{

        public function Index_action(){
            $'.$dir.' = new '.$dir.'Model();
            $datas[\'vc\'] = $this->modvinculados();
            if (!empty($_SESSION[\'filtro\'][\'chave\'])) {
                $p=$_SESSION[\'filtro\'][\'chave\'];
                $_SESSION[\'filtro\'][\'valor\']=$this->getParam($p);
                if (!empty($_SESSION[\'filtro\'][\'valor\'])) {
                $par=$p.\'=\'.$_SESSION[\'filtro\'][\'valor\']; }
            }
            if (!empty($par)) {
            if ('.$filtro.'!=\'\') { $par.= \' and \'.'.$filtro.'; }
            $'.$dir.'_lista = $'.$dir.'->lista'.$dir.'("{$par}");
            } else {$'.$dir.'_lista = $'.$dir.'->lista'.$dir.'('.$filtro.');}

            $datas[\''.$dir.'\'] = $'.$dir.'_lista;

            if ($'.$dir.'->pacesso(\'visualizar\',$_SESSION[\'acesso\'][\'cdperfil\'])==\'1\') {
                $this->view(\'/'.$dir.'/index\', $datas);
            } else {
                $this->view(\'/erro/index\', $datas);
            }

        }

        public function novo(){
           $'.$dir.' = new '.$dir.'Model();            
           $datas[\'vc\'] = $this->modvinculados();';
        foreach ($tabelas as $mod ) {
        $chaveca = $moduloscampo->pesquisaModuloscampos('cdmodulo='.$mod['cdmodulo'].' and cchave=1');            
$codigo .= '
            $'.$mod['link'].' = new '.$mod['link'].'Model();
            if ( (!empty($_SESSION[\'filtro\'][\'chave\'])) and (!empty($_SESSION[\'filtro\'][\'valor\'])) and ($_SESSION[\'filtro\'][\'chave\']==\''.$chaveca[0]['campo'].'\') ) {
                $par=$_SESSION[\'filtro\'][\'chave\'].\'=\'.$_SESSION[\'filtro\'][\'valor\'];
            }
            if (!empty($par)) {
            if ('.$fi.$mod['filtro_entidade'].$ff.'!=\'\') { $par.= \' and \'.'.$fi.$mod['filtro_entidade'].$ff.'; }
            $detalhes_'.$mod['link'].' = $'.$mod['link'].'->lista'.$mod['link'].'("{$par}");
            } else {$detalhes_'.$mod['link'].' = $'.$mod['link'].'->lista'.$mod['link'].'('.$fi.$mod['filtro_entidade'].$ff.');}
            $datas[\''.$mod['link'].'\'] = $detalhes_'.$mod['link'].';';
        }
$codigo .= '
            if ($'.$dir.'->pacesso(\'inserir\',$_SESSION[\'acesso\'][\'cdperfil\'])==\'1\') {
                $this->view(\'/'.$dir.'/novo\', $datas);
            } else {
                $this->view(\'/erro/index\', $datas);
            }
        }



        public function novom(){
            $'.$dir.' = new '.$dir.'Model();
           $datas[\'vc\'] = $this->modvinculados();';
        foreach ($tabelas as $mod ) {
        $chaveca = $moduloscampo->pesquisaModuloscampos('cdmodulo='.$mod['cdmodulo'].' and cchave=1');            
$codigo .= '
            $'.$mod['link'].' = new '.$mod['link'].'Model();
            if ( (!empty($_SESSION[\'filtro\'][\'chave\'])) and (!empty($_SESSION[\'filtro\'][\'valor\'])) and ($_SESSION[\'filtro\'][\'chave\']==\''.$chaveca[0]['campo'].'\') ) {

                $par=$_SESSION[\'filtro\'][\'chave\'].\'=\'.$_SESSION[\'filtro\'][\'valor\'];
            }
            if (!empty($par)) {
            if ('.$fi.$mod['filtro_entidade'].$ff.'!=\'\') { $par.= \' and \'.'.$fi.$mod['filtro_entidade'].$ff.'; }
            $detalhes_'.$mod['link'].' = $'.$mod['link'].'->lista'.$mod['link'].'("{$par}");
            } else {$detalhes_'.$mod['link'].' = $'.$mod['link'].'->lista'.$mod['link'].'('.$fi.$mod['filtro_entidade'].$ff.');}
            $datas[\''.$mod['link'].'\'] = $detalhes_'.$mod['link'].';';
        }
$codigo .= '
            if ($'.$dir.'->pacesso(\'inserir_mtp\',$_SESSION[\'acesso\'][\'cdperfil\'])==\'1\') {
                $this->view(\'/'.$dir.'/novom\', $datas);
            } else {
                $this->view(\'/erro/index\', $datas);
            }
        }



        public function editar(){

            $'.$dir.' = new '.$dir.'Model();
            $id = $this->getParam(\'id\');
            $detalhes_'.$dir.' = $'.$dir.'->lista'.$dir.'(\''.$chave.'=\'.$id);
            $datas[\''.$dir.'\'] = $detalhes_'.$dir.';
            $datas[\'vc\'] = $this->modvinculados($id);';
        foreach ($tabelas as $mod ) {
        $chaveca = $moduloscampo->pesquisaModuloscampos('cdmodulo='.$mod['cdmodulo'].' and cchave=1');            
$codigo .= '
            $'.$mod['link'].' = new '.$mod['link'].'Model();
            if ( (!empty($_SESSION[\'filtro\'][\'chave\'])) and (!empty($_SESSION[\'filtro\'][\'valor\'])) and ($_SESSION[\'filtro\'][\'chave\']==\''.$chaveca[0]['campo'].'\') ) {

                $par=$_SESSION[\'filtro\'][\'chave\'].\'=\'.$_SESSION[\'filtro\'][\'valor\'];
            }
            if (!empty($par)) {
            if ('.$fi.$mod['filtro_entidade'].$ff.'!=\'\') { $par.= \' and \'.'.$fi.$mod['filtro_entidade'].$ff.'; }
            $detalhes_'.$mod['link'].' = $'.$mod['link'].'->lista'.$mod['link'].'("{$par}");
            } else {$detalhes_'.$mod['link'].' = $'.$mod['link'].'->lista'.$mod['link'].'('.$fi.$mod['filtro_entidade'].$ff.');}
            $datas[\''.$mod['link'].'\'] = $detalhes_'.$mod['link'].';';
        }
$codigo .= '
            if ($'.$dir.'->pacesso(\'editar\',$_SESSION[\'acesso\'][\'cdperfil\'])==\'1\') {
                $this->view(\'/'.$dir.'/editar\', $datas);
            } else {
                $this->view(\'/erro/index\', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam(\'id\');
            $'.$dir.' = new '.$dir.'Model();
            $dados=$_POST;
            $atualiza = $'.$dir.'->atualiza'.$dir.'($dados, $id );

            if ($_POST[\'submit\']==\'Salvar e Continuar\') {

            $_SESSION[\'mensagem\'][\'tipo\'] = \'alert alert-success\';
            $_SESSION[\'mensagem\'][\'texto\'] = \'<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.\';
            header( "Location: /".PROJETO."/'.$dir.'/editar/id/{$id}" );

            } else {

            $_SESSION[\'mensagem\'][\'tipo\'] = \'alert alert-success\';
            $_SESSION[\'mensagem\'][\'texto\'] = \'<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.\';
            header( "Location: /".PROJETO."/'.$dir.'/" );

            }

        }

        public function exclui(){
            $id = $this->getParam(\'id\');
            $'.$dir.' = new '.$dir.'Model();
            $atualiza = $'.$dir.'->exclui'.$dir.'( \''.$chave.'=\'.$id );
            $_SESSION[\'mensagem\'][\'tipo\'] = \'alert alert-success\';
            $_SESSION[\'mensagem\'][\'texto\'] = \'<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.\';

            if ($'.$dir.'->pacesso(\'excluir\',$_SESSION[\'acesso\'][\'cdperfil\'])==\'1\') {
                header( "Location: /".PROJETO."/'.$dir.'/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $'.$dir.' = new '.$dir.'Model();
            $datas[\'vc\'] = $this->modvinculados();';
        foreach ($tabelas as $mod ) {
        $chaveca = $moduloscampo->pesquisaModuloscampos('cdmodulo='.$mod['cdmodulo'].' and cchave=1');            
$codigo .= '
            $'.$mod['link'].' = new '.$mod['link'].'Model();
            if ( (!empty($_SESSION[\'filtro\'][\'chave\'])) and (!empty($_SESSION[\'filtro\'][\'valor\'])) and ($_SESSION[\'filtro\'][\'chave\']==\''.$chaveca[0]['campo'].'\') ) {

                $par=$_SESSION[\'filtro\'][\'chave\'].\'=\'.$_SESSION[\'filtro\'][\'valor\'];
            }
            if (!empty($par)) {
            if ('.$fi.$mod['filtro_entidade'].$ff.'!=\'\') { $par.= \' and \'.'.$fi.$mod['filtro_entidade'].$ff.'; }
            $detalhes_'.$mod['link'].' = $'.$mod['link'].'->lista'.$mod['link'].'("{$par}");
            } else {$detalhes_'.$mod['link'].' = $'.$mod['link'].'->lista'.$mod['link'].'('.$fi.$mod['filtro_entidade'].$ff.');}
            $datas[\''.$mod['link'].'\'] = $detalhes_'.$mod['link'].';';
        }
$codigo .= '
            if ($'.$dir.'->pacesso(\'pesquisar\',$_SESSION[\'acesso\'][\'cdperfil\'])==\'1\') {
                $this->view(\'/'.$dir.'/pesquisar\', $datas);
            } else {
                $this->view(\'/erro/index\', $datas);
            }
        }

        public function insere(){
            $'.$dir.' = new '.$dir.'Model();
            $insere = $'.$dir.'->insere'.$dir.'($_POST, \''.$chave.'\');

            if ($insere==0) {
              $_SESSION[\'mensagem\'][\'tipo\'] = \'alert alert-danger\';
              $_SESSION[\'mensagem\'][\'texto\'] = \'<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.\';
            } else {
              $_SESSION[\'mensagem\'][\'tipo\'] = \'alert alert-success\';
              $_SESSION[\'mensagem\'][\'texto\'] = \'<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.\';
            }

            if ($_POST[\'submit\']==\'Salvar e Continuar\') {
            header( "Location: /".PROJETO."/'.$dir.'/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/'.$dir.'/" );
            }

        }


        public function inserem( Array $dados = null ){
            $'.$dir.' = new '.$dir.'Model();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados[\''.$visual.'\'][0])) {
                $i=0;
                foreach ($dados[\''.$visual.'\'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_'.$dir.'[$key]=$dados[$key][$i];
                    }
                    $insere = $'.$dir.'->insere'.$dir.'($dados_'.$dir.',\''.$chave.'\');
                    $i++;
                }

            }

           if ($insere==0) {
              $_SESSION[\'mensagem\'][\'tipo\'] = \'alert alert-danger\';
              $_SESSION[\'mensagem\'][\'texto\'] = \'<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.\';
            } else {
              $_SESSION[\'mensagem\'][\'tipo\'] = \'alert alert-success\';
              $_SESSION[\'mensagem\'][\'texto\'] = \'<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso. '.$i.'Registros inseridos.\';
            }

            header( "Location: /".PROJETO."/'.$dir.'/" );


        }

        public function pesquisa(){
            $'.$dir.' = new '.$dir.'Model();
            $datas[\'vc\'] = $this->modvinculados();';
        foreach ($tabelas as $mod ) {
        $chaveca = $moduloscampo->pesquisaModuloscampos('cdmodulo='.$mod['cdmodulo'].' and cchave=1');            
$codigo .= '
            $'.$mod['link'].' = new '.$mod['link'].'Model();
            if ( (!empty($_SESSION[\'filtro\'][\'chave\'])) and (!empty($_SESSION[\'filtro\'][\'valor\'])) and ($_SESSION[\'filtro\'][\'chave\']==\''.$chaveca[0]['campo'].'\') ) {

                $par=$_SESSION[\'filtro\'][\'chave\'].\'=\'.$_SESSION[\'filtro\'][\'valor\'];
            }';
        }
$codigo .= '$filtro=\'\';
            foreach ($_POST as $key => $value) {
                    if ( ($key!="submit") and ($value!="")) {
                              $vop=\'\';
                              if (is_array($value)) { $value=implode( \',\' , $value); }
                         if (substr($key, 1, 1)=="1") { $op=" >= "; } elseif (substr($key, 1, 1)=="2") { $op=" <= "; } elseif (substr($key, 1, 1)=="3") { $op=" in "; $vop=" Esteja em "; } else { $op=" = "; }
                        if (substr($key, 0, 1)=="s"){
                            $vop=\' Contenha \';
                            $w .= ($w=="") ? "upper(".substr($key, 2).") like upper("."\'%".$value."%\')" : " and upper(".substr($key, 2).") like upper("."\'%".$value."%\')" ;
                        } else if (substr($key, 0, 1)=="d") {
                            $w .= ($w=="") ? substr($key, 2).$op."\'".$value."\'" : " and ".substr($key, 2).$op."\'".$value."\'" ;
                        } else if (substr($key, 0, 1)=="i") {
                            $w .= ($w=="") ? substr($key, 2).$op.$value : " and ".substr($key, 2).$op.$value ;
                        } else if (substr($key, 0, 1)=="m") {
                            $val = str_replace(",", "\',\'", $value);
                            $w .= ($w=="") ? substr($key, 2).$op."(\'".$val."\')" : " and ".substr($key, 2).$op."(\'".$val."\')" ;
                        }
                          if ($vop!=\'\') {$op=$vop;}
                          $filtro .= \'<br>\'.substr($key, 2).$op.$value;
 
                    }
                }
            if ($w!=\'\') { if ($par!=\'\') { $w.=\' and \'.$par; } }
            else { if ($par!=\'\') {$w=$par;} }
            if ('.$filtro.'!=\'\') { if (empty($w)) { $w.= '.$filtro.'; } else { $w.= \' and \'.'.$filtro.';} }


            $pesquisa = $'.$dir.'->pesquisa'.$dir.'($w);
            $datas[\''.$dir.'\'] = $pesquisa;
            if ($filtro!=\'\') {
            $_SESSION[\'mensagem\'][\'tipo\'] = \'alert alert-warning alert-dismissable\';
            $_SESSION[\'mensagem\'][\'texto\'] = \'<strong>Parâmetros:</strong>\'.$filtro;
            }
            $this->view(\'/'.$dir.'/index\', $datas);

    }


       private function modvinculados($id = \'\'){

            $modulos = new modulosModel();
            $mod = $modulos->listaModulos("link=\''.$dir.'\'");
            $moduloscampo = new moduloscamposModel();
            $chave = $moduloscampo->pesquisaModuloscampos(\'cdmodulo=\'.$mod[0][\'cdmodulo\'].\' and cchave=1\');

            $modulosvinculados = new modulosvinculadosModel();
            $amvc = $modulosvinculados->listaModulosvinculados(\'cdvinculado=\'.$mod[0][\'cdmodulo\']);
            $pmvc = $modulosvinculados->listaModulosvinculados(\'cdmodulo=\'.$mod[0][\'cdmodulo\']);
            $i=0;
            if (!empty($amvc[0][\'cdmodulo\'])) {
            foreach ($amvc as $famvc ) {
                $amod = $modulos->listaModulos(\'cdmodulo=\'.$famvc[\'cdmodulo\']);
                $chavea = $moduloscampo->pesquisaModuloscampos(\'cdmodulo=\'.$amvc[0][\'cdmodulo\'].\' and cchave=1\');
                $dmvc[$i][\'link\']=\'/\'.PROJETO.\'/\'.$amod[0][\'link\'].\'/index\';
                $dmvc[$i][\'atalho\']=$amod[0][\'atalho\'];
                $dmvc[$i][\'nome\']=$amod[0][\'nome\'];
                $dmvc[$i][\'tipo\']=\'\';
                $dmvc[$i][\'tp\']=0;
                $_SESSION[\'filtro\'][\'chave\']=$chavea[0][\'campo\'];
                $i++;
            }
        } else {unset($_SESSION[\'filtro\']);}
                $dmvc[$i][\'link\']=\'#\';
                $dmvc[$i][\'atalho\']=\'<b>\'.$mod[0][\'atalho\'].\'</b>\';
                $dmvc[$i][\'nome\']=$mod[0][\'nome\'];
                $dmvc[$i][\'tipo\']=\' class="active"\';
                $dmvc[$i][\'tp\']=1;
                $i++;
            if ($id!=\'\') {
            foreach ($pmvc as $fpmvc ) {
                $dmod = $modulos->listaModulos(\'cdmodulo=\'.$fpmvc[\'cdvinculado\']);
                $dmvc[$i][\'link\']=\'/\'.PROJETO.\'/\'.$dmod[0][\'link\'].\'/index/\'.$chave[0][\'campo\'].\'/\'.$id;
                $dmvc[$i][\'atalho\']=$dmod[0][\'atalho\'];
                $dmvc[$i][\'nome\']=$dmod[0][\'nome\'];
                $dmvc[$i][\'tipo\']=\'\';
                $dmvc[$i][\'tp\']=2;
                $i++;
            }
            }

            return $dmvc;

        }
}';
           $arquivo = "app/controllers/".$dir."Controller.php";

           $ponteiro = fopen($arquivo, 'w+');
           fwrite($ponteiro, $codigo);
           fclose($ponteiro);
        }


       protected function gerarview($dir, $atalho, $chave, $visual, $campo, $gchave, $modulos, $moduloscampo){

           $codigoindex = '
<?php
include(\'app/views/topo.php\');
?>
<div class="<?php echo $_SESSION[\'mensagem\'][\'tipo\'];?>">
                                <?php
                                echo $_SESSION[\'mensagem\'][\'texto\'];
                                unset( $_SESSION[\'mensagem\'] );?>
                            </div>
<?php if (!empty($view_vc[1])) { ?> 
<div class="col-lg-12">
<div class="box-tab">
<ul class="nav nav-tabs">
<?php foreach ($view_vc as $vc) { ?>
<li<?php echo $vc['tipo']?>><a href="<?php echo $vc['link']?>" data-original-title="<?php echo $vc['nome']?>"><?php echo $vc['atalho']?></a></li>
<?php } ?>
</ul>

<div class="tab-content">
<div class="tab-pane fade active in">

<?php } else { echo '<div class="col-lg-12">';}?>


<section class="panel panel-default">

   <header class="panel-heading">
      Lista de '.$atalho.'
   </header>
        <div class="panel-body">
        <div class="table-responsive no-border">
        <table id="example1" class="table table-bordered table-striped mg-t datatable">
            <thead>
            <tr>';
        foreach ($visual as $campos ) {
$codigoindex .= '
            <th>'.$campos['legenda'].'</th>';
        }
$codigoindex .= '
            </tr>
            </thead>
            <tbody>
             <?php if (!empty($view_'.$dir.')) { foreach ($view_'.$dir.' as $'.$dir.') {?>
            <tr class="gradeA" onclick="location.href = \'/<?php echo PROJETO;?>/'.$dir.'/editar/id/<?php echo $'.$dir.'[\''.$chave.'\'] ?>\';" style="cursor: pointer; cursor: hand">
            ';
        foreach ($visual as $campos ) {
$codigoindex .= '<td><?php echo $'.$dir.'[\''.$campos['campo'].'\']; ?></td>
';
        }
$codigoindex .= '
            </tr>
            <?php } } ?>
        </table>
    </div>
 </div>
 </section>
 </div>
 <?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }  ?> 

<?php include(\'app/views/rodape.php\'); ?>';




           $codigonovo = '
<?php
include(\'app/views/topo.php\');
?>
<div class="<?php echo $_SESSION[\'mensagem\'][\'tipo\'];?>">
                                <?php
                                echo $_SESSION[\'mensagem\'][\'texto\'];
                                unset( $_SESSION[\'mensagem\'] );?>
                            </div>
<div class="col-lg-12">

<?php if (!empty($view_vc[1])) { foreach ($view_vc as $vc) { ?>
<a href="<?php echo $vc[\'link\']?>" class="btn btn-primary <?php echo $vc[\'tipo\']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $vc[\'nome\']?>"><?php echo $vc[\'atalho\']?></a>
<?php } ?>
<br>
<br>
<?php } ?>

<section class="panel">
<header class="panel-heading">Cadastrar Novo '.$atalho.'</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/'.$dir.'/insere/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>';
foreach ($campo as $campos ) {
if ($campos['obrigatorio']=='1') {
    $ob= ' data-parsley-required="true" ';
} else {
    $ob= '';
}
 

if ( ($campos['campo']==$chave) and ($gchave!='1')){
} else {

if ($campos['tipo']=='data'){
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="date" name="'.$campos['campo'].'" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control" placeholder="99/99/9999"'.$ob.' data-parsley-trigger="change"/></div></div>
</div></div>
';
} elseif ( ($campos['tipo']=='inteiro') or (($campos['tipo']=='numero'))){
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="'.$campos['campo'].'" name="'.$campos['campo'].'" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'" data-parsley-type="digits"/></div></div>
</div></div>
';
} elseif ( $campos['tipo']=='email'){
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="'.$campos['campo'].'" name="'.$campos['campo'].'" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'" data-parsley-type="email"/></div></div>
</div></div>
';
} elseif ( $campos['tipo']=='url'){
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="'.$campos['campo'].'" name="'.$campos['campo'].'" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'" data-parsley-type="url"/></div></div>
</div></div>
';
} elseif ( $campos['tipo']=='texto longo'){
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="'.$campos['campo'].'" rows="4"><?php echo $_POST[\''.$campos['campo'].'\']; ?></textarea>
</div></div>
</div></div>
';
} elseif (( $campos['tipo']=='lista') and ($campos['cdmodulo_referencia']!='')) {

   $dmodulos = $modulos->pesquisaModulos('cdmodulo='.$campos['cdmodulo_referencia']);
   $dcampos = $moduloscampo->pesquisaModuloscampos("cdmodulo=".$campos['cdmodulo_referencia']." and cdescritivo=1",'2');
   $cr='\'.$'.$dmodulos[0]['link'].'[\''.$dcampos[0]['campo'].'\'].\'';
   if (!empty($dcampos[1]['campo'])) {
   $cr.='\'.\' - \'.$'.$dmodulos[0]['link'].'[\''.$dcampos[1]['campo'].'\'].\''; }

$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$campos['campo'].'" name="'.$campos['campo'].'"'.$ob.' data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_'.$dmodulos[0]['link'].'[1])) { $ch=\' selected="selected" \'; }
 foreach ($view_'.$dmodulos[0]['link'].' as $'.$dmodulos[0]['link'].') {
  echo \'<option value="\'.$'.$dmodulos[0]['link'].'[\''.$campos['campo'].'\'].\'"\'.$ch.\'>'.$cr.'</option>\';
  } ?>
 </select></div></div>
</div></div>
';
} elseif (( $campos['tipo']=='lista multipla') and ($campos['cdmodulo_referencia']!='')) {

   $dmodulos = $modulos->pesquisaModulos('cdmodulo='.$campos['cdmodulo_referencia']);
      $dcampos = $moduloscampo->pesquisaModuloscampos("cdmodulo=".$campos['cdmodulo_referencia']." and cdescritivo=1",'2');
   $cr='\'.$'.$dmodulos[0]['link'].'[\''.$dcampos[0]['campo'].'\'].\'';
   if (!empty($dcampos[1]['campo'])) {
   $cr.='\'.\' - \'.$'.$dmodulos[0]['link'].'[\''.$dcampos[1]['campo'].'\'].\''; }


$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$campos['campo'].'" name="'.$campos['campo'].'[]"'.$ob.' data-parsley-trigger="change"  multiple>
  <option value=""></option>
 <?php
 $vmarcado = $_POST[\''.$campos['campo'].'\']; 

 foreach ($view_'.$dmodulos[0]['link'].' as $'.$dmodulos[0]['link'].') {
   $ch=""; 
  if ($vmarcado==$'.$dmodulos[0]['link'].'[\''.$campos['campo'].'\']) { $ch=\' selected="selected" \'; } 
  echo \'<option value="\'.$'.$dmodulos[0]['link'].'[\''.$campos['campo'].'\'].\'"\'.$ch.\'>.'.$cr.'</option>\';
  } ?>
 </select></div></div>
</div></div>
';
} elseif (( $campos['tipo']=='lista') and ($campos['expressao']!='')) {

   $expressao = $campos['expressao'];
   $texto = split("\n",$expressao);
   //print_r($texto);die();

$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$campos['campo'].'" name="'.$campos['campo'].'"'.$ob.' data-parsley-trigger="change">
  <option value=""></option>';
   foreach ($texto as $te) {
      $menu = explode('=', $te);
      if (empty($menu[1])) {$menu[1]=$menu[0];}
         $codigonovo .= '<option value="'.$menu[0].'" <?php if ($_POST[\''.$campos['campo'].'\']==\''.$menu[0].'\') { echo \'selected\';}?>>'.$menu[1].'</option>';
      }
$codigonovo .= '
 </select></div></div>
</div></div>
';
} elseif (( $campos['tipo']=='lista multipla') and ($campos['expressao']!='')) {

   $expressao = $campos['expressao'];
   $texto = split("\n",$expressao);

$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$campos['campo'].'" name="'.$campos['campo'].'"[]'.$ob.' data-parsley-trigger="change"  multiple>
  <option value=""></option>';
   foreach ($texto as $te) {
      $menu = explode('=', $te);
      if (empty($menu[1])) {$menu[1]=$menu[0];}
         echo '<option value="'.$menu[0].'" <?php if ($_POST[\''.$campos['campo'].'\']==\''.$menu[0].'\') ()?>>'.$menu[1].'</option>';
      }
$codigonovo .= ' 
  echo \'<option value="\'.$'.$dmodulos[0]['link'].'[\''.$campos['campo'].'\'].\'"\'.$ch.\'>\'.$'.$dmodulos[0]['link'].'[\''.$dcampos[0]['campo'].'\'].\'</option>\';
  } ?>
 </select></div></div>
</div></div>
';
} elseif ( $campos['tipo']=='texto curto'){
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="'.$campos['campo'].'" name="'.$campos['campo'].'" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'"/></div></div>
</div></div>
';
} else {
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="'.$campos['campo'].'" name="'.$campos['campo'].'" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'"/></div></div>
</div></div>
';
}
} }

$codigonovo .= '
<br>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/'.$dir.'/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>

 </form>
  </div>
 </section>
 </div>
<?php
include(\'app/views/rodape.php\');
?>
';








           $codigonovom = '
<?php
include(\'app/views/topo.php\');
?>
<div class="<?php echo $_SESSION[\'mensagem\'][\'tipo\'];?>">
                                <?php
                                echo $_SESSION[\'mensagem\'][\'texto\'];
                                unset( $_SESSION[\'mensagem\'] );?>
                            </div>
<div class="col-lg-12">

<?php if (!empty($view_vc[1])) { foreach ($view_vc as $vc) { ?>
<a href="<?php echo $vc[\'link\']?>" class="btn btn-primary <?php echo $vc[\'tipo\']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $vc[\'nome\']?>"><?php echo $vc[\'atalho\']?></a>
<?php } ?>
<br>
<br>
<?php } ?>

<section class="panel">
<header class="panel-heading">Cadastrar Novos '.$atalho.'</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/'.$dir.'/inserem/" role="form" method="post" name="formnovo" class="parsley-form" data-parsley-validate>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Incluir linha" onClick="addRow(\'dataTable1\')"> 
<i class="fa fa-plus-circle"></i></a>
<a class="btn btn-default tip-bottom" href="#" data-original-title="Remover linhas marcadas" onClick="deleteRow(\'dataTable1\')">
        <i class="fa fa-reply"></i></a>
 <div id="tabela1" class="form-group"> <br>
<table id="dataTable1" class="table table-bordered table-striped"> 
  <thead>
  <tr>
  <th></th>';
foreach ($campo as $campos ) {
if ( ($campos['campo']==$chave) and ($gchave!='1')){
} else{
$codigonovom .= '<th>'.$campos['legenda'].'</th>';
}
}
$codigonovom .= '
  </tr>
  </thead>
   <tbody>
   <tr>
   <td><input type="checkbox" checked="checked" /></td>
    ';
foreach ($campo as $campos ) {
if ($campos['obrigatorio']=='1') {
    $ob= ' data-parsley-required="true" ';
} else {
    $ob= '';
}
 

if ( ($campos['campo']==$chave) and ($gchave!='1')){
} else {
$codigonovom .= '<td>';

if ($campos['tipo']=='data'){
$codigonovom .= '
<input id="date" name="'.$campos['campo'].'[]" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control" placeholder="99/99/9999"'.$ob.' data-parsley-trigger="change"/>
';
} elseif ( ($campos['tipo']=='inteiro') or (($campos['tipo']=='numero'))){
$codigonovom .= '
<input id="'.$campos['campo'].'" name="'.$campos['campo'].'[]" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'" data-parsley-type="digits"/>
';
} elseif ( $campos['tipo']=='email'){
$codigonovom .= '
<input id="'.$campos['campo'].'" name="'.$campos['campo'].'[]" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'" data-parsley-type="email"/>
';
} elseif ( $campos['tipo']=='url'){
$codigonovom .= '
<input id="'.$campos['campo'].'" name="'.$campos['campo'].'[]" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'" data-parsley-type="url"/>
';
} elseif ( $campos['tipo']=='texto longo'){
$codigonovom .= '
<textarea class="form-control" name="'.$campos['campo'].'[]" rows="1"><?php echo $_POST[\''.$campos['campo'].'\']; ?></textarea>
';
} elseif (( $campos['tipo']=='lista') and ($campos['cdmodulo_referencia']!='')) {

   $dmodulos = $modulos->pesquisaModulos('cdmodulo='.$campos['cdmodulo_referencia']);
   $dcampos = $moduloscampo->pesquisaModuloscampos("cdmodulo=".$campos['cdmodulo_referencia']." and cdescritivo=1",'2');
   $cr='\'.$'.$dmodulos[0]['link'].'[\''.$dcampos[0]['campo'].'\'].\'';
   if (!empty($dcampos[1]['campo'])) {
   $cr.='\'.\' - \'.$'.$dmodulos[0]['link'].'[\''.$dcampos[1]['campo'].'\'].\''; }


$codigonovom .= '
<select id="'.$campos['campo'].'" name="'.$campos['campo'].'[]"'.$ob.' data-parsley-trigger="change">
  <option value=""></option>
 <?php
 if (empty($view_'.$dmodulos[0]['link'].'[1])) { $ch=\' selected="selected" \'; }

 foreach ($view_'.$dmodulos[0]['link'].' as $'.$dmodulos[0]['link'].') {
  echo \'<option value="\'.$'.$dmodulos[0]['link'].'[\''.$campos['campo'].'\'].\'"\'.$ch.\'>'.$cr.'</option>\';
  } ?>
 </select>
';
} elseif (( $campos['tipo']=='lista multipla') and ($campos['cdmodulo_referencia']!='')) {

   $dmodulos = $modulos->pesquisaModulos('cdmodulo='.$campos['cdmodulo_referencia']);
   $dcampos = $moduloscampo->pesquisaModuloscampos("cdmodulo=".$campos['cdmodulo_referencia']." and cdescritivo=1",'2');
   $cr='\'.$'.$dmodulos[0]['link'].'[\''.$dcampos[0]['campo'].'\'].\'';
   if (!empty($dcampos[1]['campo'])) {
   $cr.='\'.\' - \'.$'.$dmodulos[0]['link'].'[\''.$dcampos[1]['campo'].'\'].\''; }


$codigonovom .= '
<select id="'.$campos['campo'].'" name="'.$campos['campo'].'[]"'.$ob.' data-parsley-trigger="change"  multiple>
  <option value=""></option>
 <?php
 $vmarcado = $_POST[\''.$campos['campo'].'\']; 

 foreach ($view_'.$dmodulos[0]['link'].' as $'.$dmodulos[0]['link'].') {
   $ch=""; 
  if ($vmarcado==$'.$dmodulos[0]['link'].'[\''.$campos['campo'].'\']) { $ch=\' selected="selected" \'; } 
  echo \'<option value="\'.$'.$dmodulos[0]['link'].'[\''.$campos['campo'].'\'].\'"\'.$ch.\'>'.$cr.'</option>\';
  } ?>
 </select>
';
} elseif (( $campos['tipo']=='lista') and ($campos['expressao']!='')) {

   $expressao = $campos['expressao'];
   $texto = split("\n",$expressao);
   //print_r($texto);die();

$codigonovom .= '
<select id="'.$campos['campo'].'" name="'.$campos['campo'].'[]"'.$ob.' data-parsley-trigger="change">
  <option value=""></option>';
   foreach ($texto as $te) {
      $menu = explode('=', $te);
      if (empty($menu[1])) {$menu[1]=$menu[0];}
         $codigonovom .= '<option value="'.$menu[0].'" <?php if ($_POST[\''.$campos['campo'].'\']==\''.$menu[0].'\') { echo \'selected\';}?>>'.$menu[1].'</option>';
      }
$codigonovom .= '
 </select>
';
} elseif (( $campos['tipo']=='lista multipla') and ($campos['expressao']!='')) {

   $expressao = $campos['expressao'];
   $texto = split("\n",$expressao);

$codigonovom .= '
<select id="'.$campos['campo'].'" name="'.$campos['campo'].'"[]'.$ob.' data-parsley-trigger="change"  multiple>
  <option value=""></option>';
   foreach ($texto as $te) {
      $menu = explode('=', $te);
      if (empty($menu[1])) {$menu[1]=$menu[0];}
         echo '<option value="'.$menu[0].'" <?php if ($_POST[\''.$campos['campo'].'\']==\''.$menu[0].'\') ()?>>'.$menu[1].'</option>';
      }
$codigonovom .= ' 
  echo \'<option value="\'.$'.$dmodulos[0]['link'].'[\''.$campos['campo'].'\'].\'"\'.$ch.\'>\'.$'.$dmodulos[0]['link'].'[\''.$dcampos[0]['campo'].'\'].\'</option>\';
  } ?>
 </select>
';
} else {
$codigonovom .= '
<input id="'.$campos['campo'].'" name="'.$campos['campo'].'[]" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'"/>

';
}
$codigonovom .= '</td>';
}

 }
$codigonovom .= '</tr>';
$codigonovom .= '
</tbody></table> 
</div>
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/'.$dir.'/" class="btn btn-default">Cancelar</a>


 </form>
  </div>
 </section>
 </div>
<?php
include(\'app/views/rodape.php\');
?>
';




           $codigoeditar = '
<?php
include(\'app/views/topo.php\');
?>
<div class="<?php echo $_SESSION[\'mensagem\'][\'tipo\'];?>">
                                <?php
                                echo $_SESSION[\'mensagem\'][\'texto\'];
                                unset( $_SESSION[\'mensagem\'] );?>
                            </div>
<div class="col-lg-12">

<?php if (!empty($view_vc[1])) { foreach ($view_vc as $vc) { ?>
<a href="<?php echo $vc[\'link\']?>" class="btn btn-primary <?php echo $vc[\'tipo\']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $vc[\'nome\']?>"><?php echo $vc[\'atalho\']?></a>
<?php } ?>
<br>
<br>
<?php } ?>

<section class="panel">
<header class="panel-heading">Editar '.$atalho.'</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/'.$dir.'/atualiza/id/<?php echo $view_'.$dir.'[0][\''.$chave.'\'];?>" role="form" method="post" name="formeditar" class="parsley-form" data-parsley-validate>';
foreach ($campo as $campos ) {
if ($campos['obrigatorio']=='1') {
    $ob= ' data-parsley-required="true" ';
} else {
    $ob= '';
}
 

if ( ($campos['campo']==$chave) and ($gchave!='1')){
} else {

if ($campos['tipo']=='data'){
$codigoeditar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="date" name="'.$campos['campo'].'" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_'.$dir.'[0][\''.$campos['campo'].'\'] ) : ( $_POST[\''.$campos['campo'].'\'] ) ?>" class="form-control" placeholder="99/99/9999"'.$ob.' data-parsley-trigger="change"/></div></div>
</div></div>
';
} elseif ( ($campos['tipo']=='inteiro') or (($campos['tipo']=='numero'))){
$codigoeditar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="'.$campos['campo'].'" name="'.$campos['campo'].'" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_'.$dir.'[0][\''.$campos['campo'].'\'] ) : ( $_POST[\''.$campos['campo'].'\'] ) ?>" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'" data-parsley-type="digits"/></div></div>
</div></div>
';
} elseif ( $campos['tipo']=='email'){
$codigoeditar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="'.$campos['campo'].'" name="'.$campos['campo'].'" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_'.$dir.'[0][\''.$campos['campo'].'\'] ) : ( $_POST[\''.$campos['campo'].'\'] ) ?>" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'" data-parsley-type="email"/></div></div>
</div></div>
';
} elseif ( $campos['tipo']=='url'){
$codigoeditar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="'.$campos['campo'].'" name="'.$campos['campo'].'" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_'.$dir.'[0][\''.$campos['campo'].'\'] ) : ( $_POST[\''.$campos['campo'].'\'] ) ?>" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'" data-parsley-type="url"/></div></div>
</div></div>
';
} elseif ( $campos['tipo']=='texto longo'){
$codigoeditar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="'.$campos['campo'].'" rows="4"><?php echo ( empty( $_POST ) ) ? ( $view_'.$dir.'[0][\''.$campos['campo'].'\'] ) : ( $_POST[\''.$campos['campo'].'\'] ) ?></textarea>
</div></div>
</div></div>
';
} elseif (( $campos['tipo']=='lista') and ($campos['cdmodulo_referencia']!='')) {

   $dmodulos = $modulos->pesquisaModulos('cdmodulo='.$campos['cdmodulo_referencia']);
   $dcampos = $moduloscampo->pesquisaModuloscampos("cdmodulo=".$campos['cdmodulo_referencia']." and cdescritivo=1",'2');
   $cr='\'.$'.$dmodulos[0]['link'].'[\''.$dcampos[0]['campo'].'\'].\'';
   if (!empty($dcampos[1]['campo'])) {
   $cr.='\'.\' - \'.$'.$dmodulos[0]['link'].'[\''.$dcampos[1]['campo'].'\'].\''; }

$codigoeditar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$campos['campo'].'" name="'.$campos['campo'].'"'.$ob.' data-parsley-trigger="change">
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_'.$dir.'[0][\''.$campos['campo'].'\'] ) : ( $_POST[\''.$campos['campo'].'\'] ); 

 foreach ($view_'.$dmodulos[0]['link'].' as $'.$dmodulos[0]['link'].') {
   $ch=""; 
  if ($vmarcado==$'.$dmodulos[0]['link'].'[\''.$campos['campo'].'\']) { $ch=\' selected="selected" \'; } 
  echo \'<option value="\'.$'.$dmodulos[0]['link'].'[\''.$campos['campo'].'\'].\'"\'.$ch.\'>'.$cr.'</option>\';
  } ?>
 </select></div></div>
</div></div>
';
} elseif (( $campos['tipo']=='lista multipla') and ($campos['cdmodulo_referencia']!='')) {

   $dmodulos = $modulos->pesquisaModulos('cdmodulo='.$campos['cdmodulo_referencia']);
   $dcampos = $moduloscampo->pesquisaModuloscampos("cdmodulo=".$campos['cdmodulo_referencia']." and cdescritivo=1",'2');
   $cr='\'.$'.$dmodulos[0]['link'].'[\''.$dcampos[0]['campo'].'\'].\'';
   if (!empty($dcampos[1]['campo'])) {
   $cr.='\'.\' - \'.$'.$dmodulos[0]['link'].'[\''.$dcampos[1]['campo'].'\'].\''; }


$codigoeditar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$campos['campo'].'" name="'.$campos['campo'].'[]"'.$ob.' data-parsley-trigger="change"  multiple>
  <option value=""></option>
 <?php
 $vmarcado = ( empty( $_POST ) ) ? ( $view_'.$dir.'[0][\''.$campos['campo'].'\'] ) : ( $_POST[\''.$campos['campo'].'\'] ); 

 foreach ($view_'.$dmodulos[0]['link'].' as $'.$dmodulos[0]['link'].') {
   $ch=""; 
  if ($vmarcado==$'.$dmodulos[0]['link'].'[\''.$campos['campo'].'\']) { $ch=\' selected="selected" \'; } 
  echo \'<option value="\'.$'.$dmodulos[0]['link'].'[\''.$campos['campo'].'\'].\'"\'.$ch.\'>'.$cr.'</option>\';
  } ?>
 </select></div></div>
</div></div>
';
} elseif (( $campos['tipo']=='lista') and ($campos['expressao']!='')) {

   $expressao = $campos['expressao'];
   $texto = split("\n",$expressao);
   //print_r($texto);die();

$codigoeditar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$campos['campo'].'" name="'.$campos['campo'].'"'.$ob.' data-parsley-trigger="change">
  <option value=""></option>';
   foreach ($texto as $te) {
      $menu = explode('=', $te);
      if (empty($menu[1])) {$menu[1]=$menu[0];}
$codigoeditar .= '<?php $vmarcado = ( empty( $_POST ) ) ? ( $view_'.$dir.'[0][\''.$campos['campo'].'\'] ) : ( $_POST[\''.$campos['campo'].'\'] ); ?> 
         <option value="'.$menu[0].'" <?php if ($vmarcado==\''.$menu[0].'\') { echo \'selected\';}?>>'.$menu[1].'</option>';
      }
$codigoeditar .= '
 </select></div></div>
</div></div>
';
} elseif (( $campos['tipo']=='lista multipla') and ($campos['expressao']!='')) {

   $expressao = $campos['expressao'];
   $texto = split("\n",$expressao);

$codigoeditar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$campos['campo'].'" name="'.$campos['campo'].'"[]'.$ob.' data-parsley-trigger="change"  multiple>
  <option value=""></option>';
   foreach ($texto as $te) {
      $menu = explode('=', $te);
      if (empty($menu[1])) {$menu[1]=$menu[0];}
$codigoeditar .= '<?php $vmarcado = ( empty( $_POST ) ) ? ( $view_'.$dir.'[0][\''.$campos['campo'].'\'] ) : ( $_POST[\''.$campos['campo'].'\'] ); ?> 
         <option value="'.$menu[0].'" <?php if ($vmarcado==\''.$menu[0].'\') ()?>>'.$menu[1].'</option>';
      }
$codigoeditar .= ' 
  echo \'<option value="\'.$'.$dmodulos[0]['link'].'[\''.$campos['campo'].'\'].\'"\'.$ch.\'>\'.$'.$dmodulos[0]['link'].'[\''.$dcampos[0]['campo'].'\'].\'</option>\';
  } ?>
 </select></div></div>
</div></div>
';
} elseif ( $campos['tipo']=='texto curto'){
$codigoeditar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="'.$campos['campo'].'" name="'.$campos['campo'].'" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_'.$dir.'[0][\''.$campos['campo'].'\'] ) : ( $_POST[\''.$campos['campo'].'\'] ) ?>" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'"/></div></div>
</div></div>
';
} else {
$codigoeditar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="'.$campos['campo'].'" name="'.$campos['campo'].'" type="text" value="<?php echo ( empty( $_POST ) ) ? ( $view_'.$dir.'[0][\''.$campos['campo'].'\'] ) : ( $_POST[\''.$campos['campo'].'\'] ) ?>" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'"/></div></div>
</div></div>
';
}
} }

$codigoeditar .= '
<br>

<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
<a href="/<?php echo PROJETO;?>/'.$dir.'/" class="btn btn-default">Cancelar</a>
<button type="submit" name="submit" value="Salvar e Continuar" class="btn btn-primary  btn-sig"><i class=" fa fa-sign-in" ></i>
Salvar e Continuar</button>
<a href="/<?php echo PROJETO;?>/'.$dir.'/exclui/id/<?php echo $view_'.$dir.'[0][\''.$chave.'\'];?>"  class="btn btn-danger btn-sig"><i class=" fa fa-fw fa-times-circle"></i>
                    Excluir</a>
 </form>
  </div>
 </section>
 </div>
<?php
include(\'app/views/rodape.php\');
?>
';




           $codigopesquisar = '
<?php
include(\'app/views/topo.php\');
?>
<div class="col-lg-12">

<?php if (!empty($view_vc[1])) { foreach ($view_vc as $vc) { ?>
<a href="<?php echo $vc[\'link\']?>" class="btn btn-primary <?php echo $vc[\'tipo\']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $vc[\'nome\']?>"><?php echo $vc[\'atalho\']?></a>
<?php } ?>
<br>
<br>
<?php } ?>

<section class="panel">
<header class="panel-heading">Pesquisar '.$atalho.'</header>
<div class="panel-body">

<form action="/<?php echo PROJETO;?>/'.$dir.'/pesquisa/" role="form" method="post" name="formpesquisa" class="parsley-form" data-parsley-validate>';
        foreach ($campo as $campos ) {

if ($campos['tipo']=='data'){
$codigopesquisar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="date" name="d1'.$campos['campo'].'" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control " placeholder="99/99/9999"/></div>
<div class="col-xs-3"><input id="date" name="d2'.$campos['campo'].'" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control " placeholder="99/99/9999"/></div></div>
</div></div>
';
} elseif ( ($campos['tipo']=='inteiro') or (($campos['tipo']=='numero'))){
$codigopesquisar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-3"><input id="'.$campos['campo'].'" name="i1'.$campos['campo'].'" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control number" /></div>
<div class="col-xs-3"><input id="'.$campos['campo'].'" name="i2'.$campos['campo'].'" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control number" /></div><div>
</div></div>
';
} elseif ( $campos['tipo']=='email'){
$codigopesquisar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="'.$campos['campo'].'" name="s0'.$campos['campo'].'" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control" /></div></div>
</div></div>
';
} elseif ( $campos['tipo']=='url'){
$codigopesquisar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="'.$campos['campo'].'" name="s0'.$campos['campo'].'" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control" /></div></div>
</div></div>
';
} elseif ( $campos['tipo']=='texto longo'){
$codigopesquisar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<div class="row"><div class="col-xs-12"><input id="'.$campos['campo'].'" name="s0'.$campos['campo'].'" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control" /></div></div>
</div></div>
</div></div>
';
} elseif (( $campos['tipo']=='lista') and ($campos['cdmodulo_referencia']!='')) {

   $dmodulos = $modulos->pesquisaModulos('cdmodulo='.$campos['cdmodulo_referencia']);
   $dcampos = $moduloscampo->pesquisaModuloscampos("cdmodulo=".$campos['cdmodulo_referencia']." and cdescritivo=1",'2');
   $cr='\'.$'.$dmodulos[0]['link'].'[\''.$dcampos[0]['campo'].'\'].\'';
   if (!empty($dcampos[1]['campo'])) {
   $cr.='\'.\' - \'.$'.$dmodulos[0]['link'].'[\''.$dcampos[1]['campo'].'\'].\''; }


$codigopesquisar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$campos['campo'].'" name="m3'.$campos['campo'].'[]" multiple>
  <option value=""></option>
 <?php
 if (empty($view_'.$dmodulos[0]['link'].'[1])) { $ch=\' selected="selected" \'; }

 foreach ($view_'.$dmodulos[0]['link'].' as $'.$dmodulos[0]['link'].') {
  echo \'<option value="\'.$'.$dmodulos[0]['link'].'[\''.$campos['campo'].'\'].\'"\'.$ch.\'>'.$cr.'</option>\';
  } ?>
 </select></div></div>
</div></div>
';
} elseif (( $campos['tipo']=='lista multipla') and ($campos['cdmodulo_referencia']!='')) {

   $dmodulos = $modulos->pesquisaModulos('cdmodulo='.$campos['cdmodulo_referencia']);
   $dcampos = $moduloscampo->pesquisaModuloscampos("cdmodulo=".$campos['cdmodulo_referencia']." and cdescritivo=1",'2');
   $cr='\'.$'.$dmodulos[0]['link'].'[\''.$dcampos[0]['campo'].'\'].\'';
   if (!empty($dcampos[1]['campo'])) {
   $cr.='\'.\' - \'.$'.$dmodulos[0]['link'].'[\''.$dcampos[1]['campo'].'\'].\''; }


$codigopesquisar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$campos['campo'].'" name="m3'.$campos['campo'].'[]" multiple>
  <option value=""></option>
 <?php
 $vmarcado = $_POST[\''.$campos['campo'].'\']; 

 foreach ($view_'.$dmodulos[0]['link'].' as $'.$dmodulos[0]['link'].') {
   $ch=""; 
  if ($vmarcado==$'.$dmodulos[0]['link'].'[\''.$campos['campo'].'\']) { $ch=\' selected="selected" \'; } 
  echo \'<option value="\'.$'.$dmodulos[0]['link'].'[\''.$campos['campo'].'\'].\'"\'.$ch.\'>'.$cr.'</option>\';
  } ?>
 </select></div></div>
</div></div>
';
} elseif (( $campos['tipo']=='lista') and ($campos['expressao']!='')) {

   $expressao = $campos['expressao'];
   $texto = split("\n",$expressao);

$codigopesquisar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$campos['campo'].'" name="m3'.$campos['campo'].'[]" multiple>
  <option value=""></option>';
   foreach ($texto as $te) {
      $menu = explode('=', $te);
      if (empty($menu[1])) {$menu[1]=$menu[0];}
         $codigopesquisar .= '<option value="'.$menu[0].'" <?php if ($_POST[\''.$campos['campo'].'\']==\''.$menu[0].'\') { echo \'selected\';}?>>'.$menu[1].'</option>';
      }
$codigopesquisar .= '
 </select></div></div>
</div></div>
';
} elseif (( $campos['tipo']=='lista multipla') and ($campos['expressao']!='')) {

   $expressao = $campos['expressao'];
   $texto = split("\n",$expressao);

$codigopesquisar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$campos['campo'].'" name="m3'.$campos['campo'].'[]" multiple>
  <option value=""></option>';
   foreach ($texto as $te) {
      $menu = explode('=', $te);
      if (empty($menu[1])) {$menu[1]=$menu[0];}
         $codigopesquisar .= '<option value="'.$menu[0].'" <?php if ($_POST[\''.$campos['campo'].'\']==\''.$menu[0].'\') { echo \'selected\';}?>>'.$menu[1].'</option>';
      }
$codigopesquisar .= '
 </select></div></div>
</div></div>
';
} elseif ( $campos['tipo']=='texto curto'){
$codigopesquisar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="'.$campos['campo'].'" name="s0'.$campos['campo'].'" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'"/></div></div>
</div></div>
';
} else {
$codigopesquisar .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="'.$campos['campo'].'" name="s0'.$campos['campo'].'" type="text" value="<?php echo $_POST[\''.$campos['campo'].'\']; ?>" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'"/></div></div>
</div></div>
';
}
}

$codigopesquisar .= '
<br>

<button type="submit" class="btn btn-primary">Pesquisar</button>
<a href="/<?php echo PROJETO;?>/'.$dir.'/" class="btn btn-default">Cancelar</a>

 </form>
  </div>
 </section>
 </div>
<?php
include(\'app/views/rodape.php\');
?>
';

        if( !file_exists( "app/views/".$dir ) ) {
            $pasta = mkdir("app/views/".$dir, 0777);
        }

           $arquivoindex = "app/views/".$dir."/index.php";
           $arquivonovo = "app/views/".$dir."/novo.php";
           $arquivonovom = "app/views/".$dir."/novom.php";           
           $arquivoeditar = "app/views/".$dir."/editar.php";
           $arquivopesquisar = "app/views/".$dir."/pesquisar.php";

           $ponteiroindex = fopen($arquivoindex, 'w+');
           fwrite($ponteiroindex, $codigoindex);
           fclose($ponteiroindex);

           $ponteironovo = fopen($arquivonovo, 'w+');
           fwrite($ponteironovo, $codigonovo);
           fclose($ponteironovo);

           $ponteironovom = fopen($arquivonovom, 'w+');
           fwrite($ponteironovom, $codigonovom);
           fclose($ponteironovom);

           $ponteiroeditar = fopen($arquivoeditar, 'w+');
           fwrite($ponteiroeditar, $codigoeditar);
           fclose($ponteiroeditar);

           $ponteiropesquisar = fopen($arquivopesquisar, 'w+');
           fwrite($ponteiropesquisar, $codigopesquisar);
           fclose($ponteiropesquisar);

        }



protected function gerarcss($css){

$codigocss = '
body {
  background: #515e72;
  color: '.$css['cor_textopagina'].';
  line-height: 1.5;
  direction: ltr;
  -webkit-font-smoothing: antialiased;
}
@media screen and (min-width: 768px) {
  html,
  body {
    height: 100%;
  }
}
/* acordion */
.skinblue .panel-heading{
  position: relative;
  background: #ffffff;
  border-top: 2px solid '.$css['cor_topo'].';
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  width: 100%;
  font-size: 14px;
  font-weight: bold;
}
.skinblue .panel{
    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
}

/* acondion */

.skinblue .nav-tabs {
  
  border-top-left-radius: 2px;
  border-top-right-radius: 2px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
  background: url(\'../toptabs2.jpg\') repeat-x;
}
.skinblue .nav-tabs > li {
  margin: 0;
}
.skinblue .nav-tabs > li > a {
  border-top-left-radius: 2px;
  border-top-right-radius: 2px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
  border: 1px solid transparent;
  border-bottom: 0;
  margin-left: 0px;
}
.skinblue .nav-tabs > li.active > a,
.skinblue .nav-tabs > li.active > a:hover,
.skinblue .nav-tabs > li.active > a:focus {
  color: #59595a;
  border-top: 2px solid '.$css['cor_topo'].';
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-left: 1px solid #e3e6f3;
  border-right: 1px solid #e3e6f3;
  display: block;
  background-color: #fff;
}
.skinblue .nav-tabs > li > a:hover,
.skinblue .nav-tabs > li > a:hover,
.skinblue .nav-tabs > li > a:focus {
  background-color: transparent;
  border-color: transparent;
  color: #383839;
}
.skinblue .tabs-left .nav-tabs {
  float: left;
  border-top-left-radius: 2px;
  border-top-right-radius: 0;
  border-bottom-left-radius: 2px;
  border-bottom-right-radius: 0;
}
.skinblue .tabs-left .nav-tabs > li {
  float: none;
}
.skinblue .tabs-left .nav-tabs > li > a {
  border-top-left-radius: 2px;
  border-top-right-radius: 0;
  border-bottom-left-radius: 2px;
  border-bottom-right-radius: 0;
  margin-right: 0;
  margin-bottom: 2px;
  margin-left: 0;
}
.skinblue .tabs-left .nav-tabs > li.active > a,
.skinblue .tabs-left .nav-tabs > li.active > a:hover,
.skinblue .tabs-left .nav-tabs > li.active > a:focus {
  color: #59595a;
}
.skinblue .tabs-right .nav-tabs {
  float: right;
  border-top-left-radius: 0;
  border-top-right-radius: 2px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 2px;
}
.skinblue .tabs-right .nav-tabs > li {
  float: none;
}
.skinblue .tabs-right .nav-tabs > li > a {
  border-top-left-radius: 0;
  border-top-right-radius: 2px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 2px;
  margin-right: 0;
  margin-bottom: 2px;
  margin-left: 0;
}
.skinblue .tabs-right .nav-tabs > li.active > a,
.skinblue .tabs-right .nav-tabs > li.active > a:hover,
.skinblue .tabs-right .nav-tabs > li.active > a:focus {
  color: #59595a;
}
.skinblue .box-tab {
  margin-bottom: 25px;
  border-radius: 2px;
}
.skinblue .box-tab .tab-content {
  background-color: #fff;
  padding: 15px;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
  border-top-left-radius: 0;
  border-top-right-radius: 0;
  border-bottom-left-radius: 2px;
  border-bottom-right-radius: 2px;
  overflow: hidden;
}
.skinblue .box-tab.tabs-left .tab-content {
  border-top-left-radius: 0;
  border-top-right-radius: 2px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 2px;
}
.skinblue .box-tab.tabs-right .tab-content {
  border-top-left-radius: 2px;
  border-top-right-radius: 0;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 2px;
}
.skinblue .header-tab {
      color: #444;
    cursor: default;
    font-size: 20px;
    font-weight: 400;
    line-height: 35px;
    padding: 0 10px;
    padding-right: 30px;
}
/* Fim tabs */
/*
 *  Color Scheme
 *
 */
/* Selected text */
::-moz-selection {
  background: #4f5061;
  color: '.$css['cor_textopagina'].';
  text-shadow: none;
}
::selection {
  background: '.$css['cor_textopagina'].';
  color: #ffffff;
  text-shadow: none;
}
/*********************/
/* Spinnner */
.loader:after {
  border: solid 1px transparent;
  border-top-color: #1582dc;
  border-left-color: #1582dc;
}
/*********************/
/* Link hover */
a:active,
a:focus,
a:hover {
  color: #1166ad;
}
/*********************/
/* Layout top header */
.app > .header {
  background-color: '.$css['cor_topo'].';
}
.app > .header .brand {
    background: url(\'../../img/sim-bg.png\');

}
.app > .header .brand a,
.app > .header .brand a:hover {
  color: '.$css['cor_texto'].';
}
.app > .header .navbar-toggle,
.app > .header .nav > li > a,
.app > .header .bg-none {
  color: '.$css['cor_texto'].';
}
@media screen and (min-width: 768px) {
  .header .nav > li > a:hover,
  .header .nav > li > a:focus,
  .header .nav .open > a,
  .header .nav .open > a:hover,
  .header .nav .open > a:focus {
   background: url(\'../../img/activemenu.png\');
  }
}
.header .open a.toggle-search,
.header a.toggle-search:hover {
  background-color: #1377c9;
}
/*********************/
/* Layout Sidebar */
.sidebar {
  background-color: '.$css['cor_menu'].';
  color: '.$css['cor_textomenu'].';
}
.sidebar a,
.sidebar .nav-title {
  color: '.$css['cor_textomenu'].';
}
.compact-menu .main-navigation > ul > li {
  border-bottom: 1px solid #4a4b5b;
  border-top: 1px solid rgba(255, 255, 255, 0.05);
}
.app:not(.small-menu) .main-navigation > ul > li > ul > li.active a,
.app:not(.small-menu) .main-navigation > ul > li > ul > li a:hover {
  color: #ffffff;
}
.main-navigation > ul > li:hover > a {
  color: #ffffff;
}
.main-navigation > ul > li .sub-menu {
  background: url(\'../../img/submenu.png\') ;
}
@media screen and (min-width: 768px) {
  .small-menu .main-navigation > ul > li.open {
    background-color: #4a4b5b;
  }
  .small-menu .main-navigation .nav > li > .sub-menu .sub-menu {
    background-color: #4f5061;
  }
}
/*********************/
/* Gallery hover overlay */
.gallery .overlay {
  background-color: #4f5061;
  background-color: rgba(79, 80, 97, 0.9);
}
/*********************/
/* Skin button style */
.btn-color {
  color: #ffffff;
  background-color: #4f5061;
  border-color: #4f5061;
}
a.btn-color {
  color: #ffffff;
}
.btn-color:hover,
.btn-color:focus,
.btn-color:active,
.btn-color.active,
.open .dropdown-toggle.btn-color {
  color: #ffffff;
  background-color: #444453;
  background-image: none;
  border-color: #444453;
}
.btn-color.disabled,
.btn-color[disabled],
fieldset[disabled] .btn-color,
.btn-color.disabled:hover,
.btn-color[disabled]:hover,
fieldset[disabled] .btn-color:hover,
.btn-color.disabled:focus,
.btn-color[disabled]:focus,
fieldset[disabled] .btn-color:focus,
.btn-color.disabled:active,
.btn-color[disabled]:active,
fieldset[disabled] .btn-color:active,
.btn-color.disabled.active,
.btn-color[disabled].active,
fieldset[disabled] .btn-color.active {
  background-color: #4f5061;
  border-color: #4f5061;
}
.btn-color.btn-outline {
  background-color: transparent;
  color: #4f5061;
}
.btn-color.btn-outline:hover,
.btn-color.btn-outline:focus,
.btn-color.btn-outline:active,
.btn-color.btn-outline.active {
  background-color: #4f5061;
  color: #ffffff;
}
/*********************/
/* Skin text color style */
.color {
  color: #4f5061;
}
/*********************/
/* Skin nestable style */
#nestable2 .dd-handle {
  color: #cacbd0;
  border: 1px solid #4f5061;
  background-color: #4f5061;
}
#nestable2 .dd-handle:hover {
  background-color: #5a5c6f;
}
/*********************/
/* Skin slider style */
.slider-color .slider-selection {
  background-color: #4f5061;
}
.slider-color .slider-handle {
  box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 5px, #4f5061 0px 0px 0px 1px;
}
/*********************/
/* Skin panel style */
.panel-color {
  border-color: #4f5061;
}
.panel-color > .panel-heading {
  color: #cacbd0;
  background-color: #4f5061;
  border-color: #4f5061;
}
.panel-color > .panel-heading + .panel-collapse .panel-body {
  border-top-color: #4f5061;
}
.panel-color > .panel-heading a {
  color: #cacbd0;
}
.panel-color > .panel-footer + .panel-collapse .panel-body {
  border-bottom-color: #4f5061;
}
/*********************/
/* Skin label style */
.label-color {
  background-color: #4f5061;
}
.label-color[href]:hover,
.label-color[href]:focus {
  background-color: #383945;
}
/*********************/
/* Skin background color */
.bg-color {
  background-color: #4f5061;
  color: #cacbd0;
}
.bg-color a {
  color: #cacbd0;
}
.bg-color a:active,
.bg-color a:focus,
.bg-color a:hover {
  color: #afb0b7;
  text-decoration: none;
  outline: 0;
}
.bg-color .nav > li:hover > a,
.bg-color .nav > li:focus > a,
.bg-color .nav > li:active > a,
.bg-color .nav > li.active > a,
.bg-color .nav > li > a:hover,
.bg-color .nav > li > a:focus {
  background-color: #484959;
}
/*********************/
/* Skin pagination style */
.pagination > .active > a,
.pagination > .active > span,
.pagination > .active > a:hover,
.pagination > .active > span:hover,
.pagination > .active > a:focus,
.pagination > .active > span:focus {
  border-color: #4f5061;
  background-color: #4f5061;
  color: #ffffff;
}
/*********************/
/* Skin progress bar style */
.progress-bar-color {
  background-color: #4f5061;
}
/*********************/
/* Skin chart elements */
.morris-hover.morris-default-style {
  border-color: #4f5061;
  background-color: #4f5061;
  background-color: rgba(79, 80, 97, 0.9);
}
.morris-hover.morris-default-style a {
  color: #ffffff;
}
#jqstooltip {
  background-color: #4f5061;
  border-color: #4f5061;
}
#tooltip {
  background-color: #4f5061;
  color: #ffffff;
}
#tooltip:before {
  border-color: transparent #4f5061 transparent transparent;
}
/*********************/
.jvectormap-label {
  border: solid 1px #4f5061;
  background-color: #4f5061;
  color: white;
}
.jvectormap-zoomin,
.jvectormap-zoomout {
  background-color: #4f5061;
  color: white;
}

/* menu de contexto */
.menu-acao{
background-color:'.$css['cor_mc'].';
min-height: 38px;
line-height: 35px;
margin-bottom: 10px;
}
.btn-menu-acao{
background-color:'.$css['cor_mc'].';
color: '.$css['cor_textomc'].';
}
/* fim menu contexto */
/* preview layout */
#span1{
width: 80%;
background:#1582dc;
color: #fff;
height: 20px;
}
#span2{
width: 10%;
background:#4f5061;
float: left;
font-size: 8px;
height: 200px;
color: #cad0dd;
}
.menuprev{
  list-style-type: none; 
  padding-left: 2px; 
}
#span3{
width: 70%;
background: #f1f4f9;
float: left;
height: 200px;
font-size: 8px;
padding: 2px;
}
#tudo{

    padding: 15px;
    padding-top: 40px;
    margin-bottom: 10px;
}
#logo{
    width: 12.5%;
    background: url(\'../../img/sim-bg.png\');
    float:left;
}
#menutopo{
    font-size: 8px;
    line-height: 20px;
}
#mapa{
   float:left;
}
#mcontexto{
    float: right;
    min-width: 50%;
    background: #7aadd7;
    padding-left: 4px;
    color:#fff;
    font-size: 7px;
    line-height: 14px;
}
#ctt{
  background: #fff;
  padding: 4px;
  margin: 3px;
  margin-top: 5px;
  height: 170px;
}
.clear{
    clear:both;
}
/* fim previu layout */

.main-content {
  background: '.$css['cor_pagina'].';
}

';
     
           $arquivo = "inc/css/skins/".PROJETO.$css['cdlayout'].".css";

           $ponteiro = fopen($arquivo, 'w+');
           fwrite($ponteiro, $codigocss);
           fclose($ponteiro);
        } 




    }