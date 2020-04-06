<?php
error_reporting(E_ALL & ~E_NOTICE); //除了notice，都报错
session_start();
if($_SESSION['uid'] < 1)  die( "请先登录<script>location.href='user_login.php'</script>" );

//获取数据
$id = trim( $_REQUEST['id'] );

//连接数据库
try
{
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=study;charset=utf8', 'root', 'root');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT `title`,`content`,`uid`,`id` FROM  `resume` WHERE `uid` = ? AND `id` = ?";
    $sth = $dbh->prepare($sql);
    $sth->execute([ $_SESSION['uid'] , $id ] );
    $data = $sth->fetch(PDO::FETCH_ASSOC);
    
    if( empty( $data ) ) die( "简历信息不存在！<script>location.href='resume_list.php'</script>" );
    
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
    <title>修改简历</title>
    <link rel="stylesheet" href="lib/main.css">
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="lib/main.js"></script>
</head>
<body>
    <div class="container">
        <h1>修改简历</h1>
        <form action="resume_update.php" method="post" id="form_resume_update" onSubmit=" form_submit('form_resume_update');return false;">
            <input type="hidden" name="uid" value="<?=$data['uid']?>">
            <input type="hidden" name="id" value="<?=$data['id']?>">
            <div id="form_resume_update_notice" class="form_info full"></div>
            <p><input type="text" name="title" value="<?=$data['title']?>" placeholder="标题" class="full"></p>
            <p><textarea name="content" id="" cols="30" rows="15" value=""  placeholder="支持markdown语法" class="full" ><?=$data['content']?></textarea></p>
            <p>
                <input type="submit"  value="保存" class="middle_btn" >
                <input type="button" value="返回上一页" onClick="javascript:history.go(-1)">
            </p>
            
        </form>
    </div>
</body>
</html>