<?php
error_reporting(E_ALL & ~E_NOTICE); //除了notice，都报错
session_start();
if($_SESSION['uid'] < 1)  die( "请先登录<script>location.href='user_login.php'</script>" );

//连接数据库
try
{
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=study;charset=utf8', 'root', 'root');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT `id`,`title`,`uid`,`create_at` FROM  `resume` WHERE `uid` = ? AND `is_deleted` != 1 ";
    $sth = $dbh->prepare($sql);
    $sth->execute([ $_SESSION['uid'] ] );
    $data = $sth->fetchAll(PDO::FETCH_ASSOC);
    
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
    <title>我的简历</title>
    <link rel="stylesheet" href="lib/main.css">
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="lib/main.js"></script>
</head>
<body>
    <div class="container">
        <?php include 'header.php';?>
        <h1>我的简历</h1>
        <ul class="resume-list">
            <?php foreach( $data as $key => $value ):?>
            <li>
                <?php if( !empty( $value ) ):?>
                    <a href="resume_detail.php?id=<?=$value['id']?>" class="title middle" ><?= $value['title']?></a>
                    <a href="resume_detail.php?id=<?=$value['id']?>" target="_blank"><img src="img/arrow_back_ios.png" alt="查看简历" title="查看简历"></a>
                    <a href="resume_edit.php?id=<?=$value['id']?>"><img src="img/createmode_editedit.png" alt="编辑简历" title="编辑简历"></a>
                    <a href="javascript:do_del(<?=$value['id']?>);void(0);"><img src="img/highlight_remove.png" alt="删除简历" title="删除简历"></a>
                <?php endif;?>    
            </li>
            <?php endforeach;?>
            <p><a href="resume_add.php" class="add_resume" ><img src="img/add.png" alt="添加简历">添加简历</a></p>
        </ul>
    </div>
</body>
</html>