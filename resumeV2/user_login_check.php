<?php

//获取参数

$email = trim( $_REQUEST['email'] );
$password = trim( $_REQUEST['password'] );

//参数校验

if( strlen( $email ) < 1 ) die( "请输入邮箱" );
if( strlen( $password ) < 1 ) die( "请输入密码" );

//连接数据库
try
{
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=study', 'root', 'root');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `user` WHERE `email` = ? LIMIT 1";
    $sth = $dbh->prepare($sql);
    $sth->execute([$email]);
    $data = $sth->fetch(PDO::FETCH_ASSOC);

    if ( !password_verify( $password, $data['password'] ) ) die( "账号或者密码错误" );
    
    session_start();
    $_SESSION['uid'] = $data['id'];
    $_SESSION['email'] = $data['email'];

    //转向到登录页面
    die( "登录成功<script>location.href='resume_add.php'</script>" );

}
catch(PDOException $e)
{
    die( $e->getMessage() );
}
catch( Exception $e)
{
    die( $e->getMessage() );
}