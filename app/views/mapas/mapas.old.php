<?php 
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
set_time_limit(0);

$json_projetos = json_encode($view_projetos);
?>
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
        <link rel="stylesheet" type="text/css" href="/<?php echo PROJETO;?>/inc/mapas/css/<?php echo /*$view_css*/ "cssnovo";?>.css" />
        <style type="text/css">
        
        </style>
        <!--[if IE 7]><link rel="stylesheet" href="css/home-ie7.css"><![endif]-->
        <script>
            function toggleCodes(on){
                var obj = document.getElementById('icons');
                
                if (on) {
                    obj.className += ' codesOn';
                }
                else {
                    obj.className = obj.className.replace(' codesOn', '');
                }
            }
            json_projetos = eval('<?=$json_projetos?>');
            var beaches = "[";
			<?php
			foreach ($view_projetos as $projetos) {
				if ($projetos['latitude']>0){
				?>
					beaches = beaches+"['<?=$projetos['intervencao']?>','<?=$projetos['latitude']?>','<?=$projetos['longitude']?>','<?=$projetos['endereco']?>','<?=$projetos['objetivo']?>',4],";
				<?php
				}	
			}
			?>
			beaches = eval(beaches.substring(0,(beaches.length - 1))+"]");
			//alert(beaches);
        </script>
        <style type="text/css">
            html {
                height: 100%
            }
            
            body {
                height: 100%;
                margin: 0;
                padding: 0
            }
            
            #map_canvas {
                height: 100%;
            }
        </style>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&sensor=true">
        </script>
		<script src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/data.json"></script>
		<script src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer.js"></script>
		
        <script type="text/javascript">
        	var map;
            function initialize(){
                var mapOptions = {
                    center: new google.maps.LatLng(0.000643, -51.077886, 17),
                    zoom: 4,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
					zoomControl: true,
				    zoomControlOptions: {
				        style: google.maps.ZoomControlStyle.LARGE,
				        position: google.maps.ControlPosition.LEFT_CENTER
				    },
				    panControl: false,
				    panControlOptions: {
				        position: google.maps.ControlPosition.LEFT_BOTTOM
				    }
                    
                };
                map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
                mapMarkers(json_projetos);
			}
			
			function mapMarkers(beaches){
				if (typeof markers !='undefined'){
					for (var i = 0; i < markers.length; i++) {
						markerCluster.clearMarkers();
				    	markers[i].setMap(null);
					}
				}
				
				markers = [];
				for (var i = 0; i < beaches.length; i++) {
					if (beaches[i].latitude!=''){
						var myLatLng = new google.maps.LatLng(beaches[i].latitude, beaches[i].longitude);
					    var marker = new google.maps.Marker({
					        position: myLatLng,
					        map: map,
					        title: beaches[i].intervencao
					    });
						markers.push(marker);
	
						var contentString = '<div class="balaomapa">'+
							                '<div class="head_balao"><b>'+
							                beaches[i].intervencao+
							                '</b></div>'+
							                '<div class="con_mapa">'+
							                '<div class="esq_mapa">'+
							                '<ul> ' +
							                '<li><img src="/sighomologa/inc/img/home_min.png">&nbsp;'+ beaches[i].endereco +'</li>'+
							                '<li><img src="/sighomologa/inc/img/objt_min.png">&nbsp;'+ beaches[i].objetivo +'</li>'+
							                '<li><img src="/sighomologa/inc/img/cat_min.png">&nbsp;'+ beaches[i].area +'</li>'+
							                '</ul>'+
							                '</div>'+
							                '<div class="dir_mapa">'+
							                '<img src="http://3.bp.blogspot.com/-RGcSnVormTw/TcmW7WcoOgI/AAAAAAAAAAc/lj7T2BDI_gI/s1600/canstock2467652.jpg" width="140px">'+
							                '</div>'+
							                '<div class="clear"></div>'+
							                '<div class="foot_mapa" align="center">'+
							                '<a href="#" >+ informações</a>'+
							                '</div>'+
							                '</div>'+
							                '</div>';
						infowindow = false;
						
						google.maps.event.addListener(marker,'click', (function(marker,contentString){ 
							if (!infowindow){
								infowindow = new google.maps.InfoWindow();
							}else{
								infowindow.close();
								infowindow = new google.maps.InfoWindow();
							}
						    
					        return function() {
					        	infowindow.setContent(contentString);
					           	infowindow.open(map,marker);
					        };
					    })(marker,contentString,infowindow));
					}
				}
				
				markerCluster = new MarkerClusterer(map, markers);
			}

			function filterMapMarkers(){
				var array_filter=[];
				var array_filter_aux=[];
				//cdtipo
				x=document.getElementById('cdtipo');
				for (var i=0; i < x.options.length; i++){
					for (var j=0; j < json_projetos.length; j++){
						if ((x.options[i].selected) && (json_projetos[j].cdtipo == x.options[i].value)){
							/*var aux=false;
							for (var y=0;y< array_filter.length; y++){
								if (array_filter[y].cdprojeto==json_projetos[j].cdprojeto){
									aux=true;
								}
							}
							if (!aux)*/
								array_filter.push(json_projetos[j]);
						}
					}	
				}
				if (array_filter.length==0){
					array_filter=json_projetos;
				}
				array_filter_aux=array_filter;
				//alert('cdtipo-> '+array_filter_aux.length);
				array_filter=[];
								
				//cdarea
				x=document.getElementById('cdarea');
				if (x.selectedIndex>=0){
					for (var i=0; i < x.options.length; i++){
						for (var j=0; j < array_filter_aux.length; j++){
							if ((x.options[i].selected) && (array_filter_aux[j].cdarea == x.options[i].value)){
								/*var aux=false;
								for (var y=0;y< array_filter.length; y++){
									if (array_filter[y].cdprojeto==array_filter_aux[j].cdprojeto){
										aux=true;
									}
								}
								if (!aux)*/
									array_filter.push(array_filter_aux[j]);
							}
						}	
					}
				}else{
					array_filter=array_filter_aux;
				}
				array_filter_aux=array_filter;
				//alert('cdarea-> '+array_filter_aux.length);
				array_filter=[];
				
				//cdinstituicao
				x=document.getElementById('cdinstituicao');
				if (x.selectedIndex>=0){
					for (var i=0; i < x.options.length; i++){
						for (var j=0; j < array_filter_aux.length; j++){
							if ((x.options[i].selected) && (array_filter_aux[j].cdinstituicao == x.options[i].value)){
								/*var aux=false;
								for (var y=0;y< array_filter.length; y++){
									if (array_filter[y].cdprojeto==json_projetos[j].cdprojeto){
										aux=true;
									}
								}
								if (!aux)*/
									array_filter.push(array_filter_aux[j]);
							}
						}	
					}
				}else{
					array_filter=array_filter_aux;
				}
				array_filter_aux=array_filter;
				//alert('cdinstituicao-> '+array_filter_aux.length);
				array_filter=[];
				
				//cdfase
				x=document.getElementById('cdfase');
				if (x.selectedIndex>=0){
					for (var i=0; i < x.options.length; i++){
						for (var j=0; j < array_filter_aux.length; j++){
							if ((x.options[i].selected) && (array_filter_aux[j].cdfase == x.options[i].value)){
								/*var aux=false;
								for (var y=0;y< array_filter.length; y++){
									if (array_filter[y].cdprojeto==json_projetos[j].cdprojeto){
										aux=true;
									}
								}
								if (!aux)*/
									array_filter.push(array_filter_aux[j]);
							}
						}	
					}
				}else{
					array_filter=array_filter_aux;
				}
				array_filter_aux=array_filter;
				//alert('cdfase-> '+array_filter_aux.length);
				array_filter=[];
				
				//cdnatureza
				x=document.getElementById('cdnatureza');
				if (x.selectedIndex>=0){
					for (var i=0; i < x.options.length; i++){
						for (var j=0; j < array_filter_aux.length; j++){
							if ((x.options[i].selected) && (array_filter_aux[j].cdnatureza == x.options[i].value)){
								/*var aux=false;
								for (var y=0;y< array_filter.length; y++){
									if (array_filter[y].cdprojeto==json_projetos[j].cdprojeto){
										aux=true;
									}
								}
								if (!aux)*/
									array_filter.push(array_filter_aux[j]);
							}
						}	
					}
				}else{
					array_filter=array_filter_aux;
				}
				array_filter_aux=array_filter;
				//alert('cdnatureza-> '+array_filter_aux.length);
				array_filter=[];
				
				//cdmunicipio
				x=document.getElementById('cdmunicipio');
				if (x.selectedIndex>=0){
					for (var i=0; i < x.options.length; i++){
						for (var j=0; j < array_filter_aux.length; j++){
							if ((x.options[i].selected) && (array_filter_aux[j].cdmunicipio == x.options[i].value)){
								/*var aux=false;
								for (var y=0;y< array_filter.length; y++){
									if (array_filter[y].cdprojeto==json_projetos[j].cdprojeto){
										aux=true;
									}
								}
								if (!aux)*/
									array_filter.push(array_filter_aux[j]);
							}
						}	
					}
				}else{
					array_filter=array_filter_aux;
				}
				//alert('cdmunicipio-> '+array_filter_aux.length);
				mapMarkers(array_filter);
			}
		</script>
        <script src="/<?php echo PROJETO;?>/inc/mapas/jquery-1.10.2.js">
        </script>
    </head>
    <body onload="initialize()">
        <div class="container">
            <header class="clearfix topo">
                <h1>LOGO</h1>
                <nav class="">
                </nav>
            </header>
            <ul class="cbp-vimenu">
                <li class="cbp-vicurrent" id='a'>
                    <a href="#" class="icon-home-1"></a>
                </li>
                <li id='b'>
                    <a href="#" id="pes" class="icon-search"></a>
                </li>
                <li id='c'>
                    <a href="#" class="icon-list"></a>
                </li>
                <li id='d'>
                    <a href="#" class="icon-location-circled"></a>
                </li>
            </ul>
            <script>
                $(document).ready(function(){
                    $(".icon-home-1").click(function(){
                        if ($("#a").hasClass("cbp-vicurrent")) {
                            $("#a").removeClass("cbp-vicurrent");
                        }
                        if ($("#b").hasClass("cbp-vicurrent")) {
                            $("#b").removeClass("cbp-vicurrent");
                        }
                        if ($("#c").hasClass("cbp-vicurrent")) {
                            $("#c").removeClass("cbp-vicurrent");
                        }
                        if ($("#d").hasClass("cbp-vicurrent")) {
                            $("#d").removeClass("cbp-vicurrent");
                        }
                        $("#a").addClass("cbp-vicurrent");
                        $(".circle").html('<i class="icon-home-1"></i>');
                        $(".texto").html('<h4>Bem vindo ao sig</h4>Texto sobre a descrição do que e o projeto.');
                        $("#filter").show();
                        $("#menulateral").show();
                    });
                    $(".icon-search").click(function(){
                        if ($("#a").hasClass("cbp-vicurrent")) {
                            $("#a").removeClass("cbp-vicurrent");
                        }
                        if ($("#b").hasClass("cbp-vicurrent")) {
                            $("#b").removeClass("cbp-vicurrent");
                        }
                        if ($("#c").hasClass("cbp-vicurrent")) {
                            $("#c").removeClass("cbp-vicurrent");
                        }
                        if ($("#d").hasClass("cbp-vicurrent")) {
                            $("#d").removeClass("cbp-vicurrent");
                        }
                        $("#b").addClass("cbp-vicurrent");
                        $(".circle").html('<i class="icon-search"></i>');
                        $(".texto").html('<h4>Pesquisar</h4><input type="text">');
                        $("#menulateral").show();
                    });
                    $(".icon-list").click(function(){
                        if ($("#a").hasClass("cbp-vicurrent")) {
                            $("#a").removeClass("cbp-vicurrent");
                        }
                        if ($("#b").hasClass("cbp-vicurrent")) {
                            $("#b").removeClass("cbp-vicurrent");
                        }
                        if ($("#c").hasClass("cbp-vicurrent")) {
                            $("#c").removeClass("cbp-vicurrent");
                        }
                        if ($("#d").hasClass("cbp-vicurrent")) {
                            $("#d").removeClass("cbp-vicurrent");
                        }
                        $("#c").addClass("cbp-vicurrent");
                        $(".circle").html('<i class="icon-list"></i>');
						
                        var filtros ="<h4>Filtros</h4>";
						//Tipo
                        filtros+="<div class='form-group'>";
                        filtros+="<label class='control-label'>Tipo</label>";
                        filtros+="<div class='controls'>";
                        filtros+="<div class='row'><div class='col-xs-12'><select class='chosen' id='cdtipo' name='m3cdtipo[]' onchange='filterMapMarkers();' multiple>";
                        filtros+="<option value=''></option>";
                        <?php
                        foreach ($view_tipos as $tipos) {
                        	?>
							filtros+="<option value='<?=$tipos['cdtipo']?>'><?=$tipos['nome']?></option>";
							<?php 
                        } 
                        ?>						
						filtros+="</select></div></div></div></div>";

						//Area
						filtros+="<div class='form-group'>";
						filtros+="<label  class='control-label'>Area</label>";
						filtros+="<div class='controls'>";
						filtros+="<div class='row'><div class='col-xs-12'><select class='chosen' id='cdarea' name='m3cdarea[]' onchange='filterMapMarkers();' multiple>";
						filtros+="<option value=''></option>";
						<?php
                        foreach ($view_areas as $areas) {
                        	?>
							filtros+="<option value='<?=$areas['cdarea']?>'><?=$areas['descricao']?></option>";
							<?php 
                        } 
                        ?>
                        filtros+="</select></div></div></div></div>";

                      	//Instituicao
						filtros+="<div class='form-group'>";
						filtros+="<label  class='control-label'>Instituicao</label>";
						filtros+="<div class='controls'>";
						filtros+="<div class='row'><div class='col-xs-12'><select class='chosen' id='cdinstituicao' name='m3cdinstituicao[]' onchange='filterMapMarkers();' multiple>";
						filtros+="<option value=''></option>";
						<?php
						foreach ($view_instituicoes as $instituicoes) {
                        	?>
							filtros+="<option value='<?=$instituicoes['cdinstituicao']?>'><?=$instituicoes['sigla']?> - <?=$instituicoes['nome']?></option>";
							<?php 
                        } 
                        ?>
                        filtros+="</select></div></div></div></div>";

                      	//Fase
						filtros+="<div class='form-group'>";
						filtros+="<label  class='control-label'>Fase</label>";
						filtros+="<div class='controls'>";
						filtros+="<div class='row'><div class='col-xs-12'><select class='chosen' id='cdfase' name='m3cdfase[]' onchange='filterMapMarkers();' multiple>";
						filtros+="<option value=''></option>";
						<?php
						foreach ($view_fases as $fases) {
                        	?>
							filtros+="<option value='<?=$fases['cdfase']?>'><?=$fases['nome']?></option>";
							<?php 
                        } 
                        ?>
                        filtros+="</select></div></div></div></div>";

                      	//Fase
						filtros+="<div class='form-group'>";
						filtros+="<label  class='control-label'>Natureza</label>";
						filtros+="<div class='controls'>";
						filtros+="<div class='row'><div class='col-xs-12'><select class='chosen' id='cdnatureza' name='m3cdnatureza[]' onchange='filterMapMarkers();' multiple>";
						filtros+="<option value=''></option>";
						<?php
						foreach ($view_naturezas as $naturezas) {
                        	?>
							filtros+="<option value='<?=$naturezas['cdnatureza']?>'><?=$naturezas['nome']?></option>";
							<?php 
                        } 
                        ?>
                        filtros+="</select></div></div></div></div>";

                      	//Municipio
						filtros+="<div class='form-group'>";
						filtros+="<label  class='control-label'>Municipio</label>";
						filtros+="<div class='controls'>";
						filtros+="<div class='row'><div class='col-xs-12'><select class='chosen' id='cdmunicipio' name='m3cdmunicipio[]' onchange='filterMapMarkers();' multiple>";
						filtros+="<option value=''></option>";
						<?php
						foreach ($view_municipios as $municipios) {
                        	?>
							filtros+="<option value='<?=$municipios['cdmunicipio']?>'><?=$municipios['nome']?></option>";
							<?php 
                        } 
                        ?>
                        filtros+="</select></div></div></div></div>";
									 
                        $(".texto").html(filtros);
                        $("#menulateral").show();
                    });
                    $(".icon-location-circled").click(function(){
                        if ($("#a").hasClass("cbp-vicurrent")) {
                            $("#a").removeClass("cbp-vicurrent");
                        }
                        if ($("#b").hasClass("cbp-vicurrent")) {
                            $("#b").removeClass("cbp-vicurrent");
                        }
                        if ($("#c").hasClass("cbp-vicurrent")) {
                            $("#c").removeClass("cbp-vicurrent");
                        }
                        if ($("#d").hasClass("cbp-vicurrent")) {
                            $("#d").removeClass("cbp-vicurrent");
                        }
                        $("#d").addClass("cbp-vicurrent");
                        $(".circle").html('<i class="icon-location-2"></i>');
                        $(".texto").html('<h4>Áreas</h4><a href="#"><img src="/<?php echo PROJETO;?>/inc/img/saude.jpg" class="mincir" width="64px"></a><img src="educacao.jpg" class="mincir" width="64px"><img src="saneamento.jpg" class="mincir" width="64px"> <img src="transporte.jpg" class="mincir" width="64px">');
                        $("#menulateral").show();
                    });
                    $(".esconder").click(function(){
                        $("#menulateral").toggle();
                        if ($("#a").hasClass("cbp-vicurrent")) {
                            $("#a").removeClass("cbp-vicurrent");
                        }
                        if ($("#b").hasClass("cbp-vicurrent")) {
                            $("#b").removeClass("cbp-vicurrent");
                        }
                        if ($("#c").hasClass("cbp-vicurrent")) {
                            $("#c").removeClass("cbp-vicurrent");
                        }
                        if ($("#d").hasClass("cbp-vicurrent")) {
                            $("#d").removeClass("cbp-vicurrent");
                        }
                        
                    });
                });
            </script>
            <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="menulateral" style="color:#929292" align="center" id="cbp-spmenu-s2">
                <div class='esconder'>
                    <input type="image" src="/<?php echo PROJETO;?>/inc/img/esconder.png" alt="Submit">
                </div>
                <div class="circle" align="center">
                    <i class="icon-home-1"></i>
                </div>
                <div class="texto" style="overflow:auto;">
                    <h4>Bem vindo ao sig!</h4>
                    Texto sobre a descrição do que e o projeto.
                        <div id="filter" class="testef" style="display: none;">

 						<div class='form-group'>
                        <label class='control-label'>Tipo</label>
                        <div class='controls'>
                        <div class='row'><div class='col-xs-12'><select class='chosen' id='cdtipo' name='m3cdtipo[]' onchange='filterMapMarkers();' multiple>
                        <option value=''></option>
                        <?php
                        foreach ($view_tipos as $tipos) {
                        	?>
							<option value='<?=$tipos['cdtipo']?>'><?=$tipos['nome']?></option>
							<?php 
                        } 
                        ?>						
						</select></div></div></div></div>

                    </div>

                </div>
            </div>
        </div>
        <div id="map_canvas" style="padding-top:90px; width:100%; height:100%; ">
        
    </div>
      
    </body>
</html>
<?php 
//echo $json_projetos;
?>