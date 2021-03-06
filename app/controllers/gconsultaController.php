<?php
session_start();
    class gconsulta extends Controller{


public function Index_action(){

$id = $this->getParam('id');

$modulos = new modulosModel();
$moduloscampo = new moduloscamposModel();
$consultas = new consultasModel();
$projetos = new projetosModel();

$detalhes_consultas = $consultas->listaconsultas("cdconsulta=".$id);

$detalhes_campos = $consultas->rsql(" select p.cdparametro, p.questionario, c.* from parametro p
                                      left outer join modulo_campo c on p.cdcampo=c.cdcampo
                                                  where
                                                   p.cdconsulta=".$id." and p.valor is null
                                                   order by p.cdparametro ");

$campo = $detalhes_campos;

if ($detalhes_campos[0]['cdparametro']=='') {
header( "Location: /".PROJETO."/gconsulta/gerar/id/$id" );
}

foreach ($campo as $campos ) {
$ob= '';

if ($campos['cdcampo']!=''){

if ($campos['tipo']=='data'){
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="date" name="p'.$campos['cdparametro'].'" type="text" value="" class="form-control" placeholder="99/99/9999"'.$ob.' data-parsley-trigger="change"/></div></div>
</div></div>
';
} elseif ( ($campos['tipo']=='inteiro') or (($campos['tipo']=='numero'))){
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="p'.$campos['cdparametro'].'" name="p'.$campos['cdparametro'].'" type="text" value="" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'" data-parsley-type="digits"/></div></div>
</div></div>
';
} elseif ( $campos['tipo']=='email'){
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="p'.$campos['cdparametro'].'" name="p'.$campos['cdparametro'].'" type="text" value="" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'" data-parsley-type="email"/></div></div>
</div></div>
';
} elseif ( $campos['tipo']=='url'){
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="p'.$campos['cdparametro'].'" name="p'.$campos['cdparametro'].'" type="text" value="" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'" data-parsley-type="url"/></div></div>
</div></div>
';
} elseif ( $campos['tipo']=='texto longo'){
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="p'.$campos['cdparametro'].'" rows="4"></textarea>
</div></div>
</div></div>
';
} elseif (( $campos['tipo']=='lista') and ($campos['cdmodulo_referencia']!='')) {


   $dmodulos = $modulos->pesquisaModulos('cdmodulo='.$campos['cdmodulo_referencia']);
   $dcampos = $moduloscampo->pesquisaModuloscampos("cdmodulo=".$campos['cdmodulo_referencia']." and cdescritivo=1",'2');
   $ccampos = $moduloscampo->pesquisaModuloscampos("cdmodulo=".$campos['cdmodulo_referencia']." and cchave=1",'2');
   if ($dmodulos[0]['tipo_conexao']=='2') {
     $detalhes_lista = $projetos->rsql(" select ".$ccampos[0]['campo']." as codigo, ".$dcampos[0]['campo']." as descritivo from ".$dmodulos[0]['entidade']." ");
   } else {
     $detalhes_lista = $consultas->rsql(" select ".$ccampos[0]['campo']." as codigo, ".$dcampos[0]['campo']." as descritivo from ".$dmodulos[0]['entidade']." ");
   }

$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="p'.$campos['cdparametro'].'" name="p'.$campos['cdparametro'].'"'.$ob.' data-parsley-trigger="change">
  <option value=""></option>';
 foreach ($detalhes_lista as $lista) {
  $codigonovo .= '<option value="'.$lista['codigo'].'">'.$lista['descritivo'].'</option>';
  }
$codigonovo .= '  
 </select></div></div>
</div></div>
';


} elseif (( $campos['tipo']=='lista multipla') and ($campos['cdmodulo_referencia']!='')) {

 
   $dmodulos = $modulos->pesquisaModulos('cdmodulo='.$campos['cdmodulo_referencia']);
   $dcampos = $moduloscampo->pesquisaModuloscampos("cdmodulo=".$campos['cdmodulo_referencia']." and cdescritivo=1",'2');
   $ccampos = $moduloscampo->pesquisaModuloscampos("cdmodulo=".$campos['cdmodulo_referencia']." and cchave=1",'2');
   if ($dmodulos[0]['tipo_conexao']=='2') {
     $detalhes_lista = $projetos->rsql(" select ".$ccampos[0]['campo']." as codigo, ".$dcampos[0]['campo']." as descritivo from ".$dmodulos[0]['entidade']." ");
   } else {
     $detalhes_lista = $consultas->rsql(" select ".$ccampos[0]['campo']." as codigo, ".$dcampos[0]['campo']." as descritivo from ".$dmodulos[0]['entidade']." ");
   }

$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="p'.$campos['cdparametro'].'" name="p'.$campos['cdparametro'].'[]"'.$ob.' data-parsley-trigger="change">
  <option value=""></option>';
 foreach ($detalhes_lista as $lista) {
  $codigonovo .= '<option value="'.$lista['codigo'].'">'.$lista['descritivo'].'</option>';
  }
$codigonovo .= '  
 </select></div></div>
</div></div>
';
} elseif (( $campos['tipo']=='lista') and ($campos['expressao']!='')) {

   $expressao = $campos['expressao'];
   $texto = explode(",",$expressao);
   //print_r($texto);die();

$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="p'.$campos['cdparametro'].'" name="p'.$campos['cdparametro'].'"'.$ob.' data-parsley-trigger="change">
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
   $texto = explode(",",$expressao);

$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="p'.$campos['cdparametro'].'" name="p'.$campos['cdparametro'].'"[]'.$ob.' data-parsley-trigger="change"  multiple>
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
} elseif ( $campos['tipo']=='check'){
$codigonovo .= '
<div class="control-group" id="positionGroup">
     <div class="controls icheck">
         <h5>'.$campos['legenda'].'</h5>
       <div class="mb5 mt5">
           <input type="checkbox" id="minimal-checkbox-1" name="p'.$campos['cdparametro'].'" value="1">
       </div>
      </div>
</div>
';
} elseif ( $campos['tipo']=='texto curto'){
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="p'.$campos['cdparametro'].'" name="p'.$campos['cdparametro'].'" type="text" value="" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'"/></div></div>
</div></div>
';
} else {
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$campos['legenda'].'</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="p'.$campos['cdparametro'].'" name="p'.$campos['cdparametro'].'" type="text" value="" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$campos['legenda'].'"/></div></div>
</div></div>
';
}


} elseif ($campos['questionario']{0}=='d'){


            // documentos
            $documentos = new documentosModel();
            $detalhes_documentos = $documentos->listadocumentos("cddocumento=".substr($campos['questionario'],1));


            foreach ($detalhes_documentos as $documento) {

            // campos
            $campos = new camposModel();
            $detalhes_campos = $campos->listacampos("cddocumento=".$documento['cddocumento']);

$ob='';
if ($documento['tipo']=='DATA'){
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$documento['descricao'].$ob.'</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="date" name="d'.$detalhes_campos[0]['cddocumento'].'" type="text" value="" class="form-control" placeholder="99/99/9999"'.$ob.' data-parsley-trigger="change"/></div></div>
</div></div>
';
} elseif ( ($documento['tipo']=='NUMERO')){
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$documento['descricao'].$ob.'</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="'.$detalhes_campos[0]['cddocumento'].'" name="d'.$detalhes_campos[0]['cddocumento'].'" type="text" value="" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$documento['descricao'].'" data-parsley-type="digits"/></div></div>
</div></div>
';
} elseif ( $documento['tipo']=='TEXTO LONGO'){
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$documento['descricao'].$ob.'</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="d'.$detalhes_campos[0]['cddocumento'].'" rows="4"></textarea>
</div></div>
</div></div>
';
} elseif (( $documento['tipo']=='LISTA') ) {

$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$documento['descricao'].$ob.'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$detalhes_campos[0]['cddocumento'].'" name="d'.$detalhes_campos[0]['cddocumento'].'" data-parsley-trigger="change">
  <option value=""></option>';

    foreach ($detalhes_campos as $campo) {

       $codigonovo .= '<option value="'.$campo['descricao'].'"'.$ch.'>'.$campo['descricao'].'</option>';
    }
    $codigonovo .= '   </select></div></div>
                        </div></div>';

} elseif (( $documento['tipo']=='LISTA MULTIPLA') ) {


$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$documento['descricao'].$ob.'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$detalhes_campos[0]['cddocumento'].'" name="d'.$detalhes_campos[0]['cddocumento'].'[]" data-parsley-trigger="change" multiple>
  <option value=""></option>';
  

    foreach ($detalhes_campos as $campo) {

       $codigonovo .= '<option value="'.$campo['descricao'].'"'.$ch.'>'.$campo['descricao'].'</option>';
    }
    $codigonovo .= '   </select></div></div>
                        </div></div>';

}   else {
    
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$documento['descricao'].$ob.'</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="'.$detalhes_campos[0]['cddocumento'].'" name="d'.$detalhes_campos[0]['cddocumento'].'" type="text" value="" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$documento['descricao'].'"/></div></div>
</div></div>
';
}

} 

}  elseif ($campos['questionario']{0}=='p'){


            // perguntas
            $perguntas = new perguntasModel();
            $detalhes_perguntas = $perguntas->listaperguntas("cdpergunta=".substr($campos['questionario'],1));


            foreach ($detalhes_perguntas as $pergunta) {

            // respostas
            $respostas = new respostasModel();
            $detalhes_respostas = $respostas->listarespostas("cdpergunta=".$pergunta['cdpergunta']);

$ob='';
if ($pergunta['tipo']=='DATA'){
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$pergunta['descricao'].$ob.'</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="date" name="r'.$detalhes_respostas[0]['cdpergunta'].'" type="text" value="" class="form-control" placeholder="99/99/9999"'.$ob.' data-parsley-trigger="change"/></div></div>
</div></div>
';
} elseif ( ($pergunta['tipo']=='NUMERO')){
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$pergunta['descricao'].$ob.'</label>
<div class="controls">
<div class="row"><div class="col-xs-4"><input id="'.$detalhes_respostas[0]['cdpergunta'].'" name="r'.$detalhes_respostas[0]['cdpergunta'].'" type="text" value="" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$pergunta['descricao'].'" data-parsley-type="digits"/></div></div>
</div></div>
';
} elseif ( $pergunta['tipo']=='TEXTO LONGO'){
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$pergunta['descricao'].$ob.'</label>
<div class="controls">
<div class="row"><div class="col-xs-12">
<textarea class="form-control" name="r'.$detalhes_respostas[0]['cdpergunta'].'" rows="4"></textarea>
</div></div>
</div></div>
';
} elseif (( $pergunta['tipo']=='LISTA') ) {

$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$pergunta['descricao'].$ob.'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$detalhes_respostas[0]['cdpergunta'].'" name="r'.$detalhes_respostas[0]['cdpergunta'].'" data-parsley-trigger="change">
  <option value=""></option>';

    foreach ($detalhes_respostas as $resposta) {

       $codigonovo .= '<option value="'.$resposta['descricao'].'"'.$ch.'>'.$resposta['descricao'].'</option>';
    }
    $codigonovo .= '   </select></div></div>
                        </div></div>';

} elseif (( $pergunta['tipo']=='LISTA MULTIPLA') ) {


$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$pergunta['descricao'].$ob.'</label>
<div class="controls">
 <div class="row"><div class="col-xs-12"><select class="chosen" id="'.$detalhes_respostas[0]['cdpergunta'].'" name="r'.$detalhes_respostas[0]['cdpergunta'].'[]" data-parsley-trigger="change" multiple>
  <option value=""></option>';
  

    foreach ($detalhes_respostas as $resposta) {

       $codigonovo .= '<option value="'.$resposta['descricao'].'"'.$ch.'>'.$resposta['descricao'].'</option>';
    }
    $codigonovo .= '   </select></div></div>
                        </div></div>';

}   else {
    
$codigonovo .= '
<div class="form-group">
<label  class="control-label">'.$pergunta['descricao'].$ob.'</label>
<div class="controls">
<div class="row"><div class="col-xs-12"><input id="'.$detalhes_respostas[0]['cdpergunta'].'" name="r'.$detalhes_respostas[0]['cdpergunta'].'" type="text" value="" class="form-control" '.$ob.' data-parsley-trigger="change" placeholder="'.$pergunta['descricao'].'"/></div></div>
</div></div>
';
}

} 


}

}

            $datas['pagina']=$codigonovo;
            $datas['consultas']=$detalhes_consultas;
            $this->view('/gconsulta/index', $datas);
        }












function cor() {
$cor = array ( 
'0' => '#da5b43',
'1' => '#ecd179',
'2' => '#c03442',
'3' => '#542437',
'4' => '#53777b',
'5' => '#69d3e9',
'6' => '#a7dcd9',
'7' => '#e1e5cd',
'8' => '#ef8633',
'9' => '#ec6833',
'10' => '#e94363',
'11' => '#f19d9a',
'12' => '#f8ceae', 
'13' => '#c8c8aa',
'14' => '#84b09c',
'15' => '#d0f19f',
'16' => '#a9dca8',
'17' => '#7abe9b',
'18' => '#3e8787',
'19' => '#17496c',
'20' => '#566371',
'21' => '#c8f464',
'22' => '#eb6769', 
'23' => '#c54d58',
'24' => '#61cdc5',
'25' => '#4a153d',
'26' => '#bf3550',
'27' => '#e98032',
'28' => '#f8cc33',
'29' => '#8b9c14'); 

 return $cor[array_rand($cor)];
}


public function gerar(){

$id = $this->getParam('id');

$modulos = new modulosModel();
$moduloscampo = new moduloscamposModel();
$consultas = new consultasModel();
$projetos = new projetosModel();

$_SESSION[PROJETO]['grafico']='';

$detalhes_consultas = $consultas->listaconsultas("cdconsulta=".$id);

$datas['consultas']= $detalhes_consultas;


$infconsulta = $this->gera_consulta($id);

$datas['pagina']= $infconsulta;

$rodape2 = '
    </section>

    </div>
    </div>
    </div>
    </div>
    </section>
    </div>
    
    <script>
     window.onload = function(){
     '.$_SESSION[PROJETO]['grafico'].'
     }
     </script>
    <script src="/'.PROJETO.'/inc/plugins/jquery-1.11.1.min.js"></script>
    <script src="/'.PROJETO.'/inc/bootstrap/js/bootstrap.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.slimscroll.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.easing.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/appear/jquery.appear.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.placeholder.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/fastclick.js"></script>
    <script src="/'.PROJETO.'/inc/js/offscreen.js"></script>
    <script src="/'.PROJETO.'/inc/js/main.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/chosen/chosen.jquery.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/'.PROJETO.'/inc/js/bootstrap-datatables.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.sortable.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.nestable.js"></script>
    <script src="/'.PROJETO.'/inc/js/table-edit.js"></script>
    <script src="/'.PROJETO.'/inc/js/script_dm.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/icheck/icheck.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/parsley.min.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/jquery.maskedinput.min.js"></script>
    <script src="/'.PROJETO.'/inc/js/form-masks.js"></script>
    <script src="/'.PROJETO.'/inc/js/general.js"></script>



    <script src="/'.PROJETO.'/inc/plugins/isotope/isotope.pkgd.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/imagesloaded/imagesloaded.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/superbox/superbox.min.js"></script>

    <script src="/'.PROJETO.'/inc/js/gallery.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/dropzone/dropzone.js"></script>

 <!-- page level scripts -->
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.categories.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.stack.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.time.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.orderBars.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.pie.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.sparkline.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.easing.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/easy-pie-chart/jquery.easypiechart.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/raphael.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/morris/morris.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/chartjs/Chart.min.js"></script>
    </body>
<!-- /body -->
</html>';
    
             $datas['rodape']=$rodape2;
      
            $this->view('/gconsulta/consulta', $datas);
    } 






public function gerarimg(){

$id = $this->getParam('id');

$modulos = new modulosModel();
$moduloscampo = new moduloscamposModel();
$consultas = new consultasModel();
$projetos = new projetosModel();

$_SESSION[PROJETO]['grafico']='';

$detalhes_consultas = $consultas->listaconsultas("cdconsulta=".$id);

$datas['consultas']= $detalhes_consultas;


$infconsulta = $this->gera_consulta($id);

$datas['pagina']= $infconsulta;

$rodape2 = '
    </section>

    </div>
    </div>
    </div>
    </div>
    </section>
    </div>
    
    <script>
     window.onload = function(){
     '.$_SESSION[PROJETO]['grafico'].'
     }
     </script>
    <script src="/'.PROJETO.'/inc/plugins/jquery-1.11.1.min.js"></script>
    <script src="/'.PROJETO.'/inc/bootstrap/js/bootstrap.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.slimscroll.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.easing.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/appear/jquery.appear.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.placeholder.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/fastclick.js"></script>
    <script src="/'.PROJETO.'/inc/js/offscreen.js"></script>
    <script src="/'.PROJETO.'/inc/js/main.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/chosen/chosen.jquery.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/'.PROJETO.'/inc/js/bootstrap-datatables.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.sortable.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.nestable.js"></script>
    <script src="/'.PROJETO.'/inc/js/table-edit.js"></script>
    <script src="/'.PROJETO.'/inc/js/script_dm.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/icheck/icheck.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/parsley.min.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/jquery.maskedinput.min.js"></script>
    <script src="/'.PROJETO.'/inc/js/form-masks.js"></script>
    <script src="/'.PROJETO.'/inc/js/general.js"></script>



    <script src="/'.PROJETO.'/inc/plugins/isotope/isotope.pkgd.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/imagesloaded/imagesloaded.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/superbox/superbox.min.js"></script>

    <script src="/'.PROJETO.'/inc/js/gallery.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/dropzone/dropzone.js"></script>

 <!-- page level scripts -->
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.categories.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.stack.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.time.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.orderBars.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.pie.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.sparkline.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.easing.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/easy-pie-chart/jquery.easypiechart.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/raphael.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/morris/morris.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/chartjs/Chart.min.js"></script>
    
           <script type="text/javascript" src="/'.PROJETO.'/inc/js/html2canvas.js"></script>
    <script type="text/javascript">
        html2canvas(document.body).then(function(canvas) {
            document.body.appendChild(canvas);
        });
    </script>    
    </body>
<!-- /body -->
</html>';
    
             $datas['rodape']=$rodape2;
      
            $this->view('/gconsulta/consultaimg', $datas);
    } 






public function gerar_p(){

$id = $this->getParam('id');

$modulos = new modulosModel();
$moduloscampo = new moduloscamposModel();
$consultas = new consultasModel();
$projetos = new projetosmapaModel();

$_SESSION[PROJETO]['mgrafico']='';

$detalhes_consultas = $consultas->listaconsultas("cdconsulta=".$id);

$datas['consultas']= $detalhes_consultas;


$infconsulta = $this->gera_consulta_publica($id);

$datas['pagina']= $infconsulta;

$rodape2 = '
    </section>

    </div>
    </div>
    </div>
    </div>
    </section>
    </div>
    
    <script>
     window.onload = function(){
     '.$_SESSION[PROJETO]['mgrafico'].'
     }
     </script>
    <script src="/'.PROJETO.'/inc/plugins/jquery-1.11.1.min.js"></script>
    <script src="/'.PROJETO.'/inc/bootstrap/js/bootstrap.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.slimscroll.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.easing.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/appear/jquery.appear.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.placeholder.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/fastclick.js"></script>
    <script src="/'.PROJETO.'/inc/js/offscreen.js"></script>
    <script src="/'.PROJETO.'/inc/js/main.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/chosen/chosen.jquery.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/'.PROJETO.'/inc/js/bootstrap-datatables.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.sortable.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.nestable.js"></script>
    <script src="/'.PROJETO.'/inc/js/table-edit.js"></script>
    <script src="/'.PROJETO.'/inc/js/script_dm.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/icheck/icheck.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/parsley.min.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/jquery.maskedinput.min.js"></script>
    <script src="/'.PROJETO.'/inc/js/form-masks.js"></script>
    <script src="/'.PROJETO.'/inc/js/general.js"></script>



    <script src="/'.PROJETO.'/inc/plugins/isotope/isotope.pkgd.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/imagesloaded/imagesloaded.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/superbox/superbox.min.js"></script>

    <script src="/'.PROJETO.'/inc/js/gallery.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/dropzone/dropzone.js"></script>

 <!-- page level scripts -->
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.categories.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.stack.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.time.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.orderBars.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.pie.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.sparkline.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.easing.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/easy-pie-chart/jquery.easypiechart.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/raphael.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/morris/morris.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/chartjs/Chart.min.js"></script>
    </body>
<!-- /body -->
</html>';
    
             $datas['rodape']=$rodape2;
      
            $this->view('/gconsulta/consulta_p', $datas);
    } 















public function exportarxls(){

$id = $this->getParam('id');

$modulos = new modulosModel();
$moduloscampo = new moduloscamposModel();
$consultas = new consultasModel();
$projetos = new projetosModel();

$detalhes_consultas = $consultas->listaconsultas("cdconsulta=".$id);

$datas['consultas']= $detalhes_consultas;


$infconsulta = $this->gera_consulta($id);

$datas['pagina']= $infconsulta;

$rodape2 = '
    </section>

    </div>
    </div>
    </div>
    </div>
    </section>
    </div>
    
    <script>
     window.onload = function(){
     '.$_SESSION[PROJETO]['grafico'].'
     }
     </script>
    <script src="/'.PROJETO.'/inc/plugins/jquery-1.11.1.min.js"></script>
    <script src="/'.PROJETO.'/inc/bootstrap/js/bootstrap.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.slimscroll.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.easing.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/appear/jquery.appear.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.placeholder.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/fastclick.js"></script>
    <script src="/'.PROJETO.'/inc/js/offscreen.js"></script>
    <script src="/'.PROJETO.'/inc/js/main.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/chosen/chosen.jquery.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/'.PROJETO.'/inc/js/bootstrap-datatables.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.sortable.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.nestable.js"></script>
    <script src="/'.PROJETO.'/inc/js/table-edit.js"></script>
    <script src="/'.PROJETO.'/inc/js/script_dm.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/icheck/icheck.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/parsley.min.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/jquery.maskedinput.min.js"></script>
    <script src="/'.PROJETO.'/inc/js/form-masks.js"></script>
    <script src="/'.PROJETO.'/inc/js/general.js"></script>



    <script src="/'.PROJETO.'/inc/plugins/isotope/isotope.pkgd.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/imagesloaded/imagesloaded.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/superbox/superbox.min.js"></script>

    <script src="/'.PROJETO.'/inc/js/gallery.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/dropzone/dropzone.js"></script>

 <!-- page level scripts -->
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.categories.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.stack.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.time.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.orderBars.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.pie.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.sparkline.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.easing.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/easy-pie-chart/jquery.easypiechart.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/raphael.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/morris/morris.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/chartjs/Chart.min.js"></script>
    </body>
<!-- /body -->
</html>';
    
             $datas['rodape']=$rodape2;

   
 $this->view('/gconsulta/xls', $datas);
}








public function consultar(){

$id = $this->getParam('id');
$cliente = $this->getParam('cliente');

$modulos = new modulosModel();
$moduloscampo = new moduloscamposModel();
$consultas = new consultasModel();
$projetos = new projetosModel();

$detalhes_consultas = $consultas->listaconsultas("cdconsulta=".$id);

if ($cliente=='') {
            $datas['css']="default";    
            } else {
            $clientes = new clientesModel();
            $detalhes_clientes = $clientes->listaclientes("sigla='{$cliente}'");
            $datas['css'] = PROJETO.$detalhes_clientes[0]['cdlayoutmapa'];
            $datas['cliente'] = $detalhes_clientes;
            }

$vconsulta = $id;

// seleciona as saida 
  
  $sqlsaida = "select e.entidade ||'.'|| c.campo as nome, s.tipo, c.legenda, s.cdsaida, s.chave, s.visualiza, s.rotulo, s.totaliza from modulo e, modulo_campo c, saida s
           where e.cdmodulo=c.cdmodulo and c.cdcampo=s.cdcampo and s.cdconsulta=".$vconsulta ."  order by s.cdsaida";

  $rssaidas = $consultas->rsql($sqlsaida);

  //$rc = $rs->RowCount();  
  $saida='';
  $grupo='';
  $ordem='';
  $tab='';
  $agrupar=0;
  $rotulo='';
  $totaliza='';
  $i3=0;
   $i = 0;
  foreach ($rssaidas as $saidas ) {
  if ($saidas['visualiza']=='1') {
   $tab=$tab.'<th>'.$saidas['legenda'].'</th>';
  }
  if ($saidas['rotulo']=='1') {
   $rotulo=$saidas['cdsaida'];
  }
  if ($saidas['totaliza']=='1') {
   $totaliza=$saidas['cdsaida'];
  }
        $sel=trim($saidas['tipo']);
         if ($sel=='somar') {
         $sel='SUM(';
         } elseif ($sel=='maior valor') {
         $sel='MAX(';
         } elseif ($sel=='menor valor') {
         $sel='MIN(';
         } elseif ($sel=='média') {
         $sel='AVG(';
         } elseif ($sel=='quantificar') {
         $sel='COUNT(';
         } else {
         $sel='(';
         }
  
  
     if ($i>0) {
        if ($sel!='(') {
        $agrupar=1;
        } else {
         $grupo=$grupo.', '.$saidas['nome'];
         $ordem=$ordem.', '.$saidas['nome']; 
        } 
        $saida=$saida.', '.$sel.$saidas['nome'].') AS '.'"'.$saidas['cdsaida'].'"'; 
     } else {
      if ($sel!='(') {
        $agrupar=1;
        } else {
        $saida=' SELECT '.$saidas['nome'];
        $grupo=' GROUP BY '.$saidas['nome']; 
        $ordem=' ORDER BY '.$saidas['nome'];     
        }
        $saida=' SELECT '.$sel.$saidas['nome'].') AS '.'"'.$saidas['cdsaida'].'"'; 
     }
     
     
  $i++;
  }
  
  
    // seleciona as tabelas

  
  $sqltabelas = " select e.entidade as nome, e.cdmodulo from modulo e where cdmodulo in (
           select e.cdmodulo from modulo e, modulo_campo c, saida s
           where e.cdmodulo=c.cdmodulo and c.cdcampo=s.cdcampo and s.cdconsulta=".$vconsulta ."
           union
            select e.cdmodulo from modulo e, modulo_campo c, parametro p 
           where e.cdmodulo=c.cdmodulo and c.cdcampo=p.cdcampo  and p.cdconsulta=".$vconsulta." )"; 

$rstabelas = $consultas->rsql($sqltabelas);
  
    
  $tabela='';
  $relacionamento='';
  $i = 0;
  foreach ($rstabelas as $tabelas ) {
         // adiciona tabelas envolvidas
  if ($i>0) {
        $tabela=$tabela.', '.$tabelas['nome'];
        $lmodulo=$lmodulo.', '.$tabelas['cdmodulo'];
  } else {
        $tabela=' FROM '.$tabelas['nome'];
        $lmodulo=$tabelas['cdmodulo'];
     }
    $i++;
  }



   foreach ($rstabelas as $tabelas ) {
      $refcampos = $moduloscampo->listaModuloscampos('cdmodulo='.$tabelas['cdmodulo'].' and cdmodulo_referencia in ('.$lmodulo.')');

      foreach ($refcampos as $refcampo) {
            if ($relacionamento!='') {$relacionamento.=' and ';}
                $moduloref = $modulos->listaModulos('cdmodulo='.$refcampo['cdmodulo_referencia']);
                $chave = $moduloscampo->pesquisaModuloscampos('cdmodulo='.$refcampo['cdmodulo_referencia'].' and cchave=1');
                $relacionamento.= $tabelas['nome'].'.'.$refcampo['campo'].' = '.$moduloref[0]['entidade'].'.'.$chave[0]['campo'];
      }
   }

  
  
  // seleciona os parametros
  
  $sqlparametros = "select e.entidade ||'.'|| c.campo as nome, p.condicao, c.tipo, p.cdparametro, c.legenda from modulo e, modulo_campo c, parametro p 
           where e.cdmodulo=c.cdmodulo and c.cdcampo=p.cdcampo and p.cdconsulta=".$vconsulta ." order by p.cdparametro";               
   $rsparametros = $consultas->rsql($sqlparametros);
  

  $parametro='';
  $i=0;
  $lparametro='';

foreach ($rsparametros as $parametros) {

        $p='p'.$parametros['cdparametro'];
        $par = $_POST[$p];
        if ($par!='') {
        $condicao=$parametros['condicao'];
        $lparametro.=$parametros['legenda'].' '.$condicao.' '.$_POST[$p].'<br>';
        if ($condicao=='igual') {
         $condicao='=';
         } elseif ($condicao=='maior') {
         $condicao='>';
         } elseif ($condicao=='menor') {
         $condicao='<';
         } elseif ($condicao=='maior ou igual') {
         $condicao='>=';
         } elseif ($condicao=='menor ou igual') {
         $condicao='<=';
         } elseif ($condicao=='contenha') {
         $condicao='LIKE';
         } elseif ($condicao=='esteja em') {
         $condicao='IN';
         }  elseif ($condicao=='não esteja em') {
         $condicao='NOT IN';
         }


     if ($parametro!='') {
         if (($condicao=='IN') || ($condicao=='NOT IN')) {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par = str_replace( ',', "','", $par);
                $par="'".$par."'";
            }
                $parametro=$parametro." and ".$parametros['nome']." ".$condicao." ( ".$par." ) ";
         } else {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par="'".$par."'";
              if ( $parametros['tipo']=='data' ) {
              $parametro=$parametro." and ".$parametros['nome']." ".$condicao." ".$par." ";
              }  else { 
              $parametro=$parametro." and upper(".$parametros['nome'].") ".$condicao." upper(".$par.") ";
              }
             } else {
                 $parametro=$parametro." and ".$parametros['nome']." ".$condicao." ".$par." ";
            }
         }
     } else {
         if (($condicao=='IN') || ($condicao=='NOT IN')) {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par = str_replace( ',', "','", $par);
                $par="'".$par."'";
            }
                $parametro=$parametro." WHERE ".$parametros['nome']." ".$condicao." ( ".$par." ) ";
         } else {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par="'".$par."'";
              if ( $parametros['tipo']=='data' ) {
                $parametro=$parametro." WHERE ".$parametros['nome']." ".$condicao." ".$par." ";
              } else {
                $parametro=$parametro." WHERE upper(".$parametros['nome'].") ".$condicao." upper(".$par.") ";
              }
             
           } else {
                 $parametro=$parametro." WHERE ".$parametros['nome']." ".$condicao." ".$par." ";
          }
         }
     }
    
    }
     $i++;

  }

  if ($parametro=='') {
    if ($relacionamento!='') {
    $relacionamento=' WHERE '.$relacionamento;
    }
  } else {
    if ($relacionamento!='') {
  $relacionamento=' and '.$relacionamento;
}}

  $sqlrel=$saida.$tabela.$parametro.' '.$relacionamento;

  if ($agrupar==1) {
   $sqlrel=$sqlrel.$grupo;
  }

   $sqlrel=$sqlrel.$ordem;


  $rscon = $projetos->rsql($sqlrel);



$tabelav= '<table id="example1" class="table table-bordered table-striped mg-t datatable">
            <thead>
            <tr>'.$tab.'
            </tr>
            </thead>
            <tbody>
            ';

$dadosgrafico='[';
  foreach ($rscon as $con ) {

 $tabelav.= ' <tr>';
  $saidas = $consultas->rsql($sqlsaida);

  foreach ($saidas as $saida ) {
      if ($saida['visualiza']=='1') {
        $tabelav.= '     <td>'.$con[$saida['cdsaida']].'</td>';
      }

  if ($detalhes_consultas[0]['grafico']=='1') {      

      if ($saida['rotulo']=='1') {
           if ($dadosgrafico!='[') {$dadosgrafico.=',';}; 
           $dadosgrafico.='{
                              label: "'.$con[$saida['cdsaida']].'",';
      }

      if ($saida['totaliza']=='1') {
           $dadosgrafico.='   data: '.$con[$saida['cdsaida']].',
                              color: "'.$this->cor().'"
                            }';
      }
    }
  
  if ($detalhes_consultas[0]['grafico']=='2') {      
       if ($saida['rotulo']=='1') {
           if ($dadosgrafico!='[') {$dadosgrafico.=',';}; 
           $dadosgrafico.='[
                              "'.$con[$saida['cdsaida']].'",';
      }

      if ($saida['totaliza']=='1') {
           $dadosgrafico.='   '.$con[$saida['cdsaida']].'
                            ]';
      }
    }    

  if ($detalhes_consultas[0]['grafico']=='3') {      
       if ($saida['totaliza']=='1') {

           if ( ($dadosgrafico!='[') and ($i3==0) ) {$dadosgrafico.=',';}; 
 
            if ($i3==0) {
              $dadosgrafico.='[
                                "'.$con[$saida['totaliza']].'",';
              $i3=1;
            } else {
              $dadosgrafico.='   '.$con[$saida['cdsaida']].'
                            ]';
              $i3=0;
            }
      }

    }    




  }
$tabelav.= ' </tr>';
}
$tabelav.=' </table>';
$dadosgrafico.=']';

if ($lparametro!='') {
$_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
$_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong><br>'.$lparametro;
}

$visualizacao = explode(',', $detalhes_consultas[0]['visualizacao']);
if (in_array('2', $visualizacao)) {
$datas['pagina']=$tabelav;
}

$datas['consultas']=$detalhes_consultas;
$vgrafico = '';


  if ($detalhes_consultas[0]['grafico']=='1') {

     $vgrafico = '
                                    <div class="col-sm-12">

                                        <div class="flot-pie chart mt25"></div>

                                    </div>
                                    ';
  }

  if ($detalhes_consultas[0]['grafico']=='2') {

     $vgrafico .= '

                                    <div class="panel-body">
                                        <div class="category chart"></div>
                                    </div>
                                    ';
  }

    if ($detalhes_consultas[0]['grafico']=='3') {

     $vgrafico .= '

                                      <div class="col-sm-12 mb25">


                                        <div id="line-chart" class="chart"></div>

                                    </div>
                                    ';


  }

  if ($detalhes_consultas[0]['grafico']=='6') {

     $vgrafico .= '

                                      <div class="col-sm-12 mb25">
                                          <div class="piechart">
                                                <span class="total" data-percent="50">
                                                <span>
                                                    <div class="percent"></div>
                                                    <small>Daily Visits</small>
                                                </span>
                                                </span>
                                            </div>

                                        </div>


                                    ';


  }




  $rodape = '
    </section>

    </div>
    </div>
    </div>
    </div>
    </section>
    </div>

    <script src="/'.PROJETO.'/inc/plugins/jquery-1.11.1.min.js"></script>
    <script src="/'.PROJETO.'/inc/bootstrap/js/bootstrap.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.slimscroll.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.easing.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/appear/jquery.appear.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.placeholder.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/fastclick.js"></script>
    <script src="/'.PROJETO.'/inc/js/offscreen.js"></script>
    <script src="/'.PROJETO.'/inc/js/main.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/chosen/chosen.jquery.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/'.PROJETO.'/inc/js/bootstrap-datatables.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.sortable.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.nestable.js"></script>
    <script src="/'.PROJETO.'/inc/js/table-edit.js"></script>
    <script src="/'.PROJETO.'/inc/js/script_dm.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/icheck/icheck.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/parsley.min.js"></script>

    <script src="/'.PROJETO.'/inc/plugins/jquery.maskedinput.min.js"></script>
    <script src="/'.PROJETO.'/inc/js/form-masks.js"></script>
    <script src="/'.PROJETO.'/inc/js/general.js"></script>



    <script src="/'.PROJETO.'/inc/plugins/isotope/isotope.pkgd.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/imagesloaded/imagesloaded.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/superbox/superbox.min.js"></script>

    <script src="/'.PROJETO.'/inc/js/gallery.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/dropzone/dropzone.js"></script>

 <!-- page level scripts -->
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.categories.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.stack.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.time.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.orderBars.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/flot/jquery.flot.pie.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.sparkline.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/jquery.easing.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/easy-pie-chart/jquery.easypiechart.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/raphael.min.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/morris/morris.js"></script>
    <script src="/'.PROJETO.'/inc/plugins/chartjs/Chart.min.js"></script>

    <!-- page script -->
    <script>
var charts = function () {

    var data = [],
        totalPoints = 300,
        updateInterval = 30,
        plot,
        previousPoint = null;';

  if ($detalhes_consultas[0]['grafico']=='1') {
      $rodape.= ' var browserData = '.$dadosgrafico.';';
    } 

  if ($detalhes_consultas[0]['grafico']=='2') {
    
    $rodape.= ' var categoryData = '.$dadosgrafico.';';
  }


  if ($detalhes_consultas[0]['grafico']=='3') {
      $rodape.= ' var visits = '.$dadosgrafico.';';
    } else { $rodape.= ' var visits = [ ]'; }

$rodape.='

    var visitors = [
           
            ];

    var plotdata = [{
        data: visits,
        color: \'#1F9FD4\'
            }, {
        data: visitors,
        color: \'#28d8b3\'
            }];

    var barData = [
        {
            data: [[1391761856000, 8], [1394181056000, 4], [1396859456000, 2], [1399451456000, 2], [1402129856000, 5]],
            bars: {
                show: true,
                barWidth: 7 * 24 * 60 * 60 * 1000,
                fill: true,
                lineWidth: 0,
                order: 1,
                fillColor: "#FF604F"
            },
            color: "#FF604F"
        },
        {
            data: [[1391761856000, 5], [1394181056000, 3], [1396859456000, 1], [1399451456000, 7], [1402129856000, 3]],
            bars: {
                show: true,
                barWidth: 7 * 24 * 60 * 60 * 1000,
                fill: true,
                lineWidth: 0,
                order: 2,
                fillColor: "#FFB244"
            },
            color: "#FFB244"
        },
        {
            data: [[1391761856000, 3], [1394181056000, 6], [1396859456000, 4], [1399451456000, 4], [1402129856000, 4]],
            bars: {
                show: true,
                barWidth: 7 * 24 * 60 * 60 * 1000,
                fill: true,
                lineWidth: 0,
                order: 3,
                fillColor: "#28d8b3"
            },
            color: "#28d8b3"
        }
    ];

    var sparkData = {
        one: [8, 4, 3, 8, 7, 1, 6, 1, 3],
        two: [5, 5, 7, 1, 3, 5, 1, 7, 6, 3, 8, 7, 8, 1, 7, 8, 2, 6, 9, 5, 2, 9, 7, 5, 5, 9],
        three: [4, 6, 7, 1, 4, 5, 7, 9, 6, 5, 3, 7, 1, 2, 8, 7, 3, 8, 9, 2, 1, 7, 4, 9, 1, 7],
        pie: [35, 15, 50]
    };

    var chartData = [
        {
            value: Math.random(),
            color: "#D97041"
      },
        {
            value: Math.random(),
            color: "#C7604C"
      },
        {
            value: Math.random(),
            color: "#21323D"
      },
        {
            value: Math.random(),
            color: "#9D9B7F"
      },
        {
            value: Math.random(),
            color: "#7D4F6D"
      },
        {
            value: Math.random(),
            color: "#584A5E"
      }
    ];

    var tax_data = [{
        "period": "2011 Q3",
        "licensed": 3407,
        "sorned": 660
            }, {
        "period": "2011 Q2",
        "licensed": 3351,
        "sorned": 629
            }, {
        "period": "2011 Q1",
        "licensed": 3269,
        "sorned": 618
            }, {
        "period": "2010 Q4",
        "licensed": 3246,
        "sorned": 661
            }, {
        "period": "2009 Q4",
        "licensed": 3171,
        "sorned": 676
            }, {
        "period": "2008 Q4",
        "licensed": 3155,
        "sorned": 681
            }, {
        "period": "2007 Q4",
        "licensed": 3226,
        "sorned": 620
            }, {
        "period": "2006 Q4",
        "licensed": 3245,
        "sorned": null
            }, {
        "period": "2005 Q4",
        "licensed": 3289,
        "sorned": null
            }];

    function events() {
        $(\'#line-chart, .realtime\').bind(\'plothover\', function (event, pos, item) {
            if (item) {
                if (previousPoint !== item.dataIndex) {
                    previousPoint = item.dataIndex;
                    $(\'#tooltip\').remove();
                    var x = item.datapoint[0],
                        y = item.datapoint[1];
                    showTooltip(item.pageX, item.pageY, y + \' at \' + x);
                }
            } else {
                $(\'#tooltip\').remove();
                previousPoint = null;
            }
        });
    }

    function getRandomData() {

        if (data.length > 0) {
            data = data.slice(1);
        }

        // Do a random walk

        while (data.length < totalPoints) {

            var prev = data.length > 0 ? data[data.length - 1] : 50,
                y = prev + Math.random() * 10 - 5;

            if (y < 0) {
                y = 0;
            } else if (y > 20) {
                y = 20;
            }

            data.push(y);
        }

        // Zip the generated y values with the x values

        var res = [];
        for (var i = 0; i < data.length; ++i) {
            res.push([i, data[i]]);
        }

        return res;
    }

    function update() {

        plot.setData([getRandomData()]);


        plot.draw();
        setTimeout(update, updateInterval);
    }

    function showTooltip(x, y, contents) {
        $(\'<div id="tooltip">\' + contents + \'</div>\').css({
            top: y - 10,
            left: x + 20
        }).appendTo(\'body\').fadeIn(200);
    }

    function initFlot() {';
  if ($detalhes_consultas[0]['grafico']=='1') {
$rodape.='$.plot($(".flot-pie"), browserData, {
            series: {
                pie: {
                    show: true
                }
            },
            legend: {
                show: false
            },
            grid: {
                hoverable: true
            },
            stroke: {
                width: 0
            }
        });
';
}        
  if ($detalhes_consultas[0]['grafico']=='2') {
  $rodape.='
        $.plot(".category", [categoryData], {
            colors: [\'#24ACE5\'],
            series: {
                bars: {
                    show: true,
                    barWidth: 0.5,
                    align: \'center\',
                    fill: 1,
                },
                shadowSize: 0
            },
            grid: {
                color: \'#c2c2c2\',
                borderColor: \'#f0f0f0\',
                borderWidth: 1
            },
            xaxis: {
                mode: "categories",
                tickLength: 0
            }
        });
';
}
$rodape.='
        $.plot($(\'#line-chart\'), plotdata, {
            series: {
                points: {
                    show: true,
                    radius: 3
                },
                lines: {
                    show: true,
                    lineWidth: 1,
                },
                shadowSize: 0
            },
            grid: {
                color: \'#c2c2c2\',
                borderColor: \'#f0f0f0\',
                borderWidth: 0,
                hoverable: true
            }
        });
    }

    function initSparkchart() {
        $(\'.sparkline-ext\').sparkline(sparkData.three, {
            type: \'line\',
            width: \'100%\',
            height: \'40\',
            lineWidth: 1,
            lineColor: \'#ddd\',
            spotColor: \'#f1f4f9\',
            fillColor: \'\',
            spotRadius: \'2\',
        });

        $(\'.sparkline-ext\').sparkline(sparkData.two, {
            composite: true,
            type: \'line\',
            width: \'100%\',
            lineWidth: 1,
            lineColor: \'#ddd\',
            spotColor: \'#f1f4f9\',
            fillColor: \'\',
            spotRadius: \'2\',

        });

        $(\'.sparkpie\').sparkline(sparkData.pie, {
            type: \'pie\',
            height: \'60\',
            sliceColors: [\'#FF604F\', \'#FFB244\', \'#28d8b3\']
        });


        $(\'.sparkline-line-bm\').sparkline(sparkData.two, {
            type: \'line\',
            width: \'100%\',
            height: \'40\',
            lineWidth: 0.5,
            lineColor: \'#ccc\',
            spotColor: \'#ECF0F8\',
            fillColor: \'\',
            spotRadius: \'2\',
        });

        $(\'.sparkline-bar-bm\').sparkline(sparkData.two, {
            type: \'bar\',
            width: \'100%\',
            height: \'40\',
            barWidth: 5,
            barSpacing: 4,
            barColor: \'#2ecc71\'
        });
    }

    function initEastPie() {
        $(\'.bounce\').easyPieChart({
            size: 150,
            lineWidth: 9,
            barColor: \'#17c3e5\',
            trackColor: \'#F3F5F8\',
            lineCap: \'butt\',
            easing: \'easeOutBounce\',
            onStep: function (from, to, percent) {
                $(this.el).find(\'.percent\').text(Math.round(percent));
            }
        });

        $(\'.visits2\').easyPieChart({
            size: 150,
            lineWidth: 20,
            barColor: \'#2dcb73\',
            trackColor: false,
            lineCap: \'round\',
            easing: \'easeOutBounce\',
            onStep: function (from, to, percent) {
                $(this.el).find(\'.percent\').text(Math.round(percent));
            }
        });

        $(\'.total\').easyPieChart({
            size: 150,
            lineWidth: 12,
            barColor: \'#FFB244\',
            trackColor: \'#F3F5F8\',
            lineCap: \'square\',
            easing: \'easeOutBounce\',
            scaleColor: false,
            onStep: function (from, to, percent) {
                $(this.el).find(\'.percent\').text(Math.round(percent));
            }
        });

        $(".piechart").each(function () {
            var canvas = $(this).find("canvas");
            $(this).css({
                "width": canvas.width(),
                "height": canvas.height()
            });
        });
    }

    function initMorris() {
        Morris.Line({
            element: \'hero-graph\',
            data: tax_data,
            xkey: \'period\',
            ykeys: [\'licensed\', \'sorned\'],
            labels: [\'Licensed\', \'Off the road\'],
            lineColors: [\'#20aae5\', \'#bdc3c7\'],
            resize: true,
        });

        Morris.Donut({
            element: \'hero-donut\',
            data: [{
                label: \'Jam\',
                value: 25
                }, {
                label: \'Frosted\',
                value: 40
                }, {
                label: \'Custard\',
                value: 25
                }, {
                label: \'Sugar\',
                value: 10
                }],
            colors: [\'#20aae5\'],
            formatter: function (y) {
                return y + "%";
            }
        });

        Morris.Area({
            element: \'hero-area\',
            data: [{
                period: \'2010 Q1\',
                iphone: 2666,
                ipad: null,
                itouch: 2647
                }, {
                period: \'2010 Q2\',
                iphone: 2778,
                ipad: 2294,
                itouch: 2441
                }, {
                period: \'2010 Q3\',
                iphone: 4912,
                ipad: 1969,
                itouch: 2501
                }, {
                period: \'2010 Q4\',
                iphone: 3767,
                ipad: 3597,
                itouch: 5689
                }, {
                period: \'2011 Q1\',
                iphone: 6810,
                ipad: 1914,
                itouch: 2293
                }],
            xkey: \'period\',
            ykeys: [\'iphone\', \'ipad\', \'itouch\'],
            labels: [\'iPhone\', \'iPad\', \'iPod Touch\'],
            pointSize: 2,
            resize: true,
            hideHover: \'auto\',
            lineColors: [\'#20aae5\', \'#5cb85c\', \'#FF604F\']
        });

        Morris.Bar({
            element: \'hero-bar\',
            data: [{
                device: \'iPhone\',
                geekbench: 136
            }, {
                device: \'iPhone 3G\',
                geekbench: 137
            }, {
                device: \'iPhone 3GS\',
                geekbench: 275
            }, {
                device: \'iPhone 4\',
                geekbench: 380
            }, {
                device: \'iPhone 4S\',
                geekbench: 655
            }, {
                device: \'iPhone 5\',
                geekbench: 1571
            }],
            xkey: \'device\',
            ykeys: [\'geekbench\'],
            labels: [\'Geekbench\'],
            barRatio: 0.4,
            xLabelAngle: 35,
            hideHover: \'auto\',
            resize: true,
            barColors: [\'#20aae5\']
        });
    }

    function initChartJs() {
        var ctx = $("#plot-area").get(0).getContext("2d");

        var myPolarArea = new Chart(ctx).PolarArea(chartData);

        var radarChartData = {
            labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Partying", "Running"],
            datasets: [
                {
                    fillColor: "rgba(220,220,220,0.5)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    data: [65, 59, 90, 81, 56, 55, 40]
        },
                {
                    fillColor: "rgba(151,187,205,0.5)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    data: [28, 48, 40, 19, 96, 27, 100]
        }
      ]
        };

        var ptx = $("#radar").get(0).getContext("2d");

        var myRadar = new Chart(ptx).Radar(radarChartData, {
            scaleShowLabels: false,
            pointLabelFontSize: 10
        });
    }

    return {
        init: function () {
            events();
            initFlot();
            initSparkchart();
            initEastPie();
            initMorris();
            initChartJs();
            update();
        }
    };
}();

$(function () {
    "use strict";
    charts.init();
});
    </script>
    <!-- /page script -->

</body>
<!-- /body -->
</html>';


if (in_array('1', $visualizacao)) {
  $datas['graficos']=$vgrafico;
}
    $datas['rodape']=$rodape;
            $this->view('/gconsulta/consultap', $datas);
    }














  function gera_consulta($codconsulta) {
  
  $datas['pagina']='';
 $datas['graficos']='';
 $rodape='';


// aqui 
$id = $codconsulta;

$modulos = new modulosModel();
$moduloscampo = new moduloscamposModel();
$consultas = new consultasModel();
$projetos = new projetosModel();

$detalhes_consultas = $consultas->listaconsultas("cdconsulta=".$id);


$vconsulta = $id;
  
  
    // seleciona as tabelas

  
  $sqltabelas = " select e.entidade as nome, e.cdmodulo from modulo e where cdmodulo in (
           select e.cdmodulo from modulo e, modulo_campo c, saida s
           where e.cdmodulo=c.cdmodulo and c.cdcampo=s.cdcampo and s.cdconsulta=".$vconsulta ."
           union
            select e.cdmodulo from modulo e, modulo_campo c, parametro p 
           where e.cdmodulo=c.cdmodulo and c.cdcampo=p.cdcampo  and p.cdconsulta=".$vconsulta." )"; 

$rstabelas = $consultas->rsql($sqltabelas);
  
    
  $tabela='';
  $relacionamento='';
  $i = 0;
  foreach ($rstabelas as $tabelas ) {
         // adiciona tabelas envolvidas
  if ($i>0) {
        $tabela=$tabela.', '.$tabelas['nome'];
        $lmodulo=$lmodulo.', '.$tabelas['cdmodulo'];
  } else {
        $tabela=' FROM '.$tabelas['nome'];
        $lmodulo=$tabelas['cdmodulo'];
     }
    $i++;
  }



   foreach ($rstabelas as $tabelas ) {
      $refcampos = $moduloscampo->listaModuloscampos('cdmodulo='.$tabelas['cdmodulo'].' and cdmodulo_referencia in ('.$lmodulo.')');

      foreach ($refcampos as $refcampo) {
            if ($relacionamento!='') {$relacionamento.=' and ';}
                $moduloref = $modulos->listaModulos('cdmodulo='.$refcampo['cdmodulo_referencia']);
                $chave = $moduloscampo->pesquisaModuloscampos('cdmodulo='.$refcampo['cdmodulo_referencia'].' and cchave=1');
                $relacionamento.= $tabelas['nome'].'.'.$refcampo['campo'].' = '.$moduloref[0]['entidade'].'.'.$chave[0]['campo'];
      }
   }

  
  
  
  
  
// seleciona as saida 
  
  $sqlsaida = "select e.entidade ||'.'|| c.campo as nome, s.tipo, c.legenda, s.cdsaida, s.chave, s.visualiza, s.rotulo, s.totaliza, e.entidade as tabela, 1 as cod, e.legendaentidade ||'.'|| c.legenda as gdesc from modulo e, modulo_campo c, saida s
           where e.cdmodulo=c.cdmodulo and c.cdcampo=s.cdcampo and s.cdconsulta=".$vconsulta ."  
           union
           select s.questionario ||'.'|| 'informacao' as nome, s.tipo, s.questionario as legenda, s.cdsaida, s.chave, s.visualiza, s.rotulo, s.totaliza, s.questionario as tabela, 2 as cod, s.questionario ||'.'|| 'informacao' as gdesc from saida s
           where  s.cdcampo is null and s.cdconsulta=".$vconsulta ."                        
           order by 4";
           
           

  $rssaidas = $consultas->rsql($sqlsaida);

  //$rc = $rs->RowCount();  
  $saida='';
  $grupo='';
  $ordem='';
  $tab='';
  $agrupar=0;
  $rotulo='';
  $totaliza='';
  $i3=0;
   $i = 0;
  foreach ($rssaidas as $saidas ) {
  
    
if ( $saidas['cod']=='2' ){



      if ($saidas['tabela']{0}=='d') {
      $detalhes_documento = $projetos->rssql("select descricao from documento where cddocumento=".substr($saidas['tabela'],1));
      $saidas['legenda']=$detalhes_documento[0]['descricao'];
      }
      
      if ($saidas['tabela']{0}=='p') {
      $detalhes_pergunta = $projetos->rssql("select descricao from pergunta where cdpergunta=".substr($saidas['tabela'],1));
      $saidas['legenda']=$detalhes_pergunta[0]['descricao'];
      }
      
      
      $pos = strpos($tabela2, $saidas['tabela']);
      if ($pos == false) {      
      if ($tabela2==''){
      $tabela2='vquestionario '.$saidas['tabela'];
      } else {
      $tabela2=$tabela2.', vquestionario '.$saidas['tabela'];
      }
      
      $pos2 = strpos($tabela, 'projeto');
      if ($pos2 == true) {
      if ($relacionamento2==''){
      $relacionamento2=' projeto.cdprojeto = '.$saidas['tabela'].'.cdprojeto '; 
      } else {
      $relacionamento2=$relacionamento2.' and projeto.cdprojeto = '.$saidas['tabela'].'.cdprojeto ';
      }       
      }        
            
      }      
      
      
      $tab3=$saidas['tabela'];
      if ($parametro3=='') {
      $parametro3=$parametro3." ".$saidas['tabela'].".codigo='{$tab3}' ";
      } else {
      $parametro3=$parametro3." and ".$saidas['tabela'].".codigo='{$tab3}' ";
      }
      
      
  
  
  
  }  
  
  
  
  
        $sel=trim($saidas['tipo']);
         if ($sel=='somar') {
         $sel='SUM(';
         $leg='Soma '.$saidas['legenda'];
         } elseif ($sel=='maior valor') {
         $sel='MAX(';
         $leg='Maior Valor '.$saidas['legenda'];
         } elseif ($sel=='menor valor') {
         $sel='MIN(';
         $leg='Menor Valor '.$saidas['legenda'];
         } elseif ($sel=='média') {
         $sel='AVG(';
         $leg='Média '.$saidas['legenda'];
         } elseif ($sel=='quantificar') {
         $sel='COUNT(';
         $leg='Qtde '.$saidas['legenda'];
         } else {
         $sel='(';
         $leg=$saidas['legenda'];
         }
  
  
  if ($saidas['visualiza']=='1') {
   $tab=$tab.'<th>'.$leg.'</th>';
  }
  if ($saidas['rotulo']=='1') {
   $rotulo=$saidas['cdsaida'];
  }
  if ($saidas['totaliza']=='1') {
   $totaliza=$saidas['cdsaida'];
  }

  
  
     if ($i>0) {
        if ($sel!='(') {
        $agrupar=1;
        } else {
         $grupo=$grupo.', '.$saidas['nome'];
         $ordem=$ordem.', '.$saidas['nome']; 
        } 
        $saida=$saida.', '.$sel.$saidas['nome'].') AS '.'"'.$saidas['cdsaida'].'"'; 
     } else {
      if ($sel!='(') {
        $agrupar=1;
        } else {
        $saida=' SELECT '.$saidas['nome'];
        $grupo=' GROUP BY '.$saidas['nome']; 
        $ordem=' ORDER BY '.$saidas['nome'];     
        }
        $saida=' SELECT '.$sel.$saidas['nome'].') AS '.'"'.$saidas['cdsaida'].'"'; 
     }
     
     
  $i++;  
   
           
  } // saidas
  
  

  
  
  
  // seleciona os parametros
  
  $sqlparametros = "select e.entidade ||'.'|| c.campo as nome, p.condicao, c.tipo, p.cdparametro, c.legenda, p.valor from modulo e, modulo_campo c, parametro p 
           where e.cdmodulo=c.cdmodulo and c.cdcampo=p.cdcampo and p.cdconsulta=".$vconsulta ." order by p.cdparametro";               
   $rsparametros = $consultas->rsql($sqlparametros);
   


  $parametro='';
  $i=0;
  $lparametro='';

foreach ($rsparametros as $parametros) {

      $p='p'.$parametros['cdparametro'];
        
       if ($parametros['valor']!='') {
       
           if ($parametros['valor']{0}=='$') {
              $svalor=substr($parametros['valor'], 1);
              $sessao="'{$svalor}'";
              $par = $_SESSION[PROJETO]['{$sessao}'];
           
           } else {
           
            $par = $parametros['valor'];
           
           } 
       
       
       
         
       } else {
        $par = $_POST[$p];
       }
        
        if ($par!='') {
        $condicao=$parametros['condicao'];
        $lparametro.=$parametros['legenda'].' '.$condicao.' '.$par.'<br>';
        if ($condicao=='igual') {
         $condicao='=';
         } elseif ($condicao=='maior') {
         $condicao='>';
         } elseif ($condicao=='menor') {
         $condicao='<';
         } elseif ($condicao=='maior ou igual') {
         $condicao='>=';
         } elseif ($condicao=='menor ou igual') {
         $condicao='<=';
         } elseif ($condicao=='contenha') {
         $condicao='LIKE';
         } elseif ($condicao=='esteja em') {
         $condicao='IN';
         }  elseif ($condicao=='não esteja em') {
         $condicao='NOT IN';
         }


     if ($parametro!='') {
         if (($condicao=='IN') || ($condicao=='NOT IN')) {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par = str_replace( ',', "','", $par);
                $par="'".$par."'";
            }
                $parametro=$parametro." and ".$parametros['nome']." ".$condicao." ( ".$par." ) ";
         } else {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par="'".$par."'";
              if ( $parametros['tipo']=='data' ) {
              $parametro=$parametro." and ".$parametros['nome']." ".$condicao." ".$par." ";
              }  else { 
              $parametro=$parametro." and upper(".$parametros['nome'].") ".$condicao." upper(".$par.") ";
              }
             } else {
                 $parametro=$parametro." and ".$parametros['nome']." ".$condicao." ".$par." ";
            }
         }
     } else {
         if (($condicao=='IN') || ($condicao=='NOT IN')) {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par = str_replace( ',', "','", $par);
                $par="'".$par."'";
            }
                $parametro=$parametro." WHERE ".$parametros['nome']." ".$condicao." ( ".$par." ) ";
         } else {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par="'".$par."'";
              if ( $parametros['tipo']=='data' ) {
                $parametro=$parametro." WHERE ".$parametros['nome']." ".$condicao." ".$par." ";
              } else {
                $parametro=$parametro." WHERE upper(".$parametros['nome'].") ".$condicao." upper(".$par.") ";
              }
             
           } else {
                 $parametro=$parametro." WHERE ".$parametros['nome']." ".$condicao." ".$par." ";
          }
         }
     }
    
    }
     $i++;

  }
  
  


    $sqlparametro2 = "select questionario, condicao from parametro where cdcampo is null and cdconsulta=".$vconsulta ." order by cdparametro";       
    $rsparametros2 = $consultas->rsql($sqlparametro2);   
  
  

  if ($rsparametros2[0]['questionario']!='') {
    
 
  foreach ($rsparametros2 as $parametros2) {
  

  
  $codigo=$parametros2['questionario'];
  if ($parametros2['questionario']{0}=='p') {$v='r';} else {$v=$parametros2['questionario']{0};}  
  $p2=$v.substr($parametros2['questionario'],1);               
  $par2 = $_POST[$p2];
  
          if ($par2!='') {
        $condicao=$parametros2['condicao'];
        //$lparametro.=$parametros2['legenda'].' '.$condicao.' '.$par2.'<br>';
        if ($condicao=='igual') {
         $condicao='=';
         } elseif ($condicao=='maior') {
         $condicao='>';
         } elseif ($condicao=='menor') {
         $condicao='<';
         } elseif ($condicao=='maior ou igual') {
         $condicao='>=';
         } elseif ($condicao=='menor ou igual') {
         $condicao='<=';
         } elseif ($condicao=='contenha') {
         $condicao='LIKE';
         } elseif ($condicao=='esteja em') {
         $condicao='IN';
         }  elseif ($condicao=='não esteja em') {
         $condicao='NOT IN';
         }  
         
         
      $par2="'".$par2."'";
      if ($parametro2=='') {
      $parametro2=$parametro2." ( ".$parametros2[questionario].".codigo='{$codigo}' and upper(".$parametros2[questionario].".informacao) ".$condicao." upper(".$par2.") )";
      } else {
      $parametro2=$parametro2." or ( ".$parametros2[questionario].".codigo='{$codigo}' and upper(".$parametros2[questionario].".informacao) ".$condicao." upper(".$par2.") )";
      }
      
      
      $pos = strpos($tabela2, $parametros2[questionario]);
      if ($pos == false) {      
      if ($tabela2==''){
      $tabela2='vquestionario '.$parametros2[questionario];
      } else {
      $tabela2=$tabela2.', vquestionario '.$parametros2[questionario];
      }
      
      $pos = strpos($tabela, 'projeto');
      if ($pos == true) {
      if ($relacionamento2==''){
      $relacionamento2=' projeto.cdprojeto = '.$parametros2[questionario].'.cdprojeto '; 
      } else {
      $relacionamento2=$relacionamento2.' and projeto.cdprojeto = '.$parametros2[questionario].'.cdprojeto ';
      }       
      }        
            
      }
      

       
        
  }
  }


  
   if ($parametro2!='') {
   
      $parametro2=" ( ".$parametro2." ) ";
      if ($parametro=='') {
        $parametro=' WHERE '.$parametro2;
      } else { 
      $parametro=$parametro.' and '.$parametro2; 
      }
      
 
        
           
  }
  
  
}


  
   
     if ($parametro3!='') {
      if  ($parametro=='') {
        $parametro=' WHERE '.$parametro3;
      } else { 
      $parametro=$parametro.' and '.$parametro3; 
      }
      }  

    if ($relacionamento=='') {
         $relacionamento=$relacionamento2;
       } elseif ($relacionamento2!='') { $relacionamento=$relacionamento.' and '.$relacionamento2; }
 
      
  if ($tabela=='') { $tabela=' FROM '.$tabela2; } elseif ($tabela2!='') { $tabela=$tabela.', '.$tabela2; }
 

  if ($parametro=='') {     
    if ($relacionamento!='') {
    $relacionamento=' WHERE '.$relacionamento;
    }
  } else {
    if ($relacionamento!='') {
  $relacionamento=' and '.$relacionamento;
}}





  $sqlrel=$saida.$tabela.$parametro.' '.$relacionamento;

  if ($agrupar==1) {
   $sqlrel=$sqlrel.$grupo;
  }

   $sqlrel=$sqlrel.$ordem;
 
    //die($sqlrel);
  $rscon = $projetos->rsql($sqlrel);
  
  if ($rscon) {

  $titulo=' 
               <h5><b>'.$detalhes_consultas[0]['titulo'].'</b></h5>
           ';



$tabelav= '<table id="example1" class="table table-striped no-m">
            <thead>
            <tr>'.$tab.'
            </tr>
            </thead>
            <tbody>
            ';

$dadosgrafico1='[';
$dadosgrafico2='{ labels : [';
$dadosgrafico21=', datasets : [ {	fillColor : "rgba(151,187,205,0.5)", strokeColor : "rgba(151,187,205,0.8)", highlightFill : "rgba(151,187,205,0.75)", highlightStroke : "rgba(151,187,205,1)", data : [';
$dadosgrafico3='{ labels : [';
$dadosgrafico31=', datasets : [ {	fillColor : "rgba(151,187,205,0.5)", strokeColor : "rgba(151,187,205,0.8)", highlightFill : "rgba(151,187,205,0.75)", highlightStroke : "rgba(151,187,205,1)", data : [';
$dadosgrafico4='[';
$dadosgrafico6='[';
$i=0;
$dados5='';
  foreach ($rscon as $con ) {

 $tabelav.= ' <tr>';
  $saidas = $consultas->rsql($sqlsaida);

  foreach ($saidas as $saida ) {
      if ($saida['visualiza']=='1') {
        $tabelav.= '     <td>'.$con[$saida['cdsaida']].'</td>';
      }

 if ($detalhes_consultas[0]['grafico']=='1') {

      if ($saida['rotulo']=='1') {
           if ($dadosgrafico1!='[') {$dadosgrafico1.=',';};
           $dadosgrafico1.='{
                              label: "'.$con[$saida['cdsaida']].'",';
      }

      if ($saida['totaliza']=='1') {
           $cor=$this->cor();
           $dadosgrafico1.='   value: '.$con[$saida['cdsaida']].',
                              color: "'.$cor.'",
                              highlight: "'.$cor.'"
                            }';
      }
      
   }
  
  if ($detalhes_consultas[0]['grafico']=='2') {      
       if ($saida['rotulo']=='1') {
           if ($dadosgrafico2!='{ labels : [') {$dadosgrafico2.=',';}; 
           $dadosgrafico2.='"'.$con[$saida['cdsaida']].'"';
      }

      if ($saida['totaliza']=='1') {
       if ($dadosgrafico21!=', datasets : [ {	fillColor : "rgba(151,187,205,0.5)", strokeColor : "rgba(151,187,205,0.8)", highlightFill : "rgba(151,187,205,0.75)", highlightStroke : "rgba(151,187,205,1)", data : [') {$dadosgrafico21.=',';}; 
           $dadosgrafico21.=$con[$saida['cdsaida']];
      }
    }    
    
    		

  if ($detalhes_consultas[0]['grafico']=='3') {      
       if ($saida['rotulo']=='1') {
           if ($dadosgrafico3!='{ labels : [') {$dadosgrafico3.=',';}; 
           $dadosgrafico3.='"'.$con[$saida['cdsaida']].'"';
      }

      if ($saida['totaliza']=='1') {
       if ($dadosgrafico31!=', datasets : [ {	fillColor : "rgba(151,187,205,0.5)", strokeColor : "rgba(151,187,205,0.8)", highlightFill : "rgba(151,187,205,0.75)", highlightStroke : "rgba(151,187,205,1)", data : [') {$dadosgrafico31.=',';}; 
           $dadosgrafico31.=$con[$saida['cdsaida']];
      }
    }

  if ($detalhes_consultas[0]['grafico']=='4') {      
       if ($saida['totaliza']=='1') {

           if ( ($dadosgrafico4!='[') and ($i3==0) ) {$dadosgrafico4.=',';}; 
 
            if ($i3==0) {
              $dadosgrafico4.='[
                                "'.$con[$saida['cdsaida']].'",';
              $i3=1;
            } else {
              $dadosgrafico4.='   '.$con[$saida['cdsaida']].'
                            ]';
              $i3=0;
            }
      }

    }

  if ($detalhes_consultas[0]['grafico']=='5') {

       if ($saida['rotulo']=='1') {
           $dados5[$i]['legenda'] = $con[$saida['cdsaida']];
      }

      if ($saida['totaliza']=='1') {
        $dados5[$i]['valor'] = $con[$saida['cdsaida']];
      }
    }
    
    
    
    
 if ($detalhes_consultas[0]['grafico']=='6') {

      if ($saida['rotulo']=='1') {
           if ($dadosgrafico6!='[') {$dadosgrafico6.=',';};
           $dadosgrafico6.='{
                              label: "'.$con[$saida['cdsaida']].'",';
      }

      if ($saida['totaliza']=='1') {
           $cor=$this->cor();
           $dadosgrafico6.='   value: '.$con[$saida['cdsaida']].',
                              color: "'.$cor.'",
                              highlight: "'.$cor.'"
                            }';
      }
    }    




  }
$tabelav.= ' </tr>';
$i++;
}
$tabelav.=' </table>';
$dadosgrafico1.=']';
$dadosgrafico2.=']'.$dadosgrafico21.'] }	]	}';
$dadosgrafico3.=']'.$dadosgrafico31.'] }	]	}';
$dadosgrafico4.=']';
$dadosgrafico6.=']';
}

//$_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
//$_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong><br>'.$lparametro;
$visualizacao = explode(',', $detalhes_consultas[0]['visualizacao']);
if (in_array('2', $visualizacao)) {
$datas['pagina']=$tabelav;
}

$datas['consultas']=$detalhes_consultas;
$vgrafico = '';


  if ($detalhes_consultas[0]['grafico']=='1') {

     $vgrafico = '
            <div id="canvas-holder" align="center">
			         <canvas id="pizza'.$codconsulta.'" width="300" height="300"/>
		        </div>
            ';
  
     $_SESSION[PROJETO]['grafico'].='     
        var pieData'.$codconsulta.' = '.$dadosgrafico1.';
				var ctx'.$codconsulta.' = document.getElementById("pizza'.$codconsulta.'").getContext("2d");
				window.myPie = new Chart(ctx'.$codconsulta.').Pie(pieData'.$codconsulta.');';     
  }

  if ($detalhes_consultas[0]['grafico']=='2') {

     $vgrafico .= '     
     <div style="width: 95%">
			<canvas id="barra'.$codconsulta.'" style="width: 800px; height: 350px;"></canvas>
		</div>';

  $_SESSION[PROJETO]['grafico'].='   
  	var barChartData'.$codconsulta.' = '.$dadosgrafico2.' 
		var ctx'.$codconsulta.' = document.getElementById("barra'.$codconsulta.'").getContext("2d");
		window.myBar = new Chart(ctx'.$codconsulta.').Bar(barChartData'.$codconsulta.', {
			responsive : true
		});';      
  }

  if ($detalhes_consultas[0]['grafico']=='3') {

     $vgrafico .= '
     
     <div style="width: 95%">
			<canvas id="linha'.$codconsulta.'" style="width: 800px; height: 350px;"></canvas>
		</div>';

  $_SESSION[PROJETO]['grafico'].='   
  	var lineChartData'.$codconsulta.' = '.$dadosgrafico3.' 
		var ctx'.$codconsulta.' = document.getElementById("linha'.$codconsulta.'").getContext("2d");
		window.myLine  = new Chart(ctx'.$codconsulta.').Line(lineChartData'.$codconsulta.', {
			responsive : true
		});';      
  }

    if ($detalhes_consultas[0]['grafico']=='4') {

     $vgrafico .= '


                                <section class="panel">
                                    <header class="panel-heading no-b">
                                        <h5>Quarterly Apple iOS device unit sales</h5>
                                    </header>
                                    <div class="panel-body">
                                        <div id="hero-area'.$codconsulta.'" class="chart"></div>
                                    </div>
                                </section>
                                    ';


  }


    if ($detalhes_consultas[0]['grafico']=='5') {
foreach ($dados5 as $d5) {
     $vgrafico .= '<div class="col-md-4 widget"> 
<div class="col-md-12" style="border:1px solid #f9f7f7; border-left: 5px solid '.$this->cor().'; border-radius: 3px; background:#fff;"><h3>'.$d5['valor'].'</h3><span>'.$d5['legenda'].'</span></div>
</div>
';


}

  }

  

  if ($detalhes_consultas[0]['grafico']=='6') {

     $vgrafico = '
		<style>
			body{
				padding: 0;
				margin: 0;
			}
			#canvas-holder{
				width:30%;
			}
		</style>     
            <div id="canvas-holder" align="center">
			         <canvas id="pizzafacil'.$codconsulta.'" width="300" height="300"/>
		        </div>
            ';
  
     $_SESSION[PROJETO]['grafico'].='     
        var doughnutData'.$codconsulta.' = '.$dadosgrafico6.';
				var ctx'.$codconsulta.' = document.getElementById("pizzafacil'.$codconsulta.'").getContext("2d");
				window.myDoughnut = new Chart(ctx'.$codconsulta.').Doughnut(doughnutData'.$codconsulta.');';     
  }

            
  


if (in_array('1', $visualizacao)) {
  $datas['graficos']=$vgrafico;
}


  $infconsulta= $titulo.$datas['pagina']. $datas['graficos'];


   return $infconsulta; 
   //fim aqui

  }
  
  
  
  
  
  
  
  
  
  
  function gera_consulta_publica($codconsulta) {
  
  $datas['pagina']='';
 $datas['graficos']='';
 $rodape='';


// aqui 
$id = $codconsulta;

$modulos = new modulosModel();
$moduloscampo = new moduloscamposModel();
$consultas = new consultasModel();

$projetos = new projetosmapaModel();

$detalhes_consultas = $consultas->listaconsultas("cdconsulta=".$id);


$vconsulta = $id;
  
  
    // seleciona as tabelas

  
  $sqltabelas = " select e.entidade as nome, e.cdmodulo from modulo e where cdmodulo in (
           select e.cdmodulo from modulo e, modulo_campo c, saida s
           where e.cdmodulo=c.cdmodulo and c.cdcampo=s.cdcampo and s.cdconsulta=".$vconsulta ."
           union
            select e.cdmodulo from modulo e, modulo_campo c, parametro p 
           where e.cdmodulo=c.cdmodulo and c.cdcampo=p.cdcampo  and p.cdconsulta=".$vconsulta." )"; 

$rstabelas = $consultas->rsql($sqltabelas);
  
    
  $tabela='';
  $relacionamento='';
  $i = 0;
  foreach ($rstabelas as $tabelas ) {
         // adiciona tabelas envolvidas
  if ($i>0) {
        $tabela=$tabela.', '.$tabelas['nome'];
        $lmodulo=$lmodulo.', '.$tabelas['cdmodulo'];
  } else {
        $tabela=' FROM '.$tabelas['nome'];
        $lmodulo=$tabelas['cdmodulo'];
     }
    $i++;
  }



   foreach ($rstabelas as $tabelas ) {
      $refcampos = $moduloscampo->listaModuloscampos('cdmodulo='.$tabelas['cdmodulo'].' and cdmodulo_referencia in ('.$lmodulo.')');

      foreach ($refcampos as $refcampo) {
            if ($relacionamento!='') {$relacionamento.=' and ';}
                $moduloref = $modulos->listaModulos('cdmodulo='.$refcampo['cdmodulo_referencia']);
                $chave = $moduloscampo->pesquisaModuloscampos('cdmodulo='.$refcampo['cdmodulo_referencia'].' and cchave=1');
                $relacionamento.= $tabelas['nome'].'.'.$refcampo['campo'].' = '.$moduloref[0]['entidade'].'.'.$chave[0]['campo'];
      }
   }

  
  
  
  
  
// seleciona as saida 
  
  $sqlsaida = "select e.entidade ||'.'|| c.campo as nome, s.tipo, c.legenda, s.cdsaida, s.chave, s.visualiza, s.rotulo, s.totaliza, e.entidade as tabela, 1 as cod, e.legendaentidade ||'.'|| c.legenda as gdesc from modulo e, modulo_campo c, saida s
           where e.cdmodulo=c.cdmodulo and c.cdcampo=s.cdcampo and s.cdconsulta=".$vconsulta ."  
           union
           select s.questionario ||'.'|| 'informacao' as nome, s.tipo, s.questionario as legenda, s.cdsaida, s.chave, s.visualiza, s.rotulo, s.totaliza, s.questionario as tabela, 2 as cod, s.questionario ||'.'|| 'informacao' as gdesc from saida s
           where  s.cdcampo is null and s.cdconsulta=".$vconsulta ."                        
           order by 4";
           
           

  $rssaidas = $consultas->rsql($sqlsaida);

  //$rc = $rs->RowCount();  
  $saida='';
  $grupo='';
  $ordem='';
  $tab='';
  $agrupar=0;
  $rotulo='';
  $totaliza='';
  $i3=0;
   $i = 0;
  foreach ($rssaidas as $saidas ) {
  
    
if ( $saidas['cod']=='2' ){



      if ($saidas['tabela']{0}=='d') {
      $detalhes_documento = $projetos->rssql("select descricao from documento where cddocumento=".substr($saidas['tabela'],1));
      $saidas['legenda']=$detalhes_documento[0]['descricao'];
      }
      
      if ($saidas['tabela']{0}=='p') {
      $detalhes_pergunta = $projetos->rssql("select descricao from pergunta where cdpergunta=".substr($saidas['tabela'],1));
      $saidas['legenda']=$detalhes_pergunta[0]['descricao'];
      }
      
      
      $pos = strpos($tabela2, $saidas['tabela']);
      if ($pos == false) {      
      if ($tabela2==''){
      $tabela2='vquestionario '.$saidas['tabela'];
      } else {
      $tabela2=$tabela2.', vquestionario '.$saidas['tabela'];
      }
      
      $pos2 = strpos($tabela, 'projeto');
      if ($pos2 == true) {
      if ($relacionamento2==''){
      $relacionamento2=' projeto.cdprojeto = '.$saidas['tabela'].'.cdprojeto '; 
      } else {
      $relacionamento2=$relacionamento2.' and projeto.cdprojeto = '.$saidas['tabela'].'.cdprojeto ';
      }       
      }        
            
      }      
      
      
      $tab3=$saidas['tabela'];
      if ($parametro3=='') {
      $parametro3=$parametro3." ".$saidas['tabela'].".codigo='{$tab3}' ";
      } else {
      $parametro3=$parametro3." and ".$saidas['tabela'].".codigo='{$tab3}' ";
      }
      
      
  
  
  
  }  
  
  
  
  
        $sel=trim($saidas['tipo']);
         if ($sel=='somar') {
         $sel='SUM(';
         $leg='Soma '.$saidas['legenda'];
         } elseif ($sel=='maior valor') {
         $sel='MAX(';
         $leg='Maior Valor '.$saidas['legenda'];
         } elseif ($sel=='menor valor') {
         $sel='MIN(';
         $leg='Menor Valor '.$saidas['legenda'];
         } elseif ($sel=='média') {
         $sel='AVG(';
         $leg='Média '.$saidas['legenda'];
         } elseif ($sel=='quantificar') {
         $sel='COUNT(';
         $leg='Qtde '.$saidas['legenda'];
         } else {
         $sel='(';
         $leg=$saidas['legenda'];
         }
  
  
  if ($saidas['visualiza']=='1') {
   $tab=$tab.'<th>'.$leg.'</th>';
  }
  if ($saidas['rotulo']=='1') {
   $rotulo=$saidas['cdsaida'];
  }
  if ($saidas['totaliza']=='1') {
   $totaliza=$saidas['cdsaida'];
  }

  
  
     if ($i>0) {
        if ($sel!='(') {
        $agrupar=1;
        } else {
         $grupo=$grupo.', '.$saidas['nome'];
         $ordem=$ordem.', '.$saidas['nome']; 
        } 
        $saida=$saida.', '.$sel.$saidas['nome'].') AS '.'"'.$saidas['cdsaida'].'"'; 
     } else {
      if ($sel!='(') {
        $agrupar=1;
        } else {
        $saida=' SELECT '.$saidas['nome'];
        $grupo=' GROUP BY '.$saidas['nome']; 
        $ordem=' ORDER BY '.$saidas['nome'];     
        }
        $saida=' SELECT '.$sel.$saidas['nome'].') AS '.'"'.$saidas['cdsaida'].'"'; 
     }
     
     
  $i++;  
   
           
  } // saidas
  
  

  
  
  
  // seleciona os parametros
  
  $sqlparametros = "select e.entidade ||'.'|| c.campo as nome, p.condicao, c.tipo, p.cdparametro, c.legenda, p.valor from modulo e, modulo_campo c, parametro p 
           where e.cdmodulo=c.cdmodulo and c.cdcampo=p.cdcampo and p.cdconsulta=".$vconsulta ." order by p.cdparametro";               
   $rsparametros = $consultas->rsql($sqlparametros);
   


  $parametro='';
  $i=0;
  $lparametro='';

foreach ($rsparametros as $parametros) {

      $p='p'.$parametros['cdparametro'];
        
       if ($parametros['valor']!='') {
       
           if ($parametros['valor']{0}=='$') {
              $svalor=substr($parametros['valor'], 1);
              $sessao="'{$svalor}'";
              $par = $_SESSION[PROJETO]['{$sessao}'];
           
           } else {
           
            $par = $parametros['valor'];
           
           } 
       
       
       
         
       } else {
        $par = $_POST[$p];
       }
        
        if ($par!='') {
        $condicao=$parametros['condicao'];
        $lparametro.=$parametros['legenda'].' '.$condicao.' '.$par.'<br>';
        if ($condicao=='igual') {
         $condicao='=';
         } elseif ($condicao=='maior') {
         $condicao='>';
         } elseif ($condicao=='menor') {
         $condicao='<';
         } elseif ($condicao=='maior ou igual') {
         $condicao='>=';
         } elseif ($condicao=='menor ou igual') {
         $condicao='<=';
         } elseif ($condicao=='contenha') {
         $condicao='LIKE';
         } elseif ($condicao=='esteja em') {
         $condicao='IN';
         }  elseif ($condicao=='não esteja em') {
         $condicao='NOT IN';
         }


     if ($parametro!='') {
         if (($condicao=='IN') || ($condicao=='NOT IN')) {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par = str_replace( ',', "','", $par);
                $par="'".$par."'";
            }
                $parametro=$parametro." and ".$parametros['nome']." ".$condicao." ( ".$par." ) ";
         } else {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par="'".$par."'";
              if ( $parametros['tipo']=='data' ) {
              $parametro=$parametro." and ".$parametros['nome']." ".$condicao." ".$par." ";
              }  else { 
              $parametro=$parametro." and upper(".$parametros['nome'].") ".$condicao." upper(".$par.") ";
              }
             } else {
                 $parametro=$parametro." and ".$parametros['nome']." ".$condicao." ".$par." ";
            }
         }
     } else {
         if (($condicao=='IN') || ($condicao=='NOT IN')) {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par = str_replace( ',', "','", $par);
                $par="'".$par."'";
            }
                $parametro=$parametro." WHERE ".$parametros['nome']." ".$condicao." ( ".$par." ) ";
         } else {
            if (($parametros['tipo']!='inteiro') and ($parametros['tipo']!='numero') and ($parametros['tipo']!='check') and ($parametros['tipo']!='lista') )  {
                $par="'".$par."'";
              if ( $parametros['tipo']=='data' ) {
                $parametro=$parametro." WHERE ".$parametros['nome']." ".$condicao." ".$par." ";
              } else {
                $parametro=$parametro." WHERE upper(".$parametros['nome'].") ".$condicao." upper(".$par.") ";
              }
             
           } else {
                 $parametro=$parametro." WHERE ".$parametros['nome']." ".$condicao." ".$par." ";
          }
         }
     }
    
    }
     $i++;

  }
  
  


    $sqlparametro2 = "select questionario, condicao from parametro where cdcampo is null and cdconsulta=".$vconsulta ." order by cdparametro";       
    $rsparametros2 = $consultas->rsql($sqlparametro2);   
  
  

  if ($rsparametros2[0]['questionario']!='') {
    
 
  foreach ($rsparametros2 as $parametros2) {
  

  
  $codigo=$parametros2['questionario'];
  if ($parametros2['questionario']{0}=='p') {$v='r';} else {$v=$parametros2['questionario']{0};}  
  $p2=$v.substr($parametros2['questionario'],1);               
  $par2 = $_POST[$p2];
  
          if ($par2!='') {
        $condicao=$parametros2['condicao'];
        //$lparametro.=$parametros2['legenda'].' '.$condicao.' '.$par2.'<br>';
        if ($condicao=='igual') {
         $condicao='=';
         } elseif ($condicao=='maior') {
         $condicao='>';
         } elseif ($condicao=='menor') {
         $condicao='<';
         } elseif ($condicao=='maior ou igual') {
         $condicao='>=';
         } elseif ($condicao=='menor ou igual') {
         $condicao='<=';
         } elseif ($condicao=='contenha') {
         $condicao='LIKE';
         } elseif ($condicao=='esteja em') {
         $condicao='IN';
         }  elseif ($condicao=='não esteja em') {
         $condicao='NOT IN';
         }  
         
         
      $par2="'".$par2."'";
      if ($parametro2=='') {
      $parametro2=$parametro2." ( ".$parametros2[questionario].".codigo='{$codigo}' and upper(".$parametros2[questionario].".informacao) ".$condicao." upper(".$par2.") )";
      } else {
      $parametro2=$parametro2." or ( ".$parametros2[questionario].".codigo='{$codigo}' and upper(".$parametros2[questionario].".informacao) ".$condicao." upper(".$par2.") )";
      }
      
      
      $pos = strpos($tabela2, $parametros2[questionario]);
      if ($pos == false) {      
      if ($tabela2==''){
      $tabela2='vquestionario '.$parametros2[questionario];
      } else {
      $tabela2=$tabela2.', vquestionario '.$parametros2[questionario];
      }
      
      $pos = strpos($tabela, 'projeto');
      if ($pos == true) {
      if ($relacionamento2==''){
      $relacionamento2=' projeto.cdprojeto = '.$parametros2[questionario].'.cdprojeto '; 
      } else {
      $relacionamento2=$relacionamento2.' and projeto.cdprojeto = '.$parametros2[questionario].'.cdprojeto ';
      }       
      }        
            
      }
      

       
        
  }
  }


  
   if ($parametro2!='') {
   
      $parametro2=" ( ".$parametro2." ) ";
      if ($parametro=='') {
        $parametro=' WHERE '.$parametro2;
      } else { 
      $parametro=$parametro.' and '.$parametro2; 
      }
      
 
        
           
  }
  
  
}


  
   
     if ($parametro3!='') {
      if  ($parametro=='') {
        $parametro=' WHERE '.$parametro3;
      } else { 
      $parametro=$parametro.' and '.$parametro3; 
      }
      }  

    if ($relacionamento=='') {
         $relacionamento=$relacionamento2;
       } elseif ($relacionamento2!='') { $relacionamento=$relacionamento.' and '.$relacionamento2; }
 
      
  if ($tabela=='') { $tabela=' FROM '.$tabela2; } elseif ($tabela2!='') { $tabela=$tabela.', '.$tabela2; }
 

  if ($parametro=='') {     
    if ($relacionamento!='') {
    $relacionamento=' WHERE '.$relacionamento;
    }
  } else {
    if ($relacionamento!='') {
  $relacionamento=' and '.$relacionamento;
}}





  $sqlrel=$saida.$tabela.$parametro.' '.$relacionamento;

  if ($agrupar==1) {
   $sqlrel=$sqlrel.$grupo;
  }

   $sqlrel=$sqlrel.$ordem;
 
    //die($sqlrel);
  $rscon = $projetos->rsql($sqlrel);
  
  if ($rscon) {

  $titulo=' 
               <h5><b>'.$detalhes_consultas[0]['titulo'].'</b></h5>
           ';



$tabelav= '<table id="example1" class="table table-striped no-m">
            <thead>
            <tr>'.$tab.'
            </tr>
            </thead>
            <tbody>
            ';

$dadosgrafico1='[';
$dadosgrafico2='{ labels : [';
$dadosgrafico21=', datasets : [ {	fillColor : "rgba(151,187,205,0.5)", strokeColor : "rgba(151,187,205,0.8)", highlightFill : "rgba(151,187,205,0.75)", highlightStroke : "rgba(151,187,205,1)", data : [';
$dadosgrafico3='{ labels : [';
$dadosgrafico31=', datasets : [ {	fillColor : "rgba(151,187,205,0.5)", strokeColor : "rgba(151,187,205,0.8)", highlightFill : "rgba(151,187,205,0.75)", highlightStroke : "rgba(151,187,205,1)", data : [';
$dadosgrafico4='[';
$dadosgrafico6='[';
$i=0;
$dados5='';
  foreach ($rscon as $con ) {

 $tabelav.= ' <tr>';
  $saidas = $consultas->rsql($sqlsaida);

  foreach ($saidas as $saida ) {
      if ($saida['visualiza']=='1') {
        $tabelav.= '     <td>'.$con[$saida['cdsaida']].'</td>';
      }

 if ($detalhes_consultas[0]['grafico']=='1') {

      if ($saida['rotulo']=='1') {
           if ($dadosgrafico1!='[') {$dadosgrafico1.=',';};
           $dadosgrafico1.='{
                              label: "'.$con[$saida['cdsaida']].'",';
      }

      if ($saida['totaliza']=='1') {
           $cor=$this->cor();
           $dadosgrafico1.='   value: '.$con[$saida['cdsaida']].',
                              color: "'.$cor.'",
                              highlight: "'.$cor.'"
                            }';
      }
      
   }
  
  if ($detalhes_consultas[0]['grafico']=='2') {      
       if ($saida['rotulo']=='1') {
           if ($dadosgrafico2!='{ labels : [') {$dadosgrafico2.=',';}; 
           $dadosgrafico2.='"'.$con[$saida['cdsaida']].'"';
      }

      if ($saida['totaliza']=='1') {
       if ($dadosgrafico21!=', datasets : [ {	fillColor : "rgba(151,187,205,0.5)", strokeColor : "rgba(151,187,205,0.8)", highlightFill : "rgba(151,187,205,0.75)", highlightStroke : "rgba(151,187,205,1)", data : [') {$dadosgrafico21.=',';}; 
           $dadosgrafico21.=$con[$saida['cdsaida']];
      }
    }    
    
    		

  if ($detalhes_consultas[0]['grafico']=='3') {      
       if ($saida['rotulo']=='1') {
           if ($dadosgrafico3!='{ labels : [') {$dadosgrafico3.=',';}; 
           $dadosgrafico3.='"'.$con[$saida['cdsaida']].'"';
      }

      if ($saida['totaliza']=='1') {
       if ($dadosgrafico31!=', datasets : [ {	fillColor : "rgba(151,187,205,0.5)", strokeColor : "rgba(151,187,205,0.8)", highlightFill : "rgba(151,187,205,0.75)", highlightStroke : "rgba(151,187,205,1)", data : [') {$dadosgrafico31.=',';}; 
           $dadosgrafico31.=$con[$saida['cdsaida']];
      }
    }

  if ($detalhes_consultas[0]['grafico']=='4') {      
       if ($saida['totaliza']=='1') {

           if ( ($dadosgrafico4!='[') and ($i3==0) ) {$dadosgrafico4.=',';}; 
 
            if ($i3==0) {
              $dadosgrafico4.='[
                                "'.$con[$saida['cdsaida']].'",';
              $i3=1;
            } else {
              $dadosgrafico4.='   '.$con[$saida['cdsaida']].'
                            ]';
              $i3=0;
            }
      }

    }

  if ($detalhes_consultas[0]['grafico']=='5') {

       if ($saida['rotulo']=='1') {
           $dados5[$i]['legenda'] = $con[$saida['cdsaida']];
      }

      if ($saida['totaliza']=='1') {
        $dados5[$i]['valor'] = $con[$saida['cdsaida']];
      }
    }
    
    
    
    
 if ($detalhes_consultas[0]['grafico']=='6') {

      if ($saida['rotulo']=='1') {
           if ($dadosgrafico6!='[') {$dadosgrafico6.=',';};
           $dadosgrafico6.='{
                              label: "'.$con[$saida['cdsaida']].'",';
      }

      if ($saida['totaliza']=='1') {
           $cor=$this->cor();
           $dadosgrafico6.='   value: '.$con[$saida['cdsaida']].',
                              color: "'.$cor.'",
                              highlight: "'.$cor.'"
                            }';
      }
    }    




  }
$tabelav.= ' </tr>';
$i++;
}
$tabelav.=' </table>';
$dadosgrafico1.=']';
$dadosgrafico2.=']'.$dadosgrafico21.'] }	]	}';
$dadosgrafico3.=']'.$dadosgrafico31.'] }	]	}';
$dadosgrafico4.=']';
$dadosgrafico6.=']';
}

//$_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
//$_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong><br>'.$lparametro;
$visualizacao = explode(',', $detalhes_consultas[0]['visualizacao']);
if (in_array('2', $visualizacao)) {
$datas['pagina']=$tabelav;
}

$datas['consultas']=$detalhes_consultas;
$vgrafico = '';


  if ($detalhes_consultas[0]['grafico']=='1') {

     $vgrafico = '
            <div id="canvas-holder" align="center">
			         <canvas id="pizza'.$codconsulta.'" width="300" height="300"/>
		        </div>
            ';
  
     $_SESSION[PROJETO]['mgrafico'].='     
        var pieData'.$codconsulta.' = '.$dadosgrafico1.';
				var ctx'.$codconsulta.' = document.getElementById("pizza'.$codconsulta.'").getContext("2d");
				window.myPie = new Chart(ctx'.$codconsulta.').Pie(pieData'.$codconsulta.');';     
  }

  if ($detalhes_consultas[0]['grafico']=='2') {

     $vgrafico .= '     
     <div style="width: 95%">
			<canvas id="barra'.$codconsulta.'" style="width: 800px; height: 350px;"></canvas>
		</div>';

  $_SESSION[PROJETO]['mgrafico'].='   
  	var barChartData'.$codconsulta.' = '.$dadosgrafico2.' 
		var ctx'.$codconsulta.' = document.getElementById("barra'.$codconsulta.'").getContext("2d");
		window.myBar = new Chart(ctx'.$codconsulta.').Bar(barChartData'.$codconsulta.', {
			responsive : true
		});';      
  }

  if ($detalhes_consultas[0]['grafico']=='3') {

     $vgrafico .= '
     
     <div style="width: 95%">
			<canvas id="linha'.$codconsulta.'" style="width: 800px; height: 350px;"></canvas>
		</div>';

  $_SESSION[PROJETO]['mgrafico'].='   
  	var lineChartData'.$codconsulta.' = '.$dadosgrafico3.' 
		var ctx'.$codconsulta.' = document.getElementById("linha'.$codconsulta.'").getContext("2d");
		window.myLine  = new Chart(ctx'.$codconsulta.').Line(lineChartData'.$codconsulta.', {
			responsive : true
		});';      
  }

    if ($detalhes_consultas[0]['grafico']=='4') {

     $vgrafico .= '


                                <section class="panel">
                                    <header class="panel-heading no-b">
                                        <h5>Quarterly Apple iOS device unit sales</h5>
                                    </header>
                                    <div class="panel-body">
                                        <div id="hero-area'.$codconsulta.'" class="chart"></div>
                                    </div>
                                </section>
                                    ';


  }


    if ($detalhes_consultas[0]['grafico']=='5') {
foreach ($dados5 as $d5) {
     $vgrafico .= '<div class="col-md-4 widget"> 
<div class="col-md-12" style="border:1px solid #f9f7f7; border-left: 5px solid '.$this->cor().'; border-radius: 3px; background:#fff;"><h3>'.$d5['valor'].'</h3><span>'.$d5['legenda'].'</span></div>
</div>
';


}

  }

  

  if ($detalhes_consultas[0]['grafico']=='6') {

     $vgrafico = '
		<style>
			body{
				padding: 0;
				margin: 0;
			}
			#canvas-holder{
				width:30%;
			}
		</style>     
            <div id="canvas-holder" align="center">
			         <canvas id="pizzafacil'.$codconsulta.'" width="300" height="300"/>
		        </div>
            ';
  
     $_SESSION[PROJETO]['mgrafico'].='     
        var doughnutData'.$codconsulta.' = '.$dadosgrafico6.';
				var ctx'.$codconsulta.' = document.getElementById("pizzafacil'.$codconsulta.'").getContext("2d");
				window.myDoughnut = new Chart(ctx'.$codconsulta.').Doughnut(doughnutData'.$codconsulta.');';     
  }

            
  


if (in_array('1', $visualizacao)) {
  $datas['graficos']=$vgrafico;
}


  $infconsulta= $titulo.$datas['pagina']. $datas['graficos'];


   return $infconsulta; 
   //fim aqui

  }  





}


    
