<?php
    session_start();
    if( $_SESSION['uid']  < 1 )
    {
        header("Location: user_login.php");
        die("<a href='user_log.php'>请先登入再添加简历</a>");
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加简历</title>
    <link rel="stylesheet" href="main.css">
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
    <div class="container">
    <?php $is_login = true ;  include_once 'header.php'?>
        <h1>添加简历</h1> 
        <form action="resume_save.php" method="post" id="form_resume" onsubmit="send_form('form_resume');return false;" >
            <div id="form_resume_notice" class="form_info full"></div>
            <p><input type="text" name="title" placeholder="简历的名称" class="full"></p>
            <p><textarea name="content" placeholder="写入简历内容，支持markdown语法" cols="30" rows="10" class="full"></textarea></p>
            <p><input type="submit" value="保存" class="middle-button"></p>
        </form>
    </div>
</body>
</html>