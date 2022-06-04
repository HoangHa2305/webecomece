<?php
  include('inc/header.php');
  include('../classes/post.php');
?>
<?php
    $post = new post();
    if(isset($_GET['delid'])){
       $id = $_GET['delid'];
       $delcat = $post->del_category_post($id);
    }  
?>
  <div class="panel-header">
    <div class="header text-center">
      <h2 class="title">Danh mục tin tức</h2>
    </div>
  </div>
  <div class="content">
        <div class="col-md-4">
            <a href="./postadd.php">
                <button class="btn btn-primary btn-block">Thêm danh mục tin tức</button>
            </a>
        </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Danh sách danh mục tin tức</h4>
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
                          Tên danh mục tin tức
                      </th>
                      <th>
                          Mô tả
                      </th>
                      <th>
                          Trạng thái
                      </th>
                      <th></th>                
                    </thead>
                    <tbody>
                      <?php 
                          $show_cate = $post->show_category_post();
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
                                <?php echo $result['title']; ?>
                            </td>
                            <td>
                                <?php echo $result['description']; ?>
                            </td>
                            <td>
                                <?php 
                                    if($result['status']==0){
                                ?>
                                        Hiển thị
                                <?php
                                    }else{
                                ?>
                                        Ẩn
                                <?php        
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="postedit.php?catid=<?php echo $result['id_cate_post']; ?>"><i class="fas fa-pencil-alt" style="color: #008C5E;"></i></a> 
                                || 
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')" 
                                    href="?delid=<?php echo $result['id_cate_post']; ?>"><i class="fas fa-trash" style="color: red;"></i>
                                </a>
                            </td>
                          </tr>
                      <?php 
                          }
                        }                     
                      ?>  
                    </tbody>
                  </table>
                  <?php echo "Tổng số danh mục tin tức là:  $count"; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php include('inc/footer.php'); ?>