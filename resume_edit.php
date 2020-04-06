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
$title = trim( $_REQUEST['title'] );
$content = trim( $_REQUEST['content'] );

//参数检测
if( strlen( $id ) < 1 ) die( "id不能为空" );
if( strlen( $title ) < 1 ) die( "简历标题不能为空" );
if( strlen( $content ) < 6 ) die( "简历内容不能少于10个字符" );

//连接数据库

try {
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=study', 'root', 'root');
    $dbh->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
    $sql = "UPDATE `resume` SET `title` = ? , `content` = ? , `create_at` = ? WHERE `id` = ?  AND `uid` = ? LIMIT 1";
    $stmt = $dbh->prepare( $sql );
    //$stmt->execute( [ $email , password_hash( $password , PASSWORD_DEFAULT), date( "Y-m-d H:i:s" ) ] );
    $stmt->bindParam( 1 , $title );
    $stmt->bindParam( 2 , $content );
    $stmt->bindParam( 3 , date( "Y-m-d H:i:s" ) );
    $stmt->bindParam( 4 , $id );
    $stmt->bindParam( 5 , $_SESSION['uid'] );
    $stmt->execute();
    // header("Location: user_login.php");
    // die("注册成功");？？？？为什么不会转向呢 php页面转向直接对ajax组件产生了影响
    //header("Location: resume_list.php");  
    die("<script>location='resume_list.php'</script>");
} 
catch ( PDOException $e)  
{
    $errorInfo = $stmt->errorInfo();
    if( $errorInfo[1] == 1062 ) 
    {
        die("简历名称已存在");
    }
  
}
catch( Exception $e ) {
    echo $e->getMessage();
}