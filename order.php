<?php 
    include('inc/header.php');
?>
<?php 
  $login_check = Session::get('customer_login');
  if($login_check==false){
    header('Location: login.php');
  }
?>
<style>
    h3{
        font-size: 50px;
        font-weight: bold;
        color: red;
        text-align: center;
        margin-bottom: 300px;
    }
</style>
    <div class="main">
        <div class="content">
            <div class="cartoption">
                <div class="cartpage">
                    <div class="not_found">
                        <h3>Trang thanh toán</h3>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<?php 
    include('inc/footer.php');
?>