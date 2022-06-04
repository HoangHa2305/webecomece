<?php
  include('inc/header.php');
  include('../classes/customer.php');
  include_once('../helpers/format.php');
?>
<?php
  $cs = new customer();
  
  if(isset($_GET['cs_id'])){
      $id = $_GET['cs_id'];
      $del_customer = $cs->del_customer($id);
  }
?>
  <div class="panel-header">
    <div class="header text-center">
      <h2 class="title">Danh sách người dùng</h2>
    </div>
  </div>
  <div class="content">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Danh sách người dùng</h4>
              </div>              
              <div class="card-body">
                <div class="table-responsive">
                <?php 
                    if(isset($del_customer)){
                        echo $del_customer;
                    }
                ?>
                  <table class="table">
                    <thead class=" text-primary">
                        <th>STT</th>
                        <th></th>
                        <th>Tên</th>
                        <th>Thông tin</th> 
                        <th>Thao tác</th>            
                    </thead>
                    <tbody>
                        <?php 
                            $get_all_customer = $cs->get_all_customer();
                            $i=0;
                            if($get_all_customer){
                                while($result = $get_all_customer->fetch_assoc()){
                                    $i++;
                        ?>
                          <tr>
                            <td><?php   echo $i; ?></td>
                            <td>
                                <img src="uploads/<?php echo $result['image']; ?>" width="70" style="border-radius: 50%;">
                            </td>
                            <td>
                                <?php echo $result['name']; ?>
                            </td>
                            <td>
                                <a href="info.php?customerid=<?php echo $result['id']; ?>">Xem thông tin</a>
                            </td>
                            <td>
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')" 
                                    href="?cs_id=<?php echo $result['id']; ?>"><i class="fas fa-trash" style="color: red;"></i>
                                </a>                               
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
<?php include('inc/footer.php'); ?>