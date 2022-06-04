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
              <h2>Thanh toán ngoại tuyến</h2>
              <p>Best Service, Right Time, Right People – Dịch vụ tốt nhất, Đúng lúc, Đúng người</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->
     
    <!--================Product Description Area =================-->
    <form action="" method="POST">
      <section class="product_description_area">
        <div class="container">
            <div class="table-responsive">
              <table class="table table-bordered">
                  <tr>
                      <td>
                        <table class="table">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="1">ID</th>
                              <th scope="col">Sản phẩm</th>
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
                                $i =0;
                                if($get_product_cart){
                                  while($result = $get_product_cart->fetch_assoc()){
                                    $i++;
                                    $total = $result['price']*$result['quantity'];
                                    $subtotal += $total;
                            ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td>
                                  <div class="media">
                                  
                                    <div class="media-body">
                                      <p><?php echo $result['productName']; ?></p>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                    <?php echo $fm->format_currency($result['price']); ?>₫
                                </td>
                                    <td>                                          
                                        <?php echo $result['quantity']; ?>
                                    </td>
                                    <td>
                                        <?php echo $fm->format_currency($total); ?>₫
                                    </td>
                              </tr>
                            <?php
                                  } 
                                }
                            ?>
                            <tr>
                              <td></td>
                              <td></td>
                              <td colspan="2">
                                <b>Thành tiền:</b><br>
                                <b>Thuế VAT (10%):</b><br>
                                <b>Tổng cộng:</b> 
                              </td>
                              <td>
                                  <?php 
                                      echo $fm->format_currency($subtotal);
                                      Session::set('sum',$subtotal); 
                                  ?>₫
                                <br>
                                  <?php
                                    $vat = $subtotal * 0.1;
                                    echo  $fm->format_currency($vat);

                                    $gtotal = $subtotal+$vat;
                                  ?>₫
                                <br>
                                <?php echo $fm->format_currency($gtotal) ?>₫
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                      <td>
                        <table class="table table-borderless">
                          <?php
                              $id = Session::get('customer_id'); 
                              $get_customers = $cs->show_customers($id);
                              if($get_customers){
                                  while($result = $get_customers->fetch_assoc()){

                          ?>
                          <tr>
                              <td>Tên :</td>
                              <td><?php echo $result['name']; ?></td>
                          </tr>
                          <tr>
                              <td>Số điện thoại :</td>
                              <td><?php echo '0'.$result['phone']; ?></td>
                          </tr>
                          <tr>
                              <td>Email :</td>
                              <td><?php echo $result['email']; ?></td>
                          </tr>
                          <tr>
                              <td>Địa chỉ :</td>
                              <td><?php echo $result['address']; ?></td>
                          </tr>
                          <tr>
                              <td>Thành phố :</td>
                              <td><?php echo $result['city']; ?></td>
                          </tr>
                          <tr>
                              <td>Quốc tịch :</td>
                              <td><?php echo $result['country']; ?></td>
                          </tr>
                          <tr>
                              <td>Zipcode :</td>
                              <td><?php echo $result['zipcode']; ?></td>
                          </tr>
                          <tr>
                              <td colspan="2"><a href="editprofile.php" style="color: #71cd14;">Cập nhật thông tin cá nhân</a></td>
                          </tr>
                          <?php 
                                  }
                              }
                          ?>
                        </table>
                      </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <center>
                        <button class="btn btn-success" style="width: 30%;"><a href="?orderid=order" style="color: white;">Đặt hàng ngay</a></button>
                      </center>
                    </td>
                  </tr>
              </table>                
            </div>
        </div>
      </section>
    </form>
  <?php 
      include('inc/footer.php');
  ?>