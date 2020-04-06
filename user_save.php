<?php
// session_start();
// if( $_SESSION['uid']  < 1 )
// {
//     header("Location: user_login.php");
//     die("<a href='user_login.php'>请先登入再添加简历</a>");
// }

//获取参数

$email = trim( $_REQUEST['email'] );
$password = trim( $_REQUEST['password'] );
$password2 = trim( $_REQUEST['password2'] );

//参数检测

if( strlen( $email ) < 1 ) die( "Email地址不能为空" );
if( strlen( $password ) < 6 ) die( "密码不能少于6个字符" );
if( strlen( $password ) > 12 ) die( "密码不能长于12个字符" );
if( strlen( $password2 ) < 1 ) die( "重复密码不能为空" );

if( $password2 != $password2 ) die( "两次输入密码不一致" );

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) die( "邮箱格式不正确" );
//连接数据库
try {
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=study', 'root', 'root');
    $dbh->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
    $sql = "INSERT INTO `user` ( `email` , `password` , `create_at` ) VALUES ( ? , ? , ?)";
    $stmt = $dbh->prepare( $sql );
    //$stmt->execute( [ $email , password_hash( $password , PASSWORD_DEFAULT), date( "Y-m-d H:i:s" ) ] );
    $stmt->bindParam( 1 , $email );
    $stmt->bindParam( 2 , password_hash( $password , PASSWORD_DEFAULT ) );
    $stmt->bindParam( 3 , date( "Y-m-d H:i:s" ) );
    $stmt->execute();
    // header("Location: user_login.php");
    // die("注册成功");？？？？为什么不会转向呢 php页面转向直接对ajax组件产生了影响
    die("<script>location='user_login.php' </script>");
    
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