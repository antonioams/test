
<?php
include('app/views/topo.php');
$json_projetos = json_encode($view_projetos);
?>
<div class="<?php echo $_SESSION[PROJETO]['mensagem']['tipo'];?>">
                                <?php
                                echo $_SESSION[PROJETO]['mensagem']['texto'];
                                unset( $_SESSION[PROJETO]['mensagem'] );?>
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

      Informações TimeLine (Cronológica)
   </header>




















                        <div class="row">                        
                        <div class="col-md-12">

                            <!-- The time line -->
                            <ul class="timeline">
                                <!-- timeline time label -->
                                <li class="time-label">
                                 <div style="margin-left: 60px; margin-top: 10px;">
                                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Adicionar Marco <i class="fa fa-plus"></i>
</button>
                                 </div>
                                </li>

                    <!-- timeline item -->
                           <?php 
                            foreach($view_teste as $vc){

                                  $icone='';
                                  $style='';
                                  $titulo='';
                                  $foto = $vc['texto'];
                                  $texto = $vc['texto']."<br/>";
                                  if ($vc[0]['nome']!=''){
                                       $texto .= "<b>Usuário:</b> ".$vc[0]['nome'];
                                  }
                                  $acao = '';

                                    switch ($vc['tipo']) {
                                      case 'I':
                                        $acao =' foi adicionado.</h3>';
                                        break;
                                       case 'A':
                                        $acao =' foi alterado.</h3>';
                                        break;
                                        case 'D':
                                        $acao =' foi deletado.</h3>';
                                        break;
                                      default:
                                       $acao ='';
                                        break;
                                    }

                                    switch($vc[tabela]) {
                                        case 'projeto':
                                           $icone= "fa fa-star";
                                           $style = "background: #fff600; color:#fff";
                                           $titulo = '<h3 class="timeline-header no-border"><a href="#">O Projeto</a>';
                                            break;
                                        case 'contrato':
                                           $icone= "fa fa-edit";
                                           $style = "background: #35bd00; color:#fff";
                                           $titulo = '<h3 class="timeline-header no-border"><a href="#">Um contrato</a>';
                                           $texto = $vc['texto'];
                                            break;
                                        case 'contrato_item':
                                           $icone= "fa fa-plus";
                                           $style = "background: #005aff; color:#fff";
                                           $titulo = '<h3 class="timeline-header no-border"><a href="#">Um item</a>';
                                            break;
                                         case 'youtube':
                                           $icone= "fa fa-youtube-play";
                                           $style = "background: #b31217; color:#fff";
                                           $titulo = '<h3 class="timeline-header no-border"><a href="#">Um video</a>';
                                            break;
                                          case 'texto':
                                           $icone= "fa fa-file-text";
                                           $style = "background: #6cbfff; color:#fff";
                                           $titulo = '<h3 class="timeline-header no-border"><a href="#">Um texto</a>';
                                            break;
                                         case 'link':
                                           $texto = '<img src="'.$foto.'" width="280">';
                                           if ($vc[0]['nome']!=''){
                                                 $texto .= "<br/><b>Usuário:</b> ".$vc[0]['nome'];
                                            }
                                           $icone= "fa fa-photo";
                                           $style = "background: #f8b014; color:#fff";
                                           $titulo = '<h3 class="timeline-header no-border"><a href="#">Uma foto de um link</a>';
                                            break;
                                          case 'linka':
                                          // Pegar título de um site com cURL
                                           $site_url = $foto; //URL do site que se quer pegar informações
                                           
                                           $ch = curl_init();
                                           curl_setopt ($ch, CURLOPT_URL, $site_url);
                                           curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
                                          ob_start();
                                           curl_exec($ch); 
                                           curl_close($ch);
                                           $file_contents = ob_get_contents();
                                          ob_end_clean();
                                                 
                                           if (preg_match('/<title>([^<]++)/', $file_contents, $matches) == FALSE)
                                           $erro = "Erro ao resgatar o titulo do site"; // se der algum erro

                                           $texto = "<a href='".$foto."' target='_BLANK'>".htmlentities($matches[1],  ENT_COMPAT,'ISO-8859-1', true)."</a>";
                                           if ($vc[0]['nome']!=''){
                                                 $texto .= "<br/><b>Usuário:</b> ".$vc[0]['nome'];
                                            }
                                           $icone= "fa fa-link";
                                           $style = "background: #006198; color:#fff";
                                           $titulo = '<h3 class="timeline-header no-border"><a href="#">Um link</a>';

                                            break;
                                        case 'Fotos Flickr':
                            
                                            $fotos=explode('","',$vc['texto']);
                                            $img='';
                                            for ($i=0;$i<count($fotos);$i++){
                                              $foto=explode(',',str_replace('"','',$fotos[$i]));
                                              $src="http://farm".$foto[3].".static.flickr.com/".$foto[1]."/".$foto[0]."_".$foto[2]."_m.jpg";
                                              $img.="<img title='".$foto[4]."' src='".$src."' alt='' class='img-thumbnail'>";
                                            }
                                            $icone= "fa fa-flickr";
                                            $style = "background: #ff0085; color:#fff";
                                            $titulo = '<h3 class="timeline-header no-border"><a href="#">Nova(s) foto(s)</a>';
                                            $texto = "<b></b>".$img."&nbsp;";
                                        $arrayfotos='';
                                            break;
                                        default:
                                           $icone="fa fa-user";
                                           $titulo='<h3 class="timeline-header no-border"><a href="#">'.$vc['tabela'].'</a>';
                                            break;
                                    }
                                    ?>
                                <li>
                                    <i class="<?php echo $icone;?>" style="<?php echo $style;?>"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i><?php echo $vc['datahora'];?></span>
                                        <?php echo $titulo.$acao;?>
                                        <div class="timeline-body">
                                            <?php echo $texto ?>
                                        </div>
                                         <div class='timeline-footer'>

                                          <form action="/<?php echo PROJETO;?>/historico/exclui/id/<?php echo $vc['cdhistorico']?>">
                                            <button type="submit" class="btn btn-primary btn-xs">Apagar</button>
                                          </form>
                                        </div>
                                    </div>
                                </li>
                                <?php

                                  }      
                                
                                ?>
                            
                                 
                            </ul>
                        </div><!-- /.col -->
                    </div>
                    
 </div>

                                <!-- Modal -->

            <!-- main content -->
        
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Novo Marco</h4>
      </div>
      <form action="/<?php echo PROJETO;?>/historico/inserea/" role="form" method="post" >
      <div class="modal-body">
        <div class="">
          <input type="hidden" name="cdprojeto" id="cdprojeto" value="<?php echo $view_teste[0]['cdprojeto']?>">
            <div class="form-group">
                <label  class="control-label">Tipo</label>
                      <div class="controls">
                          <div class="">
                              <div class="col-xs-12">
                                <select name="tabela" id="tabela" class="form-control">
                                    <option value="">Selecione</option>
                                    <option value="youtube">Youtube</option>
                                    <option value="link">Foto(link externo)</option>
                                    <option value="linka">Link</option>
                                    <option value="texto">Texto</option>
                                </select>
                              </div>
                          </div>
                      </div>
            </div>
             </div>
             <div>
            <div class="form-group">
                <label  class="control-label">Conteúdo</label>
                      <div class="controls">
                          <div class="">
                              <div class="col-xs-12">
                                <textarea rows="4" cols="50" class="form-control" id="texto" name="texto"></textarea> 
                              </div>
                          </div>
                      </div>
            </div>
        </div>
        <div style="clear:both"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </form>
    </div>
  </div>
</div>
</section>

 <?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }  ?> 



<?php include('app/views/rodape.php');?>