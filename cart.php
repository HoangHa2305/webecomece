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
  if(!isset($_GET['id'])){
    echo "<meta http-equiv='refresh' content='0;URL=?id=live'> ";
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
              <h2>Giỏ hàng của tôi</h2>
              <p>Very us move be blessed multiply night</p>
            </div>
            <div class="page_link">
              <a href="index.php">Trang chủ</a>
              <a style="color: #71cd14;">Giỏ hàng</a>
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
            <?php 
                if(isset($update_quantity_cart)){
                    echo $update_quantity_cart;
                }                
            ?>
            <?php 
                if(isset($delcart)){
                    echo $delcart;
                }                
            ?>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Sản phẩm</th>
                  <th scope="col">Giá</th>
                  <th scope="col">Số lượng</th>
                  <th scope="col">Tổng tiền</th>
                  <th>Thao tác</th>
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
                              type="number"
                              name="quantity"
                              min="0"                                             
                              value="<?php echo $result['quantity']; ?>"
                              class="input-text qty"
                            />
                          </div>
                        </td>
                        <td>
                          <h5><?php echo $fm->format_currency($total); ?>₫</h5>
                        </td>
                        <td style="font-size: 25px;">
                            <button type="submit" name="submit" class="btn btn-light">
                                <i class="lnr lnr-sync" style="color: yellowgreen;font-size:28px;"></i>
                            </button>                     
                          ||
                          <a onclick="return confirm('Bạn muốn xóa sản phẩm này?');"
                             href="?cartid=<?php echo $result['cartId']; ?>">
                              <i class="lnr lnr-cross-circle" style="color: red;"></i>
                          </a>
                        </td>
                  </tr>
                </form>
                <?php
                      } 
                    }
                ?>
                <tr class="bottom_button">
                  <td>
                    <a class="gray_btn" href="productall.php?trang=1" style="color: #71cd14;">Tiếp tục mua hàng</a>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <div class="cupon_text">
                      <a class="gray_btn" href="?del_all_cart=0" style="background-color: #DF0029;color: white;">Xóa giỏ hàng</a>
                    </div>
                  </td>
                </tr>
                <tr>
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
                <tr class="shipping_area">
                  <td></td>
                  <td></td>
                  <td>
                    <h5>Phí giao hàng: </h5>
                  </td>
                  <td>
                    <div class="shipping_box">
                      <ul class="list">
                        <li>
                          <a href="#">Nội thành: 0₫</a>
                        </li>
                        <li>
                          <a href="#">Ngoại tỉnh: 20₫</a>
                        </li>
                        <li>
                          <a href="#">Nước ngoài: 100₫</a>
                        </li>
                      </ul>
                      <a class="gray_btn" href="#">Update Details</a>
                    </div>
                  </td>
                </tr>
                <tr class="out_button_area">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <div class="checkout_btn_inner">
                      
                      <?php 
                        $login_check = Session::get('customer_id');
                        if($login_check==false){
                      ?> 
                          <p>Bạn cần <a href="login.php" style="color: #71cd14;">đăng nhập</a> trước khi thanh toán</p>
                      <?php   
                        }else{
                      ?>
                          <a class="gray_btn" href="index.php">Tiếp tục mua hàng</a>
                          <a class="main_btn" href="payment.php">Thanh toán</a> 
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
   