<?php
include_once 'lib/Parsedown.php';

error_reporting(E_ALL & ~E_NOTICE); //除了notice，都报错
session_start();
if($_SESSION['uid'] < 1)  die( "请先登录<script>location.href='user_login.php'</script>" );

//获取数据
$id = trim( $_REQUEST['id'] );

//连接数据库
try
{
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=study', 'root', 'root');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT `title`,`content` FROM  `resume` WHERE `uid` = ? AND `id` = ?";
    $sth = $dbh->prepare($sql);
    $sth->execute([ $_SESSION['uid'] , $id ] );
    $data = $sth->fetch(PDO::FETCH_ASSOC);

    if( empty( $data ) ) die( "简历信息不存在！<script>location.href='resume_list.php'</script>" );


    $Parsedown = new Parsedown();

    $markdown = $Parsedown->text($data['content']);
    
}
catch(PDOException $e)
{
    die( $e->getMessage() );
}
catch( Exception $e)
{
    die( $e->getMessage() );
}


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link rel="stylesheet" href="lib/main.css">
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="lib/main.js"></script>
</head>
<body>
    <div class="container">
        <?= $markdown?>
    </div>
</body>
</html>