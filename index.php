<?php
session_start();

$is_login = $_SESSION['uid']  < 1 ? false : true;


try {
    $dbh = new PDO('mysql:host=mysql.ftqq.com;dbname=fangtangdb', 'php', 'fangtang');
    $dbh->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT  `id` ,  `title` , `content` , `uid` , `create_at`  FROM `resume` WHERE `is_deleted` != 1";
    $stmt = $dbh->prepare( $sql );
    //$stmt->execute( [ $email , password_hash( $password , PASSWORD_DEFAULT), date( "Y-m-d H:i:s" ) ] );
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
    <title>放糖简历</title>
    <link rel="stylesheet" href="main.css">
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
    <div class="container">
        <?php include_once 'header.php'?>
        <h1>简历中心</h1> 
        <?php if( $resume_list ):?>
        <ul class="resume_list">
            <?php foreach( $resume_list as $item ):?>    
                <li id="del_target_<?=$item['id']?>">
                    <a href="resume_detail.php?id=<?=$item['id']?>" class="title middle" target="_blank"><?=$item['title'];?></a> 
                    <a href="resume_detail.php?id=<?=$item['id']?>" target="_blank"><img src="img/arrow_back.png" alt="查看"></a>
                </li>
            <?php endforeach;?>
        </ul>
        <?php endif;?>    
    </div>
</body>
</html>