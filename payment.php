<?php 
    include('inc/header.php');
?>
<div class="main">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>PHƯƠNG THỨC THANH TOÁN</span></h2>
                </div>
            </div>
            <table class="table table-borderless" style="text-align: center;background-color: #C8E2B1;">
                <tr>
                    <td colspan="3">
                        <h3>Chọn phương thức thanh toán</h3>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="background-color: #FF6600;">
                        <a href="offlinepayment.php" style="color: white;">Thanh toán ngoại tuyến</a><br>
                    </td>
                    <td style="background-color: #008800;">
                        <a href="donhangthanhtoanonline.php" style="color: white;">Thanh toán trực tuyến</a>
                    </td>
                    <td></td>
                </tr>
                <tr>
                   <td colspan="4">
                       <a href="cart.php" style="color: #367517;">Quay trở lại giỏ hàng</a>
                    </td>
                </tr>
            </table>
        </div>
        
    </div>
</div>   
<?php 
    include('inc/footer.php');
?>