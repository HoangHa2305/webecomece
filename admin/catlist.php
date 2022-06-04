<?php
  include('inc/header.php');
  include('../classes/category.php');
?>
<?php
    $cat = new category();
    if(isset($_GET['delid'])){
       $id = $_GET['delid'];
       $delcat = $cat->del_category($id);
    }  
?>
  <div class="panel-header">
    <div class="header text-center">
      <h2 class="title">Danh mục sản phẩm</h2>
    </div>
  </div>
  <div class="content">
        <div class="col-md-4">
            <a href="./catadd.php">
                <button class="btn btn-primary btn-block">Thêm danh mục</button>
            </a>
        </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Danh sách danh mục sản phẩm</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <?php 
                      if(isset($delcat)){
                        echo $delcat;
                      }                  
                  ?> 
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                          STT
                      </th>
                      <th>
                          Tên danh mục
                      </th>
                      <th> </th>                
                    </thead>
                    <tbody>
                      <?php 
                          $show_cate = $cat->show_category();
                          if($show_cate){
                            $i =0;
                            $count =0;
                            while($result = $show_cate->fetch_assoc()){
                                $i++; 
                                $count++;                                                     
                      ?>
                          <tr>
                            <td>
                                <?php echo $i; ?>
                            </td>
                            <td>
                                <?php echo $result['catName']; ?>
                            </td>
                            <td>
                                <a href="catedit.php?catid=<?php echo $result['catId']; ?>"><i class="fas fa-pencil-alt" style="color: #008C5E;"></i></a> 
                                || 
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')" 
                                    href="?delid=<?php echo $result['catId']; ?>"><i class="fas fa-trash" style="color: red;"></i>
                                </a>
                            </td>
                          </tr>
                      <?php 
                          }
                        }                     
                      ?>  
                    </tbody>
                  </table>
                  <?php echo "Tổng số danh mục sản phẩm là:  $count"; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php include('inc/footer.php'); ?>