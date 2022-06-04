<?php 
    include('inc/header.php');
?>
<?php
    $login_check = Session::get('customer_id');
    if($login_check==false){
      header('Location:login.php');
    }
?>
<?php 
    if(isset($_GET['confirmid'])){
      $id = $_GET['confirmid'];
      $time = $_GET['time'];
      $price = $_GET['price'];
      $shifted_confirm = $ct->shifted_confirm($id,$time,$price);
    }
    if(isset($_GET['id_order'])){
      $id= $_GET['id_order'];
      $del_shifted = $ct->del_shifted_confirm($id);
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
              <h2>Đơn hàng của tôi</h2>
              <p>Best Service, Right Time, Right People – Dịch vụ tốt nhất, Đúng lúc, Đúng người</p>
            </div>
            <div class="page_link">
              <a href="index.php">Trang chủ</a>
              <a style="color: #71cd14;">Đơn hàng của tôi</a>
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
            <table class="table table-borderless">
              <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Tổng tiền</th>
                    <th scope="col">Ngày đặt</th>
                    <th scope="col">Tình trạng</th>
                    <th scope="col">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $customer_id = Session::get('customer_id'); 
                    $get_cart_ordered = $ct->get_cart_ordered($customer_id);
                    if($get_cart_ordered){
                        $i = 0;
                      while($result = $get_cart_ordered->fetch_assoc()){
                        $i++;
                        
                ?>
                  <tr>
                    <td><?php echo $i; ?></td>
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
                            <h5><?php echo $result['quantity']; ?></h5>
                        </td>
                        <td>
                          <h5><?php echo $fm->format_currency($result['price']); ?>₫</h5>
                        </td>
                        <td><?php echo $fm->formatDate($result['date_order']); ?></td>
                        <td>
                            <?php 
                                if($result['status']==0){
                            ?>
                                <h5 style="color: #489620;">Đang xử lý</h5>
                            <?php
                                }elseif($result['status']==1){
                            ?>
                                <h5 style="color: #489620;">Đã xác nhận</h5>
                            <?php 
                                }elseif($result['status']==2){
                            ?>
                                <h5 style="color: #489620;">Đang chuẩn bị hàng</h5>
                            <?php
                                }elseif($result['status']==3){
                            ?>
                                <h5 style="color: #489620;">Đang giao hàng</h5>
                            <?php 
                                }elseif($result['status']==4){
                            ?>
                                <h5 style="color: #CC3399;">Đã nhận được hàng</h5>
                            <?php 
                                }elseif($result['status']==5){
                            ?>
                                <h5 style="color: #EE0000;">Đã hủy</h5>
                            <?php 
                                }
                            ?>
                        </td>
                        <?php 
                            if($result['status']==5){
                        ?>
                        <td style="font-size: 25px;text-align: center;">
                          <a href="?id_order=<?php echo $result['id']; ?>">
                            <i class="lnr lnr-cross-circle" style="color: #EE0000;"></i>
                          </a>
                        </td>
                        <?php 
                            }elseif($result['status']==3){
                        ?>
                        <td style="font-size: 25px;text-align: center;">
                            <h5>
                              <a href="?confirmid=<?php echo $customer_id; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date_order']; ?>" style="color: #CC3399;">Đã nhận hàng</a>
                            </h5>
                        </td>
                        <?php 
                            }elseif($result['status']==4){
                        ?>
                         <td style="font-size: 25px;text-align: center;">
                            <h5>_</h5>                           
                        </td>
                        <?php 
                            }else{
                        ?>
                        <td style="font-size: 25px;text-align: center;">
                            <h5 style="color: #FFCC00;">Liên hệ</h5>
                        </td>
                        <?php 
                            }
                        ?>
                  </tr>
                <?php
                      } 
                    }
                ?>
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
   