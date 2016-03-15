
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>SIG - Maps</title>
		<meta name="description" content="SIG - Maps" />
		<meta name="keywords" content="Mapa nome do projeto " />
		<meta name="author" content="Jocas Sistemas" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="/<?php echo PROJETO;?>/inc/mapas/css/<?php echo $view_css;?>.css" />

  <!--[if IE 7]><link rel="stylesheet" href="css/home-ie7.css"><![endif]-->
    <script>
      function toggleCodes(on) {
        var obj = document.getElementById('icons');
        
        if (on) {
          obj.className += ' codesOn';
        } else {
          obj.className = obj.className.replace(' codesOn', '');
        }
      }
      
    </script>

    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map_canvas { height: 100%; }
    </style>
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?sensor=true">
    </script>
    <script type="text/javascript">
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(0.000643,-51.077886,17),
          zoom: 13,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);
      }
    </script>
    <script src="/<?php echo PROJETO;?>/inc/mapas/jquery-1.10.2.js"></script>
	</head>
  <body onload="initialize()">

		<div class="container">
			<header class="clearfix topo">
				<h1>LOGO</h1>
				<nav class="">
				</nav>
			</header>

			<ul class="cbp-vimenu">
				<li class="cbp-vicurrent" id='a'><a href="#" class="icon-home-1"></a></li>
				<li id='b' ><a href="#" id="pes" class="icon-search"></a></li>
				<li id='c'><a href="#" class="icon-list"></a></li>
				<li id='d'><a href="#" class="icon-location-circled"></a></li>
			</ul>
				<script>
				$(document).ready(function() {
				$(".icon-home-1").click(function(){
				  	   if($("#a").hasClass("cbp-vicurrent")){
				  	   	$("#a").removeClass("cbp-vicurrent");
				  	   }
				  		if($("#b").hasClass("cbp-vicurrent")){
				  	   	$("#b").removeClass("cbp-vicurrent");
				  	   }
				  	   if($("#c").hasClass("cbp-vicurrent")){
				  	   	$("#c").removeClass("cbp-vicurrent");
				  	   }
				  	   if($("#d").hasClass("cbp-vicurrent")){
				  	   	$("#d").removeClass("cbp-vicurrent");
				  	   }
				       $("#a").addClass("cbp-vicurrent");   
				      	$(".circle").html('<i class="icon-home-1"></i>'); 
				      	$(".texto").html('<h4>Bem vindo ao sig</h4>Texto sobre a descrição do que e o projeto.');
				      	$("#menulateral").show(); 
				  });
				  $(".icon-search").click(function(){
				  	   if($("#a").hasClass("cbp-vicurrent")){
				  	   	$("#a").removeClass("cbp-vicurrent");
				  	   }
				  		if($("#b").hasClass("cbp-vicurrent")){
				  	   	$("#b").removeClass("cbp-vicurrent");
				  	   }
				  	   if($("#c").hasClass("cbp-vicurrent")){
				  	   	$("#c").removeClass("cbp-vicurrent");
				  	   }
				  	   if($("#d").hasClass("cbp-vicurrent")){
				  	   	$("#d").removeClass("cbp-vicurrent");
				  	   }
				       $("#b").addClass("cbp-vicurrent");
				       $(".circle").html('<i class="icon-search"></i>');
				       $(".texto").html('<h4>Pesquisar</h4><input type="text">');
				       $("#menulateral").show(); 
					  });
				  	$(".icon-list").click(function(){
				  	   if($("#a").hasClass("cbp-vicurrent")){
				  	   	$("#a").removeClass("cbp-vicurrent");
				  	   }
				  		if($("#b").hasClass("cbp-vicurrent")){
				  	   	$("#b").removeClass("cbp-vicurrent");
				  	   }
				  	   if($("#c").hasClass("cbp-vicurrent")){
				  	   	$("#c").removeClass("cbp-vicurrent");
				  	   }
				  	   if($("#d").hasClass("cbp-vicurrent")){
				  	   	$("#d").removeClass("cbp-vicurrent");
				  	   }
				       $("#c").addClass("cbp-vicurrent");      
				       $(".circle").html('<i class="icon-list"></i>');
				       $(".texto").html('<h4>Filtros</h4><select><option> Teste Filtro</option></select>');
				       $("#menulateral").show(); 
				  });
				  	$(".icon-location-circled").click(function(){
				  	   if($("#a").hasClass("cbp-vicurrent")){
				  	   	$("#a").removeClass("cbp-vicurrent");
				  	   }
				  		if($("#b").hasClass("cbp-vicurrent")){
				  	   	$("#b").removeClass("cbp-vicurrent");
				  	   }
				  	   if($("#c").hasClass("cbp-vicurrent")){
				  	   	$("#c").removeClass("cbp-vicurrent");
				  	   }
				  	   if($("#d").hasClass("cbp-vicurrent")){
				  	   	$("#d").removeClass("cbp-vicurrent");
				  	   }
				       $("#d").addClass("cbp-vicurrent"); 
				       $(".circle").html('<i class="icon-location-2"></i>'); 
				       $(".texto").html('<h4>Categorias</h4>');
				       $("#menulateral").show();     
				  });
				  	$(".esconder").click(function(){
				  		$("#menulateral").toggle();
				  		   if($("#a").hasClass("cbp-vicurrent")){
				  	   	$("#a").removeClass("cbp-vicurrent");
				  	   }
				  		if($("#b").hasClass("cbp-vicurrent")){
				  	   	$("#b").removeClass("cbp-vicurrent");
				  	   }
				  	   if($("#c").hasClass("cbp-vicurrent")){
				  	   	$("#c").removeClass("cbp-vicurrent");
				  	   }
				  	   if($("#d").hasClass("cbp-vicurrent")){
				  	   	$("#d").removeClass("cbp-vicurrent");
				  	   }

				  	});
				});
				</script>

			<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="menulateral" style="color:#929292" align="center" id="cbp-spmenu-s2">
			<div class='esconder'> <input type="image" src="/<?php echo PROJETO;?>/inc/img/esconder.png" alt="Submit">
			</div>
			<div class="circle" align="center">
			<i class="icon-home-1"></i>
			</div>
			<div class="texto">
			<h4>Bem vindo ao sig!</h4>	
			Texto sobre a descrição do que e o projeto.
			</div>
			</div>

		</div>
  	    <div id="map_canvas" style="width:95%; height:100%"></div>
  	    <div id="" style="	
  	    width:95%; height:100%;
  	    opacity:0.65;
		-moz-opacity: 0.65;
		filter: alpha(opacity=65);
		background-color: #000;
	"></div>
	</body>
</html>
