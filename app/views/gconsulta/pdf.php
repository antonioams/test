
<?php
  include('mpdf.php');
  $arquivo=$view_consultas[0]['titulo'].".pdf";
  $mpdf=new mPDF();
  $mpdf->WriteHTML('Hello World');
  $mpdf->Output($arquivo, 'D');
  exit();                          
 
 

