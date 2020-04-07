<nav class="navbar navbar-expand-lg navbar-light bg-light title">
  <a class="navbar-brand" href="#">
    <img src="img/logo.png" height="50" alt="LOGO">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <?php if( $is_login ):?>
        <li class="nav-item"> <a class="nav-link" href="resume_list.php"><span class="menu-square"></span>我的简历</a></li>
        <li class="nav-item"> <a class="nav-link" href="#" onclick="user_logout();void(0);"><span class="menu-square"></span>注销</a></li>
      <?php else:?>
        <li class="nav-item"><a class="nav-link" href="user_reg.php"><span class="menu-square"></span>注册</a></li>
        <li class="nav-item"> <a class="nav-link" href="user_login.php" onclick="user_logout();void(0);"><span class="menu-square"></span>登录</a></li>
      <?php endif;?>    
    </ul>
  </div>
</nav>