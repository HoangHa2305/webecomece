<style>
    .product_description_area{
        text-align: center;
        color: black;
    }
    .success_note{
        color: #489620;
    }
</style>
<?php 
    include('inc/header.php');
?>
<?php 
    if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
      $customer_id = Session::get('customer_id');
      $insertOrder = $ct->insertOrder($customer_id);
      $delCart = $ct->dell_all_data_cart();
      header('Location: success.php');
    }
?>
    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div
            class="banner_content d-md-flex justify-content-between align-items-center"
          >
            <div class="mb-3 mb-md-0">
              <h2>Đặt hàng thành công</h2>
              <p>Best Service, Right Time, Right People – Dịch vụ tốt nhất, Đúng lúc, Đúng người</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->
     
    <!--================Product Description Area =================-->
    <?php 
        $customer_id = Session::get('customer_id');
        $get_amount = $ct->getAmountPrice($customer_id);
        if($get_amount){
            $amount = 0;
            while($result=$get_amount->fetch_assoc()){
                $amount += $result['price'];
                $vat = $amount*0.1;
                $total = $amount+$vat;
            }
        }
    ?>
    <section class="product_description_area">
        <div class="container">       
            <img src="https://shopta.vn/images/2015/11/dat-hang-thanh-cong.jpg">
            <p>Số tiền bạn cần phải thanh toán khi nhận hàng: <b><?php echo $fm->format_currency($total); ?>₫</b></p>
            <p>Chúng tôi sẽ liên lạc giao hàng cho bạn sớm nhất có thể. Xem lại chi tiết đơn hàng 
                <a href="orderdetails.php" class="success_note">tại đây</a></p>   
        </div>
    </section>
  <?php 
      include('inc/footer.php');
  ?>