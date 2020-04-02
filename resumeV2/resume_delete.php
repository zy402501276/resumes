<?php
session_start();
if($_SESSION['uid'] < 1)  die( "请先登录<script>location.href='user_login.php'</script>" );




//获取参数

$id = trim( $_REQUEST['id'] );

//参数校验

if( strlen( $id ) < 1 ) die( "请正确传参" );

//连接数据库
try
{
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=study;charset=utf8', 'root', 'root');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE `resume` SET `is_deleted` = ? , `create_at` = ?  WHERE  `id` = ?";
    $sth = $dbh->prepare($sql);
    $sth->execute([ 1 , date("Y-m-d H:i:s" , time()) , $id ] );

    //转向到登录页面
    die( "简历删除成功" );

}
catch(PDOException $e)
{
     $errorinfo = $sth->errorInfo();
     if( $errorinfo[1] == 1062 ) die( "简历已存在" );
}
catch( Exception $e)
{
    die( $e->getMessage() );
}