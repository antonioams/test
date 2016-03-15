
<?php
// Configurações header para forçar o download
$arquivo=$view_consultas[0]['titulo'].".xls";
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel; charset=utf-8");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );  
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
?>

   <?php echo $view_pagina;?>
   
   <?php echo $view_rodape;?>                                 
 
 

