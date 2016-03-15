<?php

require_once("phpFlickr.php");


$f = new phpFlickr("2cad18dc6454c1c9fb00f7026997a43b","3cd8c5e77295f305"); 


$set = $f->photosets_getList("21143527@N02"); 


foreach($set['photoset'] as $album){

echo "<h1>".$album['title']."</h1>";
$fotos = $f->photosets_getPhotos($album['id']);

foreach($fotos['photoset']['photo'] as $foto){

echo "<img src='http://farm" . $foto['farm'] . ".static.flickr.com/" . $foto['server'] . "/" . $foto['id'] . "_" . $foto['secret'] . "_s.jpg' legenda='" . 
$foto['title'] . "'/><BR />";

}

}




?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<script type="text/javascript">
function horizontal() {

var navItems = document.getElementById("menu_dropdown").getElementsByTagName("li");

for (var i=0; i< navItems.length; i++) {
if(navItems[i].className == "submenu")
{
if(navItems[i].getElementsByTagName('ul')[0] != null)
{
navItems[i].onmouseover=function() {this.getElementsByTagName('ul')[0].style.display="block";this.style.backgroundColor = "#A9A9A9A9";}
navItems[i].onmouseout=function() {this.getElementsByTagName('ul')[0].style.display="none";this.style.backgroundColor = "#A9A9A9A9";}
}
}
}

}

</script>
</head>
<link href="css/base-menu.css" rel="stylesheet" type="text/css" />

<center>
<body onload="horizontal();" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="background-color:#666">

<center>
<div id="page">
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="365" height="129"><img src="img/banner-left.jpg" alt="" width="365" height="131" border="0" /></td>
    <td width="100%" background="img/fundo-banner.jpg">&nbsp;</td>
    <td width="100%" background="img/fundo-banner.jpg">&nbsp;</td>
    <td width="397"><img src="img/banner-right.jpg" alt="" width="389" height="131" border="0" /></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellspacing="0" cellpadding="0">
  <tr>
    <td width="1%"><img src="img/menu-left.jpg" alt="" width="13" height="46" border="0" /></td>
    <td width="98%" background="img/menu-back.jpg">
    <div align="center" class="menu" style="text-align:center;"> 
    <ul id="menu_dropdown" class="menubar">
    <li class="submenu"><a href="http://www.quatrho.com.br/index.php">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>

            <li class="submenu"><a href="curso.php">Inscri&ccedil;&atilde;o em Curso</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;</li>
            
                    <li class="submenu"><a href="profissional.php">Cadastro de Profissionais</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
    
    <li class="submenu"><a href="http://www.quatrho.com.br/contato.php">Fale Conosco</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
    <li class="submenu"><a href="administrativo.php">Acesso Restrito</a></li>
</ul> 
    
</div></td>
    <td width="1%"><img src="img/menu-right.jpg" alt="" width="13" height="46" border="0" /></td>
  </tr>
        <tr>
      <td height="900"  width="100%" colspan="2" bgcolor="#FFFFFF">
    <iframe name="mainFrame" id="mainFrame" src="curso_ini.php" width="100%"  height="1200" frameborder="0" title="mainFrame" scrolling="no" nload="redimensiona('mainFrame')"></iframe></td></tr>
</table>
</div>
</center>
</body>
</html>



