<?php

define( "DS" , DIRECTORY_SEPARATOR );
define( "ROOT" , __DIR__ );
define( "FRAMEWORK" , ROOT.DS."framework" );
define( "VIEW" , FRAMEWORK.DS."view" );
define("STATIC",FRAMEWORK.DS.'static');


include 'vendor/autoload.php';

$GLOBALS['class'] = $m = v( 'm' ) ? v( 'm' ) : 'default';
$m = ucfirst( strtolower( $m ) );
$GLOBALS['action'] = $a = v( 'a' ) ? v( 'a' ) : 'index';

try
{
    $controller = "OriginFrame\\Controller\\".$m;

    call_user_func( [ new $controller() , $a ] );
}
catch( Exception $e)
{
    die( $e->getMessage() );
}




