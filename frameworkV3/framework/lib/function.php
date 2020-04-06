<?php

function action_class( $link )
{
    if( $link == ltrim( $_SERVER['SCRIPT_NAME'] , '/' ) )
    {
        return "active";
    }
}

function c( $key )
{
    return isset( $GLOBALS['ORIGIN'][$key] ) ? $GLOBALS['ORIGIN'][$key] : false;
}

function v( $key )
{
    
    return isset( $_REQUEST[$key] ) ? $_REQUEST[$key] : false;
}