<?php
error_reporting(E_ALL & ~E_NOTICE); //除了notice，都报错
session_start();
if($_SESSION['uid'] < 1)  die( "请先登录<script>location.href='user_login.php'</script>" );

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加简历</title>
    <link rel="stylesheet" href="lib/main.css">
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="lib/main.js"></script>
</head>
<body>
    <div class="container">
        <h1>添加简历</h1>
        <form action="resume_save.php" method="post" id="form_resume_add" onSubmit=" form_submit('form_resume_add');return false;">
            <div id="form_resume_add_notice" class="form_info full"></div>
            <p><input type="text" name="title" value="" placeholder="标题" class="full"></p>
            <p><textarea name="content" id="" cols="30" rows="15" value=""  placeholder="支持markdown语法" class="full" ></textarea></p>
            <p>
                <input type="submit"  value="保存" class="middle_btn" >
                <input type="button" value="返回上一页" onClick="javascript:history.go(-1)">
            </p>
            
        </form>
    </div>
</body>
</html>