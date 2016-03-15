
<?php 
ini_set('display_errors',1);
ini_set('display_startup_erros',1);

error_reporting(E_ALL);
set_time_limit(0);
$json_projetos = json_encode($view_projetos);
//print_r($json_projetos);
//die();
if($view_modal!=''){

}
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
           <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="/<?php echo PROJETO;?>/inc/mapas/css/<?php echo $view_css /*"cssnovo"*/;?>.css" />
        <link rel="stylesheet" type="text/css" href="/<?php echo PROJETO;?>/inc/mapas/css/modal.css" />
        <script type="text/javascript">
$(document).ready(function(){
    
    //Esconde preloader
    $(window).load(function(){
        $('#preloader').fadeOut(1500);//1500 é a duração do efeito (1.5 seg)
    });
    
});
        </script>

        <style type="text/css">
		.topo {
			min-width: 500px;
		}
        </style>
<style>
#preloader {
    position: absolute;
    left: 0px;
    right: 0px;
    bottom: 0px;
    top: 0px;
    background: url('/<?php echo PROJETO;?>/inc/img/brancotransp.png');
    z-index: 999;
}
.listait{
    width: 250px; 
    height: 520px; 
    background: #fff; 
    border-radius: 5px; 
    border-color:#ccc; 
    border-style:solid; 
    padding:5px; 
    border-width:1px; 
    float:left; 
    margin-left: 10px; 
    margin-top:10px;
        font-family: arial;
        color: #383839;
        font-size: 14px;
}
.listait img{
    width: 250px;
    border-radius: 4px;
}
.listait h4{
    margin-top: 5px;
    font-size: 16px;

}
.listait ul{
    padding: 0;
}
.listait li{
    list-style: none;
    padding-bottom: 10px;
    padding-top: 3px;
    border-bottom-style:solid; 
    border-bottom-width: 1px;
    border-bottom-color: #ccc; 
    text-align: justify;
}

</style>
          <link rel="stylesheet" href="/<?php echo PROJETO;?>/inc/mapas/css/chosen.css">
        <script type="text/javascript"> </script>
        <!--[if IE 7]><link rel="stylesheet" href="css/home-ie7.css"><![endif]-->
        <script type="text/javascript">
( function( $ ) {
$( document ).ready(function() {
$('#cssmenu').prepend('<div id="indicatorContainer"><div id="pIndicator"><div id="cIndicator"></div></div></div>');
    var activeElement = $('#cssmenu>ul>li:first');

    $('#cssmenu>ul>li').each(function() {
        if ($(this).hasClass('active')) {
            activeElement = $(this);
        }
    });


	var posLeft = activeElement.position().left;
	var elementWidth = activeElement.width();
	posLeft = posLeft + elementWidth/2 -6;
	if (activeElement.hasClass('has-sub')) {
		posLeft -= 6;
	}

	$('#cssmenu #pIndicator').css('left', posLeft);
	var element, leftPos, indicator = $('#cssmenu pIndicator');
	
	$("#cssmenu>ul>li").hover(function() {
        element = $(this);
        var w = element.width();
        if ($(this).hasClass('has-sub'))
        {
        	leftPos = element.position().left + w/2 - 12;
        }
        else {
        	leftPos = element.position().left + w/2 - 6;
        }

        $('#cssmenu #pIndicator').css('left', leftPos);
    }
    , function() {
    	$('#cssmenu #pIndicator').css('left', posLeft);
    });

	$('#cssmenu>ul').prepend('<li id="menu-button"><a>Menu</a></li>');
	$( "#menu-button" ).click(function(){
    		if ($(this).parent().hasClass('open')) {
    			$(this).parent().removeClass('open');
    		}
    		else {
    			$(this).parent().addClass('open');
    		}
    	});
});
} )( jQuery );

        </script>
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
            json_projetos = eval('<?php echo $json_projetos?>');
            //json_projetos = JSON.parse('<?php echo str_replace(array('[',']'),'',$json_projetos)?>');
            var flicker_array = '';
			
			<?php
			if ($_SESSION[PROJETO]['m_flickr_chave']!='') {
				require_once("phpFlickr.php");
				$f = new phpFlickr($_SESSION[PROJETO]['m_flickr_chave'],$_SESSION[PROJETO]['m_flickr_sec']); 
			}
			foreach ($view_projetos as $projetos) {
				if ($projetos['flicker']!=null){
					$fotos = $f->photosets_getPhotos($projetos['flicker']);		
					?>
					//var img='<img class="avatar avatar-lg img-thumbnail " title="<?php echo $fotos['photoset']['photo'][0]['title']?>" src="http://farm<?php echo $fotos['photoset']['photo'][0]['farm']?>static.flickr.com/<?php echo $fotos['photoset']['photo'][0]['server']?>/<?php echo $fotos['photoset']['photo'][0]['id']?>_<?php echo $fotos['photoset']['photo'][0]['secret']?>_m.jpg"  alt=""';
					//flicker_array = flicker_array+"['<?php echo $projetos['cdprojeto']?>',img],";
					    //src="http://farm' . $fotos['photoset']['photo'][0]['farm'] . '.static.flickr.com/' . $fotos['photoset']['photo'][0]['server'] . '/' . $fotos['photoset']['photo'][0]['id'] . '_' . $fotos['photoset']['photo'][0]['secret'] . '_m.jpg"
					var src="http://farm<?php echo $fotos['photoset']['photo'][0]['farm']?>.static.flickr.com/<?php echo $fotos['photoset']['photo'][0]['server']?>/<?php echo $fotos['photoset']['photo'][0]['id']?>_<?php echo $fotos['photoset']['photo'][0]['secret']?>_m.jpg";
					var title="<?php echo $fotos['photoset']['photo'][0]['title']?>";
					if (flicker_array=='')
						flicker_array=flicker_array+'{"cdprojeto":<?php echo $projetos['cdprojeto']?>,"src_flicker":"'+src+'","title_flicker":"'+title+'"}';
					else
						flicker_array=flicker_array+',{"cdprojeto":<?php echo $projetos['cdprojeto']?>,"src_flicker":"'+src+'","title_flicker":"'+title+'"}';
					<?php
				}	
			}
			?>
			flicker_array = eval('['+flicker_array+']');
			//alert(flicker_array);
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

                var styles = [
                              {
                                stylers: [
                                <?php
                                if($view_cormapa!=''){
                                  echo '{ hue: "'.$view_cormapa.'" },';
                                  echo '{ saturation: 0 }';
                                }
                                ?>
                                  
                                ]
                              },{
                                featureType: "road",
                                elementType: "geometry",
                                stylers: [
                                  { lightness: 100 },
                                  { visibility: "simplified" }
                                ]
                              },{
                                featureType: "road",
                                elementType: "labels",
                                stylers: [
                                  { visibility: "off" }
                                ]
                              }
                            ];

                            map.setOptions({styles: styles});
                            

                
                mapMarkers(json_projetos);
			}
			
			function mapMarkers(beaches){
				if (typeof markers !='undefined'){
					for (var i = 0; i < markers.length; i++) {
						markerCluster.clearMarkers();
				    	markers[i].setMap(null);
					}
				}
				if (beaches.length>0){
					var latlngbounds = new google.maps.LatLngBounds();
					markers = [];
					for (var i = 0; i < beaches.length; i++) {
						if (beaches[i].latitude!=''){
							if (beaches[i].icone_mapa!=null){
								var image = '/<?php echo PROJETO;?>/inc/img/area/'+beaches[i].icone_mapa;
							}else{
								var image = '/<?php echo PROJETO;?>/inc/img/area/semcat_m.png';
							}
							
							var myLatLng = new google.maps.LatLng(beaches[i].latitude, beaches[i].longitude);
						    var marker = new google.maps.Marker({
						        position: myLatLng,
						        map: map,
						        title: beaches[i].intervencao,
								icon : image
						    });
							markers.push(marker);
							
							latlngbounds.extend(marker.position);
							
							var img_flicker="http://3.bp.blogspot.com/-RGcSnVormTw/TcmW7WcoOgI/AAAAAAAAAAc/lj7T2BDI_gI/s1600/canstock2467652.jpg";
							var title_flicker='';
							for (var j=0;j<flicker_array.length;j++){
								if (flicker_array[j].cdprojeto==beaches[i].cdprojeto){
									img_flicker=flicker_array[j].src_flicker;
									title_flicker=flicker_array[j].title_flicker;
								}
							}

							//alert(img_flicker);
							var contentString = '<div style="width:396px;">'+
												'<div class="balaomapa" >'+
								                '<div class="head_balao"><b>'+
								                beaches[i].intervencao+
								                '</b></div>'+
								                '<div class="con_mapa">'+
								                '<div class="esq_mapa">'+
								                '<ul> ' +
								                '<li><img src="/<?php echo PROJETO;?>/inc/img/home_min.png">&nbsp;'+ beaches[i].endereco +'</li>'+
								                '<li><img src="/<?php echo PROJETO;?>/inc/img/objt_min.png">&nbsp;'+ beaches[i].objetivo +'</li>'+
								                '<li><img src="/<?php echo PROJETO;?>/inc/img/cat_min.png">&nbsp;'+ beaches[i].descricao+'</li>'+
								                '</ul>'+
								                '</div>'+
								                '<div class="dir_mapa">'+
								                '<img src="'+img_flicker+'" title="'+title_flicker+'" width="140px">'+
								                '</div>'+
								                '<div class="clear"></div>'+
								                '<div class="foot_mapa" align="center">'+
								                '<a href="#p'+ beaches[i].cdprojeto +'" >+ informações</a>'+
								                '</div>'+
								                '</div>'+
								                '<div class="clear"></div>'+
								                '</div>'+
								                '</div>'
								                ;
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
					map.fitBounds(latlngbounds);
				}
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

			function filterPesquisaMapMarkers(){
				var pesquisar = document.getElementById('pesquisar').value;
				pesquisar = pesquisar.toLowerCase();
				var array_filter = [];
				for (var j=0; j < json_projetos.length; j++){
					var str = String(json_projetos[j].intervencao.toLowerCase());
					if (str.search(pesquisar)>=0){
						array_filter.push(json_projetos[j]);
					}
				}
				
				mapMarkers(array_filter);
			}
		</script>
        <script src="/<?php echo PROJETO;?>/inc/mapas/jquery-1.10.2.js">
        </script>
    </head>
    <body onload="initialize()">
    	<div id="preloader" align="center" style=""><img src="/<?php echo PROJETO;?>/inc/img/loadingmapa.gif"></div>
        <div class="container">
            <header class="clearfix topo">
                <?php echo '<div style="float:left; margin-right:15px;"><img src="/'.PROJETO.'/inc/img/cliente/c'.$view_cliente[0]['cdcliente'].'.png" height="40px" alt=""></div><h1>'.$view_cliente[0]['nome'].'</h1>'; ?>
                <nav class="" style="float: right; margin-right:10%; margin-top: -60px;">
                	<div id='cssmenu'>
						<ul>
						   <li class='active has-sub'><a href='#'><span>Informações</span></a>
						      <ul>
						      	<?php foreach ($view_consultas as $consultas) { ?>
						       <!--  <li><a href="/<?php echo PROJETO;?>/gconsulta/consultar/cliente/<?php echo $view_cliente[0]['sigla']?>/id/<?php echo $consultas['cdconsulta']?>" target="_BLANK"><span><?php echo $consultas['titulo'];?></span></a> -->
						         <li><a href="#<?php echo $consultas['cdconsulta']?>"><span><?php echo $consultas['titulo'];?></span></a>
						         </li>
						     	 <?php } ?>
						         <li><a href="#lista"><span>Lista</span></a>
                                <li><a href="#galeria"><span>Galeria</span></a>
                                 </li>
						      </ul>
						   </li>
						   <li><a href='#'><span>Contato</span></a></li>
						</ul>
						</div>
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
            </ul>
            <script>
                $(document).ready(function(){
                	$("#filter").hide();
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
                        $(".texto").html('<h4>Bem vindo ao sig</h4><?php echo $view_cliente[0]["texto"]?>');
                       $("#filter").hide();
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
                        $(".texto").html('<h4>Pesquisar</h4><input type="text" name="pesquisar" id="pesquisar" onkeydown="filterPesquisaMapMarkers(this);">');
                        $("#filter").hide();
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
                        $(".texto").html('');
                        $("#menulateral").show();
                        $("#filter").show();
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
                        $(".texto").html('<h4>�?reas</h4><a href="#"><img src="/<?php echo PROJETO;?>/inc/img/saude.jpg" class="mincir" width="64px"></a><img src="educacao.jpg" class="mincir" width="64px"><img src="saneamento.jpg" class="mincir" width="64px"> <img src="transporte.jpg" class="mincir" width="64px">');
                        $("#menulateral").show();
                        $("#filter").hide();
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
                   <?php echo $view_cliente[0]['texto']?>   
            </div>
						<div id="filter" class="testef" style="overflow:scroll;">
						<h4>Filtros</h4>
                        <div class='form-group'>
                        <label class='control-label'>Tipo</label>
                        <div class='controls'>
                        <div class='row'><div class='col-xs-12'><select data-placeholder="Selecione o tipo" class="chosen-select" multiple style="width:205px;" tabindex="4" id='cdtipo' name='m3cdtipo[]' onchange='filterMapMarkers();' multiple>
                        <option value=''></option>
                        <?php
                        foreach ($view_tipos as $tipos) {
                        	?>
							<option value='<?php echo $tipos['cdtipo']?>'><?php echo $tipos['nome']?></option>
							<?php 
                        } 
                        ?>						
						</select></div></div></div></div>

						
						<div class='form-group'>
						<label  class='control-label'>Area</label>
						<div class='controls'>
						<div class='row'><div class='col-xs-12'><select data-placeholder="Selecione a area" class="chosen-select" multiple style="width:205px;"multiple style="width:350px;" tabindex="4" id='cdarea' name='m3cdarea[]' onchange='filterMapMarkers();' multiple>
						<option value=''></option>
						<?php
                        foreach ($view_areas as $areas) {
                        	?>
							<option value='<?php echo $areas['cdarea']?>'><?php echo $areas['descricao']?></option>
							<?php 
                        } 
                        ?>
                        </select></div></div></div></div>

                      	
						<div class='form-group'>
						<label  class='control-label'>Instituicao</label>
						<div class='controls'>
						<div class='row'><div class='col-xs-12'><select data-placeholder="Selecione a instituição" class="chosen-select" multiple style="width:205px;" tabindex="4" id='cdinstituicao' name='m3cdinstituicao[]' onchange='filterMapMarkers();' multiple>
						<option value=''></option>
						<?php
						foreach ($view_instituicoes as $instituicoes) {
                        	?>
							<option value='<?php echo $instituicoes['cdinstituicao']?>'><?php echo $instituicoes['sigla']?> - <?php echo $instituicoes['nome']?></option>
							<?php 
                        } 
                        ?>
                        </select></div></div></div></div>

                      	
						<div class='form-group'>
						<label  class='control-label'>Fase</label>
						<div class='controls'>
						<div class='row'><div class='col-xs-12'><select data-placeholder="Selecione a fase" class="chosen-select" multiple style="width:205px;" tabindex="4" id='cdfase' name='m3cdfase[]' onchange='filterMapMarkers();' multiple>
						<option value=''></option>
						<?php
						foreach ($view_fases as $fases) {
                        	?>
							<option value='<?php echo $fases['cdfase']?>'><?php echo $fases['nome']?></option>
							<?php 
                        } 
                        ?>
                        </select></div></div></div></div>

                      	
						<div class='form-group'>
						<label  class='control-label'>Natureza</label>
						<div class='controls'>
						<div class='row'><div class='col-xs-12'><select data-placeholder="Selecione o Tipo" class="chosen-select" multiple style="width:205px;" tabindex="4" id='cdnatureza' name='m3cdnatureza[]' onchange='filterMapMarkers();' multiple>
						<option value=''></option>
						<?php
						foreach ($view_naturezas as $naturezas) {
                        	?>
							<option value='<?php echo $naturezas['cdnatureza']?>'><?php echo $naturezas['nome']?></option>
							<?php 
                        } 
                        ?>
                        </select></div></div></div></div>

                     
						<div class='form-group'>
						<label  class='control-label'>Municipio</label>
						<div class='controls'>
						<div class='row'><div class='col-xs-12'><select data-placeholder="Selecione a fase" class="chosen-select" multiple style="width:205px;" tabindex="4" id='cdmunicipio' name='m3cdmunicipio[]' onchange='filterMapMarkers();' multiple>
						<option value=''></option>
						<?php
						foreach ($view_municipios as $municipios) {
                        	?>
							<option value='<?php echo $municipios['cdmunicipio']?>'><?php echo $municipios['nome']?></option>
							<?php 
                        } 
                        ?>
                        </select></div></div></div></div>
									 
                    </div>

                </div>
        </div>
        <div id="map_canvas" style="padding-top:90px; width:100%; height:100%; ">
        
    </div>
       <script src="/<?php echo PROJETO;?>/inc/mapas/jquery-1.10.2.js" type="text/javascript"></script>
  <script src="/<?php echo PROJETO;?>/inc/mapas/chosen.jquery.js" type="text/javascript"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>

  <!-- Modal -->
<?php foreach ($view_consultas as $consultas) { ?>
<div class="modal" id="<?php echo $consultas['cdconsulta']?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-header">
      <h2><?php echo $consultas['titulo'];?></h2>
      <a href="#close" class="btn-close" aria-hidden="true">×</a> <!--CHANGED TO "#close"-->
    </div>
    <div class="modal-body">
      <p><iframe src="/<?php echo PROJETO;?>/gconsulta/consultar/cliente/<?php echo $view_cliente[0]['sigla']?>/id/<?php echo $consultas['cdconsulta']?>" style="width: 98%; min-height: 500px;" frameborder="0"></iframe></p>
    </div>
    <div class="modal-footer">
      <a href="#close" class="btn">Fechar</a>  <!--CHANGED TO "#close"-->
    </div>
    </div>
  </div>
  <?php } 

  foreach ($view_projetos as $projetos) { ?>
<div class="modal" id="p<?php echo $projetos['cdprojeto']?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-header">
      <h2><?php echo $projetos['intervencao'];?></h2>
      <a href="#close" class="btn-close" aria-hidden="true">×</a> <!--CHANGED TO "#close"-->
    </div>
    <div class="modal-body">
      <p><iframe src="/<?php echo PROJETO?>/mapas/visualiza/projeto/<?php echo $projetos['cdprojeto']?>" style="width: 98%; min-height: 500px;" frameborder="0"></iframe></p>
    </div>
    <div class="modal-footer">

      <a href="#close" class="btn">Fechar</a>  <!--CHANGED TO "#close"-->
    </div>
    </div>
  </div>
  <?php } 
?>
<div class="modal" id="lista" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-header">
      <h2>Listagem de Obras</h2>
      <a href="#close" class="btn-close" aria-hidden="true">×</a> <!--CHANGED TO "#close"-->
    </div>
    <div class="modal-body" style="overflow: auto;">
      <p>
<iframe src="/<?php echo PROJETO?>/mapas/teste/" style="width: 98%; min-height: 500px;" frameborder="0"></iframe>
    </p>
    </div>
    <div class="modal-footer">
<a href="#close" class="btn">Fechar</a>  <!--CHANGED TO "#close"-->
    </div>
    </div>
  </div>

  <div class="modal" id="galeria" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-header">
      <h2>Galeria</h2>
      <a href="#close" class="btn-close" aria-hidden="true">×</a> <!--CHANGED TO "#close"-->
    </div>
    <div class="modal-body">
       <p>
<iframe src="/<?php echo PROJETO?>/mapas/galeria/" style="width: 100%; min-height: 500px;" frameborder="0"></iframe>
    </p>
    </div>
    <div class="modal-footer">
      <a href="#close" class="btn">Fechar</a>  <!--CHANGED TO "#close"-->
    </div>
    </div>
  </div>
<?php
echo $view_rodape;?>
</div>
<!-- /Modal -->

    </body>
</html>
<?php 
//echo $json_projetos;
?>