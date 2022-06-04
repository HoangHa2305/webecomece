<?php 
  include('inc/header.php');
  include('../classes/category.php');
?>
<?php 
     $cat = new category();
    if(!isset($_GET['catid']) || $_GET['catid']==NULL){
       echo "<script>window.location='catlist.php' </script>";    //script trả về lại trang 
    }else{
        $id = $_GET['catid'];
    }  
    if($_SERVER["REQUEST_METHOD"] == "POST"){

      $catName = $_POST['catName'];

      $updateCat = $cat->update_category($catName,$id);
  }

?>
   <div class="panel-header">
      <div class="header text-center">
        <h2 class="title">Danh mục sản phẩm</h2>
      </div>
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Chỉnh sửa danh mục sản phẩm</h4>
              <?php
                if(isset($updateCat)){
                   echo $updateCat;
                  // header("Location: http://www.example.com/");
                }
              ?>
              <?php
                $get_cate_name = $cat->getcatbyId($id);
                if($get_cate_name){
                    while($result = $get_cate_name->fetch_assoc()){

                    
              ?>
              <form action="" method="POST">            
                  <input type="text" value="<?php echo $result['catName']; ?>" name="catName" placeholder="Vui lòng thêm danh mục sản phẩm"  class="form-control">
                  <button type="submit" class="btn btn-primary" style="text-align: center;">Chỉnh sửa danh mục</button>
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