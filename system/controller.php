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



       protected function modvinculados($modulo, $id = '', $de = '', $tipo = ''){
            $modulos = new modulosModel();
            $mod = $modulos->listaModulos("link='".$modulo."'");
            $moduloscampo = new moduloscamposModel();
            $chave = $moduloscampo->pesquisaModuloscampos('cdmodulo='.$mod[0]['cdmodulo'].' and cchave=1');

            $modulosvinculados = new modulosvinculadosModel();
            $amvc = $modulosvinculados->listaModulosvinculados('cdvinculado='.$mod[0]['cdmodulo']);
            $pmvc = $modulosvinculados->listaModulosvinculados('cdmodulo='.$mod[0]['cdmodulo']);
            if ($amvc[0]['cdmodulo']!='') {
            $ppmvc = $modulosvinculados->listaModulosvinculados('cdmodulo='.$amvc[0]['cdmodulo']);
            }
            $i=0;

            foreach ($amvc as $famvc ) {
                $amod = $modulos->listaModulos('cdmodulo='.$famvc['cdmodulo']);
                $chavea = $moduloscampo->pesquisaModuloscampos('cdmodulo='.$amvc[0]['cdmodulo'].' and cchave=1');
                if ($amvc[0]['cdmodulo']=='8') {
                    $dmvc[$i]['link']='/'.PROJETO.'/'.$amod[0]['link'].'/visualiza/id/'.$_SESSION[PROJETO]['filtro'][$chavea[0]['campo']];
                } else {
                   $dmvc[$i]['link']='/'.PROJETO.'/'.$amod[0]['link'].'/editar/id/'.$_SESSION[PROJETO]['filtro'][$chavea[0]['campo']];    
                }
                $dmvc[$i]['atalho']=$amod[0]['atalho'].': <b><small>'.$_SESSION[PROJETO]['filtro']['d'.$chavea[0]['campo']].'</b></small>';
                $dmvc[$i]['nome']=$amod[0]['nome'];
                $dmvc[$i]['tipo']='';
                $dmvc[$i]['tp']=0;
                $dmvc[$i]['chave']=$chavea[0]['campo'];
                $dmvc[$i]['valor']=$_SESSION[PROJETO]['filtro'][$chavea[0]['campo']];
                $i++;
            }
            if ($id!='') {
                $_SESSION[PROJETO]['filtro'][$chave[0]['campo']]=$id;
                $_SESSION[PROJETO]['filtro']['d'.$chave[0]['campo']]=$de;
                if ($tipo!='') {
                $_SESSION[PROJETO]['filtro']['cdtipo']=$tipo;
                }

            } else {
                unset($_SESSION[PROJETO]['filtro'][$chave[0]['campo']]);
                unset($_SESSION[PROJETO]['filtro']['d'.$chave[0]['campo']]);
            }
                $dmvc[$i]['link']='#';
                $dmvc[$i]['atalho']='<b>'.$mod[0]['atalho'].'</b>';
                $dmvc[$i]['nome']=$mod[0]['nome'];
                $dmvc[$i]['tipo']=' class="active"';
                $dmvc[$i]['tp']=1;
                $i++;
            if ($id!='') {
            foreach ($pmvc as $fpmvc ) {
                 $pmod = $modulos->listaModulos('cdmodulo='.$fpmvc['cdmodulo']);
                 $chavep = $moduloscampo->pesquisaModuloscampos('cdmodulo='.$pmvc[0]['cdmodulo'].' and cchave=1');                
                $dmod = $modulos->listaModulos('cdmodulo='.$fpmvc['cdvinculado']);
                $dmvc[$i]['link']='/'.PROJETO.'/'.$dmod[0]['link'].'/index/'.$chave[0]['campo'].'/'.$id;
                $dmvc[$i]['atalho']=$dmod[0]['atalho'];
                $dmvc[$i]['nome']=$dmod[0]['nome'];
                $dmvc[$i]['tipo']='';
                $dmvc[$i]['tp']=2;
                $i++;
            }


            }

            return $dmvc;

        }





} 
