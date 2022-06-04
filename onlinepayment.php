<style>
    #table{
        text-align: center;
    }
    #back{
        color: #71cd14;
    }
</style>
<?php 
    include('inc/header.php');
?>
<div class="main">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>PHƯƠNG THỨC THANH TOÁN TRỰC TUYẾN</span></h2>
                </div>
            </div>
            <table class="table table-borderless" id="table">
                <tr>
                    <td colspan="5">
                        <h3>Chọn cổng thanh toán trực tuyến</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="donhangthanhtoanonline.php" class="btn btn-primary">Thanh toán VNPAY</a>
                        <a href="donhangthanhtoanonline.php" class="btn btn-danger">Thanh toán MOMO</a>
                    </td>
                </tr>
                <tr>
                    <td><a href="cart.php" id="back">Quay lại giỏ hàng</a></td>
                </tr>
            </table>
        </div>
        
    </div>
</div>   
<?php 
    include('inc/footer.php');
?>