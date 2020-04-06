<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户注册</title>
    <link rel="stylesheet" href="lib/bootstrap-4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="lib/bootstrap-4.4.1/dist/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
    <div class="container">
        <h1>用户注册</h1>   
        <form action="user_save.php" method="post" id="form_reg" onsubmit="send_form('form_reg');return false;" >
            <div id="form_reg_notice" class="form_info middle"></div>
            <div class="form-group  col-md-3">
            <p><input type="text" name="email" placeholder="Email" class=" form-control "></p>
            </div>
            <div class="form-group col-md-3">
            <p><input type="password" name="password" placeholder="密码（6~12个字符）" class="form-control"></p>
            </div>
            <div class="form-group col-md-3">
            <p><input type="password" name="password2" placeholder="重复密码" class="form-control "></p>
            </div>
            <button type="submit" class="btn btn-primary btn-success">注册</button>
        </form>
    </div>
</body>
</html>