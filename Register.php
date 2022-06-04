<?php 
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
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){

      $insertCustomers = $cs->insert_customers($_POST,$_FILES);
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng kí</title>
  <link rel="stylesheet" href="css/login.css" />
  <script type="text/javascript" src="js/login.js" ></script>
</head>
<body>
    <div class="login-container">
      <section class="login" id="login">
        <header>
          <h2 class="h2">Đăng kí</h2>
          <h4 class="h2">Tài khoản</h4>
          <?php 
            if(isset($insertCustomers)){
          ?>
            <h4 class="h2"><?php echo $insertCustomers; ?></h4>
          <?php 
            }
          ?>
        </header>
        <form class="login-form" action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="name" class="login-input" placeholder="Tên người dùng" required autofocus/>
            <input type="number" name="phone" class="login-input" placeholder="Số điện thoại" required autofocus/>
            <input type="text" name="email" class="login-input" placeholder="Email" required autofocus/>
            <input type="text" name="address" class="login-input" placeholder="Địa chỉ" required autofocus/>
            <input type="text" name="city" class="login-input" placeholder="Thành phố" required autofocus/>
            <input type="text" name="country" class="login-input" placeholder="Quốc gia" required autofocus/>
            <input type="text" name="zipcode" class="login-input" placeholder="Zipcode" required autofocus/>
            <input type="password" name="password" class="login-input" placeholder="Mật khẩu" required/>
            <label style="font-family: 'Roboto', sans-serif;font-weight: 500; color: gray;">Ảnh đại diện: </label>
            <input type="file" name="image" class="login-input">
            <label style="font-family: 'Roboto';font-weight: 300; color: gray;margin-left: 35px;">
              Bạn đã có tài khoản?<a href="login.php" class="login-button" style="text-decoration: none;">Đăng nhập</a>
            </label>
            <div class="submit-container">
              <button type="submit" name="submit" class="login-button">Đăng kí</button>
            </div>
        </form>
      </section>
    </div>
</body>
</html>