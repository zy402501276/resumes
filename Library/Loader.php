<?php

namespace Library;

class Loader
{
    static function origin_autoload( $class )
    {
        echo $class;
       // include_once ROOT."/".$class.".php";
    }
}

