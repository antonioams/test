<style>
.listait{
    width: 230px; 
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
.topoimp{
    display: none;
}

@media print {
    .topoimp{
    display: block;
    font-size: 12pt;
}
    .topoimp h1{
    font-size: 14pt;
}
    .listait{
    width: 205px; 
    height: 400px; 
    background: #fff; 
    border-radius: 5px; 
    border-color:#ccc; 
    border-style:solid; 
    padding:5px; 
    border-width:1px; 
    float:left; 
    margin-left: 15px; 
    margin-bottom:15px;
        font-family: arial;
        color: #383839;
        font-size: 14px;
}

    * { 
        background: transparent !important; 
        color: #000 !important; 
        text-shadow: none !important; 
        filter:none !important; 
        -ms-filter: none !important; 
    } 

    body {
        margin:0; 
        padding:0;
        line-height: 1.4em;
        font: 12pt Georgia, "Times New Roman", Times, serif;
        color: #000;
    }

    @page {
        margin: 1.5cm;
    }

    .wrap { 
        width: 100%; 
        margin: 0; 
        float: none !important; 
    }

    .no-print, nav, footer, video, audio, object, embed { 
        display:none; 
    }

    .print {
        display: block;
    }

    img {
        max-width: 100%;
    }

    aside {
        display:block;
        page-break-before: always;
    }

    h1 {
        font-size: 24pt;
    }

    h2 {
        font-size: 18pt;
    }

    h3 {
        font-size: 14pt;
    }
    
    p {
        font-size: 12pt;
        widows: 3;
        orphans: 3;
    }

    a, a:visited {
        text-decoration: underline;
    }

    a:link:after, a:visited:after { 
        content: " (" attr(href) ") ";
    }

    p a {
        word-wrap: break-word;
    }

    q:after {
        content: " (" attr(cite) ")"
    }

    a:after, a[href^="javascript:"]:after, a[href^="#"]:after { 
        content: ""; 
    }  

    .page-break { 
        page-break-before: always; 
    }
    
    /*Estilos da Demo*/
    .header.print h1{
        width: 100%;
        margin-bottom: 0.5cm;
        font-size: 18pt;
    }

    .header.print:after {
        content: "Este artigo foi escrito pela designer Dani Guerrato e retirado do site Tableless.";
    }

    .artigo {
        margin-top: 0;
        border-top: 1px solid #000;
        padding-top: 1cm;
    }

    h1 a:link:after, h1 a:visited:after { 
        content: ""; 
    }
.divFooter {
            position: fixed;
            bottom: 0;
        }
}
</style>
<button class="btn btn-default btn-sm mr5 no-print" type="button" onclick="window.print()">
                                            Imprimir
                                            <i class="fa fa-print ml5"></i>
                                        </button>
<?php

        include('app/views/topop.php');
         foreach ($view_listagaleria as $item) {
            ?>
            <div class="listait">
    <?php
   // $fotos=array(str_replace(array('{','}'),'',$item['texto']));
        if(array_key_exists("texto",$item[0])){
        $foto=explode(',',$item[0]['texto']);
        $img='';
        $src="http://farm".$foto[3].".static.flickr.com/".$foto[1]."/".$foto[0]."_".$foto[2]."_m.jpg";
        $img.="<img title='".$foto[4]."' src='".$src."' alt='' class='img-thumbnail'>";
         echo $img;
}else{
    echo "<img title='sem imagem' src='/".PROJETO."/inc/img/semfoto.jpg' alt='' class='img-thumbnail'>";
}
    ?>
    <h4><?php echo $item[0]['intervencao'];?></h4>
    <ul>
        <li>
            <b>Objetivo:</b>
            <?php echo $item[0]['objetivo'];?>
        </li>
        <li>
            <b>Área:</b> <?php echo $item[0]['area_nome'];?>
        </li>
        <li>
            <b>Municipio:</b> <?php echo $item[0]['municipio_nome'];?>
        </li>
        <li>
            <b>Fase:</b> <?php echo $item[0]['fase_nome'];?>
        </li>

    </ul>
</div>
<?php

         }


        ?>



                    <!-- /inner content wrapper -->
<?php
include('app/views/rodape.php');
?>
