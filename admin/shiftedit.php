<?php 
  include('inc/header.php');
  
  $filepath = realpath(dirname(__FILE__));
  include_once($filepath.'/../classes/cart.php');
?>
<?php 
    $ct = new cart();
    
    if(isset($_GET['shiftid'])){
        $id = $_GET['shiftid'];
        $time = $_GET['time'];
        $price = $_GET['price'];
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $status = $_POST['status'];
            $shifted = $ct->shifted($id,$time,$price,$status);
        }       
    }
?>
   <div class="panel-header">
      <div class="header text-center">
        <h2 class="title">Trạng thái đơn hàng</h2>
      </div>
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Chỉnh sửa trạng thái đơn hàng</h4>
              <?php 
                if(isset($shifted)){
                  echo $shifted;
                }
              ?>
              <?php
                $get_status_order = $ct->get_status_order($id,$time,$price);
                if($get_status_order){
                    while($result = $get_status_order->fetch_assoc()){
                   
              ?>             
              <form action="" method="POST">
                <div class="form-group">        
                    <select class="form-control" name="status">
                        <?php 
                            if($result['status']==0){
                        ?>
                        <option value="0" selected>Đang xử lí</option>
                        <option value="1">Đã xác nhận</option>
                        <option value="2">Đang chuẩn bị hàng</option>
                        <option value="3">Đang giao hàng</option>
                        <option value="4">Đã nhận hàng</option>
                        <option value="5">Đã hủy</option>
                        <?php 
                            }elseif($result['status']==1){
                        ?>
                        <option value="0">Đang xử lí</option>
                        <option value="1" selected>Đã xác nhận</option>
                        <option value="2">Đang chuẩn bị hàng</option>
                        <option value="3">Đang giao hàng</option>
                        <option value="4">Đã nhận hàng</option>
                        <option value="5">Đã hủy</option>
                        <?php 
                            }elseif($result['status']==2){
                        ?>
                        <option value="0">Đang xử lí</option>
                        <option value="1">Đã xác nhận</option>
                        <option value="2" selected>Đang chuẩn bị hàng</option>
                        <option value="3">Đang giao hàng</option>
                        <option value="4">Đã nhận hàng</option>
                        <option value="5">Đã hủy</option>
                        <?php 
                            }elseif($result['status']==3){
                        ?>
                        <option value="0">Đang xử lí</option>
                        <option value="1">Đã xác nhận</option>
                        <option value="2">Đang chuẩn bị hàng</option>
                        <option value="3" selected>Đang giao hàng</option>
                        <option value="4">Đã nhận hàng</option>
                        <option value="5">Đã hủy</option>
                        <?php 
                            }elseif($result['status']==4){
                        ?>
                        <option value="0">Đang xử lí</option>
                        <option value="1">Đã xác nhận</option>
                        <option value="2">Đang chuẩn bị hàng</option>
                        <option value="3">Đang giao hàng</option>
                        <option value="4" selected>Đã nhận hàng</option>
                        <option value="5">Đã hủy</option>
                        <?php 
                            }elseif($result['status']==5){
                        ?>
                        <option value="0">Đang xử lí</option>
                        <option value="1">Đã xác nhận</option>
                        <option value="2">Đang chuẩn bị hàng</option>
                        <option value="3">Đang giao hàng</option>
                        <option value="4">Đã nhận hàng</option>
                        <option value="5" selected>Đã hủy</option>
                        <?php 
                            }
                        ?>
                    </select>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                    <a href="inbox.php"><i class="fas fa-arrow-alt-circle-left"></i> Quay lại</a>
                </div>
              </form>
              <?php
                    }
                }
              ?>  
            </div>
          </div>
        </div>
      </div>
    </div>
<?php include('inc/footer.php'); ?>