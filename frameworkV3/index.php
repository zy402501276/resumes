<?php

include 'vendor/autoload.php';

$m = v( 'm' ) ? v( 'm' ) : 'default';
$m = ucfirst( strtolower( $m ) );
$a = v( 'a' ) ? v( 'a' ) : 'index';

$controller = "OriginFrame\\Controller\\".$m;

call_user_func( [ new $controller() , $a ] );


