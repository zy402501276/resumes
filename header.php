<div class="headerbox">
            <div class="logo"><a href="resume.php"><img src="img/logo.png" alt="logo"></a></div>
            <ul class="menu">
                <?php if( $is_login ):?>
                <li><span class="menu_square"></span> <a href="resume_list.php">我的简历</a></li>
                <li><span class="menu_square"></span> <a href="user_login.php">注销</a></li>
                <?php else:?>
                    <li><span class="menu_square"></span> <a href="user_reg.php"></a></li>
                    <li><span class="menu_square"></span> <a href="user_login.php">登入</a></li>
                <?php endif;?>             
            </ul>
        </div>