<?php
session_start();

$id = intval( trim( $_REQUEST['id'] ) );

try {
    $dbh = new PDO('mysql:host=mysql.ftqq.com;dbname=fangtangdb', 'php', 'fangtang');
    $dbh->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT * FROM `resume` WHERE `id` = ? LIMIT 1";
    $stmt = $dbh->prepare( $sql );
    //$stmt->execute( [ $email , password_hash( $password , PASSWORD_DEFAULT), date( "Y-m-d H:i:s" ) ] );
    $stmt->bindParam( 1 , $id );
    $stmt->execute();
    $resume = $stmt->fetch( PDO::FETCH_ASSOC );

    if( $resume['uid'] != $_SESSION['uid'] ) die("只能修改自己的简历");
    // header("Location: user_login.php");
    // die("注册成功");？？？？为什么不会转向呢 php页面转向直接对ajax组件产生了影响
   
} 
catch( Exception $e ) {
    echo $e->getMessage();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改简历</title>
    <link rel="stylesheet" href="main.css">
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
    <div class="container">
        <h1>修改简历</h1> 
        <form action="resume_edit.php" method="post" id="form_resume" onsubmit="send_form('form_resume');return false;" >
            <div id="form_resume_notice" class="form_info full"></div>
            <p><input type="text" name="title" placeholder="简历的名称" class="full" value="<?=$resume['title']?>"></p>
            <p><textarea name="content" placeholder="写入简历内容，支持markdown语法" cols="30" rows="10" class="full" ><?= htmlspecialchars($resume['content'])?></textarea></p>
            <input type="hidden" name="id" value="<?=$id?>">
            <p><input type="submit" value="保存" class="middle-button"></p>
        </form>
    </div>
</body>
</html>