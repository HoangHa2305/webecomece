<?php 
  include('inc/header.php');
  include('../classes/category.php');
?>
<?php 
   $cat = new category();
   if($_SERVER["REQUEST_METHOD"] == "POST"){
       $catName = $_POST['catName'];

       $insertCat = $cat->insert_category($catName);
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
              <h4 class="card-title">Thêm danh mục sản phẩm</h4>
              <?php
                if(isset($insertCat)){
                   echo $insertCat;
                  // header("Location: http://www.example.com/");
                }
              ?>
              <form action="catadd.php" method="POST">            
                  <input type="text" name="catName" placeholder="Vui lòng thêm danh mục sản phẩm"  class="form-control">
                  <button type="submit" class="btn btn-primary" style="text-align: center;">Thêm danh mục</button>
              </form>  
            </div>
          </div>
        </div>
      </div>
    </div>
<?php include('inc/footer.php'); ?>