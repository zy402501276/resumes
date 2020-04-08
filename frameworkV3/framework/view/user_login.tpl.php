<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户登录</title>
    <link rel="stylesheet" href="framework/static/main.css">
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="framework/static/main.js"></script>
</head>
<body>
    <div class="container">
        <h1><?= $title?></h1>
        <form action="index.php?m=user&a=login_check" method="post" id="form_login" onSubmit=" form_submit('form_login');return false;">
            <div id="form_login_notice" class="form_info middle"></div>
            <p><input type="text" name="email" value="" placehoder="邮箱" class="middle"></p>
            <p><input type="password" name="password" value="" placehoder="密码" class="middle"></p>
            <p><input type="submit"  value="登录" class="middle_btn" ></p>
        </form>
    </div>
</body>
</html>