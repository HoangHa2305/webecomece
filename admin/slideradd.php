<?php 
  include('inc/header.php');
  include('../classes/product.php');
?>
<?php 
    $product = new product();
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        $insertSlider = $product->insert_slider($_POST,$_FILES);
    }
?>
   <div class="panel-header">
      <div class="header text-center">
        <h2 class="title">Slider</h2>
      </div>
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-10">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Thêm Slider</h4>
                <form action="" method="POST" enctype="multipart/form-data">            
                  <table class="table">
                        <tr>
                          <td>
                              <?php 
                                if(isset($insertSlider)){
                                    echo $insertSlider;
                                }
                              ?>
                          </td>  
                        </tr>
                        <tr>
                            <td>
                              <label>Tiêu đề</label>
                            </td>
                            <td>
                                <input type="text" name="sliderName" placeholder="Nhập tiêu đề slider" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>
                              <label>Hình ảnh</label>
                            </td>
                            <td>
                              <input type="file" name="image">
                            </td>
                        </tr>
                        <tr>
                            <td>
                              <label>Hiển thị</label>
                            </td>
                            <td>
                              <select class="form-control" name="type">
                                  <option value="1">Bật</option>
                                  <option value="0">Tắt</option>
                              </select>
                            </td>
                        </tr>                                                   
                  </table>
                  <div style="text-align: center;">
                      <button type="submit" name="submit" class="btn btn-primary">Thêm Slider</button>
                  </div>                    
              </form>  
            </div>
          </div>
        </div>
      </div>
    </div>   
<?php include('inc/footer.php'); ?>