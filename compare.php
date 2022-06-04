<?php 
    include('inc/header.php');
?>
<?php 
  $login_check = Session::get('customer_login');
  if(empty($login_check)){
    echo "<script>window.location='404.php' </script>";
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
              <h2>So sánh sản phẩm</h2>
              <p>Best Service, Right Time, Right People – Dịch vụ tốt nhất, Đúng lúc, Đúng người</p>
            </div>
            <div class="page_link">
              <a href="index.php">Trang chủ</a>
              <a style="color: #71cd14;">So sánh</a>
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
                  <th scope="col">ID</th>
                  <th scope="col">Hình ảnh</th>
                  <th scope="col">Tên sản phẩm</th>
                  <th scope="col">Giá</th>
                  <th scope="col">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $customer_id = Session::get('customer_id');
                    $get_compare = $product->get_compare($customer_id);

                    $i = 0;
                    if($get_compare){
                      while($result = $get_compare->fetch_assoc()){
                        $i++;       
                ?>
                <form action="" method="POST">
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
                      </div>
                    </td>
                    <td>
                      <p><?php echo $result['productName']; ?></p>
                    </td>
                    <td>
                      <h5><?php echo $fm->format_currency($result['price']); ?>₫</h5>
                    </td>
                    <td>
                      <a href="details.php?proid=<?php echo $result['productId']; ?>" style="color: #32CD32;">
                        Xem
                      </a>
                    </td>
                  </tr>
                </form>
                <?php
                      } 
                    }
                ?>
                <tr>
                  <td colspan="5">
                    <center><a class="gray_btn" href="index.php" style="color: #71cd14;">Tiếp tục mua hàng</a></center>
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
   