<?php
print_r($view_template);
print_r($view_variavel);

foreach ($view_variavel[0] as $key=>$value){
    $vars="$".$key."='".$value."';";
    eval($vars);
}

require_once('/var/www/sig2/inc/mpdf60/mpdf.php');
//echo $view_template[0]['template'];
echo $cdmunicipio;

$template = preg_replace('/&(\w+)&/', '$\1', str_replace('&amp;','&',$view_template[0]['template']));
eval("\$template = \"$template\";");

//die ($template);
$mpdf=new mPDF();
$mpdf->WriteHTML($template);
$mpdf->Output();
?>