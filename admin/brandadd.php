<?php 
  include('inc/header.php');
  include('../classes/brand.php');
?>
<?php 
   $brand = new brand();
   if($_SERVER["REQUEST_METHOD"] == "POST"){
       $brandName = $_POST['brandName'];

       $insertBrand = $brand->insert_brand($brandName,$_FILES);
   }

?>
   <div class="panel-header">
      <div class="header text-center">
        <h2 class="title">Thương hiệu sản phẩm</h2>
      </div>
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Thêm thương hiệu sản phẩm</h4>
              <?php
                if(isset($insertBrand)){
                   echo $insertBrand;
                  // header("Location: http://www.example.com/");
                }
              ?>
              <form action="brandadd.php" method="POST" enctype="multipart/form-data">            
                  <input type="text" name="brandName" placeholder="Vui lòng thêm thương hiệu sản phẩm"  class="form-control">
                  <input type="file" name="image" class="form-control">
                  <button type="submit" class="btn btn-primary" style="text-align: center;">Thêm thương hiệu</button>
              </form>  
            </div>
          </div>
        </div>
      </div>
    </div>
<?php include('inc/footer.php'); ?>