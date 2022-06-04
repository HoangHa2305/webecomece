<?php
  include('inc/header.php');
  include('../classes/customer.php');
  include_once('../helpers/format.php');
?>
<?php
  $cs = new customer();
  $fm = new Format();

  if(isset($_GET['id_binhluan']) && isset($_GET['type'])){
      $id = $_GET['id_binhluan'];
      $type = $_GET['type'];
      $update_type_binhluan = $cs->update_type_binhluan($id,$type);
  }
  if(isset($_GET['id_binhluan_post']) && isset($_GET['type'])){
      $id = $_GET['id_binhluan_post'];
      $type = $_GET['type'];
      $update_type_binhluan_post = $cs->update_type_binhluan_post($id,$type);
  }
  if(isset($_GET['binhluan_del'])){
      $id = $_GET['binhluan_del'];
      $binhluan_del = $cs->binhluan_del($id);
  }
  if(isset($_GET['binhluan_del_post'])){
    $id = $_GET['binhluan_del_post'];
    $binhluan_del_post = $cs->binhluan_del_post($id);
  }
?>
  <div class="panel-header">
    <div class="header text-center">
      <h2 class="title">Danh sách bình luận</h2>
    </div>
  </div>
  <div class="content">
          <div class="col-md-12">
            <div class="card">
              <?php 
                if($_GET['binhluan']==0){
              ?>
              <div class="card-header">
                <h4 class="card-title">Danh sách bình luận sản phẩm</h4>
              </div>
              <?php 
                }elseif($_GET['binhluan']==1){
              ?>
              <div class="card-header">
                <h4 class="card-title">Danh sách bình luận tin tức</h4>
              </div>
              <?php 
                }
              ?>              
              <div class="card-body">
                <div class="table-responsive">
                  <a href="?binhluan=0">Sản phẩm</a> ||
                  <a href="?binhluan=1">Tin tức</a><br>
                <?php 
                    if(isset($binhluan_del)){
                        echo $binhluan_del;
                    }
                    if(isset($binhluan_del_post)){
                      echo $binhluan_del_post;
                    }
                ?>
                <?php 
                  if($_GET['binhluan']==0){
                ?>
                  <table class="table">
                    <thead class=" text-primary">
                        <th>STT</th>
                        <th></th>
                        <th>Người dùng</th>
                        <th>Nội dung</th>
                        <th>ID_sản phẩm</th> 
                        <th>Thao tác</th>            
                    </thead>
                    <tbody>
                        <?php 
                            $binhluan_list = $cs->show_binhluan();
                            if($binhluan_list){
                                $i = 0;
                                while($result = $binhluan_list->fetch_assoc()){
                                    $i++;                          
                        ?> 
                          <tr>
                            <td><?php   echo $i; ?></td>
                            <td>
                                <img src="uploads/<?php   echo $result['image'];?>" width="350" style="border-radius: 50%;">
                            </td>
                            <td>
                                <?php   echo $result['tenbinhluan'];?>
                            </td>
                            <td><?php   echo $result['binhluan'];?></td>
                            <td><?php   echo $result['product_id'];?></td>                                                     
                            <td>
                                <?php 
                                    if($result['type']==0){
                                ?>
                                <a href="?binhluan=0&id_binhluan=<?php echo $result['binhluan_id']; ?>&type=1" style="color: #33CC00;">Duyệt</a>
                                <?php 
                                    }else{ 
                                ?>
                                <a href="?binhluan=0&id_binhluan=<?php echo $result['binhluan_id']; ?>&type=0" style="color: #CC0000;">Tắt</a>
                                <?php 
                                    }
                                ?>
                            </td>
                            <td>
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này?')" 
                                    href="?binhluan=0&binhluan_del=<?php echo $result['binhluan_id']; ?>"><i class="fas fa-trash" style="color: red;"></i>
                                </a>                               
                            </td>
                          </tr>
                        <?php 
                                }
                            }
                        ?> 
                    </tbody>
                  </table>
                <?php 
                  }elseif($_GET['binhluan']==1){
                ?>
                 <table class="table">
                    <thead class=" text-primary">
                        <th>STT</th>
                        <th></th>
                        <th>Người dùng</th>
                        <th>Nội dung</th>
                        <th>ID_tin tức</th> 
                        <th>Thao tác</th>            
                    </thead>
                    <tbody>
                        <?php 
                            $binhluan_list_blog = $cs->show_binhluan_blog();
                            if($binhluan_list_blog){
                                $i = 0;
                                while($result = $binhluan_list_blog->fetch_assoc()){
                                    $i++;                          
                        ?> 
                          <tr>
                            <td><?php   echo $i; ?></td>
                            <td>
                                <img src="uploads/<?php   echo $result['image'];?>" width="350" style="border-radius: 50%;">
                            </td>
                            <td>
                                <?php   echo $result['tenbinhluan'];?>
                            </td>
                            <td><?php   echo $result['binhluan'];?></td>
                            <td><?php   echo $result['blog_id'];?></td>                                                     
                            <td>
                                <?php 
                                    if($result['type']==0){
                                ?>
                                <a href="?binhluan=1&id_binhluan_post=<?php echo $result['binhluan_id']; ?>&type=1" style="color: #33CC00;">Duyệt</a>
                                <?php 
                                    }else{ 
                                ?>
                                <a href="?binhluan=1&id_binhluan_post=<?php echo $result['binhluan_id']; ?>&type=0" style="color: #CC0000;">Tắt</a>
                                <?php 
                                    }
                                ?>
                            </td>
                            <td>
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này?')" 
                                    href="?binhluan=1&binhluan_del_post=<?php echo $result['binhluan_id']; ?>"><i class="fas fa-trash" style="color: red;"></i>
                                </a>                               
                            </td>
                          </tr>
                        <?php 
                                }
                            }
                        ?> 
                    </tbody>
                  </table>
                <?php 
                  }
                ?>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php include('inc/footer.php'); ?>