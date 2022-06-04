<?php
    include('lib/session.php');
    Session::init();

    include_once('lib/database.php');
    include_once('helpers/format.php');

    spl_autoload_register(function($className){
        include_once "classes/".$className.".php";
    });

    $db = new Database();
    $fm = new Format();
    $ct = new cart();
    $cs = new customer();
    $cat = new category();
    $product = new product();
    $brand = new brand();
?>
<?php 
  $login_check = Session::get('customer_login');
  if($login_check){
    header('Location: order.php');
  }
?>
<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])){
      $login_customers = $cs->login_customers($_POST);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập</title>
  <link rel="stylesheet" href="css/login.css" />
  <script type="text/javascript" src="js/login.js" ></script>
</head>
<body>
    <div class="login-container">
      <section class="login" id="login">
        <header>
          <h2 class="h2">Đăng nhập</h2>
          <h4 class="h2">Tài khoản</h4>
          <?php 
            if(isset($login_customers)){
          ?>
            <h4 class="h2"><?php echo $login_customers; ?></h4>
          <?php 
            }
          ?>
        </header>
        <form class="login-form" action="" method="POST">
          <input type="text" name="email" class="login-input" placeholder="Email" required autofocus/>
          <input type="password" name="password" class="login-input" placeholder="Mật khẩu" required/>
          <label style="font-family: 'Roboto';font-weight: 300; color: gray;margin-left: 35px;">
            Bạn chưa có tài khoản?<a href="Register.php" class="login-button" style="text-decoration: none;">Đăng kí</a>
          </label>
          <div class="submit-container">
            <button type="submit" name="login" class="login-button">Đăng nhập</button>
          </div>
        </form>
      </section>
    </div>
</body>
</html>