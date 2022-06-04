<?php 
  include('inc/header.php');
  include('../classes/category.php');

  $filepath = realpath(dirname(__FILE__));
  include_once($filepath.'/../classes/customer.php');
  include_once($filepath.'/../helpers/format.php');
?>
<?php 
    if(!isset($_GET['customerid']) || $_GET['customerid']==NULL){
       echo "<script>window.location='inbox.php' </script>";    //script trả về lại trang 
    }else{
        $id = $_GET['customerid'];
    } 
    $cs = new customer(); 

?>
   <div class="panel-header">
      <div class="header text-center">
        <h2 class="title">Thông tin khách hàng</h2>
      </div>
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Thông tin khách hàng</h4>
              <?php
                $get_customer = $cs->show_customers($id);
                if($get_customer){
                    while($result = $get_customer->fetch_assoc()){

                    
              ?>
               <table class="table table-borderless">
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
                        <td></td>
                        <td>
                            <a href="inbox.php"><i class="fas fa-arrow-circle-left"></i> Trở lại</a>
                        </td>
                    </tr>
                </table>
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