<?php
  include('inc/header.php');
  include('../classes/brand.php');
?>
<?php
    $brand = new brand();
    if(isset($_GET['delid'])){
        $id = $_GET['delid'];
        $delbrand = $brand->del_brand($id);
    }  
?> 
  <div class="panel-header">
    <div class="header text-center">
      <h2 class="title">Danh sách thương hiệu</h2>
    </div>
  </div>
  <div class="content">
        <div class="col-md-4">
            <a href="./brandadd.php">
                <button class="btn btn-primary btn-block">Thêm thương hiệu</button>
            </a>
        </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Danh sách thương hiệu</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <?php 
                      if(isset($delbrand)){
                        echo $delbrand;
                      }                  
                  ?> 
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                          STT
                      </th>
                      <th></th>
                      <th>
                          Tên thương hiệu
                      </th>
                      <th> </th>                
                    </thead>
                    <tbody>
                      <?php 
                          $show_brand = $brand->show_brand();
                          if($show_brand){
                            $i =0;
                            $count = 0;
                            while($result = $show_brand->fetch_assoc()){
                                $i++;
                                $count++;                                                      
                      ?>
                          <tr>
                            <td>
                                <?php echo $i; ?>
                            </td>
                            <td>
                              <img src="uploads/<?php   echo $result['image'];?>" width="100">
                            </td>
                            <td>
                                <?php echo $result['brandName']; ?>
                            </td>
                            <td>
                                <a href="brandedit.php?brandid=<?php echo $result['brandId']; ?>"><i class="fas fa-pencil-alt" style="color: #008C5E;"></i></a> 
                                || 
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')" 
                                    href="?delid=<?php echo $result['brandId']; ?>"><i class="fas fa-trash" style="color: red;"></i>
                                </a>
                            </td>
                          </tr>
                      <?php 
                          }
                        }                     
                      ?>  
                    </tbody>
                  </table>
                  <?php echo "Tổng số thương hiệu là: $count"; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php include('inc/footer.php'); ?>