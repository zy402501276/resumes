<?php
session_start();
if( $_SESSION['uid']  < 1 )
{
    header("Location: user_login.php");
    die("<a href='user_log.php'>请先登入再浏览简历</a>");
}
try {
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=resume', 'root', 'root');
    $dbh->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT  `id` ,  `title` , `content` , `uid` , `create_at`  FROM `resume` WHERE `uid` = ? AND `is_deleted` != 1";
    $stmt = $dbh->prepare( $sql );
    //$stmt->execute( [ $email , password_hash( $password , PASSWORD_DEFAULT), date( "Y-m-d H:i:s" ) ] );
    $stmt->bindParam( 1 , $_SESSION['uid'] );
    $stmt->execute();
    $resume_list = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    
} 
catch ( Execption $e)  
{
    die($e->getMessage());
    
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>我的简历</title>
    <link rel="stylesheet" href="main.css">
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
    <div class="container">
    <?php $is_login = true ;  include_once 'header.php'?>
        <h1>我的简历</h1> 
        <?php if( $resume_list ):?>
        <ul class="resume_list">
            <?php foreach( $resume_list as $item ):?>    
                <li id="del_target_<?=$item['id']?>">
                    <a href="resume_detail.php?id=<?=$item['id']?>" class="title middle" target="_blank"><?=$item['title'];?></a> 
                    <a href="resume_detail.php?id=<?=$item['id']?>" target="_blank"><img src="img/arrow_back.png" alt="查看"></a>
                    <a href="resume_update.php?id=<?=$item['id']?>"><img src="img/createmode_editedit.png" alt="修改"></a>
                    <a href="javascript:confirm_delete(<?=$item['id']?>);void(0)"><img src="img/remove_circle_outline.png" alt="删除"></a>
                </li>
            <?php endforeach;?>
        </ul>
        <?php endif;?>    
        <p><a href="resume_add.php" class="resume_add"><img src="img/add.png" alt="添加">添加简历</a></p>
    </div>
</body>
</html>