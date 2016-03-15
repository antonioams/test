
<?php
include('app/views/topo.php');
?>
<div class="<?php echo $_SESSION[PROJETO]['mensagem']['tipo'];?>">
                                <?php
                                echo $_SESSION[PROJETO]['mensagem']['texto'];
                                unset( $_SESSION[PROJETO]['mensagem'] );?>
                            </div>
<?php if (!empty($view_vc[1])) { ?> 
<div class="box-tab">
<ul class="nav nav-tabs">
    <li class="pull-left header-tab"><?php echo $view_inicial[0]['descricao'];?>
               </li>
<?php foreach ($view_vc as $vc) { ?>
<li<?php echo $vc['tipo']?>><a href="<?php echo $vc['link']?>" data-original-title="<?php echo $vc['nome']?>"><?php echo $vc['atalho']?></a></li>
<?php } ?>
</ul>

<div class="tab-content">
<div class="tab-pane fade active in">

<?php } ?>


<script src="/<?php echo PROJETO;?>/inc/js/jquery-1.10.2.js"></script>
<script>
$(document).ready(function() {

    $(".y").click(function(){
    var id = this.value;

        if($("#"+id).hasClass("col-md-3")==true) {
            $("#"+id).removeClass("col-md-3");
            $("#"+id).addClass("col-md-4");
            $("."+id).val("col-md-4");
        }
        else if($("#"+id).hasClass("col-md-4")==true) {
            $("#"+id).removeClass("col-md-4");
            $("#"+id).addClass("col-md-6");
            $("."+id).val("col-md-6");
        }
        else if($("#"+id).hasClass("col-md-6")==true) {
            $("#"+id).removeClass("col-md-6");
            $("#"+id).addClass("col-md-8");
            $("."+id).val("col-md-8");
        }
        else{
            $("#"+id).removeClass("col-md-8");
            $("#"+id).addClass("col-md-12");
            $("."+id).val("col-md-12");

        }
      
  });
      $(".z").click(function(){
         var id = this.value;
 
        if($("#"+id).hasClass("col-md-3")==true) {
            alert("Menor Tamanho!");
        }
        else if($("#"+id).hasClass("col-md-4")==true) {
            $("#"+id).removeClass("col-md-4");
            $("#"+id).addClass("col-md-3");
            $("."+id).val("col-md-3");
        }
        else if($("#"+id).hasClass("col-md-6")==true) {
            $("#"+id).removeClass("col-md-6");
            $("#"+id).addClass("col-md-4");
            $("."+id).val("col-md-4");
        }
        else if($("#"+id).hasClass("col-md-8")==true) {
            $("#"+id).removeClass("col-md-8");
            $("#"+id).addClass("col-md-6");
             $("."+id).val("col-md-6");
        }
        else {
            $("#"+id).removeClass("col-md-12");
            $("#"+id).addClass("col-md-8");
            $("."+id).val("col-md-8");
        }
      
  });

      $(".x").click(function(){
         var id = this.value;

        if($("#"+id).hasClass("h-md-1")==true) {
            alert("Menor Tamanho!");
        }
        else if($("#"+id).hasClass("h-md-2")==true) {
            $("#"+id).removeClass("h-md-2");
            $("#"+id).addClass("h-md-1");
            $("."+id).val("h-md-1");
        }
        else if($("#"+id).hasClass("h-md-3")==true) {
            $("#"+id).removeClass("h-md-3");
            $("#"+id).addClass("h-md-2");
           $("."+id).val("h-md-2");
        }
        else if($("#"+id).hasClass("h-md-4")==true) {
            $("#"+id).removeClass("h-md-4");
            $("#"+id).addClass("h-md-3");
            $("."+id).val("h-md-3");
        }
        else{
            $("#"+id).removeClass("h-md-5");
            $("#"+id).addClass("h-md-4");
            $("."+id).val("h-md-4");
        }
      
  });

      $(".xx").click(function(){
         var id = this.value;
         if($("#"+id).hasClass("h-md-1")==true) {
            $("#"+id).removeClass("h-md-1");
            $("#"+id).addClass("h-md-2");
           $("."+id).val("h-md-2");
        }
        else if($("#"+id).hasClass("h-md-2")==true) {
            $("#"+id).removeClass("h-md-2");
            $("#"+id).addClass("h-md-3");
            $("."+id).val("h-md-3");
        }
        else if($("#"+id).hasClass("h-md-3")==true) {
            $("#"+id).removeClass("h-md-3");
            $("#"+id).addClass("h-md-4");
           $("."+id).val("h-md-4");
        }
        else{
            $("#"+id).removeClass("h-md-4");
            $("#"+id).addClass("h-md-5");
            $("."+id).val("h-md-5");
        }
      
  });

});
</script>
<form action="/<?php echo PROJETO;?>/inicial_detalhes/inserem" role="form" method="post" name="formeditar">

                            <div class="col-md-12 panel widget">
                                <h4><i class="fa fa-desktop"></i> PREVIEW - Configuração da Tela</h4>
                                    <div class="panel-body col-md-12" >
<?php  if (!empty($view_inicial_detalhes[0])) {  
    foreach ($view_inicial_detalhes as $inicial_detalhes) { 
echo '
                                      <div class="'.$inicial_detalhes['largura'].'" id="'.$inicial_detalhes['ordem'].'">
                                          <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                          <div class="well col-md-12 '.$inicial_detalhes['altura'].' " id="'.$inicial_detalhes['ordem'].'a">
                                                <input type="hidden" value="'.$inicial_detalhes['altura'].'" class="'.$inicial_detalhes['ordem'].'a" id name="altura[]">
                                                <input type="hidden" value="'.$inicial_detalhes['largura'].'" class="'.$inicial_detalhes['ordem'].'" name="largura[]">
                                                <input type="hidden" value="'.$inicial_detalhes['ordem'].'" class="ordem" name="ordem[]">

                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="'.$inicial_detalhes['ordem'].'"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="'.$inicial_detalhes['ordem'].'"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="'.$inicial_detalhes['ordem'].'a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="'.$inicial_detalhes['ordem'].'a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                <select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>';

                                                foreach ($view_consultas as $consultas) {
                                                    if ($inicial_detalhes['cdconsulta']==$consultas['cdconsulta']) { $ch=' selected="selected" '; } else { $ch=''; }
                                                 echo '<option value="'.$consultas['cdconsulta'].'"'.$ch.'>'.$consultas['titulo'].'</option>';
                                                 }
                                                 echo ' 
                                                </select>
                                                </div>

                                            </div>
                                       </div>
';
}

} else {
    ?>


                                      <div class="col-md-3" id="1">
                                          <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                          <div class="well col-md-12 h-md-1 " id="1a">
                                                <input type="hidden" value="" class="1a" id name="altura[]">
                                                <input type="hidden" value="" class="1" name="largura[]">
                                                <input type="hidden" value="1" class="ordem" name="ordem[]">

                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="1"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="1"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="1a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="1a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                <select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div> 
                                       <div class="col-md-3" id="2">
                                           <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                        <div class="well col-md-12 h-md-1 " id="2a">
                                                <input type="hidden" value="" class="2a" name="altura[]">
                                                <input type="hidden" value="" class="2" name="largura[]">
                                                <input type="hidden" value="2" class="ordem" name="ordem[]">

                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="2"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="2"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="2a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="2a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                       						<select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div> 
                                    <div class="col-md-3" id="3">
                                         <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                        <div class="well col-md-12 h-md-1 " id="3a">
                                            
                                                <input type="hidden" value="" class="3a" name="altura[]">
                                                <input type="hidden" value="" class="3" name="largura[]">
                                                <input type="hidden" value="3" class="ordem" name="ordem[]">
                                               

                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="3"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="3"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="3a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="3a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                       						<select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div> 
                                       <div class="col-md-3" id="4">
                                           <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                       <div class="well col-md-12 h-md-1 " id="4a">
                                                <input type="hidden" value="" class="4a" name="altura[]">
                                                <input type="hidden" value="" class="4" name="largura[]">
                                                <input type="hidden" value="4" class="ordem" name="ordem[]">
                                             

                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="4"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="4"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="4a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="4a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                       						<select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div> 
                                    <div class="col-md-3" id="5">

                                                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                      <div class="well col-md-12 h-md-1" id="5a">

                                                <input type="hidden" value="" class="5a" name="altura[]">
                                                <input type="hidden" value="" class="5" name="largura[]">
                                                <input type="hidden" value="5" class="ordem" name="ordem[]">

                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="5"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="5"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="5a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="5a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                       						<select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div> 
                                       <div class="col-md-3" id="6">
                                           <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>

                                        <div class="well col-md-12 h-md-1 " id="6a">
                                                <input type="hidden" value="" class="6a" name="altura[]">
                                                <input type="hidden" value="" class="6" name="largura[]">
                                                <input type="hidden" value="6" class="ordem" name="ordem[]">
                                             
                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="6"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="6"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="6a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="6a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                       						<select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div> 
                                       <div class="col-md-3">
                                        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                        <div class="well col-md-12 h-md-1" id="7a">
                                                <input type="hidden" value="" class="7a" name="altura[]">
                                                <input type="hidden" value="" class="7" name="largura[]">
                                                <input type="hidden" value="7" class="ordem" name="ordem[]">
                                                

                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="7"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="7"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="7a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="7a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                       						<select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div> 
                                       <div class="col-md-3" id="8">
                                          <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>

                                        <div class="well col-md-12 h-md-1 " id="8a">
                                                <input type="hidden" value="" class="8a" name="altura[]">
                                                <input type="hidden" value="" class="8" name="largura[]">
                                                <input type="hidden" value="8" class="ordem" name="ordem[]">
                                              
                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="8"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="8"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="8a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="8a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                <select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						                      <?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div>
                                    <div class="col-md-3" id="9">
                                                                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                        <div class="well col-md-12 h-md-1 " id="9a">
                                            
                                                <input type="hidden" value="" class="9a" name="altura[]">
                                                <input type="hidden" value="" class="9" name="largura[]">
                                                <input type="hidden" value="9" class="ordem" name="ordem[]">
                    

                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="9"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="9"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="9a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="9a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                       						<select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div> 
                                        <div class="col-md-3" id="10">
                                              <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                        <div class="well col-md-12 h-md-1 " id="10a">
                                           
                                                <input type="hidden" value="" class="10a" name="altura[]">
                                                <input type="hidden" value="" class="10" name="largura[]">
                                                <input type="hidden" value="10" class="ordem" name="ordem[]">
                                              

                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="10"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="10"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="10a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="10a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                       						<select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div> 
                                         <div class="col-md-3" id="11">
                                             <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                        <div class="well col-md-12 h-md-1 " id="11a">
                                                <input type="hidden" value="" class="11a" name="altura[]">
                                                <input type="hidden" value="" class="11" name="largura[]">
                                                <input type="hidden" value="11" class="ordem" name="ordem[]">
                                               

                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="11"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="11"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="11a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="11a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                       						<select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div>  
                                       <div class="col-md-3" id="12">
                                              <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                        <div class="well col-md-12 h-md-1 " id="12a">
                                      
                                                <input type="hidden" value="" class="12a" name="altura[]">
                                                <input type="hidden" value="" class="12" name="largura[]">
                                                <input type="hidden" value="12" class="ordem" name="ordem[]">
                                               

                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="12"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="12"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="12a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="12a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                       						<select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div> 
                                       <div class="col-md-3" id="13">
                                        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                        <div class="well col-md-12 h-md-1 " id="13a">
                                           
                                                <input type="hidden" value="" class="13a" name="altura[]">
                                                <input type="hidden" value="" class="13" name="largura[]">
                                                <input type="hidden" value="13" class="ordem" name="ordem[]">
                                                

                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="13"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="13"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="13a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="13a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                       						<select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div> 
                                       <div class="col-md-3" id="14">
                                          <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                        <div class="well col-md-12 h-md-1 " id="14a">
                                            
                                                <input type="hidden" value="" class="14a" name="altura[]">
                                                <input type="hidden" value="" class="14" name="largura[]">
                                                <input type="hidden" value="14" class="ordem" name="ordem[]">
                                              

                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="14"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="14"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="14a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="14a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                       						<select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div> 
                                       <div class="col-md-3" id="15">
                                         <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                        <div class="well col-md-12 h-md-1 " id="15a">
                                            
                                                <input type="hidden" value="" class="15a" name="altura[]">
                                                <input type="hidden" value="" class="15" name="largura[]">
                                                <input type="hidden" value="15" class="ordem" name="ordem[]">
                                               

                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="15"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="15"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="15a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="15a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                       						<select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div>  
                                    <div class="col-md-3" id="16">
                                        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>

                                        <div class="well col-md-12 h-md-1 " id="16a">
                              
                                                <input type="hidden" value="" class="16a" name="altura[]">
                                                <input type="hidden" value="" class="16" name="largura[]">
                                                <input type="hidden" value="16" class="ordem" name="ordem[]">
                                                
                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="16"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="16"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="16a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="16a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                       						<select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div>
                                       <div class="col-md-3" id="17">
                                          <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                        <div class="well col-md-12 h-md-1 " id="17a">
                                                <input type="hidden" value="" class="17a" name="altura[]">
                                                <input type="hidden" value="" class="17" name="largura[]">
                                                <input type="hidden" value="17" class="ordem" name="ordem[]">
                                              

                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="17"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="17"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="17a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="17a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                       						<select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div>
                                       <div class="col-md-3" id="19">
                                        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>

                                       <div class="well col-md-12 h-md-1 " id="19a">
                                                <input type="hidden" value="" class="19a" name="altura[]">
                                                <input type="hidden" value="" class="19" name="largura[]">
                                                <input type="hidden" value="19" class="ordem" name="ordem[]">
                                                
                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="19"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="19"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="19a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="19a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                       						<select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div>
                                       <div class="col-md-3" id="20">
                                         <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                        <div class="well col-md-12 h-md-1 " id="20a">
                                                <input type="hidden" value="" class="20a" name="altura[]">
                                                <input type="hidden" value="" class="20" name="largura[]">
                                                <input type="hidden" value="20" class="ordem" name="ordem[]">
                                               

                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="20"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="20"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="20a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="20a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                       						<select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div>
                                 <div class="col-md-3" id="21">
                                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                       <div class="well col-md-12 h-md-1" id="21a">
                                                <input type="hidden" value="" class="21a" name="altura[]">
                                                <input type="hidden" value="" class="21" name="largura[]">
                                                <input type="hidden" value="21" class="ordem" name="ordem[]">

                                                <div class="bt-aum">
                                                    <button class="btn btn-success btn-xs z" aria-hidden="true" type="button"  value="21"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-success btn-xs y" aria-hidden="true" type="button"  value="21"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="bt-dim">
                                                    <button class="btn btn-warning btn-xs x" aria-hidden="true" type="button"  value="21a"><i class="fa fa-minus"></i></button><br>
                                                    <button class="btn btn-warning btn-xs xx" aria-hidden="true" type="button" value="21a"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="modulo">
                                                       						<select class="chosen" id="cdconsulta" name="cdconsulta[]" data-parsley-trigger="change">
                                                     <option value=""></option>
						<?php foreach ($view_consultas as $consultas) { ?>
                                                 <option value="<?php echo $consultas['cdconsulta'];?>"><?php echo $consultas['titulo'];?></option>
                                                <?php  } ?>
                                                  
                                                </select>
                                                </div>

                                            </div>
                                       </div>
<?php } ?>


                    </div>

                        <div class="fotter-cadastrado">
                   <button type="submit" name="submit" value="Salvar" class="btn btn-primary  btn-sig"><i class=" fa fa-fw fa-save" ></i>
                     Salvar</button>
                   <a href="/<?php echo PROJETO;?>/inicial/" class="btn btn-default">Cancelar</a>
              </div>
              <br><br>

 <?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }   ?> 

              

 </form>
<?php include('app/views/rodapelayout.php'); ?>