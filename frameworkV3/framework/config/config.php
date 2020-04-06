<?php

$GLOBALS['ORIGIN']['MYSQL_HOST']     = '127.0.0.1';
$GLOBALS['ORIGIN']['MYSQL_USER']     = 'root';
$GLOBALS['ORIGIN']['MYSQL_PASSWORD'] = 'root';
$GLOBALS['ORIGIN']['MYSQL_DBNAME']   = 'study';
$GLOBALS['ORIGIN']['MYSQL_CHARSET']  = 'utf8';
$GLOBALS['ORIGIN']['MYSQL_PORT']     = 3306;
$GLOBALS['ORIGIN']['MYSQL_PDO']      = 'mysql:host='.$GLOBALS['ORIGIN']['MYSQL_HOST'] .';dbname='.$GLOBALS['ORIGIN']['MYSQL_DBNAME'].
                                       ';port='.$GLOBALS['ORIGIN']['MYSQL_PORT'].';charset='.$GLOBALS['ORIGIN']['MYSQL_CHARSET'] ;