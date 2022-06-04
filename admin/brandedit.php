<?php 
  include('inc/header.php');
  include('../classes/brand.php');
?>
<?php 
     $brand = new brand();
    if(!isset($_GET['brandid']) || $_GET['brandid']==NULL){
       echo "<script>window.location='brandlist.php' </script>";    //script trả về lại trang 
    }else{
        $id = $_GET['brandid'];
    }  
    if($_SERVER["REQUEST_METHOD"] == "POST"){

      $brandName = $_POST['brandName'];

      $updateBrand = $brand->update_brand($brandName,$id);
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
              <h4 class="card-title">Chỉnh sửa thương hiệu sản phẩm</h4>
              <?php
                if(isset($updateBrand)){
                   echo $updateBrand;
                  // header("Location: http://www.example.com/");
                }
              ?>
              <?php
                $get_brand_name = $brand->getbrandbyId($id);
                if($get_brand_name){
                    while($result = $get_brand_name->fetch_assoc()){

                    
              ?>
              <form action="" method="POST" enctype="multipart/form-data">            
                  <input type="text" value="<?php echo $result['brandName']; ?>" name="brandName" placeholder="Vui lòng thêm thương hiệu sản phẩm"  class="form-control">
                  <input type="file" name="image" class="form-control">
                  <button type="submit" class="btn btn-primary" style="text-align: center;">Chỉnh sửa thương hiệu</button>
              </form>
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