<?php 
    include('inc/header.php');
?>
<?php
  if(isset($_GET['cartid'])){
    $cartid = $_GET['cartid'];
    $delcart = $ct->del_product_cart($cartid);
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $cartId = $_POST['cartId'];
    $quantity = $_POST['quantity'];
    $update_quantity_cart = $ct->update_quantity_cart($quantity,$cartId);
    if($quantity<=0){
      $delcart = $ct->del_product_cart($cartId);
    }
  }
  if(isset($_GET['del_all_cart'])){
    $del_all_cart = $ct->dell_all_data_cart();
  }
?>
<?php 
//   if(!isset($_GET['id'])){
//     echo "<meta http-equiv='refresh' content='0;URL=?id=live'> ";
//   }
?>
    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div
            class="banner_content d-md-flex justify-content-between align-items-center"
          >
            <div class="mb-3 mb-md-0">
              <h2>Cổng thanh toán online</h2>
              <p>Best Service, Right Time, Right People – Dịch vụ tốt nhất, Đúng lúc, Đúng người</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Cart Area =================-->
    <section class="cart_area">
      <div class="container">
        <div class="cart_inner">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" colspan="2">Sản phẩm</th>
                  <th scope="col">Giá</th>
                  <th scope="col">Số lượng</th>
                  <th scope="col">Tổng tiền</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    $get_product_cart = $ct->get_product_cart();
                    $total = 0;
                    $subtotal = 0;
                    if($get_product_cart){
                      while($result = $get_product_cart->fetch_assoc()){
                        $total = $result['price']*$result['quantity'];
                        $subtotal += $total;
                ?>
                <form action="" method="POST">
                  <tr>
                    <td>
                      <div class="media">
                        <div class="d-flex">
                          <img
                            src="./admin/uploads/<?php   echo $result['image'];?>"
                            alt=""
                            width="100"
                          />
                        </div>
                    </td>
                    <td>
                        <div class="media-body">
                          <p><?php echo $result['productName']; ?></p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <h5><?php echo $fm->format_currency($result['price']); ?>₫</h5>
                    </td>
                        <td>
                          <div class="product_count">                      
                          <input
                              type="hidden"
                              name="cartId"                                             
                              value="<?php echo $result['cartId']; ?>"
                              class="input-text qty"
                              
                            />
                            <input
                              type="text"
                              readonly
                              name="quantity"                                            
                              value="<?php echo $result['quantity']; ?>"
                              class="input-text qty"
                            />
                          </div>
                        </td>
                        <td>
                          <h5><?php echo $fm->format_currency($total); ?>₫</h5>
                        </td>
                  </tr>
                </form>
                <?php
                      } 
                    }
                ?>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <h5>Thành tiền: </h5><br>
                    <h5>Thuế VAT (10%): </h5><br>
                    <h5>Tổng cộng: </h5>
                  </td>
                  <td>
                    <h5>
                      <?php 
                          echo $fm->format_currency($subtotal);
                          Session::set('sum',$subtotal); 
                      ?>₫
                    </h5>
                    <br>
                    <h5>
                      <?php
                        $vat = $subtotal * 0.1;
                        echo  $fm->format_currency($vat);

                        $gtotal = $subtotal+$vat;
                      ?>₫
                    </h5><br>
                    <h5><?php echo $fm->format_currency($gtotal) ?>₫</h5>
                  </td>
                </tr>
                <tr >
                    <td>
                      <a href="cart.php" style="color: #71cd14;">Quay về giỏ hàng</a>  
                    </td>
                    <?php
                      $check_cart = $ct->check_cart();
                      $login_check = Session::get('customer_id');
                      if($login_check==true && $check_cart){
                                
                    ?>
                    <td style="text-align: right;">
                        <form action="congthanhtoan_onepay.php" method="POST">
                          <input type="hidden" name="total_congthanhtoan" value="<?php echo $gtotal; ?>">
                          <button class="btn btn-primary" name="captureWallet">Thanh toán ONEPAY</button>
                        </form> 
                    </td>
                    <td>
                        <div class="checkout_btn_inner">
                            <form action="congthanhtoan_vnpay.php" method="POST">
                                <input type="hidden" name="total_congthanhtoan" value="<?php echo $gtotal; ?>">
                                <button class="btn btn-danger" name="redirect" id="redirect">Thanh toán VNPAY</button>
                            </form>
                    </td>
                    <td>
                            <form action="congthanhtoan_momo.php" method="POST">
                                <input type="hidden" name="total_congthanhtoan" value="<?php echo $gtotal; ?>">
                                <button class="btn btn-dark" name="captureWallet">Thanh toán QR MOMO</button>
                            </form> 
                    </td>
                    <td>
                            <form action="congthanhtoan_momo.php" method="POST">
                                <input type="hidden" name="total_congthanhtoan" value="<?php echo $gtotal; ?>">
                                <button class="btn btn-danger" name="payWithATM"  style="background-color: #FF0099;">Thanh toán MOMO ATM</button>
                            </form>                                         
                        <?php   
                               
                            }else{
                        ?>
                            <p>Bạn cần <a href="login.php" style="color: #71cd14;">đăng nhập</a> trước khi thanh toán</p>
                        <?php 
                            }
                        ?>
                        </div>
                    </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <!--================End Cart Area =================-->
<?php 
    include('inc/footer.php');
?>
   