<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="lib/bootstrap-4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">

    <title>用户登入</title>
  </head>
  <body>
    <div class="container">
        <?php $is_login = false; include 'header.php'; ?>

        <div class="page-box">
        <h1>用户登入</h1>   
        <form action="user_login_check.php" method="post" id="form_login" onsubmit="send_form('form_login');return false;" >
            <div id="form_login_notice" class="form_info middle"></div>
            <div class="form-group">
                <input type="text" name="email" placeholder="Email" class="form-control" >
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="密码（6~12个字符）" class="form-control" >
            </div>

            <button type="submit" class="btn btn-primary">登录</button>
           
        </form>  
        </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="lib/bootstrap-4.4.1/dist/js/bootstrap.min.js"></script>
  </body>
</html>