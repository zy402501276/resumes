<?php
namespace OriginFrame\Controller;

class User
{
    public function login()
    {
      $data['title']="哈哈哈哈😁";
      render($data);
    }

    public function login_check()
    {
        $email = trim( v('email') );
        $password = trim( v('password') );

        //参数校验

        if( strlen( $email ) < 1 ) e( "请输入邮箱" );
        if( strlen( $password ) < 1 ) e( "请输入密码" );

        $sql = "SELECT * FROM `user` WHERE `email` = ? LIMIT 1";

        $data = get_data($sql,[$email]);
        if( $data)
        {
            $user_list = $data[0];
        }

        if ( !password_verify( $password, $user_list['password'] ) ) e( "账号或者密码错误" );
    
        session_start();
        $_SESSION['uid'] = $user_list['id'];
        $_SESSION['email'] = $user_list['email'];

        //转向到登录页面
        die( "登录成功<script>location.href='resume_add.php'</script>" );

    }
}