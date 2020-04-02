<?php

//获取参数

$email = trim( $_REQUEST['email'] );
$password = trim( $_REQUEST['password'] );
$pwdrepeat = trim( $_REQUEST['pwdrepeat'] );

//参数校验

if( strlen( $email ) < 1 ) die( "请输入邮箱" );
if( strlen( $password ) < 1 ) die( "请输入密码" );
if( strlen( $pwdrepeat ) < 1 ) die( "请输入重复密码" );

if( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) die("邮箱格式不正确");
if( strlen( $password ) < 6 ) die("密码必需在6~12位");
if( strlen( $password ) > 12 ) die("密码必需在6~12位");
if( $password != $pwdrepeat ) die( '两次输入密码不一致' );

//连接数据库
try
{
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=study', 'root', 'root');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `user` ( `email` , `password` , `create_at` ) VALUES ( ? , ? , ? )";
    $sth = $dbh->prepare($sql);
    $sth->execute([$email , password_hash($password,PASSWORD_BCRYPT) , date("Y-m-d H:i:s" , time())] );

    //转向到登录页面
    die( "账号创建成功<script>location.href='user_login.php'</script>" );

}
catch(PDOException $e)
{
     $errorinfo = $sth->errorInfo();
     if( $errorinfo[1] == 1062 ) die( "账号已存在" );
}
catch( Exception $e)
{
    die( $e->getMessage() );
}