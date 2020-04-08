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

function g( $key )
{
    
    return isset( $GLOBALS[$key] ) ? $GLOBALS[$key] : false;
}


function render( $data , $template=null ){
    if($html = befor_render( $data , $template ) ) echo $html;
}

function befor_render( $data , $template=null )
{   
    if( empty( $template ))
        $file = VIEW.DS.g('class').'_'.g('action').".tpl.php";
    if( !file_exists( $file ) ) 
        throw new Exception("模板不存在!");
    ob_start();
    extract( $data );
    require $file;
     $output = ob_get_contents();
     ob_end_clean();
     return $output;

}

function e( $message )
{
    throw new Exception( $e );
}

function pdo()
{

    if( !isset( $GLOBALS['PDO'] ) )
    {
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=study', 'root', 'root');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        $GLOBALS['PDO'] = $dbh;
    }
    
    return $GLOBALS['PDO'];

}

function get_data( $sql , $data=null )
{

    $dbh = pdo();

    $sth = $dbh->prepare($sql);
    $sth->execute($data);
    $data = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $data;

}