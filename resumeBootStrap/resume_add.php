<?php
    session_start();
    if( $_SESSION['uid']  < 1 )
    {
        header("Location: user_login.php");
        die("<a href='user_log.php'>请先登入再添加简历</a>");
    }

?><!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="lib/bootstrap-4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">

    <title>添加简历</title>
  </head>
  <body>
    <div class="container">
        <?php $is_login = false; include 'header.php'; ?>

        <div class="page-box">
        <h1>添加简历</h1>   
        <form action="resume_save.php" method="post" id="form_resume" onsubmit="send_form('form_resume');return false;" >
            <div id="form_resume_notice" class="form_info middle"></div>
            <div class="form-group">
            <input type="text" name="title" placeholder="简历的名称"  class="form-control" >
            </div>

            <div class="form-group">
            <textarea name="content" placeholder="写入简历内容，支持markdown语法" cols="30" rows="10"class="form-control"></textarea></p>
            </div>

            <button type="submit" class="btn btn-primary btn-lg">保存简历</button>
            <button type="button" class="btn btn-dark float-right btn-lg" onclick="javascript:history.go(-1);void(0);">后退</button>
           
        </form>  
        </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="lib/bootstrap-4.4.1/dist/js/bootstrap.min.js"></script>
  </body>
</html>