<?php 
  include('inc/header.php');

  $filepath = realpath(dirname(__FILE__));
  include_once($filepath.'/../classes/cart.php');
  include_once($filepath.'/../helpers/format.php');
?>
<?php
    $ct = new cart();
    $fm = new Format();

    if(isset($_GET['delid'])){
      $id = $_GET['delid'];
      $time = $_GET['time'];
      $price = $_GET['price'];
      $del_shifted = $ct->del_shifted($id,$time,$price);
    }
?>
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Đơn đặt hàng</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <?php 
                    if(isset($del_shifted)){
                      echo $del_shifted;
                    }
                  ?>
                  <table class="table" style="font-size: 13px;">
                    <thead class=" text-primary" >
                      <th>
                        STT
                      </th>
                      <th>
                        Thời gian đặt
                      </th>
                      <th>
                        Sản phẩm
                      </th>
                      <th>
                        Số lượng
                      </th>
                      <th>
                        Giá
                      </th>
                      <th>
                        ID khách hàng
                      </th>
                      <th>
                        Khách hàng
                      </th>
                      <th>
                        Thao tác
                      </th>
                    </thead>
                    <tbody>
                      <?php 
                        $get_inbox_cart = $ct->get_inbox_cart();
                        if($get_inbox_cart){
                          $i = 0;
                          while($result = $get_inbox_cart->fetch_assoc()){
                            $i++;

                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                          <?php echo $fm->formatDate($result['date_order']); ?>
                        </td>
                        <td>
                          <?php echo $result['productName']; ?>
                        </td>
                        <td>
                          <?php echo $result['quantity']; ?>
                        </td>
                        <td>
                          <?php echo $fm->format_currency($result['price']); ?>₫
                        </td>
                        <td>
                          <?php echo $result['customer_id']; ?>
                        </td>
                        <td>
                          <a href="customer.php?customerid=<?php echo $result['customer_id']; ?>" style="color: #3366CC;">Xem thông tin</a>
                        </td>
                        <td>
                          <?php 
                            if($result['status']==0){
                          ?>
                            <a href="shiftedit.php?shiftid=<?php echo $result['id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date_order']; ?>" 
                              style="color: #CC9900;">
                              <i class="now-ui-icons loader_refresh spin"></i> 
                              Đang xử lí
                            </a>
                          <?php 
                            }elseif($result['status']==1){
                          ?>
                            <a href="shiftedit.php?shiftid=<?php echo $result['id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date_order']; ?>" 
                              style="color: #489620;">
                              <i class="fas fa-check-circle"></i>
                              Đã xác nhận
                            </a>
                          <?php 
                            }elseif($result['status']==2){
                          ?>
                            <a href="shiftedit.php?shiftid=<?php echo $result['id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date_order']; ?>" 
                              style="color: #489620;">
                              <i class="now-ui-icons loader_refresh spin"></i>
                              Đang chuẩn bị hàng
                            </a>
                          <?php 
                            }elseif($result['status']==3){
                          ?>
                            <a href="shiftedit.php?shiftid=<?php echo $result['id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date_order']; ?>" 
                              style="color: #489620;">
                              <i class="now-ui-icons loader_refresh spin"></i>
                              Đang giao hàng
                            </a>
                          <?php 
                            }elseif($result['status']==4){
                          ?>
                            <a href="shiftedit.php?shiftid=<?php echo $result['id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date_order']; ?>" 
                              style="color: #489620;">                             
                              Đã nhận hàng -
                            </a>
                            <a href="?delid=<?php echo $result['id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date_order']; ?>" style="color: #489620;">
                              <i class="fas fa-trash-alt"></i>
                            </a>                   
                          <?php 
                            }elseif($result['status']==5){
                          ?>
                            <a href="shiftedit.php?shiftid=<?php echo $result['id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date_order']; ?>">Đã hủy </a>-
                            <a href="?delid=<?php echo $result['id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date_order']; ?>"><i class="fas fa-trash-alt"></i></a>
                          <?php 
                            }
                          ?>
                        </td>
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
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="http://presentation.creative-tim.com">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy; <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Designed by <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <?php include('inc/footer.php'); ?>