<?php 
    include('../classes/adminlogin.php');

    $class = new adminlogin();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $adminUser = $_POST['adminUser'];
        $adminPass = md5($_POST['adminPass']);

        $login_check = $class->login_admin($adminUser,$adminPass);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập QTV</title>
  <link rel="stylesheet" href="../css/login.css" />
  <script type="text/javascript" src="../js/login.js" ></script>
</head>
<body>
    <div class="login-container">
      <section class="login" id="login">
        <header>
          <h2 class="h2">Quản trị viên</h2>
          <span style="font-size: 10px;"><?php 
              if(isset($login_check)){
                echo $login_check;
              }
          ?></span>
        </header>
        <form class="login-form" action="" method="POST">
          <input type="text" class="login-input" placeholder="Tên đăng nhập" name="adminUser" required autofocus/>
          <input type="password" class="login-input" placeholder="Mật khẩu" name="adminPass" required/>
          <div class="submit-container">
            <button type="submit" class="login-button">Đăng nhập</button>
          </div>
        </form>
      </section>
    </div>
</body>
</html>