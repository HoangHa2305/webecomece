<?php
  include('inc/header.php');
  include('../classes/blog.php');
?>
<?php
    $blog = new blog();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $delblog = $blog->del_blog($id);
    }
?>
  <div class="panel-header">
    <div class="header text-center">
      <h2 class="title">Danh sách tin tức</h2>
    </div>
  </div>
  <div class="content">
        <div class="col-md-4">
            <a href="./blogadd.php">
                <button class="btn btn-primary btn-block">Thêm tin tức</button>
            </a>
        </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Danh sách tin tức</h4>
                <?php 
                  if(isset($delpro)){
                    echo $delpro;
                  }
                ?>
              </div>              
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                        <thead class=" text-primary">
                            <th>STT</th>
                            <th>Tiêu đề</th>                            
                            <th>Mô tả</th>
                            <th>Hình ảnh</th>
                            <th>Danh mục</th>
                            <th>Trạng thái</th>  
                            <th></th>              
                        </thead>
                    <tbody>
                        <?php 
                            $bloglist = $blog->show_blog();
                            if($bloglist){
                                $i = 0;
                                $count = 0;
                                while($result = $bloglist->fetch_assoc()){
                                    $i++;
                                    $count++;                                        
                        ?> 
                          <tr>
                            <td><?php   echo $i; ?></td>
                            <td><?php   echo $result['title'];?></td>
                            <td><?php   echo $result['description'];?></td>
                            <td>
                                <img src="uploads/<?php   echo $result['image'];?>" width="100">
                            </td>
                            <td><?php   echo $result['title_category'];?></td>                            
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
                                <a href="#"><i class="fas fa-eye" style="color: #473C8B;"></i></a> 
                                ||                             
                                <a href="blogedit.php?id=<?php echo $result['id']; ?>"><i class="fas fa-pencil-alt" style="color: #008C5E;"></i></a>
                                ||                                
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')" 
                                    href="?id=<?php echo $result['id']; ?>"><i class="fas fa-trash" style="color: red;"></i>
                                </a>                               
                            </td>
                          </tr>
                        <?php 
                                }
                            }
                        ?> 
                    </tbody>
                  </table>
                  <?php echo "Tổng số sản phẩm là: $count"; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php include('inc/footer.php'); ?>