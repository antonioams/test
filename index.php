<?php
    define( 'CONTROLLERS','app/controllers/' );
    define( 'VIEWS','app/views/' );
    define( 'MODELS','app/models/' );
    define( 'HELPERS','system/helpers/' );
    define( 'PROJETO','sig' );

    require_once('system/system.php');
    require_once('system/controller.php');
    require_once('system/model.php');
    require_once('system/modelpub.php');
    require_once('system/modelmapa.php');
    
    function __autoload( $file ){
        if ( file_exists(MODELS . $file . '.php') )
            require_once( MODELS . $file . '.php' );
        else if ( file_exists(HELPERS . $file . '.php') )
            require_once( HELPERS . $file . '.php' );

    }

    $start = new System;
    $start->run();