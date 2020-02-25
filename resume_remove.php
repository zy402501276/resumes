<?php
session_start();
if( $_SESSION['uid']  < 1 )
{
    header("Location: user_login.php");
    die("<a href='user_log.php'>请先登入再添加简历</a>");
}


error_reporting(E_ALL & ~E_NOTICE);

//获取参数
$id = intval( $_REQUEST['id'] );


//参数检测
if( strlen( $id ) < 1 ) die( "id不能为空" );
//连接数据库

try {
    $dbh = new PDO('mysql:host=mysql.ftqq.com;dbname=fangtangdb', 'php', 'fangtang');
    $dbh->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
    $sql = "UPDATE `resume` SET `is_deleted` = ? , `title` = CONCAT( `title` , ? ), `create_at` = ? WHERE `id` = ?  AND `uid` = ? LIMIT 1";
    $stmt = $dbh->prepare( $sql );
    //$stmt->execute( [ $email , password_hash( $password , PASSWORD_DEFAULT), date( "Y-m-d H:i:s" ) ] );
    $del = 1;
    $time = "_del_".time();
    $datetime = date( "Y-m-d H:i:s",time() );
    $uid = $_SESSION['uid'];
    
    $stmt->bindParam( 1 , $del ); //bindParm的第二个参数一定要为变量。！！！！
    $stmt->bindParam( 2 ,  $time);
    $stmt->bindParam( 3 , $datetime );
    $stmt->bindParam( 4, $id );
    $stmt->bindParam( 5 , $uid );
    $stmt->execute();
    // header("Location: user_login.php");
    // die("注册成功");？？？？为什么不会转向呢 php页面转向直接对ajax组件产生了影响
    //header("Location: resume_list.php");  
    die("done");
} 
catch( Exception $e ) {
    die($e->getMessage());
}