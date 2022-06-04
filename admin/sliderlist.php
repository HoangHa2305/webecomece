<style>
    .type_on{
        text-decoration: none;
        color: #00FF00;
    }
    .type_off{
        text-decoration: none;
        color: #DD0000;
    }
</style>
<?php
  include('inc/header.php');
  include('../classes/product.php');
?>
<?php
    $product = new product();
    if(isset($_GET['type_slider']) && isset($_GET['type'])){
        $id = $_GET['type_slider'];
        $type = $_GET['type'];
        $update_type_slider = $product->update_type_slider($id,$type);
    }
    if(isset($_GET['slider_del'])){
        $id = $_GET['slider_del'];
        $del_slider = $product->del_slider($id);
    }
?> 
  <div class="panel-header">
    <div class="header text-center">
      <h2 class="title">Slider</h2>
    </div>
  </div>
  <div class="content">
        <div class="col-md-4">
            <a href="./slideradd.php">
                <button class="btn btn-primary btn-block">Thêm slider</button>
            </a>
        </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Danh sách slider</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                <?php
                    if(isset($del_slider)){
                        echo $del_slider;
                    }
                ?>
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                          STT
                      </th>
                      <th>
                          Hình ảnh
                      </th>
                      <th>
                          Tiêu đề
                      </th>
                      <th> 
                          Hiển thị
                      </th>
                      <th></th>                
                    </thead>
                    <tbody>
                        <?php
                            $i=0;
                            $count = 0; 
                            $get_slider = $product->show_slider_list();
                            if($get_slider){
                                while($result = $get_slider->fetch_assoc()){
                                    $i++;
                                    $count++;
                        ?>
                        <tr>
                            <td>
                                <?php echo $i; ?>    
                            </td>
                            <td>
                                <img src="uploads/<?php   echo $result['slider_image'];?>" width="250">
                            </td>
                            <td>
                                <?php echo $result['sliderName']; ?>
                            </td>
                            <td>
                                <?php 
                                    if($result['type']==1){
                                ?>
                                    <a href="?type_slider=<?php echo $result['sliderId']; ?>&type=0" class="type_off">Tắt</a>
                                <?php    
                                    }else{
                                ?>
                                    <a href="?type_slider=<?php echo $result['sliderId']; ?>&type=1" class="type_on">Bật</a>
                                <?php
                                    }
                                ?>
                            </td>
                            <td>
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')" 
                                    href="?slider_del=<?php echo $result['sliderId']; ?>"><i class="fas fa-trash" style="color: red;"></i>
                                </a>
                            </td>
                        </tr>
                        <?php 
                                }
                            }
                        ?>
                    </tbody>
                  </table>
                  <?php echo "Tổng số slider là: $count"; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php 
    include('inc/footer.php'); 
?>