
<?php
require('app/views/topo.php');
?>
<div class="<?php echo $_SESSION[PROJETO]['mensagem']['tipo'];?>">
                                <?php
                                echo $_SESSION[PROJETO]['mensagem']['texto'];
                                unset( $_SESSION[PROJETO]['mensagem'] );?>
                            </div>

<div class="col-sm-12">

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
<form action="/<?php echo PROJETO;?>/inicial_detalhes/novo" role="form" method="post" name="formeditar">

<?php if (($view_inicial_detalhes[0]['altura'])!='') {  
    foreach ($view_inicial_detalhes as $inicial_detalhes) { 
echo '
                                      <div class="'.$inicial_detalhes['largura'].'" id="'.$inicial_detalhes['ordem'].'">
                                          <div class="panel col-md-12 '.$inicial_detalhes['altura'].' " id="'.$inicial_detalhes['ordem'].'a" style="overflow:auto;">
                                                '.$inicial_detalhes['consulta'].'
                                            </div>
                                       </div>
';
}

}   ?>


<?php
if ($view_rodape!='') {
echo $view_rodape;
} else {
include('app/views/rodape.php');
}



?>
