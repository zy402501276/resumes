<?php
error_reporting(E_ALL & ~E_NOTICE); //除了notice，都报错
session_start();

$id = trim( $_REQUEST['id'] );
$uid = trim( $_REQUEST['uid'] );

if($_SESSION['uid'] < 1)  die( "请先登录<script>location.href='user_login.php'</script>" );
if($_SESSION['uid'] != $uid)  die( "只能修改自己的简历<script>location.href='resume_list.php'</script>" );

//获取参数

$title = trim( $_REQUEST['title'] );
$content = trim( $_REQUEST['content'] );


//参数校验

if( mb_strlen( $title ) < 1 ) die( "请输入简历标题" );
if( mb_strlen( $content ) < 1 ) die( "请输入内容" );

if( mb_strlen( $title ) < 6 ) die( "简历标题不少于6个字符" );
if( mb_strlen( $content ) < 10 ) die( "简历不少于10个字符" );

//连接数据库
try
{
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=study;charset=utf8', 'root', 'root');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE `resume` SET `title` = ?, `content` = ? , `create_at` = ? WHERE `id` = ?";
    $sth = $dbh->prepare($sql);
    $sth->execute([ $title , $content , date("Y-m-d H:i:s" , time()) , $id ]);

    //转向到登录页面
    die( "简历修改成功<script>location.href='resume_list.php'</script>" );

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