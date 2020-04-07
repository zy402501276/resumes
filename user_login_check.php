<?php
error_reporting(E_ALL & ~E_NOTICE);

//获取参数

$email = trim( $_REQUEST['email'] );
$password = trim( $_REQUEST['password'] );

//参数检测

if( strlen( $email ) < 1 ) die( "Email地址不能为空" );
if( strlen( $password ) < 6 ) die( "密码不能少于6个字符" );
if( strlen( $password ) > 12 ) die( "密码不能长于12个字符" );

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) die( "邮箱格式不正确" );
//连接数据库

try {
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=resume', 'root', 'root');
    $dbh->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT * FROM `user` WHERE `email` = ? LIMIT 1";
    $stmt = $dbh->prepare( $sql );
    //$stmt->execute( [ $email , password_hash( $password , PASSWORD_DEFAULT), date( "Y-m-d H:i:s" ) ] );
    $stmt->bindParam( 1 , $email );
    $stmt->execute();
    $user = $stmt->fetch( PDO::FETCH_ASSOC );

    if( ! password_verify( $password , $user['password'] ) ){
        die("用户名或者密码错误");
    }

    session_start();
    $_SESSION['email'] = $user['email'];
    $_SESSION['uid'] = $user['id'];

    // header("Location: user_login.php");
    // die("注册成功");？？？？为什么不会转向呢 php页面转向直接对ajax组件产生了影响
    die("<script>location='resume_list.php' </script>");
    
} 
catch ( PDOException $e)  
{
    $errorInfo = $stmt->errorInfo();
    if( $errorInfo[1] == 1062 ) 
    {
        die("Email地址已经被注册");
    }
    
}
catch( Exception $e ) {
    echo $e->getMessage();
}